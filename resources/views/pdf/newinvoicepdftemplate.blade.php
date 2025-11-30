<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Invoice - Kokofibo Web Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen font-sans text-slate-800 bg-slate-50 p-6">
    {{-- <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-7 overflow-hidden"> --}}
    <div class="max-w-4xl mx-auto  p-7 overflow-hidden">
        <header class="flex flex-col sm:flex-row justify-between items-start gap-5 mb-6">
            <div class="flex items-center gap-4">
                <div>
                    <img class="w-24" src="https://invoice.kokofibo.com/images/logo-kokofibo.jpg" alt="">
                </div>
                <div>
                    <h1 class="text-lg font-semibold tracking-tight">Kokofibo Web Developer</h1>
                    <p class="text-sm text-slate-600">www.kokofibo.com</p>
                    <p class="text-sm text-slate-600">hello@kokofibo.com</p>
                </div>
            </div>

            <div class="text-right sm:min-w-[200px]">
                <div class="font-bold text-sm text-slate-900">Invoice</div>
                <div class="text-xs text-slate-600 mt-1">
                    Invoice No: {{ invNumberFormat($invoice->number, $invoice->invoice_date) }}<br />
                    Issue Date: {{ tanggal($invoice->invoice_date) }}<br />
                    Due Date: {{ tanggal($invoice->due_date) }}
                </div>
            </div>
        </header>

        <div class="flex flex-wrap gap-6 mb-5">
            <div class="flex-1 min-w-[220px] bg-slate-100 p-4 rounded-lg">
                <h3 class="text-xs font-semibold text-slate-900 mb-2">Bill To</h3>
                <p class="text-sm text-slate-700 leading-relaxed">
                    {{ $customer->title }} {{ $customer->company }}<br />
                    Attn: {{ $customer->salutation }} {{ $customer->name }}<br />
                    Email: {{ $customer->email }}
                </p>
            </div>

            <div class="flex-1 min-w-[220px] bg-slate-100 p-4 rounded-lg">
                <h3 class="text-xs font-semibold text-slate-900 mb-2">Payment Information</h3>
                <p class="text-sm text-slate-700 leading-relaxed">
                    Bank: Permata Bank<br />
                    Account Name: Phang Esti Anton<br />
                    Account No.: 4000685688
                </p>
            </div>
        </div>

        <table class="w-full border-collapse mt-3 text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-900 border-b border-slate-200">
                    <th class="w-[8%] text-left py-3 px-2">#</th>
                    <th class="text-left py-3 px-2">Description</th>
                    <th class="w-[80px] text-center py-3 px-2">Qty</th>
                    <th class="text-right py-3 px-2">Unit Price</th>
                    <th class="text-right py-3 px-2">Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                    $subtotal = 0;
                @endphp
                @foreach ($invoices as $key => $invoice)
                    @php
                        $tax = $invoice->tax;
                        $total = 0;
                    @endphp
                    <tr class="border-b border-dashed border-slate-200 text-slate-700">
                        <td class="py-3 px-2">{{ $key + 1 }}</td>
                        <td class="py-3 px-2">{{ $invoice->package }}</td>
                        <td class="text-center py-3 px-2">{{ $invoice->qty }}</td>
                        <td class="text-right py-3 px-2">{{ number_format($invoice->price) }}</td>
                        @php
                            $total = $invoice->qty * $invoice->price;
                            $subtotal += $total;
                        @endphp
                        <td class="text-right py-3 px-2">{{ number_format($total) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-end mt-4">
            <div class="w-80 bg-white p-4 rounded-lg border border-slate-200">
                <div class="flex justify-between text-sm text-slate-700 py-1">
                    <span>Sub-total</span><span>Rp {{ number_format($subtotal) }}</span>
                </div>
                <div class="flex justify-between text-sm text-slate-700 py-1">
                    <span>Tax {{ $tax }}%</span><span>Rp {{ number_format(($subtotal * $tax) / 100) }}</span>
                </div>
                <div
                    class="flex justify-between text-base font-bold text-slate-900 border-t border-slate-200 mt-2 pt-2">
                    <span>Total</span><span>Rp {{ number_format($subtotal + ($subtotal * $tax) / 100) }}</span>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-6 mt-5">
            <div class="flex-1 min-w-[220px] text-sm text-slate-600">
                <strong>Notes:</strong>
                <p class="mt-2 leading-relaxed">
                    1. Please make the payment before the due date stated above.<br />
                    2. Work or service continuation will proceed after payment confirmation.<br />
                </p>
                {{-- 3. Kindly send the proof of payment to hello@kokofibo.com for our records. --}}
            </div>

            <div class="w-60 text-center text-sm text-slate-600">
                <div><img class="w-[150px]" src="https://invoice.kokofibo.com/images/mich-signs.png" alt="">
                </div>
                <div class="h-3 mt-2 border-b border-dashed border-slate-300"></div>
                <div class="mt-2">Michelle</div>
                <div class="mt-2">Finance Department</div>
            </div>
        </div>

        <footer class="mt-6 text-center text-xs text-slate-500">
            Thank you for your business. For payment confirmation, please contact us at +62 877-2658-88
            36 •
            hello@kokofibo.com
        </footer>
    </div>
</body>
<style>
    .ql-editor ol {
        list-style-type: decimal !important;
    }

    .ql-editor ul {
        list-style-type: disc !important;
    }
</style>

</html>
