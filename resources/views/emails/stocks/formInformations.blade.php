@component('mail::message')
# Richiesta informazioni dalla pagina {{$form['tipo_form']}}
<br/><br/>
richiesta da 
<span class="dark-text">
    <b>
        {{ucfirst($form['nome'])}} {{ucfirst($form['cognome'])}}
    </b>
</span>  
Azienda:
<span class="dark-text">
    <b>
        {{ucfirst($form['azienda'])}}
    </b>
</span>

Messaggio: {{ucfirst($form['messaggio'])}}


{{-- <p style="margin-top:100px">
    Email di notifica dal form  
    di: {{$form['tipo_form']}}
</p> --}}

@endcomponent
