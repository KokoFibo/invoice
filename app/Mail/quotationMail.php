<?php

namespace App\Mail;

use App\Models\Customer;
use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class quotationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $number;


    public function __construct($number)
    {
        $this->number = $number;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $quotation = Quotation::where('number', $this->number)->first();
        $customer = Customer::where('id', $quotation->customer_id)->first();
        $quotation_number = quoNumberFormat($this->number, $quotation->quotation_date);
        // $month = month($invoice->due_date);
        $month = getMonthName($quotation->due_date);
        $subject = 'Quotation '.$quotation_number. ' for '.$customer->company;
        return new Envelope(
            subject: $subject,
            // cc: 'tiffany.blueskycreation@gmail.com',
            // bcc: 'info.blueskycreation@gmail.com',
            from: new Address('hello@kokofibo.com', 'Kokofibo.com'),
            to: $customer->email,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $quotation = Quotation::where('number', $this->number)->first();
        $customer = Customer::where('id', $quotation->customer_id)->first();
        $quotation_number = quoNumberFormat($this->number, $quotation->quotation_date);
        return new Content(
            view: 'pdf.quotationEmailTemplate',
            with: ['title' => $customer->salutation,  'custName' => $customer->name, 'quotation_number' => $quotation_number,
            'company' => $customer->company,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $quotations = Quotation::where('number', $this->number)->get();
        $quotation = Quotation::where('number', $this->number)->first();
        $customer = Customer::find($quotation->customer_id);
        $pdfFileName = 'Kokofibo_' . quoNumberFormat($this->number, $quotation->quotation_date) . '.pdf';
        $footer = '<table style="width: 100%">
        <tr>
            <td style="width: 33%; text-align:left ;  ">
                <img src="https://invoice.kokofibo.com/images/web.png" width="30px" style="width: 15px;">
                www.kokofibo.com
            </td>
            <td style="width: 33%; text-align:center"><img src="https://invoice.kokofibo.com/images/whatsapp.png"
                    width="30px" style="width: 15px;"> 0877 2658 8836</td>
            <td style="width: 33%; text-align:right"><img src="https://invoice.kokofibo.com/images/email.png"
                    width="30px" style="width: 15px;"> hello@kokofibo.com</td>
        </tr>
    </table>';
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetFooter($footer);

        ob_get_clean();

        $html = view('pdf.quotationpdftemplate', compact(['quotations', 'quotation', 'customer']));
        $mpdf->WriteHTML($html);
        $pdf = $mpdf->Output('', 'S');
        return [
            Attachment::fromData(fn () => $pdf, $pdfFileName)
            ->withMime('application/pdf'),
        ];
    }
}
