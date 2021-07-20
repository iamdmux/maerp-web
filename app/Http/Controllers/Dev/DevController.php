<?php

namespace App\Http\Controllers\Dev;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DevController extends Controller
{
    public function magazzino(){
        $slugLength = User::SLUGLENGTH;


        for ($i=15; $i <=25 ; $i++) { 

           $user = User::create([
                'id' => $i,
                'name' => 'magazzino',
                'slug' => Str::random($slugLength),
                'email' => "magazzino$i@maerp.app",
                'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
            ]);
            User::find($user->id)->assignRole('resp. magazzino');
        }

            return redirect('/erp')->with('success', 'All good!');
        }
    
}
