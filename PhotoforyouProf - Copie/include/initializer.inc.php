<?php
  // Gestion de la session
  if (!isset($_SESSION))
  {
    session_start();
  }
  if (!isset($_SESSION['login']))
  {
    $_SESSION['login'] = False;
  }

  require_once ('connection.inc.php');
  require_once ('mesFonctions.inc.php');

  $manager = new UserManager($db);

  if (isset($_POST['deconnexion']))
  {
    session_unset ();
    session_destroy ();
    header('Location: index.php');
  }
?>