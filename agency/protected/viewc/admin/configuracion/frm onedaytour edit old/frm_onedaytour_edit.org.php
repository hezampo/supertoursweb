<!-- Estilos y importaciones de javascript-->
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/panel.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/autocompletar/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css">

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ausu-autosuggest.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/Concurrent.Thread.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<!--jquery para el calendario-->

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/ui/jquery.ui.dialog.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.timeentry.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/menubar/js/menu.js"></script>
<script>
    $(function () {
        console.log('jquery-ready');
    });</script>
<style>
    .fields2 input {
        height: 22px;
        border: #AFAFAF solid thin;
        width: 50px;
        font-family: courier;
        font-size: 22px;
        font-weight: bold;
        text-align: center;
        color: #0033FF;
        padding-top: 3px;
    }

    #t-totale .price {
        text-align: center;
        vertical-align: middle;
        border: #0368CC solid thin;
        background-color: #fff;
        color: #0368CC;
        font-size: 22px;
        font-weight: 600;
    }

    #popup{
        position: absolute;
        top:12%;
        left:12%;
        width:500px;
    }

    .fields input {
        height: 22px;
        border: #AFAFAF solid thin;
        width: 50px;
        float: left;
        padding-right: 3px;
        padding-left: 3px;
        text-align: center;
        font-size:12px;
    }

    .field {
        height: 22px;
        font-size: 11px;
        color: #666;
        text-decoration: none;
        border: #AFAFAF solid thin;
        float: left;
    }
    span .field {
        height: 22px;
        font-size: 11px;
        color: #666;
        text-decoration: none;
        border: #AFAFAF solid thin;
        float: left;
        text-align: center;
    }
    .select {
        font-size: 12px;
        color: #666;
        text-decoration: none;
        height: 27px;
        padding: 3px;
        cursor: pointer;
    }
    .select2 {
        font-size: 14px;
        color: #333;
        text-decoration: none;
        height: 27px;
        padding: 3px;
        font-weight:bold;
        cursor: pointer;
    }

    #arrival {
        background-color: #DCE6F2;
        border: #0167CC solid thin;
        width:400px;
        float: left;
        padding: 8px 10px 20px 8px;
        margin-right: 8px;
        margin-left: 7px;
        height: auto;
    }
    #departure {
        background-color: #F3DCDC;
        border: #B83A36 solid thin;
        width: 404px;
        float: left;
        padding: 8px 10px 20px 8px;
        height: auto;
        margin-bottom: 4px;
    }

    #type .list {
        float: left;
        padding: 0 2px 0 2px;
        margin: 0;
    }
    #type .label {
        float: left;
        margin-right: 5px;
        margin-top: 4px;
    }
    #type {
        margin: auto auto 8px auto;
        float: left;
        width: 100%;
        clear: both;
    }

    #type .list li {
        font-size: 11px;
        color: #666;
        display: inline;
        text-decoration: none;
        cursor: pointer;
    }

    #total #amount {
        text-align: center;
        vertical-align: middle;
        border: #0368CC solid thin;
        background-color: #DCE6F2;
        color: #0368CC;
        font-size: 28px;
        font-weight: 600;
    }
    #total .label {
        text-align: center;
        font-size: 16px;
    }
    #t-total .price {
        text-align: center;
        vertical-align: middle;
        border: #0368CC solid thin;
        background-color: #DCE6F2;
        color: #0368CC;
        font-size: 26px;
        font-weight: 600;
    }
    #total .label {
        text-align: center;
        font-size: 16px;
    }
    #t-total .price {
        text-align: center;
        vertical-align: middle;
        border: #33449C solid thin;
        background-color: #33449C;
        color: #fff;
        font-size: 26px;
        font-weight: 600;
        border-radius: 130px 0px 130px 0px;
        margin-left: 9px;
    }
    #t-total .label {
        text-align: center;
        font-size: 12px;
    }

    #t-total2 .label {
        text-align: center;
        font-size: 16px;
    }
    #t-total2 .price {
        text-align: center;
        vertical-align: middle;
        border: #AC1B29 solid thin;
        background-color: #AC1B29;
        color: #fff;
        font-size: 26px;
        font-weight: 600;
    }


    .t-total3 .label {
        text-align: center;
        font-size: 16px;
    }
    .t-total3 .price {
        text-align: center;
        vertical-align: middle;
        border: #AC1B29  solid thin;
        background-color: #AC1B29;
        color: #fff;
        font-size: 26px;
        font-weight: 600;
    }

    .t-total4 .label {
        text-align: center;
        font-size: 16px;
    }
    .t-total4 .price {
        text-align: center;
        vertical-align: middle;
        border: #00F solid thin;
        background-color: #DCE6F2;
        color: #00F;
        font-size: 26px;
        font-weight: 600;
    }

    #content_page_tours {
        border: 1px solid #CCC;
        margin-top: 20px;
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
    }.selector:hover {
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
    #itinerary{
        background-color: #F6F6F6;
        border: 1px solid #CCC;
        width:500px;
        height:250px;
        margin-top:5px;
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

            .gris3{
                /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#d2dfed+0,c8d7eb+26,bed0ea+51,a6c0e3+51,afc7e8+62,bad0ef+75,99b5db+88,799bc8+100;Grey+Blue+Gloss+%231 */
                background: rgb(210,223,237); /* Old browsers */
                background: -moz-linear-gradient(top,  rgba(210,223,237,1) 0%, rgba(200,215,235,1) 26%, rgba(190,208,234,1) 51%, rgba(166,192,227,1) 51%, rgba(175,199,232,1) 62%, rgba(186,208,239,1) 75%, rgba(153,181,219,1) 88%, rgba(121,155,200,1) 100%); /* FF3.6-15 */
                background: -webkit-linear-gradient(top,  rgba(210,223,237,1) 0%,rgba(200,215,235,1) 26%,rgba(190,208,234,1) 51%,rgba(166,192,227,1) 51%,rgba(175,199,232,1) 62%,rgba(186,208,239,1) 75%,rgba(153,181,219,1) 88%,rgba(121,155,200,1) 100%); /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(to bottom,  rgba(210,223,237,1) 0%,rgba(200,215,235,1) 26%,rgba(190,208,234,1) 51%,rgba(166,192,227,1) 51%,rgba(175,199,232,1) 62%,rgba(186,208,239,1) 75%,rgba(153,181,219,1) 88%,rgba(121,155,200,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d2dfed', endColorstr='#799bc8',GradientType=0 ); /* IE6-9 */

            }

            .grey{
                /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#e2e2e2+0,dbdbdb+50,d1d1d1+51,fefefe+100;Grey+Gloss+%231 */
                background: rgb(226,226,226); /* Old browsers */
                background: -moz-linear-gradient(top,  rgba(226,226,226,1) 0%, rgba(219,219,219,1) 50%, rgba(209,209,209,1) 51%, rgba(254,254,254,1) 100%); /* FF3.6-15 */
                background: -webkit-linear-gradient(top,  rgba(226,226,226,1) 0%,rgba(219,219,219,1) 50%,rgba(209,209,209,1) 51%,rgba(254,254,254,1) 100%); /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(to bottom,  rgba(226,226,226,1) 0%,rgba(219,219,219,1) 50%,rgba(209,209,209,1) 51%,rgba(254,254,254,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2e2e2', endColorstr='#fefefe',GradientType=0 ); /* IE6-9 */

            }

            .blue{
                /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#c5deea+0,8abbd7+31,066dab+100;Web+2.0+Blue+3D+%231 */
                background: rgb(197,222,234); /* Old browsers */
                background: -moz-linear-gradient(top,  rgba(197,222,234,1) 0%, rgba(138,187,215,1) 31%, rgba(6,109,171,1) 100%); /* FF3.6-15 */
                background: -webkit-linear-gradient(top,  rgba(197,222,234,1) 0%,rgba(138,187,215,1) 31%,rgba(6,109,171,1) 100%); /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(to bottom,  rgba(197,222,234,1) 0%,rgba(138,187,215,1) 31%,rgba(6,109,171,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c5deea', endColorstr='#066dab',GradientType=0 ); /* IE6-9 */

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
                    
</style>
<?php if (isset($_GET['menssage'])) { ?>
    <div class="success"><?php echo $_GET['menssage']; ?></div>
<?php } ?>
<?php if (isset($_GET['error'])) { ?>
    <div class="error"><?php echo $_GET['error']; ?></div>
<?php } ?>
<div id="header_page" style="background-image: url('<?php echo $data['rootUrl']?>global/img/bg2.jpg');" >
    <div class="header">One Day Tours [ Edit ] ID <?php echo $data['tour']->id; ?>            
        <input id="myTextarea" hidden value="<?php echo $data['tour']->id; ?>">
        <p id="demo"></p>

        <script>
            function myFunction() {
                var x = document.getElementById("myTextarea").value;
                document.getElementById("demo").innerHTML = x;
            }
        </script>








    </div>
    <div  id="toolbar">
        <div class="toolbar-list">
            <ul>
                <li class="btn-toolbar" id="" style="padding: 0 35px;">
                    <form action="<?php echo $data['rootUrl'] ?>admin/resumen/oneday_tour" id="formulario" method="post" name="formulario" onsubmit="onEnviar()">
                        <input id="variable" hidden name="variable"  value="<?php echo $data['tour']->id; ?>"  />
                        <input  type="submit" value="Summary" style="margin-top: 1px;padding: 10px; color: #AC1B29;font-weight: 700;" />
                    </form>
                    <script type="text/javascript">
                        var variableJs = document.getElementById("variable").value;//"2259";

                        function onEnviar() {
                            document.getElementById("variable").value = variableJs;
                        }
                    </script>

                </li>

                <li class="btn-toolbar">
                    <a   class="link-button" id="btn-rastro" style=" margin-top: 0px; margin-left: 12px;">
                        <span class="icon-32-rastro"  title="Rastro" >&nbsp;</span>
                        Traces
                    </a>
                </li>

<!--                <li class="btn-toolbar" id="btn-cancel">
                    <a  class="link-button" >
                        <span class="icon-back" title="Editar" >&nbsp;</span>
                        Back
                    </a>
                </li>-->
                
                <li class="btn-toolbar" id="btn-cancel">
<!--                            <a  class="link-button" ><span class="icon-back" title="Editar" >&nbsp;</span>Back</a>-->
<!--                            <a class="link-button"><i class="fa fa-arrow-left fa-3x" title="Regresar" style="color: #33449C; margin-top: -1px;  margin-left: 1px;"></i> <br style="margin-left: -25px;">Back</a>-->
                            <a title="Back" id="btn-exit" href="<?php echo $data['rootUrl']?>admin/onedaytour"><i class="fa fa-arrow-left fa-3x" style="color:#AC1B29; margin-top: 0px; margin-left: 11px;"></i></a>  
                </li>
                
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<script>
//function myFunction() {
//    var x = document.getElementById("mySelect").value;
//    document.getElementById("demo").innerHTML = x;
//}
</script>
<div id="content_page_tours" style="z-index:1;margin-top: -9px;width: 984px; background-image: url('<?php echo $data['rootUrl']?>global/img/bg2.jpg');">
    <form id="form1" class="form" action="<?php echo $data['rootUrl'] ?>onedaytour/save_edited" method="POST" name="form1">
        <div id="info-group" style="width: 900px;">
            <div id="cancelation">
                <div class="ho">CANCELATION <span>#</span></div>
<!--                <div id="cancel">00000</div>-->
                 <div id="cancel" style="background: #fff;">00000</div>
            </div>
            <div id="reservation" style="width:300px;">
                <div class="ho">RESERVATION <span>#</span></div>
                <div id="reser" style="background: #fff;"><?php echo $data['tour']->code_conf; ?></div>
                <input type="hidden" name="code_conf" id="code_conf" value="<?php echo $data['tour']->code_conf ?>">
            </div>
            <div id="status">
                <div class="ho" style="color: #fff;background: #bb0000; height:12px;"><strong>STATUS</strong></div>
                <div id="stat" style="background: #fff;"><?php echo $data['tour']->estado; ?></div>
            </div>
            <div id="status-change">
<!--                <div><strong>CHANGE STATUS</strong></div>-->
                <div style="color: #fff;background: #bb0000;padding: 4px;margin-top: 0px; width:103px; margin-left: 59px; text-align: -webkit-auto;">CHANGE STATUS</div>
        <!--        <select id="estado" name="estado">
                    <option></option>
                    <option value="CONFIRMED" <?php
                if ($data['tour']->estado == 'CONFIRMED') {
                    echo ' selected="selected" ';
                };
                ?>> CONFIRMED
                    </option>
                    <option value="QUOTE" <?php
                if ($data['tour']->estado == 'QUOTE') {
                    echo ' selected="selected" ';
                };
                ?>>QUOTE
                    </option>
                    <option value="CANCELED" <?php
                if ($data['tour']->estado == 'CANCELED') {
                    echo ' selected="selected" ';
                };
                ?>>CANCELED
                    </option>
                </select>-->
                <select id="estado" name="estado" style="margin-top: -2px; margin-left: -5px; width:110px;">
                    <option></option>
                    <option <?php
                    if ($data['tour']->estado == 'CONFIRMED' || $data['tour']->estado == 'INVOICED') {
                        echo ' selected="selected" ';
                    };
                    ?>  value="CONFIRMED">CONFIRMED</option>
                    <option <?php
                    if ($data['tour']->estado == 'QUOTE') {
                        echo ' selected="selected" ';
                    };
                    ?>  value="QUOTE">QUOTE</option>
                    <option value="NOT SHOW W/ CHARGE" <?php
                    if ($data['tour']->estado == 'NOT SHOW W/ CHARGE') {
                        echo ' selected="selected" ';
                    };
                    ?>>NOT SHOW W/ CHARGE</option>
                    <option value="NOT SHOW W/O CHARGE" <?php
                    if ($data['tour']->estado == 'NOT SHOW W/O CHARGE') {
                        echo ' selected="selected" ';
                    };
                    ?>>NOT SHOW W/O CHARGE</option>
                    <option <?php
                    if ($data['tour']->estado == 'CANCELED') {
                        echo ' selected="selected" ';
                    };
                    ?>  value="CANCELED">CANCELED</option>
                </select>
            </div>
        </div>
        <!-- lider pass -->
        <br />

        <!-- agency and cal center -->
        <!--<fieldset id="inputype" ><legend>INPUT TYPE</legend>-->
        <fieldset id="inputype" style="margin-left:-1px; width:48%; border-radius: 3px 120px 0px 80px;"class="rojo"><legend style="background-color: #fff; border:1px solid #B83A36;">INPUT TYPE</legend> 
            <div id="opera" class="input">
                <table width="100%" >
                    <tr align="left">

                        <td >
                            <label style="margin-left:-2px; color:#FFFFFF;" id="label">CALL CENTER</label>
                        </td>
                        <td >
                            <input style="border-top-left-radius: 25px;text-align: center; width:280px; margin-left: -2px;border-top-right-radius: 25px;" name="nombre" type="text"  id="nombre" value="<?php echo trim($login->nombre . ' (' . $login->usuario . ')'); ?>" readonly="readonly"/>
                        </td>

                    </tr>
                    <tr><td colspan="2" >
                            <table width="100%" style="margin-top: 2%;">
                                <tr>
                                    <td width="10%">
                                        <label style="color:#FFFFFF; margin-left:-2px;">AGENCY</label>
                                    </td>
                                    <td width="40%">
                                        <div class="ausu-suggest" >
                                            <?php if ($data['tour']->id_agency != -1) { ?>
<!--                                            //disabled="disabled"-->
                                                <input style="margin-top:6px; width:150px; margin-left:16px;border-bottom-left-radius: 17px;" name="agency" type="text"  id="agency" size="19" maxlength="30" value="<?php echo $data['agency']->company_name ?>"  autocomplete="off"/>
                                                <input type="hidden" size="4" name="id_agency" id="id_agency" value="<?php echo $data['agency']->id; ?>" autocomplete="off"  readonly="readonly"/>
                                                <input type="hidden" size="4" value="<?php echo $data['agency']->type_rate; ?>" name="type_rate" id="type_rate" autocomplete="off"  readonly="readonly"/>
                                                <input type="hidden" size="4" value="0" name="disponible" id="disponible" autocomplete="off"  readonly="readonly"/>
                                                <input type="hidden" size="4" value="0" name="comision" id="comision" autocomplete="off"  readonly="readonly"/>
                                                <input type="hidden" size="4" value=0 name="comisionable" id="comisionable" autocomplete="off" readonly="readonly" />
                                            <?php } else { ?>
                                                <input name="agency" type="text"  id="agency" size="19" maxlength="30" value=""  autocomplete="off"  disabled="disabled" />
                                                <input type="hidden" size="4" name="id_agency" id="id_agency" value="-1" autocomplete="off"  readonly="readonly"/>
                                                <input type="hidden" size="4" value="-1" name="type_rate" id="type_rate" autocomplete="off"  readonly="readonly"/> 
                                                <input type="hidden" size="4" value="0" name="disponible" id="disponible" autocomplete="off"  readonly="readonly"/>
                                                <input type="hidden" size="4" value="0" name="comision" id="comision" autocomplete="off"  readonly="readonly"/>
                                                <input type="hidden" size="4" value=0 name="comisionable" id="comisionable" autocomplete="off" readonly="readonly" />
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td width="10%">
                                        <label style="color:#FFFFFF; margin-left:16px;">EMPLOY</label>
                                    </td>
                                    <td width="40%">
                                        <div class="ausu-suggest" >
                                            <input style="margin-left:12px; width:150px; margin-top:6px;border-top-right-radius: 25px;" name="uagency"  type="text"  id="uagency" autocomplete="off" size="11" maxlength="30" value="<?php
                                            if (isset($data['uag'])) {
                                                echo $data['uag']->firstname . ' ' . $data['uag']->lastname;
                                            } else {
                                                echo '" disabled="disabled';
                                            }
                                            ?>" disabled="disabled" />
                                            <input type="hidden" size="4" value="<?php
                                            if (isset($data['uag'])) {
                                                echo $data['uag']->id;
                                            } else {
                                                echo '" disabled="disabled';
                                            }
                                            ?>" name="id_auser" id="id_auser" autocomplete="off" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td></tr>

                    <tr><td colspan="2" >&nbsp;</td></tr>
                    <tr>
                        <td colspan="2">
                            <table style="margin-left:94px; margin-top: -10px;" align="center" cellspacing="10">
                                <tr valign="top">
                                    <td><label style="margin-left:4px; color:#FFFFFF;">BY PHONE</label> <input id="byrp" name="byr" type="radio" value="1" checked="checked"/>  </td>
                                    <td><label style="margin-left:4px; color:#FFFFFF;">BY MAIL</label> <input id="byrm" name="byr" type="radio" value="2" /> </td>
                                    <td><label style="margin-left:4px; color:#FFFFFF;">WEBSALE</label><input id="byrw" name="byr" type="radio" value="3" />  </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </fieldset>
        <!--<fieldset id="liderpax">-->
        <fieldset id="liderpax" style="margin-left: 502px; width: 94px; margin-top: -129px; background-color: #DCDCDC; border-radius: 130px 3px 80px 0px;" class="cerati"">
            <legend style=" margin-left: 73px; border:1px solid #00C; background-color: #fff;">LEADER PASS</legend>
            <table>
                <tr>
                    <td >
                        <div id="opera" class="input" style="padding-top:5px;">
                            <table>
                                <tr>
                                    <td>
                                        <label style="margin-left: 1px; margin-top:-5px; width: 145%; color:#FFFFFF;" id="label">SEARCH</label>
                                    </td>
                                    <td>
                                        <div class="ausu-suggest" id="opera">
                                            <input type="text" size="69" style="border-top-left-radius: 17px;border-top-right-radius: 17px; margin-top:-5px; margin-left:29px; width: 338px;" value="<?php echo $data['cliente']->lastname . ' ' . $data['cliente']->firstname . ' - E-Mail -' . $data['cliente']->username ?>" name="cliente" id="cliente" autocomplete="off">

                                            <input type="hidden" size="4" name="id_leader" id="id_leader" autocomplete="off" disabled="disabled" value="<?php echo $data['cliente']->id ?>" readonly="readonly">
                                            <div class="ausu-suggestionsBox"></div></div>
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

                                        <input type="hidden" name="idCliente" id="idCliente" value="<?php echo $data['cliente']->id ?>">
                                        <label style="margin-left: -110px; width:180px; color:#FFFFFF; " id="label">FIRST NAME</label>
                                    </td>
                                    <td>
                                        <input name="firstname1" type="text" style="margin-left: 6px; width: 135px;" id="firstname1" size="20" maxlength="20" value="<?php echo $data['cliente']->firstname ?>">
                                    </td>

                                    <td width="" align="right"> 
                                        <label id="labeldere12" style="margin-left: -14px;width:80px; color:#FFFFFF;">LAST NAME</label>
                                    </td>
                                    <td>
                                        <input name="lastname1" type="text" id="lastname1" size="20" maxlength="20" style="margin-left: -32px; width: 135px;" value="<?php echo $data['cliente']->lastname ?>">
                                    </td>
                                </tr>
                                <tr>                                 

                                    <td align="right"> 
                                        <label style="margin-top: 1px; margin-left: 0px; color:#FFFFFF; "  id="labeldere12">E-MAIL</label>
                                    </td>
                                    <td>
                                        <input name="email1" type="text" id="email1" style="border-bottom-left-radius: 17px;margin-top: 5%; width: 135px;" size="20" value="<?php echo $data['cliente']->username ?>">
                                    </td>
                                    
                                     <td align="right">
                                        <label style="margin-top: 1px; margin-left: -14px; color:#FFFFFF; " id="labeldere12">PHONE</label>
                                    </td>
                                    <td>
                                        <input name="phone1" type="text" style="border-bottom-right-radius: 17px;width: 135px; margin-top: 5%;" id="phone1" size="20" maxlength="20" value="<?php echo $data['cliente']->phone ?>">
                                        <input type="hidden" name="type_cliente" id="type_cliente" value="<?php echo $data['cliente']->tipo_client ?>">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </fieldset>
        <!-- end agency y cal center -->       
        
            <?php
            //obtener esta fecha
            list($anio, $mes, $dia) = explode('-', $data['tour']->starting_date);
            //echo $mes . '-' . $dia . '-' . $anio;
            
//            $fecha_salida = '12-12-2017';
//            list($m, $d, $y) = explode("-", $fecha_salida);
            
            $fecha = $anio . '-01-01 00:00:00';
            //echo   $fecha;        
            $sql = "SELECT priceadult_WDW, pricechild_WDW, priceadult_WATERP, pricechild_WATERP, priceadult_KENNEDYSPC, pricechild_KENNEDYSPC
                        	FROM  onetour  WHERE type_rate = ? AND annio = ?";
            $type = 0;
            $rs = Doo::db()->query($sql, array($type, $fecha));
            $prices = $rs->fetch();
            //print_r($prices);
            
            //capturamos los precios de transportacion a los diferentes grupos de parques
          
            ///////////////////////////////////////////////////////////////////////
            $price_adult_wdw =   $prices['priceadult_WDW'];
           
            
            $price_child_wdw =   $prices['pricechild_WDW'];
           
            
            ////////////////////////////////////////////////////////////////////////
            $price_adult_WATERP =   $prices['priceadult_WATERP'];
            
            
            $price_child_WATERP =   $prices['pricechild_WATERP'];
            
            
            
            ////////////////////////////////////////////////////////////////////
            $price_adult_KENNEDYSPC =   $prices['priceadult_KENNEDYSPC'];
           
            
            
            $price_child_KENNEDYSPC =   $prices['pricechild_KENNEDYSPC'];
//            
            
//            echo $price_adult_wdw;      
//            echo $price_child_wdw;
//            
//            echo $price_adult_WATERP;      
//            echo $price_child_WATERP;
//            
//            echo $price_adult_KENNEDYSPC;      
//            echo $price_child_KENNEDYSPC;
            
            ?>

          
        <!--        <fieldset id="inputype" style="width:97%; height:70%;background-color: rgb(255, 255, 255);"><legend>ONE DAY TOUR TO:</legend>
                            <div id="opera" class="input">
                              <table align="center" cellspacing="10">
                                <tr valign="top">
                                    checked="checked" 
                                  <td height="24"><label>WDW/UNIVERSAL/SEA WORLD</label>
                                    <input type="radio" name="wdw" id="wdwus"  value="1" onClick="capturar()" /></td>
                                  <td><label>WATER PARKS & HOLY LAND</label>
                                    <input type="radio" name="wdw" id="wphol"  value="2" onClick="capturar()" /></td>
                                  <td><label>KENNEDY SPACE CENTER</label>
                                    <input type="radio"  name="wdw" id="kspc" value="3" onClick="capturar()" /></td>
                                  <div style="display:none" id="resultado"></div>
                                </tr>
                              </table>
                            </div>
                      </fieldset>  -->
        <!-- END TARIFAS A GRUPOS DE PARQUES -->
        <!-- date of tours -->
        <fieldset style="width: 97.3%;margin-top: 5px; border-radius: 10%;background-color:#DCDCDC;" class="gris3">
            <div id="date" align="center">
                <table width="90%" border="0">
                    <tr>
                        <td width="11%" height="29" align="right"><span style="width:100px;"><strong>DATE</strong></span></td>
                        <td width="4%" align="right"><a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0" style="padding-bottom: 0px;" /></a></td>
                        <td width="17%"><input name="fecha_salida" type="text"  id="fecha_salida" onchange="fecha_retorno(this.value);" size="10" maxlength="16" value="<?php
                            list($anio, $mes, $dia) = explode('-', $data['tour']->starting_date);
                            echo $mes . '-' . $dia . '-' . $anio;
                            ?>" autocomplete="off"  style="height: 22px;" /></td>
                        <td width="4%" align="right"><a href="" id="dataclick2" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0" style="padding-bottom: 0px;" /></a></td>
                        <td width="17%"><input name="fecha_retorno" type="text"  id="fecha_retorno" size="10" maxlength="16" value="<?php
                            list($anio, $mes, $dia) = explode('-', $data['tour']->ending_date);
                            echo $mes . '-' . $dia . '-' . $anio;
                            ?>" autocomplete="off"  style="height: 22px;" /></td>
                        <td width="9%"><strong>ADULT(S)</strong></td>
                        <td width="15%"><input style="font-size:16px" name="adult" id="adult" autocomplete="off" type="number" onclick="capturar();" value="<?php echo $data['tour']->adult ?>" max="16" min="1" ></td>
                        <td width="8%"><strong>CHILD(S)</strong></td>
                        <td width="29%"><input style="font-size:16px" name="child" id="child" autocomplete="off" type="number" onclick="capturar();" value="<?php echo $data['tour']->child ?>" max="15" min="0" ></td>
                    <input type="text" name="group_park" id="group_park" style="display:none;" size="2" maxlength="10" style="margin-left: 254px;" value="<?php echo $tour->group_park; ?>">
                    <input type="text" name="group_park1" id="group_park1" style="display:none;" size="2" maxlength="10" style="margin-left: 294px;" value="<?php echo $data['tour']->group_park ?>">
                    </tr>
                </table>
            </div>
        </fieldset>
        <!-- end date of tours -->
        <!-- TARIFAS A GRUPOS DE PARQUES -->

        <fieldset id="inputype" title="Seleccione una de estas opciones, para incluir el Costo de la Transportacion en el Proceso." style="margin-top:4px; margin-top: 4px; width:958px; height:70%; border-radius: 10%;"class="booking2"><legend style="border:1px solid #00C; background-color: #fff;">ONE DAY TOUR TO</legend>
            <div id="opera" class="input">
                <table align="center" cellspacing="10" style="margin-top: 27px;">
                    <tr valign="top">
                      <!-- <form id="form2" class="form" action="<?php echo $data['rootUrl'] ?>admin/onedaytour" target="_blank" method="POST" name="form2" > -->
                        <td style="width: 20%;">
                            <div> 
                            <label style="color:#33449C;"><b style="margin-left: 47px;">WDW/UNIVERSAL/SEA WORLD</b></label>
                            <input type="checkbox" style="display:none; width:20px; height:20px; margin-right: 46px; margin-top:2px;" name="chwdw" id="chwdw"  disabled="disabled" value="" />
                            </div>
                            
                            <input type="radio" name="wdw" id="wdwus" style="height: 20px; width: 20px; margin-right: 165px;"  value="1" onClick="capturar(); habilitar(1);"/>
                        </td>
                        <td style="width: 20%;">
                            <div> 
                            <label style="color:#33449C;"><b style="margin-left: 30px;">WATER PARKS & HOLY LAND</b></label>
                            <input type="checkbox" style="display:none; width:20px; height:20px; margin-right: 76px; margin-top:2px;" name="chphol" id="chwphol" disabled="disabled" value="" />
                            </div>
                            
                            <input type="radio" name="wdw" id="wphol" style="height: 20px; width: 20px; margin-right: 165px;"  value="2" onClick="capturar(); habilitar(2);" />
                        </td>
                        <td style="width: 20%;">
                                                        
                            <div> 
                            <label style="color:#33449C;"><b style="margin-left: 27px;">KENNEDY SPACE CENTER</b></label>
                            <input type="checkbox" style="display:none; width:20px; height:20px; margin-right: 103px; margin-top:2px;" name="chkspc" id="chkspc" disabled="disabled" value="" />
                            </div>
                            
                            <input type="radio"  name="wdw" id="kspc" style="height: 20px; width: 20px; margin-right: 165px;"   value="3" onClick="capturar(); habilitar(3);" />
                        </td>
                        <!--</form>-->
                    <div style="display:none;" id="resultado"></div>
                    <input type="text" style="display:none;" name="group_park2" id="group_park2" size="2" maxlength="10" style="margin-left: 284px;" value="">
                    
                    <div style="margin-left: 100%;margin-top: -35px;">
                        <input type="text" name="priceadults" id="priceadults"  size="10" maxlength="10" style="display:none; margin-left: 250px;" value="<?php echo $tour->t_price_adult; ?>"></div>
                    <div style="margin-left: 100%;margin-top: 15px;">
                        <input type="text" name="pricechilds" id="pricechilds"  size="10" maxlength="10" style="display:none; margin-left: 254px;" value="<?php echo $tour->t_price_child; ?>"></div>      
                    </tr>
                </table>

            </div>
        </fieldset>

        <!-- Transfer in-->
        <table width="100%" >
            <tr>
                <td colspan="" valign="top" >

                    <fieldset id="arrival" style="border-radius: 4%; width: 460px; margin-top: 4px; background-color: #33449C; color: #fff;border:1px solid #33449C;" class="cerati">
                        <div id="reserveprices" display="none">
                            <input type="hidden" readonly="readonly" name="pricexadult" id="pricexadult" value="<?php echo $data['pricexadult']; ?>">
                            <input type="hidden" readonly="readonly" name="pricexchild" id="pricexchild" value="<?php echo $data['pricexchild']; ?>">
                            
<!--                            <input type="" readonly="readonly" name="pricexadult1" id="pricexadult1" value="<?php echo $data['pricexadult1']; ?>">
                            <input type="" readonly="readonly" name="pricexchild1" id="pricexchild1" value="<?php echo $data['pricexchild1']; ?>">
                            
                            <input type="" readonly="readonly" name="pricexadult2" id="pricexadult2" value="<?php echo $data['pricexadult2']; ?>">
                            <input type="" readonly="readonly" name="pricexchild2" id="pricexchild2" value="<?php echo $data['pricexchild2']; ?>">-->
                            
                            
                        </div>
                        <input id="totalreserve" name="totalreserve" type="hidden" value=0 readonly="readonly">
                        <legend id="leg_transfer_in" style="border:1px solid #00C; background:#DCE6F2">
                            <!--<label for="opcion_transfer_in" style=" cursor:pointer; ">TRANSFER IN</label> </legend>-->
                            <label for="opcion_transfer_in" style="cursor:pointer; background-color: #fff;">TRANSFER IN</label></legend>
                        <div id="conte_arrival" style="height: 225px;" >
                            <table width="100%">
                                <tr>
                                    <td>
                                        <div id="type">
                                            <table width="100%">
                                                <tr>
                                                    <td><div class="label">ARRIVAL</div></td>
                                                    <td>

                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td title="Price of transport per person" style="width: 43%;">
                                                        <div id="t-total">
                                                            <div id="price_transport1pp" class="price">$ 0.00</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="arrival-content">
                                            <div id="transport1" class="group" align="left">

                                                <table width="100%"><tr>
                                                        <td>
                                                            <div id="div_from">
                                                                <div class="label">FROM</div>
                                                                <select style="width:190px" name="from" id="from" class="select">
                                                                    <option value="0"></option>
                                                                    <?php foreach ($data["to_areas"] as $e) { ?>
                                                                        <option value="<?php echo $e["id"]; ?>"><?php echo $e["nombre"]; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>

                                                            <div id="div_to" style="margin-left: 70px;">
                                                                <div class="label">TO</div>
                                                                <select style="width:190px" name="to" id="to" class="select">
                                                                    <option value="1">Orlando</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div id="trip">


                                                                <table><tr><td>
                                                                            <span>

                                                                            </span></td>
                                                                        <td>
                                                                        </td></tr></table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="100%" colspan="3">
                                                            <div id="pick-drop" style="margin-top: 7px;">
                                                                <div class="label">PICK UP POINT/ADDRESS</div>
                                                                <div  style="width:100%" class="ausu-suggest">
                                                                    <input name="a_pickup1" style="width:447px;" class="field" type="text" id="a_pickup1" autocomplete="off" maxlength="55" value="<?php
                                                                    if (isset($data['pickup']->id) && $data['pickup']->id != 0) {
                                                                        echo $data['pickup']->place . ' ' . $data['pickup']->address;
                                                                    } else {
                                                                        echo '" disabled="disabled';
                                                                    }
                                                                    ?>"/>
                                                                    <input name="a_id_pickup1" type="hidden" id="a_id_pickup1" maxlength="55" value="<?php
                                                                    if (isset($data['pickup']->id)) {
                                                                        echo $data['pickup']->id;
                                                                    } else {
                                                                        echo '-1';
                                                                    }
                                                                    ?>"/>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <table width="100%">
                                                                <tr>
                                                                    <td width="25%">
                                                                        EXTENSION AREA: </td>
                                                                    <td>
                                                                        <select name="ext_from1" id="ext_from1" class="select" style="width:200px;margin-top: 13px;"></select>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td width="15%">
                                                                        <div id="rooms">
                                                                            <div class="label">LUGGAGE</div>
                                                                            <span><input name="a_luggage" type="text" id="a_luggage" size="2" maxlength="2" value="<?php echo $data["res"]->luggage1; ?>"
                                                                                         class="field"/></span>
                                                                        </div>
                                                                    </td>
                                                                    <td width="15%">
                                                                        <div id="rooms" style="margin-left: 14px;">
                                                                            <div class="label">ROOM #</div>
                                                                            <span><input name="a_room1" type="text" id="a_room1" size="4" maxlength="6" value="<?php echo $data["res"]->room1; ?>"
                                                                                         class="field"/></span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <div style="width:100%;" id="ex_pick_drop">
                                                                <div class="label" >EXTENTION PICK UP POINT/ADDRESS</div>
                                                                <div style="width:100%" class="ausu-suggest">
                                                                    <input name="a_pickup2" style="width:447px; margin-top:7px;" disabled="disabled"  class="field" type="text" id="a_pickup2" maxlength="55" autocomplete="off" value=""/>
                                                                    <div style="display:none" id="extcost">
                                                                        <input id="cost_ext" type="hidden" readonly="readonly" value="<?php
                                                                        if (isset($data['ext1']->id)) {
                                                                            echo $data['ext1']->precio_neto;
                                                                        }
                                                                        ?>">
                                                                    </div>
                                                                    <input name="a_id_pickup2" type="hidden" id="a_id_pickup2" maxlength="55" value="<?php if (isset($data['ext1']->id)) echo $data['ext1']->id ?>"/>                                              </span></div>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </fieldset>
                </td>
                <td><fieldset id="departure" style=" border-radius: 4%; margin-top: 4px; width: 460px;background-color: #AC1B29; border: #AC1B29 solid thin; color: #fff;" class="rojo">
                        <div id="reserveprices">
                        </div>
                        <input id="totalreserver" name="totalreserver" type="hidden" value=0 readonly="readonly">
                        <legend id="leg_transfer_in" style="background-color: #fff; border: #B83A36 solid thin; color:#B83A36;">
                            <label for="opcion_transfer_in" style=" cursor:pointer; ">TRANSFER OUT</label> </legend>
                        <div id="conte_arrival" style="height: 225px;" >
                            <table width="100%">
                                <tr>
                                    <td>
                                        <div id="type">
                                            <table width="100%">
                                                <tr>
                                                    <td><div class="label">DEPARTURE</div></td>
                                                    <td></td>
                                                    <td>&nbsp;</td>
                                                    <td title="Price of transport per person"style="width: 43%;">
                                                        <div id="t-total">
                                                            <div id="price_transport2pp" class="price">$ 0.00</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="arrival-content">
                                            <div id="transport1" class="group" align="left">
                                                <table width="100%">
                                                    <tr>
                                                        <td>
                                                            <div id="div_from2">
                                                                <div class="label">FROM</div>
                                                                <select style="width:190px" name="from2" id="to" class="select">
                                                                    <option value="1">Orlando</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div id="div_to2" style="margin-left: 69px;">
                                                                <div class="label">TO</div>
                                                                <select style="width:190px" name="to2" id="to2" class="select">
                                                                    <option value="0"></option>
                                                                    <?php foreach ($data["to_areas"] as $e) { ?>
                                                                        <option value="<?php echo $e["id"]; ?>"><?php echo $e["nombre"]; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="100%" colspan="3">
                                                            <div id="pick-drop2">
                                                                <div class="label">DROP OFF POINT/ADDRESS</div>
                                                                <div  style="width:100%" class="ausu-suggest">
                                                                    <input name="d_pickup1" style="width:447px; margin-top:7px;" disabled="disabled" class="field" type="text" id="d_pickup1" autocomplete="off" maxlength="55" value="<?php echo $data['dropoff']->place . ' ' . $data['dropoff']->address; ?>"/>
                                                                    <input name="d_id_pickup1" type="hidden" id="d_id_pickup1" maxlength="55" value="<?php echo $data['dropoff']->id ?>"/>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <table width="100%">
                                                                <tr>
                                                                    <td width="25%">
                                                                        EXTENSION AREA: </td>
                                                                    <td>
                                                                        <select name="ext_to2" id="ext_to2" class="select" style="width:200px; margin-top: 11px;"></select>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td width="15%">
                                                                        <div id="rooms">
                                                                            <div class="label">LUGGAGE</div>
                                                                            <span>
                                                                                <input name="d_luggage" type="text" id="d_luggage" size="2" maxlength="2" value="<?php echo $data["res"]->luggage1; ?>" class="field"/>
                                                                            </span>
                                                                        </div>
                                                                    </td>
                                                                    <td width="15%">
                                                                        <div id="rooms" style="margin-left: 15px;">
                                                                            <div class="label">ROOM #</div>
                                                                            <span>
                                                                                <input name="d_room1" type="text" id="d_room1" size="4" maxlength="6" value="<?php echo $data["res"]->room2; ?>" class="field" />
                                                                            </span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <div style="width:100%; margin-top: 8px;" id="ex_pick_drop2">
                                                                <div class="label">EXTENTION DROP OFF POINT/ADDRESS</div>
                                                                <div style="width:100%" class="ausu-suggest">
                                                                    <input name="d_pickup2" style="width:447px;" disabled="disabled"  class="field" type="text" id="d_pickup2" maxlength="55" autocomplete="off" value=""/>
                                                                    <div style="display:none" id="extcost2">
                                                                        <input id="cost_ext2" type="hidden" readonly="readonly" value="<?php
                                                                        if (isset($data['ext2']->id)) {
                                                                            echo $data['ext2']->precio_neto;
                                                                        }
                                                                        ?>">
                                                                    </div>
                                                                    <input name="d_id_pickup2" type="hidden" id="d_id_pickup2" maxlength="55" value="<?php if (isset($data['ext2']->id)) echo $data['ext2']->id ?>"/></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </fieldset>
                </td>
                <td>&nbsp;</td>
            </tr>

            <!-- End Transfer in-->
            <!-- Transfer out -->
            <tr >
            <tr>
                <td colspan="" valign="top" >
                    <div id="itinerary" style="width: 479px;margin-left: 6px;height: 130px; background-color: #F6F6F6;">
                        <h3 style="padding-left:15px; font-family:'arial'; color:#33449C;">TRIP SCHEDULE.</h3>
                        <div id="schedule1" style=" margin: -30px 4px 0px 4px">
                            <br>
                            <br>
                            <div align="center">
                                <table width="100%" class="table2 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10%">Trip</th>
                                            <th width="25%">Departure</th>
                                            <th width="25%">Arrive</th>
                                            <th width="30%">Equipment</th>
                                        </tr>
                                    </thead>  <tbody><tr class="">	<td width="10%"><?php echo $data['res']->trip_no ?>
                                                <input type="hidden" name="trip1" id="trip1" value="301" class="trip1">
                                                <input name="sarrival" type="hidden" value="1">
                                            </td>
                                            <td><?php echo date('h:i A', strtotime($data['res']->deptime1)); ?></td>
                                            <td><?php echo date('h:i A', strtotime($data['res']->arrtime1)); ?></td>
                                            <td width="30%">BUS</td>
                                        </tr> </tbody></table>
                                <b style="color:#F00"></b>
                                <input type="hidden" value="<?php echo $data['res']->deptime1; ?>" id="deptime1" name="deptime1">
                                <input type="hidden" value="<?php echo $data['res']->arrtime1; ?>" id="arrtime1" name="arrtime1">
                            </div>
                        </div>

                    </div>
                </td>
                <td>
                    <div id="itinerary" style="width: 478px;height: 130px;margin-left:5px;">
                        <h3 style="padding-left:15px; font-family:'arial'; color:#AC1B29;">TRIP SCHEDULE.</h3>
                        <div id="schedule2" style=" margin: -30px 4px 0px 4px">
                            <br>
                            <br>
                            <div align="center">
                                <table width="100%" class="table2 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10%">Trip</th>
                                            <th width="25%">Departure</th>
                                            <th width="25%">Arrive</th>
                                            <th width="30%">Equipment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="">
                                            <td width="10%"><?php echo $data['res']->trip_no2 ?>
                                                <input type="hidden" name="trip1" id="trip1" value="301" class="trip1">
                                                <input name="sarrival" type="hidden" value="1">
                                            </td>
                                            <td><?php echo date('h:i A', strtotime($data['res']->deptime2)) ?></td>
                                            <td><?php echo date('h:i A', strtotime($data['res']->arrtime2)) ?></td>
                                            <td width="30%">BUS</td>
                                        </tr> </tbody>
                                </table>
                                <b style="color:#F00"></b>
                                <input type="hidden" value="<?php echo $data['res']->deptime2; ?>" id="deptime2" name="deptime2">
                                <input type="hidden" value="<?php echo $data['res']->arrtime2; ?>" id="arrtime2" name="arrtime2">
                            </div>
                        </div>
                    </div>
                </td>
                <td>&nbsp;</td>

            </tr>
            </tr>
            <!-- End Transfer out -->

        </table>

        <!-- Parks -->
        <div id="traffic" style="">
            <fieldset style="color: #fff; border-radius: 5%; margin-top: 8px;" class="verdefosf">
                <legend style="background-color:#fff;/*border: 1px solid #CCCCCC;*/">
                    <!--<fieldset>
                        <legend style="background-color:#F6F6F6;border: 1px solid #CCCCCC;">-->
                    <div id="chk_traffic">


                        <label for="opcion_traffic" style=" cursor:pointer; border:1px solid #00C; " >TRAFFIC TOURS  </label>
                    </div>
                </legend>
                <input type="hidden" readonly="readonly" id="total_parks" value=<?php echo $data['attr']->total_paid; ?> >
                <input type="hidden" readonly="readonly" id="total_sumplemento" value=<?php echo $data['total_suplemento']; ?> >
                <div id="attractions">
                    <table width="100%">
                        <tr>
                            <td>
                                <table width="100%">
                                    <tr>
                                        <td valign="bottom">
                                            <div id="category-selection">
                                                <input type="hidden" value=1 id="nparks" />
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <div class="label" style="color: black;"><strong>CATEGORY</strong></div>
                                                        </td>
                                                        <td valign="bottom">
                                                            <div class="label" style="color: black;"><strong>SEARCH PARK</strong></div>
                                                        </td>
                                                        <td colspan="">

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="bottom">
                                                            <select name="categoria_park" id="categoria_park" class="select">

<!--<option value="0"> <p style="display: none;">.</p></option>-->
                                                                <option value="4" style="color: black; font-size: 15px;">WALT DISNEY WORLD</option>
                                                                <option value="5" style="color: black;font-size: 15px; ">SEA WORLD</option>
                                                                <option value="6" style="color: black;font-size: 15px;">UNIVERSAL PARKS</option>
                                                                <option value="7" style="color: black;font-size: 15px;">WATER PARKS</option>
                                                                <option value="8" style="color: black;font-size: 15px;">HISTORIC PARKS</option>
<!--                                                                <option value="9">FULL DAY SHOPPING TOURS</option>-->
                                                                <option value="11" style="color: black;font-size: 15px;">KENNEDY SPACE CENTER</option>
                                                                <option value="12" style="color: black;font-size: 15px;">HOLY LAND</option>

                                                            </select>
                                                        </td>
                                                        <td valign="bottom">
                                                            <div  style="width:100%" class="ausu-suggest">
                                                                <input style="width:300px;" class="field" id="park_name" type="text" autocomplete="off" value="<?php // echo $data['park']->nombre         ?>" />
                                                                <input type="hidden" name="id_park" id="id_park" value="<?php // echo $data['park']->id         ?>"/>
                                                                <input type="hidden" name="numPark" id="numPark" value="1"/>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <table class="fields2">
                                                                <tr></tr>
                                                                <tr>
                                                                    <td>
                                                                    </td>
                                                                    <td>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td valign="bottom"><input type="button" id="add_attraction_list" style="height:30px; color:#33449C;" value="Add to list"/>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <table width="100%">
                                                <tr>
                                                    <td width="80%">
                                                        <div id="tablePark">
                                                            <table class="grid2" cellspacing="0" cellpadding="0" id="table_7" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>NAME</th>
                                                                        <th>GROUP</th>
                                                                        <th>TICKET</th>
                                                                        <th>TRANSFER</th>
                                                                        <th>ADMISSION</th>
                                                                        <th>TRANSPORT</th>
                                                                        <th>DELETE</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr id="park-selected" class="row1">
                                                                        <td><?php echo $data['park']->nombre ?></td>
                                                                        <td><?php echo $data['grupo']->nombre ?></td>
                                                                        <td><img <?php echo $data['especial'] != 1 ? 'id="include_ticket"' : ""; ?> src="<?php echo $data['rootUrl'] ?>global/img/admin/<?php
                                                                            if ($data['tour']->include_park) {
                                                                                echo 'check2';
                                                                            } else {
                                                                                echo 'x02';
                                                                            }
                                                                            ?>.png"  <?php echo $data['especial'] != 1 ? 'style="cursor:pointer;"' : ""; ?> width="20" height="20">
                                                                            <input type="checkbox" style="display:none" id="adm_selector" name="include_park" <?php
                                                                            if ($data['tour']->include_park) {
                                                                                echo 'checked="checked"';
                                                                            }
                                                                            ?>>
                                                                        </td>
                                                                        <td><img src="<?php echo $data['rootUrl']; ?>global/img/admin/check2.png" style="cursor:pointer;" width="20" height="20"></td><td>$ <?php echo $data['attr']->totalAdmission; ?>.00</td><td>$ <?php
                                                                            if ($data['park']->id == 19) {
                                                                                echo '5';
                                                                            }
                                                                            ?>0.00</td><td><img id="delete_park" style="cursor:pointer;" width="20" height="20" src="<?php echo $data['rootUrl']; ?>global/img/admin/x01.png"></td>
                                                                <input type="hidden" id="admpark"  value="<?php echo $data['attr']->totalAdmission; ?>"> <input type="hidden" name="trpark" id="trpark" value="<?php
                                                                if ($data['park']->id == 19) {
                                                                    echo '5';
                                                                }
                                                                ?>0"><input type="hidden" id="id_selected_park" name="id_selected_park" readonly="readonly" value="<?php echo $data['park']->id ?>">
                                                                <input type="hidden" id="gid" name="gid" value="<?php echo $data['grupo']->id; ?>">
                                                                <input type="hidden" id="rate_adults" name="rate_adults" value="<?php echo $data['tpricexadult']; ?>">
                                                                <input type="hidden" id="rate_childs" name="rate_childs" value="<?php echo $data['tpricexchild']; ?>">                                                       
                                                                <input type="hidden" id="suplemento_adults" name="suplemento_adults" value="<?php echo $data['tpricexadult_suple']; ?>">                                                       
                                                                <input type="hidden" id="suplemento_childs" name="suplemento_childs" value="<?php echo $data['tpricexchild_suple']; ?>">                                                       
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width:170px;" valign="bottom">
                                <div id="t-total">
                                    <div class="label" style="color: black;" ><strong>PRICE PER PERSON OF TRANSPORT LOCAL</strong></div>
                                    <div id="park_transport" class="price">$<?php echo $data['sumplemento']; ?></div>
                                    <div class="label" style="color: black;" ><strong>PRICE PER PERSON OF TICKET</strong></div>
                                    <div id="park_admision" class="price">$<?php echo $data['entrada']; ?>.00</div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

            </fieldset>
        </div>
        <br />
        <!-- <fieldset>
             <legend style="background-color:#F6F6F6;border: 1px solid #CCCCCC;"><div id="chk_traffic">
                     <div class="label">COSTO SUMMARY</div></div></legend>-->

        <fieldset style="border-radius: 5%; margin-top: -6px; height:375px;" class="azul2017">
            <legend style="background-color:#fff; border: 1px solid #00C;"><div id="chk_traffic">
                    <div class="label">COSTO SUMMARY</div></div></legend>
            <table><tr>
                    <td width="70%">
                        <div id="opera" class="input" style="padding-top:0px; width:450px;">
                            <table width="100%" id="tr_complementary" style="display: none;">
                                <tr>
                                    <td width="2%">
                                        <input name="opcion_pago" id="opcion_pago_complementary" value="7"  type="radio">
                                    </td>
                                    <td width="20%">
                                        <label for="opcion_pago_complementary">Complementary</label>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" height="125" id="tableorder" style="margin-top: 5px; display: none;">
                                <tr>
                                    <td  colspan="3" width="34%" height="20" align="center"  >
                                        <input type="hidden" name="opcion_pago_saldo" id="opcion_pago_saldo" value="1" />
                                        <table width="100%" align="center" id="tableTypeSaldo" style="display:none;">
                                            <tr>
                                                <td colspan="6"   height="20" id="titlett" align="center"  >
                                                    <strong>PAYMENT OPTION</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td width="2%">
                                                    <input name="opcion_saldo" id="opcion_saldo1" value="1" checked="checked" type="radio">
                                                </td>
                                                <td width="20%">Paid Full</td>
                                                <td width="2%"><input name="opcion_saldo" id="opcion_saldo2" value="2" type="radio"></td>
                                                <td width="20%">Paid Balance</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr><td colspan="6"><hr /></td></tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td  height="35" id="titlett" align="left"  ><strong>PRED-PAID</strong></td>
                                    <td  width="34%" height="35" id="titlett" align="left" ><strong>COLLECT ON BOARD</strong></td>
                                    <td  width="34%" height="35" id="titlett" align="left" ><strong>VOUCHER</strong></td>
                                </tr>
                                <tr>
                                    <td valign="top" style="width:160px;"  >
                                        <table width="100%">
                                            <tr>
                                                <td colspan="2"></td>
                                            </tr>
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
                                            <tr>
                                                <td colspan="2"></td>
                                            </tr>
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
                                            <input name="opcion_pago" id="opcion_pago_Voucher" value="5" type="radio" class="opcion_pago"><label id="label_tipo_Cash" for="opcion_pago_Voucher" class="opcion_pago">Credit Voucher</label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <table><tr><td>
                                    <table>
                                        <tr>
                                            <td valign="" >
                                                <div id="t-total2" style="margin-left:64px;">
                                                    <div class="label"><strong>Tour Cost</strong></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div id="t-total2" style="width:168px;">
                                                    <div class="price">
                                                        <samp  id="totalAmount">$ 0.00</samp>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span style="margin-left:50px;"><strong> Disc %</strong></span>
                                                <input name="descuento" type="number" id="descuento" maxlength="3" class="txtNumbers" onkeyup="" max="100" min="0"  value="<?php echo $data['tour']->descuento_procentaje ?>"  style="height:16px; width:75px;" />
                                            </td>

                                        </tr>
                                        <tr>
                                            <td><label style="margin-left:66px;font-weight:bold;">Extra Charges</label></td>
                                            <td colspan="">
                                                <input class="txtNumbers" name="extra" type="text" id="extra" size="12" style=" padding-left:5px; width:160px; height:20px;" min="0"   value="<?php echo $data['tour']->extra_charge; ?>" autocomplete="off" />
                                            </td>
                                            <td>
                                                <label style="margin-left:50px;"><strong> Disc &nbsp;$</strong></label>
                                                <input name="descuento_valor" type="number" class="txtNumbers" id="descuento_valor" size="12" maxlength="10" pattern="6[0-9]" style="height:16px; width:75px;" value="<?php echo $data['tour']->descuento_valor ?>"  />
                                            </td>
                                        </tr>
                                        <tr >
                                            <td valign="" style="display:none">
                                                <div style="display:none" id="div_tex_comision">
                                                    <div class="label">Comision</div>
                                                </div>
                                            </td>
                                            <td style="display:none">
                                                <div id="div_val_comision" style="display:none; width:170px;">
                                                    <samp  id="valorComision">$ 0.00</samp>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="" >
                                                <label style="margin-left:64px;font-weight:bold;">Other Amount</label>
                                            </td>
                                            <td>
                                                <div id="t-total2" style="width:170px;">
                                                    <input autocomplete="off" type="text" class="txtNumbers"  name="otheramount" id="otheramount" value="<?php echo $data['tour']->otheramount_sin_tax; ?>"  style="padding-left:5px; width:160px; height:20px;" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div id="t-total2">
                                                    <div class="label" style="width:150px; color:#F00;" ><strong><label class="label"  id="txtSaldoPorPagar" style="font-weight:bold; margin-left:1px;">ACTUAL AMOUNT</label></strong></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div id="div_pagado" class="t-total3" style="width:168px;">
                                                    <div class="price">
                                                        <samp  id="saldoporpagar">$ 0.00</samp></div>
                                                </div>
                                                <br />
                                        </tr>

                                        <?php /* if( isset($data['prepaid'])) { */ ?>
                                        <tr>
                                            <td>
                                                <div id="t-total3" >
                                                    <div class="label" style="width:150px; color:#00A500;" ><strong><label class="label"  id="txtSaldoprepaid" style="font-weight:bold;  margin-left:37px;">PREPAID AMOUNT</label></strong></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div id="div_actual" class='t-total3'>
                                                    <div class="price" style="border:1px #AC1B29 solid; background-color:#00A500; color:#fff;">
                                                        <samp  id="saldoprepaid">$<?php echo $data['pagado'] ?></samp>
                                                    </div>
                                                    <input type="hidden" value="<?php echo $data['pagado'] ?>" id="prepaid-amount">
                                                </div>
                                            </td>
                                        </tr> <?php /* } */ ?>
                                        <tr style="background-color:#DCDCDC;">
                                            <td>
                                                <div id="t-total3">
                                                    <div class="label" style="width:150px; color:#00F;"><strong><label class="label" id="txtSaldoDiff" style="font-weight:bold;  margin-left:85px; ">Pay Driver</label></strong></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div id="div_actual" class="t-total3">
                                                    <div class="price" style="border:1px #33F solid; background-color:#00f; color:#fff;">
                                                        <samp id="saldoactual">$0.00</samp>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <select name="opcion_pago" id="op_pago_id" style="margin-left:15px;">
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
                                            </td>
                                        </tr>
                                        <tr id="pay_amount_html">
                                            <td valign="" >
                                                <a  id="pago_agente" style="display:block" ><img style="width: 59px;   margin-left: -3px;  margin-top: 12px;cursor:pointer" src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" />
                                                    <label style="text-align:left; font-weight:bold;   position: absolute;   margin-top: 19px;    margin-left: 9px;">Pay a Amount</label>
                                                </a>

                                            </td>
                                            <td>
                                                <div id="t-total2" style="width:170px;">
                                                    <input autocomplete="off" type="text" class="txtNumbers"  name="pay_amount" id="pay_amount" value=""  style="padding-left:5px; width:160px; height:20px;" />
                                                </div>
                                            </td>
                                            <td>
                                                <select name="opcion_pago_2" style="margin-left:15px;">
                                                    <optgroup label="PRED-PAID">
                                                        <option value="2">Credit Card no fee</option>
                                                        <option value="1">Credit Card with fee</option>
                                                        <option value="6">Cash</option>
                                                        <option value="10">Check</option>
                                                    </optgroup>
                                                    <optgroup label="COLLECT ON BOARD">
                                                        <option value="8">Credit Card no fee</option>
                                                        <option value="3">Credit Card with fee</option>
                                                        <option value="4">Cash</option>
                                                        <option value="9">Check</option>
                                                    </optgroup>     
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <tr>
                                            <td align="right">
<!--                                                &nbsp;<a style="cursor:pointer;margin-left:-18px;" margin-left:60px; id="btn-save2"><img width="50" height="40" src="<?php echo $data['rootUrl']; ?>global/img/admin/save2.png" /></a>-->
                                                <a title="Save" style="margin-top: 16px; margin-right: -44px; cursor:pointer" id="btn-save2"><i class="fa fa-floppy-o fa-4x" style="color: #AC1B29;"></i></a>
                                                
                                            </td>
                                            <td align="right">
                                                                                               
<!--                                                <a href="<?php echo $data['rootUrl']?>admin/home" title="Exit" style="margin-top: 16px; margin-right: 4px; cursor:pointer" id="btn-exit"><i class="fa fa-external-link-square fa-4x" style="color:#AC1B29;"></i></a>  -->
                                                
                                            </td>
                                            <td align="right">
                                                &nbsp;<a style="cursor:pointer;margin-left:-18px; display: none;"  id="btn-save1"><img width="50" height="40" src="<?php echo $data['rootUrl']; ?>global/img/admin/save2.png" /></a>
                                            </td>
                                        <a id="enviarF" style="display: none;"><img src="<?php echo $data['rootUrl'] ?>/global/img/admin/charge.png"></a>
                        </table>
                    </td>
                    <td valign="bottom">
                        <!--                        <div id="is_cardholder" style="">
                                                    <label for="is_user_ch">Is the user the cardholder?</label><input type="checkbox" id="is_user_ch" checked="">
                                                </div>-->
                        <table width="100%">
                            <tr>

                            </tr>
                            <tr>

                            <tr>
                            <tr>
                                <td align="right">
                                    <div id="opera" class="enviarForm" style="padding-top:5px; cursor:pointer;" align="left">
                                        <a id="enviarF" style="display:none; cursor:pointer" ><img src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>
                                    </div>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr></table>
            </td>
         
            
            <td style="width:300px;" align="left" >
              
                <textarea id="comments" name="comments" cols="0" rows="0" placeholder="Notes"  style="width: 339px; height: 100px; margin-top:3px;"></textarea>
                <textarea id="comments2" name="comments2" cols="0" rows="0"  disabled="disabled" style="width: 339px; height: 226px; margin-top:15px;"><?php echo $data['tour']->comments2; ?></textarea>
                <!--</div>-->
            </td>
            </tr>

            <tr><!-- Detalles -->
            <input type="hidden" value="0" type="number" readonly="readonly" name="total_first" id="total_first">
            <input type="hidden" value="0" type="number" readonly="readonly" name="total_total" id="total_total">
            <td colspan="2">

                <div id="estadoTranssacion">
                </div>
            </td>
            <td>&nbsp;</td>
            <td>
                <div id="estadoTranssacion">
                </div>
            </td>
            </tr>
            </table>

        </fieldset>

        <div id="userr"></div>


        <div id="mascaraP" style="display:none;"></div>
        <div id="clienteN" style="display:none;">


            <div id="header_page">
                <div class="header2">Customer</div>
<!--                <div id="toolbar">

                    <div class="toolbar-list">
                        <ul>
                            <li class="btn-toolbar" id="icon-back">
                                <a class="link-button">
                                    <span class="icon-back" title="Editar">&nbsp;</span>
                                    Cancel
                                </a>
                            </li>
                            <li class="btn-toolbar" id="icon-save">
                                <a class="link-button">
                                    <span class="icon-32-save" title="Guardar">&nbsp;</span>
                                    Save
                                </a>
                            </li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>-->
            </div>

            <div id="content_page">

                <div id="serpare">
                    <fieldset><legend>Information</legend>

                        <div class="input">
                            <label style="width:150px" class="required" id="l_trip_no"></label>
                            <label for="cardholder" title="Disable this option if the client is not the cardholder">CARDHOLDER  </label>
                            <input type="checkbox" checked="checked" id="cardholder" name="cardholder" value="1">
                        </div>
                        <div id="div_form">

                            <div class="input">
                                <label style="width:150px" class="required" id="l_username">Username / E-mail*</label>
                                <input type="text" name="username" id="username" size="25" maxlength="40" value="">
                            </div>
                            <div class="input">
                                <label style="width:150px" class="required" id="l_firstname">Firts Name*</label>
                                <input type="text" name="firstname" id="firstname" size="25" maxlength="30" value="">
                            </div>

                            <div class="input">
                                <label style="width:150px" class="required" id="l_lastname">Last Name*</label>
                                <input name="lastname" type="text" id="lastname" size="25" maxlength="30" value="">
                            </div>

                            <div class="input">
                                <label style="width:150px" class="required" id="l_phone">Phone</label>
                                <input name="phone" type="text" id="phone" size="20" maxlength="20" value="">
                            </div>

                            <div class="input">
                                <label style="width:150px" class="required" id="l_country">Country</label>
                                <select name="country" id="country" class="select">
                                    <option value=""></option>
                                    <?php foreach ($data['countries'] as $country) { ?>
                                        <option value="<?php echo $country['name'] ?>"><?php echo $country['name'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                            <div class="input">
                                <label style="width:150px" class="required" id="l_state">State</label>
                                <select name="state" id="state" class="select">
                                    <option value=""></option>
                                    <?php foreach ($data['states'] as $state) { ?>
                                        <option value="<?php echo $state['name'] ?>"><?php echo $state['name'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                            <div class="input">
                                <label style="width:150px" class="required" id="l_city">City</label>
                                <input name="city" type="text" id="city" size="25" maxlength="25" value="">
                            </div>


                            <div class="input">
                                <label style="width:150px" class="required" id="l_address">Address</label>
                                <input name="address" type="text" id="address" size="25" maxlength="60" value="">
                            </div>
                            <div class="input">
                                <label style="width:150px" class="required" id="l_zip">Zip code</label>
                                <input name="zip" type="text" id="zip" size="25" maxlength="25" value="">
                            </div>
                            <input name="id" type="hidden" id="id" value="">
                        </div>
                        <input name="frm" type="hidden" id="frm" value="1">
                        <input name="cliente_pagador" type="hidden" id="cliente_pagador" value="1">
                    </fieldset>
                </div>


            </div>
        </div>
        <div id="dialog" title="History of changes of the reserve" style="display:none;">
            <div style="overflow-y: scroll;height:250px;">
                <table class="grid2" cellspacing="1" id="grid2">
                    <thead>
                        <tr>
                            <td>Action</td>
                            <td>User</td>
                            <td>Date</td>
                            <td>&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['rastros'] as $rr) { ?>
                            <tr class="row1">
                                <td><?php echo $rr['tipo_cambio']; ?></td>
                                <td><?php echo $rr['usuario']; ?></td>
                                <td><?php echo date('M-d-Y', strtotime($rr['fecha'])); ?></td>
                                <td onclick="detalles_rastro('<?php echo $rr['id'] ?>');"><img src="<?php echo $data['rootUrl'] ?>global/img/admin/info.png" width="24" height="24" title="Details of change" /></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="dialog-message" title="Details of change">
            <div id="conten_rastro">
            </div>
        </div>

        <div id="infodb"></div>
        <div id="rastrocomi">
            <input id="rastrocom" type="hidden" name="rastrocom" value="<?php
            if (isset($data['ta']->id)) {
                echo ($data['ta']->type_rate == 0) ? $data['ta']->agency_fee : 0;
            }
            ?>" readonly="readonly"/>
        </div>
        <div id ="diff">
            <input type ="hidden" id="actual-amount" value=<?php echo $data['actual_amount']; ?>>
            <input type ="hidden" id="actual_diff" name="actual_diff" value=0>
            <input type ='hidden' id='reserve_id' name='actual_reserve' value='<?php echo $data['res']->id ?>'>
            <input type ='hidden' id='especial_price' name='especial_price' value='<?php echo $data['especial']; ?>'>

        </div>
        <div>
        <input type="text" style="width:30px; display:none;" name="fromt" id="fromt" size="25" maxlength="40" value=''>
        <input type="text" style="width:30px; display:none;" name="tot1" id="tot1" size="25" maxlength="40" value=''>
        </div>
        
        <div>
        <input type="text" style="width:30px; display:none;" name="fromt2" id="fromt2" size="25" maxlength="40" value=''>
        <input type="text" style="width:30px; display:none;" name="tot2" id="tot2" size="25" maxlength="40" value=''>
        </div>
        
        
        <div>
        <input type="text" style="width:350px; display:none;" name="pickup" id="pickup" size="25" maxlength="40" value='<?php echo $data['pickup']->place . ' ' . $data['pickup']->address; ?>'>
        <input type="text" style="width:350px; display:none;" name="dropoff" id="dropoff" size="25" maxlength="40" value='<?php echo $data['dropoff']->place . ' ' . $data['dropoff']->address; ?>'>
        </div>
        
    </form>
</div>
<!--second scripting part-->
<div id="initialscript">
    <?php echo $data['scripts'] ?>
</div>
<div id="debug"></div>
<script>
    $("#pago_agente").click(function () {

        var cantidad = $("#pay_amount").val();
        if (cantidad <= 0) {
            return false;
        }
        var email1 = $("#email1").val();
        var primer_n = $("#firstname1").val();
        var segundo_n = $("#lastname1").val();
        var phone1 = $("#phone1").val();
        if (segundo_n === '.') {
            segundo_n = ' ';
        }
        var url = ('<?php echo $data['rootUrl'] ?>admin/pago/agente/' + cantidad + '/' + email1 + '/' + primer_n + '/' + segundo_n + '/' + phone1 + '/' + '<?php echo $data['tour']->code_conf; ?>');
        window.open(url, '_blank');
        return false;
    });
//        $("#idreserva1").click(function (){
//            var url2 = ('<? echo $data['rootUrl'] ?>admin/resumen/oneday_tour/'+'<? echo $data['tour']->id; ?>');
//            window.open(url2, '_blank');
//            return false;
//        });

//        $("#idreserva1").click(function(){
//            
//            var url2 =('<? echo $data['rootUrl'] ?>/admin/resumen/oneday_tour/' +'<? echo $data['tour']->code_conf; ?>');
//              window.open(url2, '_blank');
//            return false;
//        });
    $(window).load(function () {    
        //alert("Se cargo");  
//        var answer = confirm("Desea Crear una Nueva Reserva [Oneday Tour]?");
//      
//        if (answer){
//               window.location = '<?php /*echo $data['rootUrl']*/?>admin/onedaytour/add';  
//                exit;
//            }    
//        document.getElementById("chwdw").checked = false;
//        document.getElementById("chwphol").checked = false;
//        document.getElementById("chkspc").checked = false;
//        
       
        
                
        document.getElementById('fromt').value = document.getElementById('from').value
        document.getElementById('tot1').value = document.getElementById('to').value
        
        
        document.getElementById('fromt2').value = document.getElementById('to').value
        document.getElementById('tot2').value = document.getElementById('to2').value
//       
        $("#content").css("opacity", "1");
        var sel_payment = '<?php echo $reserva->op_pago; ?>';
        $("#op_pago_id option[value=" + sel_payment + "]").attr("selected", "selected");
        calcularTotalPago();

        document.getElementById('group_park').value = document.getElementById('group_park1').value;
        
         
        var gp = group_park1.value;
        var gp = document.getElementById('group_park1').value;
        
        
       
        //carga de parques
         
        if (gp == 1) {          
            
            document.getElementById("wdwus").checked = false;
            
            
            setTimeout(function () {

           
                $('#wdwus').click();
            
            

            }, 100);
                   
 
        }

        if (gp == 2) {
            
            document.getElementById("wphol").checked = false;
            
            setTimeout(function () {

           
                $('#wphol').click();
                

            }, 100);

            
            
        }

        if (gp == 3) {
            
            document.getElementById("kspc").checked = false;         
                        
            setTimeout(function () {

                $('#kspc').click();

            }, 100);                      

           
           
        }      
          
        group_park2.value = group_park1.value; 
        document.getElementById('group_park2').value = gp;

    });
    
    $("#op_pago_id").change(function () {
        calcularTotalPago();
    });
    $(function () {
        $("#btn-save1").hide();
    });
    $.fn.autosugguest({
        className: 'ausu-suggest',
        methodType: 'POST',
        minChars: 1,
        rtnIDs: true,
        dataFile: '<?php echo $data["rootUrl"]; ?>admin/onetours/loaddatos'
    });


    (function () {
                $.datepicker.setDefaults($.datepicker.regional["es"]);
                $("#fecha_salida").datepicker({
                    firstDay: 1,
                    dateFormat: 'm-d-yy',
                    numberOfMonths: 2,
                    changeMonth: true,
                    changeYear: true
         
                });
            });
            
            $(function () {
                $.datepicker.setDefaults($.datepicker.regional["es"]);
                $("#fecha_retorno").datepicker({
                    firstDay: 1,
                    dateFormat: 'm-d-yy',
                    numberOfMonths: 2,
                    changeMonth: true,
                    changeYear: true
                });
            });
            
         $("#fecha_salida").change(function () {
                                var fecha_salida = $('#fecha_salida').val();

                                $("#fecha_retorno").val(fecha_salida);
                               
                                if (!Validar(fecha_salida)) {
                                    $('#fecha_salida').focus();
                                } else {
                                    var fecha_retorno = $('#fecha_retorno').val();
                                }                         
                                
                                
                            });
            
             $("#fecha_retorno").change(function () {
                                var fecha_retorno = $('#fecha_retorno').val();
                                
                                $("#fecha_retorno").val(fecha_retorno);
                                
                                if (!Validar(fecha_retorno)) {
                                    $('#fecha_retorno').focus();
                                } else {
                                    var fecha_salida = $('#fecha_salida').val();
                                }                         
                                
                                
                            });   
            
            
//     $(document).ready(function() {
//                $( "#fecha_salida" ).datepicker( "option", "yearRange", "-99:+2050" );
//                $( "#fecha_salida" ).datepicker( "option", "maxDate", "+1000m +1000d" );
//
//                $( "#fecha_retorno" ).datepicker( "option", "yearRange", "-99:+2050" );
//                $( "#fecha_retorno" ).datepicker( "option", "maxDate", "+1000m +1000d" );
//            });

    function poner(id, id2) {
        var id = id;
        var id2 = id2;
        $("#userr").load('<?php echo $data["rootUrl"]; ?>admin/tours/cargardatos/' + id + '/' + id2);

        //;
    }
    
//    function adultos() {
//       
//       var ad = 100;
//        
//       document.getElementById('priceadults').value = ad;
//
//        
//    }
    
    $(function () {

        $("#btn-rastro").click(function () {
            console.log('rastros');
            var posicion = $(this).position();
            mosrtarRastro(posicion.left, posicion.top);
        });
        $("#btn-cancel").click(function () {
            location.href = "<?php echo $data['rootUrl'] ?>admin/onedaytour";
        });
///////////////////////////////////////////////////////////////////////////////////////////////////////////
        $("#from").change(function (evt) {
            var id = $("#from").val();
            $("#ext_from1").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));
            if (id !== 0) {
                $("#a_pickup1").attr('readonly', false);
            } else {
                $("#a_pickup1").attr('readonly', true);
            }
            $("#a_pickup1").val("");
            $("#a_id_pickup1").val("");
            var id_agencia = $("#id_agency").val();
            if (!Validar($("#fecha_salida").val())) {
                alert('please insert a valid date');
                $("#from").val(0);
            } else {

                var fecha = $("#fecha_salida").val();

                $("#reserveprices").load(encodeURI('<?php echo $data['rootUrl'] ?>admin/oneday/getcosttransf/' + $("#type_rate").val() + '/' + fecha + '/' + id_agencia), function () {


                    if (z == 1) {

                        var tres = (parseFloat($("#pricexadult").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild").val()) * parseFloat($("#child").val())) / 2;
                        priceadults.value = parseFloat($("#pricexadult").val());                        
                        pricechilds.value = parseFloat($("#pricexchild").val());
                        group_park.value = 1;

                        $("#totalreserve").val(tres);
                    }

                    if (z == 2) {

                        var tres = (parseFloat($("#pricexadult1").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild1").val()) * parseFloat($("#child").val())) / 2;
                        priceadults.value = parseFloat($("#pricexadult1").val());
                        pricechilds.value = parseFloat($("#pricexchild1").val());
                        group_park.value = 2;

                        $("#totalreserve").val(tres);
                    }

                    if (z == 3) {

                        var tres = (parseFloat($("#pricexadult2").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild2").val()) * parseFloat($("#child").val())) / 2;
                        priceadults.value = parseFloat($("#pricexadult2").val());
                        pricechilds.value = parseFloat($("#pricexchild2").val());
                        group_park.value = 3;

                        $("#totalreserve").val(tres);
                    }

                    if (tres != Math.NaN) {
//                        $("#price_transport1pp").html("$" + Math.ceil(tres) + ".00")
//                        $("#price_transport2pp").html("$" + Math.ceil(tres) + ".00")
                        
                        if (tres % 1 == 0) {
                            
                            $("#price_transport1pp").html("$" + (tres).toFixed(2));
                            $("#price_transport2pp").html("$" + (tres).toFixed(2));

                        } else {
                            
                            $("#price_transport1pp").html("$" + (tres).toFixed(2));
                            $("#price_transport2pp").html("$" + (tres).toFixed(2));
                            
                            
                        }
                        
                        
                        
//                        $("#price_transport1pp").html("$" + (tres) + ".00");
//                        $("#price_transport2pp").html("$" + (tres) + ".00")
                    }
                    calcularTotalPago();
                });
                $("#to2").val(id);
                $("#to2").trigger('change');
                $("#schedule1").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/1/' + $("#from").val() + '/' + $("#fecha_salida").val() + '/' + ($("#adult").val() + $("#child").val()) + '/'));
                
            }
        });

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $("#to2").change(function (evt) {
            var id = $("#to2").val();
            if (id != 0) {
                $("#d_pickup1").attr('disabled', false);
            } else {
                $("#d_pickup1").attr('disabled', true);
            }
            $("#d_pickup1").val("");
            $("#d_id_pickup1").val("");
            var id_agencia = $("#id_agency").val();
            $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));
            if (!Validar($("#fecha_salida").val())) {
                alert('Please enter a valid date');
                $("#to2").val(0);
            } else {
                var fecha = $("#fecha_salida").val();
                ///actualizacion
                var id_agencia = $("#id_agency").val();
                $("#reserveprices").load(encodeURI('<?php echo $data['rootUrl'] ?>admin/oneday/getcosttransf/' + $("#type_rate").val() + '/' + fecha + '/' + id_agencia), function () {


                    if (z == 1) {

                        var tres = (parseFloat($("#pricexadult").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild").val()) * parseFloat($("#child").val())) / 2;
                        
                        $("#totalreserver").val(tres);
                        priceadults.value = parseFloat($("#pricexadult").val());
                        pricechilds.value = parseFloat($("#pricexchild").val());
                        group_park.value = 1;

                        
                    }

                    if (z == 2) {

                        var tres = (parseFloat($("#pricexadult1").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild1").val()) * parseFloat($("#child").val())) / 2;
                        
                        $("#totalreserver").val(tres);
                        priceadults.value = parseFloat($("#pricexadult1").val());
                        pricechilds.value = parseFloat($("#pricexchild1").val());
                        group_park.value = 2;

                        

                    }

                    if (z == 3) {

                        var tres = (parseFloat($("#pricexadult2").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild2").val()) * parseFloat($("#child").val())) / 2;
                        
                        $("#totalreserver").val(tres);
                        priceadults.value = parseFloat($("#pricexadult2").val());
                        pricechilds.value = parseFloat($("#pricexchild2").val());
                        group_park.value = 3;

                        

                    }

                    if (tres != Math.NaN) {

//                        $("#price_transport2pp").html("$" + Math.ceil(tres) + ".00")
//                        $("#price_transport1pp").html("$" + Math.ceil(tres) + ".00")
                        
//                        $("#price_transport2pp").html("$" + (tres) + ".00")
//                        $("#price_transport1pp").html("$" + (tres) + ".00")
                        
                        
                         if (tres % 1 == 0) {                            
                                                       
                            $("#price_transport1pp").html("$" + (tres).toFixed(2));
                            $("#price_transport2pp").html("$" + (tres).toFixed(2));

                        } else {
                            
                            $("#price_transport1pp").html("$" + (tres).toFixed(2));
                            $("#price_transport2pp").html("$" + (tres).toFixed(2));
                            
                            
                        }
                    }
                    calcularTotalPago();
                });
            }

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            if (Validar($("#fecha_salida").val())) {
                $("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#to2").val() + '/' + $("#fecha_salida").val() + '/' + ($("#adult").val() + $("#child").val()) + '/'));
            } else {
                $("#to2").val(0);
            }

        });
        $("#ext_from1").change(function () {
            var id = $("#ext_from1").val();
            if (id != 0) {
                var id_agency = $("#id_agency").val();
                var num = 1;
                $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>admin/tours/priceexten/' + id + '/' + id_agency + '/' + num));
                $("#a_pickup2").attr('disabled', false);
                $("#a_pickup1").attr('disabled', true);
            } else {
                $("#a_pickup2").attr('disabled', true);
                $("#a_pickup1").attr('disabled', false);
                $("#a_id_pickup1").val('-1');
                $("#priceExt_from1").html('0');
                //
            }
        });

        $("#dataclick1").click(function (evt) {
            evt.preventDefault();
            //$("#fecha_salida").datepicker("show");
        });
        $("#dataclick2").click(function (evt) {
            evt.preventDefault();
            //$("#fecha_retorno").datepicker("show");
        });
        $("#fechasalida").focusout(function (evt) {
            evt.preventDefault();
            $("#fecha_salida").datepicker("hide");
        });



        $("#ext_to2").change(function () {
            if (parseFloat($("#ext_to2").val()) > 0) {
                $("#d_pickup1").attr('disabled', true)
                $("#d_pickup2").attr('disabled', false)
                $("#d_room1").attr('disable', false)
            } else {
                $("#d_pickup1").attr('disabled', false)
                $("#d_pickup2").attr('disabled', true)
                $("#d_room1").attr('disable', true)
            }
            calcularTotalPago();
        });

        $('input[name="opcion_pago"]').live('change', function () {
            calcularTotalPago();
        })
        $('input[name="opcion_saldo"]').live('change', function () {
            calcularTotalPago();
        })

    });

    function calcularTotalPago() {
        ////actualizacion
        var priceadults = $("#priceadults").val();

        var pricechilds = $("#pricechilds").val();

//        var total_initial = calcCom();
        
        var total_initial = calcCom() - parseFloat($("#rastrocom").val());

        if (parseFloat($("#extra").val()) > 0) {
            total_initial += parseFloat($("#extra").val());
        }
        var total_total = total_initial;
        if (parseFloat($("#descuento_valor").val()) > 0) {
            /* total_total -= parseFloat($("#descuento_valor").val()); */
            if (parseFloat($("#otheramount").val()) > 0) {
                total_initial -= parseFloat($("#descuento_valor").val());
            } else {
                total_total -= parseFloat($("#descuento_valor").val());
                total_initial -= parseFloat($("#descuento_valor").val());
            }
        }

        if (parseFloat($("#descuento").val())) {
            if (parseFloat($("#otheramount").val()) > 0) {
                total_initial = total_initial - ((total_initial) * (parseFloat($("#descuento").val()) / 100));
            } else {
                total_total = total_total - ((total_total) * (parseFloat($("#descuento").val()) / 100));
                total_initial = total_initial - ((total_initial) * (parseFloat($("#descuento").val()) / 100));
            }
        }
        if (parseFloat($("#otheramount").val()) > 0) {
            total_total = parseFloat($("#otheramount").val());
        }

        var fee = 0;
        var tipo_pago = $("#op_pago_id option:selected").val();
        var fee_n = 0;
<?php
if ($data['tour']->id < 1655) {
    echo "fee_n = 0.03;";
} else {
    echo "fee_n = 0.04;";
}
?>
        if (tipo_pago == 3) {
            if (parseFloat(total_total) > 0) {
                fee = total_total * fee_n;
            } else {
                fee = total_initial * fee_n;
            }
            total_initial += fee;
            total_total += fee;
        }
        if (tipo_pago == 1) {
            if (parseFloat(total_total) > 0) {
                fee = total_total * fee_n;
            } else {
                fee = total_initial * fee_n;
            }
            total_initial += fee;
            total_total += fee;
        }
        //agregando comision

        if (parseFloat($("#rastrocom").val()) > 0) {
            total_total += parseFloat($("#rastrocom").val());
        }
        //    alert(total_total);

        $("#total_first").val(total_initial);
        $("#total_total").val(total_total);
        $("#totalAmount").html('$ ' + total_initial.toFixed(2));
        
        if ($("input[name='opcion_saldo']:checked").val() == "1") {
            $("#saldoporpagar").html("$ " + parseFloat($("#total_total").val()).toFixed(2));
        } else {
            $("#saldoporpagar").html("$ " + (parseFloat($("#total_total").val()) - parseFloat($("#rastrocom").val())).toFixed(2));
        }
        var total_serv = <?php echo $data['tour']->totalouta ?>;
        var prepaid = <?php echo ((isset($data['prepaid'])) ? 'true' : 'false'); ?>;
        //calculando la diferencia

<?php if (isset($data['pagado'])) { ?>
            var diff = (parseFloat(parseFloat($("#total_total").val() - $("#prepaid-amount").val())));
<?php } else { ?>
            var diff = (parseFloat(parseFloat($("#total_total").val() - $("#actual-amount").val())));
<?php } ?>
        //        alert($("#actual-amount").val());
        if (diff == Math.NaN) {
            $("#saldoactual").html('$0.00');
        } else {
            $("#saldoactual").html('$' + (diff).toFixed(2));
            $("#actual_diff").val(diff);
            if (diff < 0 && prepaid) {
                $("#txtSaldoDiff").html('Debit note for client');
                $("input[name='opcion_pago']").attr('readonly', true);
            } else {
                $("#txtSaldoDiff").html('Pay Driver');
                $("input[name='opcion_pago']").attr('readonly', false);
                if ($("input [name='opcion_pago']").val() == 1 || $("input [name='opcion_pago']").val() == 2) {
                    $("#bnt-save2").hide();
                    $("#enviarF").show();
                }
            }
        }
    }

    $(function () {
        $("#add_attraction_list").live('click', function (evt) {
            if ($("#fecha_salida").val() != '') {
                if ($("#id_park").val() !== '') {
                    if ($("#nparks").val() == 1) {
                        alert('You have selected already a park');
                    } else {
                        $("#nparks").val(parseFloat($("#nparks").val()) + 1);
                        var id_park = $("#id_park").val();
                        var id_agency = $("#id_agency").val();
                        var child = $("#child").val();
                        var adult = $("#adult").val();
                        var url = "<?php echo $data['rootUrl'] ?>onedaytour/" + child + "/" + adult + "/" + id_park + "/" + id_agency + '/' + $("#fecha_salida").val();
                        $("#park-selected").load(url, function () {
                            var total_p = parseFloat($("#rate_adults").val() * $("#adult").val());
                            var total_c = parseFloat($("#rate_childs").val() * $("#child").val());

                            var total_a_s = parseFloat($("#suplemento_adults").val() * $("#adult").val());
                            var total_c_s = parseFloat($("#suplemento_childs").val() * $("#child").val());
                            var suma_s = parseFloat(total_a_s) + parseFloat(total_c_s);
                            if (isNaN(suma_s)) {
                                suma_s = 0;
                            }
                            var suma_t = parseFloat(total_p) + parseFloat(total_c);
                            var suma_pax = parseFloat(adult) + parseFloat(child);
                            var tkxp_total = parseFloat(suma_t) / parseFloat(suma_pax);
                            var tkxp_total_su = parseFloat(suma_s) / parseFloat(suma_pax);

                            //$("#park_transport").html('$ ' + tkxp_total_su + '.00');
                            
                            if (tkxp_total_su % 1 == 0) {//es un entero

                            //$("#park_admision").html('$ ' + tkxp_total + '.00');
                            $("#park_transport").html('$ ' +(tkxp_total_su).toFixed(2));

                            }else{//es un decimal

                            //$("#park_admision").html('$ ' + tkxp_total); 
                            $("#park_transport").html('$ ' +(tkxp_total_su).toFixed(2));

                            }


                            //$("#park_admision").html('$ ' + Math.ceil(tkxp_total) + '.00');
                            
                            //$("#park_admision").html('$ ' + tkxp_total + '.00');
                            
                            if (tkxp_total % 1 == 0) {//es un entero

                            //$("#park_admision").html('$ ' + tkxp_total + '.00');
                            $("#park_admision").html('$ ' +(tkxp_total).toFixed(2));

                            }else{//es un decimal

                            //$("#park_admision").html('$ ' + tkxp_total); 
                            $("#park_admision").html('$ ' +(tkxp_total).toFixed(2));

                            }

                            //                                                
                            if (!$("#adm_selector").is(':checked')) {
                                $("#total_parks").val(parseFloat($("#trpark").val()));
                            } else {
                                $("#total_parks").val(parseFloat($("#trpark").val()) + parseFloat($("#admpark").val()));
                            }
                            calcularTotalPago();
                        });
                        $("#categoria_park").val(0);
                        $("#park_name").val('');
                        $("#id_park").val('');
                    }
                } else {
                    alert('Please select a partk first');
                }
            } else {
                alert('Please, first select a date for the tour');
                $("#fecha_salida").focus();
            }
            calcularTotalPago();
        });
        $("#fecha_salida").on('change', function () {
            if ($("#from").val() != 0) {
                $("#schedule1").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/1/' + $("#from").val() + '/' + $("#fecha_salida").val() + '/' + ($("#adult").val() + $("#child").val()) + '/'));
            }
        });
        $("#fecha_retorno").on('change', function () {
            if ($("#from").val() != 0) {
                $("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#from").val() + '/' + $("#fecha_retorno").val() + '/' + ($("#adult").val() + $("#child").val()) + '/'));
            }
        });

        $("#delete_park").live('click', function (evt) {
            $("#park-selected").html('<td></td><td></td><td></td><td></td><td></td><td></td><td></td>');
            $("#total_parks").val(0);
            $("#nparks").val(0);
            $("#total_sumplemento").val(0);
            $("#suplemento_adults").val(0);
            $("#suplemento_childs").val(0);
            calcularTotalPago();
        });

        $("#include_ticket").live('click', function () {
            if (!$("#adm_selector").is(":checked")) {
                console.log("here");
                $("#adm_selector").attr("checked", true);
                $("#include_ticket").attr("src", "<?php echo $data['rootUrl'] ?>global/img/admin/check2.png");
                var child = $("#child").val();
                var adult = $("#adult").val();
                var total_p = parseFloat($("#rate_adults").val() * $("#adult").val());
                var total_c = parseFloat($("#rate_childs").val() * $("#child").val());

                var total_a_s = parseFloat($("#suplemento_adults").val() * $("#adult").val());
                var total_c_s = parseFloat($("#suplemento_childs").val() * $("#child").val());
                var suma_s = parseFloat(total_a_s) + parseFloat(total_c_s);
                if (isNaN(suma_s)) {
                    suma_s = 0;
                }
                var suma_t = parseFloat(total_p) + parseFloat(total_c);

                var suma_pax = parseFloat(adult) + parseFloat(child);
                var tkxp_total = parseFloat(suma_t) / parseFloat(suma_pax);
                var tkxp_total_su = parseFloat(suma_s) / parseFloat(suma_pax);
                //                alert(suma_t);

//                $("#park_transport").html('$ ' + Math.ceil(tkxp_total_su) + '.00');
//
//                $("#park_admision").html('$ ' + Math.ceil(tkxp_total) + '.00');

                //$("#park_transport").html('$ ' + tkxp_total_su + '.00');
                
                if (tkxp_total_su % 1 == 0) {//es un entero

                //$("#park_admision").html('$ ' + tkxp_total + '.00');
                $("#park_transport").html('$ ' +(tkxp_total_su).toFixed(2));

                }else{//es un decimal

                //$("#park_admision").html('$ ' + tkxp_total); 
                $("#park_transport").html('$ ' +(tkxp_total_su).toFixed(2));

                }

                //$("#park_admision").html('$ ' + tkxp_total + '.00');
                
                if (tkxp_total % 1 == 0) {//es un entero

                //$("#park_admision").html('$ ' + tkxp_total + '.00');
                $("#park_admision").html('$ ' +(tkxp_total).toFixed(2));

                }else{//es un decimal

                //$("#park_admision").html('$ ' + tkxp_total); 
                $("#park_admision").html('$ ' +(tkxp_total).toFixed(2));

                }
                
            } else {
                //            alert("2");
                console.log("here2");
                $("#adm_selector").attr("checked", false);
                $("#include_ticket").attr("src", "<?php echo $data['rootUrl'] ?>global/img/admin/x02.png")
                $("#park_admision").html('$ 0.00');
            }
            var total_a_s = parseFloat($("#suplemento_adults").val() * $("#adult").val());
            var total_c_s = parseFloat($("#suplemento_childs").val() * $("#child").val());
            var suma_s = parseFloat(total_a_s) + parseFloat(total_c_s);
            if (isNaN(suma_s)) {
                suma_s = 0;
            }

            var total_p_1 = parseFloat($("#rate_adults").val() * $("#adult").val()) + parseFloat($("#rate_childs").val() * $("#child").val()) + parseFloat(suma_s);

            if (!$("#adm_selector").is(':checked')) {
                $("#total_parks").val(0);
            } else {
                $("#total_parks").val(parseFloat($("#trpark").val()) + parseFloat(total_p));
            }
            calcularTotalPago();
        });
        $("#btn-save2").click(function () {
            if (valid()) {
                $("#content").css("display", "none");
                $("#form1").submit();
            }
        });
        $("#btn-save1").click(function () {
            if (valid()) {
                location.href = "<?php echo $data['rootUrl'] ?>admin/onedaytour/"
            }
        });
        $("#adult, #child").on('change', function () {
            if ($("#from").val() != 0) {
                var total_a_s = parseFloat($("#suplemento_adults").val() * $("#adult").val());
                var total_c_s = parseFloat($("#suplemento_childs").val() * $("#child").val());
                var suma_s = parseFloat(total_a_s) + parseFloat(total_c_s);
                if (isNaN(suma_s)) {
                    suma_s = 0;
                }
                var total_p_1 = parseFloat($("#rate_adults").val() * $("#adult").val()) + parseFloat($("#rate_childs").val() * $("#child").val()) + parseFloat(suma_s);

                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


                if (z == 1) {

                    var tres = (parseFloat($("#pricexadult").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild").val()) * parseFloat($("#child").val())) / 2;
                    //            alert(tres);
                    priceadults.value = parseFloat($("#pricexadult").val());
                    pricechilds.value = parseFloat($("#pricexchild").val());
                    group_park.value = 1;
                }

                if (z == 2) {

                    var tres = (parseFloat($("#pricexadult1").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild1").val()) * parseFloat($("#child").val())) / 2;
                    //            alert(tres);
                    priceadults.value = parseFloat($("#pricexadult1").val());
                    pricechilds.value = parseFloat($("#pricexchild1").val());
                    group_park.value = 2;
                }

                if (z == 3) {

                    var tres = (parseFloat($("#pricexadult2").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild2").val()) * parseFloat($("#child").val())) / 2;
                    //            alert(tres);
                    priceadults.value = parseFloat($("#pricexadult2").val());
                    pricechilds.value = parseFloat($("#pricexchild2").val());
                    group_park.value = 3;
                }

                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                var ttres = 0;
                if ($("#ext_from1").val() != 0) {
                    ttres = parseFloat($("#cost_ext").val()) * (parseFloat($("#child").val()) + parseFloat($("#adult").val()));
                    console.log(ttres + ".....................");
                }
                $("#totalreserve").val(tres + ttres);
                if (tres != Math.NaN) {
//                    $("#price_transport1pp").html("$" + Math.ceil(tres + ttres) + ".00")
//                    $("#price_transport2pp").html("$" + Math.ceil(tres + ttres) + ".00")
                    
//                    $("#price_transport1pp").html("$" + (tres) + (ttres) + ".00")
//                    $("#price_transport2pp").html("$" + (tres) + (ttres) + ".00")
                    
                     if (tres % 1 == 0) {
                            
                            $("#price_transport1pp").html("$" + (tres + ttres).toFixed(2));
                            $("#price_transport2pp").html("$" + (tres + ttres).toFixed(2));

                        } else {
                            
                            $("#price_transport1pp").html("$" + (tres + ttres).toFixed(2));
                            $("#price_transport2pp").html("$" + (tres + ttres).toFixed(2));
                            
                            
                        }
                }
            }

            if ($("#to2").val() != 0) {


                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                if (z == 1) {
                    var tres = (parseFloat($("#pricexadult").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild").val()) * parseFloat($("#child").val())) / 2;
                    priceadults.value = parseFloat($("#pricexadult").val());
                    pricechilds.value = parseFloat($("#pricexchild").val());
                    group_park.value = 1;
                }

                if (z == 2) {
                    var tres = (parseFloat($("#pricexadult1").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild1").val()) * parseFloat($("#child").val())) / 2;
                    priceadults.value = parseFloat($("#pricexadult1").val());
                    pricechilds.value = parseFloat($("#pricexchild1").val());
                    group_park.value = 2;
                }

                if (z == 3) {
                    var tres = (parseFloat($("#pricexadult2").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild2").val()) * parseFloat($("#child").val())) / 2;
                    priceadults.value = parseFloat($("#pricexadult2").val());
                    pricechilds.value = parseFloat($("#pricexchild2").val());
                    group_park.value = 3;
                }

                var ttres = 0;

                if ($("#ext_to2").val() != 0) {
                    ttres = parseFloat($("#cost_ext2").val()) * (parseFloat($("#child").val()) + parseFloat($("#adult").val()));
                }
                $("#totalreserver").val(parseFloat(tres) + parseFloat(ttres));
                if (tres != Math.NaN) {
//                    $("#price_transport2pp").html("$" + Math.ceil(tres + ttres) + ".00")
//                    $("#price_transport1pp").html("$" + Math.ceil(tres + ttres) + ".00")
                    
//                    $("#price_transport2pp").html("$" + (tres) + (ttres) + ".00")
//                    $("#price_transport1pp").html("$" + (tres) + (ttres) + ".00")
                    
                    
                    if (tres % 1 == 0) {
                            
                                                        
                            $("#price_transport1pp").html("$" + (tres + ttres).toFixed(2));
                            $("#price_transport2pp").html("$" + (tres + ttres).toFixed(2));

                        } else {
                            
                            $("#price_transport1pp").html("$" + (tres + ttres).toFixed(2));
                            $("#price_transport2pp").html("$" + (tres + ttres).toFixed(2));
                            
                            
                        }
                    
                    
                }
            }

            if ($("#id_selected_park").length) {
                var id_park = $("#id_selected_park").val();
                var id_agency = $("#id_agency").val();
                var child = $("#child").val();
                var adult = $("#adult").val();
                var url = "<?php echo $data['rootUrl'] ?>onedaytour/" + child + "/" + adult + "/" + id_park + "/" + id_agency;
                $("#park-selected").load(url, function () {
                    var total_p = parseFloat($("#rate_adults").val() * $("#adult").val());
                    var total_c = parseFloat($("#rate_childs").val() * $("#child").val());
                    var total_a_s = parseFloat($("#suplemento_adults").val() * $("#adult").val());
                    var total_c_s = parseFloat($("#suplemento_childs").val() * $("#child").val());
                    var suma_s = parseFloat(total_a_s) + parseFloat(total_c_s);
                    if (isNaN(suma_s)) {
                        suma_s = 0;
                    }
                    var suma_t = parseFloat(total_p) + parseFloat(total_c);
                    var suma_t_s = parseFloat(total_p) + parseFloat(total_c);

                    var suma_pax = parseFloat(adult) + parseFloat(child);
                    var tkxp_total = parseFloat(suma_t) / parseFloat(suma_pax);
                    var tkxp_total_su = parseFloat(suma_s) / parseFloat(suma_pax);
                    //                $("#park_transport").html('$ '+$("#trpark").val()+'.00');

//                    $("#park_transport").html('$ ' + Math.ceil(tkxp_total_su) + '.00');
//
//                    $("#park_admision").html('$ ' + Math.ceil(tkxp_total) + '.00');

                    //$("#park_transport").html('$ ' + tkxp_total_su + '.00');
                    
                    
                    if (tkxp_total_su % 1 == 0) {//es un entero

                    //$("#park_admision").html('$ ' + tkxp_total + '.00');
                    $("#park_transport").html('$ ' +(tkxp_total_su).toFixed(2));
                    
                    }else{//es un decimal
                        
                    //$("#park_admision").html('$ ' + tkxp_total);
                    $("#park_transport").html('$ ' +(tkxp_total_su).toFixed(2));
                        
                    }

                    
                    
                    if (tkxp_total % 1 == 0) {//es un entero

                    //$("#park_admision").html('$ ' + tkxp_total + '.00');
                    $("#park_admision").html('$ ' +(tkxp_total).toFixed(2));
                    
                    }else{//es un decimal
                        
                    //$("#park_admision").html('$ ' + tkxp_total);
                    $("#park_admision").html('$ ' +(tkxp_total).toFixed(2));
                        
                    }

                    if (!$("#adm_selector").is(':checked')) {
                        $("#total_parks").val(parseFloat(total_p));
                    } else {
                        $("#total_parks").val(parseFloat($("#trpark").val()) + parseFloat(total_p));
                    }
                    calcularTotalPago();
                });

            }
            calcularTotalPago();
        });
        $("#ext_from1").on('change', function () {
            if ($(this).val() != 0) {
                var tres = $("#totalreserve").val();
                $("#extcost").load('<?php echo $data['rootUrl']; ?>admin/oneday/getcosttransfext/' + $(this).val() + '/1', function () {
                    tres = parseFloat(tres) + parseFloat($("#cost_ext").val()) * ($("#child").val() + $("#adult").val());
                    if (tres != Math.NaN) {
                        $("#totalreserve").val(tres);
//                        $("#price_transport1pp").html("$" + Math.ceil(tres) + ".00");
//                        $("#price_transport1pp").html("$" + tres + ".00");
//                        
                        
                        if (tres % 1 == 0) {
                            
                            $("#price_transport1pp").html("$" + (tres).toFixed(2));
                            
                            

                        } else {
                            
                            $("#price_transport1pp").html("$" + (tres).toFixed(2));
                                                       
                            
                        }
                    }
                    calcularTotalPago();
                });
            }
        });
        $("#ext_to2").on('change', function () {
            if ($(this).val() != 0) {
                var tres = $("#totalreserver").val();
                $("#extcost2").load('<?php echo $data['rootUrl']; ?>admin/oneday/getcosttransfext/' + $(this).val() + '/2', function () {
                    tres = parseFloat(tres) + parseFloat($("#cost_ext2").val()) * ($("#child").val() + $("#adult").val());
                    $("#totalreserver").val(tres);
//                    $("#price_transport2pp").html("$" + Math.ceil(tres) + ".00");
                    //$("#price_transport2pp").html("$" + (tres) + ".00");
                    $("#price_transport2pp").html("$" + (tres).toFixed(2));
                    
                    calcularTotalPago();
                });
            }
        });
        //    $(".txtNumbers").keydown(function(event) {
        //        if(event.shiftKey)
        //        {
        //            event.preventDefault();
        //        }
        //        if (event.keyCode == 46 || event.keyCode == 8) {
        //        }
        //        else {
        //            if (event.keyCode < 95) {
        //                if (event.keyCode < 48 || event.keyCode > 57) {
        //                    event.preventDefault();
        //                }
        //            }
        //            else {
        //                if (event.keyCode < 96 || event.keyCode > 105) {
        //                    event.preventDefault();
        //                }
        //            }
        //        }
        //    });
        $("#opcion_pago_predpaid_cash").click(function () {
            $("#btn-save2").show();
            $("#enviarF").hide();
            //        $("#pay_amount_html").hide();
        });
        $("#opcion_pago_CrediFee").click(function () {
            $("#btn-save2").show();
            $("#enviarF").hide();
            //#new
            //        $("#pay_amount_html").hide();
        });
        $("#opcion_pago_agency").click(function () {
            $("#btn-save2").show();
            $("#enviarF").hide();
            //#new
            $("#pay_amount_html").show();
        });
        $("#opcion_pago_Cash, #opcion_pago_Voucher").click(function () {
            $("#btn-save2").show();
            $("#enviarF").hide();
            //        $("#pay_amount_html").hide();
        });
        $("#opcion_pago_passager").click(function () {
            //        $("#btn-save2").hide();
            $("#enviarF").show();
            $("#pay_amount_html").show();
        });
        $('#descuento').keydown(function (evt) {
            var actual = parseFloat($(this).val());
            var pres = String.fromCharCode(evt.which);
            if (parseFloat(actual + pres) > 100) {
                evt.preventDefault();
            }
        });
        $('#descuento_valor').keydown(function (evt) {
            var actual = parseFloat($(this).val());
            var pres = String.fromCharCode(evt.which);
            var total = parseFloat($("#total_first").val());
            if (parseFloat(actual + pres) > total) {
                evt.preventDefault();
            }
        });
        $("#descuento_valor, #descuento").on('change', function () {
            calcularTotalPago();
        });
    });
    function calcCom() {
//            if (parseFloat($("#type_rate").val()) != 0) {
        if ($("#adm_selector").is(":checked")) {
            var total_p = parseFloat($("#rate_adults").val() * $("#adult").val()) + parseFloat($("#rate_childs").val() * $("#child").val());

        } else {
            if ($("#especial_price").val() == 1) {
                var total_p = parseFloat($("#rate_adults").val() * $("#adult").val()) + parseFloat($("#rate_childs").val() * $("#child").val());

            } else {
                var total_p = 0;
            }
        }


        if (isNaN(total_p)) {
            total_p = 0;
        }
        //        alert(total_p);
        var total_a_s = parseFloat($("#suplemento_adults").val() * $("#adult").val());
        var total_c_s = parseFloat($("#suplemento_childs").val() * $("#child").val());
        var suma_s = parseFloat(total_a_s) + parseFloat(total_c_s);
        if (isNaN(suma_s)) {
            suma_s = 0;
        }
//            alert($("#suplemento_adults").val());
        var total_initial = (parseFloat($("#totalreserve").val()) + parseFloat($("#totalreserver").val()) + parseFloat(total_p) + parseFloat(suma_s));

        $("#rastrocom").val(0);
//            } else {
//                var total_initial = (Math.ceil((parseFloat($("#totalreserve").val()) + parseFloat($("#totalreserver").val())) * (1.15)) + parseFloat($("#total_parks").val()) + parseFloat($("#total_sumplemento").val()));
//                $("#rastrocom").val(Math.ceil((parseFloat($("#totalreserve").val()) + parseFloat($("#totalreserver").val())) * (0.15)));
//                $("#valorComision").html('$' + ((parseFloat($("#totalreserve").val()) + parseFloat($("#totalreserver").val())) * (0.15) + '.00'));
//                var total_initial = (parseFloat($("#totalreserve").val()) + parseFloat($("#totalreserver").val()) + parseFloat($("#total_parks").val()));
//            }

        return total_initial;
    }
    function valid() {

        var at_point = false;

        if (parseFloat($("#idCliente").val()) > 0) {
            at_point = true;
        } else {
            if ($("#firstname1").val() != "" && $("#lastname1").val() != "") {
                at_point = true;
            } else {
                alert('introduce new a client');
                $("#cliente").focus();
                return false;
            }
        }
        if ($("#fecha_salida").val() != "" && Validar($("#fecha_salida").val())) {
            at_point = true;
        } else {
            alert('bad departure date');
            $("#fecha_salida").focus()
            return false;
        }
        if ((parseFloat($("#adult").val()) + parseFloat($("#child").val())) > 0) {
            at_point = true;
        } else {
            alert('set how many people is traveling');
            $("#adult").focus();
            return false;
        }
        if (parseFloat($("#from").val()) > 0 && (parseFloat($("#a_id_pickup1").val()) > 0) || parseFloat($("#ext_from1").val()) > 0) {
            at_point = true;
        } else {
            alert("select a valid pickup point");
            $("#a_pickup1").focus();
            return false;
        }
        if (parseFloat($("#to2").val()) > 0 && (parseFloat($("#d_id_pickup1").val()) > 0) || parseFloat($("#ext_to2").val()) > 0) {
            at_point = true;
        } else {
            alert("select a valid dropoff point");
            $("#d_pickup1").focus();
            return false;
        }
        if (parseFloat($("#nparks").val()) > 0) {
            at_point = true;
        } else {
            alert('which park is going to be visited')
            $("#park_name").focus();
            return false;
        }

        if (parseFloat($("#id_agency").val()) > 0) {
            if (parseFloat($("#id_auser").val()) < 0) {
                alert('which employee made the tour reservation');
                $("#uagency").focus();
                return false;
            } else {
                at_point = true;
            }
        }
        if (parseFloat($("#ext_from1").val()) > 0) {
            if ($("#a_pickup2").val() == "") {
                alert("You should introduce a valid address");
                $("#a_pickup2").focus();
                return false;
            }
        }
        if (!$("#byrm").is(':checked') && !$("#byrp").is(':checked') && !$("#byrw").is(':checked')) {
            alert("select a source of the reserve");
            $("#byrp").focus();
            return false;
        }
        
//        if (!$("#wdwus").is(':checked') && !$("#wphol").is(':checked') && !$("#kspc").is(':checked')) {
//                alert("[ Select a Group Parks ] & [ Select a New Route ]");
//                document.getElementById('from').value = '0';
//                document.getElementById('to2').value = '0';
//                document.getElementById('a_pickup1').value = ' ';
//                document.getElementById('d_pickup1').value = ' ';
//                $("#price_transport1pp").html("$" + "0.00");
//                $("#price_transport2pp").html("$" + "0.00");
//                $("#schedule1").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/1/' + $("#from").val('') + '/' + $("#fecha_salida").val() + '/' + ($("#adult").val() + $("#child").val()) + '/'));
//                $("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#to2").val('') + '/' + $("#fecha_salida").val() + '/' + ($("#adult").val() + $("#child").val()) + '/'));
//                $("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#to2").val('') + '/' + $("#fecha_retorno").val() + '/' + ($("#adult").val() + $("#child").val()) + '/'));
//                $("#wdwus").focus();
//                return false;
//            }
            
        if (!$("#opcion_pago_Cash_2").is(':checked') && !$("#opcion_pago_passager_2").is(':checked') && !$("#opcion_pago_predpaid_check").is(':checked') && !$("#opcion_pago_complementary").is(':checked') && (!$("#opcion_pago_passager").is(':checked') && !$("#opcion_pago_agency").is(':checked') && !$("#opcion_pago_predpaid_cash").is(':checked') && !$("#opcion_pago_CrediFee").is(":checked") && !$("#opcion_pago_Cash").is(':checked') && !$("#opcion_pago_Voucher").is(':checked'))) {
            alert('Please select a payment option');
            $("#opcion_pago_passager").focus();
            return false;
        }
        return at_point;
    }



    $(document).ready(function(){

	$("#wdwus").click(function() {
            
		if($("#wdwus").is(':checked')) {
		
                
                document.getElementById("from").value = document.getElementById('fromt').value ;
                document.getElementById("to2").value = document.getElementById('tot2').value ;
                
                document.getElementById("a_pickup1").value = document.getElementById('pickup').value ;                
                document.getElementById("d_pickup1").value = document.getElementById('dropoff').value ;       
                
                

                setTimeout(function () {       
          
                    var precio1 = '<?php echo  $price_adult_wdw; ?>';
                    var precio2 = '<?php echo  $price_child_wdw; ?>'; 

                    var adult = $("#adult").val();    
                    var child = $("#child").val();

                    document.getElementById("adult").disabled = '';
                    document.getElementById("child").disabled = '';

                    document.getElementById("priceadults").value =  precio1;
                    document.getElementById("pricechilds").value =  precio2;  

                    var tres = ((parseFloat($("#priceadults").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricechilds").val()) * parseFloat($("#child").val())) / 2).toFixed(2);;

                    $("#price_transport1pp").html("$" + tres);
                    $("#price_transport2pp").html("$" + tres);


                    $("#wdwus").focus();


                }, 100);


		} 
	});


	$("#wphol").click(function() {
        
		if($("#wphol").is(':checked')) {
			
		
                document.getElementById("from").value = document.getElementById('fromt').value ;
                document.getElementById("to2").value = document.getElementById('tot2').value ;
                
                document.getElementById("a_pickup1").value = document.getElementById('pickup').value ;                
                document.getElementById("d_pickup1").value = document.getElementById('dropoff').value ;    
                       

                setTimeout(function () {
                    
                    var precio3 = '<?php echo  $price_adult_WATERP; ?>';
                    var precio4 = '<?php echo  $price_child_WATERP; ?>';    

                    var adult = $("#adult").val();    
                    var child = $("#child").val();

                    document.getElementById("adult").disabled = '';
                    document.getElementById("child").disabled = '';

                    document.getElementById("priceadults").value =  precio3;
                    document.getElementById("pricechilds").value =  precio4;  



                    var tres = ((parseFloat($("#priceadults").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricechilds").val()) * parseFloat($("#child").val())) / 2).toFixed(2);;

                    $("#price_transport1pp").html("$" + tres);
                    $("#price_transport2pp").html("$" + tres);

                    $("#wphol").focus();
                


                }, 100);
		
		} 
	});

	
	$("#kspc").click(function() {
		
                if($("#kspc").is(':checked')) {
                    
                    
                document.getElementById("from").value = document.getElementById('fromt').value ;
                document.getElementById("to2").value = document.getElementById('tot2').value ;
                
                document.getElementById("a_pickup1").value = document.getElementById('pickup').value ;                
                document.getElementById("d_pickup1").value = document.getElementById('dropoff').value ;       
		
                setTimeout(function () {
                    
                    
                    var precio5 = '<?php echo  $price_adult_KENNEDYSPC; ?>';
                    var precio6 = '<?php echo  $price_child_KENNEDYSPC; ?>'; 

                    var adult = $("#adult").val();    
                    var child = $("#child").val();

                    document.getElementById("adult").disabled = '';
                    document.getElementById("child").disabled = '';

                    document.getElementById("priceadults").value =  precio5;
                    document.getElementById("pricechilds").value =  precio6;                 


                    var tres = ((parseFloat($("#priceadults").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricechilds").val()) * parseFloat($("#child").val())) / 2).toFixed(2);;

                    $("#price_transport1pp").html("$" + tres);
                    $("#price_transport2pp").html("$" + tres);        


                    $("#kspc").focus();
                

                }, 100);

		} 
            });


        });
        
    $(function () {
        $("#extra").on('change', function () {
            calcularTotalPago();
        });
        $("#otheramount").on('change', function () {
            calcularTotalPago();
        });
        $(".opcion_pago").click(function () {
            calcularTotalPago();
        });

        $("#icon-back").click(function () {
            $("#mascaraP").hide();
            $("#clienteN").hide();
        });
        $("#enviarF").click(function () {
            if (valid()) {
                if ($("input[name='opcion_pago']:checked").val() == 2) { //passenger credit card

                    if ($("#is_user_ch").is(':checked') == true) {

                        var data = $("#complete").val();
                        console.log(data);
                        if (data == "false") {
                            $("#mascaraP").show();
                            $("#cardholder").attr('checked', false);
                            shownclient();
                            $("#country").focus();
                        } else {
                            console.log('submit1');
                            $("#form1").attr('target', '_blank').submit();
                            var hilo = setInterval("estadoPago()", 5000);
                            console.log('inited-thread');
                        }
                    } else {
                        $("#mascaraP").show();
                        $("#cardholder").attr('checked', false);
                        $("#clienteN").show();
                        $("#username").focus();
                    }
                } else if ($("input[name='opcion_pago']:checked").val() == 1) { //agency credit card
                    console.log('submit2');
                    $("#form1").attr('target', '_blank').submit();
                    var hilo = setInterval("estadoPago()", 5000);
                }
            }
        });
        $("#icon-save").click(function () {
            $("#mascaraP").hide();
            if (valid2()) {
                $("#form1").attr('action', '<?php echo $data['rootUrl'] ?>onedaytour/save');
                $("#form1").submit();
            }
        });
    });


    function rutas() {
    
        $('#from').click();
        $('#to2').click();
    
    }
    function shownclient() {
        $("#username").val($("#email1").val());
        $("#firstname").val($("#firstname1").val());
        $("#lastname").val($("#lastname1").val());
        $("#phone").val($("#phone1").val());
        $("#clienteN").show();
    }

    function valid2() {
        if ($("#username").val() == "") {
            alert("A username/email is required");
            return false;
        }
        if ($("#firstname").val() == "") {
            alert("Firstname is a required field");
            return false;
        }
        if ($("#lastname").val() == "") {
            alert("Lastname is a required field");
            return false;
        }
        if ($("#phone").val() == "") {
            alert("Phone is a required field");
            return false;
        }
        if ($("#country").val() == "") {
            alert("Please select a valid country");
            return false;
        }
        if ($("#state").val() == "") {
            alert("Please select a valid state");
            return false;
        }
        if ($("#city").val() == "") {
            alert("City is a required field");
            return false;
        }
        if ($("#address").val() == "") {
            alert("An address is required");
            return false;
        }
        if ($("#zip").val() == "") {
            alert("A zip code is required");
            return false;
        }
        return true;
    }

    function estadoPago() {
        $("#estadoTranssacion").load('<?php echo $data['rootUrl']; ?>transaction/admin/onedaytours/payment');
    }

    $(function () {
        $("#opcion_pago_agency").click(function () {
            $("#btn-save2").show();
            $("#enviarF").show();
            //#new
            $("#pay_amount").show();
        });
        $("#cardholder").click(function () {
            if ($(this).is(':checked')) {
                $("#username").val($("#email1").val());
                $("#firstname").val($("#firstname1").val());
                $("#lastname").val($("#lastname1").val());
                $("#phone").val($("#phone1").val());
                $("#country").val(0);
                $("#state").val(0);
                $("#city").val('');
                $("#zip").val('');
            } else {
                $("#username").val('');
                $("#firstname").val('');
                $("#lastname").val('');
                $("#phone").val('');
                $("#country").val(0);
                $("#state").val(0);
                $("#city").val('');
                $("#zip").val('');
            }
        });
    });
</script>
<script>
    $(function () {
        $("#agency").keyup(function () {
            if ($(this).val() == "") {
                $("#uagency").attr('disabled', true);
                $("#id_agency").val(-1);
                $("#tableTypeSaldo").hide();
                $("#opcion_pago_agency, #label_tipo_agency").parent().hide();
            } else {
                $("#opcion_pago_agency, #label_tipo_agency").parent().show();
            }
        });
    });
    function mosrtarRastro(left, top) {
        $("#dialog").dialog({
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
        $("#dialog").dialog("open");
    }
    function detalles_rastro(id) {
        $("#conten_rastro").load('<?php echo $data['rootUrl']; ?>admin/onedaytour/edit/rastro/' + id);
        $("#dialog-message").dialog({
            modal: true,
            width: 600,
            buttons: {
                Ok: function () {
                    $(this).dialog("close");
                }
            }
        });
    }
<?php
if ($data['tour']->op_pago != 0) {
    $op_pago = $data['tour']->op_pago;
} else {
    if ($data['tour']->pago == "COLLECT ON BOARD") {
        list($primero, $segundo) = explode("-", $data['tour']->tipo_pago);
        if (trim($primero) == "CREDIT CARD WITH FEE") {
            $op_pago = 3;
        }
        if (trim($primero) == "CREDIT CARD NO FEE") {
            $op_pago = 8;
        }
        if (trim($primero) == "CASH") {
            $op_pago = 4;
        }
        if (trim($primero) == "CHECK") {
            $op_pago = 9;
        }
    }
    if ($data['tour']->pago == "PRE-PAID") {
        list($primero, $segundo) = explode("-", $data['tour']->tipo_pago);
        if (trim($primero) == "CREDIT CARD WITH FEE") {
            $op_pago = 1;
        }
        if (trim($primero) == "CREDIT CARD NO FEE") {
            $op_pago = 2;
        }
        if (trim($primero) == "CASH") {
            $op_pago = 6;
        }
        if (trim($primero) == "CHECK") {
            $op_pago = 10;
        }
    }
}
?>

    var sel_payment = '<?php echo $op_pago; ?>';
//    alert(sel_payment);
//    exit();
//    
    $("#op_pago_id option[value=" + sel_payment + "]").attr("selected", "selected");
</script>


<script>

    var z
    function capturar()
    {
        var resultado = "ninguno";

        var porNombre = document.getElementsByName("wdw");
        // Recorremos todos los valores del radio button para encontrar el
        // seleccionado
        for (var i = 0; i < porNombre.length; i++)
        {
            if (porNombre[i].checked)
                resultado = porNombre[i].value;

        }

       
        z = document.getElementById("resultado").innerHTML = " \ " + resultado;
        
        document.getElementById("group_park2").value = z;
           
        
        if (z == 1){
            
        var precio1 = '<?php echo  $price_adult_wdw; ?>';
        var precio2 = '<?php echo  $price_child_wdw; ?>'; 
        
       
        
        var adult = $("#adult").val();    
        var child = $("#child").val();
                        
        document.getElementById("price_transport1pp").innerHTML =  (((precio1*adult)+(precio2*child))/2).toFixed(2);
        document.getElementById("price_transport2pp").innerHTML =  (((precio1*adult)+(precio2*child))/2).toFixed(2);
        
        
        document.getElementById("priceadults").value =  precio1;
        document.getElementById("pricechilds").value =  precio2;  
        
        setTimeout(function () {
                    
               $('#from').change();
//               document.getElementById("from").value = 0;
//               document.getElementById("from").value = document.getElementById('fromt').value ;
               
               $('#to2').change();                
//               document.getElementById("to2").value = 0;               
//               document.getElementById("to2").value = document.getElementById('tot2').value ;
//                
//               document.getElementById("a_pickup1").value = document.getElementById('pickup').value ;                
//               document.getElementById("d_pickup1").value = document.getElementById('dropoff').value ;


        }, 100);
        
         }
         
        if (z == 2){
            
        var precio3 = '<?php echo  $price_adult_WATERP; ?>';
        var precio4 = '<?php echo  $price_child_WATERP; ?>';    
        
        var adult = $("#adult").val();    
        var child = $("#child").val();
        
       
        document.getElementById("price_transport1pp").innerHTML = (((precio3*adult)+(precio4*child))/2).toFixed(2);
        document.getElementById("price_transport2pp").innerHTML = (((precio3*adult)+(precio4*child))/2).toFixed(2);
        
        document.getElementById("priceadults").value =  precio3;
        document.getElementById("pricechilds").value =  precio4;  
        
        
        setTimeout(function () {
                    
               $('#from').change();
//               document.getElementById("from").value = 0;
//               document.getElementById("from").value = document.getElementById('fromt').value ;
               
               $('#to2').change();                
//               document.getElementById("to2").value = 0;               
//               document.getElementById("to2").value = document.getElementById('tot2').value ;
//                
//               document.getElementById("a_pickup1").value = document.getElementById('pickup').value ;                
//               document.getElementById("d_pickup1").value = document.getElementById('dropoff').value ;


        }, 100);
        
         } 
         
        if (z == 3){
            
        
        var precio5 = '<?php echo  $price_adult_KENNEDYSPC; ?>';
        var precio6 = '<?php echo  $price_child_KENNEDYSPC; ?>'; 
        
        
        var adult = $("#adult").val();    
        var child = $("#child").val();
            
        document.getElementById("price_transport1pp").innerHTML = (((precio5*adult)+(precio6*child))/2).toFixed(2);
        document.getElementById("price_transport2pp").innerHTML = (((precio5*adult)+(precio6*child))/2).toFixed(2);
        
        document.getElementById("priceadults").value =  precio5;
        document.getElementById("pricechilds").value =  precio6;   
        
        
        setTimeout(function () {
                    
               $('#from').change();
//               document.getElementById("from").value = 0;
//               document.getElementById("from").value = document.getElementById('fromt').value ;
               
               $('#to2').change();                
//               document.getElementById("to2").value = 0;               
//               document.getElementById("to2").value = document.getElementById('tot2').value ;
//                
//               document.getElementById("a_pickup1").value = document.getElementById('pickup').value ;                
//               document.getElementById("d_pickup1").value = document.getElementById('dropoff').value ;


        }, 100);



       
        
        }

    }
</script>

<script>
    function habilitar(value)
    {
        if (value == "1")
        {
            // Habilitamos el grupo de parques de WDW/UNIVERSAL/SEAWORLD
            
            
            document.getElementById("categoria_park")[0].style.display = 'block';
            document.getElementById("categoria_park")[1].style.display = 'block';
            document.getElementById("categoria_park")[2].style.display = 'block';
            document.getElementById("categoria_park")[3].style.display = 'none';
            document.getElementById("categoria_park")[4].style.display = 'none';
            document.getElementById("categoria_park")[5].style.display = 'none';
            document.getElementById("categoria_park")[6].style.display = 'none';
//            document.getElementById("wphol").disabled = 'disabled';
//            document.getElementById("kspc").disabled = 'disabled';

        }

        if (value == "2")
        {
            // Habilitamos el grupo de parques de WATER PARKS & HOLY LAND

            document.getElementById("categoria_park")[0].style.display = 'none';
            document.getElementById("categoria_park")[1].style.display = 'none';
            document.getElementById("categoria_park")[2].style.display = 'none';
            document.getElementById("categoria_park")[3].style.display = 'block';
            document.getElementById("categoria_park")[4].style.display = 'none';
            document.getElementById("categoria_park")[5].style.display = 'none';
            document.getElementById("categoria_park")[6].style.display = 'block';
//            document.getElementById("wdwus").disabled = 'disabled';
//            document.getElementById("kspc").disabled = 'disabled';


        }

        if (value == "3")
        {
            // Habilitamos el grupo de parques de KENNEDY SPACE CENTER

            document.getElementById("categoria_park")[0].style.display = 'none';
            document.getElementById("categoria_park")[1].style.display = 'none';
            document.getElementById("categoria_park")[2].style.display = 'none';
            document.getElementById("categoria_park")[3].style.display = 'none';
            document.getElementById("categoria_park")[4].style.display = 'none';
            document.getElementById("categoria_park")[5].style.display = 'block';
            document.getElementById("categoria_park")[6].style.display = 'none';
//            document.getElementById("wdwus").disabled = 'disabled';
//            document.getElementById("wphol").disabled = 'disabled';


        }

    }




</script>


