<?php

namespace App\Http\Livewire;

use App\Models\Package;
use Livewire\Component;

class EditPackage extends Component
{
    // public $param;
    // public $package, $price, $description, $idPackage;

    protected $rules = [


        'package' => 'required',
        'price' => 'required|numeric',
        'description' => 'required',

    ];

    public function clear()
    {
        $this->package = '';
        $this->price = '';
        $this->description = '';
    }

    public function mount($param)
    {
        $this->param = $param;
        if ($param != null) {

            $data = Package::find($param);
            $this->idPackage = $data->id;
            $this->package = $data->package;
            $this->price = $data->price;
            $this->description = $data->description;
        }
    }

    public function updatePackage()
    {
        $this->price = convert_numeric($this->price);

        $this->validate();

        $data = Package::find($this->param);
        $data->package = $this->package;
        $data->price = $this->price;
        $data->description = $this->description;
        $data->save();
        $this->clear();
        $this->dispatchBrowserEvent('success', ['message' => 'Data Updated']);
        return redirect('/package')->with('success', 'Package Updated');
    }
    public function render()
    {
        return view('livewire.edit-package');
    }
}
