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
						<a class="nav-link" href="index.php?action=afficherTaches">Listes Publics</a>
						</li>
						<?php
							if(isset($_SESSION['login'])){ ?>
                        	<li class="nav-item">
								<a class="nav-link" href="index.php?action=afficherTachesPrivee">Listes Privées</a>
							</li>
						<?php } ?>
					</ul>
					<ul class="d-flex mb-lg-0">
						<?php
							if(isset($_SESSION['login'])){ ?>
                        		<button class="btn btn-outline-primary" href="index.php?action=deconnexion" type="submit">Deconnexion</button>
						<?php }
							else { ?>
								<a class="btn  btn-primary" href="index.php?action=connexion" type="submit">Connexion</a>
								<a class="btn btn-outline-primary ms-3" href="index.php?action=inscription" type="submit">Inscription</a>
						<?php } ?>
					</ul>
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
						<form method="post">
						<div class="form-groupe mb-4">
								<input type="email" name="email" id="email" class="form-control" placeholder="Email" <?php if (isset($email)) { echo 'value="'.$email.'"';}  ?>/>
								<?php if(isset($dVueEreur['email'])){?>
									<p class="p-0 m-0 text-danger"><?php echo $dVueEreur['email']?> </p>
								<?php }?>
								<!-- <label class="form-label">Email address</label> -->
							</div>
						<div class="form-outline mb-4 ">
								<input type="password" name="mdp" class="form-control m-0" placeholder="Password" <?php if (isset($mdp)) { echo 'value="'.$mdp.'"';}  ?>/>
								<?php if(isset($dVueEreur['mdp'])){?>
									<p class="p-0 m-0 text-danger"><?php echo $dVueEreur['mdp']?> </p>
								<?php }?>
							</div>

						<!-- Submit button -->
						<button type="submit" class="btn btn-primary btn-block mb-4">
							Sign up
						</button>

						<input type="hidden" name="action" value="validationFormulaire">
						<?php if(isset($dVueEreur['all'])){?>
								<p class="p-0 m-0 text-danger"><?php echo $dVueEreur['all']?> </p>
							<?php }?>
						<?php if(isset($dVueEreur['all2'])){?>
							<p class="p-0 m-0 text-danger"><?php echo $dVueEreur['all']?> </p>
						<?php }?>
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
	</body> 
</html> 