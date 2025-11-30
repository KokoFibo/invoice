<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Quotation;
use App\Mail\quotationMail;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Mail;


class QuotationEmailController extends Controller
{
    public function index($number)
    {
        $quotations = Quotation::where('number', $number)->get();
        $quotation = Quotation::where('number', $number)->first();
        $customer = Customer::find($quotation->customer_id);
        $is_email_sent = false;
        if ($quotation->status == "Emailed") $is_email_sent = true;

        return view('pdf.quotationpdf', [
            'quotations' => $quotations,
            'quotation' => $quotation,
            'customer' => $customer,
            'is_email_sent' => $is_email_sent,
        ]);
    }

    public function pdf($number)
    {
        $quotations = Quotation::where('number', $number)->get();
        $quotation = Quotation::where('number', $number)->first();
        $customer = Customer::find($quotation->customer_id);
        // $saveLocation = 'public/storage/pdf/';
        $pdfFileName = 'Kokofibo_' . quoNumberFormat($number, $quotation->quotation_date) . '.pdf';

        $template =  view('pdf.newquotationpdftemplate', compact('quotations', 'quotation', 'customer'))->render();
        // $footerHtml = view('pdf.footer')->render();

        $pdf = Browsershot::html($template)
            ->showBackground()
            ->noSandbox()
            // ->showBrowserHeaderAndFooter()
            // ->footerHtml($footerHtml)
            ->format('A4')
            ->pdf(); // hasil binary

        // Kirim langsung ke browser untuk di-download
        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $pdfFileName . '"');

        return back()->with('message', 'PDF Generated');
    }


    public function quotationEmail($number)
    {
        // Mail::to('kokonaci@gmail.com')->send(new InvoiceMail($number));
        try {
            Mail::send(new quotationMail($number));
            $data = Quotation::where('number', $number)->get();
            foreach ($data as $d) {

                $d->emailed_at = Carbon::parse(Carbon::now())->format('Y-m-d H:i:s');
                $d->status = 'Emailed';
                $d->save();
            }
            return redirect(route('quotation'))->with('success', 'Email sent');
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect(route('quotation'))->with('error', 'Fail Sending Email');
        }
    }
}
