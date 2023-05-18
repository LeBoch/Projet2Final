<?php
include ('include/initializer.inc.php');
include ("include/entete.inc.php");



$UsersManagers = new UserManager($db);

if (isset($_POST['Envoie'])){

    if(!isset($_POST['Credit'])){

        echo "Completez le champs";


      }   else {
        $user = $UsersManagers->getById($_SESSION['Id']);
        $creditToAdd = (int)$_POST['Credit'];
        $oldCredit = $user->getCredit();
        $newCredit = $oldCredit + $creditToAdd;
        
        $UsersManagers->UpdateCredit($user,$newCredit);

}

}     

?>



<?php 


$user = $UsersManagers->getById($_SESSION['Id']);
$credit = $user->getCredit();?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Mon Crédit : <?php echo $credit; ?> Jetons</h4>

        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
    <div class="py-5 text-center">
        
        <h2>Checkout form</h2>
        <p class="lead">Veuillez continués pour vous ajouté des crédits</p>
    </div>
    <div class="row">
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation" action="" method="post" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                      
                        <label for="firstName">Nom</label>
                        <input type="text" class="forms-control" id="firstName" placeholder="" required>
                        <div class="invalid-feedback">Votre nom est requis </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Prenom</label>
                        <input type="text" class="form-control" id="lastName" placeholder="" required>
                        <div class="invalid-feedback"> Votre prénom est requis </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="username">Pseudo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" id="username" placeholder="Username" required>
                        <div class="invalid-feedback" style="width: 100%;"> Pseudo requis </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email">Email <span class="text-muted"></span></label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com">
                    <div class="invalid-feedback"> Entrée un email si vous voulez le suivis de la commande </div>
                </div>
                <div class="mb-3">
                    <label for="address">Adresse</label>
                    <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                    <div class="invalid-feedback"> Entrez votre adresse postale </div>
                </div>
                <div class="mb-3">
                    <label for="address2">Crédit</label>
                    <input type="text" class="form-control"  name="Credit" placeholder="Choissisez le crédit que vous voulez" required>
                    <div class="invalid-feedback">Entrée le nombre de crédit que vous souhaitez</div>
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Pays</label>
                        <select class="custom-select d-block w-100" id="country" required>
                            <option value="">Choissisez</option>
                            <option>France</option>
                        </select>
                        <div class="invalid-feedback"> Selectionnée un pays  </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">Ville</label>
                        <select class="custom-select d-block w-100" id="state" required>
                            <option value="">Choissisez</option>
                            <option>Carcassonne</option>
                            <option>Paris</option>
                            <option>Lyon</option>
                            <option>Toulouse</option>
                        </select>
                        <div class="invalid-feedback">Choissisez une ville valide </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" placeholder="" required>
                        <div class="invalid-feedback">Code postal requis</div>
                    </div>
                </div>
                <hr class="mb-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="same-address">
                    <label class="custom-control-label" for="same-address">L'adresse de facturation est confirmé</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="save-info">
                    <label class="custom-control-label" for="save-info">Sauvegardé vos informations pour la prochaine fois </label>
                </div>
                <hr class="mb-4">
                <h4 class="mb-3">Payment</h4>
                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                        <label class="custom-control-label" for="credit">Carte Banciare</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                        <label class="custom-control-label" for="debit">Carte Cadeaux</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                        <label class="custom-control-label" for="paypal">PayPal</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name">Nom sur la carte</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="" required>
                        <small class="text-muted">Nom complet de la carte</small>
                        <div class="invalid-feedback"> Nom de la carte requis</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Chiffre de la carte</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="" required>
                        <div class="invalid-feedback"> Numéros de la carte requis</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Expiration</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                        <div class="invalid-feedback">Date de l'expiration de la carte</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-cvv">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                        <div class="invalid-feedback"> CCV </div>
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit" name="Envoie">Appuyer pour validé la commande de jetons</button>
            </form>
        </div>
    </div>
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">© 2017-2019 Company Name</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
</div>
<script>

(function () {
  'use strict'

  window.addEventListener('load', function () {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation')

    // Loop over them and prevent submission
    Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {
        if (form.checkValidity() === false) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  }, false)
}())

</script>


<?php
include ("include/piedDePage.inc.php");
?>