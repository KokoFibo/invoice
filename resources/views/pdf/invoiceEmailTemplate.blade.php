<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>

<body
    style="
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: poppins, 'san-francisco';
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
        <img src="https://invoice.kokofibo.com/images/hello.jpg" style="display: block; width: 100%; height: auto" />
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
                    Invoice Number: {{ $invoice_number }}
                    Invoice Date: {{ $invoice_date }}
                    Due Date: {{ $due_date }}
                    Payment Method: Bank Transfer to
                    Bank BCA
                    Acc No : 639 000 8226
                    Michelle Velicia
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

                    Kokofibo Web Developer
                    0877 265 888 36
                    <a href="https://kokofibo.com/">kokofibo.com</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
