<?php

namespace Database\Seeders; 
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Créer un utilisateur
        $user = User::create([
            'name' => 'Admin',
            'email' => 'sophiehasindrae@gmail.com',
            'password' => bcrypt('admiN_1234'), 
        ]);

        $user->save();

        // Créer un compte administrateur associé à l'utilisateur
        Admin::create([
            'user_id' => $user->id,
            'admin_contact' => '+261347176224',
            'admin_contact_type' => 'telephone',
        ]);
    }
}
