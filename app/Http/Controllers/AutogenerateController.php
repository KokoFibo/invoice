<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class AutogenerateController extends Controller
{


    public function send_emails()
    {


        try {
            $numbers = Invoice::orderBy('number', 'desc')
                ->limit(3)
                ->pluck('number');

            foreach ($numbers as $number) {
                // Ambil data invoice berdasarkan number
                $invoice = Invoice::where('number', $number)->first();

                if (!$invoice) {
                    continue; // lewati kalau tidak ditemukan
                }

                // Kirim email
                Mail::send(new InvoiceMail($invoice->number));

                // Update status & waktu email
                $invoice->update([
                    'emailed_at' => now(),
                    'status' => 'Emailed',
                ]);
            }
            return 'Sukses';
        } catch (\Exception $e) {
            // Kalau ada error, tampilkan pesan gagal
            return 'Fail sending emails: ' . $e->getMessage();
        }
    }

    public function create_emails()
    {
        // rename Package
        //  18 dan 20 YIG
        // 27 sti "STI Payroll (OS) Monthly Maintenance Services (Oktober 2025)"
        // 6 ysm "Yifang Payroll (OS) Monthly Maintenance Services (Oktober 2025)"

        $lastMonth = Carbon::now()->subMonth()->translatedFormat('F Y');

        // STI
        $data = Package::find(27);
        $data->package = "STI Payroll (OS) Monthly Maintenance Services (" . $lastMonth . ")";
        $sti_package = $data->package;
        $data->save();

        // YSM
        $data = Package::find(6);
        $data->package = "Yifang Payroll (OS) Monthly Maintenance Services (" . $lastMonth . ")";
        $ysm_package = $data->package;
        $data->save();

        $yig_package1 = "Yifang Salary (Non OS) and Website Monthly Maintenance Services";
        $yig_package2 = "Biaya VPS Nevacloud";

        // customer ID
        // YSM 2
        // YIG 1
        // STI 4

        // buat invoice YSM
        $maxNumber = Invoice::max('number');
        $invoice = Invoice::create([
            'number' => $maxNumber + 1,
            'invoice_date' => now(),
            'due_date' => now()->addDays(7),
            'customer_id' => 1,
            'contract' => '',
            'package' => $yig_package1,
            'price' => 3000000,
            'qty' => 1,
            'tax' => 0,
            'discount' => 0,
            'status' => 'Draft',
        ]);
        $maxNumber = Invoice::max('number');
        $invoice = Invoice::create([
            'number' => $maxNumber,
            'invoice_date' => now(),
            'due_date' => now()->addDays(7),
            'customer_id' => 1,
            'contract' => '',
            'package' => $yig_package2,
            'price' => 1050000,
            'qty' => 1,
            'tax' => 0,
            'discount' => 0,
            'status' => 'Draft',
        ]);

        // YSM
        $maxNumber = Invoice::max('number');
        $invoice = Invoice::create([
            'number' => $maxNumber + 1,
            'invoice_date' => now(),
            'due_date' => now()->addDays(7),
            'customer_id' => 2,
            'contract' => '',
            'package' => $ysm_package,
            'price' => 2000000,
            'qty' => 1,
            'tax' => 0,
            'discount' => 0,
            'status' => 'Draft',
        ]);
        // STI
        $maxNumber = Invoice::max('number');
        $invoice = Invoice::create([
            'number' => $maxNumber + 1,
            'invoice_date' => now(),
            'due_date' => now()->addDays(7),
            'customer_id' => 4,
            'contract' => '',
            'package' => $sti_package,
            'price' => 2000000,
            'qty' => 1,
            'tax' => 0,
            'discount' => 0,
            'status' => 'Draft',
        ]);
    }

    public function index()
    {
        $this->create_emails();
        $results = $this->send_emails();
        // session()->flash('success', 'All emails sent successfully');
        // return redirect()->route('invoice');
        if ($results = "Sukses")
            return redirect('/invoice')->with('success', 'All emails sent successfully');
        else
            return redirect('/invoice')->with('Error', $results);
    }
}
