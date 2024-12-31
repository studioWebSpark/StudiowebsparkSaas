<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        /* Styles globaux */
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #333333;
            background-color: #f5f5f5;
        }

        .wrapper {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 2px solid #f0f0f0;
        }

        .logo {
            max-width: 200px;
            height: auto;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #1a1a1a;
            color: #ffffff;
        }

        .social-links {
            margin: 15px 0;
        }

        .social-links a {
            margin: 0 10px;
            color: #ffffff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="wrapper">
       

        {{ $header ?? '' }}

        <div class="content">
            {{ Illuminate\Mail\Markdown::parse($slot) }}

            {{ $subcopy ?? '' }}
        </div>
    </div>

    <div class="footer">
        <p>StudioWebspark - Votre partenaire digital</p>
        <div class="social-links">
           
            <a href="https://www.instagram.com/studiowebspark_1">Instagram</a>
        </div>
        <p>© {{ date('Y') }} Studio Webspark. Tous droits réservés.</p>
        <p>
            <small>Si vous avez reçu cet email par erreur, merci de nous contacter à
                <a href="mailto:studiowebspark@gmail.com" style="color: #ffffff;">studiowebspark@gmail.com</a>
            </small>
        </p>
    </div>
</body>

</html>