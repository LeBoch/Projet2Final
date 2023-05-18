<?php
include ('include/initializer.inc.php');
include ('include/entete.inc.php');
?>
	<div class="container text-center">
		<?php echo generationEntete("PhotoForYou", "Des pros au service des professionnels de la communication.")?>
		


<?php 
	if (isset ($_POST['envoi'])) {



	if (!isset($_POST['nom'])AND !isset($_POST['id_category'])) {


		

		echo "Completez tous les champs";

	} else {
		$uploaddir = __DIR__;
		$resteDuChemin = 'uploads/' . basename($_FILES['Chemin']['name']);
		$cheminComplet = $uploaddir . '/' . $resteDuChemin;
		move_uploaded_file($_FILES['Chemin']['tmp_name'], $cheminComplet);

		$photodonnées = [
			'Nom' =>htmlspecialchars($_POST['nom_photo']),
			'IdCategory' =>(int)($_POST['id_category']),
			'Chemin'=> $resteDuChemin,
			'IdProprietaire'=>(int)($_SESSION['Id'])
		];
	
		$photoMg = new PhotoManager($db);
		$photo = new Photo($photodonnées);
		$photoMg->add($photo);

		//$photo = $photoMg->SUPPRIMER($_GET['Id']);
	}


	}
	
		
?>




<form enctype="multipart/form-data" method="post">
    		

   		 <label for="formGroupExampleInput2">Nom photo</label>
    <input type="text" id="formGroupExampleInput2" name="nom_photo"><br>

    	<label for="formGroupExampleInput2">Id categories</label>
    <input type="text" id="formGroupExampleInput2" name="id_category"><br>

	<div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">Image</label>
        <input type="file" accept="image/png, image/jpeg" class="form-control" id="formGroupExampleInput2"    value="" name="Chemin">
    </div>








    <input type="submit" value="Vendre la photo" name="envoi">
</form>

	</div>
<?php include ("include/piedDePage.inc.php")?>