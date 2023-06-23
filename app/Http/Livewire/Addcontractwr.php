<?php

namespace App\Http\Livewire;

use App\Models\Package;
use Livewire\Component;
use App\Models\Contract;

class Addcontractwr extends Component
{

    public $contract_number, $customer_id, $contract_begin, $contract_end, $package, $price, $qty, $description, $status;
    public $packages;

    public function mount ($contract_number) {

        $this->contract_number = $contract_number;
        $this->packages = Package::all();
        $data = Contract::where('contract_number', $this->contract_number)->first();
        $this->contract_begin = $data->contract_begin;
        $this->contract_end = $data->contract_end;
        $this->customer_id = $data->customer_id;

        $this->status = $data->status;
        $this->package = '';
        $this->price = 0;
        $this->qty = 1;
        $this->description = '';
    }

    public function storeLower () {
        $data = new Contract();

        $data->contract_number = $this->contract_number;
        $data->contract_begin = $this->contract_begin;
        $data->contract_end = $this->contract_end;
        $data->customer_id = $this->customer_id;
        $data->status = $this->status;
        $data->package = $this->package;
        $data->price = $this->price;
        $data->qty = $this->qty;
        $data->description = $this->description;
        $data->save();
        $this->dispatchBrowserEvent('success', ['message' => 'Data Saved']);
        $url = 'updatecontract/'.$this->contract_number;
        return redirect()->to($url);
    }

    public function getPrice () {
        if($this->package != null) {
            $data = Package::where('package', $this->package)->first();
            $this->price = $data->price;
            $this->description = $data->description;
        } else {
            $this->price = 0;
            $this->description = '';
        }
    }

    public function cancel () {

        $url = 'updatecontract/'.$this->contract_number;
        return redirect()->to($url);
    }


    public function render()
    {

        return view('livewire.addcontractwr');
    }
}
