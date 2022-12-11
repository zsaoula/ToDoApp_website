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
		<div align="center">

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
		<h2>Personne - formulaire</h2>
		<hr>
		<!-- affichage de donn�es provenant du mod�le --> 
		<!-- <?= $dVue['data']  ?> -->


		<form method="post" name="myform" id="myform">
		<table> <tr>
		<td>Nom</td>
		<td><input name="txtNom" value="<?= $dVue['nom']  ?>" type="text" size="20"></td>
		</tr>
		<tr><td>Email</td>
		<td><input name="txtEmail" value="<?= $dVue['email'] ?>" type="text" size="3" required></td>
		</tr>
		<tr><td>Mot De Passe</td>
			<td><input name="txtMdp" value="<?= $dVue['mdp'] ?>" type="text" size="3" required></td>
		</tr>
		<tr>
		</table>
		<table> <tr>
		<td><input type="submit" value="Envoyer"></td>
		<td><input type="button" value="Effacer" onclick="clearForm(this.form);">
		</td> </tr> </table>

		<!-- action !!!!!!!!!! --> 
		<input type="hidden" name="action" value="validationFormulaire">
		</form></div>

		<?php }
		else {
			print ("erreur !!<br>");
			print ("utilisation anormale de la vueConnexion");
		} ?>
	</body> 
</html> 