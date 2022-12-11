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
		<div align="center">


		<?php
			if (isset($dVueEreur) && count($dVueEreur)>0) {
			echo "<h2>ERREUR !!!!!</h2>";
			foreach ($dVueEreur as $value){
				echo $value;
			}}
		?>
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
		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos vero quis optio similique maxime distinctio facere tempore minus nihil laboriosam illum perferendis dignissimos, ipsa sapiente vitae magni amet libero cum?
		Odio libero modi officiis vel commodi, accusamus aperiam, magni, amet molestiae neque a. Corrupti sed cumque, accusamus cum qui ea dolorem aspernatur explicabo itaque similique, ducimus rem beatae, aliquam sunt.
		Ipsam ratione, blanditiis reiciendis quaerat provident ullam facilis, cupiditate nemo cumque doloremque sint soluta placeat maxime expedita cum fugiat nisi! Asperiores ipsam inventore incidunt modi aliquam impedit sit id eos.
		Mollitia ad accusamus necessitatibus, ex aperiam libero corrupti dolorem harum similique consequatur in. Ad esse suscipit eius sit illum aut! Consequatur, accusamus? Iste, doloribus. Magnam voluptates porro itaque atque. Recusandae!
		Optio adipisci inventore delectus enim corporis fugiat? Exercitationem illum, alias repellendus ab aspernatur nemo architecto mollitia quasi voluptas maxime! Voluptatum deserunt veniam quibusdam excepturi a, eum ipsa fugit praesentium mollitia.
		Dignissimos aliquam sunt consequatur laudantium eaque voluptatem quo fuga. Incidunt et dicta atque, a debitis nam animi, possimus impedit totam, quisquam mollitia placeat. Nam numquam, aspernatur beatae ducimus unde fugit.
		Quibusdam pariatur quas provident aliquid dolorum repudiandae dolores, ad mollitia possimus totam illo ipsa nesciunt ullam minus amet consectetur sapiente at? Id quasi amet iusto voluptatum magni quos voluptatibus repellat.
		Quis doloremque labore molestiae corporis omnis culpa. Aliquam quos, quod repellat repudiandae commodi ad quidem odio maiores sequi cum quia. Eos numquam accusamus accusantium reprehenderit quaerat? Ullam odit cupiditate obcaecati!
		Rerum assumenda doloremque architecto provident corporis est reprehenderit quo laudantium magni eligendi nostrum adipisci velit molestiae deserunt molestias, ipsam culpa incidunt, sint repudiandae in aut, nulla odio. Iusto, quae autem.
		Consequatur consequuntur, repellat aspernatur harum cupiditate velit hic, dolor facilis enim, dignissimos quia praesentium ipsam similique obcaecati provident optio repellendus. Sapiente adipisci quia nisi, soluta eligendi ex culpa eos modi.
		Ipsum illo molestias, minima sunt tenetur debitis saepe nisi a quaerat qui tempora corporis, soluta dolore dignissimos nesciunt obcaecati laborum eligendi modi magni tempore possimus rem iusto quas! Commodi, ut?
		Nostrum corrupti, odit quas adipisci quaerat minima asperiores obcaecati nemo blanditiis laboriosam sed, pariatur voluptate magnam laudantium ipsum ipsam sapiente culpa molestiae perspiciatis minus! Animi quisquam delectus fugit vero et?
		Exercitationem consequuntur dolorem nemo reiciendis accusantium! Magni ullam beatae voluptatibus consequatur sapiente natus odit sint soluta. Laudantium, alias iure corrupti veritatis dolorum magnam odit enim ab iusto, maiores consequatur. Iste.
		Veniam iure optio aliquid adipisci, omnis hic maiores culpa quod! Aliquid esse excepturi velit labore provident iusto molestiae pariatur ad, delectus eos impedit, suscipit saepe, consectetur in et eveniet veniam?
		Qui nostrum tempora similique molestiae officiis, aspernatur possimus, quibusdam cum, placeat autem optio minus minima incidunt? Laborum eligendi cum excepturi, tenetur officiis, distinctio sint, inventore dolores iusto dolorem sed nemo!
		Cupiditate quam incidunt nihil vero doloremque quos praesentium accusamus nam delectus nobis. Placeat quas quis est non aperiam. Quis, consequuntur nihil. Temporibus ipsa ipsam placeat fuga consequuntur sint consectetur laborum.
		Voluptatum ut nihil dolorem porro adipisci esse, ab molestiae necessitatibus mollitia laudantium eligendi quod ad id unde, nam facere deserunt, nemo dolor? Labore iusto quasi, illum eaque quisquam voluptates eius?
		Perspiciatis temporibus ratione maiores quod, tempora quidem et cumque beatae expedita deleniti incidunt perferendis earum explicabo consequuntur vitae quas officiis quasi quia veritatis voluptatum repellendus nulla, dolorem porro atque. A?
		Vel, culpa sunt error commodi doloribus voluptates officiis voluptatibus, harum enim accusamus pariatur asperiores, aliquam odit magni? Deleniti perferendis at blanditiis illo expedita ipsa iste, odio quisquam voluptatem consequatur ipsum!
		Soluta praesentium incidunt odit ab quod, amet repellendus iure deserunt maiores doloremque sunt reprehenderit cupiditate. Alias illum earum explicabo corporis adipisci voluptatibus beatae, excepturi temporibus, delectus commodi optio nemo unde!</p>

		<?php }
		else {
			print ("erreur !!<br>");
			print ("utilisation anormale de la vueConnexion");
		} ?>
	</body> 
</html> 