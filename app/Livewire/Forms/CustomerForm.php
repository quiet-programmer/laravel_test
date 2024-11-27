<?php

namespace App\Livewire\Forms;

use App\Models\Customers;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Attributes\Rule;
use Illuminate\Validation\Rule as ValidationRule;

class CustomerForm extends Form
{
    public ?int $customerId = null;

    #[Rule('required|min:2')]
    public $first_name = '';

    #[Rule('required|min:2')]
    public $last_name = '';

    // #[Rule('required|email|unique:customers,email')]
    // public $email = '';

    #[Rule('required|email')]
    public $email = '';

    #[Rule(['required', 'regex:/^07\d{9}$/'], message: ['regex' => 'Phone number must be 11 digits starting with 07'])]
    public $phone = '';

    #[Rule('required|min:5')]
    public $address = '';

    #[Rule('required')]
    public $city = '';

    #[Rule('required')]
    public $postcode = '';

    #[Rule('required')]
    public $status = '';

    #[Rule('required|date|before:today')]
    public $date_of_birth = '';

    #[Rule('required')]
    public $notes = '';

    public function rules(): array
    {
        $emailRule = [
            'required',
            'email',
        ];

        // Add unique validation only for new records
        if (!$this->customerId) {
            $emailRule[] = 'unique:customers,email';
        } else {
            $emailRule[] = ValidationRule::unique('customers', 'email')->ignore($this->customerId);
        }

        return [
            'email' => $emailRule
        ];
    }

    public function isValid()
    {
        return !empty($this->first_name) &&
            !empty($this->last_name) &&
            !empty($this->email) &&
            !empty($this->eEmail) &&
            !empty($this->phone) &&
            !empty($this->address) &&
            !empty($this->city) &&
            !empty($this->postcode) &&
            !empty($this->status) &&
            !empty($this->date_of_birth) &&
            !empty($this->notes) &&
            preg_match('/^07\d{9}$/', $this->phone) &&
            filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    // CustomerForm.php
    public function hasEmptyFields(): bool
    {
        return empty(trim($this->first_name)) ||
            empty(trim($this->last_name)) ||
            empty(trim($this->email)) ||
            empty(trim($this->phone)) ||
            empty(trim($this->address)) ||
            empty(trim($this->city)) ||
            empty(trim($this->postcode)) ||
            empty($this->status) ||
            empty($this->date_of_birth) ||
            empty(trim($this->notes));
    }

    public function store(): bool
    {
        // $this->validate();

        $this->validate([
            'email' => ['required', 'email', 'unique:customers,email']
        ]);

        try {
            Customers::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'city' => $this->city,
                'postcode' => $this->postcode,
                'status' => $this->status,
                'date_of_birth' => $this->date_of_birth,
                'notes' => $this->notes
            ]);

            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

    public function update(Customers $customer): bool
    {
        try {
            $customer->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'city' => $this->city,
                'postcode' => $this->postcode,
                'status' => $this->status,
                'date_of_birth' => $this->date_of_birth,
                'notes' => $this->notes
            ]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
