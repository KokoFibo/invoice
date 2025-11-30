<?php

namespace App\Mail;

use App\Models\Invoice;
use App\Models\Contract;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Spatie\Browsershot\Browsershot;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $number;

    public function __construct($number)
    {
        $this->number = $number;
        // ini kah
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $invoice = Invoice::where('number', $this->number)->first();
        $customer = Customer::where('id', $invoice->customer_id)->first();
        $invoice_number = invNumberFormat($this->number, $invoice->invoice_date);
        // $month = month($invoice->due_date);
        $month = getMonthName($invoice->due_date);
        $subject = 'Invoice ' . $invoice_number . ' for ' . $customer->title . ' ' . $customer->company;

        return new Envelope(
            subject: $subject,
            // bcc: 'info.blueskycreation@gmail.com',
            from: new Address('billing@kokofibo.com', 'Kokofibo Billing Department'),
            to: $customer->email,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $invoice = Invoice::where('number', $this->number)->first();
        $customer = Customer::where('id', $invoice->customer_id)->first();
        $invoice_number = invNumberFormat($this->number, $invoice->invoice_date);
        // $subtotals = Invoice::where('number', $this->number)->get();
        // foreach($subtotals as $subtotal) {
        //     $jumlah = $jumlah + $subtotal->price * $subtotal->qty;
        //     $diskon = $subtotal->discount;
        //     $pajak = $subtotal->tax;
        // }
        // $total = $jumlah - $diskon - (($jumlah - $diskon)*$pajak/100);


        $total = getTotal($this->number);




        return new Content(
            // view: 'pdf.invoiceEmailTemplate',
            view: 'pdf.invoiceEmailTemplate',
            with: [
                'title' => $customer->salutation,
                'custName' => $customer->name,
                'invoice_number' => $invoice_number,
                'company' => $customer->company,
                'due_date' => tanggal($invoice->due_date),
                'invoice_date' => tanggal($invoice->invoice_date),
                'total' => $total
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
        // $pdfFileName = 'BlueSkyCreation_' . invNumberFormat($number, $invoice->invoice_date) . '.pdf';
        $invoices = Invoice::where('number', $this->number)->get();
        $invoice = Invoice::where('number', $this->number)->first();
        $customer = Customer::find($invoice->customer_id);

        $pdfFileName = 'Kokofibo_Invoice_' . invNumberFormat($this->number, $invoice->invoice_date) . '.pdf';

        $template =  view(
            'pdf.newinvoicepdftemplate',
            [
                'invoices' => $invoices,
                'invoice' => $invoice,
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



        return [
            Attachment::fromData(fn() => $pdf, $pdfFileName)
                ->withMime('application/pdf'),
        ];
    }
}
