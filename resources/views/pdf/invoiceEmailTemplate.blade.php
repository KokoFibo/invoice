<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;1,400;1,600&display=swap"
        rel="stylesheet">
    <title>Document</title>
</head>

<body
    style="
      display: flex;
      justify-content: center;
      align-items: center;
       font-family: 'Poppins', 'Segoe UI', 'Helvetica Neue', Arial, sans-serif !important;
      margin-top: 50px;
    ">
    <div class="card"
        style="
        width: 90%;

        max-width: 800px;
        background-color: #ffffff;
        border: 1px solid #f1f1f1;
        border-radius: 10px;
        box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        margin: 0 auto;
      ">
        {{-- <img src="https://invoice.kokofibo.com/images/invoice-header.jpg"
            style="display: block; width: 100%; height: auto" /> --}}
        <img src="https://invoice.kokofibo.com/images/merry-christmas.jpg"
            style="display: block; width: 100%; height: auto" />
        {{-- <img src="https://invoice.kokofibo.com/images/digital-web-design.jpg"
            style="display: block; width: 100%; height: auto" /> --}}
        <div class="card-content" style="padding: 50px; text-align: left; ">
            <div>
                <p
                    style="
              font-weight: bold;
              font-size: 16px;
              line-height: 2;

              margin-bottom: 0;
            ">
                    Dear {{ $title }} {{ $custName }} and team
                </p>

                <p style="font-size: 16px; line-height: 2; margin-bottom: 0">
                    I hope this email finds you well. I am writing to provide you with the invoice for the web
                    development services we have recently provided. Kindly find the invoice attached to this email.
                </p>

                <p style="font-size: 16px; line-height: 2; margin-bottom: 0">
                    Invoice Details:
                <table style="font-size: 16px;">
                    <tr>
                        <td>Invoice Number</td>
                        <td>:</td>
                        <td>{{ $invoice_number }}</td>
                    </tr>
                    <tr>
                        <td>Invoice Date</td>
                        <td>:</td>
                        <td>{{ $invoice_date }}</td>
                    </tr>
                    <tr>
                        <td>Due Date</td>
                        <td>:</td>
                        <td>{{ $due_date }}</td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td>:</td>
                        <td>IDR {{ number_format($total) }}</td>
                    </tr>
                    <tr>
                        <td>Payment Method</td>
                        <td>:</td>
                        <td>Bank Transfer</td>
                    </tr>
                </table>
                <br><span style="font-size: 16px">&nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; Bank Permata</span>
                <br><span style="font-size: 16px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Acc No : 4000 68 56 88</span>
                <br><span style="font-size: 16px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Phang Esti Anton</span>

                </p>

                <p style="font-size: 16px; line-height: 2; margin-bottom: 0">
                    We greatly appreciate the opportunity to work with you on your web development project. We are
                    confident that the delivered services meet your expectations and requirements. Please review the
                    invoice carefully and ensure that all details are accurate.
                </p>

                <p style="font-size: 16px; line-height: 2; margin-bottom: 0">
                    If you have any questions or require further clarification regarding the invoice or our services,
                    please don't hesitate to reach out. We are more than happy to assist you in any way we can.
                </p>
                <p style="font-size: 16px; line-height: 2; margin-bottom: 0">
                    To process the payment, please refer to the payment instructions provided in the invoice. Once the
                    payment is made, kindly notify us, and we will promptly update our records accordingly.
                </p>
                <p style="font-size: 16px; line-height: 2; margin-bottom: 0">
                    Thank you for choosing our web development services. We value your business and look forward to
                    serving you again in the future.
                </p>
                <p style="font-size: 16px; line-height: 2; margin-bottom: 0">
                    Best Regards,

                    <br><br>Kokofibo Web Developer
                    <br>0877 265 888 36
                    <br><a href="https://kokofibo.com/">kokofibo.com</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
