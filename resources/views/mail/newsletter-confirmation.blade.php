<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Conferma iscrizione</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; margin:0; padding:0;">
    <table width="100%" cellpadding="0" cellspacing="0"
        style="max-width:600px; margin:20px auto; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 0 10px rgba(0,0,0,0.1);">
        <tr>
            <td style="background-color:#007bff; color:#ffffff; text-align:center; padding:20px;">
                <h1 style="margin:0;">Ciao {{ $nome ?? 'amico' }}!</h1>
            </td>
        </tr>
        <tr>
            <td style="padding:20px; color:#333333; line-height:1.5;">
                <p>Grazie per esserti iscritto alla nostra newsletter di <strong>Presto.it</strong>.</p>
                <p>Riceverai aggiornamenti, novità e offerte esclusive direttamente nella tua casella di posta.</p>
                <p style="text-align:center; margin:30px 0;">
                    <a href="{{ url('/') }}"
                        style="background-color:#007bff; color:#ffffff; text-decoration:none; padding:12px 25px; border-radius:5px; display:inline-block;">Visita
                        Presto.it</a>
                </p>
                <p>Il team di <strong>Presto.it</strong></p>
            </td>
        </tr>
        <tr>
            <td style="background-color:#f0f0f0; color:#777777; text-align:center; padding:10px; font-size:12px;">
                Se non ti sei iscritto, ignora questa email.
            </td>
        </tr>
    </table>
</body>

</html>
