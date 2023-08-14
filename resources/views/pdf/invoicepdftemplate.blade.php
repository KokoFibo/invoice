<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{ asset('style/invoice.css') }}"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" /> --}}
    <title>Invoice PDF</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: "poppins", sans-serif;
            color: #3e3e3f;
            /* font-size: 10px; */
        }

        .container {
            /* width: 100vw; */
            width: 100%;
            margin: auto;
        }

        tbody tr td {
            padding-top: 15px;
        }

        .first-row {
            flex-basis: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 100px;
            /* width: 70%; */
        }

        .invoice {
            font-size: 50px;
            font-weight: 600;
            text-align: center;
        }

        .table1 {
            color: #3e3e3f;
            border-collapse: collapse;
            margin: 25px 0;
            margin: auto;
        }

        thead tr th {
            height: 45px;
        }

        .table1,
        th,
        .garis {
            /* border: 1px solid #999; */
            border-right: 1px solid #999;
            border-left: 1px solid #999;
        }

        .left,
        .right,
        .main {
            display: flex;
            padding: 10px;
        }

        .term,
        .tiffany {
            font-weight: 600;
        }

        .flex {
            display: flex;
            flex-direction: column;
        }

        .thankyou {
            font-weight: 600;
            font-size: 22px;
            font-style: italic;
        }

        .main {
            justify-content: space-between;
            align-items: end;
            margin-top: 30px;
        }

        table {
            width: 100%;
        }

        .rupiah,
        .discount,
        .tax,
        .total {
            text-align: right;
        }

        .package {
            text-align: center;
        }

        .bold {
            font-weight: 600;
        }

        /* td {
            padding: 8px 20px;
        } */

        thead tr {
            background-color: #D9EAF7;
            /* height: 25px; */
            border: 1px solid #999;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 50px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">

    </div>
    </div>
    <table style="width:100%">
        <tr>
            <td>
                <span>
                    <b>Invoice No.</b>
                </span>
                {{ invNumberFormat($invoice->number, $invoice->invoice_date) }}
            </td>
            <td style="text-align: right;">
                <img style="width:150px; " src="https://invoice.kokofibo.com/images/kokofibo logo.png"
                    alt="kokofibo logo" border="0" /></a>
            </td>
        </tr>
    </table>


    <h1 style="text-align: center;">INVOICE</h1>
    <table style="margin-bottom: 25px">
        <tr>
            <td style="width: 15%"><b>Name</b></td>
            <td style="width: 30%">{{ $customer->salutation }} {{ $customer->name }}</td>
            <td style="width: 15%"><b>Invoice Date</b></td>
            <td style="width: 15%">{{ tanggal($invoice->invoice_date) }}</td>
        </tr>
        <tr>
            <td style="width: 15%"><b>Company</b></td>
            <td style="width: 30%">{{ $customer->title }} {{ $customer->company }}</td>
            <td style="width: 15%"><b>Due Date</b></td>
            <td style="width: 30%">{{ tanggal($invoice->due_date) }}</td>
        </tr>
        <tr>
            @if ($contract_number != '-')
                <td style="width: 15%"><b>Contract No.</b></td>
                <td style="width: 30%">{{ $contract_number }}</td>
            @else
                <td style="width: 15%"><b>Contract No.</b></td>
                <td style="width: 30%">None</td>
            @endif

            <td style="width: 15%"><b>Payment to</b></td>
            <td style="width: 30%">Phang Esti Anton</td>
        </tr>
        <tr>
            <td style="vertical-align: top;"><b>Address</b></td>
            <td style="vertical-align: top;">{{ $customer->address }}</td>
            <td> </td>
            <td>
                <p>Bank Permata<br>4000 68 56 88</p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td> </td>
            <td></td>
            {{-- <td>6600 356 117</td> --}}
        </tr>
    </table>

    <div>
        <table class="table1">
            <thead>
                <tr>
                    <th style="width: 55%;">Item Description</th>
                    <th style="width: 20%;">Qty</th>
                    <th style="width: 25%;">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                @endphp
                @foreach ($invoices as $i)
                    <tr>
                        <td style="padding: 15 15px 0 15px" class="garis">{{ $i->package }}</td>
                        <td class="garis package">{{ $i->qty }} {{ $i->qty > 1 ? 'Packages' : 'Package' }}
                        </td>
                        <td style="padding: 15 15px 0 15px" class="garis rupiah">IDR
                            {{ number_format($i->qty * $i->price) }}</td>
                        @php
                            $subtotal = $subtotal + $i->qty * $i->price;
                        @endphp
                    </tr>
                @endforeach
                <tr style="height:300px">
                    <td class="garis"> </td>
                    <td class="garis"> </td>
                    <td class="garis"> </td>

                </tr>
                @if ($invoice->discount != 0)
                    <tr style=" border: 1px solid #999">
                        <td style="padding: 8 15px 7 15px">Discount</td>
                        <td></td>
                        <td class="discount" style="padding: 8 15px 7 15px; border-left: 1px solid #999">IDR
                            {{ number_format($invoice->discount) }}</td>
                    </tr>
                @endif
                @if ($invoice->tax != 0)
                    <tr style=" border: 1px solid #999">
                        <td style="padding: 8 15px 7 15px">Tax</td>
                        <td></td>
                        <td class="tax" style="padding: 8 15px 7 15px; border-left: 1px solid #999">
                            {{ $invoice->tax }} %</td>
                    </tr>
                @endif

                <tr style=" border: 1px solid #999">
                    <td style="padding: 8 15px 7 15px"><b>Grand Total</b></td>
                    <td></td>
                    <td class="total" style=" padding: 8 15px 7 15px;  border-left: 1px solid #999"><b>IDR
                            {{ number_format(roundedTotal($subtotal, $invoice->discount, $invoice->tax)) }}</b></td>
        </table>
    </div>


    <table style=" width: 100%; margin-top: 50px;">
        <tr>
            <td style="width: 50%;"><b>Terms & Conditions</b></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="width: 50%;">
                <p> Kindly make the transfer before the due date<br>
                    to continue the ongoing project. Proof of<br>
                    payment could be sent via Whatsapp or email</p>
            </td>
            <td style="text-align: right;"><img src="https://invoice.kokofibo.com/images/mich-signs.png" alt="">
            </td>
        </tr>
        <tr>
            <td style="vertical-align: bottom;">
                <h2><b><i>Thank you for your support!</i></b></h2>
            </td>
            <td style="vertical-align: bottom; text-align: right;">
                <p style="text-align: center"><b>Michelle Velicia</b> <br>
                    Kokofibo Finance Department</p>
            </td>
        </tr>
    </table>

    <div>
    </div>


    </div>
</body>

</html>
