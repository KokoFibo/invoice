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
        <img src="https://sky.blueskycreation.id/invoice-header.jpg" style="display: block; width: 100%; height: auto" />
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
                    We hope you had a wonderful week!
                </p>

                <p style="font-size: 16px; line-height: 2; margin-bottom: 0">
                    Please refer to the attached invoice number {{ $invoice_number }}
                    for {{ $company }} social media activities the upcoming month, which
                    is due for payment on {{ $due_date }}. We are grateful for your
                    support during the previous month and hope we could have another
                    great collaboration! The report of ads and contents for {{ $company }} will be sent to you
                    soon. Please kindly wait for our next email.
                </p>

                <p style="font-size: 16px; line-height: 2; margin-bottom: 0">
                    Thank you and have a great day!
                </p>
            </div>
        </div>
    </div>
</body>

</html>
