<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Quotation;
use App\Models\Package;
use Illuminate\Support\Facades\Session;

class Updatedetailquotationwr extends Component
{
    public $package, $price, $description, $current_id, $packages, $number;

    public function mount($current_id, $number)
    {
        $this->number = $number;
        $this->current_id = $current_id;
        $this->packages = Package::all();
        if ($current_id) {
            $data = Quotation::find($current_id);
            $this->package = $data->package;
            $this->price = $data->price;
            $this->description = $data->description;
        }
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

    public function updateLower()
    {
        $data = Quotation::find($this->current_id);
        $data->package = $this->package;
        $data->price = $this->price;
        $data->description = $this->description;
        $data->save();

        Session::flash('message', 'Data Updated mantafff');
        $url = 'updatequotation/' . $this->number;
        return redirect()->to($url);
    }

    public function cancel()
    {
        $url = 'updatequotation/' . $this->number;
        return redirect()->to($url);
    }

    public function render()
    {
        return view('livewire.updatedetailquotationwr');
    }
}
