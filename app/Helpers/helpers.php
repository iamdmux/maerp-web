<?php

if (!function_exists('help_is_production')) {
    function help_is_production(){ 
        return (env('APP_ENV') == 'production') ? 1 : 0;
    }
}


// svg colors
if (!function_exists('help_svg_link')) {
    function help_svg_link(){ 
          return 'inline-block text-gray-600 hover:text-gray-400 p-1 rounded-full shadow';
    }
}

// svg_icon_show
if (!function_exists('help_svg_icon_show')) {
    function help_svg_icon_show(){ 
          return '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>';
    }
}

// svg_icon_edit
if (!function_exists('help_svg_icon_edit')) {
    function help_svg_icon_edit(){ 
          return '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>';
    }
}

// svg_icon_pause
if (!function_exists('help_svg_icon_pause')) {
    function help_svg_icon_pause(){ 
          return '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
    }
}


// DATE

// MESI
if (!function_exists('help_mesi_array')) {
    function help_mesi_array(){ 
        return [ 1 =>'Gennaio', 2 =>'Febbraio', 3 =>'Marzo', 4 =>'Aprile', 5=> 'Maggio', 6 =>'Giugno', 7=>'Luglio', 8=>'Agosto', 9=>'Settembre', 10=>'Ottobre', 11=>'Novembre', 12=>'Dicembre'];
    }
}

// IMMAGINI
// if (!function_exists('getStorageMedia')) {
//     function getStorageMedia($lotto){
//         if(!$lotto->shop_image){
//             return null;
//         } elseif(( $file = asset($lotto->shop_image) )){
//             return $file;
//         } else {
//             return $file . 'no file';
//         }
//     }
// }

