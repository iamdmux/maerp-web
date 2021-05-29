<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'impostazioni']);
        Permission::create(['name' => 'assegnare-clienti']);
        Permission::create(['name' => 'visualizzare-lotti']);
        Permission::create(['name' => 'modificare-lotti']);
        Permission::create(['name' => 'vendite']);
        Permission::create(['name' => 'fatturazione']);
        Permission::create(['name' => 'creare-fatture']);
        Permission::create(['name' => 'acquisti']);
        Permission::create(['name' => 'magazzino-blackbox']);
        Permission::create(['name' => 'erp user']);

        // create roles and assign created permissions
        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'agente'])->givePermissionTo(['dashboard', 'vendite', 'visualizzare-lotti', 'erp user']);
        Role::create(['name' => 'resp. magazzino'])->givePermissionTo(['dashboard', 'magazzino-blackbox', 'visualizzare-lotti', 'modificare-lotti', 'erp user']);


        User::find(1)->assignRole('admin');
        User::find(2)->assignRole('admin');
        User::find(3)->assignRole('admin');
        for ($i=4; $i <= 10; $i++) { 
            User::find($i)->assignRole('agente');
        }
        User::find(11)->assignRole('resp. magazzino');

        
        // gli agenti:

        // LOTTI: Possono vedere i lotti
        //      : non possono modificare i lotti

        // CLIENTI: 
        // Visualizzano solo i loro clienti
        // Crezione: viene assegnato a se stessi
        // MA SE è ADMIN, ASSEGNA I CLIENTE ALL 'AGENTE?

        // FATTURA:
        // INDEX: MOSTRARE SOLO LE proprie FATTTURE
        // view, non visualizzare: proforma fattura e fattura elettronica
        // crezione: API, mostrare solo i loro CLIENTI
        // back:
        // CHECK In fatturaController
    }
}
