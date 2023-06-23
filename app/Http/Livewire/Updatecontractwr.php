<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Package;
use Livewire\Component;
use App\Models\Contract;
use App\Models\Customer;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class Updatecontractwr extends Component
{
    use WithFileUploads;

    public $contract_number, $customer_id, $contract_begin, $contract_end, $package, $price, $qty=1, $description, $status, $contract_date;
    public $contracts = [];
    public $lolos, $updateUpper;
    public $edit_price, $edit_description, $current_number, $number, $contract_number_full;
    public $current_id, $contract_id,  $signed, $done, $cancel, $prevStatus;
    public $pdf, $prevPdf;


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
            $data = Contract::find($id);
            $data->delete();
            $this->contract = Contract::where('contract_number', $this->current_number)->get();

            $this->dispatchBrowserEvent('success', ['message' => 'Data Deleted']);
        }
    }

    public function mount ($current_number) {
        Session::put('task_url', request()->fullUrl());
        $this->updateUpper = false;
        $this->current_number = $current_number;
        $this->contract_number = $current_number;
        $this->packages = Package::all();

        $this->contract = Contract::where('contract_number', $this->current_number)->get();
        foreach($this->contract as $i) {
            $this->customer_id = $i->customer_id;
            $this->contract_begin = $i->contract_begin;
            $this->contract_end = $i->contract_end;
            $this->contract_number = $i->contract_number;
            $this->contract_date = $i->contract_date;

            $this->status = $i->status;
            $this->prevStatus = $i->status ;



            $this->prevPdf = $i->pdf;

        }
        $this->customer = Customer::all();
        $this->contract_number_full = contractNumberFormat($current_number, $this->contract_date);
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
        $data_id = Contract::where('contract_number', $this->current_number)->select('id')->get();
        if($data_id != null) {
            $this->validate([
                'pdf' => 'file|max:1024|nullable', // 1MB Max
            ]);
            if($this->pdf != null) {
                Storage::delete($this->prevPdf);
                $filename = $this->pdf->storeAs('pdfs',$this->pdf->getClientOriginalName());

            }
            else {
                $filename='';
            }
            foreach($data_id as $d) {
                $data = Contract::find($d->id);
                $data->customer_id = $this->customer_id;
                $data->contract_begin = $this->contract_begin;
                $data->contract_end = $this->contract_end;
                if($this->status != '') {
                    $data->status = $this->status;
                    switch($this->status) {
                        case 'Signed': {
                            $data->signed = Carbon::now()->format('Y-m-d'); break;
                        }
                        case 'Done': {
                            $data->done = Carbon::now()->format('Y-m-d'); break;
                        }
                        case 'Cancel': {
                            $data->cancel = Carbon::now()->format('Y-m-d'); break;
                        }
                    }
                }

                if($filename != null ) {
                    $data->pdf = $filename;
                }
                $data->save();
            }
            $this->dispatchBrowserEvent('success', ['message' => 'Data Updated']);
        }
        $this->updateUpper = false;
    }

    public function back () {
        return redirect()->to('/contract');
    }

    public function cancel () {
        $this->updateUpper = false;
        $this->updateLower = false;

    }

    public function editLower ($id) {
        $this->contract_id = $id;

    }
    public function updateLower ($id) {

        $this->current_id = $id;

        $this->updateLower = false;
    }

    public function render()
    {
        return view('livewire.updatecontractwr');
    }
}
