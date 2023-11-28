<?php

$nombreemail = "Contacto Promontax"; 
$CorreoPrincipal = "promontax.andamios@gmail.com";
$CorreoCopia1= "mieresduarte@gmail.com";
//$CorreoCopia2 = "ventas@contenedoresaustral.cl";
//$CorreoCopia3 = "ventas@contenedoresaustral.cl";


$betreffEmail = "CONTACTO PROMONTAX";
$gracias = "http://promontax.cl/gracias.html";


  require "PHPMailer-5.2-stable/PHPMailerAutoload.php";
  
/*$captcha;*/
$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify'; 
$recaptcha_secret = '6LdP0B4pAAAAAASmBmga9qLvyY6qt4VjIUgsJcwG'; 
$recaptcha_response = $_POST['recaptcha_response']; 
$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
$recaptcha = json_decode($recaptcha);




        $ip = $_SERVER['REMOTE_ADDR'];

        
          if($recaptcha->score > 0.5){

                  date_default_timezone_set("America/Chile");
                  $datum = date("d.m.Y H:i");
                  $_POST = array_map('strip_tags', $_POST);

                  $inhaltEmail = $betreffEmail.":
                      Enviado: $datum Hrs
                      Nombre: " . $_POST["name"] . "
                      Dirección: " . $_POST["address"] . "
                      Telefono: " . $_POST["phone"] . "
                      E-Mail: " . $_POST["email"] . "
  
                      Mensaje: " . $_POST["message"] . "
                  ";
                  // Instanz und Zeichenkodierung setzen
                  $mail = new PHPMailer();
                  $mail->CharSet = "UTF-8";


                  $mail->setFrom($_POST["email"], $_POST["name"]);
                  $mail->addAddress($CorreoPrincipal, $nombreemail);

                  if(isset($CorreoCopia1)){
                  	$mail->addAddress($CorreoCopia1);
                  }

				  if(isset($CorreoCopia2)){
                    $mail->addAddress($CorreoCopia2);
                  }

				  if(isset($CorreoCopia2)){
                    $mail->addAddress($CorreoCopia3);
                  }

                  $mail->Subject = $betreffEmail;
                  $mail->Body = $inhaltEmail;

                  // E-Mail versenden
                  if ($mail->Send()) {
                      header("Location: " . $gracias);
                  }
                  else {
                      header("Location: " . $error);
                      }
        }else{
            echo '<h2>Hay un Problema con tu correo favor escribenos al E-MAil: '.$CorreoPrincipal.'</h2>';
        }

        ?>