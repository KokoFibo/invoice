<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Contract;
use App\Models\Customer;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

class PdfController extends Controller
{
    public function index($number)
    {
        $quotations = Quotation::where('number', $number)->get();
        $quotation = Quotation::where('number', $number)->first();
        $customer = Customer::find($quotation->customer_id);
        // $saveLocation = 'public/storage/pdf/';
        $pdfFileName = 'Kokofibo_' . quoNumberFormat($number, $quotation->quotation_date) . '.pdf';

        $template =  view(
            'pdf.newquotationpdftemplate',
            [
                'quotations' => $quotations,
                'quotation' => $quotation,
                'customer' => $customer
                // 'contract_number' => $contract_number
            ]
        )->render();
        // $footerHtml = view('pdf.footer')->render();

        $pdf = Browsershot::html($template)
            ->showBackground()
            ->noSandbox()
            // ->showBrowserHeaderAndFooter()
            // ->footerHtml($footerHtml)
            // ->format('A4')
            ->pdf(); // hasil binary

        // Kirim langsung ke browser untuk di-download
        // return response($pdf)
        //     ->header('Content-Type', 'application/pdf')
        //     ->header('Content-Disposition', 'attachment; filename="' . $pdfFileName . '"');

        return view('pdf.newquotationpdftemplate', [
            'quotations' => $quotations,
            'quotation' => $quotation,
            'customer' => $customer
            // 'contract_number' => $contract_number
        ]);
        //     return view('pdf.newinvoicepdftemplate', [
        //         'invoices' => $invoices,
        //         'invoice' => $invoice,
        //         'customer' => $customer
        //         // 'contract_number' => $contract_number
        //     ]);
    }
}
