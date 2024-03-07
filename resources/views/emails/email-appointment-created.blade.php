<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cita Médica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #3498db;
        }

        p {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
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
        <h1>Cita Médica</h1>
        <p>Estimado/a {{ Auth::user()->name}},</p>
        <p>A continuación se detallan los datos de su cita médica:</p>

        <table>
            <tr>
                <th>
                    Fecha Programada</th>
                <td>[{{ $appointment->scheduled_date }}]</td>
            </tr>
            <tr>
                <th>Hora Programada</th>
                <td>
                    [{{ $appointment->FormatScheduledTime}}]
                </td>
            </tr>
            <tr>
                <th>Tipo de consulta</th>
                <td>[{{ $appointment->type }}]</td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td>[{{ $appointment->FormatDescription }}]</td>
            </tr>
            <tr>
                <th>Médico</th>
                <td>[{{ $appointment->doctor->FormatName }} {{ $appointment->doctor->FormatLastName }}]</td>
            </tr>
            <tr>
                <th>Paciente</th>
                <td>[{{ $appointment->patient->FormatName }} {{ $appointment->patient->FormatLastName }}]</td>
            </tr>
            <tr>
                <th>Especialidad</th>
                <td>[{{ $appointment->specialty->FormatName }}]</td>
            </tr>
            <tr>
                <th>Estado</th>
                <td>[ Reservada ]</td>
            </tr>
        </table>

        <p>Gracias por confiar en nuestro servicio. Si tiene alguna pregunta o necesita reprogramar la cita, no dude en
            ponerse en contacto con nosotros.</p>

        <div class="footer">
            <p>Este correo electrónico es generado automáticamente. Por favor, no responda a este correo.</p>
        </div>
    </div>
</body>

</html>
