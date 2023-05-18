<?php
$valida = false;
if (isset($data["reserve"])) {
    $reserva = $data["reserve"];
} else {
    $valida = true;
}
if (isset($data['cliente'])) {
    $cliente = $data['cliente'];
}
if (isset($data['pickup'])) {
    $p = $data['pickup'];
}
if (isset($data['drop1'])) {
    $drop1 = $data['drop1'];
//print_r($drop1);
}
if (isset($data['pickup2'])) {
    $pickup2 = $data['pickup2'];
}
if (isset($data['drop2'])) {
    $drop2 = $data['drop2'];
}
if (isset($data['routes'])) {
    $routes = $data['routes'];
}
if (isset($data['routes2'])) {
    $routes2 = $data['routes2'];
//print_r($routes2);
}
$login = $_SESSION['login'];
?>

<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/autocompletar/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.10.3.custom.min.css" />

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ausu-autosuggest.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/Concurrent.Thread.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<!--<script type="text/javascript" src="https://www.jose-aguilar.com/scripts/jquery/jquery.js"></script>-->
<script type="text/javascript" src="https://www.jose-aguilar.com/scripts/jquery/mask/jquery.mask.js"></script>

<!--jquery para el calendario-->
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>

<script>
    $(document).ready(function () {
        $('.date').mask('11/11/1111');
        $('.time').mask('00:00:00');
        $('.date_time').mask('99/99/9999 00:00:00');
        $('.phone').mask('9999-9999');
        $('.phone_with_ddd').mask('(99) 99 999 99 99');
        $('.money').mask('0000.00', {reverse: true});
    });
</script>


<script type="text/javascript">
    var bPreguntar = true;

    window.onbeforeunload = preguntarAntesDeSalir;

    function preguntarAntesDeSalir()
    {
        if (bPreguntar)
            return "Salir de la ventana o actualizarla, generara un nuevo codigo de reserva.";
    }
