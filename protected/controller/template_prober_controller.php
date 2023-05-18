<?php

Doo::loadController('I18nController');
Doo::loadHelper('class.phpmailer');
class template_prober_controller extends I18nController{
    public function index(){
        
        try {
        Doo::loadController('DatosMailController');
		$datosMail = new DatosMailController();
		$mail = new PHPMailer(true);
		$mail = $datosMail->datos();
			$mail->AddAddress('lmoncarisg@palmerasoft.com.co', 'Luis Moncaris');
        $mail->Subject = 'Reservations Super Tours OF Orlando';// Mensaje alternativo en caso que el destinatario no pueda abrir        // correos HTML
        $mail->AltBody = 'Reservations Super Tours OF Orlando'; // El cuerpo del mensaje, puede ser con etiquetas HTML
        $mail->MsgHTML("<strong>Prueba</strong>");
		$mail->Send();
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); // Errores de PhpMailer
        } catch (Exception $e) {
            echo $e->getMessage(); // Errores de cualquier otra cosa.
        }		
	
    }
}
?>