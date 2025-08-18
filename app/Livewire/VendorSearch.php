<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class VendorSearch extends Component
{
    public $search = '';

    public function render()
    {
        $vendors = User::where('is_vendor', true)
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.vendor-search', compact('vendors'));
    }
}
