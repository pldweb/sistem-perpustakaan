<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class Latihan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:latihan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        for ($i = 1; $i <= 1000; $i++) {
            $pad = str_pad($i, 4, '0', STR_PAD_LEFT);
            $nama = "User $pad";

            $user = User::query()->where(['nama' => $nama])->first();
            if (is_null($user)) {
                $this->info("create user : $nama");
                User::query()->create([
                    'nama' => $nama,
                    'email' => "user$pad@gmail.com",
                    'password' => Hash::make('12345'),
                    'role' => 'user'
                ]);
            }
        }
    }
}
