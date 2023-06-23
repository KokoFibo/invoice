<?php

namespace App\Http\Livewire;

use App\Models\Quotation;
use App\Models\Package;
use Livewire\Component;
use App\Models\Contract;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

class Updatequotationwr extends Component
{
    public $current_number, $quotation, $customer, $status;
    public $customer_id, $quotation_date, $number, $quotation_number, $quotation_id, $packages;
    public $updateUpper, $current_id;
    public $package, $price;
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
            $data = Quotation::find($id);
            $data->delete();
            $this->quotation = Quotation::where('number', $this->current_number)->get();

            $this->dispatchBrowserEvent('success', ['message' => 'Data Deleted']);
        }
    }

    public function mount ($current_number) {
        Session::put('task_url', request()->fullUrl());
        $this->updateUpper = false;
        $this->current_number = $current_number;
        $this->number = $current_number;
        $this->packages = Package::all();

        $this->quotation = Quotation::where('number', $this->current_number)->get();
        foreach($this->quotation as $i) {
            $this->customer_id = $i->customer_id;
            $this->quotation_date = $i->quotation_date;
            $this->status = $i->status;

        }
        // $this->quotation = Quotation::all();
        $this->customer = Customer::all();
        $this->quotation_number = invNumberFormat($this->number, $this->quotation_date);
    }

    public function updatedEditPackage () {
        $data = Package::where('package', $this->edit_package)->get();
        $this->edit_price = $data->price;
        $this->edit_description = $data->description;
    }
    public function editUpper () {
        $this->updateUpper = true;
    }

    public function updateUpper () {
        $data_id = Quotation::where('number', $this->current_number)->select('id')->get();
        if($data_id != null) {
            foreach($data_id as $d) {
                $data = Quotation::find($d->id);
                $data->customer_id = $this->customer_id;
                $data->quotation_date = $this->quotation_date;
                $data->status = $this->status;
                $data->save();
            }
            $this->dispatchBrowserEvent('success', ['message' => 'Data Updated']);
        }
        $this->updateUpper = false;
    }

    public function back () {
        return redirect()->to('/quotation');
    }

    public function cancel () {
        $this->updateUpper = false;
        $this->updateLower = false;

    }

    public function editLower ($id) {
        $this->quotation_id = $id;

    }

    public function updateLower ($id) {
        $this->current_id = $id;
        $this->updateLower = false;
    }

    public function render()
    {
        return view('livewire.updatequotationwr');
    }
}
