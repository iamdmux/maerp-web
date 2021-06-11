<?php

namespace App\Http\Controllers\Magazzino;

use App\Models\User;
use App\Models\TemporayFile;
use Illuminate\Http\Request;
use App\Models\Magazzino\Lotto;
use App\Models\Magazzino\Marca;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class LottoController extends Controller
{
    public function __construct(){
        $this->middleware(['permission:visualizzare-lotti'])->only('index');
        $this->middleware(['permission:modificare-lotti'], ['only' => [
            'destroy',
        ]]);
    }

    public function index(){

        $lotti = Lotto::with('marca', 'status')->orderBy('created_at', 'DESC')->get();

        return view('magazzino.lotti.index', [
            'lotti' => $lotti,
        ]);
    }

    public function create(){
        $tipologia = Lotto::TIPOLOGIA;
        $marche = Marca::get();

        return view('magazzino.lotti.create-edit', [
            'tipoogia' => $tipologia,
            'marche' => $marche,
            'nazioniArray' => help_country_iso3166(),
            'method' => 'create'
        ]);
    }

    public function store(Request $request){

        $data = $this->validation($request);

        if($data['nazioni_tranne']){
            $data['nazioni_tranne'] = json_encode($data['nazioni_tranne']);
        }

        $pathImage = null;
        if ($data->hasFile('shopimage') && !$data->delete_image) {
            $file = $data->file('shopimage');
            $folder = uniqid() . now()->timestamp;
            $filename = $this->sanitizeFileName($file->getClientOriginalName());
            $pathImage = $file->storeAs(
                "media/lotti/$folder", $filename, 'public'
            );
        }
        $pathVideo = null;
        if ($data->hasFile('shopvideo') && !$data->delete_video) {
            $file = $data->file('shopvideo');
            $folder = uniqid() . now()->timestamp;
            $filename = $this->sanitizeFileName($file->getClientOriginalName());
            $pathVideo = $file->storeAs(
                "media/lotti/$folder", $filename, 'public'
            );
        }

        if($pathImage){
            $data['shop_image'] = $pathImage;
        }
        if($pathVideo){
            $data['shop_video'] = $pathVideo;
        }

        $nuovoLotto = new Lotto;
        $nuovoLotto->create($data->all());

        return redirect()->route('lotti.index')->with('success', 'Il lotto è stata creato');
    }

    public function edit($lottoId){
        $lotto = Lotto::with('marca', 'status')->findOrFail($lottoId);
        $tipologia = Lotto::TIPOLOGIA;
        $marche = Marca::get();

        $prenotatoList = $lotto->status->filter(function ($item) {
            return $item->pivot->tipo == 'prenotato';
        });

        $vendutoList = $lotto->status->filter(function ($item) {
            return $item->pivot->tipo == 'venduto';
        });

        return view('magazzino.lotti.create-edit', [
            'lotto' => $lotto,
            'tipoogia' => $tipologia,
            'marche' => $marche,
            'prenotatoList' => $prenotatoList,
            'vendutoList' => $vendutoList,
            'nazioniArray' => help_country_iso3166(),
            'method' => 'edit'
        ]);
    }

    public function update(Request $request, $lottoId){

        $data = $this->validation($request);

        $lotto = Lotto::findOrFail($lottoId);

        if($data['nazioni_tranne']){
            $data['nazioni_tranne'] = json_encode($data['nazioni_tranne']);
        }

        if(auth()->user()->can('modificare-lotti')){

            [$data] = $this->handleFormMedia($data, $lotto);

            $lotto->update($data->all());

            return redirect()->route('lotti.index')->with('success', 'Il lotto è stato aggiornato');
        } else {
            return redirect()->route('lotti.index')->with('success', 'Qualcosa è andato storto');
        }
    }

    protected function sanitizeFileName($string){
        return preg_replace("/[^a-z0-9\.]/", "", strtolower($string));
    }
    
    protected function handleFormMedia($data, $lotto){
        // media
        if($data->delete_image){
            if($lotto->shop_image){
                $this->deleteMedia($lotto, 'image');
                $data['shop_image'] = null;
            }
        }

        if($data->delete_video){
            if($lotto->shop_video){
                $this->deleteMedia($lotto, 'video');
                $data['shop_video'] = null;
            }
        }
        $pathImage = null;
        if ($data->hasFile('shopimage') && !$data->delete_image) {
            $file = $data->file('shopimage');
            $folder = uniqid() . now()->timestamp;
            $filename = $this->sanitizeFileName($file->getClientOriginalName());

            
            $pathImage = $file->storeAs(
                "media/lotti/$folder", $filename, 'public'
            );

            if($lotto->shop_image){
                $this->deleteMedia($lotto, 'image');
            }
        }
        $pathVideo = null;
        if ($data->hasFile('shopvideo') && !$data->delete_video) {
            $file = $data->file('shopvideo');
            $folder = uniqid() . now()->timestamp;
            $filename = $this->sanitizeFileName($file->getClientOriginalName());

            
            $pathVideo = $file->storeAs(
                "media/lotti/$folder", $filename, 'public'
            );

            if($lotto->shop_video){
                $this->deleteMedia($lotto, 'video');
            }
        }

        if($pathImage){
            $data['shop_image'] = $pathImage;
        }
        if($pathVideo){
            $data['shop_video'] = $pathVideo;
        }

        return [$data];
    }



    protected function deleteMedia($lotto, $type, $emptyDb = false){
        if($type == 'image'){
            $path = $lotto->shop_image;
        } elseif($type == 'video'){
            $path = $lotto->shop_video;
        }

        if(isset($path)){
            $explode = explode('/', $path);
            $dir = $explode[count($explode)-2];

            if(Storage::delete('public/'. $path)){
                $url = storage_path("app/public/media/lotti/$dir");
                if(File::deleteDirectory($url)){
                    return;
                } else {
                    Log::error("Cartella del lotto $lotto->id non cancellata" );
                }
            }
        }
    }


    public function destroy($lottoId){
        // vedi Observer per la cancellazione dei media
        Lotto::findOrFail($lottoId)->delete();
        return redirect()->route('lotti.index')->with('success', 'Il lotto è stata cancellato');
    }


    protected function validation(Request $request){

        $request->validate([
            'marca_id' => 'required|exists:magazzino_marche,id',
            'stagione' => 'required',
            'tipologia' => 'required',
            'kg' => 'required|numeric',
            'quantita' => 'required|numeric',
            'codice_articolo' => 'required',
            //shop
            "in_shop" => 'nullable',
            "shop_prezzo" => Rule::requiredIf($request->in_shop), 'numeric',
            "shopimage" => 'nullable|image',
            "shopvideo" => 'nullable|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4',
            "shop_descrizione" => Rule::requiredIf($request->in_shop), 'max:65535',
            "visibilita" => Rule::requiredIf($request->in_shop),
            "nazioni_tranne" => 'nullable',
            'delete_image' => 'nullable',
            'delete_video' => 'nullable',
        ]);

        return $request;
    }
}
