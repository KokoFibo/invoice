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
        <img src="https://invoice.kokofibo.com/images/quotation-header.jpg"
            style="display: block; width: 100%; height: auto" />
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
                    Thank you for inviting us to quote for your project. We've reviewed your requirements and are
                    pleased to present our response.
                </p>

                <p style="font-size: 16px; line-height: 2; margin-bottom: 0">
                    Please see the attachment below {{ $quotation_number }} for the details of the services we can
                    provide for
                    your project. We would welcome the opportunity to discuss this quote, and provide answers to any
                    inquiries you may have.
                </p>
                <p style="font-size: 16px; line-height: 2; margin-bottom: 0">
                    We hope you find this quotation acceptable and we could collaborate in this exciting project.
                </p>

                <p style="font-size: 16px; line-height: 2; margin-bottom: 0">
                    Thank you and have a wonderful day
                </p>
                <p style="font-size: 16px; line-height: 2; margin-bottom: 0">
                    <br>
                    Best Regards,<br><br>
                    Anton<br>
                    www.kokofibo.com

                </p>
            </div>
        </div>
    </div>
</body>

</html>
