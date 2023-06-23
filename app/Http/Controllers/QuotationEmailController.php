<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Quotation;
use App\Mail\quotationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuotationEmailController extends Controller
{
    public function index($number)
    {

        $quotations = Quotation::where('number', $number)->get();
        $quotation = Quotation::where('number', $number)->first();
        $customer = Customer::find($quotation->customer_id);

        return view('pdf.quotationpdf', compact(['quotations', 'quotation', 'customer']));
    }

    public function pdf($number)
    {
        $quotations = Quotation::where('number', $number)->get();
        $quotation = Quotation::where('number', $number)->first();
        $customer = Customer::find($quotation->customer_id);
        // $saveLocation = 'public/storage/pdf/';
        $pdfFileName = 'BlueSkyCreation_' . quoNumberFormat($number, $quotation->quotation_date) . '.pdf';
        $footer = '<table style="width: 100%">
        <tr>
            <td style="width: 33%; text-align:left ;  ">
                <img src="https://sky.blueskycreation.id/web.png" width="30px" style="width: 15px;">
                www.blueskycreation.id
            </td>
            <td style="width: 33%; text-align:center"><img src="https://sky.blueskycreation.id/whatsapp.png"
                    width="30px" style="width: 15px;"> 087 780 620 632</td>
            <td style="width: 33%; text-align:right"><img src="https://sky.blueskycreation.id/email.png"
                    width="30px" style="width: 15px;"> hello@blueskycreation.id</td>
        </tr>
    </table>';
        // $mpdf = new \Mpdf\Mpdf();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetFooter($footer);
        ob_get_clean();
        $data['email'] = 'testaja@testaja.com';
        $data['subject'] = 'ini adalah title atau judulnya';
        $data['body'] = 'ini adalah body atau isi dari emailnya';

        $html = view('pdf.quotationpdftemplate', compact(['quotations', 'quotation', 'customer']));
        $mpdf->WriteHTML($html);

        $mpdf->Output($pdfFileName,\Mpdf\Output\Destination::DOWNLOAD);
        // $request->session()->flash('message', 'PDF Generated');
        // return back();
        return back()->with('message' , 'PDF Generated');
    }


    public function quotationEmail ($number) {
        // Mail::to('kokonaci@gmail.com')->send(new InvoiceMail($number));
        try {
            Mail::send(new quotationMail($number));
            $data = Quotation::where('number', $number)->get();
            foreach($data as $d){

                 $d->emailed_at = Carbon::parse(Carbon::now())->format('Y-m-d H:i:s');
                $d->status = 'Emailed';
                $d->save();
            }
            return redirect( route('quotation'))->with('success', 'Email sent');

        } catch (\Exception $e) {
             return $e->getMessage();
            return redirect( route('quotation'))->with('error', 'Fail Sending Email');

        }
    }
}
