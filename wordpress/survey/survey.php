<?php
include("security.php");
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
					<div class="copy">© 2020 Chimu Agropecuaria</div>
				</div>
				<!-- /content-left-wrapper -->
			</div>
			<!-- /content-left -->

			<div class="col-lg-6 content-right" id="start">
				<div id="wizard_container">
					<div id="top-wizard">
							<div id="progressbar"></div>
						</div>
						<!-- /top-wizard -->
						<form id="wrapped" method="POST">
							<input id="website" name="website" type="text" value="">
							<!-- Leave for security protection, read docs for details -->
							<div id="middle-wizard">
								<div class="step">
									<h3 class="main_question"><strong>1/5</strong>Datos Generales</h3>
									<div class="form-group">
										<input type="text" name="fullname" class="form-control required" placeholder="Nombre del Contacto">
									</div>
									<div class="form-group">
										<input type="text" name="address" class="form-control required" placeholder="Dirección">
									</div>
									<div class="form-group">
										<input type="digits" name="phone" class="form-control required" placeholder="Teléfono">
									</div>
									<div class="form-group">
										<input type="email" name="email" class="form-control required" placeholder="Correo Electrónico">
									</div>
									<div class="form-group">
										<input type="text" name="bussines_name" class="form-control required" placeholder="Nombre del Establecimiento">
									</div>
								</div>
								<!-- /step-->
								<div class="step">
									<h3 class="main_question"><strong>2/5</strong>Encuesta sobre la información brindada</h3>
									<!-- pregunta 1 -->
									<h6>Detallada</h6>
									<div class="form-group">
										<label class="container_radio version_2">Sí
											<input type="radio" name="question_1" value="si" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">No
											<input type="radio" name="question_1" value="no" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div id="question_1_message_div" class="form-group hidden">
										<textarea id="question_1_message" name="question_1_message" class="form-control" style="height:100px;" placeholder="Si su respuesta es no, por favor brindar más información..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
									<!-- pregunta 2 -->
									<h6>Didáctica</h6>
									<div class="form-group">
										<label class="container_radio version_2">Sí
											<input type="radio" name="question_2" value="si" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">No
											<input type="radio" name="question_2" value="no" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div id="question_2_message_div" class="form-group hidden">
										<textarea id="question_2_message" name="question_2_message" class="form-control" style="height:100px;" placeholder="Si su respuesta es no, por favor brindar más información..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
									<!-- pregunta 3 -->
									<h6>Entendible</h6>
									<div class="form-group">
										<label class="container_radio version_2">Sí
											<input type="radio" name="question_3" value="si" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">No
											<input type="radio" name="question_3" value="no" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div id="question_3_message_div" class="form-group hidden">
										<textarea id="question_3_message" name="question_3_message" class="form-control" style="height:100px;" placeholder="Si su respuesta es no, por favor brindar más información..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
								</div>
								<!-- /step-->
								<div class="step">
									<h3 class="main_question"><strong>3/5</strong>Encuesta sobre el producto ofertado</h3>
									<!-- pregunta 4 -->
									<h6>Presentación</h6>
									<div class="form-group">
										<label class="container_radio version_2">Sí
											<input type="radio" name="question_4" value="si" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">No
											<input type="radio" name="question_4" value="no" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div id="question_4_message_div" class="form-group hidden">
										<textarea id="question_4_message" name="question_4_message" class="form-control" style="height:100px;" placeholder="Si su respuesta es no, por favor brindar más información..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
									<!-- pregunta 5 -->
									<h6>Peso</h6>
									<div class="form-group">
										<label class="container_radio version_2">Sí
											<input type="radio" name="question_5" value="si" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">No
											<input type="radio" name="question_5" value="no" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div id="question_5_message_div" class="form-group hidden">
										<textarea id="question_5_message" name="question_5_message" class="form-control" style="height:100px;" placeholder="Si su respuesta es no, por favor brindar más información..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
									<!-- pregunta 6 -->
									<h6>Precio</h6>
									<div class="form-group">
										<label class="container_radio version_2">Sí
											<input type="radio" name="question_6" value="si" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">No
											<input type="radio" name="question_6" value="no" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div id="question_6_message_div" class="form-group hidden">
										<textarea id="question_6_message" name="question_6_message" class="form-control" style="height:100px;" placeholder="Si su respuesta es no, por favor brindar más información..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
									<!-- pregunta 7 -->
									<h6>Pedido</h6>
									<div class="form-group">
										<label class="container_radio version_2">Sí
											<input type="radio" name="question_7" value="si" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">No
											<input type="radio" name="question_7" value="no" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div id="question_7_message_div" class="form-group hidden">
										<textarea id="question_7_message" name="question_7_message" class="form-control" style="height:100px;" placeholder="Si su respuesta es no, por favor brindar más información..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
									<!-- pregunta 8 -->
									<h6>Pago</h6>
									<div class="form-group">
										<label class="container_radio version_2">Sí
											<input type="radio" name="question_8" value="si" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">No
											<input type="radio" name="question_8" value="no" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div id="question_8_message_div" class="form-group hidden">
										<textarea id="question_8_message" name="question_8_message" class="form-control" style="height:100px;" placeholder="Si su respuesta es no, por favor brindar más información..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
									<!-- pregunta 9 -->
									<h6>Horario</h6>
									<div class="form-group">
										<label class="container_radio version_2">Sí
											<input type="radio" name="question_9" value="si" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">No
											<input type="radio" name="question_9" value="no" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div id="question_9_message_div" class="form-group hidden">
										<textarea id="question_9_message" name="question_9_message" class="form-control" style="height:100px;" placeholder="Si su respuesta es no, por favor brindar más información..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
								</div>
								<!-- /step-->
								<div class="step">
									<h3 class="main_question"><strong>4/5</strong>Encuesta sobre comportamiento de su mercado</h3>
									<!-- pregunta 10 -->
									<h6>Competidor</h6>
									<div class="form-group">
										<label class="container_radio version_2">Sí
											<input type="radio" name="question_10" value="si" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">No
											<input type="radio" name="question_10" value="no" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div id="question_10_message_div" class="form-group hidden">
										<textarea id="question_10_message" name="question_10_message" class="form-control" style="height:100px;" placeholder="Si su respuesta es no, por favor brindar más información..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
									<!-- pregunta 11 -->
									<h6>Oferta</h6>
									<div class="form-group">
										<label class="container_radio version_2">Sí
											<input type="radio" name="question_11" value="si" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">No
											<input type="radio" name="question_11" value="no" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div id="question_11_message_div" class="form-group hidden">
										<textarea id="question_11_message" name="question_11_message" class="form-control" style="height:100px;" placeholder="Si su respuesta es no, por favor brindar más información..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
									<!-- pregunta 12 -->
									<h6>Demanda</h6>
									<div class="form-group">
										<label class="container_radio version_2">Sí
											<input type="radio" name="question_12" value="si" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">No
											<input type="radio" name="question_12" value="no" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div id="question_12_message_div" class="form-group hidden">
										<textarea id="question_12_message" name="question_12_message" class="form-control" style="height:100px;" placeholder="Si su respuesta es no, por favor brindar más información..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
								</div>
								<!-- /step-->
								<div class="submit step">
									<h3 class="main_question"><strong>5/5</strong>Resultados de la prospección</h3>
									<!-- pregunta 13 -->
									<h6>Interés</h6>
									<div class="form-group">
										<label class="container_radio version_2">Sí
											<input type="radio" name="question_13" value="si" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">No
											<input type="radio" name="question_13" value="no" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div id="question_13_message_div" class="form-group hidden">
										<textarea id="question_13_message" name="question_13_message" class="form-control" style="height:100px;" placeholder="Si su respuesta es no, por favor brindar más información..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
									<!-- pregunta 14 -->
									<h6>Registro</h6>
									<div class="form-group">
										<label class="container_radio version_2">Sí
											<input type="radio" name="question_14" value="si" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">No
											<input type="radio" name="question_14" value="no" class="required" onchange="message_div_visibility(this);">
											<span class="checkmark"></span>
										</label>
									</div>
									<div id="question_14_message_div" class="form-group hidden">
										<textarea id="question_14_message" name="question_14_message" class="form-control" style="height:100px;" placeholder="Si su respuesta es no, por favor brindar más información..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
								</div>
								<!-- /step-->
							</div>
							<!-- /middle-wizard -->
							<div id="bottom-wizard">
								<button type="button" name="backward" class="backward">Anterior</button>
								<button type="button" name="forward" class="forward">Siguiente</button>
								<button type="submit" name="process" class="submit">Enviar</button>
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