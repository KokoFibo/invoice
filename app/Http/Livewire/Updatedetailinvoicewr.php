<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Package;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Updatedetailinvoicewr extends Component
{
    public $package, $price, $qty, $current_id, $packages, $number;



    public function mount ($current_id, $number) {
        $this->number = $number;
        $this->current_id = $current_id;
        $this->packages = Package::all();
        if($current_id) {
            $data = Invoice::find($current_id);
            $this->package = $data->package;
            $this->price = $data->price;
            $this->qty = $data->qty;
            // dd($this->package,$this->price,$this->qty);
        }
    }

    public function updateLower () {
        $data = Invoice::find($this->current_id);
        $data->package = $this->package;
        $data->price = $this->price;
        $data->qty = $this->qty;
        $data->save();
        // $this->dispatchBrowserEvent('success', ['message' => 'Data Updated']);

        Session::flash('message', 'Data Updated mantafff');
        $url = 'updateinvoice/'.$this->number;
        return redirect()->to($url);

    }

    public function updatedPackage()
    {
        try {
            $data = Package::where('package', $this->package)->first();
            $this->price = $data->price;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function cancel () {

        $url = 'updateinvoice/'.$this->number;
        return redirect()->to($url);
    }
    public function render()
    {
        return view('livewire.updatedetailinvoicewr');
    }
}