if (!function_exists('help_country_iso3166')){
    function help_country_iso3166(){
        return [
            ['sigla' => 'IT',  'nazione' => 'Italia'],
            ['sigla' => 'AD',  'nazione' => 'Andorra'],
            ['sigla' => 'AE',  'nazione' => 'Emirati Arabi Uniti'],
            ['sigla' => 'AF',  'nazione' => 'Afghanistan'],
            ['sigla' => 'AG',  'nazione' => 'Antigua e Barbuda'],
            ['sigla' => 'AI',  'nazione' => 'Anguilla'],
            ['sigla' => 'AL',  'nazione' => 'Albania'],
            ['sigla' => 'AM',  'nazione' => 'Armenia'],
            ['sigla' => 'AO',  'nazione' => 'Angola'],
            ['sigla' => 'AQ',  'nazione' => 'Antartide'],
            ['sigla' => 'AR',  'nazione' => 'Argentina'],
            ['sigla' => 'AS',  'nazione' => 'Samoa Americane'],
            ['sigla' => 'AT',  'nazione' => 'Austria'],
            ['sigla' => 'AU',  'nazione' => 'Australia'],
            ['sigla' => 'AW',  'nazione' => 'Aruba'],
            ['sigla' => 'AX',  'nazione' => 'Isole Åland'],
            ['sigla' => 'AZ',  'nazione' => 'Azerbaigian'],
            ['sigla' => 'BA',  'nazione' => 'Bosnia ed Erzegovina'],
            ['sigla' => 'BB',  'nazione' => 'Barbados'],
            ['sigla' => 'BD',  'nazione' => 'Bangladesh'],
            ['sigla' => 'BE',  'nazione' => 'Belgio'],
            ['sigla' => 'BF',  'nazione' => 'Burkina Faso'],
            ['sigla' => 'BG',  'nazione' => 'Bulgaria'],
            ['sigla' => 'BH',  'nazione' => 'Bahrein'],
            ['sigla' => 'BI',  'nazione' => 'Burundi'],
            ['sigla' => 'BJ',  'nazione' => 'Benin'],
            ['sigla' => 'BL',  'nazione' => 'Saint-Barthélemy'],
            ['sigla' => 'BM',  'nazione' => 'Bermuda'],
            ['sigla' => 'BN',  'nazione' => 'Brunei'],
            ['sigla' => 'BO',  'nazione' => 'Bolivia'],
            ['sigla' => 'BQ',  'nazione' => 'Isole BES'],
            ['sigla' => 'BR',  'nazione' => 'Brasile'],
            ['sigla' => 'BS',  'nazione' => 'Bahamas'],
            ['sigla' => 'BT',  'nazione' => 'Bhutan'],
            ['sigla' => 'BV',  'nazione' => 'Isola Bouvet'],
            ['sigla' => 'BW',  'nazione' => 'Botswana'],
            ['sigla' => 'BY',  'nazione' => 'Bielorussia'],
            ['sigla' => 'BZ',  'nazione' => 'Belize'],
            ['sigla' => 'CA',  'nazione' => 'Canada'],
            ['sigla' => 'CC',  'nazione' => 'Isole Cocos e Keeling'],
            ['sigla' => 'CD',  'nazione' => 'Repubblica Democratica del Congo'],
            ['sigla' => 'CF',  'nazione' => 'Repubblica Centrafricana'],
            ['sigla' => 'CG',  'nazione' => 'Repubblica del Congo'],
            ['sigla' => 'CH',  'nazione' => 'Svizzera'],
            ['sigla' => 'CI',  'nazione' => 'Costa d\'Avorio'],
            ['sigla' => 'CK',  'nazione' => 'Isole Cook'],
            ['sigla' => 'CL',  'nazione' => 'Cile'],
            ['sigla' => 'CM',  'nazione' => 'Camerun'],
            ['sigla' => 'CN',  'nazione' => 'Cina'],
            ['sigla' => 'CO',  'nazione' => 'Colombia'],
            ['sigla' => 'CR',  'nazione' => 'Costa Rica'],
            ['sigla' => 'CU',  'nazione' => 'Cuba'],
            ['sigla' => 'CV',  'nazione' => 'Capo Verde'],
            ['sigla' => 'CW',  'nazione' => 'Curaçao'],
            ['sigla' => 'CX',  'nazione' => 'Isola del Natale'],
            ['sigla' => 'CY',  'nazione' => 'Cipro'],
            ['sigla' => 'CZ',  'nazione' => 'Repubblica Ceca'],
            ['sigla' => 'DE',  'nazione' => 'Germania'],
            ['sigla' => 'DJ',  'nazione' => 'Gibuti'],
            ['sigla' => 'DK',  'nazione' => 'Danimarca'],
            ['sigla' => 'DM',  'nazione' => 'Dominica'],
            ['sigla' => 'DO',  'nazione' => 'Repubblica Dominicana'],
            ['sigla' => 'DZ',  'nazione' => 'Algeria'],
            ['sigla' => 'EC',  'nazione' => 'Ecuador'],
            ['sigla' => 'EE',  'nazione' => 'Estonia'],
            ['sigla' => 'EG',  'nazione' => 'Egitto'],
            ['sigla' => 'EH',  'nazione' => 'Sahara Occidentale'],
            ['sigla' => 'ER',  'nazione' => 'Eritrea'],
            ['sigla' => 'ES',  'nazione' => 'Spagna'],
            ['sigla' => 'ET',  'nazione' => 'Etiopia'],
            ['sigla' => 'FI',  'nazione' => 'Finlandia'],
            ['sigla' => 'FJ',  'nazione' => 'Figi'],
            ['sigla' => 'FK',  'nazione' => 'Isole Falkland'],
            ['sigla' => 'FM',  'nazione' => 'Stati Federati di Micronesia'],
            ['sigla' => 'FO',  'nazione' => 'Isole Fær Øer'],
            ['sigla' => 'FR',  'nazione' => 'Francia'],
            ['sigla' => 'GA',  'nazione' => 'Gabon'],
            ['sigla' => 'GB',  'nazione' => 'Regno Unito'],
            ['sigla' => 'GD',  'nazione' => 'Grenada'],
            ['sigla' => 'GE',  'nazione' => 'Georgia'],
            ['sigla' => 'GF',  'nazione' => 'Guyana francese'],
            ['sigla' => 'GG',  'nazione' => 'Guernsey'],
            ['sigla' => 'GH',  'nazione' => 'Ghana'],
            ['sigla' => 'GI',  'nazione' => 'Gibilterra'],
            ['sigla' => 'GL',  'nazione' => 'Groenlandia'],
            ['sigla' => 'GM',  'nazione' => 'Gambia'],
            ['sigla' => 'GN',  'nazione' => 'Guinea'],
            ['sigla' => 'GP',  'nazione' => 'Guadalupa'],
            ['sigla' => 'GQ',  'nazione' => 'Guinea Equatoriale'],
            ['sigla' => 'GR',  'nazione' => 'Grecia'],
            ['sigla' => 'GS',  'nazione' => 'Georgia del Sud e isole Sandwich meridionali'],
            ['sigla' => 'GT',  'nazione' => 'Guatemala'],
            ['sigla' => 'GU',  'nazione' => 'Guam'],
            ['sigla' => 'GW',  'nazione' => 'Guinea-Bissau'],
            ['sigla' => 'GY',  'nazione' => 'Guyana'],
            ['sigla' => 'HK',  'nazione' => 'Hong Kong'],
            ['sigla' => 'HM',  'nazione' => 'Isole Heard e McDonald'],
            ['sigla' => 'HN',  'nazione' => 'Honduras'],
            ['sigla' => 'HR',  'nazione' => 'Croazia'],
            ['sigla' => 'HT',  'nazione' => 'Haiti'],
            ['sigla' => 'HU',  'nazione' => 'Ungheria'],
            ['sigla' => 'ID',  'nazione' => 'Indonesia'],
            ['sigla' => 'IE',  'nazione' => 'Irlanda'],
            ['sigla' => 'IL',  'nazione' => 'Israele'],
            ['sigla' => 'IM',  'nazione' => 'Isola di Man'],
            ['sigla' => 'IN',  'nazione' => 'India'],
            ['sigla' => 'IO',  'nazione' => 'Territori Britannici dell\'Oceano Indiano'],
            ['sigla' => 'IQ',  'nazione' => 'Iraq'],
            ['sigla' => 'IR',  'nazione' => 'Iran'],
            ['sigla' => 'IS',  'nazione' => 'Islanda'],
            ['sigla' => 'JE',  'nazione' => 'Jersey'],
            ['sigla' => 'JM',  'nazione' => 'Giamaica'],
            ['sigla' => 'JO',  'nazione' => 'Giordania'],
            ['sigla' => 'JP',  'nazione' => 'Giappone'],
            ['sigla' => 'KE',  'nazione' => 'Kenya'],
            ['sigla' => 'KG',  'nazione' => 'Kirghizistan'],
            ['sigla' => 'KH',  'nazione' => 'Cambogia'],
            ['sigla' => 'KI',  'nazione' => 'Kiribati'],
            ['sigla' => 'KM',  'nazione' => 'Comore'],
            ['sigla' => 'KN',  'nazione' => 'Saint Kitts e Nevis'],
            ['sigla' => 'KP',  'nazione' => 'Corea del Nord'],
            ['sigla' => 'KR',  'nazione' => 'Corea del Sud'],
            ['sigla' => 'KW',  'nazione' => 'Kuwait'],
            ['sigla' => 'KY',  'nazione' => 'Isole Cayman'],
            ['sigla' => 'KZ',  'nazione' => 'Kazakistan'],
            ['sigla' => 'LA',  'nazione' => 'Laos'],
            ['sigla' => 'LB',  'nazione' => 'Libano'],
            ['sigla' => 'LC',  'nazione' => 'Santa Lucia'],
            ['sigla' => 'LI',  'nazione' => 'Liechtenstein'],
            ['sigla' => 'LK',  'nazione' => 'Sri Lanka'],
            ['sigla' => 'LR',  'nazione' => 'Liberia'],
            ['sigla' => 'LS',  'nazione' => 'Lesotho'],
            ['sigla' => 'LT',  'nazione' => 'Lituania'],
            ['sigla' => 'LU',  'nazione' => 'Lussemburgo'],
            ['sigla' => 'LV',  'nazione' => 'Lettonia'],
            ['sigla' => 'LY',  'nazione' => 'Libia'],
            ['sigla' => 'MA',  'nazione' => 'Marocco'],
            ['sigla' => 'MC',  'nazione' => 'Monaco'],
            ['sigla' => 'MD',  'nazione' => 'Moldavia'],
            ['sigla' => 'ME',  'nazione' => 'Montenegro'],
            ['sigla' => 'MF',  'nazione' => 'Saint-Martin'],
            ['sigla' => 'MG',  'nazione' => 'Madagascar'],
            ['sigla' => 'MH',  'nazione' => 'Isole Marshall'],
            ['sigla' => 'MK',  'nazione' => 'Macedonia del Nord'],
            ['sigla' => 'ML',  'nazione' => 'Mali'],
            ['sigla' => 'MM',  'nazione' => 'Birmania'],
            ['sigla' => 'MN',  'nazione' => 'Mongolia'],
            ['sigla' => 'MO',  'nazione' => 'Macao'],
            ['sigla' => 'MP',  'nazione' => 'Isole Marianne Settentrionali'],
            ['sigla' => 'MQ',  'nazione' => 'Martinica'],
            ['sigla' => 'MR',  'nazione' => 'Mauritania'],
            ['sigla' => 'MS',  'nazione' => 'Montserrat'],
            ['sigla' => 'MT',  'nazione' => 'Malta'],
            ['sigla' => 'MU',  'nazione' => 'Mauritius'],
            ['sigla' => 'MV',  'nazione' => 'Maldive'],
            ['sigla' => 'MW',  'nazione' => 'Malawi'],
            ['sigla' => 'MX',  'nazione' => 'Messico'],
            ['sigla' => 'MY',  'nazione' => 'Malaysia'],
            ['sigla' => 'MZ',  'nazione' => 'Mozambico'],
            ['sigla' => 'NA',  'nazione' => 'Namibia'],
            ['sigla' => 'NC',  'nazione' => 'Nuova Caledonia'],
            ['sigla' => 'NE',  'nazione' => 'Niger'],
            ['sigla' => 'NF',  'nazione' => 'Isola Norfolk'],
            ['sigla' => 'NG',  'nazione' => 'Nigeria'],
            ['sigla' => 'NI',  'nazione' => 'Nicaragua'],
            ['sigla' => 'NL',  'nazione' => 'Paesi Bassi'],
            ['sigla' => 'NO',  'nazione' => 'Norvegia'],
            ['sigla' => 'NP',  'nazione' => 'Nepal'],
            ['sigla' => 'NR',  'nazione' => 'Nauru'],
            ['sigla' => 'NU',  'nazione' => 'Niue'],
            ['sigla' => 'NZ',  'nazione' => 'Nuova Zelanda'],
            ['sigla' => 'OM',  'nazione' => 'Oman'],
            ['sigla' => 'PA',  'nazione' => 'Panama'],
            ['sigla' => 'PE',  'nazione' => 'Perù'],
            ['sigla' => 'PF',  'nazione' => 'Polinesia Francese'],
            ['sigla' => 'PG',  'nazione' => 'Papua Nuova Guinea'],
            ['sigla' => 'PH',  'nazione' => 'Filippine'],
            ['sigla' => 'PK',  'nazione' => 'Pakistan'],
            ['sigla' => 'PL',  'nazione' => 'Polonia'],
            ['sigla' => 'PM',  'nazione' => 'Saint-Pierre e Miquelon'],
            ['sigla' => 'PN',  'nazione' => 'Isole Pitcairn'],
            ['sigla' => 'PR',  'nazione' => 'Porto Rico'],
            ['sigla' => 'PS',  'nazione' => 'Stato di Palestina'],
            ['sigla' => 'PT',  'nazione' => 'Portogallo'],
            ['sigla' => 'PW',  'nazione' => 'Palau'],
            ['sigla' => 'PY',  'nazione' => 'Paraguay'],
            ['sigla' => 'QA',  'nazione' => 'Qatar'],
            ['sigla' => 'RE',  'nazione' => 'Riunione'],
            ['sigla' => 'RO',  'nazione' => 'Romania'],
            ['sigla' => 'RS',  'nazione' => 'Serbia'],
            ['sigla' => 'RU',  'nazione' => 'Russia'],
            ['sigla' => 'RW',  'nazione' => 'Ruanda'],
            ['sigla' => 'SA',  'nazione' => 'Arabia Saudita'],
            ['sigla' => 'SB',  'nazione' => 'Isole Salomone'],
            ['sigla' => 'SC',  'nazione' => 'Seychelles'],
            ['sigla' => 'SD',  'nazione' => 'Sudan'],
            ['sigla' => 'SE',  'nazione' => 'Svezia'],
            ['sigla' => 'SG',  'nazione' => 'Singapore'],
            ['sigla' => 'SH',  'nazione' => 'Sant\'Elena'],
            ['sigla' => 'SI',  'nazione' => 'Slovenia'],
            ['sigla' => 'SJ',  'nazione' => 'Svalbard e Jan Mayen'],
            ['sigla' => 'SK',  'nazione' => 'Slovacchia'],
            ['sigla' => 'SL',  'nazione' => 'Sierra Leone'],
            ['sigla' => 'SM',  'nazione' => 'San Marino'],
            ['sigla' => 'SN',  'nazione' => 'Senegal'],
            ['sigla' => 'SO',  'nazione' => 'Somalia'],
            ['sigla' => 'SR',  'nazione' => 'Suriname'],
            ['sigla' => 'SS',  'nazione' => 'Sudan del Sud'],
            ['sigla' => 'ST',  'nazione' => 'São Tomé e Príncipe'],
            ['sigla' => 'SV',  'nazione' => 'El Salvador'],
            ['sigla' => 'SX',  'nazione' => 'Sint Maarten'],
            ['sigla' => 'SY',  'nazione' => 'Siria'],
            ['sigla' => 'SZ',  'nazione' => 'Swaziland'],
            ['sigla' => 'TC',  'nazione' => 'Isole Turks e Caicos'],
            ['sigla' => 'TD',  'nazione' => 'Ciad'],
            ['sigla' => 'TF',  'nazione' => 'Territori Francesi del Sud'],
            ['sigla' => 'TG',  'nazione' => 'Togo'],
            ['sigla' => 'TH',  'nazione' => 'Thailandia'],
            ['sigla' => 'TJ',  'nazione' => 'Tagikistan'],
            ['sigla' => 'TK',  'nazione' => 'Tokelau'],
            ['sigla' => 'TL',  'nazione' => 'Timor Est'],
            ['sigla' => 'TM',  'nazione' => 'Turkmenistan'],
            ['sigla' => 'TN',  'nazione' => 'Tunisia'],
            ['sigla' => 'TO',  'nazione' => 'Tonga'],
            ['sigla' => 'TR',  'nazione' => 'Turchia'],
            ['sigla' => 'TT',  'nazione' => 'Trinidad e Tobago'],
            ['sigla' => 'TV',  'nazione' => 'Tuvalu'],
            ['sigla' => 'TW',  'nazione' => 'Repubblica di Cina Taiwan'],
            ['sigla' => 'TZ',  'nazione' => 'Tanzania'],
            ['sigla' => 'UA',  'nazione' => 'Ucraina'],
            ['sigla' => 'UG',  'nazione' => 'Uganda'],
            ['sigla' => 'UM',  'nazione' => 'Isole minori esterne degli Stati Uniti'],
            ['sigla' => 'US',  'nazione' => 'Stati Uniti'],
            ['sigla' => 'UY',  'nazione' => 'Uruguay'],
            ['sigla' => 'UZ',  'nazione' => 'Uzbekistan'],
            ['sigla' => 'VA',  'nazione' => 'Città del Vaticano'],
            ['sigla' => 'VC',  'nazione' => 'Saint Vincent e Grenadine'],
            ['sigla' => 'VE',  'nazione' => 'Venezuela'],
            ['sigla' => 'VG',  'nazione' => 'Isole Vergini britanniche'],
            ['sigla' => 'VI',  'nazione' => 'Isole Vergini americane'],
            ['sigla' => 'VN',  'nazione' => 'Vietnam'],
            ['sigla' => 'VU',  'nazione' => 'Vanuatu'],
            ['sigla' => 'WF',  'nazione' => 'Wallis e Futuna'],
            ['sigla' => 'WS',  'nazione' => 'Samoa'],
            ['sigla' => 'YE',  'nazione' => 'Yemen'],
            ['sigla' => 'YT',  'nazione' => 'Mayotte'],
            ['sigla' => 'ZA',  'nazione' => 'Sudafrica'],
            ['sigla' => 'ZM',  'nazione' => 'Zambia'],
            ['sigla' => 'ZW',  'nazione' => 'Zimbabwe'],
            // patch
            ['sigla' => 'KE',  'nazione' => 'Kenia'],
            ['sigla' => 'RS',  'nazione' => 'Kosovo'],
            ['sigla' => 'MM',  'nazione' => 'Myanmar'],
        ];    
    }
}