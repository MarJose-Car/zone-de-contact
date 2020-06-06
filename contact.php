<?php

<?php require_once "inc/connect.php"; 
    require_once "inc/header.php";

// var_dump($_POST);

$errors = [];
$emails = ['mariajose1974@msn.com'];
if(!array_key_exists('name', $_POST) || $_POST['name'] == '') {
  $errors['name'] = "Vous n'avez pas rempli votre nom";
}
if(!array_key_exists('email', $_POST) || $_POST['email'] == '' || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
  $errors['email'] = "Votre email n'est pas valide";
}
if(!array_key_exists('message', $_POST) || $_POST['message'] == '') {
  $errors['message'] = "Vous n'avez pas rempli votre Message";
}
if(!array_key_exists('hid', $_POST) || $_POST['hid'] == '') {
  $errors['hid'] = "Vous n'avez pas rempli votre nom";
}
// session_start();

if(!empty($errors)) {
  $_SESSION['errors'] = $errors;
  $_SESSION['inputs'] = $_POST;

  // header('location:index.php');

} else {
  $_SESSION['success'] = 1;

  $to = "mariajose1974@msn.com";
  $sujet = $_POST['name']. "a contacté le site";

  $msg = '<html><head><title>Maria Portfolio</title></head></body>';
  $msg .= '<p>Bonjour</p>';
  $msg .= '<p><strong>Nom:'.$_POST['name'].'</p>';
  $msg .= '<p><strong>Email:'.$_POST['email'].'</p>';
  $msg .= '<p><strong>Message:'.$_POST['message'].'</p>';
  $msg .= '<p><strong>Message:'.$_Server['REMOTE_ADDR'].'</p>';
  $msg .= '<p><strong>Message:'.$_Server['HTTP_USER_AGENT'].'</p>';
  $msg .= '</body></html>';

  $header = 'MIME-version:1.0'."\r\n";
  $header = 'content-type:text/html; charset=iso-8859-1'."\r\n";
  $header = "From:mariajose1974@msn.com \n";
  $header = 'Reply-to :' .$_POST['email'];

  mail($to, $sujet, $msg, $header);

  // header('location:index.php');

}
// var_dump($errors);
  ?>

  <h2>Contactez moi</h2>

  <?php if (array_key_exists('success', $_SESSION)): ?>

      <div class="alert alert-success">
        Votre message a été envoyé !
      </div>

    <?php endif;?>

    <div class="contact-form">
      <form id="contact-form" method="post" action="contact.php">
        <input required name="name" type="text" class="form-control" placeholder="Votre Nom" value="<?=isset($_SESSION['inputs']['name']) ? $_SESSION['inputs']['name']:'';?>">
        <span><?= isset($_SESSION['errors']['name']) ? '<span class="alert-danger">'.$_SESSION['errors']['name'].'</span>':'';?></span>
        <br>
        <input required name="email" type="email" class="form-control" placeholder="Votre Email"value="<?=isset($_SESSION['inputs']['email']) ? $_SESSION['inputs']['email']:'';?>">
        <span><?= isset($_SESSION['errors']['email']) ? '<span class="alert-danger">'.$_SESSION['errors']['email'].'</span>':'';?></span>
        <br>
        <textarea required name="message" class="form-control" placeholder="Votre message" row="4" value="<?=isset($_SESSION['inputs']['message']) ? $_SESSION['inputs']['message']:'';?>"></textarea><br>

        <span><?= isset($_SESSION['errors']['message']) ? '<span class="alert-danger">'.$_SESSION['errors']['message'].'</span>':'';?></span>
        
        <div. class="contact-form">
          <input type="hidden" name="hid" class="form-control">


        <input type="submit" class="for-control submit" value="Envoyer Message">
      </form>
      <h3>Debug</h3>
      
     
    </div>

<?php
unset($_SESSION['errors']);
unset($_SESSION['inputs']);
unset($_SESSION['success']);

require_once "inc/footer.php";
?>

?>
