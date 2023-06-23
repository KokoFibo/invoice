<?php

namespace App\Http\Livewire;

use App\Models\Package;
use Livewire\Component;
use App\Models\Contract;
use Illuminate\Support\Facades\Session;

class Updatedetailcontractwr extends Component
{
    public $package, $price, $qty, $description, $current_id, $packages, $contract_number;

    public function mount ($current_id, $number) {
        $this->contract_number = $number;
        $this->current_id = $current_id;
        $this->packages = Package::all();
        if($current_id) {
            $data = Contract::find($current_id);
            $this->package = $data->package;
            $this->price = $data->price;
            $this->qty = $data->qty;
            $this->description = $data->description;
        }
    }

    public function updateLower () {
        $data = Contract::find($this->current_id);
        $data->package = $this->package;
        $data->price = $this->price;
        $data->qty = $this->qty;
        $data->description = $this->description;
        $data->save();

        Session::flash('message', 'Data Updated');
        $url = 'updatecontract/'.$this->contract_number;
        return redirect()->to($url);

    }

    public function updatedPackage()
    {
        try {
            $data = Package::where('package', $this->package)->first();
            $this->price = $data->price;
            $this->description = $data->description;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function cancel () {

        $url = 'updatecontract/'.$this->contract_number;
        return redirect()->to($url);
    }

    public function render()
    {
        return view('livewire.updatedetailcontractwr');
    }
}
