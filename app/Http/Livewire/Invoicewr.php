<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use Carbon\Carbon;
use App\Models\Package;
use Livewire\Component;
use App\Models\Contract;
use App\Models\Customer;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Invoicewr extends Component
{
    use WithPagination;

    public $perpage = 5, $search = '';
    public $detailInvoice;
    public $detailInvoices;
    public $detailCustomer;
    public $invoice_number, $company, $contract, $discount, $tax, $invoice_date, $due_date, $emailed_at, $status;
    protected $listeners =  ['delete'];

    public function viewdata ($number) {
        if($number != null) {
            $this->detailInvoices = Invoice::where('number', $number)->get();
            $this->detailInvoice = Invoice::where('number', $number)->first();
            $this->detailCustomer = Customer::find($this->detailInvoice->customer_id);
            $this->company = $this->detailCustomer->company;
            $this->contract = $this->detailInvoice->contract;
            $this->discount = $this->detailInvoice->discount;
            $this->tax = $this->detailInvoice->tax;
            $this->invoice_date = $this->detailInvoice->invoice_date;
            $this->due_date = $this->detailInvoice->due_date;
            $this->emailed_at = $this->detailInvoice->emailed_at;
            $this->status = $this->detailInvoice->status;
            $this->invoice_number = invNumberFormat($number, $this->invoice_date);
        }
    }

    public function mount () {
        $this->detailInvoices = collect();
        $this->detailCustomer =collect();
    }

    public function deleteConfirmation ($number) {
        $data = Invoice::where('number', $number )->first();
        $formattedNumber = invNumberFormat($number, $data->invoice_date);
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
            $data = Invoice::where('number', $number)->get();
            foreach($data as $d) {
                $record = Invoice::find($d->id);
                $record->delete();
            }
        }
        $this->dispatchBrowserEvent('success', ['message' => 'Data Deleted']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }



    public function render()
    {
        // $data = Invoice::orderby('id', 'desc')->distinct('number')->paginate($this->perpage);
        // $data = DB::table('invoices')->distinct('number')->count('price')->paginate($this->perpage);

        $data = Invoice::groupBy('number')->orderBy('number', 'desc')->paginate($this->perpage);
        return view('livewire.invoicewr', compact(['data']));
    }
}
