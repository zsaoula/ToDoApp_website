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
		<div align="center">

		<?php
			if (isset($dVueEreur) && count($dVueEreur)>0) {
			echo "<h2>ERREUR !!!!!</h2>";
			foreach ($dVueEreur as $value){
				echo $value;
			}}
		?>
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
		<td><input type="reset" value="Rétablir"></td>
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