<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{ asset('style/invoice.css') }}"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" /> --}}
    <title>Invoice PDF</title>
</head>

<body>
    <div class="container">


        <div class="first-row">
            <div class="inv_no">
                <span style="font-weight: 700">Invoice No.</span>
                {{ invNumberFormat($invoice->number, $invoice->invoice_date) }}
            </div>

            <div class="logo">
                {{-- <img src="{{ asset('images/Blue Sky Creations.png') }}" style="width:250px" alt=""> --}}
            </div>
        </div>
        <div class=invoice>
            <p>INVOICE</p>
        </div>

        <div class="main">
            <div class="left">
                <div>
                    <p class="bold">Name</p>
                    <p class="bold">Company</p>
                    <p class="bold">Address</p>
                    <p class="bold">Contract No.</p>
                </div>
                <div style="margin-left: 20px;">
                    <p>{{ $customer->salutation }} {{ $customer->name }}</p>
                    <p>{{ $customer->title }} {{ $customer->company }}</p>
                    <p>{{ $customer->address }}</p>
                    <p>{{ $invoice->contract }}</p>
                </div>
            </div>
            <div class="right">
                <div class="left">
                    <div>
                        <p class="bold">Invoice Date</p>
                        <p class="bold">Due Date</p>
                        <p class="bold">Payment to</p>
                    </div>
                    <div style="margin-left: 20px;">
                        <p>{{ $invoice->invoice_date }}</p>
                        <p>{{ $invoice->due_date }}</p>
                        {{-- <p>{{ tanggal($invoice->invoice_date) }}</p>
                        <p>{{ tanggal($invoice->due_date) }}</p> --}}
                        <p>Tiffany Mareta<br>BCA (Bank Central Asia)<br>6600 356 117</p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <table class="table1">
                <thead>
                    <tr>
                        <th style="width: 60%;">Item Description</th>
                        <th style="width: 20%;">Qty</th>
                        <th style="width: 20%;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subtotal = 0;
                    @endphp
                    @foreach ($invoices as $i)
                        <tr>
                            <td class="garis">{{ $i->package }}</td>
                            <td class="garis package">{{ $i->qty }} {{ $i->qty > 1 ? 'Packages' : 'Package' }}
                            </td>
                            <td class="garis rupiah">IDR {{ number_format($i->qty * $i->price) }}</td>
                            @php
                                $subtotal = $subtotal + $i->qty * $i->price;
                            @endphp
                        </tr>
                    @endforeach
                    <tr style="height:100px">
                        <td class="garis"> </td>
                        <td class="garis"> </td>
                        <td class="garis"> </td>

                    </tr>
                    @if ($invoice->discount != null)
                        <tr style=" border: 1px solid #999">
                            <td>Discount</td>
                            <td></td>
                            <td class="discount" style=" border-left: 1px solid #999">IDR
                                {{ number_format($invoice->discount) }}</td>
                        </tr>
                    @endif
                    @if ($invoice->tax != null)
                        <tr style=" border: 1px solid #999">
                            <td>Tax</td>
                            <td></td>
                            <td class="tax" style=" border-left: 1px solid #999">{{ $invoice->tax }} %</td>
                        </tr>
                    @endif

                    <tr style=" border: 1px solid #999">
                        <td>Grand Total</td>
                        <td></td>
                        <td class="total" style=" border-left: 1px solid #999">IDR
                            {{ number_format(roundedTotal($subtotal, $invoice->discount, $invoice->tax)) }}</td>
            </table>
        </div>

        <div class="main">
            <div class="left">
                <div>
                    <div class="term">Terms & Conditions</div>
                    <div>
                        <p> Kindly make the transfer before the due date<br>
                            to continue the ongoing project. Proof of<br>
                            payment could be sent via Whatsapp or email</p>
                    </div>
                    <div class="thankyou">Thank you for your support!</div>
                </div>
            </div>
            <div class="flex right">
                <div><img src="{{ asset('images/tiff-signs.png') }}" alt=""></div>
                <div class="tiffany">Tiffany M</div>
                <div>Blue Sky Creation</div>
            </div>
        </div>
        <div>
            <hr>
        </div>
        <div class="footer">
            <div><i class="fa-solid fa-globe fa-lg"></i></i> www.blueskycreation.id</div>
            <div><i class="fa-brands fa-whatsapp fa-lg"></i> 087 780 620 632</div>
            <div><i class="fa-regular fa-envelope fa-lg"></i> hello@blueskycreation.id</div>
        </div>
    </div>
</body>

</html>
