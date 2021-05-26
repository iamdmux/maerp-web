<?php

namespace App\Observers;


use App\Models\Magazzino\Lotto;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LottoObserver
{

    public function created(Lotto $lotto)
    {
        //
    }


    public function updated(Lotto $lotto)
    {
        //
    }


    public function deleted(Lotto $lotto){
        if($lotto->shop_image){
            $this->deleteLottoMedia($lotto->shop_image);
        }
        
        if($lotto->shop_video){
            $this->deleteLottoMedia($lotto->shop_video);
        }
    }

    public function restored(Lotto $lotto)
    {
        //
    }


    public function forceDeleted(Lotto $lotto)
    {
        //
    }


    protected function deleteLottoMedia($path){
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
