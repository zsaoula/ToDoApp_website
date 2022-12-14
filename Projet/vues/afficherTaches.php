<html>
	<head>
		<title>Connexion</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/mdb.min.css" />
	</head>
	<body>
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
	<div class="pb-2 w-50 ">
              <div class="card">
                <div class="card-body">
                  <form class="d-flex flex-row align-items-center" method="post">
                    <input type="text" class="form-control form-control-lg" name="nomTache" id="exampleFormControlInput1"
                      placeholder="Nom">
                    <div>
                      <input type="submit" class="btn btn-primary" value="Ajouter">
                    </div>
					<input type="hidden" name="action" value="ajoutListeTache">
				   </form>
                </div>
              </div>
            </div>
		<!-- <?php
			// foreach($listesTachesPublic as $listes)
			// {
			// 	echo $listes->getNom();
			// 	foreach($listes->getTaches() as $tache)
			// 	{
			// 		echo $tache->getNom();
			// 		echo $tache->getCreationTache();
			// 		echo $tache->getTerminer();
			// 	}

			// }
		?> -->
		<?php foreach($listesTachesPublic as $listes){ ?>
		<section class="">
			<div class="container py-5">
				<div class="row d-flex justify-content-center align-items-center">
				<div class="col-md-12 col-xl-10">

					<div class="card">
					<div class="card-header p-3">
						<h5 class="mb-0"><i class="fas fa-tasks me-2"></i>
						<?php echo $listes->getNom();?>
					</h5>
					</div>
						<div class="card-body" data-mdb-perfect-scrollbar="true" style="position: relative">

							<table class="table mb-0">
							<thead>
								<tr>
								<!-- <th scope="col">Team Member</th> -->
								<th scope="col">Task</th>
								<th scope="col">Actions</th>
								<th scope="col">Checked</th>
								<th scope="col"></th>
								</tr>
							</thead>
							<?php foreach($listes->getTaches() as $tache){ ?>
								<tbody>
									<tr class="fw-normal">
									<!-- <th>
										<img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp"
										class="shadow-1-strong rounded-circle" alt="avatar 1"
										style="width: 55px; height: auto;">
										<span class="ms-2">Alice Mayer</span>
									</th> -->
									<td class="align-middle">
										<span>
										<?php echo $tache->getNom(); ?>
										</span>
									</td>
									<td class="align-middle">
										<h6 class="mb-0"><span class="badge bg-danger">High priority</span></h6>
									</td>
									<td class="align-middle">
										<form method="post">
											<?php //var_dump($tache->getChecked()) ;
											
											if(($tache->getChecked()) == 1){
												echo '<input type="checkbox" checked="true" name="tacheAlreadyChecked'. $tache->getId(). '" value="' .$tache->getId(). '"></input>';
											}
											else {
												echo '<input type="checkbox" name="tacheChecked'. $tache->getId(). '" value="' .$tache->getId(). '"></input>';
											}?>
										<!-- <input type="checkbox" name="tacheChecked" value="1">
									</input> -->
									<!-- </form>	 -->
									</td>
									<td class="align-middle">
										<a href="#!" class="text-info" data-mdb-toggle="tooltip" title="Edit todo">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
  												<path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
											</svg>
										</a>
                  						<a name="idSup" type="submit" href="index.php?action=supprimerTache&idTache=<?php echo $tache->getId();?>" class="text-danger" data-mdb-toggle="tooltip" title="Delete todo">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  												<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  												<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
											</svg>
										</a>
									</td>
									</tr>
								</tbody>
								<?php }
								// $idListe=$listes->getId();
								?>
							</table>
							<input type="hidden" name="listeTache" value="<?php echo $listes->getId(); ?>"/>
							<input type="hidden" name="action" value="checkTache"/>
							<input type="submit" class="btn btn-primary" value="Confirmer Tache Check"/>
							</form>
						</div>
					<div class="card-footer text-end p-3">
						<a class="me-2 btn btn-link" name="idSupListe" type="submit" href="index.php?action=supprimerListeTache&id=<?php echo $listes->getId();?>" >Cancel</a>
						<!-- Button -->
						<form class="d-flex flex-row align-items-center" method="post">
											
                    						<input type="text" class="form-control form-control-lg" name="nameTache" id="exampleFormControlInput1"
                      						placeholder="Nom">
											
											  <input type="date" class="form-control form-control-lg" name="dateTache" id="exampleFormControlInput1"
                      						placeholder="Date">
											  <input type="hidden" class="form-control form-control-lg" name="listeTache" value="<?php echo $listes->getId(); ?>" id="exampleFormControlInput1"
                      						placeholder="Liste">

                    				<div>
                     					 <input type="submit" class="btn btn-primary" value="Ajouter">
                    				</div>
										<input type="hidden" name="action" value="ajoutTache">
				   					</form>

						<!-- <button type="button" class="btn btn-primary">Ajouter Tache</button> -->
						<!-- Pop-up -->
						
							</div>			
						</div>
					</div>
					</div>
				</div>
				</div>
			</div>
		</section>
		<?php }?>
	</body> 
</html> 