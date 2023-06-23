<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- <link rel="stylesheet" href="style.css" /> -->
</head>

<body>
    <div class="card">
        <img src="{{ asset('images/invoice-header.jpg') }}" />
        <div class="card-content">
            <div>
                <p style="font-weight: bold">Dear {{ $title }} {{ $custName }} and team</p>

                <p>We hope you had a wonderful week!</p>

                <p>
                    Please refer to the attached invoice number {{ $invoice_number }} for {{ $company }}
                    social media activities the upcoming month, which is due for payment
                    on {{ $due_date }}. We are grateful for your support during the
                    previous month and hope we could have another great collaboration!
                    The report of ads and contents for {{ $company }} will be sent to you soon.
                    Please kindly wait for our next email.
                </p>

                <p>Thank you and have a great day!</p>
            </div>
        </div>
    </div>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: poppins;
            margin-top: 50px;

        }

        .card {
            width: 90%;
            max-width: 800px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            margin: 0 auto;
        }

        .card img {
            display: block;
            width: 100%;
            height: auto;
        }

        .card-content {
            padding: 20px;
            text-align: left;
        }

        .card-content h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .card-content p {
            font-size: 16px;
            line-height: 2;
            margin-bottom: 0;
        }
    </style>
</body>

</html>
