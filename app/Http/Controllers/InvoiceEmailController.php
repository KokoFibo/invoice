<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Contract;
use App\Models\Customer;
use App\Mail\InvoiceMail;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class InvoiceEmailController extends Controller
{
    public function index($number)
    {
        [$invoices, $invoice, $customer, $contractNumber] = $this->loadInvoiceData($number);

        return view('pdf.invoicepdf', [
            'invoices'        => $invoices,
            'invoice'         => $invoice,
            'customer'        => $customer,
            'contract_number' => $contractNumber,
            'is_emailed'      => $invoice->status === 'Emailed',
        ]);
    }

    public function pdf($number, $signature)
    {
        [$invoices, $invoice, $customer] = $this->loadInvoiceData($number);

        $pdfFileName = 'Kokofibo_Invoice_' . invNumberFormat($number, $invoice->invoice_date) . '.pdf';

        $viewName = $signature === 'signature'
            ? 'pdf.newinvoicepdftemplate'
            : 'pdf.newinvoicepdftemplateNoSignature';

        $template = view($viewName, [
            'invoices' => $invoices,
            'invoice'  => $invoice,
            'customer' => $customer,
        ])->render();

        try {
            $pdf = $this->makeBrowsershot($template)->pdf();
        } catch (\Throwable $e) {
            Log::error('Gagal generate PDF invoice', [
                'number' => $number,
                'error'  => $e->getMessage(),
            ]);

            return redirect(route('invoice'))->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
        }

        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $pdfFileName . '"');
    }

    public function invoiceEmail($number)
    {
        try {
            Mail::send(new InvoiceMail($number));

            Invoice::where('number', $number)->update([
                'emailed_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'status'     => 'Emailed',
            ]);

            return redirect(route('invoice'))->with('success', 'Email sent');
        } catch (\Throwable $e) {
            Log::error('Gagal kirim email invoice', [
                'number' => $number,
                'error'  => $e->getMessage(),
            ]);

            return redirect(route('invoice'))->with('error', $e->getMessage());
        }
    }

    /**
     * Ambil data invoice, customer, dan nomor kontrak.
     *
     * @return array [$invoices, $invoice, $customer, $contractNumber]
     */
    private function loadInvoiceData($number): array
    {
        $invoices = Invoice::where('number', $number)->get();
        $invoice  = $invoices->first();

        abort_if(!$invoice, 404, 'Invoice tidak ditemukan');

        $customer = Customer::find($invoice->customer_id);
        $contract = Contract::where('contract_number', $invoice->contract)->first();

        $contractNumber = $contract
            ? contractNumberFormat($contract->contract_number, $contract->contract_date)
            : '-';

        return [$invoices, $invoice, $customer, $contractNumber];
    }

    /**
     * Konfigurasi Browsershot.
     * Catatan: addChromiumArguments() menambahkan "--" sendiri,
     * jadi tulis nama argumen TANPA tanda hubung.
     */
    private function makeBrowsershot(string $template): Browsershot
    {
        $browsershot = Browsershot::html($template)
            ->showBackground()
            ->emulateMedia('screen') // agar variabel CSS :root terbaca
            ->format('A4');

        // Khusus server produksi (VPS, dijalankan sebagai www-data)
        if (app()->environment('production')) {
            $browsershot
                ->addChromiumArguments([
                    'no-sandbox',
                    'disable-setuid-sandbox',
                    'disable-dev-shm-usage',
                ])
                // Paksa HOME ke /tmp agar tidak bentrok dengan permission /var/www/.local
                ->setEnvVars([
                    'HOME'                => '/tmp',
                    'PUPPETEER_CACHE_DIR' => base_path('.cache/puppeteer'),
                ]);
        }

        return $browsershot;
    }
}
