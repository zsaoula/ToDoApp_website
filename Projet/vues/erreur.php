<html>
	<head>
		<title>Connexion</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Bootstrap -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  		<link rel="stylesheet" href="css/mdb.min.css" />
    </head>
    <body>

    <nav class="navbar navbar-expand-lg  bg-white border border-2 border-top-0 border-end-0 border-start-0 border-primary navbar-white p-4 shadow rounded position-sticky fixed-top">
			<div class="container">
				<a class="navbar-brand" >TODO List</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
                            <a class="btn btn-outline-primary" href="index.php?action=connexion" type="submit">Connexion</a>
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
								<a class="btn btn-outline-primary" href="index.php?action=deconnexion" type="submit">Deconnexion</a>
						<?php }
							else { ?>
								<a class="btn btn-outline-primary" href="index.php" type="submit">Connexion</a>
								<a class="btn btn-outline-primary ms-3" href="index.php?action=inscription" type="submit">Inscription</a>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>

        <?php
            foreach ($dVueEreur as $value){?>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    <p> <?php echo $value?></p>
                </div>
        <?php }?>
    </body> 
</html>