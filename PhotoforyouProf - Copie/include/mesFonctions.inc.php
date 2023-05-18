<?php

function generationEntete(string $titre, string $sous_titre): string
{
  // Voir pour le traitement si besoins des chaines
  return
    <<<HTML
      <div class="py-5 text-center">
          <img class="d-block mx-auto mb-2" src="images/logo.png" alt="logo photoforyou" width="170" height="115">
          <h1 class="display-5">$titre</h1>
          <p class="lead">$sous_titre</p>
    </div>
    HTML;
}

// Pour le chargement automatique des classes
function chargerClasse($classname)
{
  require 'classes/'.$classname.'.class.php';
}

spl_autoload_register('chargerClasse');