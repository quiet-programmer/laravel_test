<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthForm extends Form
{
    #[Rule('required|email|max:255')]
    public string $email = '';

    #[Rule('required|max:255')]
    public string $password = '';

    public function authenticate(): bool
    {
        $this->ensureIsNotRateLimited();

        if (!Auth::guard('admin')->attempt($this->only(['email', 'password']))) {
            RateLimiter::hit($this->throttleKey());

            $this->addError('email', trans('auth.failed'));

            return false;
        }

        RateLimiter::clear($this->throttleKey());
        return true;
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}
