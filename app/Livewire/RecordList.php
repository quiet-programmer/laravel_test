<?php

namespace App\Livewire;

use App\Livewire\Forms\CustomerForm;
use App\Models\Customers;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class RecordList extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'created_at';

    #[Url(history: true)]
    public $sortDir = 'desc';

    #[Url(history: true)]
    public $perPage = 5;

    public $selectedCustomer = null;

    public $isEditing = false;

    public CustomerForm $form;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function delete(Customers $customer)
    {
        $customer->delete();
    }

    public function setSortBy($sortBy)
    {
        if ($this->sortBy === $sortBy) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
            return;
        }
        $this->sortBy = $sortBy;
        $this->sortDir = 'desc';
    }

    public function resetForm()
    {
        $this->selectedCustomer = null;
        $this->isEditing = false;
        $this->form->reset();
        $this->dispatch('form-reset');
    }

    public function createCustomerModal()
    {
        $this->isEditing = false;
        $this->form->reset();
    }

    public function createCustomer()
    {
        $this->form->validate();
        if ($this->form->store()) {
            session()->flash('message', 'Customer created successfully!');
            $this->dispatch('close-modal');
            $this->resetForm();
        } else {
            session()->flash('error', 'Failed to create customer. Please try again.');
        }
    }

    public function resetCreateForm()
    {
        $this->form->reset();
    }

    public function editUser($customerId)
    {
        $this->selectedCustomer = Customers::find($customerId);
        $this->isEditing = true;
        $this->form->fill($this->selectedCustomer);
    }

    public function updateCustomer()
    {
        $this->form->validate();


        if ($this->form->update($this->selectedCustomer)) {
            session()->flash('message', 'Customer updated successfully!');

            $this->dispatch('close-modal');
            $this->resetForm();
        } else {
            session()->flash('error', 'Failed to update customer. Please try again.');
        }
    }

    public function logout()
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('admin.authenticate');
    }

    public function viewUser($customerId)
    {
        $this->selectedCustomer = Customers::findOrFail($customerId);
    }

    public function render()
    {
        $customers = Customers::latest()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);
        return view('livewire.record-list', [
            'customers' => $customers,
        ]);
    }
}
