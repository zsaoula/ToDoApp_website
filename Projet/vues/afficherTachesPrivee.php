<html>
	<head>
		<title>Connexion</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="css/mdb.min.css" />
  <style>
	/* Mise en forme du fond flouté */
    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 10;
      display: none;
    }

    /* Mise en forme du pop-up */
    .popup {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 600px;
      padding: 20px;
      background-color: #fff;
      z-index: 11;
      display: none;
    }

    /* Bouton pour fermer le pop-up */
    .close-button {
      position: absolute;
      top: 10px;
      right: 10px;
      cursor: pointer;
    }

    /* Mise en forme du contenu du pop-up */
    .popup-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .popup-content {
      font-size: 16px;
    }
	</style>
	</head>
	<body>
	<nav
			class="navbar navbar-expand-lg  bg-white border border-2 border-top-0 border-end-0 border-start-0 border-primary navbar-white p-4 shadow rounded position-sticky fixed-top">
			<div class="container">
				<a class="navbar-brand" >TODO List</a>
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
		
			<div class="d-flex justify-content-center m-2 p-2">
              <div class="card">
                <div class="card-body m-0">
                  <form class="d-flex flex-row align-items-center p-0 m-0" method="post">
                    <input type="text" class="form-control form-control-lg me-2" name="nomTache" id="exampleFormControlInput1"
                      placeholder="Nom">
                    <div>
                      <input type="submit" class="btn btn-primary" value="Ajouter">
                    </div>
					<input type="hidden" name="action" value="ajoutListeTachePrivee">
				   </form>
                </div>
              </div>
            </div>
		<?php foreach($listesTachesPrivee as $listes){ ?>
		<section class="t-0">
			<div class="container py-2 ">
				<div class="row d-flex justify-content-center align-items-center">
				<div class="col-md-12 col-xl-10">

					<div class="card">
					<div class="card-header p-3 d-flex justify-content-between align-items-center">
						<h5 class="mb-0"><i class="fas fa-tasks me-2"></i>
							<?php echo $listes->getNom();?>
						</h5>
						<div class="progress w-50">
  							<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
						</div>
					</div>
						<div class="card-body" data-mdb-perfect-scrollbar="true" style="position: relative">

							<table class="table mb-0">
							<thead>
								<tr>
									<th scope="col">Task</th>
									<th scope="col">Actions</th>
									<th scope="col">Checked</th>
									<th scope="col">Action</th>
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
										<h6 class="mb-0"><span class="badge bg-danger"><?php echo $tache->getPriorite(); ?></span></h6>
									</td>
									<td class="align-middle">
										<form method="post" class="p-0 m-0">
											<?php //var_dump($tache->getChecked()) ;
											
											if(($tache->getChecked()) == 1){
												echo '<input type="checkbox" checked="true" name="tacheAlreadyChecked'. $tache->getId(). '" value="' .$tache->getId(). '"></input>';
											}
											else {
												echo '<input type="checkbox" name="tacheChecked'. $tache->getId(). '" value="' .$tache->getId(). '"></input>';
											}?>
										<!-- <input type="checkbox" name="tacheChecked" value="1">
									</input> -->
									</td>
									<td class="align-middle">
										<button class="border-0  bg-white text-primary" data-mdb-toggle="tooltip" type="button" onclick="showPopupEdit('<?php echo $tache->getNom(); ?>','<?php echo $tache->getId(); ?>','<?php echo $tache->getPriorite(); ?>')"   title="Edit todo">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
  												<path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
											</svg>
										</button>
											<!-- Fond flouté-->
											<div class="overlay" id="overlayEdit"></div>

											<!--Pop-up-->
											<div class="popup" id="popupEdit">
												<div class="close-button" onclick="hidePopupEdit()">X</div>
												<div class="popup-title">Editer tâche</div>
												<div class="popup-content" id="popup-contentEdit"></div>
												<div>
												<form class="d-flex flex-row align-items-center" method="post">
											
                    						<input type="text" class="form-control form-control-lg" id="nomTache" name="nameTache"/>
                      						
											  
											<div>

											<form method="post" class="p-0 m-0">
												
											  <input type="hidden" class="form-control form-control-lg" name="idTache" id="idTache"/>
											  <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>
													Priorité:
												</h5>

													<div>
													<input type="radio" id="radioImportant" name="editPriorite" value="Important">
													<label>Important</label>
													</div>

													<div>
													<input type="radio" id="radioMoyen" name="editPriorite" value="Moyen">
													<label>Moyen</label>
													</div>

													<div>
													<input type="radio" id="radioFaible" name="editPriorite" value="Faible">
													<label>Faible</label>
													</div>
										</div>

                    				<div>
                     					 <input type="submit" class="btn btn-primary" value="Editer">
                    				</div>

									
										<input type="hidden" name="action" value="editerTache">
				   					</form>
												</div>	
												
											</div>
											<script>
												function showPopupEdit(nomTache,idTache,priorite) {
												// Afficher le fond flouté et le pop-up
												document.getElementById('overlayEdit').style.display = 'block';
												document.getElementById('popupEdit').style.display = 'block';
												document.getElementById('idTache').value=idTache;
												document.getElementById('nomTache').value=nomTache;
												var tache = document.getElementById('popup-contentEdit');
												tache.innerHTML=nomTache;
												if (priorite=="Important"){
													document.getElementById('radioImportant').checked=true;
												}
												if (priorite=="Moyen"){
													document.getElementById('radioMoyen').checked=true;
												}
												if (priorite=="Faible"){
													document.getElementById('radioFaible').checked=true;
												}
												
												}

												function hidePopupEdit() {
												// Masquer le fond flouté et le pop-up
												document.getElementById('overlayEdit').style.display = 'none';
												document.getElementById('popupEdit').style.display = 'none';
												}
											
											</script>
                  						<a data-mdb-toggle="tooltip"  href="index.php?action=supprimerTache&idTache=<?php echo $tache->getId();?>" title="Delete todo">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  												<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  												<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
											</svg>
										</a>
									</td>
									</tr>
								</tbody>
								<?php }
								?>
							</table>
							<input type="hidden" name="listeTache" value="<?php echo $listes->getId(); ?>"/>
							<input type="hidden" name="action" value="checkTache"/>
							<input type="submit" class="btn btn-primary" value="Confirmer Tache Check"/>
							</form>
							
						</div>
						<div class="card-footer text-end p-3">
						<a class="me-2 btn btn-primary" name="idSupListe" type="submit" href="index.php?action=supprimerListeTache&id=<?php echo $listes->getId();?>" >Cancel</a>
									   <button class="me-2 btn btn-primary" onclick="showPopup('<?php echo $listes->getNom(); ?>','<?php echo $listes->getId(); ?> ')">Ajouter tâche</button>

											<!-- Fond flouté-->
											<div class="overlay" id="overlay"></div>

											<!--Pop-up-->
											<div class="popup" id="popup">
												<div class="close-button" onclick="hidePopup()">X</div>
												<div class="popup-title">Ajouter tâche</div>
												<div class="popup-content" id="popup-content"></div>
											<div>
											<form class="d-flex flex-row align-items-center" method="post">
											
                    						<input type="text" class="form-control form-control-lg" name="nameTache"
                      						placeholder="Nom">
											  
											<div>
												
											  <input type="hidden" class="form-control form-control-lg" name="listeTache" id="tacheListe">
											  <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>
													Priorité:
												</h5>

													<div>
													<input type="radio" name="ajoutPriorite" value="Important">
													<label>Important</label>
													</div>

													<div>
													<input type="radio" name="ajoutPriorite" value="Moyen">
													<label>Moyen</label>
													</div>

													<div>
													<input type="radio" name="ajoutPriorite" value="Faible">
													<label>Faible</label>
													</div>
										</div>

                    				<div>
                     					 <input type="submit" class="btn btn-primary" value="Ajouter">
                    				</div>

									
										<input type="hidden" name="action" value="ajoutTache">
				   					</form>
											</div>	
												
											</div>

											<script>
												function showPopup(nomListe,idListe) {
												// Afficher le fond flouté et le pop-up
												document.getElementById('overlay').style.display = 'block';
												document.getElementById('popup').style.display = 'block';
												var liste = document.getElementById('popup-content');
												liste.innerHTML=nomListe;
												document.getElementById('tacheListe').value=idListe;
												}

												function hidePopup() {
												// Masquer le fond flouté et le pop-up
												document.getElementById('overlay').style.display = 'none';
												document.getElementById('popup').style.display = 'none';
												}
											
											</script>
									
						
							</div>			
						</div>
					</div>
			</div>
		</section>
		<?php }?>
	</body> 
</html> 