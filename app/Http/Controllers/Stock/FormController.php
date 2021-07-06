<?php

namespace App\Http\Controllers\Stock;

use Illuminate\Http\Request;
use App\Models\Stock\StocksForm;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Stocks\StocksFormInformations;

class FormController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            "name" => 'required|max:255',
            "surname" => 'required|max:255',
            "email" => 'required|email',
            "object" => 'required|max:255',
            "company" => 'nullable|max:255',
            "textbody" => 'required|max:65535',
        ]);

        $data['tipo_form'] = 'stocks';
        
        try {
            Mail::to( env('MAIL_FROM_ADDRESS') )->send(new StocksFormInformations($data));
        }
        catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage() . '<br> Ci scusiamo ma non è stato possibile invare la email. Si prega di riprovare più tardi.'])->withInput();  
        }


        if(auth()->check()){
            $userId = auth()->id();
        } else {
            $userId = null;
        }

        $form = StocksForm::create([
            'user_id' => $userId,
            'nome' => $data['name'],
            'cognome' => $data['surname'],
            'email' => $data['email'],
            'azienda' => $data['company'],
            'oggetto' => $data['object'],
            'messaggio' => $data['textbody'],
            'tipo_form' => $data['tipo_form']
        ]);

        return back()->with('success', 'L\'email è stata inviata. Grazie per averci contattato, risponederemo il prima possibile.');

    }

    public function show($id){
        $form = StocksForm::findOrFail($id);
        return view('stocks.erp.show', [
            'form' => $form
        ]);
    }

    public function index(){
        // visualizzabile da ERP
        $messages = StocksForm::paginate(100);
        return view('stocks.erp.index', [
            'messages' => $messages
        ]);
    }


    public function delete($id){
        $form = StocksForm::findOrFail($id);
        $form->delete();
        return redirect()->route('erp.stocksforms.index')->with('success', 'Il messaggio è stato eliminato');
    }
}
