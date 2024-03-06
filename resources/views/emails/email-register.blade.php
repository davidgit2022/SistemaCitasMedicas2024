<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Exitoso</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
        }

        .message-container {
            text-align: center;
        }

        h1 {
            color: #4caf50;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        strong {
            font-weight: bold;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="message-container">
            <h1>Registro Exitoso</h1>
            <p><strong> {{ $user->FormatName}} {{ $user->FormatLastName}}</strong>¡Bienvenido al sistema de citas médicas! Tu registro ha sido completado con éxito.</p>
            <p>A continuación, te proporcionamos algunos datos importantes:</p>
            <ul>
                <li><strong>Correo Electrónico:</strong> {{ $user->email}}</li>
                <li><strong>Contraseña:</strong> {{ $user->password}}</li>
                <li><strong>Número de Identificación:</strong> {{ $user->dni}}</li>
            </ul>
        </div>
    </div>
</body>

</html>
