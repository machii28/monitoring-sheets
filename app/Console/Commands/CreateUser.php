<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backpack:user
                            {--F|first_name= : The name of the new user}
                            {--L|last_name= : The name of the new user}
                            {--R|role= : The name of the new user}
                            {--E|email= : The user\'s email address}
                            {--P|password= : User\'s password}
                            {--encrypt=true : Encrypt user\'s password if it\'s plain text ( true by default )}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Creating a new user');

        if (! $firstName = $this->option('first_name')) {
            $firstName = $this->ask('First Name');
        }

        if (! $lastName = $this->option('last_name')) {
            $lastName = $this->ask('Last Name');
        }

        if (! $email = $this->option('email')) {
            $email = $this->ask('Email');
        }

        if (! $password = $this->option('password')) {
            $password = $this->secret('Password');
        }

        if (! $role = $this->option('role')) {
            $role = $this->ask('Role');
        }

        if ($this->option('encrypt')) {
            $password = Hash::make($password);
        }

        $auth = config('backpack.base.user_model_fqn', 'App\User');
        $user = new $auth();
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->role = $role;
        $user->email = $email;
        $user->password = $password;

        if ($user->save()) {
            $this->info('Successfully created new user');
        } else {
            $this->error('Something went wrong trying to save your user');
        }
    }
}

