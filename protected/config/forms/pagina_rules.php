<?php

//rules for create Post form
return array(
        'titulo' => array(
           array( 'required', 'El campo título es requerido.' )
        ),
       'descripcion' => array(
           array( 'required', 'El campo contenido es requerido' )
        )
    );
?>