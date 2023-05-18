<?php
//rules for create Post form
return array(
       'email' => array(
           array('email','El campo correo electrónico no es un email valido'),
           array('required','El campo correo electrónico es requerido')
        ),
        'dtf' => array(
           array( 'required', 'El campo D.T.F  es requerido' ),
           array( 'float', '2','El campo D.T.F debe ser un numero decimal' )
        ),
     );
?>