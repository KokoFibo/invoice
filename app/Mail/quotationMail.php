<?php

namespace App\Mail;

use App\Models\Customer;
use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Spatie\Browsershot\Browsershot;
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
        $subject = 'Quotation ' . $quotation_number . ' for ' . $customer->title . ' ' . $customer->company;

        return new Envelope(
            subject: $subject,
            // cc: 'tiffany.blueskycreation@gmail.com',
            // bcc: 'info.blueskycreation@gmail.com',
            from: new Address('hello@kokofibo.com', 'Kokofibo Marketing Department'),
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
            with: [
                'title' => $customer->salutation,
                'custName' => $customer->name,
                'quotation_number' => $quotation_number,
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
        // ✅ Generate HTML untuk isi PDF
        $template = view('pdf.newquotationpdftemplate', compact('quotations', 'quotation', 'customer'))->render();

        // ✅ Tambahkan footer HTML
        // $footerHtml = view('pdf.footer')->render();

        // ✅ Render ke PDF pakai Browsershot (binary)
        $pdf = Browsershot::html($template)
            ->showBackground()
            ->noSandbox()
            // ->showBrowserHeaderAndFooter()
            // ->footerHtml($footerHtml)
            ->format('A4')
            ->pdf(); // hasil binary

        // ✅ Return attachment langsung dari binary
        return [
            Attachment::fromData(fn() => $pdf, $pdfFileName)
                ->withMime('application/pdf'),
        ];
    }
}
