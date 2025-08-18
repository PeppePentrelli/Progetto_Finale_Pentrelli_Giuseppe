<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class MakeUserVendor extends Command
{

    protected $signature = 'app:make-user-vendor {email}';


    protected $description = 'Rende un utente venditore';

   
    public function handle()
    {
        $email = $this->argument('email');

        $user = User::where('email', $email)->first();

     
        if (!$user) {
            $this->error("Nessun utente trovato con email: {$email}");
            return 1;
        }

        $user->is_vendor = true;
        $user->save();

        $this->info("L'utente {$email} è ora venditore!");
        return 0; 
    }
}
