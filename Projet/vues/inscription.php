<html>
	<head>
		<title>Connexion</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		</script>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg  bg-white border border-2 border-top-0 border-end-0 border-start-0 border-primary navbar-white p-4 shadow rounded position-sticky fixed-top">
			<div class="container">
				<a class="navbar-brand" href="#">TODO List</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
								<a class="btn  ms-3 btn-outline-primary" href="index.php?action=connexion" type="submit">Connexion</a>
								<a class="btn btn-primary ms-3" href="index.php?action=inscription" type="submit">Inscription</a>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>
		<!-- Section: Design Block -->
		<section class="justify-content-center d-flex py-3">
			<div class="card">
				<div class="card-body p-5 pb-1 shadow-5 text-center">
					<h2 class="fw-bold mb-5">Inscription</h2>
					<form method="post">

						<!-- Email input -->
						<div class="form-groupe mb-4">
							<input type="text" name="nom" class="form-control " placeholder="Nom" <?php if (isset($nom)) { echo 'value="'.$nom.'"';}  ?>/>
							<?php if(isset($dVueEreur['nom'])){?>
								<p class="p-0 m-0 text-danger"><?php echo $dVueEreur['nom']?> </p>
							<?php }?>
						</div>

						<!-- Email input -->
						<div class="form-groupe mb-4">
							<input type="text" name="email" id="email" class="form-control" placeholder="Email" <?php if (isset($email)) { echo 'value="'.$email.'"';}  ?>/>
							<?php if(isset($dVueEreur['email'])){?>
								<p class="p-0 m-0 text-danger"><?php echo $dVueEreur['email']?> </p>
							<?php }?>
						</div>

						<!-- Password input -->
						<div class="form-outline mb-4 ">
							<input type="password" name="mdp" class="form-control m-0" placeholder="Mot de passe" <?php if (isset($mdp1)) { echo 'value="'.$mdp1.'"';}  ?>/>
							<?php if(isset($dVueEreur['mdp1'])){?>
								<p class="p-0 m-0 text-danger"><?php echo $dVueEreur['mdp1']?> </p>
							<?php }?>
						</div>

						<!-- Password input -->
						<div class="form-outline mb-4 ">
							<input type="password" name="mdp2" class="form-control m-0" placeholder="Mot de passe" <?php if (isset($mdp2)) { echo 'value="'.$mdp2.'"';}  ?>/>
							<?php if(isset($dVueEreur['mdp2'])){?>
								<p class="p-0 m-0 text-danger"><?php echo $dVueEreur['mdp2']?> </p>
							<?php }?>
						</div>

						<!-- Submit button -->
						<button type="submit" class="btn btn-primary btn-block mb-4">
							S'inscrire
						</button>

						<input type="hidden" name="action" value="validationFormulaireI">
				
						<?php if(isset($dVueEreur['all'])){?>
							<p class="p-0 m-0 text-danger"><?php echo $dVueEreur['all']?> </p>
						<?php }?>
					</form>
				</div>
			</div>
		</section>
	</body> 
</html> 