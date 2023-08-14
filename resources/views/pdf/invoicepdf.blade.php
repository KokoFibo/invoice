<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('style/invoice.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    {{-- @if (Session::has('message'))
        <script>
            // toastr.success("{{ 'message' }}");
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data Emailed',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif --}}
    <div class="container px-5">

        <div class="flex flex-row justify-between mt-5">
            <div>

            </div>
            <div class="flex flex-row gap-2">
                @php
                if(isEmailed($invoice->number) == false) {
                @endphp
                <div x-data="{ buttonDisabled: false }">
                    <a href="/invoiceEmail/{{ $invoice->number }}"><button x-on:click="buttonDisabled = true"
                            x-bind:disabled="buttonDisabled"
                            class="px-2 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-700">Email</button></a>
                </div>
                @php
                    }
                @endphp


                <div x-data="{ buttonDisabled: false }">

                    <a href="/pdf/{{ $invoice->number }}"><button x-on:click="buttonDisabled = true"
                            x-bind:disabled="buttonDisabled"
                            class="px-2 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-700">PDF</button></a>
                </div>

                <a href="/invoice"><button
                        class="px-2 py-1 text-sm text-white bg-black rounded hover:bg-gray-700">Back</button></a>
            </div>
        </div>
        <div class="first-row">
            <div class="inv_no">
                <span style="font-weight: 700">Invoice No.</span>
                {{ invNumberFormat($invoice->number, $invoice->invoice_date) }}
            </div>



            <div class="logo">
                <img src="{{ asset('images/kokofibo logo.png') }}" style="width:250px" alt="">
            </div>
        </div>

        <div class=invoice>
            <p>INVOICE</p>
        </div>

        <div class="flex flex-row items-start main">
            <div class="left">
                <div>
                    <p class="bold">Name</p>
                    <p class="bold">Company</p>
                    <p class="bold">Address</p>
                    @if ($contract_number != '-')
                        <p class="bold">Contract No.</p>
                    @endif
                </div>
                <div style="margin-left: 20px;">
                    <p>{{ $customer->salutation }} {{ $customer->name }}</p>
                    <p>{{ $customer->title }} {{ $customer->company }}</p>
                    <p>{{ $customer->address }}</p>
                    @if ($contract_number != '-')
                        <p>{{ $contract_number }}</p>
                    @endif

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
                        <p>{{ tanggal($invoice->invoice_date) }}</p>
                        <p>{{ tanggal($invoice->due_date) }}</p>
                        {{-- <p>{{ tanggal($invoice->invoice_date) }}</p>
                        <p>{{ tanggal($invoice->due_date) }}</p> --}}
                        <p>Phang Esti Anton<br>Bank Permata<br>4000 68 56 88</p>
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
                    @if ($invoice->discount != 0)
                        <tr style=" border: 1px solid #999">
                            <td>Discount</td>
                            <td></td>
                            <td class="discount" style=" border-left: 1px solid #999">IDR
                                {{ number_format($invoice->discount) }}</td>
                        </tr>
                    @endif
                    @if ($invoice->tax != 0)
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
                <div><img src="{{ asset('images/mich-signs.png') }}" alt=""></div>
                <div class="tiffany">Michelle Velicia</div>
                <div>Kokofibo Finance Department</div>
            </div>
        </div>
        <div>
            <hr>
        </div>
        <div class="footer">
            <div><i class="fa-solid fa-globe fa-lg"></i></i> www.kokofibo.com.id</div>
            <div><i class="fa-brands fa-whatsapp fa-lg"></i> 0877 265 888 36</div>
            <div><i class="fa-regular fa-envelope fa-lg"></i> billing@kokofibo.com</div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- @if (Session::has('message'))
        <script>
            toastr.success("{{ Session::get('message') }}");
        </script>
    @endif --}}
</body>

</html>
