<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cuenta Pública 2024</title>
    <style>
        @font-face {
            font-family: 'Soberana Sans';
            src: url('https://framework-gb.cdn.gob.mx/assets/fonts/Soberana/SoberanaSans-Regular.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'Soberana Sans', Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            font-size: 10pt;
        }
        h1 {
            font-size: 12pt;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 7pt;
        }
        th, td {
            border: 1px solid black;
            padding: 4px;
            text-align: right;
        }
        th {
            background-color: #C09339;
            color: black;
            font-size: 8pt;
            text-align: center;
            vertical-align: middle;
        }
        .subheader th {
            background-color: #E6B95B;
        }
        .category {
            background-color: #8B4513;
            color: white;
        }
        .left-align {
            text-align: left;
        }
        .total-row td {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Cuenta Pública 2024</h1>
        <p>CUENTA PÚBLICA 2024</p>
        <p>10 - ECONOMÍA</p>
        <p>K8V - INSTITUTO MEXICANO DE LA PROPIEDAD INDUSTRIAL</p>
        <p>ESTADO ANALÍTICO DEL EJERCICIO DEL PRESUPUESTO DE EGRESOS EN CLASIFICACIÓN FUNCIONAL-PROGRAMÁTICA</p>
        <p>DEL 1 DE ENERO AL 31 DE DICIEMBRE DE 2024</p>
        <p>(CIFRAS EN PESOS)</p>
    </div>
    <table>
        <thead>
            <tr class="category">
                <th colspan="6">CATEGORÍAS PROGRAMÁTICAS</th>
                <th rowspan="2">DENOMINACIÓN</th>
                <th colspan="5">GASTO CORRIENTE</th>
                <th colspan="5">GASTO DE INVERSIÓN</th>
                <th rowspan="2">TOTAL</th>
                <th colspan="3">ESTRUCTURA PORCENTUAL</th>
            </tr>
            <tr class="subheader">
                <th>FI</th>
                <th>FN</th>
                <th>SF</th>
                <th>AI</th>
                <th>PP</th>
                <th>UR</th>
                <th>SERVICIOS PERSONALES</th>
                <th>GASTO DE OPERACIÓN</th>
                <th>SUBSIDIOS</th>
                <th>OTROS DE CORRIENTE</th>
                <th>SUMA</th>
                <th>PENSIONES Y JUBILACIONES</th>
                <th>INVERSIÓN FÍSICA</th>
                <th>SUBSIDIOS</th>
                <th>OTROS DE INVERSIÓN</th>
                <th>SUMA</th>
                <th>CORRIENTE</th>
                <th>PENSIONES Y JUBILACIONES</th>
                <th>INVERSIÓN</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?php echo $row['fi']; ?></td>
                    <td><?php echo $row['fn']; ?></td>
                    <td><?php echo $row['sf']; ?></td>
                    <td><?php echo $row['ai']; ?></td>
                    <td><?php echo $row['pp']; ?></td>
                    <td><?php echo $row['ur']; ?></td>
                    <td class="left-align"><?php echo $row['denomination']; ?></td>
                    <td><?php echo $row['personal_services']; ?></td>
                    <td><?php echo $row['operation_expense']; ?></td>
                    <td><?php echo $row['subsidies']; ?></td>
                    <td><?php echo $row['other_current']; ?></td>
                    <td><?php echo $row['current_sum']; ?></td>
                    <td><?php echo $row['pensions']; ?></td>
                    <td><?php echo $row['physical_investment']; ?></td>
                    <td><?php echo $row['investment_subsidies']; ?></td>
                    <td><?php echo $row['other_investment']; ?></td>
                    <td><?php echo $row['investment_sum']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                    <td><?php echo $row['percent_current']; ?></td>
                    <td><?php echo $row['percent_pensions']; ?></td>
                    <td><?php echo $row['percent_investment']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