</script>
<style type="text/css" media="screen">
    #search{
        cursor:pointer;
    }
    #reservation{
        width:300px !important;
    }

    #offer {
        position: absolute;
        margin-left: 10px;
        margin-top: 5px;
    }

    #content_page_tours {
        border: 1px solid #CCC;
        margin-top: 0px;
        margin-right: auto;
        margin-bottom: 20px;
        margin-left: auto;
        padding: 8px;
        width: 98.4%;
        float: left;
        clear: both;
        border-radius: 20px;

    }

    #selector {
        -moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
        -webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
        box-shadow:inset 0px 1px 0px 0px #ffffff;
        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf) );
        background:-moz-linear-gradient( center top, #ededed 5%, #dfdfdf 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf');
        background-color:#ededed;
        -moz-border-radius:6px;
        -webkit-border-radius:6px;
        border-radius:6px;
        border:1px solid #dcdcdc;
        display:inline-block;
        color:#777777;
        font-family:arial;
        font-size:11px;
        font-weight:bold;
        padding:6px;
        text-decoration:none;
        text-shadow:1px 1px 0px #ffffff;
    }
    .selector:hover {
        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed) );
        background:-moz-linear-gradient( center top, #dfdfdf 5%, #ededed 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed');
        background-color:#dfdfdf;
        cursor:pointer;
    }
    .selector:active {
        position:relative;
        top:1px;
    }
    #selectos{
        padding:0;
        margin:0;
    }
    input[type="radio"]{
        height: 15px;
        width: 15px;
    }

    .background {
        background: rgba(212,228,239,1);
        background: -moz-linear-gradient(-45deg, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
        background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(212,228,239,1)), color-stop(100%, rgba(134,174,204,1)));
        background: -webkit-linear-gradient(-45deg, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
        background: -o-linear-gradient(-45deg, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
        background: -ms-linear-gradient(-45deg, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
        background: linear-gradient(135deg, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d4e4ef', endColorstr='#86aecc', GradientType=1 );

    }
    .rojo{
        /* IE10+ */ 
        background-image: -ms-linear-gradient(bottom left, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%);

        /* Mozilla Firefox */ 
        background-image: -moz-linear-gradient(bottom left, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%);

        /* Opera */ 
        background-image: -o-linear-gradient(bottom left, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%);

        /* Webkit (Safari/Chrome 10) */ 
        background-image: -webkit-gradient(linear, left bottom, right top, color-stop(0, #260505), color-stop(75.5, #AC1B29), color-stop(100, #FFC7C7));

        /* Webkit (Chrome 11+) */ 
        background-image: -webkit-linear-gradient(bottom left, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%);

        /* W3C Markup */ 
        background-image: linear-gradient(to top right, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%); 
    }
    .cerati{
        /* IE10+ */ 
        background-image: -ms-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

        /* Mozilla Firefox */ 
        background-image: -moz-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

        /* Opera */ 
        background-image: -o-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

        /* Webkit (Safari/Chrome 10) */ 
        background-image: -webkit-gradient(linear, left bottom, right top, color-stop(0, #1E4D82), color-stop(51, #33449C), color-stop(75.5, #1B1478), color-stop(100, #E1E0FF));

        /* Webkit (Chrome 11+) */ 
        background-image: -webkit-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

        /* W3C Markup */ 
        background-image: linear-gradient(to top right, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);
    }

    .super{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#c5deea+0,8abbd7+29,0751b2+78 */
        background: rgb(197,222,234); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(197,222,234,1) 0%, rgba(138,187,215,1) 29%, rgba(7,81,178,1) 78%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(197,222,234,1) 0%,rgba(138,187,215,1) 29%,rgba(7,81,178,1) 78%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(197,222,234,1) 0%,rgba(138,187,215,1) 29%,rgba(7,81,178,1) 78%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c5deea', endColorstr='#0751b2',GradientType=0 ); /* IE6-9 */

    }

    .black{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#7d7e7d+0,0e0e0e+100;Black+3D */
        background: rgb(125,126,125); /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover,  rgba(125,126,125,1) 0%, rgba(14,14,14,1) 100%); /* FF3.6-15 */
        background: -webkit-radial-gradient(center, ellipse cover,  rgba(125,126,125,1) 0%,rgba(14,14,14,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: radial-gradient(ellipse at center,  rgba(125,126,125,1) 0%,rgba(14,14,14,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7d7e7d', endColorstr='#0e0e0e',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

    }

    .gris{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#000000+0,000000+100&0.65+0,0+100;Neutral+Density */
        background: -moz-linear-gradient(-45deg,  rgba(0,0,0,0.65) 0%, rgba(0,0,0,0) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(-45deg,  rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(135deg,  rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6000000', endColorstr='#00000000',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

    }
    .azul{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#1e5799+20,2989d8+50,1e5799+80&0+0,0.8+15,1+19,1+81,0.8+85,0+100;Blue+Two+Sided+Transparent */
        background: -moz-linear-gradient(top,  rgba(30,87,153,0) 0%, rgba(30,87,153,0.8) 15%, rgba(30,87,153,1) 19%, rgba(30,87,153,1) 20%, rgba(41,137,216,1) 50%, rgba(30,87,153,1) 80%, rgba(30,87,153,1) 81%, rgba(30,87,153,0.8) 85%, rgba(30,87,153,0) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(30,87,153,0) 0%,rgba(30,87,153,0.8) 15%,rgba(30,87,153,1) 19%,rgba(30,87,153,1) 20%,rgba(41,137,216,1) 50%,rgba(30,87,153,1) 80%,rgba(30,87,153,1) 81%,rgba(30,87,153,0.8) 85%,rgba(30,87,153,0) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(30,87,153,0) 0%,rgba(30,87,153,0.8) 15%,rgba(30,87,153,1) 19%,rgba(30,87,153,1) 20%,rgba(41,137,216,1) 50%,rgba(30,87,153,1) 80%,rgba(30,87,153,1) 81%,rgba(30,87,153,0.8) 85%,rgba(30,87,153,0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#001e5799', endColorstr='#001e5799',GradientType=0 ); /* IE6-9 */

    }

    .verde{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#d8e0de+0,aebfbc+22,99afab+33,8ea6a2+50,829d98+67,4e5c5a+82,0e0e0e+100;Grey+3D */
        background: rgb(216,224,222); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(216,224,222,1) 0%, rgba(174,191,188,1) 22%, rgba(153,175,171,1) 33%, rgba(142,166,162,1) 50%, rgba(130,157,152,1) 67%, rgba(78,92,90,1) 82%, rgba(14,14,14,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(216,224,222,1) 0%,rgba(174,191,188,1) 22%,rgba(153,175,171,1) 33%,rgba(142,166,162,1) 50%,rgba(130,157,152,1) 67%,rgba(78,92,90,1) 82%,rgba(14,14,14,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(216,224,222,1) 0%,rgba(174,191,188,1) 22%,rgba(153,175,171,1) 33%,rgba(142,166,162,1) 50%,rgba(130,157,152,1) 67%,rgba(78,92,90,1) 82%,rgba(14,14,14,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d8e0de', endColorstr='#0e0e0e',GradientType=0 ); /* IE6-9 */

    }

    .gris2{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f5f6f6+0,dbdce2+21,b8bac6+49,dddfe3+80,f5f6f6+100;Grey+Pipe */
        background: rgb(245,246,246); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(245,246,246,1) 0%, rgba(219,220,226,1) 21%, rgba(184,186,198,1) 49%, rgba(221,223,227,1) 80%, rgba(245,246,246,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(245,246,246,1) 0%,rgba(219,220,226,1) 21%,rgba(184,186,198,1) 49%,rgba(221,223,227,1) 80%,rgba(245,246,246,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(245,246,246,1) 0%,rgba(219,220,226,1) 21%,rgba(184,186,198,1) 49%,rgba(221,223,227,1) 80%,rgba(245,246,246,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f5f6f6', endColorstr='#f5f6f6',GradientType=0 ); /* IE6-9 */

    }

    .brown{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f3e2c7+0,c19e67+50,b68d4c+51,e9d4b3+100;L+Brown+3D */
        background: rgb(243,226,199); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(243,226,199,1) 0%, rgba(193,158,103,1) 50%, rgba(182,141,76,1) 51%, rgba(233,212,179,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(243,226,199,1) 0%,rgba(193,158,103,1) 50%,rgba(182,141,76,1) 51%,rgba(233,212,179,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(243,226,199,1) 0%,rgba(193,158,103,1) 50%,rgba(182,141,76,1) 51%,rgba(233,212,179,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f3e2c7', endColorstr='#e9d4b3',GradientType=0 ); /* IE6-9 */

    }

    .sky{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#7db9e8+66,1e5799+100&0.39+58,1+92 */
        background: -moz-linear-gradient(top,  rgba(125,185,232,0.39) 58%, rgba(125,185,232,0.53) 66%, rgba(52,110,172,1) 92%, rgba(30,87,153,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(125,185,232,0.39) 58%,rgba(125,185,232,0.53) 66%,rgba(52,110,172,1) 92%,rgba(30,87,153,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(125,185,232,0.39) 58%,rgba(125,185,232,0.53) 66%,rgba(52,110,172,1) 92%,rgba(30,87,153,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#637db9e8', endColorstr='#1e5799',GradientType=0 ); /* IE6-9 */

    }

    .orangered{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#e5361b+20,ed9017+95 */
        background: rgb(229,54,27); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(229,54,27,1) 20%, rgba(237,144,23,1) 95%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(229,54,27,1) 20%,rgba(237,144,23,1) 95%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(229,54,27,1) 20%,rgba(237,144,23,1) 95%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e5361b', endColorstr='#ed9017',GradientType=0 ); /* IE6-9 */

    }

    .redop{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#cd615b+44,cd615b+44,cd615b+60,cd615b+72,cd615b+72,cd615b+75,cd615b+75,cd615b+96,cd615b+96&1+0,0.39+78 */
        background: -moz-linear-gradient(top,  rgba(205,97,91,1) 0%, rgba(205,97,91,0.66) 44%, rgba(205,97,91,0.53) 60%, rgba(205,97,91,0.44) 72%, rgba(205,97,91,0.42) 75%, rgba(205,97,91,0.39) 78%, rgba(205,97,91,0.39) 96%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(205,97,91,1) 0%,rgba(205,97,91,0.66) 44%,rgba(205,97,91,0.53) 60%,rgba(205,97,91,0.44) 72%,rgba(205,97,91,0.42) 75%,rgba(205,97,91,0.39) 78%,rgba(205,97,91,0.39) 96%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(205,97,91,1) 0%,rgba(205,97,91,0.66) 44%,rgba(205,97,91,0.53) 60%,rgba(205,97,91,0.44) 72%,rgba(205,97,91,0.42) 75%,rgba(205,97,91,0.39) 78%,rgba(205,97,91,0.39) 96%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cd615b', endColorstr='#63cd615b',GradientType=0 ); /* IE6-9 */

    }

    .oliva{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#fcfff5+0,e0f0cc+40,abdb91+100 */
        background: rgb(252,255,245); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(252,255,245,1) 0%, rgba(224,240,204,1) 40%, rgba(171,219,145,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(252,255,245,1) 0%,rgba(224,240,204,1) 40%,rgba(171,219,145,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(252,255,245,1) 0%,rgba(224,240,204,1) 40%,rgba(171,219,145,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff5', endColorstr='#abdb91',GradientType=0 ); /* IE6-9 */

    }

    .oliva2{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#dbe3e5+0,6993a1+81 */
        background: rgb(219,227,229); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(219,227,229,1) 0%, rgba(105,147,161,1) 81%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(219,227,229,1) 0%,rgba(105,147,161,1) 81%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(219,227,229,1) 0%,rgba(105,147,161,1) 81%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#dbe3e5', endColorstr='#6993a1',GradientType=0 ); /* IE6-9 */

    }

    .oliveti{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f2f6f8+0,d8e1e7+50,b5c6d0+82,e0eff9+100 */
        background: rgb(242,246,248); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(242,246,248,1) 0%, rgba(216,225,231,1) 50%, rgba(181,198,208,1) 82%, rgba(224,239,249,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(242,246,248,1) 0%,rgba(216,225,231,1) 50%,rgba(181,198,208,1) 82%,rgba(224,239,249,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(242,246,248,1) 0%,rgba(216,225,231,1) 50%,rgba(181,198,208,1) 82%,rgba(224,239,249,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f6f8', endColorstr='#e0eff9',GradientType=0 ); /* IE6-9 */

    }

    .brown2{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f6dfb8+47,f6dfb8+76,e1ac51+94 */
        background: rgb(246,223,184); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(246,223,184,1) 47%, rgba(246,223,184,1) 76%, rgba(225,172,81,1) 94%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(246,223,184,1) 47%,rgba(246,223,184,1) 76%,rgba(225,172,81,1) 94%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(246,223,184,1) 47%,rgba(246,223,184,1) 76%,rgba(225,172,81,1) 94%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6dfb8', endColorstr='#e1ac51',GradientType=0 ); /* IE6-9 */

    }

    .brown3{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f6cbb8+47,f6cbb8+86,e17c51+94 */
        background: rgb(246,203,184); /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover,  rgba(246,203,184,1) 47%, rgba(246,203,184,1) 86%, rgba(225,124,81,1) 94%); /* FF3.6-15 */
        background: -webkit-radial-gradient(center, ellipse cover,  rgba(246,203,184,1) 47%,rgba(246,203,184,1) 86%,rgba(225,124,81,1) 94%); /* Chrome10-25,Safari5.1-6 */
        background: radial-gradient(ellipse at center,  rgba(246,203,184,1) 47%,rgba(246,203,184,1) 86%,rgba(225,124,81,1) 94%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6cbb8', endColorstr='#e17c51',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

    }

    .brown4{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f9e0cb+49,f9e0cb+49,f9e0cb+65,f9e0cb+69,f9e0cb+70,f9e0cb+74,e9b081+86,e9b081+86 */
        background: rgb(249,224,203); /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover,  rgba(249,224,203,1) 49%, rgba(249,224,203,1) 49%, rgba(249,224,203,1) 65%, rgba(249,224,203,1) 69%, rgba(249,224,203,1) 70%, rgba(249,224,203,1) 74%, rgba(233,176,129,1) 86%, rgba(233,176,129,1) 86%); /* FF3.6-15 */
        background: -webkit-radial-gradient(center, ellipse cover,  rgba(249,224,203,1) 49%,rgba(249,224,203,1) 49%,rgba(249,224,203,1) 65%,rgba(249,224,203,1) 69%,rgba(249,224,203,1) 70%,rgba(249,224,203,1) 74%,rgba(233,176,129,1) 86%,rgba(233,176,129,1) 86%); /* Chrome10-25,Safari5.1-6 */
        background: radial-gradient(ellipse at center,  rgba(249,224,203,1) 49%,rgba(249,224,203,1) 49%,rgba(249,224,203,1) 65%,rgba(249,224,203,1) 69%,rgba(249,224,203,1) 70%,rgba(249,224,203,1) 74%,rgba(233,176,129,1) 86%,rgba(233,176,129,1) 86%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f9e0cb', endColorstr='#e9b081',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

    }


    .verdefosf{
        background: rgba(230,227,225,0.45);
        background: -moz-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(230,227,225,0.45)), color-stop(25%, rgba(189,226,222,0.45)), color-stop(53%, rgba(142,224,219,1)), color-stop(87%, rgba(86,222,215,1)), color-stop(100%, rgba(87,126,224,1)));
        background: -webkit-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
        background: -o-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
        background: -ms-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
        background: linear-gradient(to bottom, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e6e3e1', endColorstr='#577ee0', GradientType=0 );
    }

    .booking1{        
        background: rgba(67,165,230,0.28);
        background: -moz-linear-gradient(top, rgba(67,165,230,0.28) 56%, rgba(67,165,230,0.82) 89%, rgba(210,255,82,1) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(56%, rgba(67,165,230,0.28)), color-stop(89%, rgba(67,165,230,0.82)), color-stop(100%, rgba(210,255,82,1)));
        background: -webkit-linear-gradient(top, rgba(67,165,230,0.28) 56%, rgba(67,165,230,0.82) 89%, rgba(210,255,82,1) 100%);
        background: -o-linear-gradient(top, rgba(67,165,230,0.28) 56%, rgba(67,165,230,0.82) 89%, rgba(210,255,82,1) 100%);
        background: -ms-linear-gradient(top, rgba(67,165,230,0.28) 56%, rgba(67,165,230,0.82) 89%, rgba(210,255,82,1) 100%);
        background: linear-gradient(to bottom, rgba(67,165,230,0.28) 56%, rgba(67,165,230,0.82) 89%, rgba(210,255,82,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#43a5e6', endColorstr='#d2ff52', GradientType=0 );
    }

    .booking2{
        background: rgba(212,214,230,0.28);
        background: -moz-linear-gradient(top, rgba(212,214,230,0.28) 81%, rgba(212,214,230,0.6) 89%, rgba(210,255,82,1) 99%);
        background: -webkit-gradient(left top, left bottom, color-stop(81%, rgba(212,214,230,0.28)), color-stop(89%, rgba(212,214,230,0.6)), color-stop(99%, rgba(210,255,82,1)));
        background: -webkit-linear-gradient(top, rgba(212,214,230,0.28) 81%, rgba(212,214,230,0.6) 89%, rgba(210,255,82,1) 99%);
        background: -o-linear-gradient(top, rgba(212,214,230,0.28) 81%, rgba(212,214,230,0.6) 89%, rgba(210,255,82,1) 99%);
        background: -ms-linear-gradient(top, rgba(212,214,230,0.28) 81%, rgba(212,214,230,0.6) 89%, rgba(210,255,82,1) 99%);
        background: linear-gradient(to bottom, rgba(212,214,230,0.28) 81%, rgba(212,214,230,0.6) 89%, rgba(210,255,82,1) 99%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d4d6e6', endColorstr='#d2ff52', GradientType=0 );
    }

    /*    .bordered {
    border: solid #ccc 1px;
    -moz-border-radius: 20px;
    -webkit-border-radius: 20px;
    border-radius: 20px;
    -webkit-box-shadow: 0 3px 3px #ccc;
    -moz-box-shadow: 0 3px 3px #ccc;
    box-shadow: 0 3px 3px #ccc;
    }
    
    .bordered th {
    background-color: #dce9f9;
    background-image: -webkit-gradient(linear, left top, left
    bottom, from(#ebf3fc), to(#dce9f9));
    background-image: -webkit-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image: -moz-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image: -ms-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image: -o-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image: linear-gradient(top, #ebf3fc, #dce9f9);
    -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;
    -moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;
    box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;
    border-top: none;
    text-shadow: 0 1px 0 rgba(255,255,255,.5);
    }*/

</style>


<div id="header_page"  style="height:50px; background-image: url('<?php echo $data['rootUrl'] ?>global/img/bg2.jpg');" >
    <div class="header2">
<!--        <script>
            function validarx(e) {
                tecla = (document.all) ? e.keyCode : e.which;
                if (tecla == 86 && e.ctrlKey)
                    return false;
            }
        </script> -->

        <table style="width:500px;">
            <tr>
                <td width="30%">Reserves  [ ]</td>
                <td width="10%">
                    <table>
                        <tr>
                            <td id="bnt-trips" class="btn" style="cursor:pointer;"><img src="<?php echo $data['rootUrl']; ?>global/img/admin/calendar_aviso32x32.png" /></td>
                        </tr>
                    </table>
                </td>
                <td>&nbsp;</td>
                <td width="10%" ><div id="mensajeTrip"  class="temporizador"></div></td>
            </tr>
        </table>
    </div>
    <div id="info-group" style="">
        <input type="text" readonly="true" style="    background: #33449C;
               margin-left: 212px;
               margin-top: -51px;
               width: 303px;
               color: #fff;
               border-color: transparent;
               /* font-family: -webkit-body; */
               font-family: Arial, Helvetica, sans-serif;" name="taritrans" id="taritrans" placeholder="Rates" />
    </div>

    <script type="text/javascript">
        function capturar2()
        {
            var x = document.getElementById('taritrans1').value;
            document.getElementById('taritrans').value = x;
        }
    </script>

    <div  id="toolbar" style="margin-top: -27px;">
        <select style="margin-left:-2%; margin-top: -2px; width:303px; background: #AC1B29;color: #fff;border-color: transparent;" name="special_price_name" id="special_price_name" onchange="myFunction()">
    <!--    <select style="margin-left:3px; margin-top:11px; width:303px; background: #AC1B29;color: #fff;border-color: transparent;" name="fnombre" id="rate" onchange="myFunction()">-->

            <option id="" value="Rates">Rates</option>
            <?php
            $sql1 = "SELECT DISTINCT special_price_name FROM routes_net";
            $rs1 = Doo::db()->query($sql1);
            $routesnet = $rs1->fetchAll();
            foreach ($routesnet as $r) {
                echo '<option value="' . $r['special_price_name'] . '" >' . $r['special_price_name'] . '</option>';
            }
            ?>
        </select>

        <script>
            function myFunction() {
                var x = 'RATES ----------------------------------------------------->';
                document.getElementById("taritrans").value = x;
            }
        </script>           


        <div class="toolbar-list">

            <ul>
                <li class="btn-toolbar" id="btn-save1">
<!--                    <a class="link-button" id="btn-save1"><span class="icon-32-save" title="Nuevo" >&nbsp;</span>Save</a>-->
                    <a class="link-button" id="btn-save1"> <i class="fa fa-floppy-o fa-3x" title="Guardar" style="margin-left: 4px; color:#4B0082;"></i><br>&nbsp;Save</a>
                </li>

                <li class="btn-toolbar" id="btn-cancel1">
<!--                <a  class="link-button" ><span class="icon-back" title="Editar" >&nbsp;</span>Back</a>-->
                    <a class="link-button"><i class="fa fa-arrow-left fa-3x" title="Regresar" style="color: #33449C;"></i> <br>Back</a>
                </li>                      
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!-- header options -->
<form  id="formula" class="form" action="<?php echo $data['rootUrl']; ?>admin/reservas/save" method="post" name="formula" target="_blank" >
    <div id="info-group2">
        <div id="cancelation">
            <div class="ho">CANCELATION <span>#</span></div>
            <div id="cancel"><strike>  00000 </strike></div>
        </div>
        <div id="reservation" style="border-color: #fff;">
            <div class="ho" style="color: #eee; background: #eee;"> RESERVATION <span>#</span></div>
            <div id="reser"> <p ><?php /* echo $_SESSION['codconf']; */ ?></p><input type="hidden" /></div>
        </div>
        <div id="status">
            <div class="ho" style="color: #fff;background: #bb0000; height:12px;">STATUS</div>

            <div id="stat"></div>
        </div>
        <div id="status-change" >
<!--            <div style="color:#4B0082; "><strong>STATUS</strong></div>-->
            <div class="ho" style="color: #fff;background: #bb0000;padding: 4px;margin-top: 0px; margin-left:47px; width:44px; ">STATUS</div>
            <select style="width:112px; margin-left: -4px; margin-top:-2px;" id="estado" name="estado">
                <option></option>
                <option value="CONFIRMED" selected>CONFIRMED</option>
                <option value="QUOTE">QUOTE</option>
            </select>
        </div>
    </div>


    <!--    <div id="content_page"  >-->
    <div id="content_page" style="width: 1000px;z-index:1; background-image: url('<?php echo $data['rootUrl'] ?>global/img/bg2.jpg');" >
        <div id="serpare">
            <input id="fin_calculo" type="hidden" value="false"/>

            <input type="hidden"  id="vista" value="1" />
            <input name="id" type="hidden"  id="id"  value="<?php
            if (isset($reserva)) {
                echo $reserva->id;
            }
            ?>" />

            <table><tr><td>
                        <!--                        <fieldset id="inputype" style="width: 50%">-->
                        <fieldset    id="inputype" style="margin-left:-6px; width:470px; border-radius: 3px 120px 0px 80px;" class="rojo"><legend style="border:1px solid #B83A36; background:#fff;margin-left:5px;">INPUT TYPE</legend>
                            <!--<legend>INPUT TYPE</legend>-->
                            <div id="opera" class="input">  
                                <table width="50%" >
                                    <tr align="left">

                                        <td >
                                            <label style="color:#FFFFFF;"  id="label">CALL CENTER</label>
                                        </td>
                                        <td >
                                            <input style="margin-left:18px; width:275px; border-top-left-radius: 25px; text-align: center; border-top-right-radius: 25px;" name="nombre" type="text"  id="nombre" value="<?php echo trim($login->nombre . ' (' . $login->usuario . ')'); ?>" readonly="readonly"/>
                                        </td>

                                    </tr>
                                    <tr><td colspan="2" >
                                            <table width="100%">
                                                <tr>
                                                    <td width="10%">
                                                        <label style="color:#FFFFFF;">AGENCY</label>
                                                    </td>
                                                    <td width="40%">
                                                        <div class="ausu-suggest" >
                                                            <input name="agency" onchange="capturar2();" style="border-bottom-left-radius: 17px; margin-top:12px; margin-left:10px;"  type="text"  id="agency" size="19" te="off"  maxlength="30" value="" autocomplete="off"/>
                                                            <input type="hidden" size="4" value="-1" name="id_agency" id="id_agency" autocomplete="off"  readonly="readonly"/> 
                                                            <input type="hidden" size="4" value="0" name="type_rate" id="type_rate" autocomplete="off"  readonly="readonly"/> 
                                                            <input type="hidden" size="4" value="0" name="disponible" id="disponible" autocomplete="off"  readonly="readonly"/>
                                                            <input type="hidden" size="4" value="0" name="comision" id="comision" autocomplete="off"  readonly="readonly"/>






                                                        </div>
                                                    </td>
                                                    <td width="10%">
                                                        <label style="margin-left:16px; color:#FFFFFF;">Employ</label>
                                                    </td>
                                                    <td width="40%">
                                                        <div class="ausu-suggest" >
                                                            <input style="border-top-right-radius: 25px; width:150px;margin-top:10px; margin-left:18px;" name="uagency" type="text"  id="uagency" size="30" maxlength="30" value="" autocomplete="off"  />
                                                            <input type="hidden" size="4" value="" name="id_auser" id="id_auser" autocomplete="off" />
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td></tr>

                                    <tr><td colspan="2" ><select name="uagency1"  style="width:125px; height:25px; display:none;" id="uagency1">
                                                <option value="0"></option>
                                                <?php foreach ($data["user_agencia"] as $ua) { ?>
                                                    <option value="<?php echo $ua["id_agencia"]; ?>"  ><?php echo $ua["nombre"]; ?></option>
                                                <?php } ?>
                                            </select></td></tr>
                                    <tr><td colspan="2">
                                            <table style="margin-top:6px; margin-right:70px;"align="center" cellspacing="10">
                                                <tr valign="top">
                                                    <td><label  style="color:#FFFFFF;" for="calan_phone"> BY PHONE</label> <input name="canal" type="radio" id="calan_phone" value="PHONE" />  </td>
                                                    <td><label  style="color:#FFFFFF;" for="calan_mail"> BY MAIL</label> <input name="canal" type="radio"  id="calan_mail"  value="MAIL" /> </td>
                                                    <td><label style="color:#FFFFFF;" for="calan_web"> WEBSALE </label><input name="canal" type="radio" id="calan_web" value="WEBSALE" />  </td>
                                                </tr>
                                            </table>
                                        </td></tr>
                                </table>
                            </div>
                        </fieldset>
                        <fieldset id="liderpax" style="margin-left:488px; margin-top:-129px; border-radius: 130px 3px 80px 0px; width:470px;" class="cerati"><legend style="border:1px solid #00C; margin-left:64px; background:#fff;">LEADER PASS</legend>

                            <table>
                                <tr>
                                    <td >
                                        <div id="opera" class="input" style="padding-top:5px;">        
                                            <table>
                                                <tr>
                                                    <td>
                                                        <label style="color:#FFFFFF; margin-left:30px;" id="label" >SEARCH </label>
                                                    </td>
                                                    <td>
                                                        <div class="ausu-suggest" id="opera">

                                                            <input  style="margin-left:4px; width:354px; border-top-left-radius: 17px;border-top-right-radius: 17px;" type="text" size="35" value="<?php
                                                            if (isset($cliente) && isset($reserva)) {
                                                                if ($cliente->id == $reserva->id_clientes) {
                                                                    echo $cliente->lastname . " " . $cliente->firstname . " - E-Mail -" . $cliente->username;
                                                                }
                                                            }
                                                            ?>" name="leader" id="leader" autocomplete="off" />

                                                            <input type="hidden" size="4" value="" name="id_leader" id="id_leader" autocomplete="off" disabled="disabled"  readonly="readonly"/>
                                                        </div>
                                                    </td>
                                                    <td>&nbsp;&nbsp;</td>
                                                    <td title="">
                                                        <div  class="ausu-suggest" style="margin-top:-5px; margin-left:2px; display:none">      
                                                            <a id="newClient" style="cursor:pointer; visibility:hidden;" ><img src="<?php echo $data['rootUrl']; ?>global/img/new.png" alt=""  align="absmiddle" border="0"  style="padding-bottom:0px;" /></a>
                                                        </div>  
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="opera" class="input" >
                                            <table width="100%">
                                                <tr>
                                                    <td width="" align="right">

                                                        <input type="hidden" name="idCliente"   id="idCliente"  value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo trim($reserva->id_clientes);
                                                            }
                                                        }
                                                        ?>" />


                                                        <input type="hidden" name="idPagador" id="idPagador" value="0"  />
                                                        <input type="hidden" name="idPagador_aux" id="idPagador_aux" value="0"  />
                                                        <input type="hidden" name="cliente_apto" id="cliente_apto" value="0"  />
                                                        <label style="color:#FFFFFF;" id="labeldere12">FIRST NAME</label>     
                                                    </td>
                                                    <td width="">
                                                        <input style="margin-left:10px; width:140px;" name="firstname1" type="text"  id="firstname1" size="15" maxlength="15" value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->firstname;
                                                            }
                                                        }
                                                        ?>" />  
                                                    </td>

                                                    <td width="" align="right"> 
                                                        <label style="color:#FFFFFF;" id="labeldere12" >LAST NAME </label>
                                                    </td>
                                                    <td width="">  
                                                        <input style="margin-left:6px; width:134px;" name="lastname1" type="text"  id="lastname1" size="15" maxlength="15" value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->lastname;
                                                            }
                                                        }
                                                        ?>" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right"> 
                                                        <label style="color:#FFFFFF;" id="labeldere12">E-MAIL </label>
                                                    </td>
                                                    <td>  
                                                        <input style="margin-left:10px; margin-top:6px; width:140px; border-bottom-left-radius: 17px;" name="email1" type="text"  id="email1" size="15" value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->username;
                                                            }
                                                        }
                                                        ?>"/>
                                                    </td>

                                                    <td align="right">
                                                        <label style="color:#FFFFFF; margin-left:2px;" id="labeldere12">PHONE </label>
                                                    </td>
                                                    <td>
                                                        <input style="margin-top: 6px; margin-left:0px; width:134px; border-bottom-right-radius: 25px;"name="phone1" type="text"  id="phone1" size="15" maxlength="15" value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->phone;
                                                            }
                                                        }
                                                        ?>" /> 
                                                        <input  type="hidden" name="type_cliente"  id="type_cliente" value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->tipo_client;
                                                            }
                                                        }
                                                        ?>" />          
                                                    </td>


                                                </tr>
                                            </table>   
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>
                    <td>

                    </td></tr></table>

            <fieldset id="boo" style="width:952px; height: 65px; margin-top: 5px; border-radius: 26%;margin-top: 0%;" class="booking2" ><legend style="border:1px solid #00C; background:#fff;">BOOKING</legend>
                <input type="hidden" name="id_oneway" id="id_tipo_ticket" value="<?php
                if (isset($reserva)) {
                    echo $reserva->tipo_ticket;
                }
                ?>"/>
                <div id="opera" class="input" style="padding-top:5px;"> <label  style="color:#00f;" for="oneway"><strong>ONE WAY</strong> </label> <input name="tipo_ticket" onClick="capturar();" id="oneway" type="radio" value="1"  /></div>
                <div id="opera" class="input" style="padding-top:5px;"> <label style="color:#AC1B29;" for="roundtrip"><strong>ROUND TRIP</strong> </label><input name="tipo_ticket"  onClick="capturar();"  id="roundtrip" type="radio" value="2"  /> </div>
                <div id="opera" class="input" style="padding-top:5px;"> <label style="color:#4B0082;" style="padding-right:5px;"><strong>TYPE OF PASS</strong> </label>

                    <div style="display:none;" id="resultado"></div>

                    <select style="margin-left:12px" name="tipo_pass" id="tipo_pass"><option style="color:red;" value="0">NO RESIDENT</option><option style="color:blue;"  value="1">RESIDENT</option></select>  </div>

                <div id="opera" class="input"  style="padding-top:10px; clear:left;">        
                    <label style="width:45px; margin-left:485px; margin-top:-35px;color:#000000;"  ><strong>ADULT</strong></label>
                    <input name="pax" autocomplete="off" type="number" min="1"  id="pax" size="2" maxlength="2" value="1"  style="font-weight: bold;text-align: center; width:50px; margin-top:-37px;" onchange="
                            var a = document.getElementById('pax').value
                            if (isNaN(a)) {
                                return false;
                            } else {
                                var max = 100 - a;
                                if (max < 0) {
                                    var valor = 100 - $('#pax2').val();
                                    document.getElementById('pax').value = valor;
                                    $('#pax2').attr('max', valor);
                                } else {
                                    $('#pax2').attr('max', max);
                                    if ($('#pax2').val() > max) {
                                        $('#pax2').attr('value', max);
                                    }
                                }
                            }

                           "   />
                </div>
                <div id="opera" class="input"  style="padding-top:10px;">        
                    <label style="width:45px; margin-top:-35px; color:#000000;"  ><strong>CHILD</strong></label>
                    <input name="pax2" type="number"  id="pax2" size="2" maxlength="2" value="0" autocomplete="off" style="font-weight: bold; text-align: center; width:50px; margin-top:-37px;" min="0" max="15" onchange="
                            var a = document.getElementById('pax2').value;
                            if (isNaN(a)) {
                                return false;
                            } else {
                                var max = 16 - a;
                                if (max <= 0) {
                                    var valor = 16 - $('#pax').val();
                                    document.getElementById('pax2').value = valor;
                                    $('#pax2').attr('max', valor);
                                } else {
                                    if ($('#pax').val() > max) {
                                        $('#pax').attr('value', max);
                                    }
                                }
                            }"  />
                </div>
                <div id="opera" class="input"  style="padding-top:10px;">        
                    <label style="width:45px; margin-top:-35px; height:45px; color:#000;"  ><strong>TOTAL</strong></label>
                    <input style="font-weight: bold; margin-top:-37px; height: 18px; text-align: center;" name="totalpax" type="text"  id="totalpax" size="2" maxlength="2" value=""  readonly="readonly"/>
                </div>
                <div id="opera" class="input"  style="padding-top:10px;">        
                    <label style="width:45px; margin-left:-4px; margin-top:-35px; color:#000;"  ><strong>INFANT</strong></label>
                    <input name="infat" type="number"  id="infat" size="2" maxlength="2" value="0" min="0" max="16" style="font-weight: bold; text-align: center; width:50px; margin-top:-37px;margin-left:4px;"  />
                </div>

                <div id="opera" class="input" style="float: left; margin-left:230px; margin-top:-30px; "><input style="margin-top:6px;" name="byr" type="checkbox" value="1" /><label id="labeldere" style="color:#4B0082;"><strong>Customer With Disabilities</strong></label></div>



        <!--<div id="opera" class="input" style="padding-right:200px; padding-top:10px;"><input name="byr" type="radio" value="" /><label id="labeldere"> Customer With Disabilities </label></div>-->

            </fieldset>
            <!--&nbsp;-->

<!--            <table style="display:none;" width="200"  cellspacing="0" class="sup" >
                <tr>
                    <td width="167" ><label > <strong>SUPERCLUB#</strong></label></td>
                    <td width="27"><label id="labeldere"><span id="number_supu">N/A</span></label></td>
                </tr>
                <tr>
                    <td><label> <strong>POINTS BALANCE</strong></label></td>
                    <td><label id="labeldere"><span id="points">N/A</span></label></td>
                </tr>
                <tr>
                    <td><label > <strong>POINTS REQUIRED <span style="font-size: 8px;">FOR THIS TRIP</span>

                            </strong></label></td>
                    <td><label id="labeldere" >N/A</label></td>
                </tr>
            </table>-->
            <fieldset id="onew" style="border-radius: 7%; height:211px;" class="cerati"><legend style="margin-top:4px; border:1px solid #00C; background:#fff;">ONE WAY</legend>
                <div id="CargaTrip"></div>

                <div id="opera" class="input" style="padding-top:18px;"> 

                    <label style="width:75px; color:#FFFFFF;"  >DEPARTURE</label>
<!--                    <a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  />-->
                    <a href="" id="dataclick1" ><i class="fa fa-calendar fa-2x" style="color: #fff;"></i></a>
                    <!--                    </a>-->
                    <input style="width:84px; margin-left:8px; padding-top:3px; margin-top: -7px;"  name="fecha_salida" type="text"  id="fecha_salida" size="10" maxlength="15" value=""  autocomplete="off" />
                </div>

                <div id="opera" class="input"  >        
                    <div id="explo">  <label style="width:45px; color:#FFFFFF;"  > FROM</label></div>
                    <div id="explo" align="left" > <select name="fromt"  style="width:125px; height:25px;" id="from"> 
                            <option style="width:145px;"value="0"></option> 
                            <?php foreach ($data["areas"] as $e) { ?>
                                <option value="<?php echo $e["id"]; ?>"  ><?php echo $e["nombre"]; ?></option>           
                            <?php } ?>                     
                        </select></div>
                </div>
                <div id="opera" class="input"  >        
                    <div id="explo">  <label style="width:45px; color:#FFFFFF;"  > TO</label></div>
                    <div id="explo" align="left">
                        <select name="to"  id="to" style="width:130px; height:25px;">
                        </select>
                        <input type="hidden" name="valto" id="valto" value="<?php
                        if (isset($reserva)) {
                            echo $reserva->tot;
                        }
                        ?>"/>
                    </div>
                </div>
                <div id="mascaraP" style="display: none;">
                </div>
                <div id="popup" style="display: none;">
                    <div class="content-popup">     
                    </div>
                </div>

                <div id="clienteN" style=" display:none; width: 700px; margin-left: 100px;"></div>

                <div id="opera" class="input">        
                    <div style="width:50px; margin-top: -5px;" id="popup1">  <label style="width:20px; color:#FFFFFF;"  > TRIP</label><a id="search" style="cursor:pointer; color: #fff; margin-left:6px;" class="fa fa-search-plus fa-2x"></a>
                        <input type="hidden" id="valorcomision01" name="valorcomision01" value="0" style="" />
                    </div>
                    <div style="width:50px;"> <input name="trip_no" type="text" style="margin-top:1px; height: 22px; width:75px;"  id="trip_no" size="3" maxlength="3" value="<?php
                        if (isset($reserva)) {
                            echo $reserva->trip_no;
                        }
                        ?>"  readonly="readonly"/>
                    </div>
                </div>
                <div id="opera" class="input"  style="clear:right; padding-left:7px;">        
                    <div style="width:50px; ">  <label style="width:45px; padding-left: 11px; color:#FFFFFF;"  > DEP.TIME</label></div>

                    <input name="departure1" type="text"  id="departure1" size="5" maxlength="8" style="padding-left: 12px; width:62px; margin-left:11px; height: 23px; margin-top: 0px;" value="<?php
                    if (isset($reserva)) {
                        echo date("g:i a", strtotime($reserva->deptime1));
                    }
                    ?>" readonly="readonly"/>

                </div>

                <div id="opera" class="input"  style="clear:left; ">        
                    <div style="width:265px;">  <label style="width:150px; color:#FFFFFF;"  >PICK UP POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest" >
                            <input name="pickup1" type="text"  id="pickup1" size="40" maxlength="55" value="<?php
                            if (isset($p) && $p != "") {
                                echo $p->place;
                            }
                            ?>" autocomplete="off"  />
                            <input name="id_p1" type="hidden"  id="id_p1" size="40" maxlength="55" value="<?php
                            if (isset($p) && $p != "") {
                                echo $p->id;
                            }
                            ?>" />
                        </div>
                    </div>
                </div>
                <div id="opera" class="input"  >        
                    <div style="width:265px;">  <label style="margin-left:8px; width:250px; color:#FFFFFF;"  >DROP OFF POINT/ADDRESS</label></div>
                    <div style="width:210px;">
                        <div class="ausu-suggest" >
                            <input style="padding:2px; margin-left:8px; width: 272px;" name="dropoff1" type="text"  id="dropoff1" size="39" maxlength="55" value="<?php
                            if (isset($drop1) && $drop1 != "") {
                                echo $drop1->place;
                            }
                            ?>" autocomplete="off" />
                            <input name="id_dropoff1" type="hidden"  id="id_dropoff1" size="40" maxlength="55" value="<?php
                            if (isset($drop1) && $drop1 != "") {
                                echo $drop1->id;
                            }
                            ?>" />
                        </div>
                    </div>
                </div>
                <div id="opera" class="input" style="margin-left: 16px;">        
                    <div style="width:50px;">  <label style="width:45px; padding-left: 6px; color:#FFFFFF;"  >ARR.TIME</label></div>

                    <input name="arrival1" type="text"  id="arrival1" style="height: 22px; margin-left: 6px; padding-left: 10px; width:63px;" size="5" maxlength="8" value="<?php
                    if (isset($reserva)) {
                        echo date("g:i a", strtotime($reserva->arrtime1));
                    }
                    ?>" readonly="readonly" />

                </div>
                <div id="opera" class="input" style="padding-top:5px;"> <label style="padding-right:5px; color:#FFFFFF;">EXTENSION AREA:</label>
                    <select name="ext_from1" id="ext_from1" style="width:123px;height:26px;" >
                        <option value="0"></option>
                    </select>
                </div>
                <div id="opera" class="input" > <label style=" color:#FFFFFF; margin-left:-8px; margin-top:4px;">EXTENSION AREA:</label>
                    <select name="ext_to1" id="ext_to1" style="width:132px; margin-left:5px; height:26px; margin-top:5px;">
                        <option value="0"></option>
                    </select>
                </div>
                <div id="opera" class="input" >        
                    <label style="margin-left: 0px; color:#FFFFFF; margin-top:4px;"  >ROOM #</label>
                    <input name="room1" type="text"  id="room1" size="4" maxlength="6" value="" style=" width:73px;  margin-left: 30px; margin-top:4px;" />
                </div>
                <div id="opera" class="input"  style="clear:left; ">  
                    <div style="width:300px;"><label style="width:250px; color:#FFFFFF;" >EXTENSION PICK UP POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest">
                            <input name="exten1" type="text"  id="exten1" size="46" maxlength="55" value=""  autocomplete="off" disabled="disabled" />
                            <input name="id_ext_pikup1" type="hidden"  id="id_ext_pikup1" size="40" maxlength="55" value="" />
                        </div>
                    </div>
                </div>
                <div id="opera" class="input" >        
                    <div style="width:265px;"><label style="width:250px; color:#FFFFFF; margin-left: 11px;">EXTENSION DROP OFF POINT/ADDRESS</label></div>
                    <!--                    <div style="width:200px;">-->
                    <div class="ausu-suggest" >
                        <input name="exten2" type="text"  id="exten2" size="47" maxlength="55" value="" disabled="disabled" style="padding-left:11px; margin-left: 11px; width:313px;" />
                        <input name="id_ext_pikup2" type="hidden"  id="id_ext_pikup2" size="40" maxlength="55" value="" />
                        <!--                        </div>-->
                    </div>
                </div>
            </fieldset> 
            <fieldset id="round" style="display:none;border-radius: 5%; margin-top:7px; height: 211px;" class="rojo"><legend style="border:1px solid #B83A36; background:#fff;"><font color="#990000">ROUND TRIP</font></legend>

                <div id="opera" class="input" style="padding-top:18px; "> 

                    <label style="width:75px; color:#FFFFFF;"  >DEPARTURE </label>
                    <a href="" id="dataclick2" ><i class="fa fa-calendar fa-2x" style="color: #fff;"></i></a>
<!--                    <a href="" id="dataclick2" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  />-->
                    <!--</a>-->
                    <input style="width:84px; margin-left:8px; padding-top:3px;"  name="fecha_retorno" type="text"  id="fecha_retorno" size="10" maxlength="15" value="<?php
                    if (isset($reserva)) {
                        echo $reserva->fecha_retorno;
                    }
                    ?>"  autocomplete="off" />
                </div>
                <div id="opera" class="input"  >        
                    <div id="explo">  <label style="width:45px; color:#FFFFFF;"  > FROM</label></div>
                    <div id="explo" align="left"> 
                        <select name="fromt2"  style="width:125px; height:25px;" id="from2" > 
                            <option value="0"></option> 
                            <?php foreach ($data["areas"] as $e) { ?>
                                <option value="<?php echo $e["id"]; ?>"  ><?php echo $e["nombre"]; ?></option>           
                            <?php } ?>  
                        </select>
                    </div>
                </div>
                <div id="opera" class="input"  >        
                    <div id="explo"><label style="width:45px; color:#FFFFFF;"  > TO</label></div>
                    <div id="explo" align="left">
                        <select name="to2"  id="to2" style="width:130px; height:25px;"  >
                            <option value="0"></option> 
                        </select>
                    </div>
                </div>
                <div id="opera" class="input" style="margin-top: -1px;" >        
                    <div style="width:50px;" id="popup2"><label style="width:20px; color:#FFFFFF;"  > TRIP</label><a id="search2" style="cursor:pointer;color: #fff;" class="fa fa-search-plus fa-2x"></a>
                        <input type="hidden" id="valorcomision02" name="valorcomision02" value="0" />
                    </div>
                    <div style="width:50px;"> <input name="trip_no2" type="text"  id="trip_no2" size="3" maxlength="3" style="height: 22px; width:75px;" value="<?php
                        if (isset($reserva)) {
                            echo $reserva->trip_no2;
                        }
                        ?>"  readonly="readonly"/>
                    </div>
                </div>
                <div id="opera" class="input"  style="clear:right; padding-left:7px;">        
                    <div style="width:50px;">  <label style="width:45px; padding-left: 6px;  color:#FFFFFF;"  > DEP.TIME</label></div>

                    <input name="departure2" type="text"  id="departure2" size="5" maxlength="8" style="height: 22px; padding-left: 12px; width:62px; margin-left:11px;" value="<?php
                    if (isset($reserva)) {
                        echo date("g:i a", strtotime($reserva->deptime2));
                    }
                    ?>" readonly="readonly" />

                </div>
                <div id="opera" class="input"  style="clear:left; ">        
                    <div style="width:265px;">  <label style="width:150px; color:#FFFFFF;"  >PICK UP POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest" >
                            <input name="pickup2" type="text"  id="pickup2" size="40" maxlength="55" value="" autocomplete="off"  />
                            <input name="id_pickup2" type="hidden"  id="id_pickup2" size="40" maxlength="55" value=" " />
                        </div>
                    </div>
                </div>
                <div id="opera" class="input"  >        
                    <div style="width:265px;">  <label style="margin-left:8px; width:250px; color:#FFFFFF;"  >DROP OFF POINT/ADDRESS</label></div>
                    <div style="width:210px;">
                        <div class="ausu-suggest" >
                            <input style="padding:2px; margin-left:8px; width:272px;" name="dpoff2" type="text"  id="dropoff2" size="39" maxlength="55" value="<?php
                            if (isset($drop2) && $drop2 != "") {
                                echo $drop2->place;
                            }
                            ?>" autocomplete="off"  />
                            <input name="id_dropoff2" type="hidden"  id="id_dropoff2" size="40" maxlength="55" value="<?php
                            if (isset($drop2) && $drop2 != "") {
                                echo $drop2->id;
                            }
                            ?>" />
                        </div>
                    </div>
                </div>
                <div id="opera" class="input" style="margin-left: 16px;" >        
                    <div style="width:50px;"><label style="width:45px; padding-left: 6px; color:#FFFFFF;"  >ARR.TIME</label></div>
                    <div style="width:50px;">
                        <input name="arrival2" type="text"  id="arrival2" style="height: 22px; margin-left: 6px; padding-left: 10px; width:63px;" size="5" maxlength="8" value="<?php
                        if (isset($reserva)) {
                            echo date("g:i a", strtotime($reserva->arrtime2));
                        }
                        ?>" readonly="readonly"/>
                    </div>
                </div>
                <div id="opera" class="input" style="padding-top:5px; "> <label style="padding-right:5px;color:#FFFFFF;">EXTENSION AREA:</label>
                    <select name="ext_from2" id="ext_from2" style='width:123px; height:26px;' >
                        <option value="0"></option>
                    </select>
                </div>
                <div id="opera" class="input" > <label style=" color:#FFFFFF; margin-left:-8px; margin-top:4px;">EXTENSION AREA:</label>
                    <select name="ext_to2" id="ext_to2" style="width:132px; margin-left:5px; height:26px; margin-top:5px;">
                        <option value="0"></option>
                    </select>
                </div>
                <div id="opera" class="input" >        
                    <label style="width:48px; color:#FFFFFF; margin-top:4px;"  >ROOM #</label>
                    <input name="room2" type="text"  id="room2" size="4" maxlength="6" value="" style=" width:73px;  margin-left: 29px; margin-top:4px;"/>
                </div>
                <div id="opera" class="input"  style="clear:left; ">        
                    <div style="width:300px;">  <label style="width:250px; color:#FFFFFF;"  >EXTENSION PICK UP POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest" >
                            <input name="exten3" type="text"  id="exten3" size="46" maxlength="55" value="" disabled="disabled" />
                            <input name="id_ext_pikup3" type="hidden"  id="id_ext_pikup3" size="40" maxlength="55" value="" />
                        </div>
                    </div>
                </div>
                <div id="opera" class="input" >        
                    <div style="width:265px;"><label style="width:250px; color:#FFFFFF;margin-left: 12px;"  >EXTENSION DROP OFF POINT/ADDRESS</label></div>
                    <div style="width:200px;">
                        <div class="ausu-suggest" >
                            <input name="exten4" type="text"  id="exten4" size="47" maxlength="55" value="" disabled="disabled" style="padding-left:11px; margin-left: 11px; width:313px;" />
                            <input name="id_ext_pikup4" type="hidden"  id="id_ext_pikup4" size="40" maxlength="55" value=""  />
                        </div>
                    </div>
                </div>
            </fieldset> 

            <table class="sky" border="1" width="256" height="205" cellspacing="0" class="sup2" style="margin-top: 66px;">
                <tr>
                    <td style="text-align:center; color:#4B0082;" width="136"><label><strong>QUOTE</strong></label></td>
                    <td width="54" style="text-align:center;"><label style="color:#4B0082;"><strong>Adult</strong></label></td>
                    <td width="48" style="text-align:center;"><label style="color:#4B0082;"><strong>Child</strong></label></td>
                </tr>
                <tr>
                    <td><label style="text-align:left; color:#4B0082;"><strong>Line Transportation</strong></label></td>
                    <td style="text-align:center; color:blue;"><span name ="transporadult" id="transporadult"  value="0"  style="font-size: 15px; font-weight:bold; " ></span></td>
                <input type="hidden" name ="transadult" id="transadult" value="0" />

                <input type="hidden" name ="transchild" id="transchild" value="0"/>

<!--                <input type="text" name ="x" id="x" value="0"/>-->

<!--                <input type='text' id='vr1' name="vr1" onkeyup='changevalue();'>-->
<!--                <input type='text' id='x' style='font-size: 10px' name='x' size='5' value ='0,0' onchange='checkDecimals(this.value, this.value)'>-->


                <td style="text-align:center; color:blue;"><span name ="transporechil" id="transporechil" value="0" style="font-size: 15px; font-weight:bold; "></span></td>
                </tr>
                <tr>
                    <td><label style="text-align:left; color:#4B0082;"><strong>Extensions</strong></label></td>
                    <td style="text-align:center; color:red;"><span id="extenadult" style="font-size: 15px;font-weight:bold; "></span></td>
                    <td style="text-align:center; color:red;"><span id="extenchil" style="font-size: 15px;font-weight:bold; "></span></td>
                </tr>
                <tr>
                    <td><label style="text-align:left; color:#4B0082;"><strong>Special Discount %</strong></label></td>
                    <td colspan="2">
                        <input name="descuento" type="number" id="descuento" maxlength="3" onkeyup="valorExtra();" max="100" min="0"   style="text-align:left; height:20px; width:112px;" />
                    </td>
                </tr>
                <tr>
                    <td><label style="text-align:left; color:#4B0082;"><strong>Special Discount &nbsp;$</strong></label></td>
                    <td colspan="2">
                        <input name="descuento_valor" type="text" id="descuento_valor" size="12" maxlength="10" pattern="6[0-9]" style="height:20px; width:114px;" onkeyup="valorExtra();"  />
                    </td>
                </tr>
                <tr>
                <tr>
                    <td><label style="text-align:left; color:#4B0082;"><strong>Extra Charges</strong></label></td>
                    <td colspan="2">
                        <input name="extra" type="text" id="extra" size="12" style=" width:114px; height:20px; fon" min="0" onkeyup="valorExtra();"  />
                    </td>
                </tr>
                <tr>
                    <td><label style="text-align:left; color:#ffffff;"><strong>Sub-total per Pax</strong></label></td>
                    <td style="text-align:center; color:#ffffff;"><span id="subtoadult" style="font-size: 15px; font-weight:bold; "></span></td>
                    <td style="text-align:center; color:#ffffff;"><span id="subtochild" style="font-size: 15px; font-weight:bold; "></span></td>
                </tr>
                <tr>
                    <td><label style="color:#ffffff;" ><strong>Total</strong></label></td>
                    <td style="text-align:center;" colspan="2"><label style="color:#ffffff;"><strong id="totaltotal" style="font-size: 15px; font-weight:bold; ">$ 00.0</strong>

                        </label></td>
                <div id="enviarDatos"></div>
                <input size="5" type="hidden" id="price_exten03" name="price_exten03" value="0"  />
                <input size="5" type="hidden" id="price_exten04" name="price_exten04" value="0" />
                <input size="5" type="hidden" id="subtoadult1" name="subtoadult1" value="0" />
                <input size="5" type="hidden" id="subtochild1" name="subtochild1" value="0" /><br>
                <input size="5" type="hidden" id="subtoadult22" name="subtoadult22" value="0" />
                <input size="5" type="hidden" id="subtochild22" name="subtochild22" value="0" /><br>
                <input size="5" type="hidden" id="subtoadult33" name="subtoadult33" value="0" />
                <input size="5" type="hidden" id="subtochild33" name="subtochild33" value="0" />   

                <input size="5" type="hidden" id="price1" name="price1" value="0" />

                <input size="5" type="hidden" id="subtochild2" name="subtochild2" value="0" />
                <input size="5" type="hidden" id="subtoadult2" name="subtoadult2" value="0" />
                <input size="5" type="hidden" id="price_exten01" name="price_exten01" value="0"  />
                <input size="5" type="hidden" id="price_exten02" name="price_exten02" value="0" />
                </tr>


               <!--<tr>
   <td>&nbsp;</td>
   <td colspan="2">&nbsp;</td>
 </tr>
 <tr>
   <td>&nbsp;
                   </td>
   <td colspan="2">&nbsp;
   

   </td>
 </tr>
 <tr>
   <td>&nbsp;
   
                   </td>
   <td colspan="2">&nbsp;
                   </td>
 </tr>
 <tr>
   <td>&nbsp;
                   </td>
   <td colspan="2">&nbsp;
   

   </td>
 </tr>
 <tr>
   <td>&nbsp;
   
                   </td>
   <td colspan="2">&nbsp;
                   </td>
 <tr>
   <td>&nbsp;</td>
   <td colspan="2">&nbsp;</td>
 </tr>
 <tr>
   <td>&nbsp;</td>
   <td colspan="2">&nbsp;</td>
 </tr>
 
 <tr>
   <td>&nbsp;</td>
   <td colspan="2">&nbsp;</td>
 </tr>
 <tr>
   <td>&nbsp;</td>
   <td colspan="2">&nbsp;</td>
 </tr>
 <tr>
   <td>&nbsp;</td>
   <td colspan="2">&nbsp;</td>
               </tr>-->

            </table>            


            <fieldset id="pymen" style="margin-top:4px; border-radius: 5%; height:383px;" class="super" ><legend style="border:1px solid #00C; background:#fff" >PAYMENT INFORMATIONS</legend>
                <input type="hidden" name="totalcom" id="totalcom" value="0">
<!--                <table style="margin-top: 3%; max-width: 81%;">-->
                <tr><td style="border: 0px solid #000;">

                        <div id="opera" class="input" style="padding-top:5px; width:450px;"> 
                            <table width="100%" height="125" id="tableorder" style="display:none;">
                                <tr>
                                    <td  colspan="3" width="34%" height="20" align="center"  >
                                        <input type="hidden" name="opcion_pago_saldo" id="opcion_pago_saldo" value="1" />
                                        <table width="100%" align="center" id="tableTypeSaldo" style="display:none;">
                                            <tr>
                                                <td colspan="6"   height="20" id="titlett" align="center"  ><strong>PAYMENT OPTION </strong> 
                                                </td>
                                            </tr>

                                            <tr>
<!--                                                    <td>&nbsp;</td>-->
                                                <td width="2%">
                                                    <input name="opcion_saldo" id="opcion_saldo1" value="1" type="radio">
                                                </td>
                                                <td width="20%">Paid Full</td>
                                                <td width="2%"><input name="opcion_saldo" id="opcion_saldo2" value="2" type="radio"  checked="checked"></td>
                                                <td width="20%">Paid Balance</td>
<!--                                                    <td>&nbsp;</td>-->
                                            <tr>
                                            <tr><td colspan="6"><hr /></td></tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td  width="34%" height="35" id="titlett" align="left"  ><strong>PRED-PAID</strong> </td>
                                    <td  width="34%" height="35" id="titlett" align="left"  ><strong>COLLECT ON BOARD</strong> </td>
                                    <td  width="34%" height="35" id="titlett" align="left"  ><strong>VOUCHER</strong> </td>
                                </tr>
                                <tr>
                                    <td valign="top"  >
                                        <table style="width:160px;">    
                                            <tr>
                                                <td colspan="2"></td>
                                            </tr>
                                        <!--   <tr id="tipo_passager">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_passager"  value="2" agencypago="true" type="radio"></td>
                                                                                            <td width="" align="left"><label id="label_tipo_passager" for="opcion_pago_passager" class="opcion_pago">Credit Card no fee</label></td>   </tr>
                                            <tr id="tipo_agency" style="">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_agency"  value="1" agencypago="true" type="radio"></td>
                                              <td width="" align="left"> <label id="label_tipo_agency" for="opcion_pago_agency" class="opcion_pago">Credit Card with fee</label></td>
                                            </tr> 
                                            <tr id="tipo_predpaid_cash" style="">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_cash"  value="6" agencypago="true" type="radio"></td>
                                              <td width="" align="left" id=""> <label id="label_tipo_predpaid_cash" for="opcion_pago_predpaid_cash" class="opcion_pago">Cash in terminal </label></td>
                                            </tr>        -->
                                            <tr id="tipo_passager" style="height:20px;width:160px; display:block;">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_passager"  value="2" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td nowrap="nowrap" width="" align="left"><label id="label_tipo_passager" for="opcion_pago_passager" class="opcion_pago">Credit Card no fee</label></td>
                                            </tr>
                                            <tr id="tipo_agency" style="height:20px; width:160px;  display:block">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_agency"  value="1" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td  nowrap="nowrap" width="" align="left"> <label id="label_tipo_agency" for="opcion_pago_agency" class="opcion_pago">Credit Card with fee</label></td>
                                            </tr>
                                            <tr id="tipo_passager_3" style="height:20px;width:160px; display:block">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_cash"  value="6" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td nowrap="nowrap" > <label id="label_tipo_predpaid_cash" for="opcion_pago_predpaid_cash" class="">Cash</label></td>
                                            </tr>
                                            <tr id="tipo_passager_4" style="height:20px;width:160px; display:block">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_check"  value="10" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td nowrap="nowrap" > <label id="label_tipo_predpaid_check" for="opcion_pago_predpaid_check" class="">Check</label></td>
                                            </tr>
                                        </table>        
                                    </td>
                                    <td valign="top" >
                                        <table style="width:160px;">
                                        <!--  <tr id="tipo_CrediFee">
                                            <td width="5"><input name="opcion_pago" id="opcion_pago_CrediFee" value="3" type="radio"></td>
                                            <td align="left" > <label id="label_tipo_CrediFee" for="opcion_pago_CrediFee" class="opcion_pago">Credit Card+ 3 % FEE</label></td>
                                          </tr>
                                          <tr id="tipo_Cash">
                                            <td width="5"><input name="opcion_pago" id="opcion_pago_Cash" value="4" type="radio"></td>
                                            <td align="left"><label id="label_tipo_Cash" for="opcion_pago_Cash" class="opcion_pago">Cash</label></td>
                                          </tr>-->
                                            <tr id="tipo_passager_2" style="">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_passager_2"  value="8" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td nowrap="nowrap" width="" align="left"><label id="label_tipo_passager_2" for="opcion_pago_passager_2" class="opcion_pago">Credit Card no fee</label></td>
                                            </tr>
                                            <tr id="tipo_CrediFee">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_CrediFee" value="3" type="radio" class="opcion_pago"></td>
                                                <td align="left"  nowrap="nowrap" > <label id="label_tipo_CrediFee" for="opcion_pago_CrediFee" class="opcion_pago">Credit Card with fee</label></td>
                                            </tr>
                                            <tr id="tipo_Cash">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_Cash" value="4" type="radio" class="opcion_pago"></td>
                                                <td align="left"><label id="label_tipo_Cash" for="opcion_pago_Cash" class="opcion_pago">Cash</label></td>
                                            </tr>
                                            <tr id="tipo_Cash_2">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_Cash_2" value="9" type="radio" class="opcion_pago"></td>
                                                <td align="left"><label id="label_tipo_Cash" for="opcion_pago_Cash_2" class="opcion_pago">Check</label></td>
                                            </tr>
                                        </table> 
                                    </td>
                                    <td align="left" valign="top" >
                                        <div id="tipo_Voucher" style="display:none">
                                            <input name="opcion_pago" id="opcion_pago_Voucher" value="5" type="radio"><label id="label_tipo_Cash" for="opcion_pago_Voucher" class="opcion_pago">Credit Voucher</label>
                                        </div>
                                    </td>
                                </tr>

                            </table>


                        </div>

                        <div id="opera" class="input" style="width: 80%;" >


                            <table class="oliveti" style="width: 49%; border: 2px solid #000; margin-left: -8px; margin-top: -9px; height: 139px;">
                                <caption class="rojo" style=" font-weight:bold; font-size:16px; color:#fff;">Passenger Payment Information</caption>

<!--                                    <tr id="tr_agencycomision" style="display:none">
    <td width="132">
        <label  style="padding-left:20px; width:100px; font-size:11px; margin-left:2px;color: #BDBDBD;"><strong>Agency Comision &nbsp;$</strong></label>
    </td>
    <td width="296">
        <label id="totalComision" style="margin-top: 30px; padding-bottom:8px;color: #BDBDBD; "></label>
    </td>
</tr>-->
                                <tr>
                                    <td style="width: 700px;">
                                        <label  style="display:none; font-weight:bold; padding-left:20px; height: 20px; font-size:16px; color:#000;"><strong style="margin-top:-18px; margin-left: 108px; padding-bottom:10px; "><strong>Total Fare&nbsp;$</strong></label>
                                    </td>
                                    <td>
                                        <!--                                        <font  class="black" style="float: left; height:24px; text-align: center;border: #AC1B29 solid thin; background-color: #1B1478; width: 103px; margin-top:3px; font-size:22px; padding-left:3px; height:25px; font-weight:bold; color:#fff;  margin-left: 2px;" id="totalPagar" ></font>
                                                                                <input name="totP" type="hidden"  id="totP" value="" /> -->

                                    </td>
                                </tr>

<!--                                <tr>
    <td style="width: 700px;">
        <label  style="font-weight:bold; padding-left:19px; height: 20px; font-size:16px; color:#000;"><strong style="margin-top:-18px; margin-left: -17px; padding-bottom:10px; "><strong>Total Amount Paid&nbsp;$</strong></label>
    </td>
    <td>
        <input type="text" readonly="readonly"  id="totalAmountPaid" style="font-size:22px; margin-top:7px; margin-left: -11px; width:107px; height:23px; color: green; font-weight:bold; text-align: center;">
    </td>
    
    
</tr>-->


                                <tr style="display:none;">
                                    <td>
                                        <label  style="padding-left:20px; font-size:12px; "><strong style="padding-bottom:0px; color:#090;">Total Amount Paid $</strong></label>

                                    </td>
                                    <td>
                                        <label id="saldoPagado" >$  </label>
                                        <br />
                                    </td>
                                </tr>
                                <td>&nbsp;</td>


                                <tr  style=" height:13px; width:180px;">

                                    <td style="width: 700px;">
                                        <label  style="padding-left:70px; font-size:16px; margin-top:-49px;"><strong   id="txtamountpendiente" style="padding-bottom:0px; color:#000">Amount to Collect&nbsp;$</strong></label>
                                    </td>
                                    <td>
<!--                                    <input type="text" id="otheramount" name="otheramount"  style="text-align: center; height: 24px; font-size: 22px;font-weight: bold;color: #fff;border: #AC1B29 solid thin; background-color: #AC1B29; width: 104px;float:left;width:106px; font-weight:bold; color:fff;" value="" onkeyup="CalcularTotalTotal();"  />-->

                                        <input autocomplete="off" type="text"  class="txtNumbers"  id="saldoporpagar" value=""  style="background-color: #BCED91; border: 1px #33F solid; margin-top: -47px; margin-left: 3px; text-align: center; height: 25px; font-family: sans-serif; font-size: 22px; width:106px;"  />
                                        <!--                                        <label style="text-align: center;  width:105px; background-color: #BCED91; color:#000; font-size: 22px; font-weight: bold; margin-left:3px; border: 1px #33F solid;  margin-top: -11px;width: 106px;height: 23px;  font-family: sans-serif;" id="saldoporpagar" >$  </label>-->


                                        <br />
                                    </td>
                                </tr>
                                <td>&nbsp;</td>


                                <tr style="width: 700px;" ><td>
                                        <label  style=" padding-left:62px; font-size:16px; margin-left:68px; margin-top:-53px; "><strong style="padding-bottom:10px; color: #000;">Paid Driver&nbsp;$</strong></label>    </td>
                                    <td>
                                        <input type="text" id="paid_driver" name="paid_driver" class="brown2"  style="text-align: center; height: 24px; font-size: 22px;font-weight: bold;color: #000; border: #33F solid thin; margin-top: -52px; margin-left: 3px; width: 104px;float:left;width:106px; font-weight:bold; color:fff;" value="" onKeyUp="CalcularTotalTotal();" onclick="CalcularTotalTotal();" />

                                    </td>
                                </tr>

                                <tr style="width: 700px;" >
                                    <td>
                                        <label  style="padding-left:-4px; font-size:16px; margin-left: 20px; margin-top: -30px; "><strong style="padding-bottom:10px; color:#000;">Passenger Balance Due&nbsp;$</strong></label>

                                    </td>

                                    <td>
                                        <input style="border: 1px #33F solid; margin-top: -29px; margin-left: -22px; text-align: center; height: 25px; font-size: 22px; width:106px;" autocomplete="off" type="text" class="gris2"  class="txtNumbers"  name="balance_due" id="balance_due" value=""    />
                                    </td>
                                </tr>


<!--                                <tr id="pay_amount_html" style="height: 50px;">
   <td>

       <label  style="padding-left:48px; font-size:16px; "><strong style="padding-bottom:10px; color:#000;">Add Payment&nbsp;$</strong></label>
        <input autocomplete="off" type="text" class="caja5"  name="pay_amount" id="pay_amount" value=""  onkeyup="PasarPago();"  style=" height:23px; color: green;" />
       
   </td>
   <td>



           <input autocomplete="off" type="text" class="txtNumbers"  name="pay_amount" id="pay_amount" value=""  style=" text-align: center;font-size: 22px;font-weight: bold;color: #fff;border: 1px #33F solid; background-color: #F3FE3D; padding-left:5px; width:100px; height:20px;float:left; margin-top:4px;" />
       <input autocomplete="off" type="text" class="txtNumbers"  name="balance_due" id="balance_due" value=""  style="display:none; height: 24px; text-align: center;font-size: 22px;font-weight: bold;color: #fff;border: 1px #33F solid; background-color: #72CBEC; padding-left:5px; width:100px; height:24px; float:left; margin-top:4px;" />

   </td>
</tr>
                                -->

                            </table>

                            <table class="oliveti" style="width: -8%; border: 2px solid #000; margin-left: -8px; margin-top: 9px; height: 154px; ">

                                <caption class="cerati" style="  font-weight:bold; font-size:16px; color:#fff;">Agency Payment Information</caption>

                                <tr>
                                    <td>
                                        <b style="font-size: 18px; margin-left: 3px; ">Agency Request to Collect&nbsp;$</b>
                                    </td>
                                    <td>

                                    </td>
                                </tr>    
                                <tr>
                                    <td>
                                        <b style="font-size: 18px; margin-top:3px;">Total Net Fare&nbsp;$</b>
                                    </td>
                                    <td>
                                        <font  class="orangered" style="float: left; height:24px; text-align: center;border: #AC1B29 solid thin; background-color: #1B1478; width: 103px; margin-top:3px; font-size:22px; padding-left:3px; height:25px; font-weight:bold; color:#fff;  margin-left: 10px;" id="totalPagar" ></font>
                                        <input name="totP" type="hidden"  id="totP" value="" /> 
                                        <input type="text"  class="orangered" style="display:none; float: left; height:24px; text-align: center;border: #AC1B29 solid thin; font-weight:bold; color:#fff; background-color: #1B1478; height:25px; width: 103px; margin-left: 10px; margin-top:13px; font-size:22px; padding-left:3px;"  id="totalPagarnet" />

                                    </td>
                                </tr>
                                <tr id="pay_amount_html" style="height: 50px;">
                                    <td>
                                        <b style=" color:#000;font-size: 18px;">Amount Paid&nbsp;$</b>                                       
                                    </td>
                                    <td>
                                        <input autocomplete="off" type="text" class="txtNumbers"  name="pay_amount" id="pay_amount" value=""  onKeyUp="CalcularTotalTotal();" onclick="CalcularTotalTotal();" style="text-align: center; z-index: 100; position: absolute; margin-top: -17px; margin-left:-108px; width: 106px; height:25px; font-size:22px;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b style="padding-left:123px; "><strong style="margin-left:-83px; color:#000;font-size: 18px; font-weight:bold;">Agency Balance Due&nbsp;$</strong></b>                                         
                                    </td>
                                    <td>
                                        <input autocomplete="off" type="text" class="gris2"  class="txtNumbers"  name="agency_balance_due" id="agency_balance_due" value=""  style="border: 1px #33F solid; margin-left: 10px; margin-top:-7px; text-align: center; height: 25px; font-size: 22px; width:106px;" />
                                    </td>
                                </tr>  
                            </table>

                        </div>

<!--                        <input autocomplete="off" type="hidden" class="txtNumbers"  name="pay_amount121212" id="pay_amount121212" value=""  style=" " />-->




<!--                            <input  type="button" value="Pay Driver" style="cursor:pointer; margin-top: -10px; margin-left: 303px; padding: 10px;  height: 33px;   width: 119px; color: #AC1B29;font-weight: 700;" />-->


                    </td>


                    <td>
                        <div id="comco" class="input"> <div style="width:275px;">  <label style="color:#4B0082; width:150px;padding-left:100%; margin-left:31px; margin-top:31px;"  ><strong></strong></label></div><textarea id="comments" name="notes" cols="0" rows="0"  placeholder="NOTES" style="margin: 2px; width: 379px; height: 151px; margin-top: -396px; margin-left:551px; border-radius: 0px 15px 0px 0px;"></textarea></div>
                    </td>
                </tr>


                <!--  OTHERAMOUNT onKeyDown="return validarx(event)"        class="txtNumbers"     </table>-->



                <input autocomplete="off" type="text"  class="black"  name="otheramount"  id="otheramount"  style="margin-top: -151px; margin-left: -107px; text-align: center; height: 25px; font-size: 22px;font-weight: bold;color: #fff;border: #AC1B29 solid thin; background-color: #1B1478; width: 103px;float:left;width:106px; font-weight:bold; color:fff;"   value="" onkeyup="CalcularTotalTotal();"/>
<!--                <input autocomplete="off" type="text" class="txtNumbers"  name="otheramount2"  id="otheramount2" onclick="ocultar()"  style="margin-top: -78px; margin-left: -136px; text-align: center; height: 25px; font-size: 22px;font-weight: bold;color: #fff;border: #AC1B29 solid thin; background-color: #1B1478; width: 103px;float:left;width:106px; font-weight:bold; color:fff;" onKeyDown="return validarx(event)"  value=""/>-->
                <script type="text/javascript">
//                    function ocultar()
//                    {
//                        var valor = $('#otheramount2').val();
//                        document.getElementById('otheramount').value = valor;
//                        document.getElementById('otheramount').style.display = '';
//                        document.getElementById('otheramount2').style.display = 'none';
//                    }
                </script>

                <select name="opcion_pago" style="margin-left:-401px; margin-top: 41px;" id="op_pago_id">
                    <optgroup label="COLLECT ON BOARD">
                        <option value="8">Credit Card no fee</option>
                        <option value="3">Credit Card with fee</option>
                        <option value="4">Cash</option>
                        <option value="9">Check</option>
                    </optgroup>
                    <optgroup label="VOUCHER">
                        <option value="5">Credit Voucher</option>
                    </optgroup>
                    <optgroup label="COMPLEMENTARY">
                        <option value="7">Complementary</option>
                    </optgroup>
                </select>


                <!--                <a  type="button"  title="Confirm Booking" style="  margin-left: 871px; margin-top:47px; cursor:pointer" id="btn-save2"></a>-->
                <input  title="Confirm Booking" type="button" id="btn-save2"  style="margin-left: 812px; margin-top:254px; height: 35px; cursor:pointer; color: #000;font-weight: 700; width:124px;" value="Confirm Booking" />
<!--                <i class="fa fa-floppy-o fa-5x" style="color:#fff;"></i>-->

<!--                <input name="apply_payment" type="button" id="apply_payment" onclick="aplicar_pago();"  style="display:none; border-bottom-color: #000; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; cursor:pointer;  margin-left: 65px; margin-top: 26px; padding: 10px;  height: 35px;   width: 118px; color: #000; font-weight: 700; background-color: #F3FF22;" value="Apply Payment" />-->

                <input title="Add Payment" type="button" id="pay_driver" name="pay_driver" onclick="pago_driver();" style="margin-left: 11px; margin-top: -275px; height: 35px; cursor:pointer; color: #000;font-weight: 700; width: 124px;  padding: 10px;" value="Add Payment"/>

            </fieldset>

            <select name="opcion_pago_2" style="margin-left:395px; margin-top: -102px; ">
                <optgroup label="PRED-PAID">
                    <option value="2">Credit Card no fee</option>
                    <option value="1">Credit Card with fee</option>
                    <option value="6">Cash</option>
                    <option value="10">Check</option>
                </optgroup>

            </select>

        </div>

    </div>
<!--    <input autocomplete="off" type="text" class="txtNumbers"  name="pay_amount" id="pay_amount" value=""  onkeyup="PasarPago();" style=" text-align: center;font-size: 22px;font-weight: bold; color:green; border: 1px #33F solid; background-color: #FFFD; padding-left:5px; width:102px; height:23px; float:left; margin-top:-163px; margin-left:258px; " />-->


</form>
<div id="userr"></div>
<div id="puestosEnUso"></div>

<div id="dialog_states__trips" title="Seats available on trips" style="display:none;">
    <div>
        <div id="states__trips_conte"></div>
    </div>
</div>

<div id="dialog-trip-pregunta" title="Time limit for booking" style="display:none">
    <p>
    <div id="reloj_temporizador" class="temporizador"></div>
    <div id="mensaje_trips_pregunta"></div>
</p>
</div>

<div id="miVentana" style="position: fixed; width: 195px; height: 170px;  top:441px; left: 55px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">

    <div style="font-weight: bold; text-align: left; color: #FFFFFF; padding: 5px; background-color:#006394">Apply Payment</div>
    <label  style="padding-left:57px; font-size:16px; margin-left:-55px;"><strong style="text-align: center; padding-bottom:10px; color: #000;">$</strong></label> 
    <input name="aplica_pago" type="text" id="aplica_pago" size="12" style=" width:114px; height:20px;" value="0.00" />
<!--    <p style="padding: 5px; text-align: justify; line-height:normal">Suspendisse vehicula, nisl vitae molestie pulvinar, eros nunc volutpat neque, sit amet ultricies nulla sem at ipsum.</p>-->
    <select name="opcion_pago_2" id="opcion_pago_2" style="margin-left:6px; margin-top: 5px; ">
        <optgroup label="PRED-PAID">
            <option value="2">Credit Card no fee</option>
            <option value="1">Credit Card with fee</option>
            <option value="6">Cash</option>
            <option value="10">Check</option>
        </optgroup>

    </select>

    <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;">
        <input id="btnAceptar" onclick="ocultarVentana();" name="btnAceptar" size="20" type="button" value="Aceptar" onClick="CalcularTotalTotal();"/>

    </div>
</div>      


<div id="miVentana2" style="position: fixed; width: 174px; height: 170px;  top:407px; left: 86px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">

    <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#006394">Add Payment</div>
    <label  style="padding-left:57px; font-size:16px; "><strong style="padding-bottom:10px; color: #000; margin-left:-55px;">$</strong></label> 

    <!--class="money"-->
    <input name="pago_driver"   type="text" id="pago_driver" size="12" style="font-size: 22px;  text-align:right; margin-top:6px; margin-left:29px; width:114px; height:20px;" value="0.00" onkeyup="dupliPago();"/>

    <input name="pago_driver2"  type="text" id="pago_driver2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />
<!--    <input name="someTextBox" type="text" id="someTextBox" size="12" style="display:none; margin-top:9px; margin-left:27px; width:114px; height:20px;" value="0.00" />-->

<!--    <p style="padding: 5px; text-align: justify; line-height:normal">Suspendisse vehicula, nisl vitae molestie pulvinar, eros nunc volutpat neque, sit amet ultricies nulla sem at ipsum.</p>-->
    <select name="opcion_pago1" id="op_pago_id1" style="margin-left:6px; margin-top: 8px;" onclick="calculos()">
        <option id="" value="0">((( Amount Paid )))</option>
        <optgroup label="PRED-PAID">
            <option value="20">Credit Card no fee</option>
            <option value="21">Credit Card with fee</option>
            <option value="22">Cash</option>
            <option value="23">Check</option>
        </optgroup>
        <option id="" value="1">((( Paid Driver )))</option>
        <optgroup label="COLLECT ON BOARD">
            <option value="24">Credit Card no fee</option>
            <option value="25">Credit Card with fee</option>
            <option value="26">Cash</option>
            <option value="27">Check</option>
        </optgroup>       


    </select>

    <script>

        function calculos() {

            var opcion = $("#op_pago_id1").val();

            //PRED-PAID////////////////////////////////////////////

            //Credit Card no fee

            if (opcion === '20') {

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                $("#pago_driver").val((total).toFixed(2));
            }

            //Credit Card with fee

            if (opcion === '21') {

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var valor = pago_driver2 * 0.04;

                var total = (pago_driver2) + (valor);

                $("#pago_driver").val((total).toFixed(2));

            }

            //Cash
            if (opcion === '22') {

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                $("#pago_driver").val((total).toFixed(2));
            }

            //Check
            if (opcion === '23') {

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);


                $("#pago_driver").val((total).toFixed(2));
            }



            ////////////////////////////////////////////////////////



            //COLLECT ON BOARD//////////////////////////////////////

            //Credit Card no fee
            if (opcion === '24') {

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                $("#pago_driver").val((total).toFixed(2));
                

            }

            //Credit Card with fee
            if (opcion === '25') {

                var pago_driver = parseInt($("#pago_driver").val());

                var valor = pago_driver * 0.04;

                var total = (pago_driver) + (valor);

                $("#pago_driver").val((total).toFixed(2));

            }

            //Cash
            if (opcion === '26') {

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                $("#pago_driver").val((total).toFixed(2));

            }

            //Check

            if (opcion === '27') {

                var pago_driver2 = parseInt($("#pago_driver2").val());

                var total = (pago_driver2);

                $("#pago_driver").val((total).toFixed(2));

            }



        }
    </script>

    <!--presionar();-->
    <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;">
        <input id="btnExit" onclick="Exit();" name="btnExit" size="20" type="button" value="Exit"  />
        <input id="btnCancelar" onclick="reset();" name="btnCancelar" size="20" type="button" value="Reset"  />
        <input id="btnAceptar" onclick="ocultarVentana2();" name="btnAceptar" size="20" type="button" value="Save"  />

    </div>
</div>      

<style>
    #rectangulo {
        border: solid 2px #000;
        margin-left: 86px;
        margin-top: -360px;
        height: 198px;
        width: 284px;
        display:none;
    }

</style>

<script type="text/javascript">
    function PasarPago()
    {
//        var pay_amount = document.getElementById('pay_amount').value;
//        document.getElementById('totalAmountPaid').value = pay_amount;

    }
</script>

<script type="text/javascript">
    function reset()
    {

        document.getElementById('pago_driver').value = '0.00';
        document.getElementById('pago_driver2').value = '0.00';
        document.getElementById('op_pago_id1').value = 0;

    }
</script>

<script type="text/javascript">
    function dupliPago()
    {
//       ("#pago_driver").mask("99,99");
        var dupli = document.getElementById('pago_driver').value;
        document.getElementById('pago_driver2').value = dupli;

    }
</script>
<!--<table width="100" height="100" border="1" bordercolor="#00FF00" background ="" bgcolor="#0000FF"> <tr>    <td>sss </tr></table>-->

<script type="text/javascript">
    function Exit()
    {
        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
        ventana2.style.display = 'none'; // Y lo hacemos invisible

    }
</script>

<script type="text/javascript">
    function aplicar_pago() {
        //alert('mostrar');
        var ventana = document.getElementById('miVentana'); // Accedemos al contenedor

        var totalPagar = document.getElementById('totalPagar').value;

//        alert(totalPagar);
        ventana.style.marginTop = "100px"; // Definimos su posición vertical. La ponemos fija para simplificar el código
        ventana.style.marginLeft = ((document.body.clientWidth - 350) / 2) + "px"; // Definimos su posición horizontal
        ventana.style.display = 'block'; // Y lo hacemos visible
    }
    function ocultarVentana()
    {
        var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
        ventana.style.display = 'none'; // Y lo hacemos invisible
        var opcion_pago_2 = $('#opcion_pago_2').val();
        var aplica_pago = $('#aplica_pago').val();

        // document.getElementById('pay_amount').value = aplica_pago;
        //var resultados = prueba + opcion_pago_2;
        //alert(opcion_pago_2);
    }
    //document.getElementById('otheramount').value = totalPagar;
</script>

<script type="text/javascript">
    function pago_driver() {
        //alert('mostrar');
        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
        ventana2.style.marginTop = "100px"; // Definimos su posición vertical. La ponemos fija para simplificar el código
        ventana2.style.marginLeft = ((document.body.clientWidth - 350) / 2) + "px"; // Definimos su posición horizontal
        ventana2.style.display = 'block'; // Y lo hacemos visible
        document.getElementById('pago_driver').value = '0.00';
        document.getElementById('op_pago_id1').value = 0;



        //$('#pago_driver').val()='0.00';
    }

    function ocultarVentana2()
    {
        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor

        var opcion_pago = $('#opcion_pago_id').val();
        var pago_driver = $('#pago_driver').val();
        var opcion = $("#op_pago_id1").val();

        //PRED-PAID////////////////////////////////////////////
        //Credit Card with fee

        if (opcion === '0') {

            document.getElementById('paid_driver').value = '0.00';
            document.getElementById('pay_amount').value = '0.00';

            setTimeout(function () {
                $('#pay_amount').click();

            }, 0.001);

            setTimeout(function () {
                $('#paid_driver').click();

            }, 0.001);



        }

        if (opcion === '1') {

            document.getElementById('paid_driver').value = '0.00';
            document.getElementById('pay_amount').value = '0.00';

            setTimeout(function () {
                $('#pay_amount').click();

            }, 0.001);

            setTimeout(function () {
                $('#paid_driver').click();

            }, 0.001);

        }

        //Pred-Paid

        if (opcion === '20') {

            document.getElementById('pay_amount').value = pago_driver;

            setTimeout(function () {
                $('#pay_amount').click();

            }, 0.001);

        }

        if (opcion === '21') {

            document.getElementById('pay_amount').value = pago_driver;

            setTimeout(function () {
                $('#pay_amount').click();

            }, 0.001);

        }

        if (opcion === '22') {

            document.getElementById('pay_amount').value = pago_driver;

            setTimeout(function () {
                $('#pay_amount').click();

            }, 0.001);

        }

        if (opcion === '23') {

            document.getElementById('pay_amount').value = pago_driver;

            setTimeout(function () {
                $('#pay_amount').click();

            }, 0.001);

        }

        //Collect on Board

        if (opcion === '24') {

            document.getElementById('paid_driver').value = pago_driver;
            document.getElementById('pay_amount').value = pago_driver;

            setTimeout(function () {
                $('#paid_driver').click();

            }, 0.001);
            
            setTimeout(function () {
                $('#pay_amount').click();

            }, 0.001);



        }

        if (opcion === '25') {

            document.getElementById('paid_driver').value = pago_driver;
            document.getElementById('pay_amount').value = pago_driver;

            setTimeout(function () {
                $('#paid_driver').click();

            }, 0.001);
            
            setTimeout(function () {
                $('#pay_amount').click();

            }, 0.001);



        }

        if (opcion === '26') {

            document.getElementById('paid_driver').value = pago_driver;
            document.getElementById('pay_amount').value = pago_driver;

            setTimeout(function () {
                $('#paid_driver').click();

            }, 0.001);
            
            setTimeout(function () {
                $('#pay_amount').click();

            }, 0.001);



        }

        if (opcion === '27') {

            document.getElementById('paid_driver').value = pago_driver;
            document.getElementById('pay_amount').value = pago_driver;

            setTimeout(function () {
                $('#paid_driver').click();

            }, 0.001);
            
            setTimeout(function () {
                $('#pay_amount').click();

            }, 0.001);



        }


        //var resultados = prueba + opcion_pago_2;
        //alert(pago_driver);
    }
</script>

<canvas id="rectangulo" width="300" height="150"></canvas>


<script type="text/javascript">


    // var pago_driver = $('#totalpagar').val();

    document.getElementById('otheramount').value = ('0.00');
    document.getElementById('totalPagarnet').value = ('0.00');
    document.getElementById('balance_due').value = ('0.00');
    document.getElementById('agency_balance_due').value = ('0.00');
    document.getElementById('pay_amount').value = ('0.00');
    document.getElementById('paid_driver').value = ('0.00');


    $("#opcion_pago_Voucher").change(function () {
        $("#pay_amount_html").hide();
    });
    $("#opcion_pago_Cash").change(function () {
        $("#pay_amount_html").show();
    });
    $("#label_tipo_CrediFee").change(function () {
        $("#pay_amount_html").show();
    });
    $("#opcion_pago_agency").change(function () {
        $("#pay_amount_html").show();
    });
    $("#opcion_pago_passager").change(function () {
        $("#pay_amount_html").show();
    });


    $("#op_pago_id").change(function () {
        CalcularTotalTotal();
    });
    $("#pay_amount").change(function () {
        CalcularTotalTotal();
    });

    $("#paid_driver").change(function () {
        CalcularTotalTotal();
    });

    $(document).ready(function () {

        $("#calan_phone").attr('checked', true);

        var tipo;



        client = document.getElementById("newClient");
//client.style.visibility = "hidden";

        if ($("#pax").val() != "" || $("#pax2").val() != "") {

            var pax = $('#pax').val();
            var pax2 = $('#pax2').val();
            var total;

            if (pax2 == "") {
                pax2 = 0;
                // $('#pax2').val(0);
            }

            if (pax == "") {
                pax = 0;
                $('#pax').val(0);
            }

            total = (parseInt(pax) + parseInt(pax2));
            $('#totalpax').val(total);
            CalcularTotalTotal();
        }


        var validar = '<?php echo $valida ?>';


        if (validar) {

            $("#oneway").attr("checked", true);
//            alert("hola");

            $("#round").css("display", "none");

            $(".sup2").css("margin-top", "2px");


        }

        $('#uagency').attr('disabled', 'disabled');
        //$('#leader').focus();
        $('#agency').focus();
        $.fn.autosugguest({
            className: 'ausu-suggest',
            methodType: 'POST',
            minChars: 1,
            rtnIDs: true,
            dataFile: '<?php echo $data['rootUrl']; ?>leader/ajax'
        });

        var id = $("#from").val();


        if (id != "") {

            $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id), function (response, status, xhr) {
                if (response != '') {
                    var id2 = $("#to").val();

                    if ('<?php echo $valida ?>' == "") {

                        var idto = $("#valto").val();

                        $("#to option[value=" + idto + "]").attr("selected", true);
                        $("#from2 option[value=" + idto + "]").attr("selected", true);

                        var idFrom = $("#from").val();
                        $("#to2 option[value=" + idFrom + "]").attr("selected", true);

                        $('#from2').attr('disabled', 'disabled');
                        $('#to2').attr('disabled', 'disabled');
                    }



                    $("#ext_to1").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id2));

                    $("#ext_from2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id2));

                }
            });

            $("#ext_from1").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));
            $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));

        }

    });

    function poner(id, id2) {
        var id = id;
        var id2 = id2;

        $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>leader/ajax2/' + id + '/' + id2), function (response, status, xhr) {
            var id_leader = $('#id_leader').val();
            $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/superclub/' + id_leader));
        });

    }


    $('#agency').change(function () {
        if ($("#agency").val() == "") {
            $('#uagency').attr('disabled', true);
            $('#uagency').val('');
            $('#id_auser').val('');
            $('#id_agency').val('-1');
            $('#comision').val('0');
            $('#disponible').val('0');
        } else {
            $('#uagency').attr('disabled', false);
        }
        $("#price_exten01").val(0);
        $("#price_exten02").val(0);

        $("#subtochild1").val(0);
        $("#subtoadult1").val(0);
        $("#subtochild22").val(0);
        $("#subtoadult22").val(0);
        $("#subtochild33").val(0);
        $("#subtoadult33").val(0);


        $("#trip_no").val("");

        $("#price_exten03").val(0);
        $("#price_exten04").val(0);

        $("#subtochild2").val(0);
        $("#subtoadult2").val(0);
        $("#trip_no2").val("");

        $("#pickup1").val("");
        $("#dropoff1").val("");
        $("#pickup2").val("");
        $("#dropoff2").val("");


        $("#from option[value=" + 0 + "]").attr("selected", true);
        $("#to option[value=" + 0 + "]").attr("selected", true);
        $("#from2 option[value=" + 0 + "]").attr("selected", true);
        $("#to2 option[value=" + 0 + "]").attr("selected", true);

        $("#ext_from1 option[value=" + 0 + "]").attr("selected", true);
        $("#ext_from2 option[value=" + 0 + "]").attr("selected", true);
        $("#ext_to1 option[value=" + 0 + "]").attr("selected", true);
        $("#ext_to2 option[value=" + 0 + "]").attr("selected", true);

        $("#ext_from1").html("");
        $("#ext_from2").html("");

        $("#ext_to1").html("");
        $("#ext_to2").html("");

        CalcularTotalTotal();

    });



    $('#pax').change(function () {
        var pax = $('#pax').val();
        var pax2 = $('#pax2').val();
        var total;
        if (pax2 === "") {
            pax2 = 0;
            // $('#pax2').val(0);
        }
        if (pax == "") {
            pax = 0;
            $('#pax').val(0);
        }
        total = (parseInt(pax) + parseInt(pax2));
        $('#totalpax').val(total);

        CalcularTotalTotal();

    });

    function CalcularTotal(pax_1, pax_2) {


        var x = $("#price1").val();

        if (x == 1) {
            var transporChil1 = $("#subtochild1").val();
            var transporAdul1 = $("#subtoadult1").val();
        }

        if (x == 2) {
            var transporChil1 = $("#subtochild22").val();
            var transporAdul1 = $("#subtoadult22").val();
        }

        if (x == 3) {
            var transporChil1 = $("#subtochild33").val();
            var transporAdul1 = $("#subtoadult33").val();
        }

        var transporChil2 = $("#subtochild2").val();
        var transporAdul2 = $("#subtoadult2").val();
        var price_exten01 = $("#price_exten01").val();
        var price_exten02 = $("#price_exten02").val();
        var price_exten03 = $("#price_exten03").val();
        var price_exten04 = $("#price_exten04").val();

        if (isNaN(transporChil1)) {
            transporChil1 = 0;
        }
        if (isNaN(transporAdul1)) {
            transporAdul1 = 0;
        }
        if (isNaN(transporChil2)) {
            transporChil2 = 0;
        }
        if (isNaN(transporAdul2)) {
            transporAdul2 = 0;
        }



//        if($("#subtoadult1").val()==''){           
//           transporAdul1 = 0;   
//           
//        }
//        
//        if($("#subtochild1").val()==''){
//           transporChil1 = 0;
//        }
//        
//        if($("#subtoadult2").val()==''){           
//           transporAdul2 = 0;           
//        }
//        
//        if($("#subtochild2").val()==''){
//           transporChil2 = 0;
//        }



        if (isNaN(price_exten01)) {
            price_exten01 = 0;
        }
        if (isNaN(price_exten02)) {
            price_exten02 = 0;
        }
        if (isNaN(price_exten03)) {
            price_exten03 = 0;
        }
        if (isNaN(price_exten04)) {
            price_exten04 = 0;
        }

        //alert(transporChil1+', '+transporAdul1+', '+transporChil2+', '+transporAdul2+', '+price_exten01+', '+price_exten02+', '+price_exten03+', '+price_exten04);
        var price_exten = parseFloat(price_exten01) + parseFloat(price_exten02) + parseFloat(price_exten03) + parseFloat(price_exten04);

        var transadult = (parseFloat(transporAdul1) + parseFloat(transporAdul2)) * pax_1;
        var transchild = (parseFloat(transporChil1) + parseFloat(transporChil2)) * pax_2;



        var totalA = parseFloat(transadult) + (parseFloat(price_exten) * pax_1);
        var totalC = parseFloat(transchild) + (parseFloat(price_exten) * pax_2);

        var totalP = totalA + totalC;
        $("#totalPagar2").text(totalP.toFixed(2));
        $("#extenadult").text('$' + (price_exten * pax_1).toFixed(2));
        $("#extenchil").text('$' + (price_exten * pax_2).toFixed(2));
        $("#transporadult").text('$' + transadult.toFixed(2));
        $("#transporechil").text('$' + transchild.toFixed(2));

        $("#subtoadult").text('$' + (totalA / parseFloat($("#pax").val())).toFixed(2));
        $("#transporechil").text('$' + transchild.toFixed(2));
        if (parseFloat($("#pax2").val()) <= 0) {
            $("#subtochild").text('$0.00');
        } else {
            $("#subtochild").text('$' + (totalC / parseFloat($("#pax2").val())).toFixed(2));
        }
        return totalP;
    }

    function comision() {

        var id_agency = $('#id_agency').val();
        var type_rate = $('#type_rate').val();

        if (id_agency == '-1') {
            id_agency = -1;
            type_rate = 0;

            return 0;
        }
        if (type_rate == '1') {

            $("#comision").val(0);

        }
        var pax_1 = $('#pax').val();
        var pax_2 = $('#pax2').val();
        var total;
        if (pax_1 == "") {
            pax_1 = 0;
        }
        if (pax_2 == "") {
            pax_2 = 0;
        }

        var totalP = CalcularTotal(pax_1, pax_2);
        if (totalP > 0) {
            var transporChil1 = $("#subtochild1").val();
            var transporAdul1 = $("#subtoadult1").val();
            var transporChil2 = $("#subtochild2").val();
            var transporAdul2 = $("#subtoadult2").val();
            var porc_comi1 = $("#valorcomision01").val();
            var porc_comi2 = $("#valorcomision02").val();
            if (porc_comi2 != 0) {
                var porc_comiEx = (parseFloat(porc_comi1) + parseFloat(porc_comi2)) / 2;
                $("#comision").val((parseFloat(porc_comi1) + parseFloat(porc_comi2) + parseFloat(porc_comiEx)) / 2);
            } else {
                var porc_comiEx = porc_comi1;
                $("#comision").val(porc_comi1);
            }
            var transpor1 = (parseFloat(transporChil1) * parseFloat(pax_2)) + (parseFloat(transporAdul1) * parseFloat(pax_1));
            var transpor2 = (parseFloat(transporChil2) * parseFloat(pax_2)) + (parseFloat(transporAdul2) * parseFloat(pax_1));
            var transporEx = parseFloat(totalP) - (parseFloat(transpor1) + parseFloat(transpor2));
            var comiT1 = parseFloat(transpor1) * parseFloat(porc_comi1) / 100;
            var comiT2 = parseFloat(transpor2) * parseFloat(porc_comi2) / 100;

            if (transporEx > 0) {
                var comiEx = parseFloat(transporEx) * parseFloat(porc_comiEx) / 100;
            } else {
                var comiEx = 0;
            }
            var comi = parseFloat(comiT1) + parseFloat(comiT2) + parseFloat(comiEx);
            //alert(comi);
            $("#totalComision").text(comi.toFixed(2));
            $("#totalcom").val(comi);
            $("#totalPagar").text(Math.ceil(totalP).toFixed(2));
            //alert(subtotalAdulto+', '+subtotalninio+', '+totalP+','+transporChil1+', '+transporAdul1+', '+transporChil2+', '+transporAdul2+', '+porc_comi1+', '+porc_comi2+', '+transpor1+', '+transpor2+', '+transporEx+', '+comiT1+', '+comiT2+', '+porc_comi2+', '+comiEx+', '+comi);

        } else {

            var comi = 0;
        }
        return comi;
    }

    $('#pax2').change(function () {

        var pax = $('#pax').val();
        var pax2 = $('#pax2').val();
        if (pax2 == "") {
            pax2 = 0;
            $('#pax2').val(0);
        }
        if (pax == "") {
            pax = 0;
            $('#pax').val(0);
        }
        var total;
        total = (parseInt(pax) + parseInt(pax2));

        $('#totalpax').val(total);

        CalcularTotalTotal();
    });




    $('#oneway').change(function () {
        /*$("#round").css("display", "none");*/
//        $("#fecha_retorno").attr("readonly", 'readonly');
//        $("#fecha_retorno").attr("disable", 'disable');
//        $("#from2").attr("disable", true);
//        $("#from2").attr("readonly", "readonly");
//        $("#pickup2").attr("readonly", "readonly");
//        $("#dropoff2").attr("readonly", "readonly");
//        $("#arrival2").attr("readonly", "readonly");
//        $("#to2").attr("readonly", "readonly");
//        $("#ext_from2").attr("readonly", "readonly");
//        $("#departure2").attr("readonly", "readonly");
//        $("#ext_to2").attr("readonly", "readonly");
//        $("#room2").attr("readonly", "readonly");
//        $("#exten3").attr("readonly", "readonly");
//        $("#exten4").attr("readonly", "readonly");
//        $("#trip_no2").html("");
//        $("#departure2").html("");
//        $("#arrival2").html("");

        $("#trip_no2").val("");
        $("#departure2").val("");
        $("#arrival2").val("");
        $("#fecha_retorno").val("");

        $("#pickup2").val("");
        $("#id_pickup2").val("");

        $("#dropoff2").val("");
        $("#id_dropoff2").val("");

        $("#exten3").val("");
        $("#id_ext_pikup3").val("");

        $("#exten4").val("");
        $("#id_ext_pikup4").val("");


        $("#ext_to2").find('option').removeAttr("selected");
        $("#ext_from2").find('option').removeAttr("selected");

        $("#round").css("display", "none");
        $(".sup2").css("margin-top", "2px");
        $("#subtochild2").val(0);
        $("#subtoadult2").val(0);
        $("#price_exten03").val(0);
        $("#price_exten04").val(0);
        CalcularTotalTotal();
    });

    $('#roundtrip').change(function () {
//        $("#fecha_retorno").attr("disable", '');
//        $("#fecha_retorno").removeAttr("disable");
//        $("#from2").attr("disable", false);
//        $("#departure2").removeAttr("readonly");
//        $("#dropoff2").removeAttr("readonly");
//        $("#pickup2").removeAttr("readonly");
//        $("#arrival2").removeAttr("readonly");
//        $("#to2").removeAttr("readonly");
//        $("#ext_from2").removeAttr("readonly");
//        $("#ext_to2").removeAttr("readonly");
//        $("#exten3").removeAttr("readonly");
//        $("#exten4").removeAttr("readonly");
//        $("#room2").removeAttr("readonly");
//        $("#from2").removeAttr("readonly");
//        $("#round").css("display", "block");
        $("#round").css("display", "block");
        $(".sup2").css("margin-top", " -209px");

    });


    $('#fecha_salida').datepicker({
        dateFormat: 'mm-dd-yy',
        minDate: 0
    });

    $("#dataclick1").click(function (e) {
        e.preventDefault();
        //$("#fecha_salida").datepicker("show");
    });

    $("#fecha_retorno").datepicker({
        dateFormat: 'mm-dd-yy',
        beforeShow: function () {
            if ($('#fecha_retorno').attr("disable")) {
                return false;
            }
        }
    });

    $("#dataclick2").click(function (e) {
        e.preventDefault();
        //$("#fecha_retorno").datepicker("show");
    });

    $("#fecha_salida").change(function () {

        $("#trip_no").val('');
        $("#departure1").val('');
        $("#arrival1").val('');
        $("#subtochild1").val(0);
        $("#subtoadult1").val(0);
        CalcularTotalTotal();

        fechaRetorno($("#fecha_salida").val());
    });
    function fechaRetorno(menor) {
        var d = new Date(menor);
        d.setTime(d.getTime())
        $('#fecha_retorno').datepicker('option', 'minDate', d);
    }

    $("#fecha_retorno").change(function () {
        $("#trip_no2").val('');
        $("#departure2").val('');
        $("#arrival2").val('');
        $("#subtochild2").val(0);
        $("#subtoadult2").val(0);
        CalcularTotalTotal();
    });

    $("#from").change(function () {
        var id = $("#from").val();
        $("#pickup1").val('');
        $("#id_p1").val('');
//       $("#dropoff2").val('');
//       $("#id_dropoff2").val('');
        $("#dropoff1").val('');
        $("#id_dropoff1").val('');
//        $("#pickup2").val('');
//        $("#id_pickup2").val('');

        $('#pickup1').removeAttr("disabled");

        $("#price_exten01").val(0);
        $("#price_exten02").val(0);

        $("#subtochild1").val(0);
        $("#subtoadult1").val(0);
        $("#trip_no").val("");
        CalcularTotalTotal();
        $('#exten1').attr('disabled', 'disabled');
        $("#exten1").val('');
        if (id != "") {
            var id_agency = $("#id_agency").val();
            $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
            $("#ext_to1").load(encodeURI('<?php echo $data['rootUrl']; ?>exten_to_tot_of_from/' + id));
//            $("#ext_from2").load(encodeURI('<?php echo $data['rootUrl']; ?>exten_to_tot_of_from/' + id));
//            $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>exten_to_tot_of_from/' + id));

//            $("#from2").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id), function() {
//                $("#to2").load(encodeURI('<?php echo $data['rootUrl']; ?>area_to_tot_of_from/' + $("#from2").val()));
//            });
            $("#ext_from1").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id + '/' + id_agency));


        }
    });

    $("#to").change(function () {

        var id = $("#to").val();
//        $("#dropoff2").val('');
//        $("#id_dropoff2").val('');
        $("#dropoff1").val('');
        $("#id_dropoff1").val('');
//        $("#pickup2").val('');
//        $("#id_pickup2").val('');

        $('#dropoff1').removeAttr("disabled");

//        $("#price_exten01").val(0);
        $("#price_exten02").val(0);

        $("#subtochild1").val(0);
        $("#subtoadult1").val(0);
        $("#trip_no").val("");
        CalcularTotalTotal();
        $('#exten2').attr('disabled', 'disabled');
        $("#exten2").val('');
        if (id != "") {
            var id_agency = $("#id_agency").val();
//            $("#ext_from2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id + '/' + id_agency));
//            $("#from2").attr("value", id);
//            setTimeout($("#to2").load(encodeURI('<?php echo $data['rootUrl']; ?>area_to_tot_of_from/' + $("#from2").val())), 200);
            var idFrom = $("#from").val();
        }
    });


    $("#from2").change(function () {

        var id = $("#from2").val();
        $("#dropoff2").val('');
        $("#id_dropoff2").val('');
        $("#pickup2").val('');
        $("#id_pickup2").val('');

        $('#pickup2').removeAttr("disabled");


        $("#price_exten03").val(0);
        $("#price_exten04").val(0);

        $("#subtochild2").val(0);
        $("#subtoadult2").val(0);
        $("#trip_no2").val("");
        CalcularTotalTotal();
        $('#exten3').attr('disabled', 'disabled');
        $("#exten3").val('');
        if (id != "") {
            var id_agency = $("#id_agency").val();
            $("#to2").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
            $("#ext_from2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id + '/' + id_agency));
            $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>exten_to_tot_of_from/' + id));
        }
    });

    $("#to2").change(function () {

        var id = $("#to2").val();
        $("#dropoff2").val('');
        $("#id_dropoff2").val('');

        $('#dropoff2').removeAttr("disabled");

//        $("#price_exten03").val(0);
        $("#price_exten04").val(0);

        $("#subtochild2").val(0);
        $("#subtoadult2").val(0);
        $("#trip_no2").val("");
        CalcularTotalTotal();
        $('#exten4').attr('disabled', 'disabled');
        $("#exten4").val('');
        if (id != "") {
            var id_agency = $("#id_agency").val();
            $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id + '/' + id_agency));
        }
    });


//    function changevalue()
//        {
//           //var text2 = document.getElementById('transporadult');
//           //obtenemos el objeto del elemento de id x..
//           var text2 = document.getElementById('x');
//
//           //aca asignas los valores a las cajas de texto declaradas
//           text2.value = document.getElementById('price_exten01').value;
//           // ...
//           // ....
//        }

    function extenprince(id, id2) {

        if (document.getElementById('oneway').checked) {

            var from = $("#from").val();
            var to = $("#to").val();
            var trip_no = $('#trip_no').val();
            var fechasal = $("#fecha_salida").val();

            var tp = 1;

        }


        if (document.getElementById('roundtrip').checked) {

            var from = $("#from").val();
            var to = $("#to").val();
            var trip_no = $('#trip_no').val();
            var fechasal = $("#fecha_salida").val();

            var from2 = $("#from2").val();
            var to2 = $("#to2").val();
            var trip_no2 = $('#trip_no2').val();
            var fecharetor = $("#fecha_retorno").val();

            var tp = 2;

        }


        var transAdult = $("#transporadult").text();
        var transChild = $("#transporechil").text();




        if (isNaN(transAdult)) {
            transAdult = 0;
        } else {
            transAdult = parseFloat(transAdult.substring(1, transAdult.length));
        }
        if (isNaN(transChild)) {
            transChild = 0;
        } else {
            transChild = parseFloat(transChild.substring(1, transChild.length));
        }
        var id_agency = $("#id_agency").val();

        var type_rate = $("#type_rate").val();
        if (id_agency == '') {
            id_agency = '-1';
        }


        //var url = '<? echo $data['rootUrl']; ?>consul/extenp/' + id + '/' + id2 + '/' + transAdult + '/' + transChild + '/' + type_rate + '/' + id_agency + '/' + from + '/' + to + '/' + trip_no + '/' + fechasal + '/' + tp;

        var url = '<?php echo $data['rootUrl']; ?>consul/extenp/' + id + '/' + id2 + '/' + transAdult + '/' + transChild + '/' + type_rate + '/' + id_agency + '/' + from + '/' + to + '/' + trip_no + '/' + fechasal + '/' + tp + '/' + from2 + '/' + to2 + '/' + trip_no2 + '/' + fecharetor;
//        var url = '<? echo $data['rootUrl']; ?>consul/exten/' + id + '/' + from + '/' + to + '/' + trip_no + '/' + fechasal;
        $("#userr").load(encodeURI(url));

    }

    $("#ext_from1").change(function () {
        var id = $("#ext_from1").val();
        var id2 = 1;
        extenprince(id, id2);
        if (id > 0) {
            $('#exten1').removeAttr('disabled');
            $("#pickup1").val('');
            $("#id_p1").val('');
            $('#pickup1').attr('disabled', 'disabled');
        } else {
            $('#pickup1').removeAttr('disabled');
            $('#exten1').attr('disabled', 'disabled');
            $("#exten1").val('');
            $("#id_ext_pikup1").val('');
        }
    });
    $("#ext_to1").change(function () {
        var id = $("#ext_to1").val();
        var id2 = 2;
        extenprince(id, id2);
        if (id > 0) {
            $('#exten2').removeAttr('disabled');
            $("#dropoff1").val('');
            $("#id_dropoff1").val('');
            $('#dropoff1').attr('disabled', 'disabled');
        } else {
            $('#dropoff1').removeAttr('disabled');
            $('#exten2').attr('disabled', 'disabled');
            $("#exten2").val('');
            $("#id_ext_pikup2").val('');
        }
    });

    $("#ext_from2").change(function () {

        var id = $("#ext_from2").val();
        var id2 = 3;
        extenprince(id, id2);
        if (id > 0) {
            $('#exten3').removeAttr('disabled');
            $("#pickup2").val('');
            $("#id_pickup2").val('');
            $('#pickup2').attr('disabled', 'disabled');
        } else {
            $('#pickup2').removeAttr('disabled');
            $('#exten3').attr('disabled', 'disabled');
            $("#exten3").val('');
            $("#id_ext_pikup2").val('');
        }
    });
    $("#ext_to2").change(function () {
        var id = $("#ext_to2").val();
        var id2 = 4;
        extenprince(id, id2);
        if (id > 0) {
            $('#exten4').removeAttr('disabled');
            $("#dropoff2").val('');
            $("#id_dropoff2").val('');
            $('#dropoff2').attr('disabled', 'disabled');
        } else {
            $('#dropoff2').removeAttr('disabled');
            $('#exten4').attr('disabled', 'disabled');
            $("#exten4").val('');
            $("#id_ext_pikup4").val('');
        }
    });

    function valorExtra() {
        CalcularTotalTotal();
    }
    $("#extra").change(function () {
        valorExtra();
    });

    $("#descuento").keypress(Event, function (e) {
        if (e.charCode > 47 && e.charCode < 58) {
            var char = String.fromCharCode(e.charCode);
            var valor = $("#descuento").val()
            var d = valor + '' + char;
            if (d > 100 || d < 0) {
                return false;
            }
            /*
             $("#descuento").val(valor + char + '%');
             var pos = valor.length;
             
             if((valor+char) == '' ){
             $("#descuento").val('0%');
             }  
             establerCursorPosicion(pos+1,'descuento');*/
        } else {
            return false;
        }
    });

    var saber;

    $("#tipo_pass").change(function () {
        $("#price_exten01").val(0);
        $("#price_exten02").val(0);

        $("#subtochild1").val(0);
        $("#subtoadult1").val(0);
        $("#trip_no").val("");

        $("#price_exten03").val(0);
        $("#price_exten04").val(0);

        $("#subtochild2").val(0);
        $("#subtoadult2").val(0);
        $("#trip_no2").val("");

        $("#ext_from1 option[value=" + 0 + "]").attr("selected", true);
        $("#ext_from2 option[value=" + 0 + "]").attr("selected", true);
        $("#ext_to1 option[value=" + 0 + "]").attr("selected", true);
        $("#ext_to2 option[value=" + 0 + "]").attr("selected", true);
        CalcularTotalTotal();
    });



    $("#popup1 a").click(function () {

        var from = $('#from').val();
        var to = $('#to').val();
        var fecha_sali = $('#fecha_salida').val();
        var tipopas = $('#tipo_pass').val();
        var agency;
        if ($('#id_agency').val() != '-1') {
            agency = $('#id_agency').val()
        } else {
            agency = -1;
        }
        tipo = 1;
        if ($('#fecha_salida').val() != '' && $('#totalpax').val() != '') {

        } else {
            var mensage = "";
            if (trim($('#fecha_salida').val()) == '') {
                mensage += "- Departure date is required. \n";
            }
            if (trim($('#totalpax').val()) == '') {
                mensage += "- Total passengers required. \n";
            }
            if (trim($('#from').val()) == '') {
                mensage += "From is required. \n";
            }
            if (trim($('#to').val()) == '') {
                mensage += "To  is required. \n";
            }

            alert(mensage);

            return false;

        }
        var special_price_name = $('#special_price_name').val();

//
//        $("#transporadult").html("");
//        $("#transporechil").html("");
//        $("#subtoadult").html("");
//        $("#subtochild").html("");
//        $("#subtoadult1").val(0);
//        $("#subtochild1").val(0);
//        $("#subtoadult2").val(0);
//        $("#subtochild2").val(0);
//        $("#transporechil").html("");
//        $("#totaltotal").html("$ 00.0");
//        //$("#ext_from1 option[value="+0+"]").attr("selected",true);
//        $("#extenadult").html("");
//        $("#extenchil").html("");
        $('.content-popup').html(" ");
        $('.content-popup').load('<?php echo $data['rootUrl']; ?>consul/trips/' + from + '/' + to + '/' + fecha_sali + '/' + tipopas + '/' + saber + '/' + tipo + '/' + agency + '/' + special_price_name);
        //$('.content-popup').load('<? echo $data['rootUrl']; ?>consul/extenprice/' + from + '/' + to + '/' + fecha_sali + '/' + tipopas + '/' + saber + '/' + tipo + '/' + agency);
        $('#mascaraP').fadeIn('slow');
        $('#popup').fadeIn('slow');
        saber = 1;

    });

    $("#popup2 a").click(function () {
        var from = $('#from2').val();
        var to = $('#to2').val();
        var fecha_retorno = $('#fecha_retorno').val();
        var tipopas = $('#tipo_pass').val();

        if ($('#trip_no').val() == '') {
            alert("Must fill out the form ONE WAY");
            return false;
        }

        tipo = 2;

        if ($('#from2').attr("readonly") != "readonly") {
            if ($('#fecha_retorno').val() != '' && $('#totalpax').val() != '') {
            } else {

                var mensage = "";



                if ($('#fecha_retorno').val() == '') {
                    mensage += "- Return date is required. \n";
                }

                if ($('#totalpax').val() == '') {
                    mensage += "- Total passengers required. \n";
                }

                if ($('#from2').val() == '') {
                    mensage += "- From is required. \n";
                }

                if ($('#to2').val() == '') {
                    mensage += "- To  is required. \n";
                }

                $("#subtoadult2").val("0");
                $("#subtochild1").val("0");

                alert(mensage);

                return false;

            }
            var agency;
            if ($('#id_agency').val() != '-1') {
                agency = $('#id_agency').val()
            } else {
                agency = -1;
            }

//           var special_price_name = "PRUEBA2";
            var special_price_name = $('#special_price_name').val();

            $('.content-popup').html(" ");
            $('.content-popup').load('<?php echo $data['rootUrl']; ?>consul/trips/' + from + '/' + to + '/' + fecha_retorno + '/' + tipopas + '/' + saber + '/' + tipo + '/' + agency + '/' + special_price_name);
            $('#mascaraP').fadeIn('slow');
            $('#popup').fadeIn('slow');

            saber = 2;
            // alert(texto[0]+'trips/1/12-12/1'+'][400x250]');
        }
    });

    $("#newClient").click(function () {
        registrarCliente();
    });


    function registrarCliente() {
        var email = $("#email1").val();
        var firstname = $("#firstname1").val();
        var lastname = $("#lastname1").val();
        var phone = $("#phone1").val();
        var id = $("#idCliente").val();
        if (id == '') {
            id = 0;
        }
        if (email == '') {
            email = 0;
        }
        if (firstname == '') {
            firstname = 0;
        }
        if (lastname == '') {
            lastname = 0;
        }
        if (phone == '') {
            phone = 0;
        }
        $("#clienteN").load(encodeURI('<?php echo $data['rootUrl']; ?>admin/clientes/pagador/' + email + '/' + firstname + '/' + lastname + '/' + phone + '/' + id), function () {
            $("input[name='creator']").remove();
        });
        $('#mascaraP').fadeIn('slow');
        $('#clienteN').fadeIn('slow');
        $("#email1").focus();
        //setInterval('setTimeout("activarenvioPago()",5000)',5000);
    }


    function borrar() {
        $("#transporadult").html("$ 00.0");
        $("#transporechil").html("$ 00.0");
        $("#subtoadult").html("$ 00.0");
        $("#subtochild").html("$ 00.0");
        $("#totaltotal").html("$ 00.0");
        //$("#ext_from1 option[value="+0+"]").attr("selected",true);
        $("#extenadult").html("$ 00.0");
        $("#extenchil").html("$ 00.0");
        $("#totalPagar").html('$ 00.00');
        $("#totalPagarnet").html('$ 00.00');

    }

    function llamar(extraSettings, $innerbox) {
        var $innerbox = $innerbox;
        var dato = extraSettings;
        if (saber == 1) {
            var from = $('#from').val();
            var to = $('#to').val();
            var fecha_sali = $('#fecha_salida').val();
            var tipopas = $('#tipo_pass').val();
        } else {
            var from = $('#from2').val();
            var to = $('#to2').val();
            var fecha_sali = $('#fecha_retorno').val();
            var tipopas = $('#tipo_pass').val();
        }

        var ruta = dato[0] + '/' + from + '/' + to + '/' + fecha_sali + '/' + tipopas + '/' + saber;
        // alert(ruta);

        $.get(ruta, function (data) {
            $(data).appendTo($innerbox);
        });

        if (saber == 1) {
            var mensage = "";
            if ($('#fecha_salida').val() == '') {
                mensage += "- Departure date is required. \n";
            }
            if ($('#totalpax').val() == '') {
                mensage += "Total pass  is requerido. \n";
            }
            if ($('#from').val() == '') {
                mensage += "From is requerido. \n";
            }
            if ($('#to').val() == '') {
                mensage += "to  is requerido. \n";
            }
            if (mensage) {

                $("P.close A").click();
            }
        } else {
            var mensage = "";
            if ($('#fecha_retorno').val() == '') {
                mensage += "fecha salida is requerida. \n";
            }
            if ($('#totalpax').val() == '') {
                mensage += "total pass  is requerido. \n";
            }
            if ($('#from2').val() == '') {
                mensage += "From is requerido. \n";
            }
            if ($('#to2').val() == '') {
                mensage += "to  is requerido. \n";
            }
            if (mensage) {

                $("P.close A").click();
            }


        }
    }
    $('#btn-save1').click(function () {
        if (validarFomulario()) {
            bPreguntar = false;
            CalcularTotalTotal();
            $("#totP").val($("#totalPagar").text());
            $("#transadult").val($("#transporadult").text().substring(1, $("#transporadult").text().length));
            $("#transchild").val($("#transporechil").text().substring(1, $("#transporechil").text().length));
            $("#formula").attr('target', '_parent');
            $("#formula").attr('action', '<?php echo $data['rootUrl']; ?>admin/reservas/save');
            $("#content").css("display", "0");
            $("#formula").submit();
        }

    });

    $('#btn-save2').click(function () {
        if (validarFomulario()) {
            bPreguntar = false;
            CalcularTotalTotal();
            $("#totP").val($("#totalPagar").text());
            $("#transadult").val($("#transporadult").text().substring(1, $("#transporadult").text().length));
            $("#transchild").val($("#transporechil").text().substring(1, $("#transporechil").text().length));
            $("#formula").attr('target', '_parent');
            $("#formula").attr('action', '<?php echo $data['rootUrl']; ?>admin/reservas/save');
            $("#content").css("opacity", "0");
            $("#formula").submit();
        }

    });

    $("#enviarF").click(function () {
        if (validarFomulario()) {
            if ($("#enviar_escondido").val() == 1) {
                $("#enviar_escondido").val(0);
                irApagar();
            } else {
                registrarCliente();
            }
        }
    });

    function irApagar() {
        if (validarFomulario()) {
            CalcularTotalTotal();
            $("#totP").val($("#totalPagar").text());
            $("#transadult").val($("#transporadult").text().substring(1, $("#transporadult").text().length));
            $("#transchild").val($("#transporechil").text().substring(1, $("#transporechil").text().length));
            $("#formula").attr('action', '<?php echo $data['rootUrl']; ?>admin/reservas/pago');
            $("#formula").attr('target', '_blank');
            var hilo = setInterval("estadoPago()", 5000);
            $("#formula").submit();
        }
    }

    function activarenvioPago() {
        if ($("#enviar_escondido").val() == 1) {
            $("#enviar_escondido").val(0);
            irApagar();
        }
    }

    function validarFomulario() {
        var msError = '';
        if (trim($("#idCliente").val()) == '') {
            if (trim($("#firstname1").val()) == '') {
                msError = '- Enter the first name of the passenger';
                alert(msError);
                $("#leader").focus();
                return false;
            }

            if (trim($("#lastname1").val()) == '') {
                msError = '- Enter the last name of the passenger';
                alert(msError);
                $("#leader").focus();
                return false;
            }
        }
        if (trim($("#id_agency").val()) == '-1' /*&& trim($("#id_agency").val()) != ''*/) {
//            if (trim($("#uagency").val()) == '') {
            msError = '- Enter data Agency';
            alert(msError);
            $("#agency").focus();
            return false;
//            }
        }

        var canal = 0;
        var num = document.getElementsByName('canal').length
        for (var i = 0; i < num; i++) {
            if (document.getElementsByName('canal').item(i).checked) {
                canal = document.getElementsByName('canal').item(i).value;
            }
        }
        if (canal == 0) {
            msError = '- Select the channel through which came the reservation.';
            alert(msError);
            $("#calan_phone").focus();
            return false;
        }

        if (trim($("#trip_no").val()) == '') {
            msError = '- Select Output Trip';
            alert(msError);
            $("#trip_no").focus();
            return false;
        }
        if (trim($("#id_p1").val()) == '' && trim($("#ext_from1").val()) == '0') {
            msError = '- Enter  pickup of ONE WAY';
            alert(msError);
            $("#pickup1").focus();
            return false;
        }

        if (trim($("#id_dropoff1").val()) == '' && trim($("#ext_to1").val()) == '0') {
            msError = '- Enter  dropoff of ONE WAY';
            alert(msError);
            $("#dropoff1").focus();
            return false;
        }
        if (document.getElementById('roundtrip').checked) {
            if (trim($("#trip_no2").val()) == '') {
                msError = '- Select Return Trip';
                alert(msError);
                $("#trip_no2").focus();
                return false;
            }
            if (trim($("#id_pickup2").val()) == '' && trim($("#ext_from2").val()) == '0') {
                msError = '- Enter  pickup of Return TRIP';
                alert(msError);
                $("#pickup2").focus();
                return false;
            }
            if (trim($("#id_dropoff2").val()) == '' && trim($("#ext_to2").val()) == '0') {
                msError = '- Enter  dropoff of Return TRIP';
                alert(msError);
                $("#dropoff2").focus();
                return false;
            }

        }

        var tipo_pago = 0;
        var num = document.getElementsByName('opcion_pago').length
        for (var i = 0; i < num; i++) {
            if (document.getElementsByName('opcion_pago').item(i).checked) {
                tipo_pago = document.getElementsByName('opcion_pago').item(i).value;
            }
        }
        if (tipo_pago == 0) {
            msError = '- Select the type of payment';
            //alert(msError);
            //return false;
        }

        return true;
    }

    $('#btn-cancel1').click(function () {
        window.location = '<?php echo $data['rootUrl']; ?>admin/reservas';
    });

    function trim(myString) {
        if (myString == null || myString == '') {
            return '';
        }
        return myString.replace(/^\s+/g, '').replace(/\s+$/g, '')
    }


    $("#apply_payment").click(function () {
        //cargarHoteles();
        //alert('Apply Payment');
    });

    $("#pay_driver").click(function () {
        //cargarHoteles();
//       alert('hola mundo');
        document.getElementById('pago_driver2').value = '0.00';

    });




    function CalcularTotalTotal() {

        //var otheramount_2 = $("#saldoporpagar").text((((apagar_2 + fee) - pay_amount)).toFixed(2));

        var error = "";
        var pax = $('#pax').val();
        var pax2 = $('#pax2').val();
        if (pax2 == "") {
            pax2 = 0;
        }
        if (pax == "") {
            pax = 0;
        }

        error += validateNumber($("#extra").val(), 'Extra', true);
        var extra = 0;
        if (error == "") {
            extra = $("#extra").val();
        }
        var comi = 0/*comision()*/;
        var full = CalcularTotal(pax, pax2) + comi;
//        alert(comi);
        var balance = full - comi;
        var disponible = $("#disponible").val();
        var agency = $("#id_agency").val();

        var tipo_pago = 0;
        var num = document.getElementsByName('opcion_pago').length
        for (var i = 0; i < num; i++) {
            if (document.getElementsByName('opcion_pago').item(i).checked) {
                tipo_pago = document.getElementsByName('opcion_pago').item(i).value;
            }
        }



        //var op_pago_id = $("#op_pago_id").val();
        //Select de Caja Nueva para Paid driver

        var opcion = $("#op_pago_id1").val();



        tipo_pago = $("#op_pago_id option:selected").val();

//        if(tipo_pago === 3){
//         alert('hola mundo');   
//        }
        var tipo_saldo = $('#opcion_pago_saldo').val();
        var apagar = full;
        if (tipo_saldo == 2) {
            apagar = balance;
        }
        //RESTAMOS DESCUENTO DE %
        error = "";
        error += validateNumber($("#descuento").val(), 'Descuento', true);
        var desc_porc = 0;
        if (error == "") {
            desc_porc = $("#descuento").val();
        }
        //RESTAMOS DESCUENTO DE $
        error = "";
        error += validateNumber($("#descuento_valor").val(), 'Descuento Valor', true);
        var desc_valor = 0;
        if (error == "") {
            desc_valor = $("#descuento_valor").val();
        }
        var pay_amount = $("#pay_amount").val();

        var paid_driver = $("#paid_driver").val();

        var pago_driver = $("#pago_driver").val();


        apagar = parseFloat(apagar) + parseFloat(extra) - parseFloat((full * desc_porc) / 100) - parseFloat(desc_valor);


        var fee = apagar * 0.04;


        var otheramount_2 = $("#otheramount").val();


        if (otheramount_2 > 0) {

            var apagar_2 = parseFloat(otheramount_2);

        } else {

            var apagar_2 = parseFloat(apagar);

        }
        var totalPax = parseFloat(pax) + parseFloat(pax2);
        $("#totalComision").text(comi.toFixed(2));



        if (tipo_pago == 5) {
            if (disponible - balance < 0) {
                /*alert('Your available credit is less than the total amount to be paid');
                 $("#opcion_pago").attr("checked",false);
                 $("#opcion_saldo1").attr('checked',false);
                 $("#opcion_saldo2").attr('checked',false);
                 $("#opcion_saldo2").attr('disabled',false);
                 $("#opcion_saldo1").attr('disabled',false);*/
                $("#opcion_saldo2").attr('checked', true);
                $("#opcion_saldo1").attr('disabled', true);
                $("#opcion_saldo2").attr('disabled', false);
                $("#opcion_pago_saldo").val('2');
                /*$("#totalPagar").text((balance).toFixed(2));
                 $("#totaltotal").text((balance).toFixed(2));*/
                $("#totalPagar").text((apagar).toFixed(2));
                $("#totaltotal").text((apagar).toFixed(2));

                $("#saldoporpagar").val(((apagar_2 - pay_amount)).toFixed(2));
                //$("#balance_due").val(((apagar - (apagar_2 - pay_amount))).toFixed(2));


                if (opcion === '0') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '1') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                //COLLECT ON BOARD

                if (opcion === '24') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '25') {
//                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
//                    
                    
                    $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                    //actualizacion
//                    $("#saldoporpagar").val((((apagar_2 + fee) - pay_amount)).toFixed(2));
                    $("#saldoporpagar").val((((apagar_2 + (2*fee)) - pay_amount)).toFixed(2));
                    $("#totalPagar").text((apagar + fee).toFixed(2));
                    $("#totaltotal").text((apagar + fee).toFixed(2));
                }

                if (opcion === '26') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '27') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                //PERD-PAID

                if (opcion === '20') {
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                }

                if (opcion === '21') {
//                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
//                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    
                    $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                    //actualizacion
                    $("#saldoporpagar").val((((apagar_2 + fee) - pay_amount)).toFixed(2));
                    $("#totalPagar").text((apagar + fee).toFixed(2));
                    $("#totaltotal").text((apagar + fee).toFixed(2));
                }

                if (opcion === '22') {
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                }

                if (opcion === '23') {
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                }




            } else {
                $("#opcion_saldo2").attr('checked', true);
                $("#opcion_saldo1").attr('disabled', true);
                $("#opcion_saldo2").attr('disabled', false);
                $("#opcion_pago_saldo").val('2');
                /*$("#totalPagar").text((balance).toFixed(2));
                 $("#totaltotal").text((balance).toFixed(2));*/
                $("#totalPagar").text((apagar).toFixed(2));

                $("#totaltotal").text((apagar).toFixed(2));
                $("#saldoporpagar").val(((apagar_2 - pay_amount)).toFixed(2));

                if (opcion === '0') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '1') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }
                //COLLECT ON BOARD

                if (opcion === '24') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '25') {
//                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    
                    $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                    //actualizacion
                    $("#saldoporpagar").val((((apagar_2 + (2*fee)) - pay_amount)).toFixed(2));
                    $("#totalPagar").text((apagar + fee).toFixed(2));
                    $("#totaltotal").text((apagar + fee).toFixed(2));
                }

                if (opcion === '26') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '27') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }


                //PRED - PAID

                if (opcion === '20') {
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                }

                if (opcion === '21') {
//                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
//                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    
                    $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                    //actualizacion
                    $("#saldoporpagar").val((((apagar_2 + fee) - pay_amount)).toFixed(2));
                    $("#totalPagar").text((apagar + fee).toFixed(2));
                    $("#totaltotal").text((apagar + fee).toFixed(2));
                }

                if (opcion === '22') {
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                }

                if (opcion === '23') {
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                }

                //alert(w);
            }
        } else if (tipo_pago == 1) {
//            $("#opcion_saldo2").attr('checked', true);
//            $("#opcion_saldo1").attr('disabled', true);
//            $("#opcion_saldo2").attr('disabled', false);
//          $("#opcion_pago_saldo").val('2');
            $("#totalPagar").text((apagar + fee).toFixed(2));
            $("#totaltotal").text((apagar + fee).toFixed(2));
            if (otheramount_2 > 0) {
                $("#saldoporpagar").val((((apagar_2) - pay_amount)).toFixed(2));


                if (opcion === '0') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '1') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                //COLLECT ON BOARD
                if (opcion === '24') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '25') {
//                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    
                    $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));

                    ///actualizacion
                    //$("#saldoporpagar").val((((apagar_2 + fee) - pay_amount)).toFixed(2));
                    $("#saldoporpagar").val((((apagar_2 + (2*fee)) - pay_amount)).toFixed(2));
                    $("#totalPagar").text((apagar + fee).toFixed(2));
                    $("#totaltotal").text((apagar + fee).toFixed(2));
                }

                if (opcion === '26') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '27') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }


                //PRED-PAID

                if (opcion === '20') {
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                }

                if (opcion === '21') {
//                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
//                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    
                    $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                   
                    ///actualizacion
                    $("#saldoporpagar").val((((apagar_2 + fee) - pay_amount)).toFixed(2));
                    $("#totalPagar").text((apagar + fee).toFixed(2));
                    $("#totaltotal").text((apagar + fee).toFixed(2));

                }

                if (opcion === '22') {
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                }

                if (opcion === '23') {
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                }

            } else {
                $("#saldoporpagar").val((((apagar_2 + fee) - pay_amount)).toFixed(2));
                //$("#balance_due").val(((apagar - (apagar_2 - pay_amount))).toFixed(2));
                ////$("#balance_due").val(((apagar_2 - pay_amount) - pago_driver).toFixed(2));
                //$("#balance_due").val(((apagar_2 - pay_amount)- paid_driver).toFixed(2));
                ////$("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));

                if (opcion === '0') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '1') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                //COLLECT ON BOARD

                if (opcion === '24') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '25') {
//                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    
                    
                    $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                    //actualizacion
                    //$("#saldoporpagar").val((((apagar_2 + fee) - pay_amount)).toFixed(2));
                    $("#saldoporpagar").val((((apagar_2 + (2*fee)) - pay_amount)).toFixed(2));
                    $("#totalPagar").text((apagar + fee).toFixed(2));
                    $("#totaltotal").text((apagar + fee).toFixed(2));
                }

                if (opcion === '26') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '27') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }


                //PRED-PAID

                if (opcion === '20') {
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                }

                if (opcion === '21') {
//                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
//                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                    
                    
                    $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                    //actualizacion
                    $("#saldoporpagar").val((((apagar_2 + fee) - pay_amount)).toFixed(2));
                    $("#totalPagar").text((apagar + fee).toFixed(2));
                    $("#totaltotal").text((apagar + fee).toFixed(2));
                }

                if (opcion === '22') {
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                }

                if (opcion === '23') {
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                }
            }



        } else {
            $("#opcion_saldo2").attr('disabled', false);
            $("#opcion_saldo1").attr('disabled', false);
            if (tipo_pago == 3) {
                $("#totalPagar").text((apagar + fee).toFixed(2));
                $("#totaltotal").text((apagar + fee).toFixed(2));


                ////capturar balance du con fee
                ///////////////////////////////////////////////////////////////////////////////////////////////////


                //$("#agency_balance_due").val((apagar + fee).toFixed(2));

                if (otheramount_2 > 0) {
                    $("#saldoporpagar").val((((apagar_2) - pay_amount)).toFixed(2));
                    //$("#balance_due").val(((apagar - (apagar_2 - pay_amount))).toFixed(2));
                    ////$("#balance_due").val(((apagar_2 - pay_amount) - pago_driver).toFixed(2));
                    //$("#balance_due").val(((apagar_2 - pay_amount)- paid_driver).toFixed(2));
                    ////$("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));

                    if (opcion === '0') {
                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    }

                    if (opcion === '1') {
                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    }

                    //COLLECT ON BOARD

                    if (opcion === '24') {
                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    }

                    if (opcion === '25') {
//                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                        
                        $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                        //actualizacion
                        //$("#saldoporpagar").val((((apagar_2 + fee) - pay_amount)).toFixed(2));
                        $("#saldoporpagar").val((((apagar_2 + (2*fee)) - pay_amount)).toFixed(2));
                        $("#totalPagar").text((apagar + fee).toFixed(2));
                        $("#totaltotal").text((apagar + fee).toFixed(2));
                    }

                    if (opcion === '26') {
                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    }

                    if (opcion === '27') {
                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    }

                    //PRED-PAID

                    if (opcion === '20') {
                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    }

                    if (opcion === '21') {
//                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
//                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                        
                        $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                        //actualizacion
                        $("#saldoporpagar").val((((apagar_2 + fee) - pay_amount)).toFixed(2));
                        $("#totalPagar").text((apagar + fee).toFixed(2));
                        $("#totaltotal").text((apagar + fee).toFixed(2));
                    }

                    if (opcion === '22') {
                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    }

                    if (opcion === '23') {
                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    }


                } else {
                    $("#saldoporpagar").val((((apagar_2 + fee) - pay_amount)).toFixed(2));
                    //$("#balance_due").val(((apagar - (apagar_2 - pay_amount))).toFixed(2));
                    ////$("#balance_due").val(((apagar_2 - pay_amount) - pago_driver).toFixed(2));
                    //$("#balance_due").val(((apagar_2 - pay_amount)- paid_driver).toFixed(2));
                    ////$("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));

//                    var tp = document.getElementById('saldoporpagar').value;
//                    
//                    alert(tp);

                    $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));


                    if (opcion === '0') {

//                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));

                        $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                    }

                    if (opcion === '1') {

//                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));

                        $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));


                    }

                    //COLLECT ON BOARD

                    if (opcion === '24') {
//                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
//                        
                        $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                    }

                    if (opcion === '25') {
//                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
//                        
                        $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                        //actualizacion
                        //$("#saldoporpagar").val((((apagar_2 + fee) - pay_amount)).toFixed(2));
                        $("#saldoporpagar").val((((apagar_2 + (2*fee)) - pay_amount)).toFixed(2));
                        $("#totalPagar").text((apagar + fee).toFixed(2));
                        $("#totaltotal").text((apagar + fee).toFixed(2));
//                        $("#totalPagar").text((apagar + fee).toFixed(2));
//                        $("#totaltotal").text((apagar + fee).toFixed(2));
//                    }

                    if (opcion === '26') {
//                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));

                        $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                    }

                    if (opcion === '27') {
//                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
//                        
                        $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                    }

                    //PRED-PAID



                    if (opcion === '20') {
//                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));

                        $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                    }

                    if (opcion === '21') {
//                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));

                        $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                        //actualizacion
                        $("#saldoporpagar").val((((apagar_2 + fee) - pay_amount)).toFixed(2));
                        $("#totalPagar").text((apagar + fee).toFixed(2));
                        $("#totaltotal").text((apagar + fee).toFixed(2));
                    }

                    if (opcion === '22') {
//                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));

                        $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                    }

                    if (opcion === '23') {
//                        $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                        $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));


                        $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                        $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                    }


                }



            } else {
                $("#totalPagar").text((apagar).toFixed(2));
                $("#totaltotal").text((apagar).toFixed(2));

                $("#saldoporpagar").val(((apagar_2 - pay_amount)).toFixed(2));
                //$("#balance_due").val(((apagar - (apagar_2 - pay_amount))).toFixed(2));
                ////$("#balance_due").val(((apagar_2 - pay_amount) - pago_driver).toFixed(2));
                //$("#balance_due").val(((apagar_2 - pay_amount)- paid_driver).toFixed(2));
                ////$("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));

                $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));


                if (opcion === '0') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '1') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                //COLLECT ON BOARD

                if (opcion === '24') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '25') {
//                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
//                    
                    $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));
                    
                    
                    //actualizacion
                    //$("#saldoporpagar").val((((apagar_2 + fee) - pay_amount)).toFixed(2));
                    $("#saldoporpagar").val((((apagar_2 + (2*fee)) - pay_amount)).toFixed(2));
                    $("#totalPagar").text((apagar + fee).toFixed(2));
                    $("#totaltotal").text((apagar + fee).toFixed(2));
                }

                if (opcion === '26') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '27') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                //PRED-PAID



                if (opcion === '20') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '21') {
//                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
//                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                    
                    $("#balance_due").val((((apagar_2 + fee) - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val((((apagar + fee) - pay_amount)).toFixed(2));

                    //actualizacion
                    $("#saldoporpagar").val((((apagar_2 + fee) - pay_amount)).toFixed(2));
                    $("#totalPagar").text((apagar + fee).toFixed(2));
                    $("#totaltotal").text((apagar + fee).toFixed(2));
                }

                if (opcion === '22') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

                if (opcion === '23') {
                    $("#balance_due").val(((apagar_2 - pay_amount) - paid_driver).toFixed(2));
                    $("#agency_balance_due").val(((apagar - pay_amount)).toFixed(2));
                }

            }
        }


        if ($("#fin_calculo").val() == "false") {
            if (tipo_pago == 1 || tipo_pago == 2) {
                $('#enviarF').css('display', 'block');
                /* bloqueado para poder guardar sin obligacion de ir a plataforma de pago
                 * $('#btn-save1').css('display', 'none');
                 $('#btn-save2').css('display', 'none');*/

            } else {
                $('#enviarF').css('display', 'none');
                $('#btn-save1').css('display', 'block');
                $('#btn-save2').css('display', 'block');
            }
        }

    }

    $('#opcion_saldo1, #opcion_saldo2').change(function () {
        if ($(this).get(0).id == 'opcion_saldo1') {
            $('#opcion_pago_saldo').val('1');
        } else if ($(this).get(0).id == 'opcion_saldo2') {
            $('#opcion_pago_saldo').val('2');
        }
        CalcularTotalTotal();
    });

    $('#opcion_pago_passager, #opcion_pago_agency, #opcion_pago_predpaid_cash,#opcion_pago_complementary,#opcion_pago_CrediFee, #opcion_pago_Cash,#opcion_pago_Voucher').change(function (e) {
        CalcularTotalTotal();
    });



    function estadoPago() {
        $("#estadoTranssacion").load('<?php echo $data['rootUrl']; ?>transaction/admin/reserva/pago');
    }

    $("#cardholder").click(function (e) {
        if ($("#cardholder").is(':checked')) {
            var idPagador = $("#idPagador").val();
            var idCliente = $("#idCliente").val();
            $("#idPagador_aux").val(idPagador);
            $("#idPagador").val(idCliente);
        } else {
            var idPagador = $("#idPagador_aux").val();
            $("#idPagador").val(idPagador);
        }
    });

    function mosrtarTrips(left, top) {
        $("#dialog_states__trips").dialog({
            autoOpen: false,
            width: 300,
            height: 300,
            show: {
                effect: "blind",
                duration: 1000
            },
            hide: {
                effect: "blind",
                duration: 1000
            },
            position: [left - 260, top + 50],
        });
        $("#states__trips_conte").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="100px" height="100px" id="gif"/>');
        $("#states__trips_conte").load('<?php echo $data['rootUrl']; ?>admin/reservas/estado_trips');
        $("#dialog_states__trips").dialog("open");
    }

    $("#bnt-trips").click(function () {
        var posicion = $(this).position();
        mosrtarTrips(posicion.left, posicion.top);
    });

    function estadoTrip() {
        $("#mensajeTrip").load('<?php echo $data['rootUrl']; ?>admin/reservas/consultatrip');
    }

    function preguntaTrip() {
        $("#dialog-trip-pregunta").dialog({
            resizable: false,
            height: 250,
            modal: true,
            buttons: {
                "YES": function () {
                    $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/2");
                    $(this).dialog("close");
                },
                'NOT': function () {
                    $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/4");
                    $(this).dialog("close");
                }
            }
        });
    }
    $("#estado").change(function () {
        var estado = $(this).val();
        $("#stat").html(estado);
    });

//    $(function() {
//        setInterval(function() {
//            CalcularTotalTotal();
//            console.log('calculando');
//        }, 500);
//    })
</script>

<script>

    var z
    function capturar()
    {
        var resultado = "ninguno";

        var porNombre = document.getElementsByName("tipo_ticket");
        // Recorremos todos los valores del radio button para encontrar el
        // seleccionado
        for (var i = 0; i < porNombre.length; i++)
        {
            if (porNombre[i].checked)
                resultado = porNombre[i].value;

        }

        //document.getElementById("resultado").innerHTML=" \
        //Value: "+resultado;
        z = document.getElementById("resultado").innerHTML = " \ " + resultado;


    }
</script>



