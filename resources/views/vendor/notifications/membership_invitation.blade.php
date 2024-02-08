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
                text-align: left;
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
                <a href="{{ route('home') }}">
                    <img src="https://cezagora.fra1.cdn.digitaloceanspaces.com/logo.png" alt="CezAgora Logo" width="200">
                </a>
            </div>
            <div class="email-content">
                <h1>Alatura-te comunitatii CezAgora,</h1>
                <h2>Fii printre primii care se inregistreaza in marketplace-ul dedicat industriei de cosmetice!</h2>
                <h3><b>Salutare, {{ $companyName }}</b>,</h3>

                <p>Ca membru apreciat al marketplace-ului CezAgora, te vom conecta atat cu producatori de cosmetice cat si cu furnizori de produse si servicii relevante, iti vom creste oportunitatile de vanzare si iti vom oferi mai multa vizibilitate si expunere.</p>
                <p>Iti oferim posibilitatea de a vinde si de a cumpara materii prime, ingrediente si amblaje, servicii de laborator, formulare si private label, toate intr-un singur loc.</p>

                <p class="special-offer">Inscrierea este gratuita! Platesti doar comision la vanzare.</p>

                <p class="special-offer"><b>Oferta speciala pentru vanzatori:</b> Pentru a sarbatori sosirea ta in comunitatea noastra profesionala, iti acordam
                    <b>primele doua vanzari fara comision!</b> Acesta este modul nostru de a-ti oferi posibilitatea sa experimentezi multiplele avantaje ale platformei noastre.
                </p>

                <a href="{{ route('register') }}" class="button">Inregistreaza-te acum</a>
                <p>Vrei sa afli mai multe despre noi? <a href="{{ route('about') }}">Apasa aici</a>.</p>
            </div>
            <p>Cu drag,</p>
            <p>Echipa CezAgora</p>
            <div class="email-footer">
                <p>Daca ai intrebari sau doresti informatii suplimentare, contacteaza-ne <a href="mailto:support@cezagora.com">support@cezagora.com</a>.</p>
            </div>
        </div>

    </body>
</html>

