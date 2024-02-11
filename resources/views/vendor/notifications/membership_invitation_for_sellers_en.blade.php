<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                margin: 0;
                padding: 0;
                background: linear-gradient(to bottom, #ffffff 0%, #ffe5e5 100%);
                font-family: 'Arial', sans-serif;
                color: #d18f8f;
                line-height: 1.6;
            }
            .email-container {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                background: #fff;
            }
            .email-header {
                text-align: center;
                padding-bottom: 20px;
            }
            .email-content {
                text-align: center;
            }
            .email-footer {
                text-align: center;
                padding-top: 20px;
                font-size: 0.8em;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                margin-top: 20px;
                background-color: #d18f8f;
                color: #fff;
                text-decoration: none;
                border-radius: 25px;
                transition: background-color 0.3s ease;
            }
            .button:hover {
                background-color: #e6a0a0;
            }
            .special-offer {
                display: inline-block;
                padding: 10px 20px;
                margin-top: 20px;
                background-color: #f7ebeb;
                color: #d18f8f;
                text-decoration: none;
                border-radius: 25px;
                transition: background-color 0.3s ease;
            }
        </style>
        <title>CezAgora Invitation</title>
    </head>
    <body>
        <div class="email-container">
            <div class="email-header">
                <a href="https://www.cezagora.com">
                    <img src="https://cezagora.fra1.cdn.digitaloceanspaces.com/logo.png" alt="CezAgora Logo" width="200">
                </a>
            </div>
            <div class="email-content">
                <h1>You're invited to join CezAgora,</h1>
                <h3>Your dedicated B2B marketplace tailored for the cosmetic industry!</h3>
                <p><b>Dear Esteemed, {{ $companyName }}</b>,</p>
                <p>As a valued member of our community, you will sell raw materials, ingredients, laboratory and formulation services and more in one place. Also, you'll get the chance to connect with a wide network of cosmetics manufacturers and make them your potential customers.</p>
                <p>Registration is free, listing your products and services is also free! No hidden monthly fees, You will pay a small of commission of 10% only when you make a successful sale on our platform.</p>
                <p class="special-offer"><b>Special Offer:</b> To celebrate your arrival, we are thrilled to offer
                    <b>zero fees on your first two sales!</b> This is our way of welcoming you to experience the full advantages of CezAgora, completely fee-free.
                </p>
                <p>Ready to embark on this journey with us? Simply click the button below to start exploring a world where your products find their perfect match.</p>
                <a href="https://www.cezagora.com/register" class="button">Join CezAgora now</a>
            </div>
            <p>Warm regards,</p>
            <p>CezAgora Team</p>
            <div class="email-footer">
                <p>If you have any questions, feel free to contact us at <a href="mailto:support@cezagora.com">support@cezagora.com</a>.</p>
            </div>
        </div>
    </body>
</html>

