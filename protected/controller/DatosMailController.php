<?php

Doo::loadController('I18nController');
Doo::loadController('RecaptController');
Doo::loadHelper('class.phpmailer');

class DatosMailController extends DooController {

    public function datos() {
        $mail = new PHPMailer(false);
        $mail->IsSMTP();
        $mail->Host = "smtpout.secureserver.net";
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";
        $mail->SMTPAuth = true;
        
        $correo_emisor = "henry@supertours.com";
        $nombre_emisor = "SuperTours";
        $contrasena = "Henry123";
        //$mail->SMTPDebug  = 2;
        //$mail->SMTPSecure = "tsl";
        
        $mail->Username = $correo_emisor;
        $mail->Password = $contrasena;
        
        
        //$mail->AddReplyTo($correo_emisor, $nombre_emisor);
        $mail->SetFrom("no_reply@supertours.com", $nombre_emisor);
        $mail->Subject = 'Reservations SuperTours';
        $mail->AltBody = 'Reservations SuperTours';
        $mail->AddAddress("reservations@supertours.com", "SuperTours");
        $mail->AddBCC("arturo@supertours.com", "SuperTours");
        $mail->AddBCC("arbusmad2021@gmail.com", "SuperTours");
        //$mail->IsHTML(true);
        
        
        return $mail;
    }

}
