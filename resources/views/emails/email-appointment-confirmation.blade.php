<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Cita</title>
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
            text-align: center;
        }

        .message-container {
            text-align: left;
            margin-top: 20px;
        }

        h1 {
            color: #2ecc71;
            margin-bottom: 10px;
        }

        .saludo {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        .recomendacion {
            color: #3498db;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="message-container">
            <div class="saludo">
                <p>Hola {{ $appointment->patient->FormatName}}</p>
            </div>
            <h1>Confirmación de Cita</h1>
            <p>Tu cita médica programada para el siguiente día está confirmada:</p>
            <ul>
                <li><strong>Fecha Programada:</strong> {{ $appointment->scheduled_date }}</li>
                <li><strong>Hora Programada:</strong> {{ $appointment->FormatScheduledTime }}</li>
                <li><strong>Tipo de cita:</strong> {{ $appointment->type }}</li>
                <li><strong>Médico:</strong> {{ $appointment->doctor->FormatName }} {{ $appointment->doctor->FormatLastName }}</li>
                <li><strong>Especialidad:</strong> {{ $appointment->specialty->FormatName }}</li>
            </ul>
            <p class="recomendacion">Te recomendamos llegar 10 minutos antes con tus documentos necesarios.</p>
        </div>

        <div class="footer">
            <p>Este correo electrónico es generado automáticamente. Por favor, no responda a este correo.</p>
        </div>
    </div>
</body>

</html>
