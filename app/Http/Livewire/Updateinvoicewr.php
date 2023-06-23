<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Package;
use Livewire\Component;
use App\Models\Contract;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

class Updateinvoicewr extends Component
{
    public $current_number, $invoice, $customer, $dataContract, $contract, $discount, $tax = 0.0, $status;
    public $customer_id, $invoice_date, $due_date, $number, $invoice_number, $invoice_id, $packages;
    public $updateUpper, $current_id, $company;
    public $package, $price, $qty, $formattedTax = 0.0;
    protected $listeners =  ['delete'];


    public function deleteConfirmation ($id) {
        $this->dispatchBrowserEvent('delete_confirmation', [
            'title' => 'Are you sure',
            'text' => "to delete this data?",
            'icon' => 'warning',
            'id' => $id,
        ]);
    }

    public function delete ($id) {
        if($id != null) {
            $data = Invoice::find($id);
            $data->delete();
            $this->invoice = Invoice::where('number', $this->current_number)->get();

            $this->dispatchBrowserEvent('success', ['message' => 'Data Deleted']);
        }
    }

    public function mount ($current_number) {
        Session::put('task_url', request()->fullUrl());
        $this->updateUpper = false;
        $this->current_number = $current_number;
        $this->number = $current_number;
        $this->packages = Package::all();

        $this->invoice = Invoice::where('number', $this->current_number)->get();
        foreach($this->invoice as $i) {
            $this->customer_id = $i->customer_id;
            $this->invoice_date = $i->invoice_date;
            $this->due_date = $i->due_date;
            $this->contract = $i->contract;
            $this->discount = $i->discount;
            $this->tax = $i->tax;
            $this->status = $i->status;

        }
        $this->customer = Customer::all();
        $data_company = Customer::find($this->customer_id);
        $this->company = $data_company->company;
        $this->dataContract = Contract::where('customer_id', $this->customer_id)->get();
        foreach($this->dataContract as $d) {
            $this->contract_date = $d->contract_date;
        }

        $this->invoice_number = invNumberFormat($this->number, $this->invoice_date);


    }

    public function updatedTax () {
        // cara ini supaya tidak error saat edit
        try {
            $this->formattedTax = number_format((float)$this->tax);
        } catch (\Exception $e) {
             return $e->getMessage();
}
    }

    public function updatedEditPackage () {
        $data = Package::where('package', $this->edit_package)->get();
        $this->edit_price = $data->price;
    }
    public function editUpper () {
        $this->updateUpper = true;
    }

    public function updatedDiscount () {
        if($this->discount == null) {
            $this->discount = 0;
        }
    }

    public function updateUpper () {
        $data_id = Invoice::where('number', $this->current_number)->select('id')->get();
        if($data_id != null) {
            foreach($data_id as $d) {
                $data = Invoice::find($d->id);
                $data->customer_id = $this->customer_id;
                $data->contract = $this->contract;
                $data->invoice_date = $this->invoice_date;
                $data->due_date = $this->due_date;
                if($this->discount == null) {
                    $this->discount = 0;
                }
                $data->discount = $this->discount;
                $data->tax = $this->tax;
                $data->status = $this->status;
                $data->save();
            }
            $this->dispatchBrowserEvent('success', ['message' => 'Data Updated']);
        }


        $this->updateUpper = false;
    }

    public function back () {
        return redirect()->to('/invoice');
    }

    public function cancel () {
        $this->updateUpper = false;
        $this->updateLower = false;

    }

    public function editLower ($id) {
        $this->invoice_id = $id;

    }

    public function updateLower ($id) {

        $this->current_id = $id;
        // if($this->invoice_id != null) {
        //     $data = Invoice::find($this->invoice_id);
        //     $data->package = $this->package;
        //     $data->price = $this->price;
        //     $data->qty = $this->qty;
        //     $data->save();
        // }
        $this->updateLower = false;
    }

    public function render()
    {
            return view('livewire.updateinvoicewr');
    }
}
