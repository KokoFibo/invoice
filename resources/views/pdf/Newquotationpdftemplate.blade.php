<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title>Quotation - Simple Example</title>
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Quill Editor -->
        {{-- <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.core.css" rel="stylesheet"> --}}
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
        {{-- <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.core.js"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script> --}}
    </head>

<body class="min-h-screen font-sans text-slate-800 bg-slate-50 p-6">
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
                <div class="font-bold text-sm text-slate-900">Quotation</div>
                <div class="text-xs text-slate-600 mt-1">
                    No: {{ invNumberFormat($quotation->number, $quotation->quotation_date) }}<br />
                    Date: {{ tanggal($quotation->quotation_date) }}<br />

                </div>
            </div>
        </header>

        <div class="flex flex-wrap gap-6 mb-5">
            <div class="flex-1 min-w-[220px] bg-slate-100 p-4 rounded-lg">
                <h3 class="text-xs font-semibold text-slate-900 mb-2">To</h3>
                <p class="text-sm text-slate-700 leading-relaxed">
                    Client: {{ $customer->title }} {{ $customer->company }}<br />
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
                    {{-- <th class="text-right py-3 px-2">Total</th> --}}
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                @endphp
                @foreach ($quotations as $key => $quotation)
                    @php
                        $tax = $quotation->tax;
                    @endphp
                    <tr class="border-b border-dashed border-slate-200 text-slate-700">
                        <td class="py-3 px-2">{{ $key + 1 }}</td>
                        <td class="py-3 px-2">
                            <p>{{ $quotation->package }}</p>
                            <div class="ql-editor">{!! $quotation->description !!}</div>
                        </td>
                        <td class="text-center py-3 px-2">{{ number_format($quotation->qty) }} Package</td>
                        <td class="text-right py-3 px-2">{{ number_format($quotation->price) }}</td>
                        @php
                            $subtotal += $quotation->price * $quotation->qty;
                        @endphp
                        {{-- <td class="text-right py-3 px-2">{{ number_format($quotation->price) }}</td> --}}
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="flex justify-end mt-4">
            <div class="w-80 bg-white p-4 rounded-lg border border-slate-200">
                <div class="flex justify-between text-sm text-slate-700 py-1">
                    <span>Sub-total</span><span>Rp {{ $subtotal }}</span>
                </div>
                <div class="flex justify-between text-sm text-slate-700 py-1">
                    <span>Tax {{ $quotation->tax }} %</span><span>Rp
                        {{ number_format(($subtotal * $tax) / 100) }}</span>
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
                    1. The price does not include additional costs outside the scope.<br />
                    2. Work will begin after a 50% down payment is received.<br />
                    3. Estimated completion time is 2-3 weeks after confirmation.
                </p>
            </div>

            <div class="w-60 text-center text-sm text-slate-600">
                <div>Approved by,</div>
                <div><img class="w-[150px] my-4" src="https://invoice.kokofibo.com/images/mich-signs.png"
                        alt="">
                </div>
                <div class="border-b border-dashed border-slate-300"></div>
                <div class="mt-2">Michelle</div>
                <div class="mt-2">Billing Department</div>
            </div>
        </div>

        <footer class="mt-6 text-center text-xs text-slate-500">
            This quotation is an offer. For order confirmation, please contact us: +62 812-3456-7890 • email@contoh.id
        </footer>
    </div>

    <style>
        /* Styling untuk list di Quill agar muncul di Tailwind   */

        .ql-editor ol {
            list-style-type: decimal !important;
            margin-left: -3rem !important;
        }

        .ql-editor ul {
            list-style-type: disc !important;
            margin-left: -3rem !important;
        }
    </style>
</body>

</html>
