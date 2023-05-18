<?php
include ('include/initializer.inc.php');
include ('include/entete.inc.php');
?>
	<div class="container text-center">
		<?php echo generationEntete("PhotoForYou", "Des pros au service des professionnels de la communication.")?>

<?php
    if (isset ($_POST['envoi'])){


        if(!isset($_POST['nom']) || !isset($_POST['description'])){
        
            echo "Completez tous les champs";
        
        

        }else {
            $categoriesdonnées = [
                'nom'=>htmlspecialchars($_POST['nom']),
                'description'=>htmlspecialchars($_POST['description'])
            ];
            

            $CategorieMg = new CategorieManager($db);
            $categorie = new Categorie($categoriesdonnées);
            $CategorieMg->add($categorie);
        }
    }



?>





<form enctype ="multipart/form-data" method="post">
<div class="mb-3">
    <label for ="formGroupExampleInput2">Nom Categorie</label>
<input type="text" id="formGroupExampleInput2" name="nom"> <br>
</div>


    <div class="mb-3">
        <label for ="formGroupExampleInput2">description Categorie </label>
        <input type="text" id="formGroupExampleInput2" name="description"><br>
    </div>
            <input type="submit" value="Vendre la photo" name="envoi">
    </div>	

</form>

	</div>


<?php include ("include/piedDePage.inc.php")?>