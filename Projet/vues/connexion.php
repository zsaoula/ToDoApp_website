<html>
	<head>
		<title>Connexion</title>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<script type="text/javascript">
		function clearForm(oForm) {
		
			var elements = oForm.elements; 
				
			oForm.reset();

			for(i=0; i<elements.length; i++) {
				
				field_type = elements[i].type.toLowerCase();
				
				switch(field_type) {
				
					case "text": 
					case "password": 
					case "textarea":
						case "hidden":	
						
						elements[i].value = ""; 
						break;
					
					case "radio":
					case "checkbox":
						if (elements[i].checked) {
							elements[i].checked = false; 
						}
						break;

					case "select-one":
					case "select-multi":
								elements[i].selectedIndex = -1;
						break;

					default: 
						break;
				}
			}
		}
		</script>
	</head>
	<body>
	
	<?php
	// on v�rifie les donn�es provenant du mod�le
	if (isset($dVue))
	{?>

		<?php
			if (isset($dVueEreur) && count($dVueEreur)>0) {
			echo "<h2>ERREUR !!!!!</h2>";
			foreach ($dVueEreur as $value){
				echo $value;
			}}
		?>
		<!-- Navbar -->
		<nav
			class="navbar navbar-expand-lg  bg-white border border-2 border-top-0 border-end-0 border-start-0 border-primary navbar-white p-4 shadow rounded position-sticky fixed-top">
			<div class="container">
				<a class="navbar-brand" href="#">TODO List</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="index.php?action=inscription">Inscription</a>
						</li>
						<li class="nav-item">
						<a class="nav-link" href="index.php?action=afficherTaches">ListPublic</a>
						</li>
						<!-- <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
							aria-expanded="false">
							Dropdown
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="#">Action</a></li>
							<li><a class="dropdown-item" href="#">Another action</a></li>
							<li>
							<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="#">Something else here</a></li>
						</ul>
						</li> -->
						<!-- <li class="nav-item">
						<a class="nav-link disabled">Disabled</a>
						</li> -->
					</ul>
					<!-- <form class="d-flex">
						<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline-primary" type="submit">Search</button>
					</form> -->
					</div>
				</div>
			</nav>
		

		<!-- Section: Design Block -->
		<section class="text-center text-lg-start">
			<style>
				.cascading-right {
				margin-right: -50px;
				}

				@media (max-width: 991.98px) {
				.cascading-right {
					margin-right: 0;
				}
				}
			</style>

			<!-- Jumbotron -->
			<div class="container  py-3">
				<div class="row  g-0 align-items-center">
				<div class="col-lg-6 mb-5 mb-lg-5 ">
					<div class="card cascading-right" style="
						background: hsla(0, 0%, 100%, 0.55);
						backdrop-filter: blur(30px);
						">
					<div class="card-body p-5 pb-1 shadow-5 text-center">
						<h2 class="fw-bold mb-5">Sign up now</h2>
						<form>
						<!-- 2 column grid layout with text inputs for the first and last names -->
						<div class="row">
							<div class="col-md-6 mb-4">
							<div class="form-outline">
								<input type="text" id="form3Example1" class="form-control" />
								<label class="form-label" for="form3Example1">First name</label>
							</div>
							</div>
							<div class="col-md-6 mb-4">
							<div class="form-outline">
								<input type="text" id="form3Example2" class="form-control" />
								<label class="form-label" for="form3Example2">Last name</label>
							</div>
							</div>
						</div>

						<!-- Email input -->
						<div class="form-outline mb-4">
							<input type="email" id="form3Example3" class="form-control" />
							<label class="form-label" for="form3Example3">Email address</label>
						</div>

						<!-- Password input -->
						<div class="form-outline mb-4">
							<input type="password" id="form3Example4" class="form-control" />
							<label class="form-label" for="form3Example4">Password</label>
						</div>

						<!-- Submit button -->
						<button type="submit" class="btn btn-primary btn-block mb-4">
							Sign up
						</button>

						
						</form>
					</div>
					</div>
				</div>

				<div class="col-lg-6 mb-2 mb-lg-0 ">
					<img src="./vues/todo.png" class=" rounded-4 shadow-4"
					alt="" />
				</div>
				</div>
			</div>
		<!-- Jumbotron -->
		</section>

		<?php }
		else {
			print ("erreur !!<br>");
			print ("utilisation anormale de la vueConnexion");
		} ?>
	</body> 
</html> 