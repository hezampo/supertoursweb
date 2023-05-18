<?php include Doo::conf()->SITE_PATH . Doo::conf()->PROTECTED_FOLDER . "config/lang/" . Doo::conf()->lang . ".php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Admin Panel</title>
        <link href="<?php echo $data['rootUrl']; ?>global/css/panel.css" rel="stylesheet" type="text/css" />
<!--        <link rel="stylesheet" type="text/css" href="<?php/* echo $data['rootUrl']; */?>global/css/blitzer/jquery-ui-1.8.23.custom.css" />-->
        <link href="<?php echo $data['rootUrl']; ?>global/css/jquery.multiselect.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $data['rootUrl']; ?>global/js/menubar/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $data['rootUrl']; ?>global/css/toolbar.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $data['rootUrl']; ?>global/css/prettify.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $data['rootUrl']; ?>global/css/jquery.Jcrop.css" type="text/css" rel="stylesheet">


            <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js"></script>
            <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui.min.js"></script>
            <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.multiselect.js"></script>
            <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/menubar/js/menu.js"></script>
            <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/prettify.js"></script>
            <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/ajaxfileupload.js"></script>



            <script type="text/javascript">
                $(document).ready(function () {
                    $.menu();
                });
            </script>

            <style>
                .main-icon{
                    padding-left: 10px;
                }
                .main-panel{
                    margin-left:15px;
                    border: 1px solid #CCCCCC;
                    background-color: #f6f6f6;
                    padding:0px 0px 0px 8px;
                }
                .main-icon a{
                    text-decoration: none;
                }
                .row-icons{
                    width:100%;
                    margin-top:10px;
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

                .cielo{
                    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f5f6f6+0,dbdce2+21,b8bac6+49,dddfe3+80,f5f6f6+100;Grey+Pipe */
                    background: rgb(245,246,246); /* Old browsers */
                    background: -moz-linear-gradient(left,  rgba(245,246,246,1) 0%, rgba(219,220,226,1) 21%, rgba(184,186,198,1) 49%, rgba(221,223,227,1) 80%, rgba(245,246,246,1) 100%); /* FF3.6-15 */
                    background: -webkit-linear-gradient(left,  rgba(245,246,246,1) 0%,rgba(219,220,226,1) 21%,rgba(184,186,198,1) 49%,rgba(221,223,227,1) 80%,rgba(245,246,246,1) 100%); /* Chrome10-25,Safari5.1-6 */
                    background: linear-gradient(to right,  rgba(245,246,246,1) 0%,rgba(219,220,226,1) 21%,rgba(184,186,198,1) 49%,rgba(221,223,227,1) 80%,rgba(245,246,246,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f5f6f6', endColorstr='#f5f6f6',GradientType=1 ); /* IE6-9 */

                }

                .cielo2{
                    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#feffff+0,d2ebf9+100;Blue+3D+%2312 */
                    background: rgb(254,255,255); /* Old browsers */
                    background: -moz-linear-gradient(left,  rgba(254,255,255,1) 0%, rgba(210,235,249,1) 100%); /* FF3.6-15 */
                    background: -webkit-linear-gradient(left,  rgba(254,255,255,1) 0%,rgba(210,235,249,1) 100%); /* Chrome10-25,Safari5.1-6 */
                    background: linear-gradient(to right,  rgba(254,255,255,1) 0%,rgba(210,235,249,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#feffff', endColorstr='#d2ebf9',GradientType=1 ); /* IE6-9 */

                }

                .cielo3{
                    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#feffff+62,d2ebf9+80,d2ebf9+80,d2ebf9+89,feffff+89,d2ebf9+89,d2ebf9+89,d2ebf9+90,d2ebf9+91,feffff+91,feffff+91,d2ebf9+91,d2ebf9+100,d2ebf9+100,d2ebf9+100,d2ebf9+100,feffff+100,feffff+100 */
                    background: rgb(254,255,255); /* Old browsers */
                    background: -moz-linear-gradient(top,  rgba(254,255,255,1) 62%, rgba(210,235,249,1) 80%, rgba(210,235,249,1) 80%, rgba(210,235,249,1) 89%, rgba(254,255,255,1) 89%, rgba(210,235,249,1) 89%, rgba(210,235,249,1) 89%, rgba(210,235,249,1) 90%, rgba(210,235,249,1) 91%, rgba(254,255,255,1) 91%, rgba(254,255,255,1) 91%, rgba(210,235,249,1) 91%, rgba(210,235,249,1) 100%, rgba(210,235,249,1) 100%, rgba(210,235,249,1) 100%, rgba(210,235,249,1) 100%, rgba(254,255,255,1) 100%, rgba(254,255,255,1) 100%); /* FF3.6-15 */
                    background: -webkit-linear-gradient(top,  rgba(254,255,255,1) 62%,rgba(210,235,249,1) 80%,rgba(210,235,249,1) 80%,rgba(210,235,249,1) 89%,rgba(254,255,255,1) 89%,rgba(210,235,249,1) 89%,rgba(210,235,249,1) 89%,rgba(210,235,249,1) 90%,rgba(210,235,249,1) 91%,rgba(254,255,255,1) 91%,rgba(254,255,255,1) 91%,rgba(210,235,249,1) 91%,rgba(210,235,249,1) 100%,rgba(210,235,249,1) 100%,rgba(210,235,249,1) 100%,rgba(210,235,249,1) 100%,rgba(254,255,255,1) 100%,rgba(254,255,255,1) 100%); /* Chrome10-25,Safari5.1-6 */
                    background: linear-gradient(to bottom,  rgba(254,255,255,1) 62%,rgba(210,235,249,1) 80%,rgba(210,235,249,1) 80%,rgba(210,235,249,1) 89%,rgba(254,255,255,1) 89%,rgba(210,235,249,1) 89%,rgba(210,235,249,1) 89%,rgba(210,235,249,1) 90%,rgba(210,235,249,1) 91%,rgba(254,255,255,1) 91%,rgba(254,255,255,1) 91%,rgba(210,235,249,1) 91%,rgba(210,235,249,1) 100%,rgba(210,235,249,1) 100%,rgba(210,235,249,1) 100%,rgba(210,235,249,1) 100%,rgba(254,255,255,1) 100%,rgba(254,255,255,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#feffff', endColorstr='#feffff',GradientType=0 ); /* IE6-9 */

                }

                .white{
                    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ffffff+0,ffffff+100&1+0,0+100;White+to+Transparent */
                    background: -moz-linear-gradient(-45deg,  rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%); /* FF3.6-15 */
                    background: -webkit-linear-gradient(-45deg,  rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* Chrome10-25,Safari5.1-6 */
                    background: linear-gradient(135deg,  rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#00ffffff',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

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

                .sky4{

                    background: -moz-linear-gradient(0deg, #141CA8 0%, #FFFFFF 1%, #FCFDFF 50%, #FFFFFF 99%, #CC2B12 100%); /* ff3.6+ */
                    background: -webkit-gradient(linear, left top, right top, color-stop(0%, #141CA8), color-stop(1%, #FFFFFF), color-stop(50%, #FCFDFF), color-stop(99%, #FFFFFF), color-stop(100%, #CC2B12)); /* safari4+,chrome */
                    background: -webkit-linear-gradient(0deg, #141CA8 0%, #FFFFFF 1%, #FCFDFF 50%, #FFFFFF 99%, #CC2B12 100%); /* safari5.1+,chrome10+ */
                    background: -o-linear-gradient(0deg, #141CA8 0%, #FFFFFF 1%, #FCFDFF 50%, #FFFFFF 99%, #CC2B12 100%); /* opera 11.10+ */
                    background: -ms-linear-gradient(0deg, #141CA8 0%, #FFFFFF 1%, #FCFDFF 50%, #FFFFFF 99%, #CC2B12 100%); /* ie10+ */
                    background: linear-gradient(90deg, #141CA8 0%, #FFFFFF 1%, #FCFDFF 50%, #FFFFFF 99%, #CC2B12 100%); /* w3c */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#141CA8', endColorstr='#CC2B12',GradientType=1 ); /* ie6-9 */
                }


                            /* Flash class and keyframe animation */
                .flashit{
                  color:#f2f;
                        -webkit-animation: flash linear 10s infinite;
                        animation: flash linear 1s infinite;
                }
                @-webkit-keyframes flash {
                        0% { opacity: 1; }
                        50% { opacity: .1; }
                        100% { opacity: 1; }
                }
                @keyframes flash {
                        0% { opacity: 1; }
                        50% { opacity: .1; }
                        100% { opacity: 1; }
                }
                /* Pulse class and keyframe animation */
                .pulseit{
                        -webkit-animation: pulse linear 20.5s infinite;
                        animation: pulse linear 20.5s infinite;
                }
                @-webkit-keyframes pulse {
                        0% { width:450px; }
                        50% { width:550px; }
                        100% { width:450px; }
                }
                @keyframes pulse {
                        0% { width:450px; }
                        50% { width:550px; }
                        100% { width:450px; }
                }

/*                   .fadeInRightBig {
  -webkit-animation-name: fadeInRightBig;
  animation-name: fadeInRightBig;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  }
  @-webkit-keyframes fadeInRightBig {
  0% {
  opacity: 0;
  -webkit-transform: translate3d(2000px, 0, 0);
  transform: translate3d(2000px, 0, 0);
  }
  100% {
  opacity: 1;
  -webkit-transform: none;
  transform: none;
  }
  }
  @keyframes fadeInRightBig {
  0% {
  opacity: 0;
  -webkit-transform: translate3d(2000px, 0, 0);
  transform: translate3d(2000px, 0, 0);
  }
  100% {
  opacity: 1;
  -webkit-transform: none;
  transform: none;
  }
  }*/
.bounceIn {
  -webkit-animation-name: bounceIn;
  animation-name: bounceIn;
  -webkit-animation-duration: .75s;
  animation-duration: .75s;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  }
  @-webkit-keyframes bounceIn {
  0%, 20%, 40%, 60%, 80%, 100% {
  -webkit-transition-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000);
  transition-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000);
  }
  0% {
  opacity: 0;
  -webkit-transform: scale3d(.3, .3, .3);
  transform: scale3d(.3, .3, .3);
  }
  20% {
  -webkit-transform: scale3d(1.1, 1.1, 1.1);
  transform: scale3d(1.1, 1.1, 1.1);
  }
  40% {
  -webkit-transform: scale3d(.9, .9, .9);
  transform: scale3d(.9, .9, .9);
  }
  60% {
  opacity: 1;
  -webkit-transform: scale3d(1.03, 1.03, 1.03);
  transform: scale3d(1.03, 1.03, 1.03);
  }
  80% {
  -webkit-transform: scale3d(.97, .97, .97);
  transform: scale3d(.97, .97, .97);
  }
  100% {
  opacity: 1;
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  }
  }
  @keyframes bounceIn {
  0%, 20%, 40%, 60%, 80%, 100% {
  -webkit-transition-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000);
  transition-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000);
  }
  0% {
  opacity: 0;
  -webkit-transform: scale3d(.3, .3, .3);
  transform: scale3d(.3, .3, .3);
  }
  20% {
  -webkit-transform: scale3d(1.1, 1.1, 1.1);
  transform: scale3d(1.1, 1.1, 1.1);
  }
  40% {
  -webkit-transform: scale3d(.9, .9, .9);
  transform: scale3d(.9, .9, .9);
  }
  60% {
  opacity: 1;
  -webkit-transform: scale3d(1.03, 1.03, 1.03);
  transform: scale3d(1.03, 1.03, 1.03);
  }
  80% {
  -webkit-transform: scale3d(.97, .97, .97);
  transform: scale3d(.97, .97, .97);
  }
  100% {
  opacity: 1;
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  }
  }

  .pulse {
  -webkit-animation-name: pulse;
  animation-name: pulse;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  }
  @-webkit-keyframes pulse {
  0% {
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  }
  50% {
  -webkit-transform: scale3d(1.05, 1.05, 1.05);
  transform: scale3d(1.05, 1.05, 1.05);
  }
  100% {
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  }
  }
  @keyframes pulse {
  0% {
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  }
  50% {
  -webkit-transform: scale3d(1.05, 1.05, 1.05);
  transform: scale3d(1.05, 1.05, 1.05);
  }
  100% {
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  }
  }




            </style>



    </head>
    <!--    class="bg-gray"-->
    <body class="sky44" >

        <div id="container" style='height:100% !important'>

            <div id=header>

                <!--<div class="logo"></div>  class="bounceIn"-->
                <?php

//                    $login = $_SESSION['login'];
//                    //$usuario = $login->usuario_pago;
//                    $nombre = $login->nombre;

                ?>
<!--                <h4>
                    <div style="margin-left:444px; margin-top: 19px; position: absolute; width: 292px; color:gray; font-family:sans-serif; font-size:18px; font-weight:bold; text-align:left; " class="header2"><i>Welcome: </i><i><?php echo $nombre; ?></i>
                </h4>-->

                <img class="" src="<?php echo $data['rootUrl']; ?>global/img/logo.png" alt="" style="width: 50.7%; height: 69px; margin-left: -13px; margin-top: -6px;" />
<!--                <div class="" id="save2" style="position:fixed; overflow: visible; z-index: 1000; margin-left: 1095px; margin-top: -226px; font-weight: bold; font-size: 20x; ">    -->

<!--                <img style="margin-left: -292px; margin-top: -3px;" src ='<?php echo $data['rootUrl'] ?>global/img/celebrating.gif' width="66px" height="66px">
            -->
<!--                </div> -->

                <div id="hd-menu">
                    <!--<a class="login img-link" href="" id="login">Administrador del sistema</a>-->
                    <a class="home img-link" style="position:absolute; margin-top:-10px; margin-left: -142px;" href="<?php echo $data['rootUrl']; ?>admin/home" id="home">Home</a>
                    <a class="logout img-link" style="position:absolute; margin-top:-10px; margin-left: -70px;" href="<?php echo $data['rootUrl']; ?>admin/logout">Logout</a>
                </div>

                <br class="clear" />

                <?php

                $login = $_SESSION['login'];

                echo $login->menu;


                ?>
            </div>
            <!-- <div class="hd-login-bar" style="background-color: #60AF45;">La opción de pagos para tours se encuentra habilitada.    Att: Ángel.  </div>
             <div class="hd-login-bar" style="background-color: #6899E2;">Por favor Realizar todos los pagos con credicard en SUR.    Att: Ángel.  </div>-->
            <!--           style="border-radius: 20px; height:525px;" class="verde" -->
            <div id="content">

                <?php include $data['content']; ?>
            </div>

<!--                     <div id="footer" style="
                position:fixed !important;
                bottom: 0px !important;
                width: 990px !important;
            ">
                          Copyright &copy; 2017
                        </div>-->
        </div>

<!--        <h1 class="flashit">Welcome</h1>-->

    </body>
</html>
