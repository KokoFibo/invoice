<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Contract;
use App\Models\Customer;
use App\Mail\InvoiceMail;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class InvoiceEmailController extends Controller
{
    public function index($number)
    {
        $is_emailed = false;
        $invoices = Invoice::where('number', $number)->get();
        $invoice = Invoice::where('number', $number)->first();
        $customer = Customer::find($invoice->customer_id);
        $contract = Contract::where('contract_number', $invoice->contract)->first();
        if ($contract != '') {
            $contract_number = contractNumberFormat($contract->contract_number, $contract->contract_date);
        } else {
            $contract_number = '-';
        }

        if ($invoice->status == "Emailed")  $is_emailed = true;

        return view('pdf.invoicepdf', [
            'invoices' => $invoices,
            'invoice' => $invoice,
            'customer' => $customer,
            'contract_number' => $contract_number,
            'is_emailed' => $is_emailed,
        ]);
    }



    public function pdf($number, $signature)
    {
        $invoices = Invoice::where('number', $number)->get();
        $invoice = Invoice::where('number', $number)->first();
        $customer = Customer::find($invoice->customer_id);
        $contract = Contract::where('contract_number', $invoice->contract)->first();
        if ($contract != '') {
            $contract_number = contractNumberFormat($contract->contract_number, $contract->contract_date);
        } else {
            $contract_number = '-';
        }
        // $saveLocation = 'public/storage/pdf/';
        $pdfFileName = 'Kokofibo_Invoice_' . invNumberFormat($number, $invoice->invoice_date) . '.pdf';
        $template =  view(
            'pdf.newinvoicepdftemplate',
            [
                'invoices' => $invoices,
                'invoice' => $invoice,
                'customer' => $customer
                // 'contract_number' => $contract_number
            ]
        )->render();

        if ($signature == "signature") {
            $template =  view(
                'pdf.newinvoicepdftemplate',
                [
                    'invoices' => $invoices,
                    'invoice' => $invoice,
                    'customer' => $customer
                    // 'contract_number' => $contract_number
                ]
            )->render();
        } else {
            $template =  view(
                'pdf.newinvoicepdftemplateNoSignature',
                [
                    'invoices' => $invoices,
                    'invoice' => $invoice,
                    'customer' => $customer
                    // 'contract_number' => $contract_number
                ]
            )->render();
        }

        $pdf = Browsershot::html($template)
            ->setOption('args', ['--disable-web-security'])
            ->showBackground()
            ->noSandbox()
            // ->showBrowserHeaderAndFooter()
            // ->footerHtml($footerHtml)
            ->format('A4')
            ->pdf();


        // Kirim langsung ke browser untuk di-download
        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $pdfFileName . '"');

        // return back()->with('message', 'PDF Generated');
    }

    public function invoiceEmail($number)
    {
        // Mail::to('kokonaci@gmail.com')->send(new InvoiceMail($number));



        try {
            Mail::send(new InvoiceMail($number));
            $data = Invoice::where('number', $number)->get();
            foreach ($data as $d) {

                $d->emailed_at = Carbon::parse(Carbon::now())->format('Y-m-d H:i:s');
                $d->status = 'Emailed';
                $d->save();
            }
            return redirect(route('invoice'))->with('success', 'Email sent');
        } catch (\Exception $e) {
            // dd('ada kesalahan email');
            //  return $e->getMessage();
            return redirect(route('invoice'))->with('error', 'Fail Sending Email');
        }
    }
}
