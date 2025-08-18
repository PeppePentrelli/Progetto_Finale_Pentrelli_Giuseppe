<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Richiesta Venditore - Presto.it</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #0d6efd;
        }

        h1 {
            color: #0d6efd;
            text-align: center;
            margin-bottom: 20px;
            font-size: 28px;
        }

        h2 {
            color: #555;
            font-size: 22px;
            margin-top: 30px;
            margin-bottom: 15px;
        }

        p {
            margin-bottom: 10px;
            font-size: 16px;
        }

        strong {
            color: #0d6efd;
        }

        .info-item {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            border: 1px solid #e9ecef;
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
        }

        .button {
            display: inline-block;
            background-color: #198754;
            color: #ffffff;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }

        .logo-icon {
            font-size: 30px;
            color: #0d6efd;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 style="text-align: center;">
            <span class="logo-icon">
                ⚡
            </span>
            Richiesta di Lavoro - sezione vendita
        </h1>

        <h2>Un utente ha chiesto di lavorare con noi!</h2>

        <p>Ecco i suoi dati:</p>

        <div class="info-item">
            <p><strong>Nome:</strong> {{ $user->name }}</p>
        </div>
        <div class="info-item">
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>

        <p>Se vuoi rendere <strong>{{ $user->name }}</strong> un venditore, clicca sul pulsante qui sotto:</p>

        <div class="button-container">
            <a href="{{ route('make.vendor', compact('user')) }}" class="button">Rendi venditore</a>
        </div>

        <div class="footer">
            <p>Grazie per il tuo lavoro su Presto.it!</p>
            <p>&copy; {{ date('Y') }} Presto.it. Tutti i diritti riservati.</p>
        </div>
    </div>
</body>

</html>
