<?php

namespace App\Http\Livewire;

use App\Models\Quotation;
use App\Models\Package;
use Livewire\Component;

class Addquotationwr extends Component
{
    public $quotation_date,  $customer_id, $contract, $tax;
    public $discount, $status, $package, $price, $qty, $number;
    public $current_id, $packages;

    public function mount ($number) {
        $this->number = $number;
        $this->packages = Package::all();
        $data = Quotation::where('number', $this->number)->first();
        $this->quotation_date = $data->quotation_date;
        $this->customer_id = $data->customer_id;
        $this->status = $data->status;
        $this->package = '';
        $this->price = 0;
        $this->description = '';
    }

    public function storeLower () {
        $data = new Quotation();

        $data->number = $this->number;
        $data->quotation_date = $this->quotation_date;
        $data->customer_id = $this->customer_id;
        $data->status = $this->status;
        $data->package = $this->package;
        $data->price = $this->price;
        $data->description = $this->description;
        $data->save();
        $this->dispatchBrowserEvent('success', ['message' => 'Data Saved']);

        $url = 'updatequotation/'.$this->number;
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

        $url = 'updatequotation/'.$this->number;
        return redirect()->to($url);
    }

    public function render()
    {
        return view('livewire.addquotationwr');
    }
}
