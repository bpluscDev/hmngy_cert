<?php
require_once 'includes/db.php'; // Assuming you have a db connection file

// Get certificate ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect or show an error if no ID is provided
    die("Certificate ID is required.");
}
$id = $_GET['id'];

// Fetch certificate data
$sql = "SELECT * FROM certificates WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$certificate = $result->fetch_assoc();

// If no certificate is found, show an error
if (!$certificate) {
    die("Certificate not found.");
}

// Format dates
$vigencia_inicio = date("d \d\e F \d\el Y", strtotime($certificate['fecha_inicio']));
$vigencia_fin = date("d \d\e F \d\e Y", strtotime($certificate['fecha_fin']));
$vigencia_text = $vigencia_inicio . " al " . $vigencia_fin;

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cert. <?php echo htmlspecialchars($certificate['id']); ?> | Humanergy LLC</title>
	<link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
	<!-- Compressed Styles -->
	<link href="css/slides.min.css" rel="stylesheet" type="text/css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom Styles -->
	<link href="css/custom.css" rel="stylesheet" type="text/css">

	<!-- jQuery 3.3.1 -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Compressed Scripts -->
	<script src="js/slides.min.js" type="text/javascript"></script>

	<!-- Fonts and Material Icons -->
	<link rel="stylesheet" as="font"
		href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,600,700|Material+Icons" />
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>

<body><br>
    <!-- Black bar with logo -->
    <div style="background-color: #000000e1; padding: 10px 20px;">
        <a href="index.html">
            <img src="assets/img/humanergy.png" width="150px" alt="">
        </a>
    </div>

	<section>
		<div class="container" style="padding-top: 100px;">
			<div class="row">
					<div class="col-lg-6">
						<center>
						<img src="assets/img/human-b.png" alt="">
						</center>
					</div>
				<div class="col-lg-6">
					<p style="font-size: 3rem; padding-top: 5%; padding-left: 5%; padding-right: 5%; font-weight: bold;">Empresa: <span style="font-weight: 400;"><?php echo htmlspecialchars($certificate['nombre_empresa']); ?></span></p>
					<p style="font-size: 3rem; font-weight: bold; padding-left: 5%; padding-right: 5%;">Nivel: <span style="font-weight: 400;">Diamond Partner.</span></p>
					<p style="font-size: 3rem; font-weight: bold; padding-left: 5%; padding-right: 5%;">Id Partner: <span style="font-weight: 400;">191119</span></p>
					<p style="font-size: 3rem; font-weight: bold; padding-left: 5%; padding-right: 5%;">Id Certificado: <span style="font-weight: 400;"><?php echo htmlspecialchars($certificate['id']); ?></span></p>
					<p style="font-size: 3rem; font-weight: bold; padding-left: 5%; padding-right: 5%;">Organismo certificador: <i><span style="font-weight: 400;">Humanergy L.L.C.</span></i></p>
					<p style="font-size: 3rem; font-weight: bold; padding-left: 5%; padding-right: 5%;">Certificado: <i><span style="font-weight: 400;"><?php echo htmlspecialchars($certificate['nombre_certificacion']); ?></span></i></p>
					<p style="font-size: 3rem; font-weight: bold; padding-left: 5%; padding-right: 5%;">Vigencia: <span style="font-weight: 400;"><?php echo $vigencia_text; ?></span></p>
				</div>
			</div>
		</div>
	</section>

	<center>
		<!-- Footer -->
		<section>
			<div><br><br><br><br><br>
				<p style="color: rgb(0, 0, 0); font-size: 2.5rem; font-weight: 500; padding-top: 5%;"> © 2024 Humanergy · Todos los derechos
					reservados</p>
			</div>
		</section>
	</center>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
		crossorigin="anonymous"></script>
</body>

</html>
