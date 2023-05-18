<?php

//rules for create Post form
return array(
        'nombre' => array(
           array( 'required', 'El campo nombre es requerido.' )
        ),

        'ciudad' => array(
           array( 'required', 'El campo ciudad es requerido' ),
        ),

        'telefono' => array(
           array( 'required', 'El campo teléfono es requerido' )
        ),

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