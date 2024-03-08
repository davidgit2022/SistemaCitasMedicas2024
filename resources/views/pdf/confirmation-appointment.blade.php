<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Cita Médica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f4f4f4;
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

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalle de Cita Médica</h1>
        <p>A continuación se detallan los datos de su cita médica:</p>
        
        <table>
            <tr>
                <th>Fecha Programada</th>
                <td>{{ $appointment->scheduled_date }}</td>
            </tr>
            <tr>
                <th>Hora Programada</th>
                <td>{{ $appointment->FormatScheduledTime }}</td>
            </tr>
            <tr>
                <th>Tipo de Cita</th>
                <td>{{ $appointment->type }}</td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td>{{ $appointment->FormatDescription }}</td>
            </tr>
            <tr>
                <th>Médico</th>
                <td>{{ $appointment->doctor->FormatName }} {{ $appointment->doctor->FormatLastName }}</td>
            </tr>
            <tr>
                <th>Paciente</th>
                <td>{{ $appointment->patient->FormatName }} {{ $appointment->patient->FormatLastName }}</td>
            </tr>
            <tr>
                <th>Especialidad</th>
                <td>{{ $appointment->specialty->FormatName  }}</td>
            </tr>
            <tr>
                <th>Estado</th>
                <td>{{ $appointment->status }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
