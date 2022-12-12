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
										<?php echo $tache->getNom() ?>
										</span>
									</td>
									<td class="align-middle">
										<h6 class="mb-0"><span class="badge bg-danger">High priority</span></h6>
									</td>
									<td class="align-middle">
										<!-- <a href="#!" data-mdb-toggle="tooltip" title="Done"><i
											class="fas fa-check text-success me-3"></i></a>
										<a href="#!" data-mdb-toggle="tooltip" title="Remove"><i
											class="fas fa-trash-alt text-danger"></i></a> -->
									</td>
									</tr>
								</tbody>
								<?php }
								$idListe=$listes->getId();
								?>
							</table>
							
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