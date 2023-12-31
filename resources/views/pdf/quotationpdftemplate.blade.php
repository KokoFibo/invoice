<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quotation PDF</title>
    <style>
        body {
            font-family: poppins, sans-serif;
            color: #374151;
            width: 100%;
        }
    </style>

</head>

<body>
    <div>


        <table style="width: 100%;">
            <tr>
                <td style="width:50%">
                    <h1 style="font-size:50px">QUOTATION</h1>
                    <p style="font-size:15px">DETAILED OF PROVIDED SERVICES</p>
                </td>
                <td style="width:50%;  text-align: right">
                    <img style="width:150px; " src="https://invoice.kokofibo.com/images/kokofibo logo.png"
                        alt="kokofibo logo" border="0" /></a>
                </td>
            </tr>
        </table>
        <br>
        <br>

        <table style="width:100%">
            <tr>
                <td style="width:50%; font-size: 15px; font-weight: bold; ">Created for</td>
                <td style="width:50%; font-size: 15px; font-weight: bold; ">Created on</td>
            </tr>

            <tr>
                <td style="width:50%; font-size: 15px; font-weight: bold;">
                    <hr>
                </td>
                <td style="width:50%; font-size: 15px; font-weight: bold;">
                    <hr>
                </td>
            </tr>
        </table>
        <table style="width:100%">
            <tr>
                <td style="width:15%; font-size: 15px; font-weight: bold; ">Name</td>
                <td style="width:35%; font-size: 15px; ; ">{{ $customer->salutation }} {{ $customer->name }}</td>
                <td style="width:15%; font-size: 15px; font-weight: bold; ">Date</td>
                <td style="width:35%; font-size: 15px; ; ">{{ tanggal_with_hari($quotation->quotation_date) }}</td>
            </tr>
        </table>
        <table style="width:100%">
            <tr>
                <td style="width:15%; font-size: 15px; font-weight: bold; ">Company</td>
                <td style="width:35%; font-size: 15px;  ">{{ $customer->title }} {{ $customer->company }}</td>
                <td style="width:15%; font-size: 15px; font-weight: bold; ">Number</td>
                <td style="width:35%; font-size: 15px;  ">
                    {{ quoNumberFormat($quotation->number, $quotation->quotation_date) }}</td>
            </tr>
        </table>
        <br>
        <br>



        <table style="width:100%; color: #374151; border-collapse: collapse;">
            <thead>
                <tr>
                    <td colspan="3"
                        style="text-align:center; background-color:#D9EAF7; padding: 5px 0 5px 0; border: 1px solid #999; font-size: 25px">
                        PROVIDED
                        SERVICES</td>
                </tr>
                <tr style="border: 1px solid #999">
                    <th style="width: 55%; font-size: 15px; border: 1px solid #999;padding: 8px 20px;">Item Description
                    </th>
                    <th style="width: 20%; font-size: 15px; border: 1px solid #999;padding: 8px 20px;">Quantity</th>
                    <th style="width: 25%; font-size: 15px; border: 1px solid #999;padding: 8px 20px;">Total</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $grandTotal = 0;
                @endphp
                @foreach ($quotations as $q)
                    <tr>
                        <td
                            style="font-size: 14px;border: 1px solid #999; padding: 8px 20px; text-align:left; line-height: 1.6;">
                            <b>{{ $q->package }}</b>
                            @php
                                $desc = getDetail($q->description);
                            @endphp
                            <ul>

                                @php
                                    $cols = 40;
                                @endphp
                                @foreach ($desc as $d)
                                    <em> {{ $d }}</em>
                                @endforeach
                            </ul>
                        </td>
                        <td style="font-size: 14px;border: 1px solid #999;padding: 8px 20px; text-align:center;">1
                            Package</td>
                        <td style="font-size: 14px;border: 1px solid #999;padding: 8px 20px; text-align:right;">IDR
                            {{ number_format($q->price) }}</td>
                        @php
                            $grandTotal = $grandTotal + $q->price;
                        @endphp
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2"
                        style="font-size: 14px;border: 1px solid #999;padding: 8px 20px;text-align:left;"><b>Grand
                            Total</b></td>
                    <td style="font-size: 14px;border: 1px solid #999;padding: 8px 20px; text-align:right;"><b>IDR
                            {{ number_format($grandTotal) }}</b>
                    </td>
                </tr>
            </tbody>
        </table>
        {{-- <br>
        <table style="width: 100%">
            <tr>

                <td style="width: 33%; text-align:left ;  ">

                    <img src="https://sky.blueskycreation.id/web.png" style="width: 15px;"> www.blueskycreation.id
                </td>
                <td style="width: 33%; text-align:center"><img src="https://sky.blueskycreation.id/whatsapp.png"
                        style="width: 15px;"> 087 780 620 632</td>
                <td style="width: 33%; text-align:right"><img src="https://sky.blueskycreation.id/email.png"
                        style="width: 15px;"> hello@blueskycreation.id</td>
            </tr>
        </table> --}}

        <pagebreak />

        <br>
        {{-- <br> --}}
        {{--  Work Process  --}}
        <table style=" font-size: 13.5px; width:100%; border: 1px solid #999; line-height: 1.1;">
            <tr>
                <td colspan="2"
                    style=" border-bottom: 1px solid #999; background-color:#d9eaf7; line-height: 3.2;
                width:100%; text-align: center;padding:5px;">
                    <span style="letter-spacing: 5px; font-weight: bold; font-size:17px;">Work Process</span>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 10px 7px 5px 7px"><b>Step 1</b> Initiation</td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0 7px">Client defines and interpret the details of the
                    request </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 0 7px 5px 7px"><b>Step 2</b> Quotation</td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0 7px">Our team will send you the estimation of your requested
                    project</td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0 7px 5px 7px"><b>Step 3</b> Contract</td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0 7px">client has determined the desired package and signed
                    the contract</td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0 7px 5px 7px"><b>Step 4</b> Down Payment</td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0 7px">Due to the nature of the services, we need 50% of
                    down payment to start the project</td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0 7px 5px 7px"><b>Step 5</b> Brief</td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0 7px">A description of key elements and detailed
                    requirements of the project</td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0 7px 5px 7px"><b>Step 6</b> Development</td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0 7px">Our team begin to develop the project </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0 7px 5px 7px"><b>Step 7</b> Completion</td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0 7px 10px 7px">We release the final deliverables of the project to
                    the client </td>
            </tr>





        </table>
        {{--  TERMS AND CONDITIONS  --}}
        {{-- <table style=" font-size: 13.5px; width:100%; border: 1px solid #999; line-height: 1.1;margin-top:50px;">
            <tr>
                <td colspan="2"
                    style=" border-bottom: 1px solid #999; background-color:#d9eaf7; line-height: 3.2;
                width:100%; text-align: center;padding:5px;">
                    <span style="letter-spacing: 5px; font-weight: bold; font-size:17px;">TERMS AND CONDITIONS</span>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 10px 7px 5px 7px"><b>Revisions</b></td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0 7px">The services include 1x major revision and 2x
                    minor revisions.
                    No photo/video shoot revisions</td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 0 7px 5px 7px"><b>Monthly Services</b></td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0 7px">The services of our social media packages are
                    provided per month & cannot be accumulated.</td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0 7px 5px 7px"><b>Contract Period</b></td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0 7px 10px 7px">Our social media packages comes with a minimum
                    of 3 months contract.</td>

            </tr>




        </table> --}}
    </div>
</body>

</html>
