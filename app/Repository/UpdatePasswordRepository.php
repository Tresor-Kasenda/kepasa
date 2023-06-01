<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UpdatePasswordRepository
{
    public function updatePassword($request, User $user): User|RedirectResponse
    {

        if (! Hash::check($request['old_password'], $user->password)) {
            return back()->with('danger', "Old password doesn't match ! ");
        }
        $user->update([
            'password' => Hash::make($request['password'])
        ]);

        return $user;
    }
    public function reset(User $user, $request): JsonResponse|Redirector|RedirectResponse|Application
    {
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        }
        );

        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }

    protected function credentials(Request $request): array
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'current_password'
        );
    }

    protected function resetPassword($user, $password): void
    {
        $this->setUserPassword($user, $password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

        $this->guard()->login($user);
    }

    protected function setUserPassword($user, $password): void
    {
        $user->password = Hash::make($password);
    }

    protected function sendResetResponse(Request $request, $response): JsonResponse|Redirector|RedirectResponse|Application
    {
        if ($request->wantsJson()) {
            return new JsonResponse(['message' => trans($response)], 200);
        }

        return redirect($this->redirectPath())
            ->with('status', trans($response));
    }

    protected function sendResetFailedResponse(Request $request, $response): RedirectResponse
    {
        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'email' => [trans($response)],
            ]);
        }

        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    public function broker(): PasswordBroker
    {
        return Password::broker();
    }

    protected function guard(): Guard|StatefulGuard
    {
        return Auth::guard();
    }
}
