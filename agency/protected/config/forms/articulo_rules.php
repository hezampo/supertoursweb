<?php

//rules for create Post form
return array(
        'titulo' => array(
           array( 'required', 'El campo título es requerido.' )
        ),

        'fecha' => array(
           array( 'required', 'El campo fecha es requerido' ),
           array( 'date', 'yyyy-dd-mm','El campo fecha tiene un formato invalido' )
        ),

        'descripcion' => array(
           array( 'required', 'El campo descripción es requerido' )
        ),

        'intro' => array(
           array( 'required', 'El campo introducción es requerido' )
        )

    );
?>