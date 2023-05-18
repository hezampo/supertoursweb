<?php

//rules for create Post form
return array(
        'tipo_credito' => array(
           array( 'required', 'El campo tipo credito es requerido.' )
        ),

        'tasa_anual' => array(
           array( 'required', 'El campo tasa anual es requerido' ),
           array( 'float', '4','El campo tasa anual debe ser un numero decimal' )
        ),
    
        'plazo_maximo' => array(
           array( 'required', 'El campo plazo maximo es requerido' ),
           array( 'integer','El campo plazo maximo debe ser un numero entero' )
        ),
    
        'descripcion' => array(
           array( 'required', 'El campo descripcion es requerido.' )
        ),

    );
?>