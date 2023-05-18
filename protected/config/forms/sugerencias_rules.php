<?php
//rules for create Post form
return array(
       
        'email' => array(
           array('email','El campo correo electrónico no es un email valido'),
           array('required','El campo correo electrónico es requerido')
        ),

       'asunto' => array(
           array('required','El campo asunto es requerido')
        ),

       'mensaje' => array(
           array('required','El campo mensaje es requerido')
        )

    );
?>
