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

        if(!help_is_production()){
            $u1 = User::create([
                'name' => 'magazzino1',
                'slug' => Str::random($slugLength),
                'email' => 'magazzino1@maerp.app',
                'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
            ]);
            User::find($u1->id)->assignRole('resp. magazzino');
            $u2 = User::create([
                'name' => 'magazzino2',
                'slug' => Str::random($slugLength),
                'email' => 'magazzino2@maerp.app',
                'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
            ]);
            User::find($u2->id)->assignRole('resp. magazzino');
            $u3 = User::create([
                'name' => 'magazzino3',
                'slug' => Str::random($slugLength),
                'email' => 'magazzino3@maerp.app',
                'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
            ]);
            User::find($u3->id)->assignRole('resp. magazzino');

            return redirect('/erp')->with('success', 'All good!');
        }
    }
}
