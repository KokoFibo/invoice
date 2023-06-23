<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Package;
use Livewire\Component;

class Addinvoicewr extends Component
{
    public $invoice_date, $due_date, $customer_id, $contract, $tax;
    public $discount, $status, $package, $price, $qty, $number;
    public $packages;

    public function mount ($number) {
        $this->number = $number;
        $this->packages = Package::all();
        $data = Invoice::where('number', $this->number)->first();
        $this->invoice_date = $data->invoice_date;
        $this->due_date = $data->due_date;
        $this->customer_id = $data->customer_id;
        $this->contract = $data->contract;
        $this->tax = $data->tax;
        $this->discount = $data->discount;
        $this->status = $data->status;
        $this->package = '';
        $this->price = 0;
        $this->qty = 0;
    }

    public function storeLower () {
        $data = new Invoice();

        $data->number = $this->number;
        $data->invoice_date = $this->invoice_date;
        $data->due_date = $this->due_date;
        $data->customer_id = $this->customer_id;
        $data->contract = $this->contract;
        $data->tax = $this->tax;
        $data->discount = $this->discount;
        $data->status = $this->status;
        $data->package = $this->package;
        $data->price = $this->price;
        $data->qty = $this->qty;
        $data->save();
        $this->dispatchBrowserEvent('success', ['message' => 'Data Saved']);

        $url = 'updateinvoice/'.$this->number;
        return redirect()->to($url);

    }

    public function getPrice () {
        if($this->package != null) {
            $data = Package::where('package', $this->package)->first();
            $this->price = $data->price;
        } else {
            $this->price = 0;
        }
    }

    public function cancel () {

        $url = 'updateinvoice/'.$this->number;
        return redirect()->to($url);
    }
    public function render()
    {
        return view('livewire.addinvoicewr');
    }
}
