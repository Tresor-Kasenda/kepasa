<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\RoleEnum;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kepasa:add-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates users and stores them in the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->comment('Add User Command Interactive Wizard');

        process : {
            $name = ucwords($this->anticipate('name', ['admin', 'kepasa manager']));
            $email = strtolower($this->ask('email'));
            $password = $this->secret('password');
            $password_confirmation = $this->secret('confirm password');

            $validator = validator(
                compact('name', 'email', 'password', 'password_confirmation'),
                [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]
            );
        }

        if (!$validator->fails()) {
            try {
                $password = Hash::make($password);
                $role = Role::query()
                    ->where('id', '=', RoleEnum::SUPER)
                    ->first();
                $role_id = $role->id;
                $user = User::query()
                    ->create(compact('name', 'email', 'password', 'role_id'));

                $user->save();
                Profile::query()
                    ->create([
                        'user_id' => $user->id
                    ]);
                Setting::query()
                    ->create([
                        'user_id' => $user->id
                    ]);
                $this->info(sprintf('User %s <%s> created', $name, $email));
                exit();
            } catch (\Exception $exception) {
                $this->error('Something went wrong run the command with -v for more details');
                dd($exception);
            }
        } else {
            $this->error("some values are wrong !");
            $this->table(['Errors'], $validator->errors()->messages());
            goto process;
        }
    }
}
