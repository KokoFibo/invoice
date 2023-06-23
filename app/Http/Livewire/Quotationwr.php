<?php

namespace App\Http\Livewire;

use App\Models\Quotation;
use Carbon\Carbon;
use App\Models\Package;
use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Quotationwr extends Component
{
    use WithPagination;
    public $customer, $package, $packageData,  $price, $description, $customer_id, $status;
    public $perpage = 5, $search = '';
    public $detailQuotation;
    public $detailQuotations;
    public $detailCustomer;
    public $dcompany, $dquotation_date, $dpackage, $dprice, $ddescription, $demailed_at, $dstatus, $dquotation_number;
    protected $listeners =  ['delete'];

    public function viewdata ($number) {
        if($number != null) {
            $this->detailQuotations = Quotation::where('number', $number)->get();
            $this->detailQuotation = Quotation::where('number', $number)->first();
            $this->detailCustomer = Customer::find($this->detailQuotation->customer_id);
            $this->dcompany = $this->detailCustomer->company;
            $this->dquotation_date = $this->detailQuotation->quotation_date;
            $this->dpackage = $this->detailQuotation->package;
            $this->dprice = $this->detailQuotation->price;
            $this->ddescription = $this->detailQuotation->description;
            $this->demailed_at = $this->detailQuotation->emailed_at;
            $this->dstatus = $this->detailQuotation->status;
            $this->dquotation_number = invNumberFormat($number, $this->detailQuotation->quotation_date);
        }
    }

    public function mount () {
        $this->detailQuotations = collect();
        $this->detailCustomer =collect();
    }

    public function deleteConfirmation ($number) {
        $data = Quotation::where('number', $number )->first();
        $formattedNumber = quoNumberFormat($number, $data->quotation_date);
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
            $data = Quotation::where('number', $number)->get();
            foreach($data as $d) {
                $record = Quotation::find($d->id);
                $record->delete();
            }
        }
        $this->dispatchBrowserEvent('success', ['message' => 'Data Deleted']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }



    public function updatedPackage () {
        if($this->package) {
            $data = Package::where('package', $this->package)->first();
            $this->price = $data->price;
            $this->description = $data->description;
        }
    }

    public function render()
    {
        // $data = DB::table('quotations')->groupBy('number')->orderBy('number', 'desc')->paginate($this->perpage);
        $data = Quotation::groupBy('number')->orderBy('number', 'desc')->paginate($this->perpage);
        return view('livewire.quotationwr', compact(['data']));
    }
}
