<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.css" />

<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css" />

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/modernizr.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>/global/js/booking.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">



<!--<link rel="stylesheet" href="/resources/demos/style.css">-->

<script src="http://www.eresmas.com/js/logs.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" type="text/css" href="estilos.css" />

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

    .verdefosf1{
        background: rgba(230,227,225,0.45);
        background: -moz-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,201,0.45) 25%, rgba(86,222,141,0.96) 87%, rgba(86,185,173,1) 92%, rgba(87,126,224,1) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(230,227,225,0.45)), color-stop(25%, rgba(189,226,201,0.45)), color-stop(87%, rgba(86,222,141,0.96)), color-stop(92%, rgba(86,185,173,1)), color-stop(100%, rgba(87,126,224,1)));
        background: -webkit-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,201,0.45) 25%, rgba(86,222,141,0.96) 87%, rgba(86,185,173,1) 92%, rgba(87,126,224,1) 100%);
        background: -o-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,201,0.45) 25%, rgba(86,222,141,0.96) 87%, rgba(86,185,173,1) 92%, rgba(87,126,224,1) 100%);
        background: -ms-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,201,0.45) 25%, rgba(86,222,141,0.96) 87%, rgba(86,185,173,1) 92%, rgba(87,126,224,1) 100%);
        background: linear-gradient(to bottom, rgba(230,227,225,0.45) 0%, rgba(189,226,201,0.45) 25%, rgba(86,222,141,0.96) 87%, rgba(86,185,173,1) 92%, rgba(87,126,224,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e6e3e1', endColorstr='#577ee0', GradientType=0 );
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

    .vinotinto{
        background: rgba(173,0,17,1);
        background: -moz-linear-gradient(top, rgba(173,0,17,1) 0%, rgba(228,196,198,0.97) 44%, rgba(0,0,61,0.93) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(173,0,17,1)), color-stop(44%, rgba(228,196,198,0.97)), color-stop(100%, rgba(0,0,61,0.93)));
        background: -webkit-linear-gradient(top, rgba(173,0,17,1) 0%, rgba(228,196,198,0.97) 44%, rgba(0,0,61,0.93) 100%);
        background: -o-linear-gradient(top, rgba(173,0,17,1) 0%, rgba(228,196,198,0.97) 44%, rgba(0,0,61,0.93) 100%);
        background: -ms-linear-gradient(top, rgba(173,0,17,1) 0%, rgba(228,196,198,0.97) 44%, rgba(0,0,61,0.93) 100%);
        background: linear-gradient(to bottom, rgba(173,0,17,1) 0%, rgba(228,196,198,0.97) 44%, rgba(0,0,61,0.93) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ad0011', endColorstr='#00003d', GradientType=0 );
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

    .verde2018{
        background: rgba(100,241,39,1);
        background: -moz-radial-gradient(center, ellipse cover, rgba(100,241,39,1) 0%, rgba(74,176,69,1) 29%, rgba(74,176,69,1) 85%);
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(100,241,39,1)), color-stop(29%, rgba(74,176,69,1)), color-stop(85%, rgba(74,176,69,1)));
        background: -webkit-radial-gradient(center, ellipse cover, rgba(100,241,39,1) 0%, rgba(74,176,69,1) 29%, rgba(74,176,69,1) 85%);
        background: -o-radial-gradient(center, ellipse cover, rgba(100,241,39,1) 0%, rgba(74,176,69,1) 29%, rgba(74,176,69,1) 85%);
        background: -ms-radial-gradient(center, ellipse cover, rgba(100,241,39,1) 0%, rgba(74,176,69,1) 29%, rgba(74,176,69,1) 85%);
        background: radial-gradient(ellipse at center, rgba(100,241,39,1) 0%, rgba(74,176,69,1) 29%, rgba(74,176,69,1) 85%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#64f127', endColorstr='#4ab045', GradientType=1 );
    }

    .verde2017{
        background: rgba(14,216,54,1);
        background: -moz-linear-gradient(top, rgba(14,216,54,1) 0%, rgba(51,151,90,1) 62%, rgba(56,143,95,0.9) 70%, rgba(56,143,95,0.53) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(14,216,54,1)), color-stop(62%, rgba(51,151,90,1)), color-stop(70%, rgba(56,143,95,0.9)), color-stop(100%, rgba(56,143,95,0.53)));
        background: -webkit-linear-gradient(top, rgba(14,216,54,1) 0%, rgba(51,151,90,1) 62%, rgba(56,143,95,0.9) 70%, rgba(56,143,95,0.53) 100%);
        background: -o-linear-gradient(top, rgba(14,216,54,1) 0%, rgba(51,151,90,1) 62%, rgba(56,143,95,0.9) 70%, rgba(56,143,95,0.53) 100%);
        background: -ms-linear-gradient(top, rgba(14,216,54,1) 0%, rgba(51,151,90,1) 62%, rgba(56,143,95,0.9) 70%, rgba(56,143,95,0.53) 100%);
        background: linear-gradient(to bottom, rgba(14,216,54,1) 0%, rgba(51,151,90,1) 62%, rgba(56,143,95,0.9) 70%, rgba(56,143,95,0.53) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0ed836', endColorstr='#388f5f', GradientType=0 );
    }

    .rojo2017{
        background: rgba(196,107,84,1);
        background: -moz-linear-gradient(top, rgba(196,107,84,1) 0%, rgba(196,107,84,0.9) 18%, rgba(248,114,84,0.79) 39%, rgba(255,47,5,0.72) 51%, rgba(250,54,15,0.64) 67%, rgba(239,59,31,0.47) 99%, rgba(239,59,31,0.46) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(196,107,84,1)), color-stop(18%, rgba(196,107,84,0.9)), color-stop(39%, rgba(248,114,84,0.79)), color-stop(51%, rgba(255,47,5,0.72)), color-stop(67%, rgba(250,54,15,0.64)), color-stop(99%, rgba(239,59,31,0.47)), color-stop(100%, rgba(239,59,31,0.46)));
        background: -webkit-linear-gradient(top, rgba(196,107,84,1) 0%, rgba(196,107,84,0.9) 18%, rgba(248,114,84,0.79) 39%, rgba(255,47,5,0.72) 51%, rgba(250,54,15,0.64) 67%, rgba(239,59,31,0.47) 99%, rgba(239,59,31,0.46) 100%);
        background: -o-linear-gradient(top, rgba(196,107,84,1) 0%, rgba(196,107,84,0.9) 18%, rgba(248,114,84,0.79) 39%, rgba(255,47,5,0.72) 51%, rgba(250,54,15,0.64) 67%, rgba(239,59,31,0.47) 99%, rgba(239,59,31,0.46) 100%);
        background: -ms-linear-gradient(top, rgba(196,107,84,1) 0%, rgba(196,107,84,0.9) 18%, rgba(248,114,84,0.79) 39%, rgba(255,47,5,0.72) 51%, rgba(250,54,15,0.64) 67%, rgba(239,59,31,0.47) 99%, rgba(239,59,31,0.46) 100%);
        background: linear-gradient(to bottom, rgba(196,107,84,1) 0%, rgba(196,107,84,0.9) 18%, rgba(248,114,84,0.79) 39%, rgba(255,47,5,0.72) 51%, rgba(250,54,15,0.64) 67%, rgba(239,59,31,0.47) 99%, rgba(239,59,31,0.46) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c46b54', endColorstr='#ef3b1f', GradientType=0 );
    }

    .azul2017{
        background: rgba(0,120,212,1);
        background: -moz-linear-gradient(top, rgba(0,120,212,1) 18%, rgba(0,154,250,1) 32%, rgba(0,154,250,1) 34%, rgba(0,154,250,0.5) 65%);
        background: -webkit-gradient(left top, left bottom, color-stop(18%, rgba(0,120,212,1)), color-stop(32%, rgba(0,154,250,1)), color-stop(34%, rgba(0,154,250,1)), color-stop(65%, rgba(0,154,250,0.5)));
        background: -webkit-linear-gradient(top, rgba(0,120,212,1) 18%, rgba(0,154,250,1) 32%, rgba(0,154,250,1) 34%, rgba(0,154,250,0.5) 65%);
        background: -o-linear-gradient(top, rgba(0,120,212,1) 18%, rgba(0,154,250,1) 32%, rgba(0,154,250,1) 34%, rgba(0,154,250,0.5) 65%);
        background: -ms-linear-gradient(top, rgba(0,120,212,1) 18%, rgba(0,154,250,1) 32%, rgba(0,154,250,1) 34%, rgba(0,154,250,0.5) 65%);
        background: linear-gradient(to bottom, rgba(0,120,212,1) 18%, rgba(0,154,250,1) 32%, rgba(0,154,250,1) 34%, rgba(0,154,250,0.5) 65%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0078d4', endColorstr='#009afa', GradientType=0 );
    }

    .redopc{
        background: rgba(167,6,41,1);
        background: -moz-linear-gradient(top, rgba(167,6,41,1) 0%, rgba(167,6,41,0.54) 32%, rgba(167,6,41,0.54) 40%, rgba(138,5,34,0.54) 44%, rgba(105,2,24,0.54) 53%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(167,6,41,1)), color-stop(32%, rgba(167,6,41,0.54)), color-stop(40%, rgba(167,6,41,0.54)), color-stop(44%, rgba(138,5,34,0.54)), color-stop(53%, rgba(105,2,24,0.54)));
        background: -webkit-linear-gradient(top, rgba(167,6,41,1) 0%, rgba(167,6,41,0.54) 32%, rgba(167,6,41,0.54) 40%, rgba(138,5,34,0.54) 44%, rgba(105,2,24,0.54) 53%);
        background: -o-linear-gradient(top, rgba(167,6,41,1) 0%, rgba(167,6,41,0.54) 32%, rgba(167,6,41,0.54) 40%, rgba(138,5,34,0.54) 44%, rgba(105,2,24,0.54) 53%);
        background: -ms-linear-gradient(top, rgba(167,6,41,1) 0%, rgba(167,6,41,0.54) 32%, rgba(167,6,41,0.54) 40%, rgba(138,5,34,0.54) 44%, rgba(105,2,24,0.54) 53%);
        background: linear-gradient(to bottom, rgba(167,6,41,1) 0%, rgba(167,6,41,0.54) 32%, rgba(167,6,41,0.54) 40%, rgba(138,5,34,0.54) 44%, rgba(105,2,24,0.54) 53%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a70629', endColorstr='#690218', GradientType=0 );
    }

    .grad {
        background: red; /* For browsers that do not support gradients */
        background: -webkit-linear-gradient(-90deg, red, yellow); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(-90deg, red, yellow); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(-90deg, red, yellow); /* For Firefox 3.6 to 15 */
        background: linear-gradient(-90deg, red, yellow); /* Standard syntax */
    }

    .angry{
        background: -moz-linear-gradient(270deg, #008080 0%, #FFFFFF 25%, #32898C 50%, #FFFFFF 75%, #005757 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #008080), color-stop(25%, #FFFFFF), color-stop(50%, #32898C), color-stop(75%, #FFFFFF), color-stop(100%, #005757)); /* safari4+,chrome */
        background: -webkit-linear-gradient(270deg, #008080 0%, #FFFFFF 25%, #32898C 50%, #FFFFFF 75%, #005757 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(270deg, #008080 0%, #FFFFFF 25%, #32898C 50%, #FFFFFF 75%, #005757 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(270deg, #008080 0%, #FFFFFF 25%, #32898C 50%, #FFFFFF 75%, #005757 100%); /* ie10+ */
        background: linear-gradient(180deg, #008080 0%, #FFFFFF 25%, #32898C 50%, #FFFFFF 75%, #005757 100%); /* w3c */
    }

    .angry2{
        background: -moz-radial-gradient(center, ellipse cover, #0B4A8A 0%, #010C17 83%, #000000 100%); /* ff3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #0B4A8A), color-stop(83%, #010C17), color-stop(100%, #000000)); /* safari4+,chrome */
        background: -webkit-radial-gradient(center, ellipse cover, #0B4A8A 0%, #010C17 83%, #000000 100%); /* safari5.1+,chrome10+ */
        background: -o-radial-gradient(center, ellipse cover, #0B4A8A 0%, #010C17 83%, #000000 100%); /* opera 11.10+ */
        background: -ms-radial-gradient(center, ellipse cover, #0B4A8A 0%, #010C17 83%, #000000 100%); /* ie10+ */
        background: radial-gradient(ellipse at center, #0B4A8A 0%, #010C17 83%, #000000 100%); /* w3c */
    }

    .angryrad{
        background: -moz-radial-gradient(center, ellipse cover, #003333 0%, #05C1FF 50%, #003333 100%); /* ff3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #003333), color-stop(50%, #05C1FF), color-stop(100%, #003333)); /* safari4+,chrome */
        background: -webkit-radial-gradient(center, ellipse cover, #003333 0%, #05C1FF 50%, #003333 100%); /* safari5.1+,chrome10+ */
        background: -o-radial-gradient(center, ellipse cover, #003333 0%, #05C1FF 50%, #003333 100%); /* opera 11.10+ */
        background: -ms-radial-gradient(center, ellipse cover, #003333 0%, #05C1FF 50%, #003333 100%); /* ie10+ */
        background: radial-gradient(ellipse at center, #003333 0%, #05C1FF 50%, #003333 100%); /* w3c */
    }

    .payment{
        background: -moz-linear-gradient(0deg, #0C0680 0%, #FFFFFF 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, right top, color-stop(0%, #0C0680), color-stop(33%, #FFFFFF), color-stop(50%, #0c0680), color-stop(65%, #FFFFFF), color-stop(100%, #0C0680)); /* safari4+,chrome */
        background: -webkit-linear-gradient(0deg, #0C0680 0%, #FFFFFF 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(0deg, #0C0680 0%, #FFFFFF 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(0deg, #0C0680 0%, #FFFFFF 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* ie10+ */
        background: linear-gradient(90deg, #0C0680 0%, #FFFFFF 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0C0680', endColorstr='#0C0680',GradientType=1 ); /* ie6-9 */
    }

    .paymentvert{

        background: -moz-linear-gradient(90deg, #0C0680 0%, #ffffff 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #0C0680), color-stop(35%, #FFFFFF), color-stop(50%, #0c0680), color-stop(67%, #ffffff), color-stop(100%, #0C0680)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #0C0680 0%, #ffffff 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #0C0680 0%, #ffffff 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #0C0680 0%, #ffffff 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* ie10+ */
        background: linear-gradient(0deg, #0C0680 0%, #ffffff 33%, #0c0680 50%, #FFFFFF 65%, #0C0680 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0C0680', endColorstr='#0C0680',GradientType=0 ); /* ie6-9 */

    }

    .paymentvertblack{
        background: -moz-linear-gradient(90deg, #000000 0%, #ffffff 33%, #000000 50%, #FFFFFF 65%, #000000 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #000000), color-stop(35%, #FFFFFF), color-stop(50%, #000000), color-stop(67%, #ffffff), color-stop(100%, #000000)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #000000 0%, #ffffff 33%, #000000 50%, #FFFFFF 65%, #000000 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #000000 0%, #ffffff 33%, #000000 50%, #FFFFFF 65%, #000000 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #000000 0%, #ffffff 33%, #000000 50%, #FFFFFF 65%, #000000 100%); /* ie10+ */
        background: linear-gradient(0deg, #000000 0%, #ffffff 33%, #000000 50%, #FFFFFF 65%, #000000 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#000000', endColorstr='#000000',GradientType=0 ); /* ie6-9 */
    }

    .ama{
        background: -moz-linear-gradient(90deg, #29FF50 0%, #29FF50 8%, #428CFC 22%, #428CFC 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #428CFC), color-stop(78%, #428CFC), color-stop(92%, #29FF50), color-stop(100%, #29FF50)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #29FF50 0%, #29FF50 8%, #428CFC 22%, #428CFC 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #29FF50 0%, #29FF50 8%, #428CFC 22%, #428CFC 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #29FF50 0%, #29FF50 8%, #428CFC 22%, #428CFC 100%); /* ie10+ */
        background: linear-gradient(0deg, #29FF50 0%, #29FF50 8%, #428CFC 22%, #428CFC 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#428CFC', endColorstr='#29FF50',GradientType=0 ); /* ie6-9 */
    }

    .ama2{
        background: -moz-linear-gradient(90deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #FFFCD9), color-stop(78%, #FFFCD9), color-stop(92%, #1EFF00), color-stop(100%, #1EFF00)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* ie10+ */
        background: linear-gradient(0deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#FFFCD9', endColorstr='#1EFF00',GradientType=0 ); /* ie6-9 */
    }

    .naran{
        background: -moz-linear-gradient(90deg, #15FF00 0%, #15FF00 8%, #E3E8FA 22%, #E3E8FA 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #E3E8FA), color-stop(78%, #E3E8FA), color-stop(92%, #15FF00), color-stop(100%, #15FF00)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #15FF00 0%, #15FF00 8%, #E3E8FA 22%, #E3E8FA 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #15FF00 0%, #15FF00 8%, #E3E8FA 22%, #E3E8FA 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #15FF00 0%, #15FF00 8%, #E3E8FA 22%, #E3E8FA 100%); /* ie10+ */
        background: linear-gradient(0deg, #15FF00 0%, #15FF00 8%, #E3E8FA 22%, #E3E8FA 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#E3E8FA', endColorstr='#15FF00',GradientType=0 ); /* ie6-9 */
    }

    .roge{
        background: -moz-linear-gradient(90deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #E3E8FA), color-stop(78%, #E3E8FA), color-stop(92%, #FF0505), color-stop(100%, #FF0505)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* ie10+ */
        background: linear-gradient(0deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#E3E8FA', endColorstr='#FF0505',GradientType=0 ); /* ie6-9 */
    }

    .verd{
        background: -moz-linear-gradient(90deg, #FFFFFF 0%, #FFFFFF 8%, #8EDE93 22%, #8EDE93 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #8EDE93), color-stop(78%, #8EDE93), color-stop(92%, #FFFFFF), color-stop(100%, #FFFFFF)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #FFFFFF 0%, #FFFFFF 8%, #8EDE93 22%, #8EDE93 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #FFFFFF 0%, #FFFFFF 8%, #8EDE93 22%, #8EDE93 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #FFFFFF 0%, #FFFFFF 8%, #8EDE93 22%, #8EDE93 100%); /* ie10+ */
        background: linear-gradient(0deg, #FFFFFF 0%, #FFFFFF 8%, #8EDE93 22%, #8EDE93 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8EDE93', endColorstr='#FFFFFF',GradientType=0 ); /* ie6-9 */
    }

    .azu{
        background: -moz-linear-gradient(90deg, #F4FF1C 0%, #F4FF1C 8%, #DEEEFA 22%, #DEEEFA 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #DEEEFA), color-stop(78%, #DEEEFA), color-stop(92%, #F4FF1C), color-stop(100%, #F4FF1C)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #F4FF1C 0%, #F4FF1C 8%, #DEEEFA 22%, #DEEEFA 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #F4FF1C 0%, #F4FF1C 8%, #DEEEFA 22%, #DEEEFA 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #F4FF1C 0%, #F4FF1C 8%, #DEEEFA 22%, #DEEEFA 100%); /* ie10+ */
        background: linear-gradient(0deg, #F4FF1C 0%, #F4FF1C 8%, #DEEEFA 22%, #DEEEFA 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#DEEEFA', endColorstr='#F4FF1C',GradientType=0 ); /* ie6-9 */
    }
    .brown3{
        background: -moz-linear-gradient(90deg, #9E634A 0%, #9E634A 12%, #FFDCB5 21%, #FFDCB5 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #FFDCB5), color-stop(79%, #FFDCB5), color-stop(88%, #9E634A), color-stop(100%, #9E634A)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #9E634A 0%, #9E634A 12%, #FFDCB5 21%, #FFDCB5 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #9E634A 0%, #9E634A 12%, #FFDCB5 21%, #FFDCB5 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #9E634A 0%, #9E634A 12%, #FFDCB5 21%, #FFDCB5 100%); /* ie10+ */
        background: linear-gradient(0deg, #9E634A 0%, #9E634A 12%, #FFDCB5 21%, #FFDCB5 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#FFDCB5', endColorstr='#9E634A',GradientType=0 ); /* ie6-9 */
    }

    .verdefos3{
        background: -moz-linear-gradient(90deg, #06209E 0%, #151E9E 12%, #FFFFFF 20%, #FFFFFF 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #FFFFFF), color-stop(80%, #FFFFFF), color-stop(88%, #151E9E), color-stop(100%, #06209E)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #06209E 0%, #151E9E 12%, #FFFFFF 20%, #FFFFFF 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #06209E 0%, #151E9E 12%, #FFFFFF 20%, #FFFFFF 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #06209E 0%, #151E9E 12%, #FFFFFF 20%, #FFFFFF 100%); /* ie10+ */
        background: linear-gradient(0deg, #06209E 0%, #151E9E 12%, #FFFFFF 20%, #FFFFFF 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#FFFFFF', endColorstr='#06209E',GradientType=0 ); /* ie6-9 */

    }

    .gris17{
        background: -moz-linear-gradient(180deg, #ffffff 0%, #000000 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, right top, color-stop(0%, #000000), color-stop(100%, #ffffff)); /* safari4+,chrome */
        background: -webkit-linear-gradient(180deg, #ffffff 0%, #000000 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(180deg, #ffffff 0%, #000000 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(180deg, #ffffff 0%, #000000 100%); /* ie10+ */
        background: linear-gradient(270deg, #ffffff 0%, #000000 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#000000', endColorstr='#ffffff',GradientType=1 ); /* ie6-9 */
    }

    #div1 {
        overflow:scroll;	
        width:1000px;
        margin-left: -11px;
        height: 488px;
    }

    #div1 table {
        
        width:5000px;
        height:80px;
        background-color:#fff;
        position:relative;
        float:left;

    }

    td.locked_left, th.locked_left {
        background-color: #DCDCDC;
        font-weight : bold;
        border-left : 1px solid #00000;
        border-top: 1px solid #07063B;
    }

    #div2 {
        overflow:scroll;	
        width:89px;
        margin-left: -11px;
        margin-top:2px;
        height: 80px;
        position:relative;
        float:left;

    }

    #div2 table2 {
      
        width:80px;
        height:80px;
        background-color:#fff;

    }


    .enlace {

        color: #0000D9;
        width: 100%;
        height: 100%;
        text-decoration: none;

    }


    .enlace:hover {

        text-decoration: none;
        background: #77AADD;


    }


    table {

        border: 1px solid #8F171F;
        width: 20%;

    }


    td {

        align: middle;
        border: 1px solid #8F171F;


    }
    
    .ui-datepicker .ui-widget-content {
    background: #315C7C;
    }
    
    .ui-widget-header {
    border: 1px solid #dddddd;
    background: #E9E86F;
    color: #333333;
    font-weight: bold;
    }

    .ui-datepicker {
    background: #333;
    border: 1px solid #555;
    color: #EEE;
    }


</style>

<?php

$fec1 = $this->data['fecha_ini'];
list($mes, $dia, $anyo) = explode("-", $fec1);
$fecha_ini = $mes . "-" . $dia . "-" . $anyo;

$fec2 = $this->data['fecha_fin'];
list($mes2, $dia2, $anyo2) = explode("-", $fec2);
$fecha_fin = $mes2 . "-" . $dia2 . "-" . $anyo2;

$trip_no = $this->data['item'];
$trip = $data["trip"];





if($trip_no == 101){
    $idtrips = 2;
    //echo $idtrips;
}

if($trip_no == 201){
    $idtrips = 4;
    //echo $idtrips;
}

if($trip_no == 301){
    $idtrips = 6;
    //echo $idtrips;
}

//******************************************************************************************************************************************************************************

$sqlcap= "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5 FROM routes WHERE fecha_ini = '$fecha_ini' AND fecha_fin = '$fecha_ini'  AND trip_no = '$trip_no' ";
$rscap = Doo::db()->query($sqlcap);
$capac = $rscap->fetchAll();


foreach ($capac as $cap) {

}

$capacidad1 = $cap['capacity'];
$capacidad2 = $cap['capacity2'];
$capacidad3 = $cap['capacity3'];
$capacidad4 = $cap['capacity4'];
$capacidad5 = $cap['capacity5'];

$capacidad = $capacidad1 + $capacidad2 + $capacidad3 + $capacidad4 + $capacidad5;

//print($capacidad);



$sql_stdida = "SELECT (sum(pax) + sum(pax2))as tari_std
                        FROM  reservas 
                        Where trip_no = '$trip_no' AND fecha_salida = '$fecha_ini' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
$rs_stdida = Doo::db()->query($sql_stdida, array($trip_no, $fecha_ini));
$r_stdida = $rs_stdida->fetchAll();
$std_seats_ida = $r_stdida[0]['tari_std'] ? $r_stdida[0]['tari_std'] : 0;



$sql_stdretorno = "SELECT (sum(pax) + sum(pax2))as tari_std
                        FROM  reservas 
                        Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha_fin' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
$rs_stdretorno = Doo::db()->query($sql_stdretorno, array($trip_no, $fecha_fin));
$r_stdretorno = $rs_stdretorno->fetchAll();
$std_seats_retorno = $r_stdretorno[0]['tari_std'] ? $r_stdretorno[0]['tari_std'] : 0;

$standard_total = $std_seats_ida + $std_seats_retorno;



$sqlflexida = "SELECT (sum(pax) + sum(pax2))as tari_flex
                        FROM  reservas 
                        Where trip_no = '$trip_no' AND fecha_salida = '$fecha_ini' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
$rsflexida = Doo::db()->query($sqlflexida, array($trip_no, $fecha_ini));
$r_flexida = $rsflexida->fetchAll();
$superflex_seats_ida = $r_flexida[0]['tari_flex'] ? $r_flexida[0]['tari_flex'] : 0;

$sqlflexretorno = "SELECT (sum(pax) + sum(pax2))as tari_flex
                        FROM  reservas 
                        Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha_fin' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
$rsflexretorno = Doo::db()->query($sqlflexretorno, array($trip_no, $fecha_fin));
$r_flexretorno = $rsflexretorno->fetchAll();
$superflex_seats_retorno = $r_flexretorno[0]['tari_flex'] ? $r_flexretorno[0]['tari_flex'] : 0;

$superflex_total = $superflex_seats_ida + $superflex_seats_retorno;

//TOURS////////////////////////////////////////////////////////////////////

//De Ida
$sqlTourIda = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                        FROM  reservas 
                        Where trip_no = '$trip_no' AND fecha_salida = '$fecha_ini' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
$rsti = Doo::db()->query($sqlTourIda, array($trip_no, $fecha_ini));
$r_tida = $rsti->fetchAll();
$ocupadas_tour_ida = $r_tida[0]['ocupadas_tour'] ? $r_tida[0]['ocupadas_tour'] : 0;



//De Retorno
$sqlTourReturn = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                        FROM  reservas 
                        Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha_fin' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
$rstr = Doo::db()->query($sqlTourReturn, array($trip_no, $fecha_fin));
$r_treturn = $rstr->fetchAll();
$ocupadas_tour_return = $r_treturn[0]['ocupadas_tour'] ? $r_treturn[0]['ocupadas_tour'] : 0;


$tours_total = $ocupadas_tour_ida + $ocupadas_tour_return;

//print($ocupadas_tours);

////////////////////////////////////////////////////////////////////////////
//SPECIAL/////////////////////////////////////////////////////////////////

$sql_spcida = "SELECT (sum(pax) + sum(pax2))as tari_spc
                        FROM  reservas 
                        Where trip_no = '$trip_no' AND fecha_salida = '$fecha_ini' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
$rs_spcida = Doo::db()->query($sql_spcida, array($trip_no, $fecha_ini));
$r_spcida = $rs_spcida->fetchAll();
$spc_seats_ida = $r_spcida[0]['tari_spc'] ? $r_spcida[0]['tari_spc'] : 0;



$sql_spcretorno = "SELECT (sum(pax) + sum(pax2))as tari_spc
                        FROM  reservas 
                        Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha_fin' AND id2 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
$rs_spcretorno = Doo::db()->query($sql_spcretorno, array($trip_no, $fecha_fin));
$r_spcretorno = $rs_spcretorno->fetchAll();
$spc_seats_retorno = $r_spcretorno[0]['tari_spc'] ? $r_spcretorno[0]['tari_spc'] : 0;

$special_total = $spc_seats_ida + $spc_seats_retorno;


//////////////////////////////////////////////////////////////////////////


//webfare
$sqlwebida = "SELECT (sum(pax) + sum(pax2))as webfare
    FROM  reservas 
    Where trip_no = '$trip_no' AND fecha_salida = '$fecha_ini' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
$rswebida = Doo::db()->query($sqlwebida, array($trip_no, $fecha_ini));
$r_webida = $rswebida->fetchAll();
$webfare_ida = $r_webida[0]['webfare'] ? $r_webida[0]['webfare'] : 0;

$sqlwebretorno = "SELECT (sum(pax) + sum(pax2))as webfare
                        FROM  reservas 
                        Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha_fin' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
$rswebretorno = Doo::db()->query($sqlwebretorno, array($trip_no, $fecha_fin));
$r_webretorno = $rswebretorno->fetchAll();
$webfare_retorno = $r_webretorno[0]['webfare'] ? $r_webretorno[0]['webfare'] : 0;

$webfare_total = $webfare_ida + $webfare_retorno;

//echo $webfare_total;

//superpromo
$sqlspromoida = "SELECT (sum(pax) + sum(pax2))as spromo
    FROM  reservas 
    Where trip_no = '$trip_no' AND fecha_salida = '$fecha_ini' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
$rsspromoida = Doo::db()->query($sqlspromoida, array($trip_no, $fecha_ini));
$r_spromoida = $rsspromoida->fetchAll();
$superpromo_ida = $r_spromoida[0]['spromo'] ? $r_spromoida[0]['spromo'] : 0;

$sqlspromoretorno = "SELECT (sum(pax) + sum(pax2))as webfare
                        FROM  reservas 
                        Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha_fin' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
$rsspromoretorno = Doo::db()->query($sqlspromoretorno, array($trip_no, $fecha_fin));
$r_spromoretorno = $rsspromoretorno->fetchAll();
$superpromo_retorno = $r_spromoretorno[0]['spromo'] ? $r_spromoretorno[0]['spromo'] : 0;

$superpromo_total = $superpromo_ida + $superpromo_retorno;

//echo $superpromo_total;

//superdiscount
$sqlsdiscida = "SELECT (sum(pax) + sum(pax2))as sdisc
    FROM  reservas 
    Where trip_no = '$trip_no' AND fecha_salida = '$fecha_ini' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
$rsdiscida = Doo::db()->query($sqlsdiscida, array($trip_no, $fecha_ini));
$r_discida = $rsdiscida->fetchAll();
$superdisc_ida = $r_discida[0]['sdisc'] ? $r_discida[0]['sdisc'] : 0;

$sqlsdiscretorno = "SELECT (sum(pax) + sum(pax2))as sdisc
                        FROM  reservas 
                        Where trip_no2 = '$trip_no' AND fecha_retorno = '$fecha_fin' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
$rssdiscretorno = Doo::db()->query($sqlsdiscretorno, array($trip_no, $fecha_fin));
$r_discretorno = $rssdiscretorno->fetchAll();
$superdisc_retorno = $r_discretorno[0]['sdisc'] ? $r_discretorno[0]['sdisc'] : 0;

$superdiscount_total = $superdisc_ida + $superdisc_retorno;

$total_cupos = $standard_total + $superflex_total + $tours_total + $special_total + $webfare_total + $superpromo_total + $superdiscount_total;


if($capacidad == 0){    
    $cupo_disponible = 0;
}else{
   $cupo_disponible = $capacidad - $total_cupos; 
}


?> 



<div style="margin-left:0px;" id="header_page" >   
    
    <div style="font-size: 12pt; margin-left:7px; margin-top: 1px; width: 450px;" class="header2">Matrix Retorno[ <?php echo $data['dato'] . ' Trip - ' . $data['item'] ?> ]<?php echo  "<font color='#800000'>". "     [" .$fecha_ini. " ~ " . $fecha_fin . "]   "; ?> <a id="soldout" style="display:none; margin-left:0px; margin-top: -22px; position:absolute; " href='<?php echo $data['rootUrl'] ?>admin/routes/edit'><img src ='<?php echo $data['rootUrl'] ?>global/img/soldout.gif' width='161px' height='84px'></div>

    <div  id="toolbar">


        <div class="toolbar-list">

            <ul>
                <li class="btn-toolbar" id="btn-save">

                    <a   class="link-button" id="btn-save" onclick="guardando()" style=" margin-top: -5px; margin-left: 9px;">

                        <span class="icon-32-save" title="Save" >&nbsp;</span>

                        Save

                    </a>

                </li>

                <li class="btn-toolbar" id="btn-cancel" style=" margin-top: -5px; margin-left: 9px;">

                    <a  class="link-button" >

                        <span class="icon-back" title="Back" >&nbsp;</span>

                        Back

                    </a>

                </li>

            </ul>

            <div class="clear"></div>

        </div>

        <div class="clear"></div>

    </div>

</div>


<div>


    <div id="serpare">

        <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/routes/save" method="post" name="form1">

            <fieldset style="display:none;"><legend>General Information</legend>

                <div class="input">

                    <label style="width:150px" class="required" id="l_trip_from">Departure</label>

                    <select name="trip_from" id="trip_from" class="select">

                        <option value="0">Select Option</option>  

                        <?php foreach ($data["areas"] as $e): ?>

                            <option value="<?php echo $e["id"]; ?>" <?php echo ($trip->trip_from == trim($e['id']) ? 'selected' : ''); ?>><?php echo $e["nombre"]; ?></option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="input">

                    <label style="width:150px" class="required" id="l_trip_to">Arrival</label>

                    <select name="trip_to" id="trip_to" class="select">

                        <option value="0">Select Option</option>    

                        <?php foreach ($data["areas"] as $e): ?>

                            <option value="<?php echo $e["id"]; ?>" <?php echo (trim($trip->trip_to) == trim($e['id']) ? 'selected' : ''); ?>><?php echo $e["nombre"]; ?></option>

                        <?php endforeach; ?>

                    </select>

                </div> 


                <div class="input">

                    <label style="width:150px" class="required">Trip</label>

                    <select name="trip_no" id="trip_no" class="select">

                        <option value=""></option>    

                        <?php foreach ($data["tripsnumber"] as $e): ?>

                            <option value="<?php echo $e["trip_no"]; ?>" <?php echo ($trip->trip_no == $e['trip_no'] ? 'selected' : ''); ?>><?php echo $e["trip_no"]; ?></option>

                        <?php endforeach; ?>

                    </select>
                    <?php echo ($trip->trip_no == $e['trip_no'] ? 'selected' : ''); ?>
                    <?php echo $e["trip_no"]; ?>
                    <input type="" value="<?php echo $trip->trip_no; ?>" />
                </div> 


                <div class="input">

                    <label style="width:150px" class="required" id="price_1">Adult Price</label>

                    <input name="price" type="text"  id="price" size="10" maxlength="7"  value="<?php echo $trip->price; ?>" />

                </div>

                <div class="input">

                    <label style="width:150px" class="required" id="price_2">Child Price</label>

                    <input name="price2" type="text"  id="price2" size="10" maxlength="7"  value="<?php echo $trip->price2; ?>" />

                </div>

                <div class="input">

                    <label style="width:150px" class="required" id="price_3">Child Price R.</label>

                    <input name="price3" type="text"  id="price3" size="10" maxlength="7"  value="<?php echo $trip->price3; ?>" />

                </div>


                <div class="input">

                    <label style="width:150px" class="required" id="price_3">Adult Price R.</label>

                    <input name="price4" type="text"  id="price3" size="10" maxlength="7"  value="<?php echo $trip->price4; ?>" />

                </div>

                <div class="input">

                    <label style="width:150px" class="required" id="l_trip_departure">Departure Time</label>

                    <input name="trip_departure" type="text"  id="trip_departure" size="10" maxlength="7"  value="<?php echo $trip->trip_departure; ?>" />

                </div>


                <div class="input">

                    <label style="width:150px" class="required" id="l_trip_arrival">Arrival Time</label>

                    <input name="trip_arrival" type="text"  id="trip_arrival" size="10" maxlength="7"  value="<?php echo $trip->trip_arrival; ?>" />

                </div>



                <div class="input">

                    <label style="width:150px" class="required" id="l_anno">Year</label>

                    <input name="anno" type="text"  id="anno" size="10" maxlength="7"  value="<?php echo $trip->anno; ?>" />

                </div>


                <tr><td>

                        <div class="input">

                            <label style="width:150px" id="l_price4">Start Date</label>


                            <input type="text" style="margin-top: 3px; width:95px; color:  #0B55C4; font-weight: bold;"  name="fecha_ini" id="fecha_ini" size="25" maxlength="25" value="<?php echo ($routes->fecha_ini != "" ? date("m-d-Y", $routes->fecha_ini) : ''); ?>"/>

                        </div></td></tr>


                <tr><td>

                        <div class="input">

                            <label style="width:150px" id="l_price4">End Date</label>


                            <input type="text" style="margin-top: 3px; width:95px; color:  #0B55C4; font-weight: bold;"  name="fecha_fin" id="fecha_fin" size="25" maxlength="25" value="<?php echo ($routes->fecha_fin != "" ? date("m-d-Y", $routes->fecha_fin) : ''); ?>"/>

                        </div></td></tr>




                <input name="type_rate" type="hidden" id="type_rate" value="<?php echo $trip->type_rate; ?>" />
                <input name="id" type="hidden" id="id" value="<?php echo $trip->id; ?>" />
            </fieldset>
            <script>
                $(function () {
                    $("#fecha_iniC").datepicker({
                        
                        firstDay: 1,
                        altField: "#fecha_finC",
                        dateFormat: 'mm-dd-yy',
                        maxDate: '+30 Day'                       
                    });   
                    
                $('#fecha_ini1').datepicker({
                        dateFormat: 'yy-mm-dd',
                        minDate: 0,
                        numberOfMonths: 2
                        

                });

                $('#fecha_fin1').datepicker({
                        dateFormat: 'yy-mm-dd',
                        minDate: 0,
                        numberOfMonths: 2
                    });                
                
                });
            </script>
            <?php
                $fechaSistema = date("m-d-y");
            ?>
            <label style="display: none;" for="from">Date ini</label>
            <input style="display: none;" type="text" id="fecha_iniC" name="datepicker" value="<?php echo $fechaSistema; ?>">
            
            <label style="display: none;" for="to">Date fin</label>
            <input style="display: none;" type="text" id="fecha_fin" name="fecha_fin" value="<?php echo date("m-d-Y", strtotime('+30 day', $fecha_ini)) ?>"> 
            
            <input style="display: none;" type="text" id="fecha_finC" name="fecha_finC" /><br /><br />
            
            <script type="text/javascript">
                var text = $('#fecha_finC').val();
                
            </script>
            
            <div id="filter-bar" style="display: none;">
                <label style="width:70px" class="filter-by">Filter by : </label>
                <select name="filtro" id="filtro" class="select">
                    <option value="fecha_ini" <?php echo $data["filtro"] == 'fecha_ini' ? 'selected' : '' ?>>Date</option>
                    <option value="vehicle" <?php echo $data["filtro"] == 'vehicle' ? 'selected' : '' ?>>Vehicles</option>
                    <option value="capacity" <?php echo $data["filtro"] == 'capacity' ? 'selected' : '' ?>>Capacity</option>
                </select>
                <span class="search">
                    <input name="texto" type="text" size="30" maxlength="30" class="input-search" id="texto" value="<?php echo $data["texto"] ?>"/>
                    <input type="button" class="search-btn" id="btn-find" />
                </span>
            </div>
            
            <style type="text/css">
                body {
                    font-family: Arial !important;
                    font-size: 9pt;
                    color: #315C7C;
                }

                a {
                    color: #9F7000;
                    text-decoration: none;
                }

                table {
                    border-left: 1px solid #315C7C;
                    border-right: 0px;
                    font-size: 9pt;
                }

                th.dato {
                    border-right: 1px solid #315C7C;
                    border-top: 1px solid #315C7C;
                    border-left: 0px;
                    border-bottom: 0px;
                    color: #315C7C;
                    background-color: #A7C7DF;
                    font-size: 9pt;
                }

/*                tr {
                    border-collapse;
                }*/

                td.dato {
                    border-right: 1px solid #315C7C;
                    border-top: 1px solid #315C7C;
                    border-left: 0px;
                    border-bottom: 0px;
                    background-color: #FFFFFF;
                    color: #315C7C;
                    font-size: 9pt;
                }

                div.contenedor {
                    width: 373px;
                }

                div.cuerpo {
                    height: 254px;
                    width: 3475px;
                    overflow: auto;
                    border-bottom: 1px solid #315C7C;
                    border-right: 1px solid #315C7C;
                }




                .datagrid table { border-collapse: collapse; text-align: center; margin-left:-1px; margin-top:-2px; height:17%; width: 100%; }
                .datagrid {font: normal 9px/105% Verdana, Arial, Helvetica, sans-serif;  background: #F5F7FF; overflow: hidden; border: 2px solid #07063B; width: 940%; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }
                .datagrid table td, .datagrid table th { padding: -63px 10px; }
                .datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #00008D), color-stop(1, #00BFF1) );
                                          background:-moz-linear-gradient( center top, #225454 5%, #8F171F 100% );
                                          filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#110359', endColorstr='#E01418');
                                          background-color:#F72735; color:#FFFFFF; font-size: 9px; font-weight: bold; border-left: 2px solid #07063B; width: 409px;  }
                .datagrid table thead th:first-child { border: none; }
                .datagrid table tbody td {  color: #000000; border-left: 2px solid #07063B;font-size: 10px;  }
                .datagrid table tbody .alt td { background: #D9D9D9; color: #000000;  }
                .datagrid table tbody td:first-child { border-left: none; }
                .datagrid table tbody tr:last-child td { border-bottom: none; }
                .datagrid table tfoot td div { border-top: 1px solid #07063B;background: #FFFFFF;}
                .datagrid table tfoot td { padding: 0; font-size: 10px }
                .datagrid table tfoot td div{ padding: 3px; }


            </style>


            <style>

                .datagrid2 table2 { border-collapse: collapse; text-align: center; margin-left:-1px; margin-top:-2px; height:17%; width: 100%; }
                .datagrid2 {font: normal 10px/105% Verdana, Arial, Helvetica, sans-serif;  background: #DFF5EC; overflow: hidden; border: 2px solid #07063B; width: 8%; margin-left:1px; margin-top:2px; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }
                .datagrid2 table2 td, .datagrid table2 th { padding: -63px 10px; }
                .datagrid2 table2 thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #00008D), color-stop(1, #00BFF1) );
                                            background:-moz-linear-gradient( center top, #225454 5%, #8F171F 100% );
                                            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#110359', endColorstr='#8F171F');
                                            background-color:#F72735; color:#FFFFFF; font-size: 10px; font-weight: bold; border-left: 2px solid #07063B; width: 409px;  }
                .datagrid2 table2 thead th:first-child { border: none; }
                .datagrid2 table2 tbody td {  color: #000000; border-left: 2px solid #07063B;font-size: 10px;  }
                .datagrid2 table2 tbody .alt td { background: #D9D9D9; color: #000000;  }
                .datagrid2 table2 tbody td:first-child { border-left: none; }
                .datagrid2 table2 tbody tr:last-child td { border-bottom: none; }
                .datagrid2 table2 tfoot td div { border-top: 1px solid #07063B;background: #FFFFFF;}
                .datagrid2 table2 tfoot td { padding: 0; font-size: 10px }
                .datagrid2 table2 tfoot td div{ padding: 3px; }


            </style>

            
        <div id="accordion" >

<!--            <h6  style="color: transparent; background:#fff; border-color: transparent; margin-top:-57px; margin-left: -11px; width: 986px;  padding: 0em 2.2em;" ></h6>

            <div style="display:none; background-color: #fff; margin-top:0px; margin-left:-11px;  width: 948px;  height:75px; padding: 0em 2.2em;">

            </div>-->


            <h3 class="oliveti" style="color: red; border-color: transparent; margin-top:-2px; margin-left: -11px; width: 981px; font-size: 138%; font-weight: bold; ">&nbsp;&nbsp;&nbsp;Editar</h3>

            <div style="margin-top:2px; margin-left:-12px;  width: 950px; height: 99.2px;">

            
            
            <table style="margin-top:-11px; margin-left:-26px;" align="left" cellspacing="0" border="0">
                
                <thead> 
                    
                <tr>
                    <td style="background:#F2F2F2; border-top: 1px double #000000; border-bottom: 1px double #000000; border-left: 1px double #000000; border-right: 1px double #000000;padding-left: 47px;" colspan=2 rowspan=3 height="30" width="95" align="center" valign=middle><font color="#000000" style="margin-left: -43px;">Date</font></td>
                    <td style="background:#F2F2F2; border-top: 1px double #000000; border-bottom: 1px double #000000; border-right: 1px double #000000;" rowspan=3 align="center" width="55" valign=middle sdnum="1033;0;0"><font color="#000000">Vehicles</font></td>
                    <td style="background:#F2F2F2; border-top: 1px double #000000; border-bottom: 1px double #000000; border-right: 1px double #000000;" rowspan=3 align="center" width="55" valign=middle><font color="#000000">Capacity</font>
                        <input type="text" title="Capacidad Total" id="capatot" name="capatot" style="margin-top: -38px; text-align:center; width: 48px; font-weight: bold; color:#000;" size="20" value="" autocomplete="off"/>
                        <input type="text" name="idtrip" id="idtrip" size="10" style="display:none; margin-top: -30px; text-align:center; width: 48px; font-weight: bold; color:#000;" autocomplete="off" value="<?php echo $idtrips; ?>" />
                    </td>
                    <td id="capaci2" name="capaci2" style="display:none; background:#F2F2F2; border-top: 1px double #000000; border-bottom: 1px double #000000; border-right: 1px double #000000;" rowspan=3 align="center" width="55" valign=middle><font color="#000000">Capacity2</font></td>
                    <td id="capaci3" name="capaci3" style="display:none; background:#F2F2F2; border-top: 1px double #000000; border-bottom: 1px double #000000; border-right: 1px double #000000;" rowspan=3 align="center" width="55" valign=middle><font color="#000000">Capacity3</font></td>
                    <td id="capaci4" name="capaci4" style="display:none; background:#F2F2F2; border-top: 1px double #000000; border-bottom: 1px double #000000; border-right: 1px double #000000;" rowspan=3 align="center" width="55" valign=middle><font color="#000000">Capacity4</font></td>
                    <td id="capaci5" name="capaci5" style="display:none; background:#F2F2F2; border-top: 1px double #000000; border-bottom: 1px double #000000; border-right: 1px double #000000;" rowspan=3 align="center" width="55" valign=middle><font color="#000000">Capacity5</font></td>
                    <td style="background:#F2F2F2; border-top: 1px double #000000; border-bottom: 1px double #000000;" rowspan=3 align="center" width="55" valign=middle><font color="#000000">Seats Remain</font></td>
                    <td style="background:#D2E0E4; border-top: 1px double #000000; border-left: 1px double #000000; border-right: 1px double #000000; padding-left: 500px;"  colspan=12 align="center" valign=bottom bgcolor="#BDD7EE" sdnum="1033;0;&quot;$&quot;#,##0.00"><font align="center"  color="#000000" style="margin-left: -500px;">Price</font></td>
                    <td style="border-top: 1px double #000000; padding-left: 350px;" colspan=7 align="center" valign=bottom bgcolor="#FFF2CC"><font color="#000000" style="margin-left: -351px;">Seats</font></td>
                    <td style="border-top: 1px double #000000; border-left: 1px double #000000; padding-left: 55px; " colspan=2 align="center" valign=bottom bgcolor="#2E75B6"><font color="#000000" style="color:#fff; margin-left: -55px;">Extension</font></td>
                    <td style="background:#F2F2F2; background:#bb0000; border-top: 1px double #000000; border-left: 1px double #000000;border-bottom: 1px double #000000; padding-left: 650px; " colspan=13 align="center" valign=bottom><font color="#fff" style="margin-left: -649px;">From Orlando</font></td>
                    <td style="background: #4B0082; border-top: 1px double #000000; border-left: 1px double #000000; border-right: 1px double #000000; border-bottom: 1px double #000000; padding-left: 650px;" colspan=13 align="center" valign=bottom><font color="#fff" style="margin-left: -650px;">From Kissimmee</font></td>
                    <td style="background: #256CB5; border-top: 1px double #000000; border-right: 1px double #000000; border-bottom: 1px double #000000; padding-left: 650px;" colspan=12 align="center" valign=bottom><font color="#fff" style="margin-left: -650px;">From Fort Pierce</font></td>
                    <td style="background: #615247; border-top: 1px double #000000; border-right: 1px double #000000; border-bottom: 1px double #000000; padding-left: 650px;" colspan=11 align="center" valign=bottom><font color="#fff" style="margin-left: -650px;">From Lake Worth</font></td>
                    <td style="background: #72AB07; border-top: 1px double #000000; border-right: 1px double #000000; border-bottom: 1px double #000000; padding-left: 650px;" colspan=10 align="center" valign=bottom><font color="#fff" style="margin-left: -650px;">From Fort Lauderdale</font></td>
                </tr>
                <tr>
                    <td style="border-top: 1px double #000000; border-left: 1px double #000000; border-right: 1px double #000000" colspan=2 align="center" width="55" valign=bottom bgcolor="#F8CBAD" sdnum="1033;0;&quot;$&quot;#,##0.00">Super Promo</td>
                    <td style="border-top: 1px double #000000;" colspan=2 align="center" valign=bottom bgcolor="#F8CBAD" sdnum="1033;0;&quot;$&quot;#,##0.00">Super Discount</td>
                    <td style="border-top: 1px double #000000; border-left: 1px double #000000;border-left: 1px double #000000 " colspan=2 align="center" valign=bottom bgcolor="#F8CBAD" sdnum="1033;0;&quot;$&quot;#,##0.00">Web Fare</td>
                    <td style="border-top: 1px double #000000; border-left: 1px double #000000; " colspan=2 align="center" valign=bottom bgcolor="#C5E0B4" sdnum="1033;0;&quot;$&quot;#,##0.00">Standard</td>
                    <td style="border-top: 1px double #000000; border-left: 1px double #000000; " colspan=2 align="center" valign=bottom bgcolor="#C5E0B4" sdnum="1033;0;&quot;$&quot;#,##0.00">Super Flex</td>
                    <td style="border-top: 1px double #000000; border-left: 1px double #000000; border-right: 1px double #000000 " colspan=2 align="center" valign=bottom bgcolor="#FFE699" sdnum="1033;0;&quot;$&quot;#,##0.00">Florida Resident</td>
                    <td style="border-top: 1px double #000000; border-bottom: 1px double #000000;" rowspan=2 align="center" valign=middle bgcolor="#F8CBAD">Super Promo</td>
                    <td style="border-top: 1px double #000000; border-bottom: 1px double #000000; border-left: 1px double #000000 " rowspan=2 align="center" valign=middle bgcolor="#F8CBAD" sdnum="1033;0;0"><font color="#000000">Super Discount</font></td>
                    <td style="border-top: 1px double #000000; border-bottom: 1px double #000000; border-left: 1px double #000000 " rowspan=2 align="center" valign=middle bgcolor="#F8CBAD" sdnum="1033;0;0"><font color="#000000">WEB FARE</font></td>
                    <td style="border-top: 1px double #000000; border-bottom: 1px double #000000;border-left: 1px double #000000 " rowspan=2 align="center" valign=middle bgcolor="#C5E0B4" sdnum="1033;0;0"><font color="#000000">Standard</font></td>
                    <td style="border-top: 1px double #000000; border-bottom: 1px double #000000; border-left: 1px double #000000 " rowspan=2 align="center" valign=middle bgcolor="#C5E0B4" sdnum="1033;0;0"><font color="#000000">Super Flex</font></td>
                    <td style="border-top: 1px double #000000; border-bottom: 1px double #000000;" rowspan=2 align="center" valign=middle bgcolor="#C55A11" sdnum="1033;0;0"><font color="#000000">Special Prices</font></td>
                    <td style="border-top: 1px double #000000; border-bottom: 1px double #000000;border-left: 1px double #000000 " rowspan=2 align="center" valign=middle bgcolor="#C55A11" sdnum="1033;0;0"><font color="#000000">Tours</font></td>
                    <td style="border-top: 1px double #000000; border-bottom: 1px double #000000;border-left: 1px double #000000" rowspan=2 align="center" valign=middle bgcolor="#DEEBF7" sdnum="1033;0;0"><font color="#000000">Universal</font></td>
                    <td style="border-top: 1px double #000000; border-bottom: 1px double #000000; border-left: 1px double #000000; " rowspan=2 align="center" valign=middle bgcolor="#DEEBF7" sdnum="1033;0;0"><font color="#000000">Walt Disney</font></td>
                    <td style="background:#EDEDED; border-left: 1px double #000000" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Ft Pierce</font></td>
                    <td style="background:#EDEDED; border-left: 1px double #000000" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">L Worth</font></td>
                    <td style="background:#EDEDED; border-left: 1px double #000000" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">FTL</font></td>
                    <td style="background:#EDEDED; border-left: 1px double #000000" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">H/Wood</font></td>
                    <td style="background:#EDEDED; border-left: 1px double #000000" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">NM Beach</font></td>
                    <td style="background:#EDEDED; border-left: 1px double #000000" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">M Beach</font></td>
                    <td style="background:#EDEDED; border-left: 1px double #000000" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">S Beach</font></td>
                    <td style="background:#EDEDED; border-left: 1px double #000000" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">D/town</font></td>
                    <td style="background:#EDEDED; border-left: 1px double #000000" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">POM</font></td>
                    <td style="background:#EDEDED; border-left: 1px double #000000" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Airport</font></td>
                    <td style="background:#EDEDED; border-left: 1px double #000000" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">M.I.A.</font></td>
                    <td style="background:#EDEDED; border-left: 1px double #000000; border-right: 1px double #000000;"align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Hialeah</font></td>
                    <td style="background:#EDEDED;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Kendall</font></td>
                    <td style="background:#C6C6FF; border-left: 1px double #000000; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Ft Pierce</font></td>
                    <td style="background:#C6C6FF; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">L Worth</font></td>
                    <td style="background:#C6C6FF; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">FTL</font></td>
                    <td style="background:#C6C6FF; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">H/Wood</font></td>
                    <td style="background:#C6C6FF; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">NM Beach</font></td>
                    <td style="background:#C6C6FF; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">M Beach</font></td>
                    <td style="background:#C6C6FF; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">S Beach</font></td>
                    <td style="background:#C6C6FF; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">D/town</font></td>
                    <td style="background:#C6C6FF; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">POM</font></td>
                    <td style="background:#C6C6FF; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Airport</font></td>
                    <td style="background:#C6C6FF; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">M.I.A.</font></td>
                    <td style="background:#C6C6FF; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Hialeah</font></td>
                    <td style="background:#C6C6FF; border-right: 1px double #000000" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Kendall</font></td>
                    <td style="background:#d4f1ea; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">L Worth</font></td>
                    <td style="background:#d4f1ea; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">FTL</font></td>
                    <td style="background:#d4f1ea; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">H/Wood</font></td>
                    <td style="background:#d4f1ea; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">NM Beach</font></td>
                    <td style="background:#d4f1ea; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">M Beach</font></td>
                    <td style="background:#d4f1ea; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">S Beach</font></td>
                    <td style="background:#d4f1ea; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">D/town</font></td>
                    <td style="background:#d4f1ea; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">POM</font></td>
                    <td style="background:#d4f1ea; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Airport</font></td>
                    <td style="background:#d4f1ea; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">M.I.A.</font></td>
                    <td style="background:#d4f1ea; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Hialeah</font></td>
                    <td style="background:#d4f1ea; border-right: 1px double #000000" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Kendall</font></td>

                    <td style="background:#FFF2CC; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">FTL</font></td>
                    <td style="background:#FFF2CC; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">H/Wood</font></td>
                    <td style="background:#FFF2CC; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">NM Beach</font></td>
                    <td style="background:#FFF2CC; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">M Beach</font></td>
                    <td style="background:#FFF2CC; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">S Beach</font></td>
                    <td style="background:#FFF2CC; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">D/town</font></td>
                    <td style="background:#FFF2CC; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">POM</font></td>
                    <td style="background:#FFF2CC; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Airport</font></td>
                    <td style="background:#FFF2CC; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">M.I.A.</font></td>
                    <td style="background:#FFF2CC; border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Hialeah</font></td>
                    <td style="background:#FFF2CC; border-right: 1px double #000000" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Kendall</font></td>

                    <td style="background:rgb(255, 230, 153); border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">H/Wood</font></td>
                    <td style="background:rgb(255, 230, 153); border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">NM Beach</font></td>
                    <td style="background:rgb(255, 230, 153); border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">M Beach</font></td>
                    <td style="background:rgb(255, 230, 153); border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">S Beach</font></td>
                    <td style="background:rgb(255, 230, 153); border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">D/town</font></td>
                    <td style="background:rgb(255, 230, 153); border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">POM</font></td>
                    <td style="background:rgb(255, 230, 153); border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Airport</font></td>
                    <td style="background:rgb(255, 230, 153); border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">M.I.A.</font></td>
                    <td style="background:rgb(255, 230, 153); border-right: 1px double #000000;" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Hialeah</font></td>
                    <td style="background:rgb(255, 230, 153); border-right: 1px double #000000" align="center" valign=middle sdnum="1033;0;0"><font color="#000000">Kendall</font></td>

                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px double #000000; border-left: 1px double #000000; " align="center" valign=bottom bgcolor="#F8CBAD" sdnum="1033;0;&quot;$&quot;#,##0.00">Adult</td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px double #000000; border-left: 1px double #000000; " align="center" valign=bottom bgcolor="#F8CBAD" sdnum="1033;0;&quot;$&quot;#,##0.00">Child</td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px double #000000; border-left: 1px double #000000; " align="center" valign=bottom bgcolor="#F8CBAD" sdnum="1033;0;&quot;$&quot;#,##0.00">Adult</td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px double #000000; border-left: 1px double #000000;" align="center" valign=bottom bgcolor="#F8CBAD" sdnum="1033;0;&quot;$&quot;#,##0.00">Child</td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px double #000000; border-left: 1px double #000000;" align="center" valign=bottom bgcolor="#F8CBAD" sdnum="1033;0;&quot;$&quot;#,##0.00">Adult</td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px double #000000; border-left: 1px double #000000;" align="center" valign=bottom bgcolor="#F8CBAD" sdnum="1033;0;&quot;$&quot;#,##0.00">Child</td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px double #000000; border-left: 1px double #000000; " align="center" valign=bottom bgcolor="#C5E0B4" sdnum="1033;0;&quot;$&quot;#,##0.00">Adult</td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px double #000000; border-left: 1px solid #000000;" align="center" valign=bottom bgcolor="#C5E0B4" sdnum="1033;0;&quot;$&quot;#,##0.00">Child</td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px double #000000; border-left: 1px double #000000; " align="center" valign=bottom bgcolor="#C5E0B4" sdnum="1033;0;&quot;$&quot;#,##0.00">Adult</td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px double #000000; border-left: 1px solid #000000;" align="center" valign=bottom bgcolor="#C5E0B4" sdnum="1033;0;&quot;$&quot;#,##0.00">Child</td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px double #000000; border-left: 1px double #000000;" align="center" valign=bottom bgcolor="#FFE699" sdnum="1033;0;&quot;$&quot;#,##0.00">Adult</td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px double #000000; border-left: 1px solid #000000; border-right: 1px double #000000" align="center" valign=bottom bgcolor="#FFE699" sdnum="1033;0;&quot;$&quot;#,##0.00">Child</td>
                    <td style="background:#bb0000; border-top: 1px double #000000; border-bottom: 1px double #000000; border-left: 1px double #000000;" colspan=13 align="center" valign=middle sdnum="1033;0;0"><font color="#fff">To Orlando</font></td>
                    <td style="background: #4B0082; border-top: 1px double #000000; border-bottom: 1px double #000000; border-left: 1px double #000000; border-right: 1px double #000000" colspan=13 align="center" valign=middle sdnum="1033;0;0"><font color="#fff">To Kissimmee</font></td>
                    <td style="background: #256CB5; border-top: 1px double #000000; border-bottom: 1px double #000000; border-right: 1px double #000000" colspan=12 align="center" valign=middle sdnum="1033;0;0"><font color="#fff">To Fort Pierce</font></td>
                    <td style="background: #615247; border-top: 1px double #000000; border-bottom: 1px double #000000; border-right: 1px double #000000" colspan=11 align="center" valign=middle sdnum="1033;0;0"><font color="#fff">To Lake Worth</font></td>
                    <td style="background: #72AB07; border-top: 1px double #000000; border-bottom: 1px double #000000; border-right: 1px double #000000" colspan=10 align="center" valign=middle sdnum="1033;0;0"><font color="#fff">To Fort Lauderdale</font></td>
                </tr>
                                
                </thead>
                
                
                <?php
                //$sql11 = "SELECT  DISTINCT capacity, fecha_ini, trip_no, vehicles, capacity2, capacity3, capacity4, capacity5, seats_remain, spprc_adult,spprc_child,sdprc_adult,sdprc_child,wfprc_adult,wfprc_child,stprc_adult,stprc_child,sflexprc_adult,sflexprc_child,flresprc_adult,flresprc_child,spseats,sdseats,wfseats,stseats,sflexseats,spprcseats,toursseats,univext,wdext,f1t3 FROM routes WHERE (fecha_ini >= '$fec1' AND fecha_fin <= '$fec2') AND trip_no = '$trip_no' AND trip_from = '3' AND trip_to = '1'";
                $sql11 = "SELECT  DISTINCT capacity, capacity2, capacity3, capacity4, capacity5, fecha_ini, trip_no, vehicles, seats_remain, spprc_adult,spprc_child,sdprc_adult,sdprc_child,wfprc_adult,wfprc_child,stprc_adult,stprc_child,sflexprc_adult,sflexprc_child,flresprc_adult,flresprc_child,spseats,sdseats,wfseats,stseats,sflexseats,spprcseats,toursseats,univext,wdext,f1t3,f1t4,f1t5,f1t6,f1t7,f1t8,f1t9,f1t10,f1t19,f1t11,f1t12,f1t13,f1t14,f2t3,f2t4,f2t5,f2t6,f2t7,f2t8,f2t9,f2t10,f2t19,f2t11,f2t12,f2t13,f2t14,f3t4,f3t5,f3t6,f3t7,f3t8,f3t9,f3t10,f3t19,f3t11,f3t12,f3t13,f3t14,f4t5,f4t6,f4t7,f4t8,f4t9,f4t10,f4t19,f4t11,f4t12,f4t13,f4t14,f5t6,f5t7,f5t8,f5t9,f5t10,f5t19,f5t11,f5t12,f5t13,f5t14 FROM routes WHERE (fecha_ini >= '$fec1' AND fecha_fin <= '$fec2') AND trip_no = '$trip_no' ";
                $rs11 = Doo::db()->query($sql11);
                $result = $rs11->fetchAll();

                foreach ($result as $registro) {

                }    

                    $vehicles = $registro['vehicles'];
                    $capacity = $registro['capacity'];
                    $capacity2 = $registro['capacity2'];
                    $capacity3 = $registro['capacity3'];
                    $capacity4 = $registro['capacity4'];
                    $capacity5 = $registro['capacity5'];
                    $capatot = $capacity + $capacity2 + $capacity3 + $capacity4 + $capacity5;
                    $seats_remain = $cupo_disponible;
                    $spprc_adult = $registro['spprc_adult'];
                    $spprc_child = $registro['spprc_child'];
                    $sdprc_adult = $registro['sdprc_adult'];
                    $sdprc_child = $registro['sdprc_child'];
                    $wfprc_adult = $registro['wfprc_adult'];
                    $wfprc_child = $registro['wfprc_child'];
                    $stprc_adult = $registro['stprc_adult'];
                    $stprc_child = $registro['stprc_child'];
                    $sflexprc_adult = $registro['sflexprc_adult'];
                    $sflexprc_child = $registro['sflexprc_child'];
                    $flresprc_adult = $registro['flresprc_adult'];
                    $flresprc_child = $registro['flresprc_child'];
                    $spseats = $registro['spseats'];
                    $sdseats = $registro['sdseats'];
                    $wfseats = $registro['wfseats'];
                    $stseats = $registro['stseats'];
                    $sflexseats = $registro['sflexseats'];
                    $spprcseats = $registro['spprcseats'];
                    $toursseats = $registro['toursseats'];
                    $univext = $registro['univext'];
                    $wdext = $registro['wdext'];

                
               
                $f1t3 = $registro['f1t3'];
                    if ($f1t3 == '') {
                        $registro['f1t3'] = '0.00';
                    } else {
                        $registro['f1t3'] = $f1t3;
                }

                $f1t4 = $registro['f1t4'];
                if ($f1t4 == '') {
                    $registro['f1t4'] = '0.00';
                } else {
                    $registro['f1t4'] = $f1t4;
                }


                $f1t5 = $registro['f1t5'];
                if ($f1t5 == '') {
                    $registro['f1t5'] = '0.00';
                } else {
                    $registro['f1t5'] = $f1t5;
                }

               
                $f1t6 = $registro['f1t6'];
                if ($f1t6 == '') {
                    $registro['f1t6'] = '0.00';
                } else {
                    $registro['f1t6'] = $f1t6;
                }

               
                $f1t7 = $registro['f1t7'];
                if ($f1t7 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f1t7'] = 'N/A';
                    }
                    if ($trip_no == 301) {
                        $registro['f1t7'] = '0.00';
                    }
                } else {
                    $registro['f1t7'] = $f1t7;
                }



                $f1t8 = $registro['f1t8'];
                if ($f1t8 == '') {
                    $registro['f1t8'] = '0.00';
                } else {
                    $registro['f1t8'] = $f1t8;
                }


                
                $f1t9 = $registro['f1t9'];
                if ($f1t9 == '') {
                    $registro['f1t9'] = '0.00';
                } else {
                    $registro['f1t9'] = $f1t9;
                }


                $f1t10 = $registro['f1t10'];

                if ($f1t10 == '') {
                    $registro['f1t10'] = '0.00';
                } else {
                    $registro['f1t10'] = $f1t10;
                }


                $f1t19 = $registro['f1t19'];
                if ($f1t19 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f1t19'] = '0.00';
                    }
                    if ($trip_no == 301) {
                        $registro['f1t19'] = 'N/A';
                    }
                } else {
                    $registro['f1t19'] = $f1t19;
                }


                $f1t11 = $registro['f1t11'];
                if ($f1t11 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f1t11'] = '0.00';
                    }
                    if ($trip_no == 301) {
                        $registro['f1t11'] = 'N/A';
                    }
                } else {
                    $registro['f1t11'] = $f1t11;
                }                


                $f1t12 = $registro['f1t12'];
                if ($f1t12 == '') {
                    $registro['f1t12'] = '0.00';
                } else {
                    $registro['f1t12'] = $f1t12;
                }


                $f1t13 = $registro['f1t13'];
                if ($f1t13 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f1t13'] = 'N/A';
                    }
                    if ($trip_no == 301) {
                        $registro['f1t13'] = '0.00';
                    }
                } else {
                    $registro['f1t13'] = $f1t13;
                }                


                $f1t14 = $registro['f1t14'];
                if ($f1t14 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f1t14'] = 'N/A';
                    }
                    if ($trip_no == 301) {
                        $registro['f1t14'] = '0.00';
                    }
                } else {
                    $registro['f1t14'] = $f1t14;
                }
                

                $f2t3 = $registro['f2t3'];
                if ($f2t3 == '') {
                    $registro['f2t3'] = '0.00';
                } else {
                    $registro['f2t3'] = $f2t3;
                }
                

                $f2t4 = $registro['f2t4'];

                if ($f2t4 == '') {
                    $registro['f2t4'] = '0.00';
                } else {
                    $registro['f2t4'] = $f2t4;
                }                


                $f2t5 = $registro['f2t5'];
                if ($f2t5 == '') {
                    $registro['f2t5'] = '0.00';
                } else {
                    $registro['f2t5'] = $f2t5;
                }                


                $f2t6 = $registro['f2t6'];
                if ($f2t6 == '') {
                    $registro['f2t6'] = '0.00';
                } else {
                    $registro['f2t6'] = $f2t6;
                }
                

                $f2t7 = $registro['f2t7'];
                if ($f2t7 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f2t7'] = 'N/A';
                    }
                    if ($trip_no == 301) {
                        $registro['f2t7'] = '0.00';
                    }
                } else {
                    $registro['f2t7'] = $f2t7;
                }


                $f2t8 = $registro['f2t8'];
                if ($f2t8 == '') {
                    $registro['f2t8'] = '0.00';
                } else {
                    $registro['f2t8'] = $f2t8;
                }


                
                $f2t9 = $registro['f2t9'];
                if ($f2t9 == '') {
                    $registro['f2t9'] = '0.00';
                } else {
                    $registro['f2t9'] = $f2t9;
                }
                

                $f2t10 = $registro['f2t10'];
                if ($f2t10 == '') {
                    $registro['f2t10'] = '0.00';
                } else {
                    $registro['f2t10'] = $f2t10;
                }



                
                $f2t19 = $registro['f2t19'];
                if ($f2t19 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f2t19'] = '0.00';
                    }
                    if ($trip_no == 301) {
                        $registro['f2t19'] = 'N/A';
                    }
                } else {
                    $registro['f2t19'] = $f2t19;
                }


               

                $f2t11 = $registro['f2t11'];
                if ($f2t11 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f2t11'] = '0.00';
                    }
                    if ($trip_no == 301) {
                        $registro['f2t11'] = 'N/A';
                    }
                } else {
                    $registro['f2t11'] = $f2t11;
                }

               


                $f2t12 = $registro['f2t12'];
                if ($f2t12 == '') {
                    $registro['f2t12'] = '0.00';
                } else {
                    $registro['f2t12'] = $f2t12;
                }

                

                $f2t13 = $registro['f2t13'];
                if ($f2t13 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f2t13'] = 'N/A';
                    }
                    if ($trip_no == 301) {
                        $registro['f2t13'] = '0.00';
                    }
                } else {
                    $registro['f2t13'] = $f2t13;
                }

                

                $f2t14 = $registro['f2t14'];
                if ($f2t14 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f2t14'] = 'N/A';
                    }
                    if ($trip_no == 301) {
                        $registro['f2t14'] = '0.00';
                    }
                } else {
                    $registro['f2t14'] = $f2t14;
                }

                

                $f3t4 = $registro['f3t4'];
                if ($f3t4 == '') {
                    $registro['f3t4'] = '0.00';
                } else {
                    $registro['f3t4'] = $f3t4;
                }

                

                $f3t5 = $registro['f3t5'];
                if ($f3t5 == '') {
                    $registro['f3t5'] = '0.00';
                } else {
                    $registro['f3t5'] = $f3t5;
                }

                

                $f3t6 = $registro['f3t6'];
                if ($f3t6 == '') {
                    $registro['f3t6'] = '0.00';
                } else {
                    $registro['f3t6'] = $f3t6;
                }

                

                $f3t7 = $registro['f3t7'];
                if ($f3t7 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f3t7'] = 'N/A';
                    }
                    if ($trip_no == 301) {
                        $registro['f3t7'] = '0.00';
                    }
                } else {
                    $registro['f3t7'] = $f3t7;
                }

                

                $f3t8 = $registro['f3t8'];
                if ($f3t8 == '') {
                    $registro['f3t8'] = '0.00';
                } else {
                    $registro['f3t8'] = $f3t8;
                }

                

                $f3t9 = $registro['f3t9'];
                if ($f3t9 == '') {
                    $registro['f3t9'] = '0.00';
                } else {
                    $registro['f3t9'] = $f3t9;
                }

                

                $f3t10 = $registro['f3t10'];
                if ($f3t10 == '') {
                    $registro['f3t10'] = '0.00';
                } else {
                    $registro['f3t10'] = $f3t10;
                }

                

                $f3t19 = $registro['f3t19'];
                if ($f3t19 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f3t19'] = '0.00';
                    }
                    if ($trip_no == 301) {
                        $registro['f3t19'] = 'N/A';
                    }
                } else {
                    $registro['f3t19'] = $f3t19;
                }

                

                $f3t11 = $registro['f3t11'];
                if ($f3t11 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f3t11'] = '0.00' ;
                    }
                    if ($trip_no == 301) {
                        $registro['f3t11'] = 'N/A' ;
                    }
                } else {
                    $registro['f3t11'] = $f3t11;
                }

                

                $f3t12 = $registro['f3t12'];
                if ($f3t12 == '') {
                    $registro['f3t12'] = '0.00';
                } else {
                    $registro['f3t12'] = $f3t12;
                }

                

                $f3t13 = $registro['f3t13'];
                if ($f3t13 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f3t13'] = 'N/A';
                    }
                    if ($trip_no == 301) {
                        $registro['f3t13'] = '0.00';
                    }
                } else {
                    $registro['f3t13'] = $f3t13;
                }


                

                $f3t14 = $registro['f3t14'];
                if ($f3t14 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f3t14'] = 'N/A';
                    }
                    if ($trip_no == 301) {
                        $registro['f3t14'] = '0.00';
                    }
                } else {
                    $registro['f3t14'] = $f3t14;
                }


                
                $f4t5 = $registro['f4t5'];
                if ($f4t5 == '') {
                    $registro['f4t5'] = '0.00';
                } else {
                    $registro['f4t5'] = $f4t5;
                }


                

                $f4t6 = $registro['f4t6'];
                if ($f4t6 == '') {
                    $registro['f4t6'] = '0.00';
                } else {
                    $registro['f4t6'] = $f4t6;
                }

                

                $f4t7 = $registro['f4t7'];
                if ($f4t7 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f4t7'] = 'N/A';
                    }
                    if ($trip_no == 301) {
                        $registro['f4t7'] = '0.00';
                    }
                } else {
                    $registro['f4t7'] = $f4t7;
                }

                

                $f4t8 = $registro['f4t8'];
                if ($f4t8 == '') {
                    $registro['f4t8'] = '0.00';
                } else {
                    $registro['f4t8'] = $f4t8;
                }


                

                $f4t9 = $registro['f4t9'];
                if ($f4t9 == '') {
                    $registro['f4t9'] = '0.00';
                } else {
                    $registro['f4t9'] = $f4t9;
                }

                
                $f4t10 = $registro14101['f4t10'];
                if ($f4t10 == '') {
                    $registro14101['f4t10'] = '0.00';
                } else {
                    $registro14101['f4t10'] = $f4t10;
                }

                

                $f4t19 = $registro['f4t19'];
                if ($f4t19 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f4t19'] = '0.00';
                    }
                    if ($trip_no == 301) {
                        $registro['f4t19'] = 'N/A' ;
                    }
                } else {
                    $registro['f4t19'] = $f4t19;
                }


                

                $f4t11 = $registro['f4t11'];
                if ($f4t11 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f4t11'] = '0.00';
                    }
                    if ($trip_no == 301) {
                        $registro['f4t11'] = 'N/A';
                    }
                } else {
                    $registro['f4t11'] = $f4t11;
                }


                

                $f4t12 = $registro['f4t12'];
                if ($f4t12 == '') {
                    $registro['f4t12'] = '0.00';
                } else {
                    $registro['f4t12'] = $f4t12;
                }


                
                $f4t13 = $registro['f4t13'];
                if ($f4t13 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f4t13'] = 'N/A';
                    }
                    if ($trip_no == 301) {
                        $registro['f4t13'] = '0.00';
                    }
                } else {
                    $registro['f4t13'] = $f4t13;
                }

                

                $f4t14 = $registro['f4t14'];
                if ($f4t14 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f4t14'] = 'N/A';
                    }
                    if ($trip_no == 301) {
                        $registro['f4t14'] = '0.00';
                    }
                } else {
                    $registro['f4t14'] = $f4t14;
                }

                

                $f5t6 = $registro['f5t6'];
                if ($f5t6 == '') {
                    $registro['f5t6'] = '0.00';
                } else {
                    $registro['f5t6'] = $f5t6;
                }

                

                $f5t7 = $registro['f5t7'];
                if ($f5t7 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f5t7'] = 'N/A';
                    }
                    if ($trip_no == 301) {
                        $registro['f5t7'] = '0.00';
                    }
                } else {
                    $registro['f5t7'] = $f5t7;
                }

                

                $f5t8 = $registro['f5t8'];
                if ($f5t8 == '') {
                    $registro['f5t8'] = '0.00';
                } else {
                    $registro['f5t8'] = $f5t8;
                }

                

                $f5t9 = $registro['f5t9'];
                if ($f5t9 == '') {
                    $registro['f5t9'] = '0.00';
                } else {
                    $registro['f5t9'] = $f5t9;
                }

                

                $f5t10 = $registro['f5t10'];
                if ($f5t10 == '') {
                    $registro['f5t10'] = '0.00';
                } else {
                    $registro['f5t10'] = $f5t10;
                }

                

                $f5t19 = $registro['f5t19'];
                if ($f5t19 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f5t19'] = '0.00';
                    }
                    if ($trip_no == 301) {
                        $registro['f5t19'] = 'N/A' ;
                    }
                } else {
                    $registro['f5t19'] = $f5t19;
                }

                

                $f5t11 = $registro['f5t11'];
                if ($f5t11 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f5t11'] = '0.00';
                    }
                    if ($trip_no == 301) {
                        $registro['f5t11'] = 'N/A';
                    }
                } else {
                    $registro['f5t11'] = $f5t11;
                }

                

                $f5t12 = $registro['f5t12'];
                if ($f5t12 == '') {
                    $registro['f5t12'] = '0.00';
                } else {
                    $registro['f5t12'] = $f5t12;
                }

                
                $f5t13 = $registro['f5t13'];
                if ($f5t13 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f5t13'] = 'N/A';
                    }
                    if ($trip_no == 301) {
                        $registro['f5t13'] = '0.00';
                    }
                } else {
                    $registro['f5t13'] = $f5t13;
                }

                

                $f5t14 = $registro['f5t14'];
                if ($f5t14 == '') {
                    if ($trip_no == 101 || 201) {
                        $registro['f5t14'] = 'N/A';
                    }
                    if ($trip_no == 301) {
                        $registro['f5t14'] = '0.00';
                    }
                } else {
                    $registro['f5t14'] = $f5t14;
                }


                
                ?>
                <tr onclick = "this.style.background = '#f01133'">

                            <td>                            
                                <input title='Start Date' type="text" style="text-align:center;  margin-top: 1px; width:95px; color:  red; font-weight: bold;"  name="fecha_ini1" id="fecha_ini1" size="25" maxlength="25"  value="<?php echo $fec1; ?>" autocomplete="off"/>
                                <input title="Activar Chequeo Para Actualizar Tarifas" style="margin-top:-14px; margin-left:2px;"  name="d1" type="checkbox" value="1" checked/>
                            </td>
                            <td> 
                                <input title='End Date' type="text" style="text-align:center;  margin-top: 1px; width:95px; color:red; font-weight: bold;"  name="fecha_fin1" id="fecha_fin1" size="25" maxlength="25"  value="<?php echo $fec2; ?>" autocomplete="off"/>
                                <input style="display:none; margin-top:-14px; margin-left:2px;"  name="d2" type="checkbox" value="1" />
                            </td>

                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="vehicles" type="text"  autocomplete="off" id="vehicles" size="20" onkeypress="validate(event)" onkeyup="vehiculos();remain_tours();capacidad_total();" maxlength="10" value="<?php echo $vehicles; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="capacity" type="text"  autocomplete="off" id="capacity" size="20" onkeypress="validate(event)" onkeyup="remain_tours();capacidad_total();" maxlength="10" value="<?php echo $capacity; ?>"/>
                            </td> 
                            
                            <td id="capacit2" name="capacit2" style="display:none;">
                                <input style="display:none; text-align:center; width: 48px; font-weight: bold; color:#000;" name="capacity2" type="text"  autocomplete="off" id="capacity2" size="20" onkeypress="validate(event)" onkeyup="remain_tours();capacidad_total();" maxlength="10" value="<?php echo $capacity2; ?>"/>
                            </td> 
                            <td id="capacit3" name="capacit3" style="display:none;">
                                <input style="display:none; text-align:center; width: 48px; font-weight: bold; color:#000;" name="capacity3" type="text"  autocomplete="off" id="capacity3" size="20" onkeypress="validate(event)" onkeyup="remain_tours();capacidad_total();" maxlength="10" value="<?php echo $capacity3; ?>"/>
                            </td>
                            <td id="capacit4" name="capacit4" style="display:none;">
                                <input style="display:none; text-align:center; width: 48px; font-weight: bold; color:#000;" name="capacity4" type="text"  autocomplete="off" id="capacity4" size="20" onkeypress="validate(event)" onkeyup="remain_tours();capacidad_total();" maxlength="10" value="<?php echo $capacity4; ?>"/>
                            </td>
                            <td id="capacit5" name="capacit5" style="display:none;">
                                <input style="display:none; text-align:center; width: 48px; font-weight: bold; color:#000;" name="capacity5" type="text"  autocomplete="off" id="capacity5" size="20" onkeypress="validate(event)" onkeyup="remain_tours();capacidad_total();" maxlength="10" value="<?php echo $capacity5; ?>"/>
                            </td>
                            
                            <td>                            
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="seats_remain" type="text"  autocomplete="off" id="seats_remain" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $seats_remain; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="spprc_adult" type="text"  autocomplete="off" id="spprc_adult" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $spprc_adult; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="spprc_child" type="text"  autocomplete="off" id="spprc_child" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $spprc_child; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="sdprc_adult" type="text"  autocomplete="off" id="sdprc_adult" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $sdprc_adult; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="sdprc_child" type="text"  autocomplete="off" id="sdprc_child" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $sdprc_child; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="wfprc_adult" type="text"  autocomplete="off" id="wfprc_adult" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $wfprc_adult; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="wfprc_child" type="text"  autocomplete="off" id="wfprc_child" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $wfprc_child; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="stprc_adult" type="text"  autocomplete="off" id="stprc_adult" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $stprc_adult; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="stprc_child" type="text"  autocomplete="off" id="stprc_child" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $stprc_child; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="sflexprc_adult" type="text"  autocomplete="off" id="sflexprc_adult" onkeypress="validate(event)" size="20" maxlength="10" value="<?php echo $sflexprc_adult; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="sflexprc_child" type="text"  autocomplete="off" id="sflexprc_child" onkeypress="validate(event)" size="20" maxlength="10" value="<?php echo $sflexprc_child; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="flresprc_adult" type="text"  autocomplete="off" id="flresprc_adult" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $flresprc_adult; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="flresprc_child" type="text"  autocomplete="off" id="flresprc_child" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $flresprc_child; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="spseats" type="text"  autocomplete="off" id="spseats" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $spseats; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="sdseats" type="text"  autocomplete="off" id="sdseats" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $sdseats; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="wfseats" type="text"  autocomplete="off" id="wfseats" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $wfseats; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="stseats" type="text"  autocomplete="off" id="stseats" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $stseats; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="sflexseats" type="text"  autocomplete="off" id="sflexseats" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $sflexseats; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="spprcseats" type="text"  autocomplete="off" id="spprcseats" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $spprcseats; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="toursseats" type="text"  autocomplete="off" id="toursseats" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $toursseats; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="univext" type="text"  autocomplete="off" id="univext" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $univext; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" name="wdext" type="text"  autocomplete="off" id="wdext" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $wdext; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f1t3" id="f1t3" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f1t3'];  ?>" />
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f1t4" id="f1t4" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f1t4']; ?>" />
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f1t5" id="f1t5" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f1t5']; ?>" />
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f1t6" id="f1t6" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f1t6']; ?>" />
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f1t7" id="f1t7" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f1t7']; ?>" />
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f1t8" id="f1t8" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f1t8']; ?>" />
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f1t9" id="f1t9" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f1t9']; ?>" />
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f1t10" id="f1t10" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f1t10'];?>" />
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f1t19" id="f1t19" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f1t19']; ?>" />
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f1t12" id="f1t12" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f1t12']; ?>" />
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f1t11" id="f1t11" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f1t11']; ?>" />
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f1t13" id="f1t13" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f1t13']; ?>" />
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f1t14" id="f1t14" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f1t14']; ?>" />
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f2t3" id="f2t3" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f2t3']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f2t4" id="f2t4" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f2t4']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f2t5" id="f2t5" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f2t5']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f2t6" id="f2t6" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f2t6']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f2t7" id="f2t7" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f2t7']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f2t8" id="f2t8" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f2t8']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f2t9" id="f2t9" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f2t9']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f2t10" id="f2t10" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f2t10']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f2t19" id="f2t19" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f2t19']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f2t12" id="f2t12" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f2t12']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f2t11" id="f2t11" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f2t11']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f2t13" id="f2t13" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f2t13']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f2t14" id="f2t14" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f2t14']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f3t4" id="f3t4" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f3t4']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f3t5" id="f3t5" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f3t5']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f3t6" id="f3t6" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f3t6']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f3t7" id="f3t7" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f3t7']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f3t8" id="f3t8" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f3t8']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f3t9" id="f3t9" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f3t9']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f3t10" id="f3t10" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f3t10']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f3t19" id="f3t19" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f3t19']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f3t12" id="f3t12" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f3t12']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f3t11" id="f3t11" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f3t11']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f3t13" id="f3t13" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f3t13']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f3t14" id="f3t14" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f3t14']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f4t5" id="f4t5" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f4t5']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f4t6" id="f4t6" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f4t6']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f4t7" id="f4t7" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f4t7']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f4t8" id="f4t8" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f4t8']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f4t9" id="f4t9" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f4t9']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f4t10" id="f4t10" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f4t10']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f4t19" id="f4t19" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f4t19']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f4t12" id="f4t12" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f4t12']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f4t11" id="f4t11" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f4t11']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f4t13" id="f4t13" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f4t13']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f4t14" id="f4t14" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f4t14']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f5t6" id="f5t6" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f5t6']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f5t7" id="f5t7" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f5t7']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f5t8" id="f5t8" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f5t8']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f5t9" id="f5t9" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f5t9']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f5t10" id="f5t10" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo$registro['f5t10']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f5t19" id="f5t19" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f5t19']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f5t12" id="f5t12" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f5t12']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f5t11" id="f5t11" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f5t11']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f5t13" id="f5t13" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f5t13']; ?>"/>
                            </td>
                            <td>
                                <input style="text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="f5t14" id="f5t14" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $registro['f5t14']; ?>"/>
                            </td>
                        </tr> 
                        
                        
                        <tr onclick = "this.style.background = '#f01133'">

                            <td>                            
                                <input title='' type="text" style="border-color: transparent;  text-align:center;  margin-top: 1px; width:95px; color:  red; font-weight: bold;"  name="" id="" size="25" maxlength="25"  value="" readonly="readonly" autocomplete="off"/>
<!--                                <input title="Activar Chequeo Para Actualizar Tarifas" style="margin-top:-14px; margin-left:2px;"  name="d1" type="checkbox" value="1" checked/>-->
                            </td>
                            <td> 
                                <input title='' type="text" style="border-color: transparent; text-align:center;  margin-top: 1px; width:95px; color:red; font-weight: bold;"  name="" id="" size="25" maxlength="25"  value="" readonly="readonly" autocomplete="off"/>
<!--                                <input style="display:none; margin-top:-14px; margin-left:2px;"  name="d2" type="checkbox" value="1" />-->
                            </td>

                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" onkeyup="" readonly="readonly" maxlength="10" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td> 
                            
                            <td id="capacit21" name="capacit21" style="display:none;">
                                <input style="display:none; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" onkeyup="" maxlength="10" readonly="readonly" value=""/>
                            </td> 
                            <td id="capacit31" name="capacit31" style="display:none;">
                                <input style="display:none; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" onkeyup="" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td id="capacit41" name="capacit41" style="display:none;">
                                <input style="display:none; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" onkeyup="" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td id="capacit51" name="capacit51" style="display:none;">
                                <input style="display:none; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" onkeyup="" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            
                            <td>                            
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" onkeypress="validate(event)" size="20" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" onkeypress="validate(event)" size="20" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            
                            <td id="sold_2" style="display:none;">
                                <input style="display:none; border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="sold2" id="sold2" type="text"  autocomplete="off"  size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td id="sold_3" style="display:none;">
                                <input style="display:none; border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="sold3" id="sold3" type="text"  autocomplete="off"  size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td id="sold_4" style="display:none;">
                                <input style="display:none; border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="sold4" id="sold4" type="text"  autocomplete="off"  size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td id="sold_5" style="display:none;">
                                <input style="display:none; border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="sold5" id="sold5" type="text"  autocomplete="off"  size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" readonly="readonly" onkeypress="validate(event)" maxlength="10" value="Sold"/>
                            </td>
                            <td>
                                <input style="border-color: #00BFFF; background-color: #00BFFF; text-align:center; width: 48px; font-weight: bold; color:#000;" name="spseats1" type="text"  autocomplete="off" id="spseats1" readonly="readonly" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $superpromo_total ?>"/>
                            </td>
                            <td>
                                <input style="border-color: #00BFFF; background-color: #00BFFF; text-align:center; width: 48px; font-weight: bold; color:#000;" name="sdseats1" type="text"  autocomplete="off" id="sdseats1" readonly="readonly" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $superdiscount_total ?>"/>
                            </td>
                            <td>
                                <input style="border-color: #00BFFF; background-color: #00BFFF; text-align:center; width: 48px; font-weight: bold; color:#000;" name="wfseats1" type="text"  autocomplete="off" id="wfseats1" readonly="readonly" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $webfare_total ?>"/>
                            </td>
                            <td>
                                <input style="border-color: #00BFFF; background-color: #00BFFF; text-align:center; width: 48px; font-weight: bold; color:#000;" name="stseats1" type="text"  autocomplete="off" id="stseats1" size="20" readonly="readonly" onkeypress="validate(event)" maxlength="10" value="<?php echo $standard_total ?>"/>
                            </td>
                            <td>
                                <input style="border-color: #00BFFF; background-color: #00BFFF; text-align:center; width: 48px; font-weight: bold; color:#000;" name="sflexseats1" type="text"  autocomplete="off" id="sflexseats1" readonly="readonly" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $superflex_total; ?>"/>
                            </td>
                            <td>
                                <input style="border-color: #00BFFF; background-color: #00BFFF; text-align:center; width: 48px; font-weight: bold; color:#000;" name="spprcseats1" type="text"  autocomplete="off" id="spprcseats1" readonly="readonly" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $special_total; ?>"/>
                            </td>
                            <td>
                                <input style="border-color: #00BFFF; background-color: #00BFFF; text-align:center; width: 48px; font-weight: bold; color:#000;" name="toursseats1" type="text"  autocomplete="off" id="toursseats1" readonly="readonly" size="20" onkeypress="validate(event)" maxlength="10" value="<?php echo $tours_total; ?>"/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" readonly="readonly" maxlength="10" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" readonly="readonly" maxlength="10" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                        </tr> 
                        
                        
                        <tr onclick = "this.style.background = '#f01133'">

                            <td>                            
                                <input title='Start Date' type="text" style="border-color: transparent; text-align:center;  margin-top: 1px; width:95px; color:  red; font-weight: bold;"  name="" id="" size="25" maxlength="25"  value="" readonly="readonly" autocomplete="off"/>
<!--                                <input title="Activar Chequeo Para Actualizar Tarifas" style="margin-top:-14px; margin-left:2px;"  name="d1" type="checkbox" value="1" checked/>-->
                            </td>
                            <td> 
                                <input title='End Date' type="text" style="border-color: transparent; text-align:center;  margin-top: 1px; width:95px; color:red; font-weight: bold;"  name="" id="" size="25" maxlength="25"  value="" readonly="readonly" autocomplete="off"/>
<!--                                <input style="display:none; margin-top:-14px; margin-left:2px;"  name="d2" type="checkbox" value="1" />-->
                            </td>

                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" onkeyup="" readonly="readonly" maxlength="10" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td> 
                            
                            <td id="capacit2" name="capacit2" style="display:none;">
                                <input style="display:none; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" onkeyup="" maxlength="10" readonly="readonly" value=""/>
                            </td> 
                            <td id="capacit3" name="capacit3" style="display:none;">
                                <input style="display:none; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" onkeyup="" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td id="capacit4" name="capacit4" style="display:none;">
                                <input style="display:none; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" onkeyup="" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td id="capacit5" name="capacit5" style="display:none;">
                                <input style="display:none; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" onkeyup="" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            
                            <td>                            
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" onkeypress="validate(event)" size="20" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" onkeypress="validate(event)" size="20" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            
                            <td id="remain2" style="display:none;">
                                <input style="display:none; border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="rm2" id="rm2" type="text"  autocomplete="off"  size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                                
                            </td>
                            <td id="remain3" style="display:none;">
                                <input style="display:none; border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="rm3" id="rm3" type="text"  autocomplete="off"  size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                                
                            </td>
                            <td id="remain4" style="display:none;">
                                <input style="display:none; border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="rm4" id="rm4" type="text"  autocomplete="off"  size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                                
                            </td>
                            <td id="remain5" style="display:none;">
                                <input style="display:none; border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="rm5" id="rm5" type="text"  autocomplete="off"  size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                                
                            </td>
                            
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" readonly="readonly" onkeypress="validate(event)" maxlength="10" value="Remain"/>
                            </td>
                            <td>
                                <input style="border-color: #FFFACD; background-color: #FFFACD; text-align:center; width: 48px; font-weight: bold; color:#000;" name="spseats2" type="text"  autocomplete="off" id="spseats2" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="0"/>
                            </td>
                            <td>
                                <input style="border-color: #FFFACD; background-color: #FFFACD; text-align:center; width: 48px; font-weight: bold; color:#000;" name="sdseats2" type="text"  autocomplete="off" id="sdseats2" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="0"/>
                            </td>
                            <td>
                                <input style="border-color: #FFFACD; background-color: #FFFACD; text-align:center; width: 48px; font-weight: bold; color:#000;" name="wfseats2" type="text"  autocomplete="off" id="wfseats2" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="0"/>
                            </td>
                            <td>
                                <input style="border-color: #FFFACD; background-color: #FFFACD; text-align:center; width: 48px; font-weight: bold; color:#000;" name="stseats2" type="text"  autocomplete="off" id="stseats2" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="0"/>
                            </td>
                            <td>
                                <input style="border-color: #FFFACD; background-color: #FFFACD; text-align:center; width: 48px; font-weight: bold; color:#000;" name="sflexseats2" type="text"  autocomplete="off" id="sflexseats2" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="0"/>
                            </td>
                            <td>
                                <input style="border-color: #FFFACD; background-color: #FFFACD; text-align:center; width: 48px; font-weight: bold; color:#000;" name="spprcseats2" type="text"  autocomplete="off" id="spprcseats2" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="0"/>
                            </td>
                            <td>
                                <input style="border-color: #FFFACD; background-color: #FFFACD; text-align:center; width: 48px; font-weight: bold; color:#000;" name="toursseats2" type="text"  autocomplete="off" id="toursseats2" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="0"/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" readonly="readonly" maxlength="10" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" name="" type="text"  autocomplete="off" id="" size="20" onkeypress="validate(event)" readonly="readonly" maxlength="10" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value="" />
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                            <td>
                                <input style="border-color: transparent; text-align:center; width: 48px; font-weight: bold; color:#000;" type="text" name="" id="" size="20" onkeypress="validate(event)" maxlength="10" readonly="readonly" value=""/>
                            </td>
                        </tr>
                    
            </table>
                
        </div>


    </div>
    
    </form>
     
     <div  id="save2" style="position:absolute; overflow: visible; z-index: 1000; margin-left: 0px; margin-top: -213px; font-weight: bold; font-size: 16px; display:none;">                
                
                <h6 style="position:absolute; margin-left: 449px; margin-top: -57px;  width: 100px; color: #0B55C4;">Saving...</h6> 
                <a style="margin-left: 455px; margin-top: -36px; position: absolute;" href='<?php echo $data['rootUrl'] ?>admin/routes/edit/'><img src ='<?php echo $data['rootUrl'] ?>global/img/spinner1.gif' width="25px" height="25px" margin-left="0px" margin-top="0px">
    
     </div>   
            
     

            
        
            <?php

                $tripn = $data['item'];

            ?>
<!--            <input type="submit" />-->
            <input type="hidden" value="<?php echo $data['item'] ?>" id="trip_nro" name="trip_nro">
            <input type="hidden" value="<?php echo $fechaFinal; ?>" id="fec_fin" name="fec_fin">
           
                        

            
<!--            <div id="save2" style="margin-left: -78px; margin-top: -518px; display:none;">
                
                <i class="fa fa-cog fa-spin fa-2x fa-fw" style="color: #A11313;"></i>
                
            </div>-->
            
            
            
        

    </div>
    
    <div id="pagination">
        <?php echo $data['pager'] ?>
    </div>

</div>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>

<script type="text/javascript">
    function guardando()
    {
        document.getElementById('save2').style.display = '';

    }
</script>


            
            
<script type="text/javascript">
    function capacidad_total()
    {


        var vehiculo = document.getElementById('vehicles').value;
        var capatot = document.getElementById('capatot').value;
        var capa1 = document.getElementById('capacity').value;
        var capa2 = document.getElementById('capacity2').value;
        var capa3 = document.getElementById('capacity3').value;
        var capa4 = document.getElementById('capacity4').value;
        var capa5 = document.getElementById('capacity5').value;



        if(capa1 == '' || capa1<='0'){

            var caparoso = "<?php echo $capacity; ?>";
            document.getElementById('capacity').value = "<?php echo $capacity; ?>";
            document.getElementById('capatot').value = caparoso;

        }


        if(capa2 == '' || capa2<='0'){

            var caparoso1 = document.getElementById('capacity').value;
            var caparoso2 = document.getElementById('capacity2').value;
            var capares = parseInt(caparoso1) +  parseInt(caparoso2);
//                        document.getElementById('capacity').style.disabled = true;
            document.getElementById('capacity2').value="<?php echo $capacity2; ?>";
            document.getElementById('capatot').value = capares;

        }

        if(capa3 == '' || capa3<='0'){

            var caparoso1 = document.getElementById('capacity').value;
            var caparoso2 = document.getElementById('capacity2').value;
            var caparoso3 = document.getElementById('capacity3').value;
            var capares = parseInt(caparoso1) +  parseInt(caparoso2) +  parseInt(caparoso3);



            document.getElementById('capacity3').value="<?php echo $capacity3; ?>";
            document.getElementById('capatot').value = capares;

        }

        if(capa4 == '' || capa4<='0'){

            var caparoso1 = document.getElementById('capacity').value;
            var caparoso2 = document.getElementById('capacity2').value;
            var caparoso3 = document.getElementById('capacity3').value;
            var caparoso4 = document.getElementById('capacity4').value;

            var capares = parseInt(caparoso1) +  parseInt(caparoso2) +  parseInt(caparoso3) +  parseInt(caparoso4);

            document.getElementById('capacity4').value="<?php echo $capacity4; ?>"; 
            document.getElementById('capatot').value = capares;

        }

        if(capa5 == '' || capa5<='0'){

            var caparoso1 = document.getElementById('capacity').value;
            var caparoso2 = document.getElementById('capacity2').value;
            var caparoso3 = document.getElementById('capacity3').value;
            var caparoso4 = document.getElementById('capacity4').value;
            var caparoso5 = document.getElementById('capacity5').value;

            var capares = parseInt(caparoso1) +  parseInt(caparoso2) +  parseInt(caparoso3) +  parseInt(caparoso4) +  parseInt(caparoso5);

            document.getElementById('capacity5').value="<?php echo $capacity5; ?>";
            document.getElementById('capatot').value = capares;

        }

        if (vehiculo == 1 && (capa1 != '')){

            document.getElementById('capatot').value = parseInt(capa1);

            if(capa1 == 0){
                document.getElementById('capatot').value = "<?php echo $capacity; ?>"; 
            }
        }
        if(vehiculo == 2 && capa2 != ''){


            if(capa1 == 0){
                var capacity = "<?php echo $capacity; ?>"; 
                document.getElementById('capacity').value = "<?php echo $capacity; ?>"; 
                document.getElementById('capatot').value = parseInt(capacity) + parseInt(capa2);
            }

            if(capa2 == 0){
                var capacity2 = "<?php echo $capacity2; ?>"; 
                document.getElementById('capacity2').value = "<?php echo $capacity2; ?>"; 
                document.getElementById('capatot').value = parseInt(capa1) + parseInt(capacity2);
            }                   



        }
        if(vehiculo == 3 && capa3 != ''){

            document.getElementById('capatot').value = parseInt(capa1) + parseInt(capa2) + parseInt(capa3);
        }
        if(vehiculo == 4 && capa4 != ''){

            document.getElementById('capatot').value = parseInt(capa1) + parseInt(capa2) + parseInt(capa3) + parseInt(capa4);
        }
        if(vehiculo == 5 && capa5 != ''){

            document.getElementById('capatot').value = parseInt(capa1) + parseInt(capa2) + parseInt(capa3) + parseInt(capa4) + parseInt(capa5);
        }



    }
</script>


<script type="text/javascript">
    function vehiculos()
    {
        var vehiculo = document.getElementById('vehicles').value;                                      

        if (vehiculo <= 0){

            document.getElementById('vehicles').value = '1';
            document.getElementById('capaci2').style.display = 'none';
            document.getElementById('capacit2').style.display = 'none';
            document.getElementById('capacity2').style.display = 'none';
            document.getElementById('capacity2').value = '0';

            document.getElementById('capaci3').style.display = 'none';
            document.getElementById('capacit3').style.display = 'none';
            document.getElementById('capacity3').style.display = 'none';
            document.getElementById('capacity3').value = '0';

            document.getElementById('capaci4').style.display = 'none';
            document.getElementById('capacit4').style.display = 'none';
            document.getElementById('capacity4').style.display = 'none';
            document.getElementById('capacity4').value = '0';

            document.getElementById('capaci5').style.display = 'none';
            document.getElementById('capacit5').style.display = 'none';
            document.getElementById('capacity5').style.display = 'none';
            document.getElementById('capacity5').value = '0';
        }

        if (vehiculo == 1){


            document.getElementById('capaci2').style.display = 'none';
            document.getElementById('capacit2').style.display = 'none';
            document.getElementById('capacity2').style.display = 'none';
            document.getElementById('capacity2').value = '0';

            document.getElementById('capaci3').style.display = 'none';
            document.getElementById('capacit3').style.display = 'none';
            document.getElementById('capacity3').style.display = 'none';
            document.getElementById('capacity3').value = '0';

            document.getElementById('capaci4').style.display = 'none';
            document.getElementById('capacit4').style.display = 'none';
            document.getElementById('capacity4').style.display = 'none';
            document.getElementById('capacity4').value = '0';

            document.getElementById('capaci5').style.display = 'none';
            document.getElementById('capacit5').style.display = 'none';
            document.getElementById('capacity5').style.display = 'none';
            document.getElementById('capacity5').value = '0';

            document.getElementById('sold_2').style.display = 'none';
            document.getElementById('remain2').style.display = 'none';
            document.getElementById('sold2').style.display = 'none';
            document.getElementById('rm2').style.display = 'none';

            document.getElementById('sold_3').style.display = 'none';
            document.getElementById('remain3').style.display = 'none';
            document.getElementById('sold3').style.display = 'none';
            document.getElementById('rm3').style.display = 'none';

            document.getElementById('sold_4').style.display = 'none';
            document.getElementById('remain4').style.display = 'none';
            document.getElementById('sold4').style.display = 'none';
            document.getElementById('rm4').style.display = 'none';

            document.getElementById('sold_5').style.display = 'none';
            document.getElementById('remain5').style.display = 'none';
            document.getElementById('sold5').style.display = 'none';
            document.getElementById('rm5').style.display = 'none';


        }

        if (vehiculo == 2){


            document.getElementById('capaci2').style.display = '';
            document.getElementById('capacit2').style.display = '';
            document.getElementById('capacity2').style.display = '';

            document.getElementById('capaci3').style.display = 'none';
            document.getElementById('capacit3').style.display = 'none';
            document.getElementById('capacity3').style.display = 'none';
            document.getElementById('capacity3').value = '0';

            document.getElementById('capaci4').style.display = 'none';
            document.getElementById('capacit4').style.display = 'none';
            document.getElementById('capacity4').style.display = 'none';
            document.getElementById('capacity4').value = '0';

            document.getElementById('capaci5').style.display = 'none';
            document.getElementById('capacit5').style.display = 'none';
            document.getElementById('capacity5').style.display = 'none';
            document.getElementById('capacity5').value = '0';

            document.getElementById('sold_2').style.display = '';
            document.getElementById('remain2').style.display = '';
            document.getElementById('sold2').style.display = '';
            document.getElementById('rm2').style.display = '';

            document.getElementById('sold_3').style.display = 'none';
            document.getElementById('remain3').style.display = 'none';
            document.getElementById('sold3').style.display = 'none';
            document.getElementById('rm3').style.display = 'none';

            document.getElementById('sold_4').style.display = 'none';
            document.getElementById('remain4').style.display = 'none';
            document.getElementById('sold4').style.display = 'none';
            document.getElementById('rm4').style.display = 'none';

            document.getElementById('sold_5').style.display = 'none';
            document.getElementById('remain5').style.display = 'none';
            document.getElementById('sold5').style.display = 'none';
            document.getElementById('rm5').style.display = 'none';


        }

        if (vehiculo == 3){


            document.getElementById('capaci2').style.display = '';
            document.getElementById('capacit2').style.display = '';
            document.getElementById('capacity2').style.display = '';

            document.getElementById('capaci3').style.display = '';
            document.getElementById('capacit3').style.display = '';
            document.getElementById('capacity3').style.display = '';

            document.getElementById('capaci4').style.display = 'none';
            document.getElementById('capacit4').style.display = 'none';
            document.getElementById('capacity4').style.display = 'none';
            document.getElementById('capacity4').value = '0';

            document.getElementById('capaci5').style.display = 'none';
            document.getElementById('capacit5').style.display = 'none';
            document.getElementById('capacity5').style.display = 'none';
            document.getElementById('capacity5').value = '0';

            document.getElementById('sold_2').style.display = '';
            document.getElementById('remain2').style.display = '';
            document.getElementById('sold2').style.display = '';
            document.getElementById('rm2').style.display = '';

            document.getElementById('sold_3').style.display = '';
            document.getElementById('remain3').style.display = '';
            document.getElementById('sold3').style.display = '';
            document.getElementById('rm3').style.display = '';

            document.getElementById('sold_4').style.display = 'none';
            document.getElementById('remain4').style.display = 'none';
            document.getElementById('sold4').style.display = 'none';
            document.getElementById('rm4').style.display = 'none';

            document.getElementById('sold_5').style.display = 'none';
            document.getElementById('remain5').style.display = 'none';
            document.getElementById('sold5').style.display = 'none';
            document.getElementById('rm5').style.display = 'none';

        }

        if (vehiculo == 4){


            document.getElementById('capaci2').style.display = '';
            document.getElementById('capacit2').style.display = '';
            document.getElementById('capacity2').style.display = '';

            document.getElementById('capaci3').style.display = '';
            document.getElementById('capacit3').style.display = '';
            document.getElementById('capacity3').style.display = '';

            document.getElementById('capaci4').style.display = '';
            document.getElementById('capacit4').style.display = '';
            document.getElementById('capacity4').style.display = '';

            document.getElementById('capaci5').style.display = 'none';
            document.getElementById('capacit5').style.display = 'none';
            document.getElementById('capacity5').style.display = 'none';
            document.getElementById('capacity5').value = '0';

            document.getElementById('sold_2').style.display = '';
            document.getElementById('remain2').style.display = '';
            document.getElementById('sold2').style.display = '';
            document.getElementById('rm2').style.display = '';

            document.getElementById('sold_3').style.display = '';
            document.getElementById('remain3').style.display = '';
            document.getElementById('sold3').style.display = '';
            document.getElementById('rm3').style.display = '';

            document.getElementById('sold_4').style.display = '';
            document.getElementById('remain4').style.display = '';
            document.getElementById('sold4').style.display = '';
            document.getElementById('rm4').style.display = '';

            document.getElementById('sold_5').style.display = 'none';
            document.getElementById('remain5').style.display = 'none';
            document.getElementById('sold5').style.display = 'none';
            document.getElementById('rm5').style.display = 'none';



        }

        if (vehiculo == 5){



            document.getElementById('capaci2').style.display = '';
            document.getElementById('capacit2').style.display = '';
            document.getElementById('capacity2').style.display = '';

            document.getElementById('capaci3').style.display = '';
            document.getElementById('capacit3').style.display = '';
            document.getElementById('capacity3').style.display = '';

            document.getElementById('capaci4').style.display = '';
            document.getElementById('capacit4').style.display = '';
            document.getElementById('capacity4').style.display = '';

            document.getElementById('capaci5').style.display = '';
            document.getElementById('capacit5').style.display = '';
            document.getElementById('capacity5').style.display = '';

            document.getElementById('sold_2').style.display = '';
            document.getElementById('remain2').style.display = '';
            document.getElementById('sold2').style.display = '';
            document.getElementById('rm2').style.display = '';

            document.getElementById('sold_3').style.display = '';
            document.getElementById('remain3').style.display = '';
            document.getElementById('sold3').style.display = '';
            document.getElementById('rm3').style.display = '';

            document.getElementById('sold_4').style.display = '';
            document.getElementById('remain4').style.display = '';
            document.getElementById('sold4').style.display = '';
            document.getElementById('rm4').style.display = '';

            document.getElementById('sold_5').style.display = '';
            document.getElementById('remain5').style.display = '';
            document.getElementById('sold5').style.display = '';
            document.getElementById('rm5').style.display = '';

        }
//                    

    }
</script>
            
<script type="text/javascript">
    function scrolltop()
    {
        setTimeout(function () {

            document.getElementById('div2').scrollTop = document.getElementById('div1').scrollTop;

        }, 0.001);


    }
</script>

<script languague="javascript">

    function ocultarmenu() {
        div = document.getElementById('menu-bar');
        div.style.display = 'none';
        div2 = document.getElementById('hd-menu');
        div2.style.display = 'none';

    }

</script>

<script type="text/javascript">

    function comprobarScreen()
    {
        
        window.moveTo(0, 0);
	window.resizeTo(screen.width, screen.height);
        window.fullScreen;
        
        if (window.screen.availWidth <= 640) {
            window.parent.document.body.style.zoom = "62%";
        }

        if (window.screen.availWidth == 800) {
            window.parent.document.body.style.zoom = "78%";
        }
        
         if (window.screen.availWidth == 960) {
            window.parent.document.body.style.zoom = "100%";
        } 
        
        if (window.screen.availWidth == 1024) {
            window.parent.document.body.style.zoom = "100%";

        }
        if (window.screen.availWidth == 1280) {
            window.parent.document.body.style.zoom = "100%";

        }
        if (window.screen.availWidth == 1366) {
            window.parent.document.body.style.zoom = "100%";

        }

        if (window.screen.availWidth == 1440) {
            window.parent.document.body.style.zoom = "100%";

        }

        if (window.screen.availWidth == 1600) {
            window.parent.document.body.style.zoom = "100%";

        }

        if (window.screen.availWidth == 1680) {
            window.parent.document.body.style.zoom = "100%";

        }
        if (window.screen.availWidth > 1680) {
            window.parent.document.body.style.zoom = "125%";


        }
    }

</script>


<script type="text/javascript">
                
                   
                $(window).load(function () {
                    
                    //ocultarmenu();
                    comprobarScreen();

                    $("accordion").hide();
                    document.getElementById('capatot').value = document.getElementById('capacity').value;
                    vehiculos();
                    capacidad_total();
                    remain_tours();

                });    
                
                $('#btn-find').click(function () {
                    $('#form1').submit();
                });

                function validateForm() {
                    var sErrMsg = "";
                    var flag = true;

                    sErrMsg += validateText($('#price').val(), $('#price_1').html(), true);
                    sErrMsg += validateText($('#price2').val(), $('#price_1').html(), true);
                    sErrMsg += validateText($('#price3').val(), $('#price_3').html(), true);
                    sErrMsg += validateText($('#trip_departure').val(), $('#l_trip_departure').html(), true);
                    sErrMsg += validateText($('#trip_arrival').val(), $('#l_trip_arrival').html(), true);
                    sErrMsg += validateText($('#anno').val(), $('#l_anno').html(), true);

                    if (document.form1.trip_from.selectedIndex === 0) {
                        sErrMsg += "- debe seleccionar Partida \n";
                    }

                    if (document.form1.trip_to.selectedIndex === 0) {
                        sErrMsg += "- debe seleccionar Llegada \n";
                    }

                    if (document.form1.trip_no.selectedIndex === 0) {
                        sErrMsg += "- debe seleccionar Number Trip \n";
                    }

                    if (sErrMsg !== "")
                    {
                        //alert(sErrMsg);
                        flag = false;
                    }

                    return flag;
                }

                $(function () {
                    $.datepicker.setDefaults($.datepicker.regional["es"]);
                    $("#fecha_ini").datepicker({
                        firstDay: 1
                    });
                });
                $(function () {
                    $.datepicker.setDefaults($.datepicker.regional["es"]);
                    $("#fecha_fin").datepicker({
                        firstDay: 1
                    });
                });

                $('#btn-save').click(function () {

//                    if (validateForm()) {
//                        validar();
                        $('#form1').submit();
//                    }
                });

                $('#btn-cancel').click(function () {
                    window.location = '<?php echo $data['rootUrl']; ?>admin/routes';
                });
</script>

<script type="text/javascript">
    $(function () {
        $("#accordion").accordion({
            collapsible: true
        });
    });

</script>

<script type="text/javascript">

    function validate(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
        var regex = /[0123456789-]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault)
                theEvent.preventDefault();
        }
    }

</script>

<script type="text/javascript">

    function remain_tours()
    {     
               
        setTimeout(function () {
        
        //capacidad total
        var capatot = parseInt($("#capatot").val());
        
        //total cupos disponibles
        var seats_remain = parseInt($("#seats_remain").val());
        
        //WEB PAGE
       
        //super discount asignado
        var sdseats = parseInt($("#sdseats").val());
        
        //webfare asignado
        var wfseats = parseInt($("#wfseats").val());
        
        //super promo asignado
        var spseats = parseInt($("#spseats").val());
        
        
        //super promo vendido
        var spseats1 = parseInt($("#spseats1").val());
        //super discount vendido
        var sdseats1 = parseInt($("#sdseats1").val());
        // web fare vendido
        var wfseats1 = parseInt($("#wfseats1").val());
        
                
        
        //SUR
        
        //superflex asignado
        var sflexseats = parseInt($("#sflexseats").val());
        
        //standard vendido
        var stseats1 = parseInt($("#stseats1").val());
        
        //superflex vendido
        var sflexseats1 = parseInt($("#sflexseats1").val());
        
        //precios especiales vendidos
        var spprcseats1 = parseInt($("#spprcseats1").val());
        
        //tours vendidos
        var toursseats1 = parseInt($("#toursseats1").val());
        
        
        var remain_tours1 = parseInt(spseats1) + parseInt(sdseats1) + parseInt(wfseats1) + parseInt(stseats1) + parseInt(sflexseats1) + parseInt(spprcseats1) + parseInt(toursseats1);
        
        var remain_tours = parseInt(spseats1) + parseInt(sdseats1) + parseInt(wfseats1) + parseInt(stseats1) + parseInt(spprcseats1) + parseInt(toursseats1);
        
        var tot_remain_tours = (capatot - remain_tours1);        
        
        //standard asignado
        var standard = (capatot - sflexseats);
        //webfare asignado
        var webfare = (capatot - wfseats);
        
        //actualizacion
        var wfseats2 = parseInt(standard)-(parseInt(wfseats1) + parseInt(sdseats1) + parseInt(spseats1) + parseInt(stseats1) + parseInt(spprcseats1) + parseInt(toursseats1));
        
        $("#stseats").val(standard);
        $("#wfseats").val(standard);    
        
        //actualizacion
        $("#wfseats2").val(wfseats2);
        
        //REMAIN
        
        //tours disponibles
        $("#toursseats2").val(tot_remain_tours);
        
        //precios especiales disponibles
        $("#spprcseats2").val(tot_remain_tours);
        
        //total cupos disponibles
        $("#seats_remain").val(tot_remain_tours);
        
        //REMAIN////
        
        //super promo disponible
        var spseats2 = parseInt($("#spseats2").val());
        
        
        //super discount disponible
        var sdseats2 = parseInt($("#sdseats2").val());
        
        //web fare disponible     
        
        //var wfseats2 = parseInt($("#wfseats2").val());
        
        if(seats_remain == 0){            
            document.getElementById('soldout').style.display = "";    
        }else{           
            document.getElementById('soldout').style.display = "none";
        }
        
        if(seats_remain > sflexseats){
            
            //var remain_tours = parseInt(spseats1) + parseInt(sdseats1) + parseInt(wfseats1) + parseInt(stseats1) + parseInt(sflexseats1) + parseInt(spprcseats1) + parseInt(toursseats1);
            var result_standard = ((capatot - sflexseats)-(remain_tours));
            var result_superflex = sflexseats - sflexseats1;
            var result_superdiscount = sdseats - sdseats1;
            var result_superpromo = (capatot-sflexseats-wfseats2+(spseats-spseats1))-(wfseats1+sdseats1+spseats1+stseats1+spprcseats1+toursseats1);
            
            //super promo disponible
            $("#spseats2").val(result_superpromo);
            //super discount disponible
            $("#sdseats2").val(result_superdiscount);
            //webfare disponible
            $("#wfseats2").val(result_standard);
            
            //standard disponible
            $("#stseats2").val(result_standard);          
            //super flex disponible
            $("#sflexseats2").val(result_superflex); 
            
            $("#spprcseats").val();
            
            $("#toursseats").val();
            
            $("#spprcseats2").val(capatot-(wfseats1+sdseats1+spseats1+stseats1+sflexseats1+spprcseats1+toursseats1));
            
            $("#toursseats2").val(capatot-(wfseats1+sdseats1+spseats1+stseats1+sflexseats1+spprcseats1+toursseats1)); 
            
            
            
        }else{
                        
            var stseats = parseInt($("#stseats").val());
            var spseats = parseInt($("#spseats").val());
            var spseats1 = parseInt($("#spseats1").val());
            var sdseats = parseInt($("#sdseats").val());
            var sdseats1 = parseInt($("#sdseats1").val());
            var sflexseats = parseInt($("#sflexseats").val());
            var sflexseats1 = parseInt($("#sflexseats1").val());
            var result_superflex = sflexseats - sflexseats1;
            var result_superpromo = spseats - spseats1;
            var result_superdiscount = sdseats - sdseats1;
            
            
            $("#spprcseats").val();            
            $("#toursseats").val();
            
            if(seats_remain == 0){
                
                //standard disponible
                $("#stseats2").val(0);
                //webfare disponible
                $("#wfseats2").val(0);
                //super promo disponible
                $("#spseats2").val(0);
                //super discount disponible
                $("#sdseats2").val(0);
                //super flex disponible
                $("#sflexseats2").val(0);
                //super precios especiales desponibles
                $("#spprcseats2").val(0);
                //super tours disponibles
                $("#toursseats2").val(0); 
                
            }else{
            
                //standard disponible
                $("#stseats2").val(stseats-(wfseats1+sdseats1+spseats1+stseats1+spprcseats1+toursseats1));
                //webfare disponible
                $("#wfseats2").val(wfseats-(wfseats1+sdseats1+spseats1+stseats1+spprcseats1+toursseats1));
                //super promo disponible
                $("#spseats2").val(result_superpromo);
                //super discount disponible
                $("#sdseats2").val(result_superdiscount);
                //super flex disponible
                $("#sflexseats2").val(result_superflex);
                //super precios especiales desponibles
                $("#spprcseats2").val(capatot-(wfseats1+sdseats1+spseats1+stseats1+sflexseats1+spprcseats1+toursseats1));
                //super tours disponibles
                $("#toursseats2").val(capatot-(wfseats1+sdseats1+spseats1+stseats1+sflexseats1+spprcseats1+toursseats1)); 
            }
            
        }        
        
        
     }, 500);        


    }

</script>

<script>
 
 $(document).ready(function () { 
											
                                    var trips = "' . $trips . '";
                                    var tipo_reserva = "' . $tipo_reserva . '";
                                    var seats_remain301 = "' . $seats_remain301 . '";
                                        
                                    alert(trips);
                                                   
                                        function adultos() {
                                            var pasadult = $("#pasadult").val();                    
                                            $("#pax").val(pasadult); 

                                        }

                                        function chicos() {
                                            var pasanino = $("#pasanino").val();                    
                                            $("#pax2").val(pasanino); 

                                        }

                                        function infan() {
                                            var infan = $("#infante").val();                    
                                            $("#infat").val(infan); 

                                        }

                                        function tipo_pax() {


                                            var tipo_px = $("#tipo_pasajero").val();                    
                                            $("#tipo_pass").val(tipo_px); 

                                            setTimeout(function () {

                                                $("#btn-cancelar").click();
                                                $("#mascaraP").fadeIn("slow");
                                                $("#popup").fadeIn("slow");  
                                                $("#tipo_pass").click();


                                            }, 0.001);



                                        }

                                    }
                    
                
                

   
</script>
    
