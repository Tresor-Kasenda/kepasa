<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\OrganiserAccountCreate;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
            'lastName' => ['required', 'string', 'max:255'],
            'phones' => ['required', 'min:10']
        ]);
    }

    /**
     * @param  array  $data
     * @return Builder|Model
     */
    protected function create(array $data): Model|Builder
    {
        $user = User::query()
            ->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => $data['role'],
                'lastName' => $data['lastName'],
                'phones' => $data['phones'],
                'password' => Hash::make($data['password']),
            ]);
        if ($data['role'] == 3){
            $user->company()->create([
                'email' => $data['email']
            ]);
            dispatch(new OrganiserAccountCreate($user))->delay(now()->addSecond(5));
            return $user;
        } else if($data['role'] = 4){
            $user->profile()->create([
                'alternativePhones' => $data['phones']
            ]);
            return $user;
        }
        return $user;
    }
}
