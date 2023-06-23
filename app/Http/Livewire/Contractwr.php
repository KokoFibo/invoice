<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contract;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;

class Contractwr extends Component
{
    public $perpage = 5, $search = '';
    public $detailContracts, $detailContract, $detailCustomer, $dcompany;
    public $dcontract_number, $dpackage, $dprice, $ddescription, $dcontract_date, $dcontract_begin, $dcontract_end, $dstatus, $dPDF;
    public $dsent, $dsigned, $dcancel, $ddone;
    protected $listeners =  ['delete'];

    public function viewdata ($number) {
        if($number != null) {
            $this->detailContracts = Contract::where('contract_number', $number)->get();
            $this->detailContract = Contract::where('contract_number', $number)->first();
            $this->detailCustomer = Customer::find($this->detailContract->customer_id);
            $this->dcompany = $this->detailCustomer->company;

            $this->dcontract_number = invNumberFormat($number, $this->detailContract->contract_date);
            $this->dpackage = $this->detailContract->package;
            $this->dprice = $this->detailContract->price;
            $this->ddescription = $this->detailContract->description;
            $this->dcontract_date = $this->detailContract->contract_date;
            $this->dcontract_begin = $this->detailContract->contract_begin;
            $this->dcontract_end = $this->detailContract->contract_end;
            $this->dstatus = $this->detailContract->status;
            $this->dsent = $this->detailContract->sent;
            $this->dsigned = $this->detailContract->signed;
            $this->ddone = $this->detailContract->done;
            $this->dcancel = $this->detailContract->cancel;
            $this->dPDF = $this->detailContract->pdf;


        }
    }

    public function mount () {
        $this->detailContracts = collect();
        $this->detailCustomer =collect();
    }

    public function downloadpdf ($contract_number) {
        $data = Contract::where('contract_number', $contract_number)->first();

        return Storage::download($data->pdf);
    }


    public function deleteConfirmation ($number) {
        $data = Contract::where('contract_number', $number )->first();
        $formattedNumber = contractNumberFormat($number, $data->contract_date);
        $company = getCompany($data->customer_id);
        $this->dispatchBrowserEvent('delete_confirmation', [
            'title' => 'Are you sure',
            'text' => "to delete " . $formattedNumber. " of ". $company. " data?",
            'icon' => 'warning',
            'id' => $number,
        ]);
    }

    public function delete ($id) {
        $number = $id;

        if($id != null) {
            $data = Contract::where('contract_number', $number)->get();
            foreach($data as $d) {
                $record = Contract::find($d->id);
                $record->delete();
            }
        }
        $this->dispatchBrowserEvent('success', ['message' => 'Data Deleted']);
    }

    public function render()
    {
        $data = Contract::groupBy('contract_number')->orderBy('contract_number', 'desc')->paginate($this->perpage);
        return view('livewire.contractwr', compact(['data']));
    }
}
