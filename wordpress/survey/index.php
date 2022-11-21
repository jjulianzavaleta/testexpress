<?php
@session_start();
if(isset($_SESSION["autentica"]) && $_SESSION["autentica"] == "SIP"){
    header("Location: survey.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Registro de Visitas - Chimu Xpress">
    <meta name="author" content="David Quevedo">
    <title>Registro de Visitas | Chimu Xpress</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/menu.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">
	
	<!-- MODERNIZR MENU -->
	<script src="js/modernizr.js"></script>
	
	<script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-11097556-8']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>

</head>

<body>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->
	
	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->
	
	<nav>
		<ul class="cd-primary-nav">
			<li><a href="index.html" class="animated_link">Inicio</a></li>
			<li><a href="https://xpress.chimuagropecuaria.com.pe" class="animated_link" target="_blank">Chimu Xpress</a></li>
			<li><a href="clases/logout.php" class="animated_link">Cerrar Sesión</a></li>
		</ul>
	</nav>
	<!-- /menu -->
	
	<div class="container-fluid full-height">
		<div class="row row-height">
			<div class="col-lg-6 content-left">
				<div class="content-left-wrapper">
					<a href="index.html" id="logo"><img src="img/logo.png" alt="" width="40" height="40"></a>
					<div>
						<figure><img src="img/info_graphic_1.svg" alt="" class="img-fluid"></figure>
						<h2>Registro de Visitas</h2>
						<p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel. Adhuc invidunt duo ex. Eu tantas dolorum ullamcorper qui.</p>
						<a href="#start" class="btn_1 rounded mobile_btn">¡Empezar ahora!</a>
					</div>
					<div class="copy">&copy; 2020 por Chimu Agropecuaria</div>
				</div>
				<!-- /content-left-wrapper -->
			</div>
			<!-- /content-left -->

			<div class="col-lg-6 content-right" id="start">
				<div id="wizard_container">
					<!-- /top-wizard -->
					<form id="" method="POST" action="loginValidar.php" autocomplete="off">
						<input id="website" name="website" type="text" value="">
						<!-- Leave for security protection, read docs for details -->
						<div>
							<div>
								<div class="form-group">
									<input type="text" name="username" class="form-control required" placeholder="Usuario">
								</div>
								<div class="form-group">
									<input type="password" name="password" class="form-control required" placeholder="Contraseña">
								</div>
							</div>
						</div>
						<!-- /middle-wizard -->
						<div id="bottom-login">
							<button type="submit" name="process" class="login">Iniciar Sesión</button>
						</div>
						<!-- /bottom-wizard -->
					</form>
				</div>
				<!-- /Wizard container -->
			</div>
			<!-- /content-right-->
		</div>
		<!-- /row-->
	</div>
	<!-- /container-fluid -->

	<div class="cd-overlay-nav">
		<span></span>
	</div>
	<!-- /cd-overlay-nav -->

	<div class="cd-overlay-content">
		<span></span>
	</div>
	<!-- /cd-overlay-content -->

	<a href="#0" class="cd-nav-trigger">Menu<span class="cd-icon"></span></a>
	<!-- /menu button -->
	
	<!-- COMMON SCRIPTS -->
	<script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/common_scripts.min.js"></script>
	<script src="js/velocity.min.js"></script>
	<script src="js/functions.js"></script>

	<!-- Wizard script -->
	<script src="js/survey_func.js"></script>

</body>

</html>