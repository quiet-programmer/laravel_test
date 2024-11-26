<?php

namespace App\Livewire;

use App\Livewire\Forms\AuthForm;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

class AuthPage extends Component
{
    public AuthForm $form;

    public function loginUser()
    {
        $this->form->validate();

        if ($this->form->authenticate()) {
            return redirect()->route('admin.home');
        }
    }
    public function render()
    {
        return view('livewire.auth-page');
    }
}
