<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Письмо от пользователя</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h2>
            E-mail: {{ $email }}
            </2>
            <h2>
                Сообщение:
            </h2>
            <p>
                {{ $msg }}
            </p>
    </body>
</html>