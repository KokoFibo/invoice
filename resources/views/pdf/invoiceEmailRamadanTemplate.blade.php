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
                    We are wishing you an early Eid-Al Fitr celebration. We hope this holiday brings you and your family
                    warmth, joy, and incredible opportunities. We wish you could enjoy this holiday to recharge and
                    spend it with your loved ones.
                </p>

                <p style="font-size: 16px; line-height: 2; margin-bottom: 0">
                    With apology, we are sending you the invoice ahead of schedule due to the upcoming holidays.
                    However, the invoice's due date remains the same as the previous month, which is
                    {{ $due_date }}. The report will also be sent to you at the end of this month.
                </p>
                <p style="font-size: 16px; line-height: 2; margin-bottom: 0">
                    We also want to inform you that due to the upcoming Eid-Al Fitr Holiday, <b>we are unable to accept
                        both request nor revision on 19 - 25 April 2023</b>. However, posting schedules will be uploaded
                    normally. We sincerely appreciate your understanding.
                </p>

                <p style="font-size: 16px; line-height: 2; margin-bottom: 0">
                    We are thankful to have you as our client and we appreciate all the support you have given us
                    before.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
