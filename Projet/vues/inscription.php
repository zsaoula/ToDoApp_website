<html>
	<head>
		<title>Connexion</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
						<a class="nav-link" href="index.php?action=afficherTaches">Listes Publics</a>
						</li>
						<?php
							if(isset($_SESSION['login'])){ ?>
                        	<li class="nav-item">
								<a class="nav-link" href="index.php?action=afficherTachesPrivee">Listes Privées</a>
							</li>
						<?php } ?>
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
					<ul class="d-flex mb-lg-0">
						<?php
							if(isset($_SESSION['login'])){ ?>
                        		<button class="btn btn-outline-primary" href="index.php?action=deconnexion" type="submit">Deconnexion</button>
						<?php }
							else { ?>
								<a class="btn  ms-3 btn-outline-primary" href="index.php" type="submit">Connexion</a>
								<a class="btn btn-primary ms-3" href="index.php?action=inscription" type="submit">Inscription</a>
						<?php } ?>
					</ul>
					</div>
				</div>
			</nav>


		<?php
			if (isset($dVueEreur) && count($dVueEreur)>0) {
			echo "<h2>ERREUR !!!!!</h2>";
			foreach ($dVueEreur as $value){
				echo $value;
			}}
		?>
			<!-- Section: Design Block -->
		<section class="justify-content-center d-flex py-3">
				<div class="card">
					<div class="card-body p-5 pb-1 shadow-5 text-center">
						<h2 class="fw-bold mb-5">Sign up now</h2>
						<form method="post">
							<!-- 2 column grid layout with text inputs for the first and last names -->
							<!-- <div class="row">
								<div class="col-md-6 mb-4">
								<div class="form-outline">
									<input type="text"  name="name" class="form-control" />
									<label class="form-label" >First name</label>
								</div>
								</div>
								<div class="col-md-6 mb-4">
								<div class="form-outline">
									<input type="text" id="form3Example2" class="form-control" />
									<label class="form-label" for="form3Example2">Last name</label>
								</div>
								</div>
							</div> -->
							<!-- Name input -->
							<!-- <div class="form-outline mb-4">
								<input type="text" name="name" class="form-control" />
								<label class="form-label">Name</label>
							</div> -->

							<!-- Email input -->
							<div class="form-outline mb-4">
								<input type="text" name="name" class="form-control" />
								<label class="form-label">Name</label>
							</div>

							<!-- Email input -->
							<div class="form-outline mb-4">
								<input type="email" name="email" class="form-control" />
								<label class="form-label">Email address</label>
							</div>

							<!-- Password input -->
							<div class="form-outline mb-4 ">
								<input type="password" name="mdp" class="form-control m-0" placeholder="Password"/>
								<label class="form-label">Password</label>
							</div>

							<!-- Submit button -->
							<button type="submit" class="btn btn-primary btn-block mb-4">
								Sign up
							</button>

							<input type="hidden" name="action" value="validationFormulaireI">
						</form>
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