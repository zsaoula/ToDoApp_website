<html>
	<head>
		<title>Connexion</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<!-- MDB icon -->
		<link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
		<!-- Google Fonts Roboto -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
		<!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />
	</head>
	<body>
		<div align="center">
		<form methode="">
			<button type="submit">
				Passer la connexion
			</button>
			<input type="hidden" name="action" value="afficherTaches">
		</form>
		<form methode="">
			<button type="submit">
				Inscription
			</button>
			<input type="hidden" name="action" value="inscription">
		</form>
		<h2>Personne - formulaire</h2>
		<hr>
		<!-- affichage de donn�es provenant du mod�le --> 
		<!-- <?= $dVue['data']  ?> -->


		<form method="post" name="formulaireAjoutList" id="myform">
			<p>Nom</p>
			<input name="txtNom" value="<?= $dVue['nom']  ?>" type="text" size="20">
			<p>>Son type</p>
			<input type="radio" id="private" value="private">
			<label for="html">HTML</label>
			<input type="radio" id="public"  value="public">
			<label for="css">CSS</label><br>
		
			<input type="submit" value="Envoyer">
			
			<input type="button" value="Effacer" onclick="clearForm(this.form);">

		<!-- action !!!!!!!!!! --> 
		<input type="hidden" name="action" value="validationFormulaire">
		</form></div>
		<?php
			foreach($listesTachesPublic as $listes)
			{
				echo $listes->getNom();
				foreach($listes->getTaches as $tache)
				{
					echo $tache->getNom();
					echo $tache->getCreationTache();
					echo $tache->getCreationTache();
				}

			}
		?>
	</body> 
</html> 