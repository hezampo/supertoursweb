<!-- Estilos e importaciones de javascript-->
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/panel.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/autocompletar/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css">
<!--<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/button.css" />-->

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ausu-autosuggest.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/Concurrent.Thread.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>


<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/ui/jquery.ui.dialog.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.timeentry.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/menubar/js/menu.js"></script>



<script>
    $(function () {
        console.log('jquery-ready');
    });
</script>


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
        background-color: #FFF;
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
/*    .rojo{
         IE10+  
        background-image: -ms-linear-gradient(bottom left, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%);

         Mozilla Firefox  
        background-image: -moz-linear-gradient(bottom left, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%);

         Opera  
        background-image: -o-linear-gradient(bottom left, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%);

         Webkit (Safari/Chrome 10)  
        background-image: -webkit-gradient(linear, left bottom, right top, color-stop(0, #260505), color-stop(75.5, #AC1B29), color-stop(100, #FFC7C7));

         Webkit (Chrome 11+)  
        background-image: -webkit-linear-gradient(bottom left, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%);

         W3C Markup  
        background-image: linear-gradient(to top right, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%); 
    }*/
/*    .cerati{
         IE10+  
        background-image: -ms-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

         Mozilla Firefox  
        background-image: -moz-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

         Opera  
        background-image: -o-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

         Webkit (Safari/Chrome 10)  
        background-image: -webkit-gradient(linear, left bottom, right top, color-stop(0, #1E4D82), color-stop(51, #33449C), color-stop(75.5, #1B1478), color-stop(100, #E1E0FF));

         Webkit (Chrome 11+)  
        background-image: -webkit-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

         W3C Markup  
        background-image: linear-gradient(to top right, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);
    }*/
    
    .cerati{
               /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#1e5799+20,2989d8+50,1e5799+80&0+0,0.8+15,1+19,1+81,0.8+85,0+100 */
        background: -moz-linear-gradient(45deg, rgba(30,87,153,0) 0%, rgba(30,87,153,0.8) 15%, rgba(30,87,153,1) 19%, rgba(30,87,153,1) 20%, rgba(41,137,216,1) 50%, rgba(30,87,153,1) 80%, rgba(30,87,153,1) 81%, rgba(30,87,153,0.8) 85%, rgba(30,87,153,0) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(45deg, rgba(30,87,153,0) 0%,rgba(30,87,153,0.8) 15%,rgba(30,87,153,1) 19%,rgba(30,87,153,1) 20%,rgba(41,137,216,1) 50%,rgba(30,87,153,1) 80%,rgba(30,87,153,1) 81%,rgba(30,87,153,0.8) 85%,rgba(30,87,153,0) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(45deg, rgba(30,87,153,0) 0%,rgba(30,87,153,0.8) 15%,rgba(30,87,153,1) 19%,rgba(30,87,153,1) 20%,rgba(41,137,216,1) 50%,rgba(30,87,153,1) 80%,rgba(30,87,153,1) 81%,rgba(30,87,153,0.8) 85%,rgba(30,87,153,0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#001e5799', endColorstr='#001e5799',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
    }



    .black{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#7d7e7d+0,0e0e0e+100;Black+3D */
        background: rgb(125,126,125); /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover,  rgba(125,126,125,1) 0%, rgba(14,14,14,1) 100%); /* FF3.6-15 */
        background: -webkit-radial-gradient(center, ellipse cover,  rgba(125,126,125,1) 0%,rgba(14,14,14,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: radial-gradient(ellipse at center,  rgba(125,126,125,1) 0%,rgba(14,14,14,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7d7e7d', endColorstr='#0e0e0e',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

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

    .ama2{
        background: -moz-linear-gradient(90deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #FFFCD9), color-stop(78%, #FFFCD9), color-stop(92%, #1EFF00), color-stop(100%, #1EFF00)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* ie10+ */
        background: linear-gradient(0deg, #1EFF00 0%, #1EFF00 8%, #FFFCD9 22%, #FFFCD9 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#FFFCD9', endColorstr='#1EFF00',GradientType=0 ); /* ie6-9 */
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

    .roge{
        background: -moz-linear-gradient(90deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #E3E8FA), color-stop(78%, #E3E8FA), color-stop(92%, #FF0505), color-stop(100%, #FF0505)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* ie10+ */
        background: linear-gradient(0deg, #FF0505 0%, #FF0505 8%, #E3E8FA 22%, #E3E8FA 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#E3E8FA', endColorstr='#FF0505',GradientType=0 ); /* ie6-9 */
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
        background: -moz-linear-gradient(90deg, #9E634A 0%, #9E634A 12%, #FFDCB5 21%, #FFDCB5 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #FFDCB5), color-stop(79%, #FFDCB5), color-stop(88%, #9E634A), color-stop(100%, #9E634A)); /* safari4+,chrome */
        background: -webkit-linear-gradient(90deg, #9E634A 0%, #9E634A 12%, #FFDCB5 21%, #FFDCB5 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(90deg, #9E634A 0%, #9E634A 12%, #FFDCB5 21%, #FFDCB5 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(90deg, #9E634A 0%, #9E634A 12%, #FFDCB5 21%, #FFDCB5 100%); /* ie10+ */
        background: linear-gradient(0deg, #9E634A 0%, #9E634A 12%, #FFDCB5 21%, #FFDCB5 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#FFDCB5', endColorstr='#9E634A',GradientType=0 ); /* ie6-9 */
    }

    .gris3{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#d2dfed+0,c8d7eb+26,bed0ea+51,a6c0e3+51,afc7e8+62,bad0ef+75,99b5db+88,799bc8+100;Grey+Blue+Gloss+%231 */
        background: rgb(210,223,237); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(210,223,237,1) 0%, rgba(200,215,235,1) 26%, rgba(190,208,234,1) 51%, rgba(166,192,227,1) 51%, rgba(175,199,232,1) 62%, rgba(186,208,239,1) 75%, rgba(153,181,219,1) 88%, rgba(121,155,200,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(210,223,237,1) 0%,rgba(200,215,235,1) 26%,rgba(190,208,234,1) 51%,rgba(166,192,227,1) 51%,rgba(175,199,232,1) 62%,rgba(186,208,239,1) 75%,rgba(153,181,219,1) 88%,rgba(121,155,200,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(210,223,237,1) 0%,rgba(200,215,235,1) 26%,rgba(190,208,234,1) 51%,rgba(166,192,227,1) 51%,rgba(175,199,232,1) 62%,rgba(186,208,239,1) 75%,rgba(153,181,219,1) 88%,rgba(121,155,200,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d2dfed', endColorstr='#799bc8',GradientType=0 ); /* IE6-9 */

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

    .oliveti{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f2f6f8+0,d8e1e7+50,b5c6d0+82,e0eff9+100 */
        background: rgb(242,246,248); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(242,246,248,1) 0%, rgba(216,225,231,1) 50%, rgba(181,198,208,1) 82%, rgba(224,239,249,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(242,246,248,1) 0%,rgba(216,225,231,1) 50%,rgba(181,198,208,1) 82%,rgba(224,239,249,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(242,246,248,1) 0%,rgba(216,225,231,1) 50%,rgba(181,198,208,1) 82%,rgba(224,239,249,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f6f8', endColorstr='#e0eff9',GradientType=0 ); /* IE6-9 */

    }


    .orangered{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#e5361b+20,ed9017+95 */
        background: rgb(229,54,27); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(229,54,27,1) 20%, rgba(237,144,23,1) 95%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(229,54,27,1) 20%,rgba(237,144,23,1) 95%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(229,54,27,1) 20%,rgba(237,144,23,1) 95%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e5361b', endColorstr='#ed9017',GradientType=0 ); /* IE6-9 */

    }

    .olivo{

        background: rgba(98,125,77,0.59);
        background: -moz-linear-gradient(top, rgba(98,125,77,0.59) 37%, rgba(31,59,8,0.59) 78%, rgba(31,59,8,0.59) 82%, rgba(31,59,8,1) 94%);
        background: -webkit-gradient(left top, left bottom, color-stop(37%, rgba(98,125,77,0.59)), color-stop(78%, rgba(31,59,8,0.59)), color-stop(82%, rgba(31,59,8,0.59)), color-stop(94%, rgba(31,59,8,1)));
        background: -webkit-linear-gradient(top, rgba(98,125,77,0.59) 37%, rgba(31,59,8,0.59) 78%, rgba(31,59,8,0.59) 82%, rgba(31,59,8,1) 94%);
        background: -o-linear-gradient(top, rgba(98,125,77,0.59) 37%, rgba(31,59,8,0.59) 78%, rgba(31,59,8,0.59) 82%, rgba(31,59,8,1) 94%);
        background: -ms-linear-gradient(top, rgba(98,125,77,0.59) 37%, rgba(31,59,8,0.59) 78%, rgba(31,59,8,0.59) 82%, rgba(31,59,8,1) 94%);
        background: linear-gradient(to bottom, rgba(98,125,77,0.59) 37%, rgba(31,59,8,0.59) 78%, rgba(31,59,8,0.59) 82%, rgba(31,59,8,1) 94%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#627d4d', endColorstr='#1f3b08', GradientType=0 );
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


    .wdw1{


        background: -moz-linear-gradient(271deg, #AC1B29 0%, #AC1B29 12%, #ffffff 51%, #ffffff 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #AC1B29), color-stop(12%, #AC1B29), color-stop(51%, #ffffff), color-stop(100%, #ffffff)); /* safari4+,chrome */
        background: -webkit-linear-gradient(271deg, #AC1B29 0%, #AC1B29 12%, #ffffff 51%, #ffffff 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(271deg, #AC1B29 0%, #AC1B29 12%, #ffffff 51%, #ffffff 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(271deg, #AC1B29 0%, #AC1B29 12%, #ffffff 51%, #ffffff 100%); /* ie10+ */
        background: linear-gradient(179deg, #AC1B29 0%, #AC1B29 12%, #ffffff 51%, #ffffff 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#AC1B29', endColorstr='#ffffff',GradientType=0 ); /* ie6-9 */
    }

    .kspc{


        background: -moz-linear-gradient(271deg, #33449C 0%, #33449C 12%, #ffffff 51%, #ffffff 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #33449C), color-stop(12%, #33449C), color-stop(51%, #ffffff), color-stop(100%, #ffffff)); /* safari4+,chrome */
        background: -webkit-linear-gradient(271deg, #33449C 0%, #33449C 12%, #ffffff 51%, #ffffff 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(271deg, #33449C 0%, #33449C 12%, #ffffff 51%, #ffffff 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(271deg, #33449C 0%, #33449C 12%, #ffffff 51%, #ffffff 100%); /* ie10+ */
        background: linear-gradient(179deg, #33449C 0%, #33449C 12%, #ffffff 51%, #ffffff 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#33449C', endColorstr='#ffffff',GradientType=0 ); /* ie6-9 */
    }

    .wphol{

        background: -moz-linear-gradient(271deg, #FF5E00 0%, #FF5E00 12%, #ffffff 51%, #ffffff 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #F77423), color-stop(12%, #F77423), color-stop(51%, #ffffff), color-stop(100%, #ffffff)); /* safari4+,chrome */
        background: -webkit-linear-gradient(271deg, #FF5E00 0%, #FF5E00 12%, #ffffff 51%, #ffffff 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(271deg, #FF5E00 0%, #FF5E00 12%, #ffffff 51%, #ffffff 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(271deg, #FF5E00 0%, #FF5E00 12%, #ffffff 51%, #ffffff 100%); /* ie10+ */
        background: linear-gradient(179deg, #FF5E00 0%, #FF5E00 12%, #ffffff 51%, #ffffff 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#F77423', endColorstr='#ffffff',GradientType=0 ); /* ie6-9 */
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

    .descuentos{

        background: -moz-linear-gradient(270deg, #ff0000 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #ff0000 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ff0000), color-stop(16%, #FFFFFF), color-stop(50%, #ffffff), color-stop(83%, #FFFFFF), color-stop(100%, #ff0000)); /* safari4+,chrome */
        background: -webkit-linear-gradient(270deg, #ff0000 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #ff0000 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(270deg, #ff0000 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #ff0000 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(270deg, #ff0000 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #ff0000 100%); /* ie10+ */
        background: linear-gradient(180deg, #ff0000 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #ff0000 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff0000', endColorstr='#ff0000',GradientType=0 ); /* ie6-9 */


    }

    .extracargos{
        background: -moz-linear-gradient(270deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* ff3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #008080), color-stop(16%, #FFFFFF), color-stop(50%, #ffffff), color-stop(83%, #FFFFFF), color-stop(100%, #005757)); /* safari4+,chrome */
        background: -webkit-linear-gradient(270deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* safari5.1+,chrome10+ */
        background: -o-linear-gradient(270deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* opera 11.10+ */
        background: -ms-linear-gradient(270deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* ie10+ */
        background: linear-gradient(180deg, #008080 0%, #FFFFFF 16%, #ffffff 50%, #FFFFFF 83%, #005757 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#008080', endColorstr='#005757',GradientType=0 ); /* ie6-9 */

    }

    .ui-widget-header {
        /* border: 1px solid #333333; */
        /*background: #0086cc;*/
        background: #c00;
        color: #ffffff;
        font-weight: bold;
        border-radius: 6px 6px 0px 0px !important;
        font-family: bebasbook;
    }

    .ui-dialog {
        position: absolute;
        top: 80px;
        left: 676px;
        padding: .2em;
        outline: 0;
    }

    .oliverty{
        border: 2px solid #fff;
        border-radius: 9px 9px 2px 2px;
        background-image: url(../../../global/img/confirm.png);  
        width: 149px;
        height: 30px;
        font-size: 17px;
        font-weight: bold;
        font-style: Normal;
        color: white;
        background-position: 0px 0px;
        background-repeat: repeat-x;
        padding: 0;
        margin-left: 797px;
        margin-top: -83px;
        position: absolute;
        filter: hue-rotate(1137deg);
    }

    @keyframes animatedBackgroundButton {
        from { background-position: 0 0; }
        to { background-position: 100% 0; }
    }

    .oliverty:hover{
        animation: animatedBackgroundButton 1s linear infinite;
        -moz-filter:hue-rotate(-350deg);
        -webkit-filter:hue-rotate(-350deg);
        -o-filter:hue-rotate(-350deg);
        -ms-filter:hue-rotate(-350deg);
        filter:hue-rotate(-350deg);

    }
    

    .rojo{ 
        background: #bf1b04; 
        box-shadow: 0px 0px 0 #8F1502; 
    }
    
    
    

    .button_sliding_bg {
        color: #fff;
        background: #006394;
        padding: 12px 17px;
        margin: 25px;
        font-family: 'OpenSansBold', sans-serif;
        border: 2px solid #31302B;
        font-size: 14px;
        font-weight: bold;
        letter-spacing: 1px;
        text-transform: uppercase;
        border-radius: 2px;
        display: inline-block;
        text-align: center;
        cursor: pointer;
        box-shadow: inset 0 0 0 0 #31302B;
        -webkit-transition: all ease 0.8s;
        -moz-transition: all ease 0.8s;
        transition: all ease 0.8s;
    }
    .button_sliding_bg:hover {
        box-shadow: inset 0 100px 0 0 #E21F26;
        color: #fff;
    }

    ul.tabs {

    margin: 0;

    padding: 0;

    float: left;

    list-style: none;

    height: 32px; /*--Define el ancho de las tabs--*/

    border-bottom: 1px solid #999;

    border-left: 1px solid #999;

    width: 40%;

    }

    ul.tabs li {

    float: left;

    margin: 0;

    padding: 0;

    height: 31px; /*--Sustrae 1px de la altura de la lista desordenada--*/

    line-height: 31px; /*--Alineamiento vertical del texto dentro de la tabla--*/

    border: 1px solid #999;
    
    border-radius: 5px 5px 0px 0px !important;

    border-left: none;

    margin-bottom: -1px; /*--Desplaza los item de la lista abajo 1px--*/

    overflow: hidden;

    position: relative;

    background: #E21F26;

    }

    ul.tabs li a {

    text-decoration: none;

    color: #fff;

    display: block;

    font-size: 1.2em;

    padding: 0 20px;

    border: 2px solid #fff;
    
    border-radius: 5px 5px 0px 0px !important;

    outline: none;

    }

    ul.tabs li a:hover {

    background: #006394;

    }

    html ul.tabs li.active, html ul.tabs li.active a:hover  { /*--Estate seguro de que a la tab activa no se le aplicarán estas propiedades hover--*/

    background: #fff;

    border-bottom: 1px solid #fff; /*--Esto hace que la tab activa esté conectada con respecto a su contenido--*/

    }
    
    .tab_container {

    border: 1px solid #999;

    border-top: none;

    overflow: hidden;

    clear: both;

    float: left; width: 40%;

    background: #fff;

    }

    .tab_content {

    padding: 20px;

    font-size: 1.2em;

    }
    
    /**********************************************/

    
    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
    }

    h2 {
        font-size: 1.1em;
        margin-top: 2em;
        text-align: center;
    }

    main {
        width: 40%;
        margin: auto;
    }
/*height: 103%;*/
    #modal {
        background: rgba(0, 0, 0, 0.9);
        opacity: 0.16;
        filter: alpha(opacity=100);
        color: #fff;
        position: absolute;
        top: 9%;
        left: 12.8%;
        height: 235%;
        width: 74.5%;
        transition: all .5s;
    }
    #modal p {
        width: 60%;
        height: 40%;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        margin: auto;
        font-size: 1.5em;
        text-align: center;
    }

    #mostrar-modal {
        display: none;
    }
    #mostrar-modal + label {
        background: steelblue;
        display: table;
        margin: auto;
        height:14px;
        color: #fff;
        line-height: 2;
        padding: 0 1em;
        text-transform: uppercase;
        cursor: pointer;
    }
    #mostrar-modal + label:hover {
        background: #38678f;
    }
    #mostrar-modal:checked ~ #modal {
        top: 1399px;
    }
    #mostrar-modal:checked ~ #cerrar-modal + label {
        display: block;
        left: 70em;
        margin-top: -248px;
    }

    #cerrar-modal {
        display: none;
    }
    #cerrar-modal + label {
        position: fixed;
        top: 33em;
        right: 208em;
        z-index: 100;
        color: #fff;
        /*  font-weight: bold;*/
        cursor: pointer;
        background: tomato;
        width: 68px;
        height: 25px;
        line-height: 27px;
        text-align: center;
        border-radius: 0%;
        display: none;
        transition: all .5s;
    }
    #cerrar-modal:checked ~ #modal {
        top: 9%;
    }
    #cerrar-modal:checked + label {
        display: none;
    }


    .flotante {
        display:scroll;
        position:fixed;
        bottom:40.5%;
        right:87.7%;
        top:-16.8%;
    }
    
    .flashit{
        
    color:#f2f;
            -webkit-animation: flash linear 0.4s infinite;
            animation: flash linear 0.4s infinite;
    }
    @-webkit-keyframes flash {
            0% { opacity: 1; } 
            50% { opacity: .6 } 
            100% { opacity: 1; }
    }
    @keyframes flash {
            0% { opacity: 1; } 
            50% { opacity: .6; } 
            100% { opacity: 1; }
    }

    .flashit2{

        color:#f2f;
                -webkit-animation: flash linear 0.4s infinite;
                animation: flash linear 0.4s infinite;
        }
        @-webkit-keyframes flash {
                0% { opacity: 1; } 
                50% { opacity: .6 } 
                100% { opacity: 1; }
        }
        @keyframes flash {
                0% { opacity: 1; } 
                50% { opacity: .6; } 
                100% { opacity: 1; }
    }



</style>

<script>
    $(function () {
        function mostrarPagos(left, top) {

            $("#dialog2").dialog({
                autoOpen: false,
                width: 580,
                height: 150,
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
            $("#dialog2").dialog("open");
        }
        $("#btn-pagos").click(function () {
            var posicion = $(this).position();
            mostrarPagos(posicion.left, posicion.top);
        });

    });
</script>

<?php if (isset($_GET['menssage'])) { ?>
    <div class="success"><?php echo $_GET['menssage']; ?></div>
<?php } ?>
<?php if (isset($_GET['error'])) { ?>
    <div class="error"><?php echo $_GET['error']; ?></div>
<?php } ?>
    
<?php
     
    $estado_onetour = $data['tour']->estado;
    $starting_date = $data['tour']->starting_date;
    $ending_date = $data['tour']->ending_date;     
    $fecha = $starting_date;
    $adultos = $data['tour']->adult;
    $ninos = $data['tour']->child;
    $fecha_crea = $data['tour']->creation_date;  
    
    $total_pasajeros = $adultos + $ninos;
    $balance_due =  $data['tour']->passenger_balance_due;
    $id_oneday = $data['tour']->id;
    $tipo_reserva = "oneday";
    
    
    
    $include_park = $data['tour']->include_park;
    //echo  $include_park;
       
    
    
    if($estado_onetour == 'INVOICED'){
        
        $id_onetour = $data['tour']->id;
        
        $sql = "SELECT id_factura FROM facturaservicio WHERE id_servicio = '$id_onetour' AND tipo_servicio = 'ONE'";
        $rs = Doo::db()->query($sql);
        $factura = $rs->fetchAll();

        foreach ($factura as $fact) {

        }

        $invoice_no =  $fact['id_factura'];
        $sql2 = "SELECT creation_date FROM factura WHERE id = $invoice_no";
        $rs2 = Doo::db()->query($sql2);
        $fecha = $rs2->fetchAll();

        foreach ($fecha as $fec) {

        }

        $fecha_factura =  $fec['creation_date'];
    
    
    }
    
?> 


    
<div id="header_page" style="background-image: url('<?php echo $data['rootUrl'] ?>global/img/bg2.jpg');" >
    <div class="header">One Day Tours [ Edit ] ID <?php echo $data['tour']->id; ?>            
        <input id="myTextarea" hidden value="<?php echo $data['tour']->id; ?>">
        <p id="demo"></p>

        <?php
        
//        $suma = $_POST["sum"];      
//        print($suma);
        
        $onetour_id = $data['tour']->id;
        $parque_incluido = $data['tour']->include_park;
        //print($include_park);
        
        
        $pagado = $data['pagado'];
//print($pagado);
        $pagado_sinCargo = ($pagado / 1.04);
//cargo al pago con credit card
        $CargoCC = $pagado - $pagado_sinCargo;

        $totaltotalfull = $data['tour']->total;
        $id_reserva = $data['tour']->id_reserva;
        $op_pago_conductor = $data['tour']->op_pago_conductor;
        

        $id = $data['pickup']->id;
        $place = $data['pickup']->place;
        $address = $data['pickup']->address;

        $placedrop = $data['dropoff']->place;
        $addressdrop = $data['dropoff']->address;
        
        Doo::db()->query("UPDATE attraction_trafic SET  admission = '$parque_incluido'  WHERE id_tours = '$onetour_id' AND type_tour = 'ONE'");
        
        $sql_atrac = "SELECT id from attraction_trafic  WHERE id_tours = '$onetour_id' AND type_tour = 'ONE'";
        $rs_atr = Doo::db()->query($sql_atrac);
        $id_atract = $rs_atr->fetchAll();
        
        foreach ($id_atract as $idat){
            $id_atr = $idat['id'];
        }
        
        //print($id_atr);
        
        
        
        Doo::db()->query("UPDATE traffic_report SET  id_attraction_trafic = '$id_atr'  WHERE id_tour = '$onetour_id' AND type_tour = 'ONE'");
        
        
        
        /*FLOOR (REDONDEA) PCCWF (PAGOS PREPAGO CON CREDIT CARD WITH FEE)*/
        $sqlpp = "SELECT SUM(pagado) AS PCCWF FROM tours_pago WHERE id_tours = $onetour_id AND pago='CREDIT CARD WITH FEE' AND tipo_pago='PRED-PAID' AND tipo='ONE'";
        $rspp = Doo::db()->query($sqlpp);
        $pagosccwf = $rspp->fetchAll();

    //                    print($pagosprep);
        foreach ($pagosccwf as $pccwf) {
    //                        print($ppr['PAGPRED']);
        }
        $pago_ccwf = $pccwf['PCCWF']; 
        $pago_sinccwf = ($pccwf['PCCWF']) / 1.04;
        $cargos1 = $pago_ccwf - $pago_sinccwf;
        $cargospp = number_format($cargos1, 2, '.', '');

        //print($cargospp);
        
        //////////////////////////////////////////////////////////////////
        
        /*FLOOR (REDONDEA) PCCWF (PAGOS COLLECT ON BOARD CON CREDIT CARD WITH FEE)*/
        $sqlcob = "SELECT SUM(pagado) AS PCOB FROM tours_pago WHERE id_tours = $onetour_id AND pago='CREDIT CARD WITH FEE' AND tipo_pago='COLLECT ON BOARD' AND tipo='ONE'";
        $rscob = Doo::db()->query($sqlcob);
        $pagoscob = $rscob->fetchAll();

    //                    print($pagosprep);
        foreach ($pagoscob as $pcob) {
    //                        print($ppr['PAGPRED']);
        }
        $pago_cob = $pcob['PCOB']; 
        $pago_sincccob = ($pcob['PCOB']) / 1.04;
        $cargos2 = $pago_cob - $pago_sincccob;
        $cargoscob = number_format($cargos2, 2, '.', '');

        //print($cargoscob);

        //////////////////////FROMT///////////////////////////////////////
        $sql5 = "SELECT fromt AS DESDE FROM reservas WHERE id=$id_reserva";
        $rs5 = Doo::db()->query($sql5);
        $rutas = $rs5->fetchAll();

        //print($pagosprep);
        foreach ($rutas as $rut) {
            //print($ppr['PAGPRED']);
        }

        //////////////////////////////////////
        $fromt = $rut['DESDE'];
        //////////////////////////////////////
        //print($fromt);
        $tot = 1;
        ///////////////////////////////////////////////////////////////////
        ////////////////////////TOT2///////////////////////////////////////
        $sql6 = "SELECT tot2 AS HASTA FROM reservas WHERE id=$id_reserva";
        $rs6 = Doo::db()->query($sql6);
        $rutas2 = $rs6->fetchAll();

        //print($pagosprep);
        foreach ($rutas2 as $rut2) {
            //print($ppr['PAGPRED']);
        }
        //////////////////////////////////////
        $tot2 = $rut2['HASTA'];
        /////////////////////////////////////
        //print($tot2);
        $fromt2 = 1;
        /////////////////////////////////////////////////////////////////////
        ////////////////////////PICK1///////////////////////////////////////
        $sql7 = "SELECT pickup1 AS PICK FROM reservas WHERE id=$id_reserva";
        $rs7 = Doo::db()->query($sql7);
        $pick1 = $rs7->fetchAll();

        //print($pagosprep);
        foreach ($pick1 as $pickup) {
            //print($ppr['PAGPRED']);
        }
        //////////////////////////////////////
        $a_id_pickup1 = $pickup['PICK'];
        /////////////////////////////////////
        //print($a_id_pickup1);
        /////////////////////////////////////////////////////////////////////
        ////////////////////////DROPOFF2///////////////////////////////////////
        $sql8 = "SELECT dropoff2 AS DROPOFF FROM reservas WHERE id=$id_reserva";
        $rs8 = Doo::db()->query($sql8);
        $dropoff2 = $rs8->fetchAll();

        //print($pagosprep);
        foreach ($dropoff2 as $dropoff) {
            //print($ppr['PAGPRED']);
        }
        //////////////////////////////////////
        $d_id_pickup1 = $dropoff['DROPOFF'];
        /////////////////////////////////////
        //print($d_id_pickup1);
        /////////////////////////////////////////////////////////////////////


        $pickup1 = $place . ' ' . $address;
        $dropoff1 = $placedrop . ' ' . $addressdrop;
//        print($pickup1);
//        print($dropoff1);
        //print($address);
        //echo $CargoCC;
        
        $id_one_tour = $data['tour']->id;
        
        $sql10 = "SELECT estado_one, estado_round, fecha_retorno FROM reservas WHERE id_tours = $id_one_tour ";
        $rs10 = Doo::db()->query($sql10);
        $estados = $rs10->fetchall();

        foreach ($estados as $est){

        }

//        $estado_transf_in = $est['estado_one'];
        $estado_transf_out = $est['estado_round'];
        //print($estado_transf_out);
        $fecha_retorno_reservas = $est['fecha_retorno'];
        //print($fecha_retorno_reservas);
        
        //echo $data['agency']->id;
        
        $idagencia = $data['agency']->id;
        //print($idagencia);
        $sql44 = "SELECT acount,opcion1,opcion2,opcion3,opcion4,opcion5,days FROM agency_account WHERE id_agencia = '$idagencia' ";
        $rs44 = Doo::db()->query($sql44);
        $opcion = $rs44->fetchAll();


        foreach ($opcion as $opc) {

        }
        $voucher = $opc['opcion5']; 
 
        //301
        $trip301 = 301;
                        
                        $sqlrtp301 = "SELECT SUM(cantidad)as CANTIDAD from reservas_trip_puestos where fecha_trip= '$fecha' AND trip_to = '$trip301' AND (tipo = '1' OR tipo = '2') AND (estado='USING' OR estado='RENEWED')";
                        $rsrtp301 = Doo::db()->query($sqlrtp301);
                        $puestosocupados301 = $rsrtp301->fetchAll();    

                        foreach ($puestosocupados301 as $po301){

                            $puestos_ocupados301 = $po301['CANTIDAD'];
                            
                        }

                        $sqlcap_301 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5 FROM routes WHERE fecha_ini = '$fecha' AND fecha_fin = '$fecha'  AND trip_no = '$trip301' ";
                        $rscap_301 = Doo::db()->query($sqlcap_301);
                        $capac_301 = $rscap_301->fetchAll();


                        foreach ($capac_301 as $cap301) {
                            
                        }

                        $capacidad1_301 = $cap301['capacity'];
                        $capacidad2_301 = $cap301['capacity2'];
                        $capacidad3_301 = $cap301['capacity3'];
                        $capacidad4_301 = $cap301['capacity4'];
                        $capacidad5_301 = $cap301['capacity5'];

                        $capacidad301 = $capacidad1_301 + $capacidad2_301 + $capacidad3_301 + $capacidad4_301 + $capacidad5_301;


                        //tarifa standard
                        $sql_stdida301 = "SELECT (sum(pax) + sum(pax2))as tari_std
                        FROM  reservas 
                        Where trip_no = '$trip301' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rs_stdida301 = Doo::db()->query($sql_stdida301, array($trip301, $fecha));
                        $r_stdida301 = $rs_stdida301->fetchAll();
                        $std_seats_ida301 = $r_stdida301[0]['tari_std'] ? $r_stdida301[0]['tari_std'] : 0;



                        $sql_stdretorno301 = "SELECT (sum(pax) + sum(pax2))as tari_std
                                            FROM  reservas 
                                            Where trip_no2 = '$trip301' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rs_stdretorno301 = Doo::db()->query($sql_stdretorno301, array($trip301, $fecha));
                        $r_stdretorno301 = $rs_stdretorno301->fetchAll();
                        $std_seats_retorno301 = $r_stdretorno301[0]['tari_std'] ? $r_stdretorno301[0]['tari_std'] : 0;

                        $standard_total301 = $std_seats_ida301 + $std_seats_retorno301;

                        //echo $standard_total;
                        //tarifa superflex
                        $sqlflexida301 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                        FROM  reservas 
                        Where trip_no = '$trip301' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rsflexida301 = Doo::db()->query($sqlflexida301, array($trip301, $fecha));
                        $r_flexida301 = $rsflexida301->fetchAll();
                        $superflex_seats_ida301 = $r_flexida301[0]['tari_flex'] ? $r_flexida301[0]['tari_flex'] : 0;

                        $sqlflexretorno301 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                                            FROM  reservas 
                                            Where trip_no2 = '$trip301' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rsflexretorno301 = Doo::db()->query($sqlflexretorno301, array($trip301, $fecha));
                        $r_flexretorno301 = $rsflexretorno301->fetchAll();
                        $superflex_seats_retorno301 = $r_flexretorno301[0]['tari_flex'] ? $r_flexretorno301[0]['tari_flex'] : 0;

                        $superflex_total301 = $superflex_seats_ida301 + $superflex_seats_retorno301;

                        //echo $superflex_total;
                        //webfare
                        $sqlwebida301 = "SELECT (sum(pax) + sum(pax2))as webfare
                        FROM  reservas 
                        Where trip_no = '$trip301' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rswebida301 = Doo::db()->query($sqlwebida301, array($trip301, $fecha));
                        $r_webida301 = $rswebida301->fetchAll();
                        $webfare_ida301 = $r_webida301[0]['webfare'] ? $r_webida301[0]['webfare'] : 0;

                        $sqlwebretorno301 = "SELECT (sum(pax) + sum(pax2))as webfare
                                            FROM  reservas 
                                            Where trip_no2 = '$trip301' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rswebretorno301 = Doo::db()->query($sqlwebretorno301, array($trip301, $fecha));
                        $r_webretorno301 = $rswebretorno301->fetchAll();
                        $webfare_retorno301 = $r_webretorno301[0]['webfare'] ? $r_webretorno301[0]['webfare'] : 0;

                        $webfare_total301 = $webfare_ida301 + $webfare_retorno301;

                        //echo $webfare_total;
                        //superpromo
                        $sqlspromoida301 = "SELECT (sum(pax) + sum(pax2))as spromo
                        FROM  reservas 
                        Where trip_no = '$trip301' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rsspromoida301 = Doo::db()->query($sqlspromoida301, array($trip301, $fecha));
                        $r_spromoida301 = $rsspromoida301->fetchAll();
                        $superpromo_ida301 = $r_spromoida301[0]['spromo'] ? $r_spromoida301[0]['spromo'] : 0;

                        $sqlspromoretorno301 = "SELECT (sum(pax) + sum(pax2))as webfare
                                            FROM  reservas 
                                            Where trip_no2 = '$trip301' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rsspromoretorno301 = Doo::db()->query($sqlspromoretorno301, array($trip301, $fecha));
                        $r_spromoretorno301 = $rsspromoretorno301->fetchAll();
                        $superpromo_retorno301 = $r_spromoretorno301[0]['spromo'] ? $r_spromoretorno301[0]['spromo'] : 0;

                        $superpromo_total301 = $superpromo_ida301 + $superpromo_retorno301;

                        //echo $superpromo_total;
                        //superdiscount
                        $sqlsdiscida301 = "SELECT (sum(pax) + sum(pax2))as sdisc
                        FROM  reservas 
                        Where trip_no = '$trip301' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rsdiscida301 = Doo::db()->query($sqlsdiscida301, array($trip301, $fecha));
                        $r_discida301 = $rsdiscida301->fetchAll();
                        $superdisc_ida301 = $r_discida301[0]['sdisc'] ? $r_discida301[0]['sdisc'] : 0;

                        $sqlsdiscretorno301 = "SELECT (sum(pax) + sum(pax2))as sdisc
                                            FROM  reservas 
                                            Where trip_no2 = '$trip301' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rssdiscretorno301 = Doo::db()->query($sqlsdiscretorno301, array($trip301, $fecha));
                        $r_discretorno301 = $rssdiscretorno301->fetchAll();
                        $superdisc_retorno301 = $r_discretorno301[0]['sdisc'] ? $r_discretorno301[0]['sdisc'] : 0;

                        $superdiscount_total301 = $superdisc_ida301 + $superdisc_retorno301;

                        //echo $superdiscount_total;
                        //tours
                        //De Ida
                        $sqlTourIda301 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                            FROM  reservas 
                                            Where trip_no = '$trip301' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rstida301 = Doo::db()->query($sqlTourIda301, array($trip301, $fecha));
                        $r_tida301 = $rstida301->fetchAll();
                        $ocupadas_tour_ida301 = $r_tida301[0]['ocupadas_tour'] ? $r_tida301[0]['ocupadas_tour'] : 0;



                        //De Retorno
                        $sqlTourReturn301 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                            FROM  reservas 
                                            Where trip_no2 = '$trip301' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rstreturn301 = Doo::db()->query($sqlTourReturn301, array($trip301, $fecha));
                        $r_treturn301 = $rstreturn301->fetchAll();
                        $ocupadas_tour_return301 = $r_treturn301[0]['ocupadas_tour'] ? $r_treturn301[0]['ocupadas_tour'] : 0;


                        $tours_total301 = $ocupadas_tour_ida301 + $ocupadas_tour_return301;

//                      echo $tours_total;
                        //SPECIAL/////////////////////////////////////////////////////////////////

                        $sql_spcida301 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                            FROM  reservas 
                                            Where trip_no = '$trip301' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rs_spcida301 = Doo::db()->query($sql_spcida301, array($trip301, $fecha));
                        $r_spcida301 = $rs_spcida301->fetchAll();
                        $spc_seats_ida301 = $r_spcida301[0]['tari_spc'] ? $r_spcida301[0]['tari_spc'] : 0;



                        $sql_spcretorno301 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                            FROM  reservas 
                                            Where trip_no2 = '$trip301' AND fecha_retorno = '$fecha' AND id2 = '7' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rs_spcretorno301 = Doo::db()->query($sql_spcretorno301, array($trip301, $fecha));
                        $r_spcretorno301 = $rs_spcretorno301->fetchAll();
                        $spc_seats_retorno301 = $r_spcretorno301[0]['tari_spc'] ? $r_spcretorno301[0]['tari_spc'] : 0;

                        $special_total301 = $spc_seats_ida301 + $spc_seats_retorno301;

                        //echo $special_total;

                        $ocupadas301 = $standard_total301 + $superflex_total301 + $webfare_total301 + $superpromo_total301 + $superdiscount_total301 + $tours_total301 + $special_total301;
                        //$seats_remain301 = $capacidad301 - $ocupadas301;
                        $seats_remain301 = ($capacidad301 - $ocupadas301)-($puestos_ocupados301);
                        
                        //echo $seats_remain;
                        //Routes

                        $sqlRoute301 = "SELECT spseats, sdseats, wfseats, stseats, sflexseats, spprcseats, toursseats   FROM  routes
                                            Where trip_no = '$trip301' AND fecha_ini = '$fecha' ";
                        $rsro301 = Doo::db()->query($sqlRoute301, array($trip301, $fecha));
                        $r_route301 = $rsro301->fetchAll();
                        $spromo_seats301 = $r_route301[0]['spseats'] ? $r_route301[0]['spseats'] : 0;
                        $sd_seats301 = $r_route301[0]['sdseats'] ? $r_route301[0]['sdseats'] : 0;
                        //$wf_seats = $r_route[0]['wfseats'] ? $r_route[0]['wfseats'] : 0;
                        //$st_seats = $r_route[0]['stseats'] ? $r_route[0]['stseats'] : 0;


                        $sflex_seats301 = $r_route301[0]['sflexseats'] ? $r_route301[0]['sflexseats'] : 0;

                        $st_seats301 = $capacidad301 - $sflex_seats301;
                        $wf_seats301 = $capacidad301 - $sflex_seats301;

                        $special_seats301 = $r_route301[0]['spprcseats'] ? $r_route301[0]['spprcseats'] : 0;
                        $tours_seats301 = $r_route301[0]['toursseats'] ? $r_route301[0]['toursseats'] : 0;

                        $remain_tours301 = $superpromo_total301 + $superdiscount_total301 + $webfare_total301 + $standard_total301 + $superflex_total301 + $special_total301 + $tours_total301;

                        $tot_remain_tours301 = $capacidad301 - $remain_tours301;

                        $result_special_prices301 = $tot_remain_tours301;

                        $result_tours301 = $tot_remain_tours301;
                        
                        //300
                        
                        $trip300 = 300;
                        
                        $sqlrtp300 = "SELECT SUM(cantidad)as CANTIDAD from reservas_trip_puestos where fecha_trip= '$fecha' AND trip_to = '$trip300' AND (tipo = '1' OR tipo = '2') AND (estado='USING' OR estado='RENEWED')";
                        $rsrtp300 = Doo::db()->query($sqlrtp300);
                        $puestosocupados300 = $rsrtp300->fetchAll();    

                        foreach ($puestosocupados300 as $po300){

                            $puestos_ocupados300 = $po300['CANTIDAD'];
                        }

                        
                        $sqlcap_300 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5 FROM routes WHERE fecha_ini = '$fecha' AND fecha_fin = '$fecha'  AND trip_no = '$trip300' ";
                        $rscap_300 = Doo::db()->query($sqlcap_300);
                        $capac_300 = $rscap_300->fetchAll();


                        foreach ($capac_300 as $cap300) {
                            
                        }

                        $capacidad1_300 = $cap300['capacity'];
                        $capacidad2_300 = $cap300['capacity2'];
                        $capacidad3_300 = $cap300['capacity3'];
                        $capacidad4_300 = $cap300['capacity4'];
                        $capacidad5_300 = $cap300['capacity5'];

                        $capacidad300 = $capacidad1_300 + $capacidad2_300 + $capacidad3_300 + $capacidad4_300 + $capacidad5_300;


                        //tarifa standard
                        $sql_stdida300 = "SELECT (sum(pax) + sum(pax2))as tari_std
                        FROM  reservas 
                        Where trip_no = '$trip300' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rs_stdida300 = Doo::db()->query($sql_stdida300, array($trip300, $fecha));
                        $r_stdida300 = $rs_stdida300->fetchAll();
                        $std_seats_ida300 = $r_stdida300[0]['tari_std'] ? $r_stdida300[0]['tari_std'] : 0;



                        $sql_stdretorno300 = "SELECT (sum(pax) + sum(pax2))as tari_std
                                            FROM  reservas 
                                            Where trip_no2 = '$trip300' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rs_stdretorno300 = Doo::db()->query($sql_stdretorno300, array($trip300, $fecha));
                        $r_stdretorno300 = $rs_stdretorno300->fetchAll();
                        $std_seats_retorno300 = $r_stdretorno300[0]['tari_std'] ? $r_stdretorno300[0]['tari_std'] : 0;

                        $standard_total300 = $std_seats_ida300 + $std_seats_retorno300;

                        //echo $standard_total;
                        //tarifa superflex
                        $sqlflexida300 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                        FROM  reservas 
                        Where trip_no = '$trip300' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rsflexida300 = Doo::db()->query($sqlflexida300, array($trip300, $fecha));
                        $r_flexida300 = $rsflexida300->fetchAll();
                        $superflex_seats_ida300 = $r_flexida300[0]['tari_flex'] ? $r_flexida300[0]['tari_flex'] : 0;

                        $sqlflexretorno300 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                                            FROM  reservas 
                                            Where trip_no2 = '$trip300' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rsflexretorno300 = Doo::db()->query($sqlflexretorno300, array($trip300, $fecha));
                        $r_flexretorno300 = $rsflexretorno300->fetchAll();
                        $superflex_seats_retorno300 = $r_flexretorno300[0]['tari_flex'] ? $r_flexretorno300[0]['tari_flex'] : 0;

                        $superflex_total300 = $superflex_seats_ida300 + $superflex_seats_retorno300;

                        //echo $superflex_total;
                        //webfare
                        $sqlwebida300 = "SELECT (sum(pax) + sum(pax2))as webfare
                        FROM  reservas 
                        Where trip_no = '$trip300' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rswebida300 = Doo::db()->query($sqlwebida300, array($trip300, $fecha));
                        $r_webida300 = $rswebida300->fetchAll();
                        $webfare_ida300 = $r_webida300[0]['webfare'] ? $r_webida300[0]['webfare'] : 0;

                        $sqlwebretorno300 = "SELECT (sum(pax) + sum(pax2))as webfare
                                            FROM  reservas 
                                            Where trip_no2 = '$trip300' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rswebretorno300 = Doo::db()->query($sqlwebretorno300, array($trip300, $fecha));
                        $r_webretorno300 = $rswebretorno300->fetchAll();
                        $webfare_retorno300 = $r_webretorno300[0]['webfare'] ? $r_webretorno300[0]['webfare'] : 0;

                        $webfare_total300 = $webfare_ida300 + $webfare_retorno300;

                        //echo $webfare_total;
                        //superpromo
                        $sqlspromoida300 = "SELECT (sum(pax) + sum(pax2))as spromo
                        FROM  reservas 
                        Where trip_no = '$trip300' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rsspromoida300 = Doo::db()->query($sqlspromoida300, array($trip300, $fecha));
                        $r_spromoida300 = $rsspromoida300->fetchAll();
                        $superpromo_ida300 = $r_spromoida300[0]['spromo'] ? $r_spromoida300[0]['spromo'] : 0;

                        $sqlspromoretorno300 = "SELECT (sum(pax) + sum(pax2))as webfare
                                            FROM  reservas 
                                            Where trip_no2 = '$trip300' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rsspromoretorno300 = Doo::db()->query($sqlspromoretorno300, array($trip300, $fecha));
                        $r_spromoretorno300 = $rsspromoretorno300->fetchAll();
                        $superpromo_retorno300 = $r_spromoretorno300[0]['spromo'] ? $r_spromoretorno300[0]['spromo'] : 0;

                        $superpromo_total300 = $superpromo_ida300 + $superpromo_retorno300;

                        //echo $superpromo_total;
                        //superdiscount
                        $sqlsdiscida300 = "SELECT (sum(pax) + sum(pax2))as sdisc
                        FROM  reservas 
                        Where trip_no = '$trip300' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rsdiscida300 = Doo::db()->query($sqlsdiscida300, array($trip300, $fecha));
                        $r_discida300 = $rsdiscida300->fetchAll();
                        $superdisc_ida300 = $r_discida300[0]['sdisc'] ? $r_discida300[0]['sdisc'] : 0;

                        $sqlsdiscretorno300 = "SELECT (sum(pax) + sum(pax2))as sdisc
                                            FROM  reservas 
                                            Where trip_no2 = '$trip300' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rssdiscretorno300 = Doo::db()->query($sqlsdiscretorno300, array($trip300, $fecha));
                        $r_discretorno300 = $rssdiscretorno300->fetchAll();
                        $superdisc_retorno300 = $r_discretorno300[0]['sdisc'] ? $r_discretorno300[0]['sdisc'] : 0;

                        $superdiscount_total300 = $superdisc_ida300 + $superdisc_retorno300;

                        //echo $superdiscount_total;
                        //tours
                        //De Ida
                        $sqlTourIda300 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                            FROM  reservas 
                                            Where trip_no = '$trip300' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rstida300 = Doo::db()->query($sqlTourIda300, array($trip300, $fecha));
                        $r_tida300 = $rstida300->fetchAll();
                        $ocupadas_tour_ida300 = $r_tida300[0]['ocupadas_tour'] ? $r_tida300[0]['ocupadas_tour'] : 0;



                        //De Retorno
                        $sqlTourReturn300 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                                            FROM  reservas 
                                            Where trip_no2 = '$trip300' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rstreturn300 = Doo::db()->query($sqlTourReturn300, array($trip300, $fecha));
                        $r_treturn300 = $rstreturn300->fetchAll();
                        $ocupadas_tour_return300 = $r_treturn300[0]['ocupadas_tour'] ? $r_treturn300[0]['ocupadas_tour'] : 0;


                        $tours_total300 = $ocupadas_tour_ida300 + $ocupadas_tour_return300;

//                    echo $tours_total;
                        //SPECIAL/////////////////////////////////////////////////////////////////

                        $sql_spcida300 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                            FROM  reservas 
                                            Where trip_no = '$trip300' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rs_spcida300 = Doo::db()->query($sql_spcida300, array($trip300, $fecha));
                        $r_spcida300 = $rs_spcida300->fetchAll();
                        $spc_seats_ida300 = $r_spcida300[0]['tari_spc'] ? $r_spcida300[0]['tari_spc'] : 0;



                        $sql_spcretorno300 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                                            FROM  reservas 
                                            Where trip_no2 = '$trip300' AND fecha_retorno = '$fecha' AND id2 = '7' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
                        $rs_spcretorno300 = Doo::db()->query($sql_spcretorno300, array($trip300, $fecha));
                        $r_spcretorno300 = $rs_spcretorno300->fetchAll();
                        $spc_seats_retorno300 = $r_spcretorno300[0]['tari_spc'] ? $r_spcretorno300[0]['tari_spc'] : 0;

                        $special_total300 = $spc_seats_ida300 + $spc_seats_retorno300;

                        //echo $special_total;

                        $ocupadas300 = $standard_total300 + $superflex_total300 + $webfare_total300 + $superpromo_total300 + $superdiscount_total300 + $tours_total300 + $special_total300;
                        //$seats_remain300 = $capacidad300 - $ocupadas300;
                        $seats_remain300 = ($capacidad300 - $ocupadas300)-($puestos_ocupados300);
                        
                        //echo $seats_remain;
                        //Routes

                        $sqlRoute300 = "SELECT spseats, sdseats, wfseats, stseats, sflexseats, spprcseats, toursseats   FROM  routes
                                            Where trip_no = '$trip300' AND fecha_ini = '$fecha' ";
                        $rsro300 = Doo::db()->query($sqlRoute300, array($trip300, $fecha));
                        $r_route300 = $rsro300->fetchAll();
                        $spromo_seats300 = $r_route300[0]['spseats'] ? $r_route300[0]['spseats'] : 0;
                        $sd_seats300 = $r_route300[0]['sdseats'] ? $r_route300[0]['sdseats'] : 0;
                        //$wf_seats = $r_route[0]['wfseats'] ? $r_route[0]['wfseats'] : 0;
                        //$st_seats = $r_route[0]['stseats'] ? $r_route[0]['stseats'] : 0;


                        $sflex_seats300 = $r_route300[0]['sflexseats'] ? $r_route300[0]['sflexseats'] : 0;

                        $st_seats300 = $capacidad300 - $sflex_seats300;
                        $wf_seats300 = $capacidad300 - $sflex_seats300;

                        $special_seats300 = $r_route300[0]['spprcseats'] ? $r_route300[0]['spprcseats'] : 0;
                        $tours_seats300 = $r_route300[0]['toursseats'] ? $r_route300[0]['toursseats'] : 0;


                        $remain_tours300 = $superpromo_total300 + $superdiscount_total300 + $webfare_total300 + $standard_total300 + $superflex_total300 + $special_total300 + $tours_total300;

                        $tot_remain_tours300 = $capacidad300 - $remain_tours300;

                        $result_special_prices300 = $tot_remain_tours300;

                        $result_tours300 = $tot_remain_tours300;                        
        
        
        ?>
        
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
                        
                       
                        <input  type="submit" value="Summary" style="margin-top: 7px; margin-left: 9px; padding: 10px; padding-left: 6px;  height: 34px; width: 74px; color: #AC1B29;font-weight: 700; font-size:11px; cursor:pointer;" />                        
                                
                        
                    
                    
                    </form>
                    <script type="text/javascript">
                        var variableJs = document.getElementById("variable").value;//"2259";

                        function onEnviar() {
                            document.getElementById("variable").value = variableJs;
                        }
                    </script>

                </li>

                <li class="btn-toolbar" id="btn-rastro">
                    <a   class="link-button" id="btn-rastro" style=" margin-top: 5px; margin-left: 5px;">
                        <span class="icon-32-rastro"  title="Rastro" >&nbsp;</span>
                        Traces
                    </a>
                </li>

                <li style="margin-left: -1px; margin-top: 1px;" class="btn-toolbar" id="btn-pagos">
                    <a  style="margin-left: 1px; margin-top: -15px;" class="link-button" id="btn-pagos">    
                        <span class="pagos" title="Pagos" style="margin-left: 5px; margin-top: 12px; color:#4B0082; width: 32px; height: 32px; ">&nbsp;</span>

                        Payments
                    </a>
                </li>

                <!--                <li class="btn-toolbar" id="btn-cancel">
                                    <a  class="link-button" >
                                        <span class="icon-back" title="Editar" >&nbsp;</span>
                                        Back
                                    </a>
                                </li>-->

                <!--                <li class="btn-toolbar" id="btn-cancel">
                
                                    <a title="Back" id="btn-exit" href="<?php echo $data['rootUrl'] ?>admin/onedaytour"><i class="fa fa-arrow-left fa-3x" style="color:#AC1B29; margin-top: 0px; margin-left: 5px;"></i></a>  
                                </li>-->

            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
    
    
<fieldset id="facturas" style="position:absolute; width:109px; height: 36px; margin-top: -130px; margin-left:872px; background-color: #F5F5F5; border-color: transparent;">

    <div id="invoices">

    <table>
        <tr>
            <td><label id="lbl_invoice" style="position:absolute; margin-left:-78px; margin-top:9px; font-size: 14px; color:#0B55C4; font-weight: bold;">Invoice #</label></td>
            <td><input type="text"  id="invoice" name="invoice" style="position:absolute;  height: 17px; margin-left:-8px; margin-top: 3px; width:119px; text-align: center; color:red; font-size:18px; padding-top:3px; font-weight:bold;"   value="<?php echo $invoice_no; ?>" readonly="readonly"/></td>
            <td><label id="lbl_creation" style="position:absolute; margin-left:-9px; margin-top:32px; color:#000; font-size:8px;">Creation Date:</label></td>
            <td><input type="text"  id="fec_invoice" name="fec_invoice" style="position:absolute; margin-left:69px; margin-top: 31.2px; width:50px; text-align: left; color:#000; font-size:8px; font-weight:bold; border:0px; background-color: transparent;"   value="<?php echo $fecha_factura; ?>" readonly="readonly"/></td>
        </tr>
    </table>


    </div>

 </fieldset>

<div id="content_page_tours" style="z-index:1; margin-top: -9px; width: 984px; height: 1392px;">
    <form action="<?php echo $data['rootUrl'] ?>admin/onedaytour/save_edited" id="form1" method="POST" name="form1">
<!--        <input type="text" name="opc_ap"  id="opc_ap" size="12" style="" value="0" />-->
        
        
        <div id="info-group" style="width: 900px;">
            <div id="cancelation">
                <div class="ho">CANCELATION <span>#</span></div>
                <!--                <div id="cancel">00000</div>-->
                <div id="cancel" style="background: #fff;">00000</div>
            </div>
            <div id="reservation" style="width:300px;">
                <div class="ho">RESERVATION <span>#</span></div>
                <div> 
                    <input type="text" id="reser" name ="reser" style="background: #FFC351; text-align: center; width: 299px; font-weight: 600; font-size: 11px; padding-top: 1px; height: 10px;" value="<?php echo $data['tour']->code_conf; ?>" readonly="readonly" />
                </div>
                <input type="hidden" id="code_conf" name="code_conf"  value="<?php echo $data['tour']->code_conf ?>">
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
        <fieldset id="inputype" style="margin-left:-1px; width:48%; border-radius: 3px 120px 0px 80px; box-shadow: 0 -14px 4px #DC1349;"class="rojo"><legend style="background-color: #fff; border:1px solid #B83A36;">INPUT TYPE</legend> 
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
        <fieldset id="liderpax" style="margin-left: 502px; width: 94px; margin-top: -129px; background-color: #DCDCDC; border-radius: 130px 3px 80px 0px; box-shadow: 0 -14px 4px #1E90F6;" class="cerati">
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
        //$fecha_salida = '12-12-2017';
        //list($m, $d, $y) = explode("-", $fecha_salida);

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
        $price_adult_wdw = $prices['priceadult_WDW'];
        $price_child_wdw = $prices['pricechild_WDW'];

        $price_adult_WATERP = $prices['priceadult_WATERP'];
        $price_child_WATERP = $prices['pricechild_WATERP'];

        $price_adult_KENNEDYSPC = $prices['priceadult_KENNEDYSPC'];
        $price_child_KENNEDYSPC = $prices['pricechild_KENNEDYSPC'];
        ?>


        <!-- END TARIFAS A GRUPOS DE PARQUES -->
        <!-- date of tours -->
        <fieldset style="width: 97.3%;margin-top: 5px; border-radius: 10%;background-color:#DCDCDC;" class="gris3">
            <div id="date" align="center">
                <table width="90%" border="0">
                    <tr>
                        <td width="11%" height="29" align="right"><span style="width:100px;"><strong>DATE</strong></span></td>
<!--                        <td width="4%" align="right"><a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0" style="padding-bottom: 3.1px;" /></a></td>-->
                        <td width="4%" align="right"><a href="" id="dataclick1" ><i class="fa fa-calendar" style="font-size: 21px; color: #00E;"></i></a></td>
                        
                        
                        <td width="17%"><input name="fecha_salida" type="text"  id="fecha_salida" onchange="fecha_retorno(this.value);fechale2();" size="10" maxlength="16" value="<?php
                            list($anio, $mes, $dia) = explode('-', $data['tour']->starting_date);
                            echo $mes . '-' . $dia . '-' . $anio;
                            ?>" autocomplete="off"  style="background-color: #FFF; text-align:center; font-weight: bold; height: 22px;" /></td>
<!--                        <td width="4%" align="right"><a href="" id="dataclick2" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0" style="padding-bottom: 3.1px;" /></a></td>-->
                        <td width="4%" align="right"><a href="" id="dataclick2"><i class="fa fa-calendar" style="font-size: 21px; color: #B83A36;"></i></a></td>
                        
                        
                        <td width="17%">
                        <input name="fecha_retorno" type="text"  id="fecha_retorno"  size="10" maxlength="16" value="<?php
                        list($anio, $mes, $dia) = explode('-', $data['tour']->ending_date);
                        echo $mes . '-' . $dia . '-' . $anio;
                        ?>" autocomplete="off" onchange="" style="text-align:center; font-weight: bold; height: 22px;" />

                        <input type="text" name="fec_retor" id="fec_retor"  style="display:none; text-align:center;"  size="10" maxlength="15" value="<?php echo $fecha_retorno_reservas; ?>"   autocomplete="off" />
                        
                        </td>
                        <td width="9%"><strong>ADULT(S)</strong></td>
                        <td width="15%"><input style="font-size:16px; font-weight:bold; text-align: center;" name="adult" id="adult" autocomplete="off" type="number" onclick="capturar();" value="<?php echo $data['tour']->adult ?>" max="16" min="1" ></td>
                        <td width="8%"><strong>CHILD(S)</strong></td>
                        <td width="29%"><input style="font-size:16px; font-weight:bold; text-align: center;" name="child" id="child" autocomplete="off" type="number" onclick="capturar();" value="<?php echo $data['tour']->child ?>" max="15" min="0" ></td>
                    <input type="text" name="group_park" id="group_park" style="display:none;" size="2" maxlength="10" style="margin-left: 254px;" value="<?php echo $tour->group_park; ?>">
                    <input type="text" name="group_park1" id="group_park1" style="display:none;" size="2" maxlength="10" style="margin-left: 294px;" value="<?php echo $data['tour']->group_park ?>">
                    </tr>
                </table>
            </div>
        </fieldset>
        <!-- end date of tours -->

        <fieldset id="inputype" title="" style="width:97%; margin-top: 4px; height:70%; border-radius: 10%;"class="booking2"><legend style="border:1px solid #00C; background-color: #fff;">ONE DAY TOUR TO</legend>
            <div id="opera" class="input">
                <table align="center" cellspacing="10" style="margin-top: 27px;">
                    <tr valign="top">
                      <!-- <form id="form2" class="form" action="<?php /*echo $data['rootUrl']*/ ?>admin/onedaytour" target="_blank" method="POST" name="form2" > -->
                        <td style="width: 20%;">

                            <div style="margin-right:70px; margin-top:-15px;">
<!--                                        <a  href='<?php /*echo $data['rootUrl'] */?>admin/reservas/add'><img src ='<?php /*echo $data['rootUrl']*/ ?>global/estilos/img/one-day/WDW1.png' width='370px' height='70px'></a>-->

                                <?php
                //Datos de las variables en PHP
                                /* <?php echo "$fecha"; ?><br /> <?php echo "$dato"; ?>...  bgcolor="#FFFFFF" */
                                
                                $sql1 = "SELECT g1,g2,g3,g4,g5,g6,g7,g8,g9,g10 FROM grupo_parques_oneday WHERE grupo_parque ='1'";
                                        $rs1 = Doo::db()->query($sql1);
                                        $grupo_parques = $rs1->fetchAll();
                                        foreach ($grupo_parques as $grp1) {
                                            
                                        
                                        }
                                            $gp1= $grp1['g1'];
                                            $gp2= $grp1['g2'];
                                            $gp3= $grp1['g3'];
                                            $gp4= $grp1['g4'];
                                            $gp5= $grp1['g5'];
                                            $gp6= $grp1['g6'];
                                            $gp7= $grp1['g7'];
                                            $gp8= $grp1['g8'];
                                            $gp9= $grp1['g9'];
                                            $gp10= $grp1['g10'];

                                            $sql2 = "SELECT nombre FROM grupo_parques WHERE id ='$gp1'";
                                            $rs2 = Doo::db()->query($sql2);
                                            $nombre_grupo2 = $rs2->fetchAll();


                                            foreach ($nombre_grupo2 as $ng2) {

                                            }
                                            $var1 = $ng2['nombre'];
                                            
                                            /* -------------------  */
                                            
                                            $sql3 = "SELECT nombre FROM grupo_parques WHERE id ='$gp2'";
                                            $rs3 = Doo::db()->query($sql3);
                                            $nombre_grupo3 = $rs3->fetchAll();


                                            foreach ($nombre_grupo3 as $ng3) {

                                            }
                                            $var2 = $ng3['nombre'];
                                            
                                            /* -------------------  */
                                            
                                            $sql4 = "SELECT nombre FROM grupo_parques WHERE id ='$gp3'";
                                            $rs4 = Doo::db()->query($sql4);
                                            $nombre_grupo4 = $rs4->fetchAll();


                                            foreach ($nombre_grupo4 as $ng4) {

                                            }
                                            $var3 = $ng4['nombre'];
                                            
                                            
                                        
                                            /* -------------------  */
                                            
                                            $sql55 = "SELECT nombre FROM grupo_parques WHERE id ='$gp4'";
                                            $rs55 = Doo::db()->query($sql55);
                                            $nombre_grupo5 = $rs5->fetchAll();


                                            foreach ($nombre_grupo5 as $ng55) {

                                            }
                                            $var4 = $ng5['nombre'];
                                           
                                            /* -------------------  */
                                            
                                            $sql66 = "SELECT nombre FROM grupo_parques WHERE id ='$gp5'";
                                            $rs66 = Doo::db()->query($sql66);
                                            $nombre_grupo6 = $rs66->fetchAll();


                                            foreach ($nombre_grupo6 as $ng6) {

                                            }
                                            $var5 = $ng6['nombre'];
                                ?>

                                <fieldset  style="margin-left: 132px; border:4px solid #AC1B29; width:150px; color:#fff; height: 83px; border-radius: 20px 20px 0px 0px; background-color: transparent;" class="round">

                                    <legend align="center" ><b style="color:#AC1B29;">GROUP PARKS 1</b></legend>

                                    <marquee align="center" height="50"  style="border-radius:10px 10px 0px 0px;" direction="up" onmouseover="this.stop();" onmouseout="this.start();" scrolldelay="220" class="wdw1" ><strong>


                                        <span   class="Estilomar"><strong><?php echo "$var1"; ?></span></strong><br />

                                        <span  class="Estilomar"><strong><?php echo "$var2"; ?></strong></span> <br />

                                        <span  class="Estilomar"><strong><?php echo "$var3"; ?></strong></span> <br /> 
                                        
                                        <span  class="Estilomar"><strong><?php echo "$var4"; ?></strong></span> <br /> 
                                                
                                        <span  class="Estilomar"><strong><?php echo "$var5"; ?></strong></span> <br />
                                                


                                        <span  class="Estilomar"><strong><?php echo "  "; ?></strong></span> <br /> 


                                        <span  class="Estilomar"><strong><?php echo "$var1"; ?></strong></span> <br /> 

                                        <span  class="Estilomar"><strong><?php echo "$var2"; ?></strong></span> <br />  

                                        <span  class="Estilomar"><strong><?php echo "$var3"; ?></strong></span> <br />
                                        
                                        <span  class="Estilomar"><strong><?php echo "$var4"; ?></strong></span> <br /> 
                                                
                                        <span  class="Estilomar"><strong><?php echo "$var5"; ?></strong></span> <br />
                                                


                                        <span  class="Estilomar"><strong><?php echo "  "; ?></strong></span> <br /> 


                                        <span  class="Estilomar"><strong><?php echo "$var1"; ?></strong></span> <br />  

                                        <span  class="Estilomar"><strong><?php echo "$var2"; ?></strong></span> <br />

                                        <span  class="Estilomar"><strong><?php echo "$var3"; ?></strong></span> <br />
                                        
                                        <span  class="Estilomar"><strong><?php echo "$var4"; ?></strong></span> <br /> 
                                                
                                        <span  class="Estilomar"><strong><?php echo "$var5"; ?></strong></span> 



                                    </marquee>
                                    <input type="radio" name="wdw" id="wdwus" style="height: 20px; width: 20px; margin-right: 64px;" value="1" required="required" onClick="capturar();habilitar(1);reseteo();"/>


                                </fieldset>

                            </div>                                                  

                            <!--                                    <label style="color:#33449C; font-size:14px;"><b style="margin-left: 47px;">WDW/UNIVERSAL/SEA WORLD</b></label>-->

                        </td>
                        <td style="width: 20%;">
                            <!--                                    <label style="color:#498128; font-size:14px;"><b style="margin-left: 16px;">WATER PARKS & HOLY LAND</b></label>-->
                            <div style="margin-right:36px; margin-top:-15px;">
<!--                                        <a  href='<?php echo $data['rootUrl'] ?>admin/reservas/add'><img src ='<?php echo $data['rootUrl'] ?>global/estilos/img/one-day/WPHL1.png' width='240px' height='80px'></a>-->

                                <?php
//Datos de las variables en PHP
                                /* <?php echo "$fecha"; ?><br /> <?php echo "$dato"; ?>...  bgcolor="#FFFFFF" */
                               
                                $sql12 = "SELECT g1,g2,g3,g4,g5,g6,g7,g8,g9,g10 FROM grupo_parques_oneday WHERE grupo_parque ='2'";
                                        $rs12 = Doo::db()->query($sql12);
                                        $grupo_parques12 = $rs12->fetchAll();
                                        foreach ($grupo_parques12 as $grp2) {
                                            
                                        
                                        }
                                            $gp11= $grp2['g1'];
                                            $gp12= $grp2['g2'];
                                            $gp13= $grp2['g3'];
                                            $gp14= $grp2['g4'];
                                            $gp15= $grp2['g5'];
                                            $gp16= $grp2['g6'];
                                            $gp17= $grp2['g7'];
                                            $gp18= $grp2['g8'];
                                            $gp19= $grp2['g9'];
                                            $gp20= $grp2['g10'];

                                            $sql13 = "SELECT nombre FROM grupo_parques WHERE id ='$gp11'";
                                            $rs13 = Doo::db()->query($sql13);
                                            $nombre_grupo11 = $rs13->fetchAll();


                                            foreach ($nombre_grupo11 as $ng11) {

                                            }
                                            $var11 = $ng11['nombre'];
                                            
                                            /* -----------------------*/
                                            
                                            $sql14 = "SELECT nombre FROM grupo_parques WHERE id ='$gp12'";
                                            $rs14 = Doo::db()->query($sql14);
                                            $nombre_grupo12 = $rs14->fetchAll();


                                            foreach ($nombre_grupo12 as $ng12) {

                                            }
                                            $var12 = $ng12['nombre'];
                                            
                                             /* -----------------------*/
                                            
                                            $sql15 = "SELECT nombre FROM grupo_parques WHERE id ='$gp13'";
                                            $rs15 = Doo::db()->query($sql15);
                                            $nombre_grupo13 = $rs15->fetchAll();


                                            foreach ($nombre_grupo13 as $ng13) {

                                            }
                                            $var13 = $ng13['nombre'];
                                            

                                             /* -----------------------*/
                                            
                                            $sql16 = "SELECT nombre FROM grupo_parques WHERE id ='$gp14'";
                                            $rs16 = Doo::db()->query($sql16);
                                            $nombre_grupo14 = $rs16->fetchAll();


                                            foreach ($nombre_grupo14 as $ng14) {

                                            }
                                            $var14 = $ng14['nombre'];
                                            
                                             /* -----------------------*/
                                            
                                            $sql17 = "SELECT nombre FROM grupo_parques WHERE id ='$gp15'";
                                            $rs17 = Doo::db()->query($sql17);
                                            $nombre_grupo15 = $rs17->fetchAll();


                                            foreach ($nombre_grupo15 as $ng15) {

                                            }
                                            $var15 = $ng15['nombre'];
                                        
                                
                                ?>
                                
                                             

                                <fieldset  style="margin-left: -51px; border:4px solid #FF5E00; width:150px; color:#fff; height: 83px; border-radius: 20px 20px 0px 0px; background-color: transparent;" class="round">

                                    <legend align="center"><b style="color:#FF5E00;">GROUP PARKS 2</b></legend>

                                    <marquee align="center" height="50"  style="border-radius:10px 10px 0px 0px;" direction="up" onmouseover="this.stop();" onmouseout="this.start();" scrolldelay="320" class="wphol" ><strong>


                                        <span   class="Estilomar"><strong><?php echo "$var11"; ?></span></strong><br />

                                        <span  class="Estilomar"><strong><?php echo "$var12"; ?></strong></span> <br />

                                        <span  class="Estilomar"><strong><?php echo "$var13"; ?></strong></span> <br />

                                        <span  class="Estilomar"><strong><?php echo "$var14"; ?></strong></span> <br />

                                        <span  class="Estilomar"><strong><?php echo "$var15"; ?></strong></span> <br />

                                        <span  class="Estilomar"><strong><?php echo "  "; ?></strong></span> <br /> 


                                        <span  class="Estilomar"><strong><?php echo "$var11"; ?></strong></span> <br />                 

                                        <span  class="Estilomar"><strong><?php echo "$var12"; ?></strong></span> <br /> 

                                        <span  class="Estilomar"><strong><?php echo "$var13"; ?></strong></span> <br />

                                        <span  class="Estilomar"><strong><?php echo "$var14"; ?></strong></span> <br />

                                        <span  class="Estilomar"><strong><?php echo "$var15"; ?></strong></span> <br />


                                        <span  class="Estilomar"><strong><?php echo "  "; ?></strong></span> <br /> 


                                        <span  class="Estilomar"><strong><?php echo "$var11"; ?></strong></span> <br />  

                                        <span  class="Estilomar"><strong><?php echo "$var12"; ?></strong></span> <br />

                                        <span  class="Estilomar"><strong><?php echo "$var13"; ?></strong></span> <br />

                                        <span  class="Estilomar"><strong><?php echo "$var14"; ?></strong></span> <br />

                                        <span  class="Estilomar"><strong><?php echo "$var15"; ?></strong></span> <br />


                                        <span  class="Estilomar"><strong><?php echo "  "; ?></strong></span> <br /> 


                                        <span  class="Estilomar"><strong><?php echo "$var11"; ?></strong></span> <br />  

                                        <span  class="Estilomar"><strong><?php echo "$var12"; ?></strong></span> <br />

                                        <span  class="Estilomar"><strong><?php echo "$var13"; ?></strong></span> <br />

                                        <span  class="Estilomar"><strong><?php echo "$var14"; ?></strong></span> <br />

                                        <span  class="Estilomar"><strong><?php echo "$var15"; ?></strong></span> <br />




                                    </marquee>

                                    <input type="radio" name="wdw" id="wphol" style="height: 20px; width: 20px; margin-right: 70px;" value="2" required="required" onClick="capturar();habilitar(2);reseteo();"/>


                                </fieldset>

                            </div>                                                  


                          </div>
<!--                                    <input type="radio" name="wdw" id="wphol" style="height: 20px; width: 20px; margin-right: 241px;" value="2" required="required" onClick="capturar();habilitar(2)" />-->
                        </td>
                        <td style="width: 20%;">
                            <!--                                    <label style="color:#EF152C; font-size:14px;"><b style="margin-left: 36px;">KENNEDY SPACE CENTER</b></label>-->
                            <div style="margin-right:64px; margin-top:-15px;">
<!--                                        <a style="margin-right:64px; margin-top:-15px;"  href='<?php echo $data['rootUrl'] ?>admin/reservas/add'><img src ='<?php echo $data['rootUrl'] ?>global/estilos/img/one-day/KSPC.png' width='145px' height='70px'></a>-->
                                <?php
//Datos de las variables en PHP
                                /* <?php echo "$fecha"; ?><br /> <?php echo "$dato"; ?>...  bgcolor="#FFFFFF" */
                                
                                $sql23 = "SELECT g1,g2,g3,g4,g5,g6,g7,g8,g9,g10 FROM grupo_parques_oneday WHERE grupo_parque ='3'";
                                        $rs23 = Doo::db()->query($sql23);
                                        $grupo_parques21 = $rs23->fetchAll();
                                        
                                        foreach ($grupo_parques21 as $grp3) {                                            
                                        
                                        }
                                        
                                $gp21= $grp3['g1'];
                                $gp22= $grp3['g2'];
                                $gp23= $grp3['g3'];
                                $gp24= $grp3['g4'];
                                $gp25= $grp3['g5'];
                                $gp26= $grp3['g6'];
                                $gp27= $grp3['g7'];
                                $gp28= $grp3['g8'];
                                $gp29= $grp3['g9'];
                                $gp30= $grp3['g10'];

                                $sql24 = "SELECT nombre FROM grupo_parques WHERE id ='$gp21'";
                                $rs24 = Doo::db()->query($sql24);
                                $nombre_grupo21 = $rs24->fetchAll();


                                foreach ($nombre_grupo21 as $ng21) {

                                }
                                $var21 = $ng21['nombre'];

                                /* -----------------------*/

                                $sql25 = "SELECT nombre FROM grupo_parques WHERE id ='$gp22'";
                                $rs25 = Doo::db()->query($sql25);
                                $nombre_grupo22 = $rs25->fetchAll();


                                foreach ($nombre_grupo22 as $ng22) {

                                }
                                $var22 = $ng22['nombre'];

                                /* -----------------------*/

                                $sql26 = "SELECT nombre FROM grupo_parques WHERE id ='$gp23'";
                                $rs26 = Doo::db()->query($sql26);
                                $nombre_grupo23 = $rs26->fetchAll();


                                foreach ($nombre_grupo23 as $ng23) {

                                }
                                $var23 = $ng23['nombre'];

                                /* -----------------------*/

                                $sql27 = "SELECT nombre FROM grupo_parques WHERE id ='$gp24'";
                                $rs27 = Doo::db()->query($sql27);
                                $nombre_grupo24 = $rs27->fetchAll();


                                foreach ($nombre_grupo24 as $ng24) {

                                }
                                $var24 = $ng24['nombre'];

                                /* -----------------------*/

                                $sql28 = "SELECT nombre FROM grupo_parques WHERE id ='$gp25'";
                                $rs28 = Doo::db()->query($sql28);
                                $nombre_grupo25 = $rs28->fetchAll();


                                foreach ($nombre_grupo25 as $ng25) {

                                }
                                $var25 = $ng25['nombre'];

                                /* -----------------------*/

                                
                                ?>

                                <fieldset  style="margin-left: -42px; border:4px solid #33449C; width:150px; color:#fff; height: 83px; border-radius: 20px 20px 0px 0px; background-color: transparent;" class="round">

                                    <legend align="center"><b style="color:#33449C;">GROUP PARKS 3</b></legend>

                                    <marquee align="center" height="50"  style="border-radius:10px 10px 0px 0px;" direction="up" onmouseover="this.stop();" onmouseout="this.start();" scrolldelay="420" class="kspc" ><strong>


                                        <span  class="Estilomar"><strong><?php echo "$var21"; ?></span></strong> <br />
                                        <span  class="Estilomar"><strong><?php echo "$var22"; ?></strong></span> <br />
                                        <span  class="Estilomar"><strong><?php echo "$var23"; ?></strong></span> <br />
                                        <span  class="Estilomar"><strong><?php echo "$var24"; ?></strong></span> <br />
                                        <span  class="Estilomar"><strong><?php echo "$var25"; ?></strong></span> <br />


                                        <span  class="Estilomar"><strong><?php echo "  "; ?></strong></span> <br /> 

                                        <span  class="Estilomar"><strong><?php echo "$var21"; ?></strong></span> <br /> 
                                        <span  class="Estilomar"><strong><?php echo "$var22"; ?></strong></span> <br />
                                        <span  class="Estilomar"><strong><?php echo "$var23"; ?></strong></span> <br />
                                        <span  class="Estilomar"><strong><?php echo "$var24"; ?></strong></span> <br />
                                        <span  class="Estilomar"><strong><?php echo "$var25"; ?></strong></span> <br />

                                        <span  class="Estilomar"><strong><?php echo "  "; ?></strong></span> <br /> 

                                        <span  class="Estilomar"><strong><?php echo "$var21"; ?></strong></span> <br />
                                        <span  class="Estilomar"><strong><?php echo "$var22"; ?></strong></span> <br />
                                        <span  class="Estilomar"><strong><?php echo "$var23"; ?></strong></span> <br />
                                        <span  class="Estilomar"><strong><?php echo "$var24"; ?></strong></span> <br />
                                        <span  class="Estilomar"><strong><?php echo "$var25"; ?></strong></span> <br />

                                        <span  class="Estilomar"><strong><?php echo "  "; ?></strong></span> <br /> 

                                        <span  class="Estilomar"><strong><?php echo "$var21"; ?></strong></span> <br /> 
                                        <span  class="Estilomar"><strong><?php echo "$var22"; ?></strong></span> <br />
                                        <span  class="Estilomar"><strong><?php echo "$var23"; ?></strong></span> <br />
                                        <span  class="Estilomar"><strong><?php echo "$var24"; ?></strong></span> <br />
                                        <span  class="Estilomar"><strong><?php echo "$var25"; ?></strong></span> <br />


                                    </marquee>

                                    <input type="radio" name="wdw" id="kspc" style="height: 20px; width: 20px; margin-right: 71px;" value="3" required="required" onClick="capturar();habilitar(3);reseteo();"/>


                                </fieldset>   

                            </div>
<!--                                    <input type="radio"  name="wdw" id="kspc" style="height: 20px; width: 20px; margin-right: 144px;"  value="3" required="required" onClick="capturar();habilitar(3)" />-->
                        </td>

                        <!--</form>-->
                    <input type="text" style="display:none;" name="group_park2" id="group_park2" size="2" maxlength="10" style="margin-left: 284px;" value="">
                    <div style="display:none;" id="resultado"></div>
                    <div style="display:none;" id="result"></div>
                    <input type="text" name="selectcond" id="selectcond" value="" style="display:none; position:absolute; margin-left:0px; margin-top:0px;" />


                    <div style="margin-left: 100%;margin-top: -5px;">
                        <input type="text" name="priceadults" id="priceadults"  size="10" maxlength="10" style="display:none; margin-left: -254px;" value="<?php echo $data['tour']->t_price_adult; ?>">
                    </div>
                    <div style="margin-left: 100%;margin-top: -5px;">
                        <input type="text" name="pricechilds" id="pricechilds"  size="10" maxlength="10" style="display:none; margin-left: -254px;" value="<?php echo $data['tour']->t_price_child; ?>">
                    </div>      
                    </tr>
                </table>

            </div>
        </fieldset> 

        <!-- Transfer in-->
        <input type="text"  name="estado_trf_out"  id="estado_trf_out"  style="display:none; width:25px;  margin-left: 30px; margin-top:4px;" value="<?php echo $estado_transf_out; ?>" />
        <table width="100%" >
            <tr>
                <td colspan="" valign="top" >

                    <fieldset id="arrival" style="border-radius: 4%; width: 460px; height: 243px; margin-top: 4px; background-color: #33449C; color: #fff;border:1px solid #33449C;" class="cerati">
                        <div id="reserveprices" display="none">
                            <input type="hidden" readonly="readonly" name="pricexadult" id="pricexadult" value="<?php echo $data['pricexadult']; ?>">
                            <input type="hidden" readonly="readonly" name="pricexchild" id="pricexchild" value="<?php echo $data['pricexchild']; ?>">


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
                                                        <div style = "display:none;" id="t-total">
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
                                                                <select style="width:190px; color:#000; font-size: 12.5px;" name="from" id="from" class="select">
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
                                                                <select style="width:190px; color:#000; font-size:12.5px;" name="to" id="to" class="select">
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
                <td><fieldset id="departure" style="border-radius: 4%; margin-top: 4px; width: 460px; height: 245px; background-color: #AC1B29; border: #AC1B29 solid thin; color: #fff;" class="rojo">
                        <div id="reserveprices">
                        </div>
                        <input id="totalreserver" name="totalreserver" type="hidden" value=0 readonly="readonly">
                        <legend id="leg_transfer_in" style="background-color: #fff; border: #B83A36 solid thin; color:#B83A36;">
                            <label for="opcion_transfer_in" style=" cursor:pointer; ">TRANSFER OUT</label> </legend>
                        <div id="conte_arrival" style="height: 225px;" >
                            
                                <div>
                    
                                    <select style="position:absolute; border: #000 2px solid; width:191px; margin-left: 266px; margin-top:0.7px; border-radius: 0px 0px 0px 0px; font-weight:bold;" id="estado_transfer_out" name="estado_transfer_out" onchange="fecha_transfer_out();">

                                        <optgroup  label="STATUS">

                                            <option style="font-weight:bold;" value="1">CONFIRMED</option>
                                            <option style="font-weight:bold;" value="2">CANCELED</option>                                                                     
                                            <option style="font-weight:bold;" value="3">NO SHOW</option>                                          


                                        </optgroup>

                                    </select>

                                </div>
                            
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
                                                        <div style = "display:none;" id="t-total">
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
                                                                <select style="width:190px; color:#000; font-size: 12.5px;" name="from2" id="to" class="select">
                                                                    <option value="1">Orlando</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div id="div_to2" style="margin-left: 69px;">
                                                                <div class="label">TO</div>
                                                                <select style="width:190px; color:#000; font-size: 12.5px;" name="to2" id="to2" class="select">
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
                    <div id="itinerary" style="width: 479px;margin-left: 6px;height: 130px; background-color: #FFF;">
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
                                            <th width="10%">Seats</th>
                                        </tr>
                                    </thead>  <tbody><tr class="">	<td width="10%"><?php echo $data['res']->trip_no ?>
                                                <input type="hidden" name="trip1" id="trip1" value="301" class="trip1">
                                                <input name="sarrival" type="hidden" value="1">
                                            </td>
                                            <td><?php echo date('h:i A', strtotime($data['res']->deptime1)); ?></td>
                                            <td><?php echo date('h:i A', strtotime($data['res']->arrtime1)); ?></td>
                                            <td width="30%">BUS</td>
                                            <td style="text-align:center;" width="10%"><?php echo $result_tours301; ?></td>
                                        </tr> </tbody></table>
                                <b style="color:#F00"></b>
                                <input type="hidden" value="<?php echo $data['res']->deptime1; ?>" id="deptime1" name="deptime1">
                                <input type="hidden" value="<?php echo $data['res']->arrtime1; ?>" id="arrtime1" name="arrtime1">
                            </div>
                        </div>

                    </div>
                </td>
                <td>
                    <div id="itinerary" style="width: 478px; height: 130px; margin-left:5px; background-color: #FFF;">
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
                                            <th width="10%">Seats</th>
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
                                            <td style="text-align:center;" width="10%"><?php echo $result_tours300; ?></td>
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
                                                                <input style="width:300px;" class="field" id="park_name" type="text" autocomplete="off" value="<?php // echo $data['park']->nombre                                          ?>" />
                                                                <input type="hidden" name="id_park" id="id_park" value="<?php // echo $data['park']->id                                          ?>"/>
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
                                                        <td valign="bottom"><input type="button" id="add_attraction_list"  style="height:30px; color:#33449C; cursor:pointer;" value="Add to list"/>
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

        <fieldset style="border-radius: 5%; margin-top: -6px; height:420px;" class="azul2017">
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

                        <table>
                            <tr>
                                <td>
                                    <table class="oliveti" style="width: 39%; border: 2px solid #000; margin-left: 0px; margin-top: 4px; height: 157px;">

                                        <caption class="rojo" style=" font-weight:bold; font-size:16px; color:#fff; border-radius: 25px 0px 0px 0px; border: 2px #000 solid">Passenger Payment Information</caption>


                                        <td>&nbsp;</td>

                                        <tr  style=" height:13px; width:180px;">

                                            <td style="width: 700px;">
                                                <label  style=" float:right; font-size:16px; margin-top:-29px;"><strong   id="txtamountpendiente" style=" color:#F00">Amount to Collect&nbsp;$</strong></label>
                                            </td>
                                            <td>

                                                <div  style="width:116px;">
                                                    <div class="price">
                                                        <input type="text"  id="saldoactual" name="saldoactual" class="verd"    value="" style="float: right; width:85px; height: 25px; margin-top: -29px; margin-right:6px; width:106px; text-align: right; font-weight:bold; color:#000; border: 1px #33F solid; font-size:22px;" onKeyUp="dupliac();ponDecimales(2);" onkeypress="return soloNumeros(event);" autocomplete="off" />  
                                                    </div>

                                                </div>

                                                <br />
                                            </td>
                                        </tr>
                                        <td>&nbsp;</td>


                                        <tr style="width: 700px;" ><td>
                                                <label  style=" float:right; font-size:16px;  margin-top:-43px; "><strong style=" color: #000;">Paid Driver&nbsp;$</strong></label>    </td>
                                            <td>                                               
                                                <input  type="text" id="paid_driver" name="paid_driver" autocomplete="off" readonly="readonly"  class="brown3"   style="float:right; text-align: right; margin-right:5.1px; height: 25px; font-size: 22px;font-weight: bold;color: #000; border: 1px #33F solid; margin-top: -49px;  width:106px; font-weight:bold; color:#000;" onKeyUp="calcularTotalPago();" onclick="valida_pago(this,'one');" value="<?php echo number_format($data['tour']->paid_driver, 2, '.', ''); ?>"  />
                                                <input  type="text" id="paid_driverp" name="paid_driverp" style="display:none;" value=""  />
                                            </td>
                                        </tr>

                                        <tr style="width: 700px;" >
                                            <td>
                                                <label  style=" float:right; font-size:16px;  margin-top: -23px; "><strong style=" color:#000;">Passenger Balance Due&nbsp;$</strong></label>

                                            </td>

                                            <td>                                              
                                                <input type="text" id="balance_due" name="balance_due"  class="ama2"  style="float:right; border: 1px #33F solid; margin-top: -29px; margin-right:5.1px;  text-align: right; height: 25px; font-size: 22px; font-weight:bold; width:106px;" autocomplete="off"  value="" readonly="readonly"  />
                                                <input type="text" id="pass_balance_due" name="pass_balance_due"  class="ama2"  style="display:none; float:right; border: 1px #33F solid; margin-top: -29px; margin-right:5.1px;  text-align: right; height: 25px; font-size: 22px; width:106px;" autocomplete="off"  value="<?php $data['tour']->passenger_balance_due; ?>"   />
                                            </td>
                                        </tr>



                                    </table>


                                    <table class="oliveti" style="width: 39%; border: 2px solid #000; margin-left: 0px; margin-top: 11px; height: 171px; ">


                                        <caption class="cerati" style="  font-weight:bold; font-size:16px; color:#fff; border: 2px #000 solid">Agency Payment Information</caption>


                                        <tr style="width: 700px;">
                                            <td>
                                                <label  style=" float:right; padding-left: 122px; font-size:16px;  margin-top: 4px; margin-left: -6px;"><strong style=" color:#000;">Total Net Fare&nbsp;$</strong></label>
                                            </td>
                                            <td>



                                                <div id="t-total2" >
                                                    <input type="text"  id="totalAmount" name="totalAmount" class="orangered"  readonly="readonly"  value="" onKeyUp="" style="float: right; width:85px; height: 25px; margin-top: 3px; margin-right:6px; width:106px; text-align: right; font-weight:bold; color:#fff; border: 1px #33F solid; font-size:22px;" autocomplete="off" onkeypress="validate(event);" /> 
                                                </div>
                                            </td>
                                        </tr>

                                        <tr id="pay_amount_html" style="height: 50px; width: 700px;">
                                            <td>
                                                <b style="float: right; color:#000;font-size: 16px; margin-top:-4px;">Amount Pre-Paid&nbsp;$</b>                                       
                                            </td>


                                            <td>
                                                <div id="t-total2">

                                                    
                                                    <input type="text" id="pay_amount" name="pay_amount" class="azu" class="txtNumbers" readonly="readonly"  onKeyUp="calcularTotalPago(); outcharge();" onclick="valida_pago2(this,'two');" value="<?php echo number_format($data['tour']->pred_paid_amount, 2, '.', ''); ?>"  style=" text-align: right; margin-top: -5px; margin-right:6px; float:right; width: 106px; height:25px; font-size:22px; font-weight:bold; border: 1px #33F solid;" onkeypress="validate(event);" autocomplete="off"/>

                                                    <input type="text" id="pay_amountp" name="pay_amountp" style="display:none;" value="" />


                                                </div>
                                            </td>



                                        </tr>

                                        <tr style="height:33px; width: 700px;">
                                            <td>
                                                <b style="float: right;"><strong style=" color:#000;font-size: 16px; font-weight:bold; margin-top: -8px;">Total Amount Paid&nbsp;$</strong></b>                                         
                                            </td>
                                            <td>
                                                <input type="text" id="tot_amount_paid" name="tot_amount_paid" readonly="readonly" autocomplete="off"  class="verdefos3"  class="txtNumbers"    value="<?php echo number_format($data['tour']->total_paid, 2, '.', ''); ?>"  style="float:right;  border: 1px #33F solid;  margin-top:-10px; margin-right:6px; text-align: right; height: 25px; font-size: 22px; font-weight: bold; width:106px;" />
                                                <input type="text" id="tot_amount_paidp" name="tot_amount_paidp" style="display:none;" value="" />

                                            </td>


                                        </tr>  
                                        <tr style="width: 700px;">
                                            <td>
                                                <b style="float: right; "><strong style=" color:#000;font-size: 16px; font-weight:bold;">Agency Balance Due&nbsp;$</strong></b>                                         
                                            </td>
                                            <td>
                                                <input type="text" id="agency_balance_due" name="agency_balance_due" readonly="readonly" autocomplete="off"  class="roge"  class="txtNumbers"    value=""  style="float:right; border: 1px #33F solid; margin-top:-1px; margin-right:6px; text-align: right; height: 25px; font-size: 22px; font-weight:bold; width:106px;" />
                                            </td>
                                            
                                            <input type="text" id="pago_tarjeta" name="pago_tarjeta" title="Pago Tarjeta" value="0.00"  style="display:none; position:absolute;  border: 1px #FFF solid; margin-top: 67.2px;  margin-left: 377px; width: 68px; height:12px; text-align:right; font-size: 14px; padding-top:2px; background-color: transparent; color:#fff;"  autocomplete="off"  />                                

                                        </tr>  
                                    </table>

                                    <img class="ventana-imagen-class" style="position:absolute; margin-left:556px; margin-top:-383px; width: 178px; height: 179px; " src="<?php echo $data['rootUrl']; ?>global/img/admin/ventana.png" />

                                    <table class="oliveti" style="width: 22%; border: 2px solid #000; margin-left: 744px; margin-top: -383px; height: 159px; border-radius: 0px 0px 0px 0px;">

                                        <caption class="olivo" style=" font-weight:bold; font-size:14px; color:#fff; border-radius: 0px 25px 0px 0px; border: 2px #000 solid">Extra Charges & Discounts</caption>

                                        <td>&nbsp;</td>


                                        <tr style="width: 700px;" >
                                            <td>
                                                <label  style=" float:right; font-size:14px; margin-top:-8px; "><strong style="padding-bottom:10px; color: #000;">Discount&nbsp;%</strong></label>
                                            </td>

                                            <td>

                                                <input  type="number" id="descuento" name="descuento" maxlength="3" class="descuentos" onkeypress="return descuentoporc(event);" onKeyUp="desporc();" onchange="desporc();" max="100" min="0"  value="<?php echo $data['tour']->descuento_procentaje ?>"  autocomplete="off" style="text-align: right; color:#000; font-size: 22px;font-weight: bold; border: #33F solid thin; float:left; margin-top: -8px; margin-left:0px; height:25px; width:80px; " />
                                            </td>
                                        </tr>

                                        <tr style="width: 700px;" >
                                            <td>
                                                <label  style="float:right; font-size:14px;  margin-top: 8px; "><strong style="padding-bottom:10px; color:#000;">Discount&nbsp;&nbsp;&nbsp;$</strong></label>

                                            </td>

                                            <td>

                                                <input type="text" id="descuento_valor" name="descuento_valor"  class="descuentos"   size="12" style="float:right; border: 1px #33F solid; margin-top: 7px; margin-right:6px;  text-align: right; color:#000; font-size: 22px; font-weight: bold; height: 25px; width:80px;" value="<?php echo $data['tour']->descuento_valor; ?>" autocomplete="off" onkeypress="return solodescuento(event);"  onkeyup="desval();ponDecimales(2);"  />
                                                <input type="button" id="reset_desc" name="reset_desc"  size="12" style="display:none; margin-top: 3px; margin-right:6px;   color:#000; font-size: 10px; font-weight: bold; height: 14px; width:82px;" value="Reset"  onclick="reset_descuento_valor();calcularTotalPago();"  />
                                            </td>



                                        </tr>

                                        <td>&nbsp;</td>


                                        <tr  style="width: 700px;">

                                            <td style="width: 700px;">
                                                <label  style="float:right;  font-size:13px;  margin-top: -9px;"><strong style="padding-bottom:10px; color: #000;">Extra Charges&nbsp;$</strong></label>
                                            </td>

                                            <td>
                                                <input type="text" id="extra" name="extra"  class="extracargos"  size="12" style=" float:right;  text-align: right; color:#000; margin-top: -15px; margin-right:6px;  width:80px; height:25px;  border: 1px #33F solid; font-family: sans-serif; font-size: 22px; font-weight:bold;"   value="<?php echo $data['tour']->extra_charge; ?>" autocomplete="off" onkeypress="return soloextra(event);" onkeyup="resetextra();ponDecimales(2);"/>

                                                <br />
                                            </td>
                                        </tr>


<!--                                </td>-->
                                <td valign="bottom">

                                    <table width="100%">
                                        <tr>

                                        </tr>
                                        <tr>

                                        </tr>
                                        <tr>
                                            <td align="right">
                                                <div id="opera" class="enviarForm" style="padding-top:5px; cursor:pointer;" align="left">
                                                    <a id="enviarF" style="display:none; cursor:pointer" ><img src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                </td>
<!--                            </tr>-->
                        </table>
                                    
                        <input  type="button" id="pay_driver" name="pay_driver" title="Add Payment" class="button_sliding_bg"  onclick="abrirVentana2();" style="position:absolute; border-color: #000; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; border-top-left-radius: 0px; border-top-right-radius: 0px; margin-left: 372px; margin-top: -94px; height: 30px; cursor:pointer; color: #fff; font-weight: 700; width: 171px;  padding: 6px; padding-left: 6px; padding-top: 4.5px;" value="Add Payment"/>
                        
<!--                        <input type="button" name="btnventana" id="btventana"  style="cursor:pointer; color: #AC1B29; font-weight: 700; margin-top: -137px; margin-left: 372px; padding: 10px; font-size:9px; width: 118px;"  onclick="abrirVentana2();" value="Add Payment"/>-->

                    </td>

                <div id="t-total2" style="width:170px;">
                    <input type="text" name="otheramount" id="otheramount" class="txtNumbers" value="<?php echo $data['tour']->otheramount_sin_tax; ?>"  style="display:none; padding-left:5px; width:160px; height:20px;" autocomplete="off"  />
                    <input type="text" name="otheramountp" id="otheramountp"  value=""  style="display:none;" autocomplete="off"  />
                </div>

                <div style="width:170px;">
                    <input autocomplete="off" type="text" name="prueba" id="prueba" value=""  style="display:none; padding-left:5px; width:360px; height:20px;" />
                </div>

                <td style="width:300px;" align="left" >                        

                </td>
                </tr>      

                <tr>
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
<!--        <textarea id="comments" name="comments" cols="0" rows="0" placeholder="Notes"  style=" width: 384px; height: 100px; margin-top:-4px; margin-left: 557px;"></textarea>
        <textarea id="comments2" name="comments2" cols="0" rows="0"  disabled="disabled" style=" width: 384px; height: 100px; margin-top:12px; margin-left: 557px;"><?php echo $data['tour']->comments2; ?></textarea>

-->

        <div id="userr"></div>


        <div id="mascaraP" style="display:none;"></div>
        <div id="clienteN" style="display:none;">


            <div id="header_page">
                <div class="header2">Customer</div>

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

        <div id="dialog2" title="History of Payments [One Day Tours]" style="display:none; width:550px; margin-left:-12px;">
            <div style="overflow-y: scroll;height:250px; width:550px; margin-left:0px;">
                <table class="grid2" cellspacing="1" id="grid2">
                    <thead>
                        <tr>
                            <td style="text-align: center; width: 50px;">Eliminar</td>
                            <td style="text-align: center; width:170px; padding-left:2px;">Pago</td>
                            <td style="text-align: center; width:158px; padding-left:2px;">Tipo Pago</td>
                            <td style="text-align: center; width:78px; padding-right:10px;">Valor Pagado</td>
                            <td style="text-align: center; width:150px;">Fecha</td>
<!--                            <td style="text-align: center; width:80px;">User</td>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id_onetour = $data['tour']->id;
                        $sql122 = "SELECT pago, tipo_pago, pagado, fecha FROM tours_pago where id_tours= $id_onetour AND pagado <> '0.00' AND tipo='ONE' order by fecha";
                        $rs12 = Doo::db()->query($sql122);
                        $pagos2 = $rs12->fetchAll();
                        foreach ($pagos2 as $p):
                            ?>
                            <tr class="row1">
                                <td style="text-align: center;">
                                    <a id="delpay" name="delpay" style="cursor:pointer;" href="javascript:ventanaSecundaria('<?php echo $data['rootUrl'] ?>admin/pagos/recibirId/<?php echo $data['tour']->id ?>/<?php echo $tipo_reserva ?>')"  onClick=""><img style ="margin-top:8px; margin-left: 1px;" title="Eliminar Pago" src ='<?php echo $data['rootUrl'] ?>global/img/remove.png' width='15px'></a>
                                </td>
                                <td style="text-align: left;"><?php echo $p['pago']; ?></td>
                                <td style="text-align: left;"><?php echo $p['tipo_pago']; ?></td>
                                <td style="text-align: right;"><?php echo $p['pagado']; ?></td>
                                <td style="text-align: center;"><?php echo $p['fecha']; ?></td>
<!--                                <td style="text-align: center;"><?php /* echo $login->usuario; */?></td>-->
                                <script lenguage='javascript'>
                                    function ventanaSecundaria(url){
                                        window.open(url, 'ventana1', 'width=1243, height=720, scrollbars=NO');

                                    }
                                </script>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <a  id="pago_agente1" style="display:none; position: absolute; margin-right: 2px;"><img style="width:0px; height:28px; margin-top:106px; margin-left:374px;" src="<?php echo $data['rootUrl']; ?>global/img/admin/chargedisabled.png" /></a>
        <a  id="pago_agente" style="display:block" ><img style="width: 0px;  height:3px; margin-left: 591px;  margin-top: 65px; cursor:pointer" src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>
        
        <div id="">
        <input  type="button" id="btn-save2" title="Save" class="oliverty"  class="link-button" value="SAVE"/>
        </div>
<!--        <a href="#Aqui URL" class="boton colorRojo formaBoton">PRESIONAME!</a>
	<a href="#Aqui URL" class="boton anaranjado formaBoton">PRESIONAME!</a>
	<a href="#Aqui URL" class="boton verde formaBoton">PRESIONAME!</a>
	<a href="#Aqui URL" class="boton rosa formaBoton">PRESIONAME!</a>
	<a href="#Aqui URL" class="boton azul formaBoton">PRESIONAME!</a>
	<a href="#Aqui URL" class="boton purpura formaBoton">PRESIONAME!</a>-->

        <select name="opcion_pago_driver" id="opcion_pago_driver" style="display:none; margin-left:414px; margin-top:-327px;">
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

        <input type="text" name="opcionpago"  id="opcionpago" size="25"  style="display:none;" value="<?php echo $data['tour']->op_pago; ?>">


        <select name="opcion_pago" id="op_pago_id" style="display:none; margin-left:372px; margin-top:-160px; width: 171px;" onchange="change_oppago();">
            <optgroup label="COLLECT ON BOARD">
                <option value="8">Credit Card no fee</option>
                <option value="3">Credit Card with fee</option>
                <option value="4">Cash</option>
                <option value="9">Check</option>
            </optgroup>
            <optgroup label="VOUCHER">
                <option value="5">Credit Voucher</option>
            </optgroup>
            <optgroup label="PAID">
                <option value="6">Paid</option>
            </optgroup>     
            <optgroup disabled= "disabled" label="COMPLEMENTARY">
                <option value="7">Complementary</option>
            </optgroup>
        </select>

        <select name="op_pago_conductor" id="op_pago_conductor" style="margin-left:372px; margin-top:-137px; width: 171px;" onclick="valida_voucher();" onchange="captura(); passenger_balance();">
            <optgroup label="COLLECT ON BOARD">
                <option value="8">Credit Card no fee</option>
                <option value="3">Credit Card with fee</option>
                <option value="4">Cash</option>
                <option value="9">Check</option>
            </optgroup>
            <optgroup label="VOUCHER">
                <option value="5">Credit Voucher</option>
            </optgroup>
            <optgroup label="PAID">
                <option value="6">Paid</option>
            </optgroup>
            <optgroup disabled= "disabled" label="COMPLEMENTARY">
                <option value="7">Complementary</option>
            </optgroup>
        </select>

        <select id="opcion_pago_2" name="opcion_pago_2" style="display:none; margin-left:372px; margin-top: 3px; width:171px;">
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


        <select id="opcion_pago_3" name="opcion_pago_3" style="display:none; margin-left:424px; margin-top: -168px;">
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

       
        


        <div style="margin-left:556px; margin-top:-84px;">
                <ul class="tabs" style=" width:98%;">
                    
                    <li style=""><a href="#tab1">Saved Notes</a></li>
                    <li><a href="#tab2" onclick="foco_comment();">Add Notes</a></li>

                </ul>

                <div class="tab_container" style="height:155px; width: 388px;">
                    <div id="tab1" class="tab_content">
                        <!--Contenido del bloque-->

                        <textarea id="comments2" name="comments2" cols="0" rows="0"  disabled="disabled" style=" width: 375px; height: 142px; margin-left:-16px; margin-top:-17px; "><?php echo $data['tour']->comments2; ?></textarea>

                    </div>
                    <div id="tab2" class="tab_content">
                       <!--Contenido del bloque-->
                        <textarea id="comments" name="comments" cols="0" rows="0" style=" width: 375px; height: 142px; margin-left:-16px; margin-top:-17px;"></textarea>
                    </div>
                </div>

        </div>

        <input type="text" id="saldoPagado2"  style=" display:none; font-family: sans-serif; font-size: 22px; color:#000; font-weight: bold; padding-left:23px; margin-left: -32px; width: 83px;" value="" />

        <input type="text" name="opc_ap"  id="opc_ap" size="12" style="display:none;" value="0" />
        <input type="text" name="PAP" id="PAP" size="12" style="display:none;" value="0.00" />
        <input type="text" name="PAP2" id="PAP2" size="12" style="display:none;" value="0.00" />         
        <input type="text" name="etb" id="etb" size="12" style="display:none;" value="0.00" />
        <input type="text" name="paid_drivert" id="paid_drivert" size="12" style="display:none;" value="<?php echo number_format($data['tour']->paid_driver, 2, '.', ','); ?>" />
        <input type="text" name="pred_paid_amountt" id="pred_paid_amountt" size="12" style="display:none;" value="<?php echo number_format($data['tour']->pred_paid_amount, 2, '.', ','); ?>" />

        <input type="text" name="tot_charge" id="tot_charge" size="12" style="display:none;" value="<?php echo number_format($data['tour']->total_charge, 2, '.', ','); ?>" />
        <!--paid driver edition-->
        <input type="text" name="p_d_e" id="p_d_e" size="12" style="display:none;" value="<?php echo $data['tour']->paid_driver ?>" />
        <!--pay amount edition-->
        <input type="text" name="p_a_e" id="p_a_e" size="12" style="display:none;" value="<?php echo $data['tour']->pred_paid_amount ?>" />
        <input type="text" name="totalbalance" id="totalbalance" size="12" style="display:none;" value="0.00" />

        <table width="100%" style="position:absolute; background-color: transparent; margin-top: -190px;; margin-left:554px; height:179px; width:181px;">
             
            <tr>
                <td style="margin-left:1px; margin-top:0px;">

            <div id="miVentana2" style="position: absolute; width: 176px; height: 174px;  top:-1px; left: 0px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">

            <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#006394">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

<!--    <label  style="padding-left:57px; font-size:16px; "><strong style="padding-bottom:10px; color: #000; margin-left:-55px;">$</strong></label> -->
            <p>
                <label  id="tap" style="padding-left:57px; font-size:10px; "><strong style="padding-bottom:10px; color:#090; margin-left:-50px;">Total Amount Paid $</strong></label> 
                <input type="text" id="saldoPagado"  readonly="readonly" style="text-align: right; font-family: sans-serif; font-size: 10px; color:#090; font-weight: bold; padding-left:4px; margin-left: 126px; margin-top: -16px; width: 38px;" value="<?php echo number_format($data['tour']->total_paid, 2, '.', ''); ?>"  />
            </p>

            <label  id="dolares" style="padding-left:39px; font-size:16px; "><strong style="padding-bottom:10px; color:#006394; ">$</strong></label> 

            <!--class="money"-->
            <input type="text" id="pago_driver" name="pago_driver"  size="12" style="font-size: 22px; font-weight:bold; text-align:right; margin-top:-21px; margin-left:54px; width:114px; height:20px;" value="" placeholder = "0.00" onkeypress="return solopagodriver(event);"  onkeyup="dupliPago(); ponDecimales(2);" autocomplete="off"/>

            <input type="text" id="pago_driver2" name="pago_driver2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />

            

            <input type="text" id="collect" name="collect"  title="Paid Driver" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="<?php echo number_format($data['tour']->paid_driver, 2, '.', ''); ?>" />

            <input type="text" id="prepaid" name="prepaid"   title="Amount Paid" size="12" style="display:none;  margin-top:4px; margin-left:17px; width:114px; height:20px;" value="<?php echo number_format($data['tour']->pred_paid_amount, 2, '.', ''); ?>" />


<!--    <input name="someTextBox" type="text" id="someTextBox" size="12" style="display:none; margin-top:9px; margin-left:27px; width:114px; height:20px;" value="0.00" />-->


            <select name="opcion_pago1" id="op_pago_id1" style="margin-left:9px; margin-top: 8px;" disabled= "disabled" onclick="calculos();">
                <option style="color:red;" id="" value="0">((( Amount Paid )))</option>
                <optgroup label="PRE-PAID">
                    <option value="20">Credit Card NO Fee</option>
                    <option value="21">Credit Card with Fee</option>
                    <option value="22">Cash</option>
                    <option value="23">Check</option>
                </optgroup>
                <option style="color:blue;" id="" value="1">((( Paid Driver )))</option>
                <optgroup label="COLLECT ON BOARD">
                    <option value="24">Credit Card NO Fee</option>
                    <option value="25">Credit Card with Fee</option>
                    <option value="26">Cash</option>
                    <option value="27">Check</option>
                </optgroup>       


            </select>
            

            
            <div class="paymentvertblack" style="padding: 5px;  text-align: center; margin-top: 10px; height: 31px;">

                    <div>
                        <input type="button" id="btnExit" name="btnExit" style=" background-color: #006394; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; padding:5px; width:39px; height: 24px; font-size:9px; margin-top: 3px; margin-left: -124px; font-weight: bold;"  size="20"  value="EXIT" onclick="Exit();"  />
                    </div>
                    
                    <div>
                        <input type="button" id="btnCancelar" name="btnCancelar" style=" background-color: grey; border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; margin-left: -26px; margin-top: -24px; padding:5px; padding-left:3px; width:49px; font-weight: bold; font-size:9px;"  size="20"  disabled="true" value="CANCEL" onclick="resetal(); reset2();"  />
                    </div>
                    
                    <div>
                        <input type="button" id="btnAceptar" name="btnAceptar"  size="20" value="SAVE"  style=" border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; width:68px; height: 24px; font-size:9px; font-weight: bold; margin-left: 98px; margin-top: -24px;" onclick="ocultarVentana2();" disabled="true" />
                    </div>
                        
                    <div>    
                        <input type="button" id="btnPagolinea" name="btnPagolinea"  size="20" value="MAKE CHARGE"  style=" display:none; border-color: palegreen; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding:5px; padding-left:2px; width:68px; height: 24px; font-weight: bold; margin-right: -100px; margin-top: -24px; font-size:8px;  color:#fff; background-color:#006400;" onclick="" disabled="true" />
                    </div>
                        
                    <div>
                        <input type="button" id="btndecline" name="btndecline"  size="20" value="CANCEL"  style=" display:none; border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding:5px; padding-left:3px; width:49px; height: 24px; font-weight: bold; margin-top: -24px; font-size:9px; margin-left: -26px; color:#fff; background-color:red;" onclick="cancelar();" disabled="true" />
                    </div>
                    
                    <div>
                        <input type="button" id="btncancol" name="btncancol"  size="20" value="CANCEL"  style="display:none; background-color:red; border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding:5px; padding-left:3px; width:49px; height: 24px; font-weight: bold; margin-top: -24px; font-size:9px; margin-left: -26px; color:#fff;" onclick="cancelar_collect_on_board();" disabled="true" />
                    </div>
                    
                    <input type="button" id="enviar_escondido" value="0" style="display:none;" />

            </div>


            <input type="button" id="btnBD" name="btnBD" size="20" value="Balance_Due"  style="display:none; cursor:pointer; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px;" onclick="bal_due();"  />

            <input type="button" id="btnABD" name="btnABD" size="20" value="Agency_Balance_Due"  style="display:none; cursor:pointer; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px;" onclick="agen_bal_due();"  />

            <input type="button" id="btn_Other" name="btn_Other" size="10" value="Amount to Collect $"  style="display:none; cursor:pointer; margin-left:130px; margin-top:-396px; font-weight: bold; font-size: 16px; width: 163px; height: 27px;  border-color: red; " onclick="calc_other();"  />


        </div> 
                   
                    
            </td>
            
        </tr>
                
        </table>
        
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
            <input type ="hidden" id="actual_diff" name="actual_diff" value='0'>
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


        </table>  


        <!-- ******************************** OCULTAR TABLA TOUR COST ****************************************************************-->
        <table style="display:none; margin-top:625px; margin-left:10px;">
            <tr>
                <td valign="" >
                    <div id="t-total2" style="margin-left:64px;">
                        <div class="label"><strong>Tour Cost</strong></div>
                    </div>
                </td>
                <td>
                    <div id="t-total2" style="width:168px;">
                        <div class="price">
<!--                            <samp  id="totalAmount">$ 0.00</samp>-->
<!--                            <input type="text"  class="orangered"   id="totalAmount" value="" onKeyUp="dupliac();" style="float: right; width:85px; height: 25px; margin-top: -6px; text-align: right; font-weight:bold; color:#fff; border: 1px #33F solid; font-size:22px; padding-left:5px; " autocomplete="off" onkeypress="validate(event);" />-->
                        </div>
                    </div>
                </td>
                <td><span style="margin-left:50px;"><strong> Disc %</strong></span>
<!--                    <input name="descuento" type="number" id="descuento" maxlength="3" class="txtNumbers" onkeyup="" max="100" min="0"  value="<?php echo $data['tour']->descuento_procentaje ?>"  style="height:16px; width:75px;" />-->
                </td>

            </tr>
            <tr>
                <td><label style="margin-left:66px;font-weight:bold;">Extra Charges</label></td>
                <td colspan="">
<!--                    <input class="txtNumbers" name="extra" type="text" id="extra" size="12" style=" padding-left:5px; width:160px; height:20px;" min="0"   value="<?php echo $data['tour']->extra_charge; ?>" autocomplete="off" />-->
                </td>
                <td>
                    <label style="margin-left:50px;"><strong> Disc &nbsp;$</strong></label>
<!--                    <input name="descuento_valor" type="number" class="txtNumbers" id="descuento_valor" size="12" maxlength="10" pattern="6[0-9]" style="height:16px; width:75px;" value="<?php echo $data['tour']->descuento_valor ?>"  />-->
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
                        <input  type="text" class="txtNumbers"  name="otheramount" id="otheramount" value="<?php /*echo $data['tour']->otheramount_sin_tax;*/ ?>"  style="padding-left:5px; width:160px; height:20px;" autocomplete="off" />
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
                        <input  type="text"  id="saldoporpagar" name="saldoporpagar" class="verd" value="<?php echo number_format($data['tour']->total, 2, '.', ''); ?>" style=" margin-left:3px; margin-top: -23px; width:90px; height:25px; text-align: right; border:1px #33F solid;  color:#000; font-family:arial; font-size: 22px; font-weight:bold;" onKeyUp="dupliac();" autocomplete="off" onkeypress="validate(event);" />
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
                        <div>
                            <div class="price" style="border:1px #AC1B29 solid; background-color:#00A500; color:#fff;">
                                <samp  id="saldoprepaid"><?php echo $data['pagado'] ?></samp>
                                <input  type="text"  id="saldoprepaid" name="saldoprepaid" class="verd" value="<?php echo number_format($data['pagado'], 2, '.', ''); ?>" style=" margin-left:3px; margin-top: -23px; width:90px; height:25px; text-align: right; border:1px #33F solid;  color:#000; font-family:arial; font-size: 22px; font-weight:bold;" onKeyUp="dupliac();" autocomplete="off" onkeypress="validate(event);" />

                            </div>

                            <div>

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
                <!--                            <samp id="saldoactual">$0.00</samp>-->
<!--                                            <input  type="text"  id="saldoactual" />-->
                                        </div>
                                    </div>
                                </td>
                                <td>
<!--                                    <select name="opcion_pago" id="op_pago_id" style="margin-left:-274px; margin-top:-890px; width: 171px;">
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
                                    </select>-->
                                </td>
                            </tr>
                            <tr id="pay_amount_html">
                                <td valign="" >
<!--                                    <a  id="pago_agente" style="display:block" ><img style="width: 4px;  height:4px; margin-left: 374px;  margin-top: -753px; cursor:pointer" src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" />
                                        <label style="text-align:left; font-weight:bold;   position: absolute;   margin-top: 19px;    margin-left: 9px;">Pay a Amount</label>
                                    </a>-->

                                </td>
                                <td>
                                    <div id="t-total2" style="width:170px;">
                                        <input autocomplete="off" type="text" class="txtNumbers"  name="pay_amount" id="pay_amount" value=""  style="padding-left:5px; width:160px; height:20px; font-weight:bold;" />
                                    </div>
                                </td>
                                <td>
<!--                                    <select name="opcion_pago_2" style="margin-left:15px;">
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
                                    </select>-->
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td align="right">
                                    &nbsp;<a style="cursor:pointer; margin-left:-18px;" id="btn-save2"><img width="50" height="40" src="<?php echo $data['rootUrl']; ?>global/img/admin/save2.png" /></a>
                                    <a title="Save" class="oliverty" style="margin-top: 16px; margin-right: -44px; cursor:pointer" id="btn-save2"><i class="fa fa-floppy-o fa-4x" style="color: #AC1B29;"></i></a>
                                    <input  type="button" id="btn-save2" title="Save" class="oliverty"   class="link-button" value="SAVE"/>
                                </td>
                                <td align="right">

                                    <a href="<?php echo $data['rootUrl'] ?>admin/home" title="Exit" style="margin-top: 16px; margin-right: 4px; cursor:pointer" id="btn-exit"><i class="fa fa-external-link-square fa-4x" style="color:#AC1B29;"></i></a>  

                                </td>
                                <td align="right">
                                    &nbsp;<a style="cursor:pointer;margin-left:-18px; display: none;"  id="btn-save1"><img width="50" height="40" src="<?php echo $data['rootUrl']; ?>global/img/admin/save2.png" /></a>
                                </td>
                            <a id="enviarF" style="display: none;"><img src="<?php echo $data['rootUrl'] ?>/global/img/admin/charge.png"></a>
                            </table>

                            <!--*******************************************FIN TABLA *******************************************************************************************************-->
            </fieldset> 
            
        <main>
        <!--  <h2>Editar Reserva</h2>-->
            <input type="radio" id="mostrar-modal" name="modal" onclick="pregunta(event);"/>
            <label class="flotante" style="margin-left:-384px; color:#fff;" for="mostrar-modal">Editar</label>                         
            <div id="modal">                        
            </div>
        </main>
        
        <input type="text" id="temp" name="temp" title="Fees" size="12" style="display:none; position:absolute; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="<?php echo number_format($data['tour']->total_charge, 2, '.', ''); ?>" />

        <input type="text" id="temp_driver"  name="temp_driver" title="Temp Driver" size="12" style="display:none; margin-top:4px; margin-left:-230px; width:114px; height:20px;" value="<?php echo $cargoscob; ?>" />
        <input type="text" id="temp_prepaid"  name="temp_prepaid" title="Temp Prepaid" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="<?php echo $cargospp; ?>" />
        
        <br>
        </br>
            
        <input type="text" id="no_pago"  name="no_pago" title="# pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="no_prep"  name="no_prep" title="# prep" size="12" style="display:none; margin-top:4px; margin-left:417px; width:18px; height:11px;" value="0" />
        <br>
        </br>
        <input type="text" id="pago_1"  name="pago_1" title="pago # 1" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago1"  name="pago1" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago1"  name="tipo_pago1" title="tipo pago1" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado1"  name="pagado1" title="pagado1" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

        <input type="text" id="pago_pre1"  name="pago_pre1" title="pago # 1" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre1"  name="pagopre1" title="pago prep1" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre1"  name="tipo_pagopre1" title="tipo pagopre1" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre1"  name="pagadopre1" title="pagadopre1" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />

        <br>
        </br>
        <input type="text" id="pago_2"  name="pago_2" title="pago # 2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago2"  name="pago2" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago2"  name="tipo_pago2" title="tipo pago2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado2"  name="pagado2" title="pagado2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

        <input type="text" id="pago_pre2"  name="pago_pre2" title="pago # 2" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre2"  name="pagopre2" title="pago prep2" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre2"  name="tipo_pagopre2" title="tipo pagopre2" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre2"  name="pagadopre2" title="pagadopre2" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />


        <br>
        </br>
        <input type="text" id="pago_3"  name="pago_3" title="pago # 3" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago3"  name="pago3" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago3"  name="tipo_pago3" title="tipo pago3" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado3"  name="pagado3" title="pagado3" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

        <input type="text" id="pago_pre3"  name="pago_pre3" title="pago # 3" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre3"  name="pagopre3" title="pago prep3" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre3"  name="tipo_pagopre3" title="tipo pagopre3" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre3"  name="pagadopre3" title="pagadopre3" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />


        <br>
        </br>
        <input type="text" id="pago_4"  name="pago_4" title="pago # 4" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago4"  name="pago4" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago4"  name="tipo_pago4" title="tipo pago4" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado4"  name="pagado4" title="pagado4" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

        <input type="text" id="pago_pre4"  name="pago_pre4" title="pago # 4" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre4"  name="pagopre4" title="pago prep4" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre4"  name="tipo_pagopre4" title="tipo pagopre4" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre4"  name="pagadopre4" title="pagadopre4" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />

        <br>
        </br>
        <input type="text" id="pago_5"  name="pago_5" title="pago # 5" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago5"  name="pago5" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago5"  name="tipo_pago5" title="tipo pago5" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado5"  name="pagado5" title="pagado5" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

        <input type="text" id="pago_pre5"  name="pago_pre5" title="pago # 5" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre5"  name="pagopre5" title="pago prep5" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre5"  name="tipo_pagopre5" title="tipo pagopre5" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre5"  name="pagadopre5" title="pagadopre5" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />

        <br>
        </br>
        <input type="text" id="pago_6"  name="pago_6" title="pago # 6" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago6"  name="pago6" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago6"  name="tipo_pago6" title="tipo pago6" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado6"  name="pagado6" title="pagado6" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

        <input type="text" id="pago_pre6"  name="pago_pre6" title="pago # 6" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre6"  name="pagopre6" title="pago prep6" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre6"  name="tipo_pagopre6" title="tipo pagopre6" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre6"  name="pagadopre6" title="pagadopre6" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />

        <br>
        </br>
        <input type="text" id="pago_7"  name="pago_7" title="pago # 7" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago7"  name="pago7" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago7"  name="tipo_pago7" title="tipo pago7" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado7"  name="pagado7" title="pagado7" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

        <input type="text" id="pago_pre7"  name="pago_pre7" title="pago # 7" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre7"  name="pagopre7" title="pago prep7" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre7"  name="tipo_pagopre7" title="tipo pagopre7" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre7"  name="pagadopre7" title="pagadopre7" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />

        <br>
        </br>
        <input type="text" id="pago_8"  name="pago_8" title="pago # 8" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago8"  name="pago8" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago8"  name="tipo_pago8" title="tipo pago8" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado8"  name="pagado8" title="pagado8" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

        <input type="text" id="pago_pre8"  name="pago_pre8" title="pago # 8" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre8"  name="pagopre8" title="pago prep8" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre8"  name="tipo_pagopre8" title="tipo pagopre8" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre8"  name="pagadopre8" title="pagadopre8" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />

        <br>
        </br>
        <input type="text" id="pago_9"  name="pago_9" title="pago # 9" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago9"  name="pago9" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago9"  name="tipo_pago9" title="tipo pago9" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado9"  name="pagado9" title="pagado9" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

        <input type="text" id="pago_pre9"  name="pago_pre9" title="pago # 9" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre9"  name="pagopre9" title="pago prep9" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre9"  name="tipo_pagopre9" title="tipo pagopre9" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre9"  name="pagadopre9" title="pagadopre9" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />

        <br>
        </br>
        <input type="text" id="pago_10"  name="pago_10" title="pago # 10" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago10"  name="pago10" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago10"  name="tipo_pago10" title="tipo pago10" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado10"  name="pagado10" title="pagado10" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />

        <input type="text" id="pago_pre10"  name="pago_pre10" title="pago # 10" size="12" style="display:none; margin-top:4px; margin-left:63px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre10"  name="pagopre10" title="pago prep10" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre10"  name="tipo_pagopre10" title="tipo pagopre10" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre10"  name="pagadopre10" title="pagadopre10" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />

        <input type="text" style="display:none; margin-left: 158px; margin-top: 5px; width:30px; color: #0B55C4; font-weight: bold; font-size: 18px; text-align: center;" name="idagencia" id="idagencia"  size="10" maxlength="10"  value="<?php echo $voucher; ?>" autocomplete="off"/>
        <input name="fecha_trip" type="text"  id="fecha_trip"  size="10" maxlength="16" value=""  autocomplete="off" style="display:none; height: 22px; text-align: center; font-weight:bold;" />
        <input type="button" style="display:none;" id="btn-pax"   value="Change Pax" onclick="preguntaTrip2();"/> 
        
        <input type="text" style="display:none; margin-left: 158px; margin-top: 5px; width:30px; color: #0B55C4; font-weight: bold; font-size: 18px; text-align: center;" name="incl_ticket" id="incl_ticket"  size="10" maxlength="10"  value="<?php echo $include_park; ?>" autocomplete="off"/>
<!--        <input type="text" style=" margin-left: 158px; margin-top: 5px; width:30px; color: #0B55C4; font-weight: bold; font-size: 18px; text-align: center;" name="cambiar_tikete" id="cambiar_tikete"  size="10" maxlength="10"  value="" autocomplete="off"/>-->
        
        
        </form>
    
        <input  type="text" id="disp301" name="disp301" style="width:24px; display:none;" value="<?php echo $disponible301; ?>" />
        <input  type="text" id="disp300" name="disp300" style="width:24px; display:none;" value="<?php echo $disponible300; ?>" />
        
        <input type="button" style="display:none;" id="btn-load"   value="Cargar Puesto"/> 
        <input type="button" style="display:none;" id="btn-update"   value="Actualizar Puesto"/>         
        <div id="puestosEnUso"></div>        
        <div id="CargaTrip"></div>
        
        <div style="display:none;" id="mensajeTrip"></div>
        
        <div class="" id="save2" style="position:absolute; overflow: visible; z-index: 1000; margin-left: 392px; margin-top: -332px; font-weight: bold; font-size: 16px; display:none;">                
                  
            <a style="margin-left: -133px; margin-top: -667px; position: absolute;" href='<?php echo $data['rootUrl'] ?>admin/onedaytour/add/'><img src ='<?php echo $data['rootUrl'] ?>global/img/spinner1.gif' width="25px" height="25px" margin-left="85px" margin-top="-127px">
    
        </div>      
        
        <div class="" id="save3" style="position:absolute; overflow: visible; z-index: 1000; margin-left: 373px; margin-top: -332px; font-weight: bold; font-size: 16px; display:none;">                
     
            <a style="margin-left: 381px; margin-top: -667px; position: absolute;" href='<?php echo $data['rootUrl'] ?>admin/onedaytour/add/'><img src ='<?php echo $data['rootUrl'] ?>global/img/spinner2.gif' width="25px" height="25px" margin-left="85px" margin-top="-127px">
        
        </div>  
        
        <div class="" id="sur2015" style="position:absolute; overflow: visible; z-index: 1000; margin-left: 0px; margin-top: 0px; font-weight: bold; font-size: 16px; display:none;">                
     
            <a style="margin-left: 575px; margin-top: -1775px; position: absolute;" href=''><img src ='<?php echo $data['rootUrl'] ?>global/img/sur2015.gif' width="115px" height="85px" margin-left="0px" margin-top="0px">
        
        </div>  
        
        <img id="print" title= "Print Credit Card" onclick="window.print();" style="position:absolute; margin-left: 173px; margin-top: 26px; "src ='<?php echo $data['rootUrl'] ?>global/img/print.png' width="35px" height="35px" margin-left="0px" margin-top="0px">
        <!--second scripting part-->
        <div id="initialscript">
            <?php echo $data['scripts'] ?>
        </div>
        <div id="debug"></div>   


        <script type="text/javascript">
            function cargando()
            {
                document.getElementById('save2').style.display = '';
                document.getElementById('save3').style.display = '';

            }
        </script>                 
                     

            <script type="text/javascript">

                function change_oppago()
                {

                   document.getElementById('opcionpago').value = document.getElementById('op_pago_id').value;



                }

            </script>



            <script type="text/javascript">

                function make_charge()
                {

                    var payamount = document.getElementById('pay_amount').value;



                    if (payamount > 0) {
//                        var op = 8;
//                        alert(op);
//                        exit;
//                        document.getElementById('op_pago_id').value = 8;
//                        var pg = document.getElementById('pago_agente');
//                        var pg1 = document.getElementById('pago_agente1');
//                        pg.style.display = 'block';
//                        pg1.style.display = 'none';

                    } else {
//                        pg.style.display = 'none';
//                        pg1.style.display = 'block';

                    }

                }

            </script>

            <script type="text/javascript">

                function pago_click()
                {
                    var pag = document.getElementById('pago_agente');
                    var pag1 = document.getElementById('pago_agente1');

                }

            </script>

            <script type="text/javascript">

                function outcharge()
                {
                    var pamount = document.getElementById('pay_amount').value;

                }

            </script>

            <script type="text/javascript">

            function resetal()
                    {

                   
                    //document.getElementById('saldoporpagar').value = apagar;
                    var op_pago_conductor = "<?php echo $op_pago_conductor; ?>";         
                    var op_pag_conduct = $("#selectcond").val();
                                                          
                    var pay_amount = '0.00';

                    var paid_driver = $("#paid_driver").val();

                    var pago_driver = $("#pago_driver").val();

                    var totalamount = $("#totalAmount").val();

                    var saldoactual = $("#saldoactual").val();

                    $("#pay_amount").val(pay_amount);

//        document.getElementById('pay_amount').value = pay_amount;

                    document.getElementById('op_pago_id2').value = 2;

                    document.getElementById('pago_driver').value = '';
                    document.getElementById('pago_driver').style.color = '#848484';

                    document.getElementById('pago_driver2').value = '0.00';

                    document.getElementById('op_pago_id1').value = 0;

                    document.getElementById('temp').value = '0.00';
                    document.getElementById('temp_driver').value = '0.00';
                    document.getElementById('temp_prepaid').value = '0.00';
                    document.getElementById('pago_tarjeta').value = '0.00';
                    document.getElementById('prepaid').value = '0.00';
                    document.getElementById('collect').value = '0.00';
                    document.getElementById('pago_driver').disabled = false;

                    document.getElementById('btnAceptar').style.background = '';
                    document.getElementById('btnAceptar').style.color = '#000';
                    document.getElementById('dolares').style.color = '#848484';
                    document.getElementById('btnAceptar').style.cursor = '';
                    //document.getElementById('btnAceptar').disabled = true;
                    document.getElementById('op_pago_conductor').value = op_pago_conductor;
                    document.getElementById('selectcond').value = op_pag_conduct; 
                    
                    document.getElementById('paid_driver').style.color = "#000";
                    document.getElementById('pay_amount').style.color = "#000";
                    document.getElementById('pay_amount').className = "azu";
                    document.getElementById('paid_driver').className = "brown3";
                    document.getElementById('paid_driver').title =""; 
                    document.getElementById('pay_amount').title =""; 
                    
                    //Pagos Collect on Board
                    document.getElementById('no_pago').value = '0';
                    document.getElementById('pago_1').value = '0';
                    document.getElementById('pago_2').value = '0';
                    document.getElementById('pago_3').value = '0';
                    document.getElementById('pago_4').value = '0';
                    document.getElementById('pago_5').value = '0';
                    document.getElementById('pago_6').value = '0';
                    document.getElementById('pago_7').value = '0';
                    document.getElementById('pago_8').value = '0';
                    document.getElementById('pago_9').value = '0';
                    document.getElementById('pago_10').value = '0';
                    document.getElementById('pago1').value = '';
                    document.getElementById('pago2').value = '';
                    document.getElementById('pago3').value = '';
                    document.getElementById('pago4').value = '';
                    document.getElementById('pago5').value = '';
                    document.getElementById('pago6').value = '';
                    document.getElementById('pago7').value = '';
                    document.getElementById('pago8').value = '';
                    document.getElementById('pago9').value = '';
                    document.getElementById('pago10').value = '';
                    document.getElementById('tipo_pago1').value = '';
                    document.getElementById('tipo_pago2').value = '';
                    document.getElementById('tipo_pago3').value = '';
                    document.getElementById('tipo_pago4').value = '';
                    document.getElementById('tipo_pago5').value = '';
                    document.getElementById('tipo_pago6').value = '';
                    document.getElementById('tipo_pago7').value = '';
                    document.getElementById('tipo_pago8').value = '';
                    document.getElementById('tipo_pago9').value = '';
                    document.getElementById('tipo_pago10').value = '';        
                    document.getElementById('pagado1').value = '0.00';
                    document.getElementById('pagado2').value = '0.00';
                    document.getElementById('pagado3').value = '0.00';
                    document.getElementById('pagado4').value = '0.00';
                    document.getElementById('pagado5').value = '0.00';
                    document.getElementById('pagado6').value = '0.00';
                    document.getElementById('pagado7').value = '0.00';
                    document.getElementById('pagado8').value = '0.00';
                    document.getElementById('pagado9').value = '0.00';
                    document.getElementById('pagado10').value = '0.00';


                    //Pagos prepago

                    document.getElementById('no_prep').value = '0';
                    document.getElementById('pago_pre1').value = '0';
                    document.getElementById('pago_pre2').value = '0';
                    document.getElementById('pago_pre3').value = '0';
                    document.getElementById('pago_pre4').value = '0';
                    document.getElementById('pago_pre5').value = '0';
                    document.getElementById('pago_pre6').value = '0';
                    document.getElementById('pago_pre7').value = '0';
                    document.getElementById('pago_pre8').value = '0';
                    document.getElementById('pago_pre9').value = '0';
                    document.getElementById('pago_pre10').value = '0';




                    document.getElementById('pagopre1').value = '';
                    document.getElementById('pagopre2').value = '';
                    document.getElementById('pagopre3').value = '';
                    document.getElementById('pagopre4').value = '';
                    document.getElementById('pagopre5').value = '';
                    document.getElementById('pagopre6').value = '';
                    document.getElementById('pagopre7').value = '';
                    document.getElementById('pagopre8').value = '';
                    document.getElementById('pagopre9').value = '';
                    document.getElementById('pagopre10').value = '';



                    document.getElementById('tipo_pagopre1').value = '';
                    document.getElementById('tipo_pagopre2').value = '';
                    document.getElementById('tipo_pagopre3').value = '';
                    document.getElementById('tipo_pagopre4').value = '';
                    document.getElementById('tipo_pagopre5').value = '';
                    document.getElementById('tipo_pagopre6').value = '';
                    document.getElementById('tipo_pagopre7').value = '';
                    document.getElementById('tipo_pagopre8').value = '';
                    document.getElementById('tipo_pagopre9').value = '';
                    document.getElementById('tipo_pagopre10').value = '';


                    document.getElementById('pagadopre1').value = '0.00';
                    document.getElementById('pagadopre2').value = '0.00';
                    document.getElementById('pagadopre3').value = '0.00';
                    document.getElementById('pagadopre4').value = '0.00';
                    document.getElementById('pagadopre5').value = '0.00';
                    document.getElementById('pagadopre6').value = '0.00';
                    document.getElementById('pagadopre7').value = '0.00';
                    document.getElementById('pagadopre8').value = '0.00';
                    document.getElementById('pagadopre9').value = '0.00';
                    document.getElementById('pagadopre10').value = '0.00';


                    document.getElementById('pago_driver').disabled = false;

                    document.getElementById('btnAceptar').style.background = '';
                    document.getElementById('btnAceptar').style.color = '#000';
                    document.getElementById('dolares').style.color = '#848484';
                    document.getElementById('btnAceptar').style.cursor = '';

                    document.getElementById('paid_driver').style.color = "#000";
                    document.getElementById('pay_amount').style.color = "#000";
                    document.getElementById('pay_amount').className = "azu";
                    document.getElementById('paid_driver').className = "brown3";
                    document.getElementById('paid_driver').title =""; 
                    document.getElementById('pay_amount').title =""; 


                    document.getElementById('op_pago_id2').value = 2;
                    document.getElementById('op_pago_id1').value = 0;
                    document.getElementById('op_pago_id').value = 8;
                    document.getElementById('op_pago_conductor').value = 8; 
                    document.getElementById('selectcond').value = 8; 
            
                    
                    calcularTotalPago();                    
               

                }
            </script>


            <script type="text/javascript">

                function tipopago()
                {

                    var op_pago = document.getElementById('op_pago').value;

                    //CREDIT CARD NO FEE
                    if (op_pago == 8) {

                        document.getElementById('op_pago_id').value = 8;
                        $('#op_pago_id').click();

                    }

                    //CREDIT CARD WITH FEE
                    if (op_pago == 3) {

                        $('#op_pago_id').click();
                        document.getElementById('op_pago_id').value = 3;
                        balance_pasajero();

                    }



                    //CASH
                    if (op_pago == 4) {

                        document.getElementById('op_pago_id').value = 4;
                        $('#op_pago_id').click();

                    }

                    //CREDIT VOUCHER
                    if (op_pago == 9) {

                        document.getElementById('op_pago_id').value = 9;
                        $('#op_pago_id').click();

                    }

                    //CREDIT VOUCHER
                    if (op_pago == 5) {

                        document.getElementById('op_pago_id').value = 5;
                        $('#op_pago_id').click();

                    }

                    //COMPLEMENTARY
                    if (op_pago == 7) {

                        document.getElementById('op_pago_id').value = 7;
                        $('#op_pago_id').click();

                    }
                }
            </script>

            <script type="text/javascript">
                function reset2()
                {
                    setTimeout(function () {

                        $('#btnAceptar').click();
                        //document.getElementById('tot_amount_paid').value = '0.00';
                        //refrescamos las rutas que vienen de la tabla reservas de la base de datos
                        document.getElementById('from').value = "<?php echo $fromt; ?>";
                        document.getElementById('to2').value = "<?php echo $tot2; ?>";


                    }, 0.001);


                    setTimeout(function () {

                        tipopago();

                    }, 100);

                }

            </script>
            
            <script type="text/javascript">
            foco_comment(){
                
                document.getElementById('comments2').disabled = false;
                $("#comments2").focus();
            }

            </script>

            <script type="text/javascript">
                function dupliPago()
                {
                    //       ("#pago_driver").mask("99,99");
                    var dupli = document.getElementById('pago_driver').value;
                    document.getElementById('pago_driver2').value = dupli;

                    if (dupli == '') {
                        document.getElementById('pago_driver').value = '0.00';

                        document.getElementById('pago_driver').style.color = '#848484';

                        document.getElementById('dolares').style.color = '#848484';

                        $("#pago_driver").focus();
                    }

                    if (dupli > '0.00') {
                        document.getElementById("op_pago_id1").disabled = false;

                        document.getElementById('pago_driver').style.color = '#000';

                        document.getElementById('dolares').style.color = '#000';

                        $("#pago_driver").focus();



                    } else {

                        document.getElementById("op_pago_id1").disabled = false;

                        document.getElementById('pago_driver').style.color = '#000';

                        document.getElementById('dolares').style.color = '#000';

                        $("#pago_driver").focus();


                    }

                }
            </script>
            
            <script type="text/javascript">

                            function pregunta(e) {
                                if (confirm('¿Esta seguro de que desea Editar este One Day Tours?')) {
                                    //document.formborrar.submit() 

                                    document.getElementById('modal').style.display = 'none';
                                    //document.getElementbyId('mostrar-modal').style.display = 'none';


                                } else {
                                    e.preventDefault();
                                }
                            }

            </script>


            <script>

                function calculos() {


                    var opcion = $("#op_pago_id1").val();

                    //*****************************************************PRED-PAID*************************************************************//
                    //***************************************************************************************************************************//

                    //Credit Card no fee

                    if (opcion === '20') {

                        //alert('opcion 20');
                        if (confirm('Confirme su Tipo de Pago !!!')) {

                            
                            var pago_driver2 = parseFloat($("#pago_driver2").val());
                            var agency_balance_due = parseFloat($("#agency_balance_due").val());
                            var total = parseFloat(pago_driver2);
                            var valor = 0;
                            var prepaid = parseFloat($("#prepaid").val());
                            var kollect = parseFloat($("#pago_driver").val());
                            
                            var no_prep =  document.getElementById("no_prep").value;
                            no_prep = parseInt(no_prep) + 1;

                            var pago = 'PRED-PAID'; 
                            var tipo_pago = 'CREDIT CARD NO FEE';
                            
                            if(agency_balance_due <= "0"){                 
                         
                            document.getElementById('pago_driver').value = "0.00"; 
                            document.getElementById("btnPagolinea").disabled = true;
                            document.getElementById("btnPagolinea").style.display = "none";
                            document.getElementById("btndecline").style.display = "none"; 
                            document.getElementById("btnAceptar").disabled = true;
                            document.getElementById("btnAceptar").style.background = "lightgray";   

                            alert("Este pago no puede ser Procesado!!!");              
                            Exit();

                            }else{
                            

                            prepaid = parseFloat(prepaid) + parseFloat(total);
                            
                            $("#no_prep").val(no_prep);
                            $("#prepaid").val((prepaid).toFixed(2));
                            $("#pago_driver").val((total).toFixed(2));   
                            $("#pago_tarjeta").val((total).toFixed(2));
                            $("#PAP").val((valor).toFixed(2));
                            
                            if(no_prep == 1){                    
                                      
                            document.getElementById("pago_pre1").value = no_prep;
                            document.getElementById("pagopre1").value = pago;
                            document.getElementById("tipo_pagopre1").value= tipo_pago;
                            $("#pagadopre1").val((kollect).toFixed(2));

                            }else if(no_prep == 2){

                                document.getElementById("pago_pre2").value = no_prep;
                                document.getElementById("pagopre2").value = pago;
                                document.getElementById("tipo_pagopre2").value= tipo_pago;
                                $("#pagadopre2").val((kollect).toFixed(2));

                            }else if(no_prep == 3){

                                document.getElementById("pago_pre3").value = no_prep;
                                document.getElementById("pagopre3").value = pago;
                                document.getElementById("tipo_pagopre3").value= tipo_pago;
                                $("#pagadopre3").val((kollect).toFixed(2));

                            }else if(no_prep == 4){

                                document.getElementById("pago_pre4").value = no_prep;
                                document.getElementById("pagopre4").value = pago;
                                document.getElementById("tipo_pagopre4").value= tipo_pago;
                                $("#pagadopre4").val((kollect).toFixed(2));

                            }else if(no_prep == 5){

                                document.getElementById("pago_pre5").value = no_prep;
                                document.getElementById("pagopre5").value = pago;
                                document.getElementById("tipo_pagopre5").value= tipo_pago;
                                $("#pagadopre5").val((kollect).toFixed(2));

                            }else if(no_prep == 6){

                                document.getElementById("pago_pre6").value = no_prep;
                                document.getElementById("pagopre6").value = pago;
                                document.getElementById("tipo_pagopre6").value= tipo_pago;
                                $("#pagadopre6").val((kollect).toFixed(2));

                            }else if(no_prep == 7){

                                document.getElementById("pago_pre7").value = no_prep;
                                document.getElementById("pagopre7").value = pago;
                                document.getElementById("tipo_pagopre7").value= tipo_pago;
                                $("#pagadopre7").val((kollect).toFixed(2));

                            }else if(no_prep == 8){

                                document.getElementById("pago_pre8").value = no_prep;
                                document.getElementById("pagopre8").value = pago;
                                document.getElementById("tipo_pagopre8").value= tipo_pago;
                                $("#pagadopre8").val((kollect).toFixed(2));

                            }else if(no_prep == 9){

                                document.getElementById("pago_pre9").value = no_prep;
                                document.getElementById("pagopre9").value = pago;
                                document.getElementById("tipo_pagopre9").value= tipo_pago;
                                $("#pagadopre9").val((kollect).toFixed(2));

                            }else if(no_prep == 10){

                                document.getElementById("pago_pre10").value = no_prep;
                                document.getElementById("pagopre10").value = pago;
                                document.getElementById("tipo_pagopre10").value= tipo_pago;
                                $("#pagadopre10").val((kollect).toFixed(2));

                            }
                            

                            document.getElementById("op_pago_id1").disabled = true;                     
                            document.getElementById("pago_driver").disabled = true;
                            document.getElementById('pago_driver').style.color = '#848484';
                            
                            document.getElementById("btnPagolinea").disabled = false;
                            document.getElementById("btnPagolinea").style.display = "";
                            document.getElementById("btnPagolinea").style.cursor = 'pointer';

                            document.getElementById("btndecline").disabled = false;
                            document.getElementById("btndecline").style.display = "";
                            document.getElementById("btndecline").style.cursor = 'pointer';     

                            document.getElementById("btnAceptar").disabled = false;
                            document.getElementById('btnAceptar').style.cursor = 'pointer';
                            document.getElementById('btnAceptar').style.background = '#006400';
                            document.getElementById('btnAceptar').style.color = '#fff';
                            
                            document.getElementById('opcion_pago_2').value = 2;
                            document.getElementById('opcion_pago_3').value = 2;
                            //document.getElementById('op_pago_id').value = 8;
                            
                            valida_clase2();

                            }

                        } else {
                            // Do nothing!
                            
                            Exit2();
                        }


                    }

                    //Credit Card with fee

                    if (opcion == '21') {
                        
                       
                        if (confirm('Confirme su Tipo de Pago !!!')) {


                            var pago_driver2 = parseFloat($("#pago_driver2").val());
                            var pago_driver = parseFloat($("#pago_driver").val());
                            var agency_balance_due = parseFloat($("#agency_balance_due").val());
                            var valor = parseFloat(pago_driver2) * 0.04;
                            var total = parseFloat(pago_driver2) + parseFloat(valor);                            
                            var temp_prepaid = parseFloat($("#temp_prepaid").val());
                            var temp = parseFloat($("#temp").val());
                            
                            var no_prep =  document.getElementById("no_prep").value;
                            no_prep = parseInt(no_prep) + 1;

                            var pago = 'PRED-PAID'; 
                            var tipo_pago = 'CREDIT CARD WITH FEE';


                            if(agency_balance_due <= "0"){

                            document.getElementById('pago_driver').value = "0.00"; 
                            document.getElementById("btnPagolinea").disabled = true;
                            document.getElementById("btnPagolinea").style.display = "none";
                            document.getElementById("btndecline").style.display = "none"; 
                            document.getElementById("btnAceptar").disabled = true;
                            document.getElementById("btnAceptar").style.background = "lightgray";   

                            alert("Este pago no puede ser Procesado!!!");                    
                            Exit();

                            }else{                 
                                                        
                            temp = parseFloat(temp) + parseFloat(valor);
                            temp_prepaid = parseFloat(temp_prepaid) + parseFloat(valor);
                            $("#temp").val((temp).toFixed(2));
                            $("#temp_prepaid").val((temp_prepaid).toFixed(2));

                            var prepaid = parseFloat($("#prepaid").val());
                            prepaid = parseFloat(prepaid) + parseFloat(total);

                            $("#no_prep").val(no_prep);
                            $("#prepaid").val((prepaid).toFixed(2));
                            $("#pago_driver").val((total).toFixed(2)); 
                            $("#pago_tarjeta").val((total).toFixed(2));
                            $("#tot_charge").val((temp).toFixed(2));
                            $("#PAP").val((valor).toFixed(2));
                            
                            
                            if(no_prep == 1){
                                                          
                            document.getElementById("pago_pre1").value = no_prep;
                            document.getElementById("pagopre1").value = pago;
                            document.getElementById("tipo_pagopre1").value= tipo_pago;
                            $("#pagadopre1").val((total).toFixed(2));

                            }else if(no_prep == 2){

                                document.getElementById("pago_pre2").value = no_prep;
                                document.getElementById("pagopre2").value = pago;
                                document.getElementById("tipo_pagopre2").value= tipo_pago;
                                $("#pagadopre2").val((total).toFixed(2));

                            }else if(no_prep == 3){

                                document.getElementById("pago_pre3").value = no_prep;
                                document.getElementById("pagopre3").value = pago;
                                document.getElementById("tipo_pagopre3").value= tipo_pago;
                                $("#pagadopre3").val((total).toFixed(2));

                            }else if(no_prep == 4){

                                document.getElementById("pago_pre4").value = no_prep;
                                document.getElementById("pagopre4").value = pago;
                                document.getElementById("tipo_pagopre4").value= tipo_pago;
                                $("#pagadopre4").val((total).toFixed(2));

                            }else if(no_prep == 5){

                                document.getElementById("pago_pre5").value = no_prep;
                                document.getElementById("pagopre5").value = pago;
                                document.getElementById("tipo_pagopre5").value= tipo_pago;
                                $("#pagadopre5").val((total).toFixed(2));

                            }else if(no_prep == 6){

                                document.getElementById("pago_pre6").value = no_prep;
                                document.getElementById("pagopre6").value = pago;
                                document.getElementById("tipo_pagopre6").value= tipo_pago;
                                $("#pagadopre6").val((total).toFixed(2));

                            }else if(no_prep == 7){

                                document.getElementById("pago_pre7").value = no_prep;
                                document.getElementById("pagopre7").value = pago;
                                document.getElementById("tipo_pagopre7").value= tipo_pago;
                                $("#pagadopre7").val((total).toFixed(2));

                            }else if(no_prep == 8){

                                document.getElementById("pago_pre8").value = no_prep;
                                document.getElementById("pagopre8").value = pago;
                                document.getElementById("tipo_pagopre8").value= tipo_pago;
                                $("#pagadopre8").val((total).toFixed(2));

                            }else if(no_prep == 9){

                                document.getElementById("pago_pre9").value = no_prep;
                                document.getElementById("pagopre9").value = pago;
                                document.getElementById("tipo_pagopre9").value= tipo_pago;
                                $("#pagadopre9").val((total).toFixed(2));

                            }else if(no_prep == 10){

                                document.getElementById("pago_pre10").value = no_prep;
                                document.getElementById("pagopre10").value = pago;
                                document.getElementById("tipo_pagopre10").value= tipo_pago;
                                $("#pagadopre10").val((total).toFixed(2));

                            }

                            document.getElementById("op_pago_id1").disabled = true;
                            document.getElementById("pago_driver").disabled = true;
                            document.getElementById('pago_driver').style.color = '#848484';
                            
                            document.getElementById("btnPagolinea").disabled = false;
                            document.getElementById("btnPagolinea").style.display = "";
                            document.getElementById("btnPagolinea").style.cursor = 'pointer';

                            document.getElementById("btndecline").disabled = false;
                            document.getElementById("btndecline").style.display = "";
                            document.getElementById("btndecline").style.cursor = 'pointer';

                            document.getElementById("btnAceptar").disabled = false;
                            document.getElementById('btnAceptar').style.cursor = 'pointer';
                            document.getElementById('btnAceptar').style.background = '#006400';
                            document.getElementById('btnAceptar').style.color = '#fff';
                            
                            document.getElementById('opcion_pago_2').value = 1;
                            document.getElementById('opcion_pago_3').value = 1;
//                            document.getElementById('op_pago_id').value = 8;

                            valida_clase2();

                            }


                        } else {
                            // Do nothing!
                            //exit;
                            Exit2();
                        }


                    }

                    //Cash
                    if (opcion === '22') {

                        if (confirm('Confirme su Tipo de Pago !!!')) {


                            var pago_driver2 = parseFloat($("#pago_driver2").val());
                            var agency_balance_due = parseFloat($("#agency_balance_due").val());
                            var total = (pago_driver2);
                            var valor = 0;
                            var prepaid = parseFloat($("#prepaid").val());
                            
                            var no_prep =  document.getElementById("no_prep").value;
                            no_prep = parseInt(no_prep) + 1;

                            var pago = 'PRED-PAID'; 
                            var tipo_pago = 'CASH';

                            if(agency_balance_due <= "0"){

                            document.getElementById('pago_driver').value = "0.00"; 
                            document.getElementById("btnPagolinea").disabled = true;
                            document.getElementById("btnPagolinea").style.display = "none";
                            document.getElementById("btndecline").style.display = "none"; 
                            document.getElementById("btnAceptar").disabled = true;
                            document.getElementById("btnAceptar").style.background = "lightgray";   

                            alert("Este pago no puede ser Procesado!!!");
                            Exit();

                            }else{
                                                        
                            prepaid = parseFloat(prepaid) + parseFloat(total);                            
                            
                            $("#no_prep").val(no_prep);
                            $("#prepaid").val((prepaid).toFixed(2));
                            $("#pago_driver").val((total).toFixed(2));
                            $("#PAP").val((valor).toFixed(2));
                            
                            if(no_prep == 1){                    
                                      
                            document.getElementById("pago_pre1").value = no_prep;
                            document.getElementById("pagopre1").value = pago;
                            document.getElementById("tipo_pagopre1").value= tipo_pago;
                            $("#pagadopre1").val((total).toFixed(2));

                            }else if(no_prep == 2){

                                document.getElementById("pago_pre2").value = no_prep;
                                document.getElementById("pagopre2").value = pago;
                                document.getElementById("tipo_pagopre2").value= tipo_pago;
                                $("#pagadopre2").val((total).toFixed(2));

                            }else if(no_prep == 3){

                                document.getElementById("pago_pre3").value = no_prep;
                                document.getElementById("pagopre3").value = pago;
                                document.getElementById("tipo_pagopre3").value= tipo_pago;
                                $("#pagadopre3").val((total).toFixed(2));

                            }else if(no_prep == 4){

                                document.getElementById("pago_pre4").value = no_prep;
                                document.getElementById("pagopre4").value = pago;
                                document.getElementById("tipo_pagopre4").value= tipo_pago;
                                $("#pagadopre4").val((total).toFixed(2));

                            }else if(no_prep == 5){

                                document.getElementById("pago_pre5").value = no_prep;
                                document.getElementById("pagopre5").value = pago;
                                document.getElementById("tipo_pagopre5").value= tipo_pago;
                                $("#pagadopre5").val((total).toFixed(2));

                            }else if(no_prep == 6){

                                document.getElementById("pago_pre6").value = no_prep;
                                document.getElementById("pagopre6").value = pago;
                                document.getElementById("tipo_pagopre6").value= tipo_pago;
                                $("#pagadopre6").val((total).toFixed(2));

                            }else if(no_prep == 7){

                                document.getElementById("pago_pre7").value = no_prep;
                                document.getElementById("pagopre7").value = pago;
                                document.getElementById("tipo_pagopre7").value= tipo_pago;
                                $("#pagadopre7").val((total).toFixed(2));

                            }else if(no_prep == 8){

                                document.getElementById("pago_pre8").value = no_prep;
                                document.getElementById("pagopre8").value = pago;
                                document.getElementById("tipo_pagopre8").value= tipo_pago;
                                $("#pagadopre8").val((total).toFixed(2));

                            }else if(no_prep == 9){

                                document.getElementById("pago_pre9").value = no_prep;
                                document.getElementById("pagopre9").value = pago;
                                document.getElementById("tipo_pagopre9").value= tipo_pago;
                                $("#pagadopre9").val((total).toFixed(2));

                            }else if(no_prep == 10){

                                document.getElementById("pago_pre10").value = no_prep;
                                document.getElementById("pagopre10").value = pago;
                                document.getElementById("tipo_pagopre10").value= tipo_pago;
                                $("#pagadopre10").val((total).toFixed(2));

                            }                            
                            

                            document.getElementById("op_pago_id1").disabled = true;
                            document.getElementById("pago_driver").disabled = true;
                            document.getElementById('pago_driver').style.color = '#848484';
                            
                            document.getElementById("btndecline").disabled = false;
                            document.getElementById("btndecline").style.display = "";
                            document.getElementById("btndecline").style.cursor = 'pointer'; 

                            document.getElementById('btnAceptar').style.cursor = 'pointer';
                            document.getElementById("btnAceptar").disabled = false;
                            document.getElementById('btnAceptar').style.background = '#006400';
                            document.getElementById('btnAceptar').style.color = '#fff';
                            
                            document.getElementById('opcion_pago_2').value = 6;
                            document.getElementById('opcion_pago_3').value = 6;
//                            document.getElementById('op_pago_id').value = 8;

                            valida_clase2();

                            }

                        } else {
                            // Do nothing!
                            //exit;
                            Exit2();
                        }


                    }

                    //Check
                    if (opcion === '23') {

                        if (confirm('Confirme su Tipo de Pago !!!')) {
                          

                            var pago_driver2 = parseFloat($("#pago_driver2").val());
                            var agency_balance_due = parseFloat($("#agency_balance_due").val());
                            var total = parseFloat(pago_driver2);
                            var valor = 0;
                            var prepaid = parseFloat($("#prepaid").val());
                            
                            var no_prep =  document.getElementById("no_prep").value;
                            no_prep = parseInt(no_prep) + 1;

                            var pago = 'PRED-PAID'; 
                            var tipo_pago = 'CHECK';

                            if(agency_balance_due <= "0"){

                            document.getElementById('pago_driver').value = "0.00"; 
                            document.getElementById("btnPagolinea").disabled = true;
                            document.getElementById("btnPagolinea").style.display = "none";
                            document.getElementById("btndecline").style.display = "none"; 
                            document.getElementById("btnAceptar").disabled = true;
                            document.getElementById("btnAceptar").style.background = "lightgray";   


                            alert("Este pago no puede ser Procesado!!!");
                            Exit();

                            }else{
                            

                            prepaid = parseFloat(prepaid) + parseFloat(total);                            
                            $("#no_prep").val(no_prep);
                            $("#prepaid").val((prepaid).toFixed(2));
                            $("#pago_driver").val((total).toFixed(2));
                            $("#PAP").val((valor).toFixed(2));
                            
                            
                            if(no_prep == 1){                    
                                      
                            document.getElementById("pago_pre1").value = no_prep;
                            document.getElementById("pagopre1").value = pago;
                            document.getElementById("tipo_pagopre1").value= tipo_pago;
                            $("#pagadopre1").val((total).toFixed(2));

                            }else if(no_prep == 2){

                                document.getElementById("pago_pre2").value = no_prep;
                                document.getElementById("pagopre2").value = pago;
                                document.getElementById("tipo_pagopre2").value= tipo_pago;
                                $("#pagadopre2").val((total).toFixed(2));

                            }else if(no_prep == 3){

                                document.getElementById("pago_pre3").value = no_prep;
                                document.getElementById("pagopre3").value = pago;
                                document.getElementById("tipo_pagopre3").value= tipo_pago;
                                $("#pagadopre3").val((total).toFixed(2));

                            }else if(no_prep == 4){

                                document.getElementById("pago_pre4").value = no_prep;
                                document.getElementById("pagopre4").value = pago;
                                document.getElementById("tipo_pagopre4").value= tipo_pago;
                                $("#pagadopre4").val((total).toFixed(2));

                            }else if(no_prep == 5){

                                document.getElementById("pago_pre5").value = no_prep;
                                document.getElementById("pagopre5").value = pago;
                                document.getElementById("tipo_pagopre5").value= tipo_pago;
                                $("#pagadopre5").val((total).toFixed(2));

                            }else if(no_prep == 6){

                                document.getElementById("pago_pre6").value = no_prep;
                                document.getElementById("pagopre6").value = pago;
                                document.getElementById("tipo_pagopre6").value= tipo_pago;
                                $("#pagadopre6").val((total).toFixed(2));

                            }else if(no_prep == 7){

                                document.getElementById("pago_pre7").value = no_prep;
                                document.getElementById("pagopre7").value = pago;
                                document.getElementById("tipo_pagopre7").value= tipo_pago;
                                $("#pagadopre7").val((total).toFixed(2));

                            }else if(no_prep == 8){

                                document.getElementById("pago_pre8").value = no_prep;
                                document.getElementById("pagopre8").value = pago;
                                document.getElementById("tipo_pagopre8").value= tipo_pago;
                                $("#pagadopre8").val((total).toFixed(2));

                            }else if(no_prep == 9){

                                document.getElementById("pago_pre9").value = no_prep;
                                document.getElementById("pagopre9").value = pago;
                                document.getElementById("tipo_pagopre9").value= tipo_pago;
                                $("#pagadopre9").val((total).toFixed(2));

                            }else if(no_prep == 10){

                                document.getElementById("pago_pre10").value = no_prep;
                                document.getElementById("pagopre10").value = pago;
                                document.getElementById("tipo_pagopre10").value= tipo_pago;
                                $("#pagadopre10").val((total).toFixed(2));

                            }


                            document.getElementById("op_pago_id1").disabled = true;
                            document.getElementById("pago_driver").disabled = true;
                            document.getElementById('pago_driver').style.color = '#848484';

                            document.getElementById('btnAceptar').style.cursor = 'pointer';
                            document.getElementById("btnAceptar").disabled = false;
                            document.getElementById('btnAceptar').style.background = '#006400';
                            document.getElementById('btnAceptar').style.color = '#fff';
                            
                            document.getElementById('opcion_pago_2').value = 10;
                            document.getElementById('opcion_pago_3').value = 10;
                            //document.getElementById('op_pago_id').value = 8;
                            
                            valida_clase2();
                            
                            }

                        } else {
                            // Do nothing!
                            //exit;
                            Exit2();
                        }

                    }







                    //COLLECT ON BOARD//////////////////////////////////////

                    //Credit Card no fee
                    if (opcion === '24') {

                        if (confirm('Confirme su Tipo de Pago !!!')) {

                            
                            var pago_driver2 = parseFloat($("#pago_driver2").val());
                            var balance_due = parseFloat($("#balance_due").val());
                            var total = parseFloat(pago_driver2);
                            var valor = 0;
                            var collect = parseFloat($("#collect").val());
                            var kollect = parseFloat($("#pago_driver").val());
                            
                            var no_pago =  document.getElementById("no_pago").value;
                            no_pago = parseInt(no_pago) + 1;
                            
                            var pago = 'COLLECT ON BOARD'; 
                            var tipo_pago = 'CREDIT CARD NO FEE';

                            if(balance_due <= "0"){

                            document.getElementById('pago_driver').value = "0.00"; 
                            document.getElementById("btnPagolinea").disabled = true;
                            document.getElementById("btnPagolinea").style.display = "none";
                            document.getElementById("btndecline").style.display = "none"; 
                            document.getElementById("btncancol").style.display = "none";
                            document.getElementById("btnAceptar").disabled = true;
                            document.getElementById("btnAceptar").style.background = "lightgray";   


                            alert("Este pago no puede ser Procesado!!!");
                            Exit();

                            }else{

                            $("#no_pago").val(no_pago);
                            collect = parseFloat(collect) + parseFloat(total);
                            $("#collect").val((collect).toFixed(2));
                            $("#pago_driver").val((total).toFixed(2));                            
                            $("#PAP").val((valor).toFixed(2));
                            
                            if(no_pago == 1){                    
                                      
                            document.getElementById("pago_1").value = no_pago;
                            document.getElementById("pago1").value = pago;
                            document.getElementById("tipo_pago1").value= tipo_pago;
                            $("#pagado1").val((kollect).toFixed(2));

                            }else if(no_pago == 2){

                                document.getElementById("pago_2").value = no_pago;
                                document.getElementById("pago2").value = pago;
                                document.getElementById("tipo_pago2").value= tipo_pago;
                                $("#pagado2").val((kollect).toFixed(2));

                            }else if(no_pago == 3){

                                document.getElementById("pago_3").value = no_pago;
                                document.getElementById("pago3").value = pago;
                                document.getElementById("tipo_pago3").value= tipo_pago;
                                $("#pagado3").val((kollect).toFixed(2));

                            }else if(no_pago == 4){

                                document.getElementById("pago_4").value = no_pago;
                                document.getElementById("pago4").value = pago;
                                document.getElementById("tipo_pago4").value= tipo_pago;
                                $("#pagado4").val((kollect).toFixed(2));

                            }else if(no_pago == 5){

                                document.getElementById("pago_5").value = no_pago;
                                document.getElementById("pago5").value = pago;
                                document.getElementById("tipo_pago5").value= tipo_pago;
                                $("#pagado5").val((kollect).toFixed(2));

                            }else if(no_pago == 6){

                                document.getElementById("pago_6").value = no_pago;
                                document.getElementById("pago6").value = pago;
                                document.getElementById("tipo_pago6").value= tipo_pago;
                                $("#pagado6").val((kollect).toFixed(2));

                            }else if(no_pago == 7){

                                document.getElementById("pago_7").value = no_pago;
                                document.getElementById("pago7").value = pago;
                                document.getElementById("tipo_pago7").value= tipo_pago;
                                $("#pagado7").val((kollect).toFixed(2));

                            }else if(no_pago == 8){

                                document.getElementById("pago_8").value = no_pago;
                                document.getElementById("pago8").value = pago;
                                document.getElementById("tipo_pago8").value= tipo_pago;
                                $("#pagado8").val((kollect).toFixed(2));

                            }else if(no_pago == 9){

                                document.getElementById("pago_9").value = no_pago;
                                document.getElementById("pago9").value = pago;
                                document.getElementById("tipo_pago9").value= tipo_pago;
                                $("#pagado9").val((kollect).toFixed(2));

                            }else if(no_pago == 10){

                                document.getElementById("pago_10").value = no_pago;
                                document.getElementById("pago10").value = pago;
                                document.getElementById("tipo_pago10").value= tipo_pago;
                                $("#pagado10").val((kollect).toFixed(2));

                            }

                            
                            
                            document.getElementById("btndecline").disabled = true;
                            document.getElementById("btndecline").style.display = "none";
                            document.getElementById("btndecline").style.cursor = '';

                            document.getElementById("btncancol").disabled = false;
                            document.getElementById("btncancol").style.display = "";
                            document.getElementById("btncancol").style.cursor = 'pointer';

                            document.getElementById("op_pago_id1").disabled = true;
                            document.getElementById("pago_driver").disabled = true;
                            document.getElementById('pago_driver').style.color = '#848484';

                            document.getElementById('btnAceptar').style.cursor = 'pointer';
                            document.getElementById("btnAceptar").disabled = false;
                            document.getElementById('btnAceptar').style.background = '#006400';
                            document.getElementById('btnAceptar').style.color = '#fff';
                            
                            document.getElementById('op_pago_id').value = 8;
                            document.getElementById('opcionpago').value = 8;
                            
                            
                            valida_clase2();
                            
                            }

                        } else {
                            // Do nothing!
                            //exit;
                            Exit2();
                        }


                    }

                    //Credit Card with fee
                    if (opcion === '25') {

                        if (confirm('Confirme su Tipo de Pago !!!')) {

                            var pago_driver = parseFloat($("#pago_driver").val());
                            var balance_due = parseFloat($("#balance_due").val());
                            var valor = parseFloat(pago_driver) * 0.04;
                            var total = parseFloat(pago_driver) + parseFloat(valor);
                            var temp = parseFloat($("#temp").val());
                            var temp_driver = parseFloat($("#temp_driver").val()); 
                            var tot_cargo = (pago_driver) - (valor);

                            var no_pago =  document.getElementById("no_pago").value;
                
                            no_pago = parseInt(no_pago) + 1;

                            var pago = 'COLLECT ON BOARD'; 
                            var tipo_pago = 'CREDIT CARD WITH FEE';

                            if(balance_due <= "0"){

                            document.getElementById('pago_driver').value = "0.00"; 
                            document.getElementById("btnPagolinea").disabled = true;
                            document.getElementById("btnPagolinea").style.display = "none";
                            document.getElementById("btndecline").style.display = "none"; 
                            document.getElementById("btncancol").style.display = "none";
                            document.getElementById("btnAceptar").disabled = true;
                            document.getElementById("btnAceptar").style.background = "lightgray";   


                            alert("Este pago no puede ser Procesado!!!");
                            Exit();

                            }else{

                            

                            temp = parseFloat(temp) + parseFloat(valor);
                            temp_driver = parseFloat(temp_driver) + parseFloat(valor);

                            $("#temp").val((temp).toFixed(2));
                            $("#temp_driver").val((temp_driver).toFixed(2));
                            $("#no_pago").val(no_pago);

                            var collect = parseFloat($("#collect").val());
                            collect = parseFloat(collect) + parseFloat(total);

                            $("#collect").val((collect).toFixed(2));
                            $("#pago_driver").val((total).toFixed(2));                         
                            $("#PAP").val((valor).toFixed(2));
                            $("#tot_charge").val((temp).toFixed(2));
                            
                            if(no_pago == 1){
                    
                                      
                            document.getElementById("pago_1").value = no_pago;
                            document.getElementById("pago1").value = pago;
                            document.getElementById("tipo_pago1").value= tipo_pago;
                            $("#pagado1").val((total).toFixed(2));

                            }else if(no_pago == 2){

                                document.getElementById("pago_2").value = no_pago;
                                document.getElementById("pago2").value = pago;
                                document.getElementById("tipo_pago2").value= tipo_pago;
                                $("#pagado2").val((total).toFixed(2));

                            }else if(no_pago == 3){

                                document.getElementById("pago_3").value = no_pago;
                                document.getElementById("pago3").value = pago;
                                document.getElementById("tipo_pago3").value= tipo_pago;
                                $("#pagado3").val((total).toFixed(2));

                            }else if(no_pago == 4){

                                document.getElementById("pago_4").value = no_pago;
                                document.getElementById("pago4").value = pago;
                                document.getElementById("tipo_pago4").value= tipo_pago;
                                $("#pagado4").val((total).toFixed(2));

                            }else if(no_pago == 5){

                                document.getElementById("pago_5").value = no_pago;
                                document.getElementById("pago5").value = pago;
                                document.getElementById("tipo_pago5").value= tipo_pago;
                                $("#pagado5").val((total).toFixed(2));

                            }else if(no_pago == 6){

                                document.getElementById("pago_6").value = no_pago;
                                document.getElementById("pago6").value = pago;
                                document.getElementById("tipo_pago6").value= tipo_pago;
                                $("#pagado6").val((total).toFixed(2));

                            }else if(no_pago == 7){

                                document.getElementById("pago_7").value = no_pago;
                                document.getElementById("pago7").value = pago;
                                document.getElementById("tipo_pago7").value= tipo_pago;
                                $("#pagado7").val((total).toFixed(2));

                            }else if(no_pago == 8){

                                document.getElementById("pago_8").value = no_pago;
                                document.getElementById("pago8").value = pago;
                                document.getElementById("tipo_pago8").value= tipo_pago;
                                $("#pagado8").val((total).toFixed(2));

                            }else if(no_pago == 9){

                                document.getElementById("pago_9").value = no_pago;
                                document.getElementById("pago9").value = pago;
                                document.getElementById("tipo_pago9").value= tipo_pago;
                                $("#pagado9").val((total).toFixed(2));

                            }else if(no_pago == 10){

                                document.getElementById("pago_10").value = no_pago;
                                document.getElementById("pago10").value = pago;
                                document.getElementById("tipo_pago10").value= tipo_pago;
                                $("#pagado10").val((total).toFixed(2));

                            }                


                            document.getElementById("op_pago_id1").disabled = true;
                            document.getElementById("pago_driver").disabled = true;
                            document.getElementById('pago_driver').style.color = '#848484';
                            
                            document.getElementById("btndecline").disabled = true;
                            document.getElementById("btndecline").style.display = "none";
                            document.getElementById("btndecline").style.cursor = '';

                            document.getElementById("btncancol").disabled = false;
                            document.getElementById("btncancol").style.display = "";
                            document.getElementById("btncancol").style.cursor = 'pointer';

                            document.getElementById('btnAceptar').style.cursor = 'pointer';
                            document.getElementById("btnAceptar").disabled = false;
                            document.getElementById('btnAceptar').style.background = '#006400';
                            document.getElementById('btnAceptar').style.color = '#fff';
                            
                            document.getElementById('op_pago_id').value = 3;
                            document.getElementById('opcionpago').value = 3;                            
                            
                            valida_clase();
                            
                            }

                        } else {
                            // Do nothing!
                            //exit;
                            //reset();
                            Exit2();
                        }

                    }

                    //Cash
                    if (opcion === '26') {


                        if (confirm('Confirme su Tipo de Pago !!!')) {
                            
                            var pago_driver = parseFloat($("#pago_driver").val());
                            var balance_due = parseFloat($("#balance_due").val());
                            var total = parseFloat(pago_driver);
                            var valor = 0;
                            var collect = parseFloat($("#collect").val());
                            var kollect = parseFloat($("#pago_driver").val());
                    
                            var no_pago =  document.getElementById("no_pago").value;
                            no_pago = parseInt(no_pago) + 1;

                            var pago = 'COLLECT ON BOARD'; 
                            var tipo_pago = 'CASH';

                            if(balance_due <= "0"){

                            document.getElementById('pago_driver').value = "0.00"; 
                            document.getElementById("btnPagolinea").disabled = true;
                            document.getElementById("btnPagolinea").style.display = "none";
                            document.getElementById("btndecline").style.display = "none"; 
                            document.getElementById("btncancol").style.display = "none";
                            document.getElementById("btnAceptar").disabled = true;
                            document.getElementById("btnAceptar").style.background = "lightgray";   

                            alert("Este pago no puede ser Procesado!!!");
                            Exit();

                            }else{

                            $("#no_pago").val(no_pago);
                            collect = parseFloat(collect) + parseFloat(total);
                            $("#collect").val((collect).toFixed(2));
                            $("#pago_driver").val((total).toFixed(2));        
                            $("#PAP").val((valor).toFixed(2));

                            if(no_pago == 1){                    
                                      
                            document.getElementById("pago_1").value = no_pago;
                            document.getElementById("pago1").value = pago;
                            document.getElementById("tipo_pago1").value= tipo_pago;
                            $("#pagado1").val((kollect).toFixed(2));

                            }else if(no_pago == 2){

                                document.getElementById("pago_2").value = no_pago;
                                document.getElementById("pago2").value = pago;
                                document.getElementById("tipo_pago2").value= tipo_pago;
                                $("#pagado2").val((kollect).toFixed(2));

                            }else if(no_pago == 3){

                                document.getElementById("pago_3").value = no_pago;
                                document.getElementById("pago3").value = pago;
                                document.getElementById("tipo_pago3").value= tipo_pago;
                                $("#pagado3").val((kollect).toFixed(2));

                            }else if(no_pago == 4){

                                document.getElementById("pago_4").value = no_pago;
                                document.getElementById("pago4").value = pago;
                                document.getElementById("tipo_pago4").value= tipo_pago;
                                $("#pagado4").val((kollect).toFixed(2));

                            }else if(no_pago == 5){

                                document.getElementById("pago_5").value = no_pago;
                                document.getElementById("pago5").value = pago;
                                document.getElementById("tipo_pago5").value= tipo_pago;
                                $("#pagado5").val((kollect).toFixed(2));

                            }else if(no_pago == 6){

                                document.getElementById("pago_6").value = no_pago;
                                document.getElementById("pago6").value = pago;
                                document.getElementById("tipo_pago6").value= tipo_pago;
                                $("#pagado6").val((kollect).toFixed(2));

                            }else if(no_pago == 7){

                                document.getElementById("pago_7").value = no_pago;
                                document.getElementById("pago7").value = pago;
                                document.getElementById("tipo_pago7").value= tipo_pago;
                                $("#pagado7").val((kollect).toFixed(2));

                            }else if(no_pago == 8){

                                document.getElementById("pago_8").value = no_pago;
                                document.getElementById("pago8").value = pago;
                                document.getElementById("tipo_pago8").value= tipo_pago;
                                $("#pagado8").val((kollect).toFixed(2));

                            }else if(no_pago == 9){

                                document.getElementById("pago_9").value = no_pago;
                                document.getElementById("pago9").value = pago;
                                document.getElementById("tipo_pago9").value= tipo_pago;
                                $("#pagado9").val((kollect).toFixed(2));

                            }else if(no_pago == 10){

                                document.getElementById("pago_10").value = no_pago;
                                document.getElementById("pago10").value = pago;
                                document.getElementById("tipo_pago10").value= tipo_pago;
                                $("#pagado10").val((kollect).toFixed(2));

                            }
                            
                            document.getElementById("op_pago_id1").disabled = true;
                            document.getElementById("pago_driver").disabled = true;
                            document.getElementById('pago_driver').style.color = '#848484';
                            
                            document.getElementById("btndecline").disabled = true;
                            document.getElementById("btndecline").style.display = "none";
                            document.getElementById("btndecline").style.cursor = '';

                            document.getElementById("btncancol").disabled = false;
                            document.getElementById("btncancol").style.display = "";
                            document.getElementById("btncancol").style.cursor = 'pointer';

                            document.getElementById('btnAceptar').style.cursor = 'pointer';
                            document.getElementById("btnAceptar").disabled = false;
                            document.getElementById('btnAceptar').style.background = '#006400';
                            document.getElementById('btnAceptar').style.color = '#fff';
                            
                            document.getElementById('op_pago_id').value = 4;
                            document.getElementById('opcionpago').value = 4;
                                                       
                            valida_clase(); 
                            
                            }


                        } else {
                            // Do nothing!
                            //exit;
                            Exit2();
                        }

                    }

                    //Check

                    if (opcion === '27') {


                        if (confirm('Confirme su Tipo de Pago !!!')) {


                            var pago_driver2 = parseFloat($("#pago_driver2").val());
                            var balance_due = parseFloat($("#balance_due").val());
                            var total = (pago_driver2);
                            var valor = 0;
                            var collect = parseFloat($("#collect").val());
                            var kollect = parseFloat($("#pago_driver").val());
                            
                            var no_pago =  document.getElementById("no_pago").value;
                            no_pago = parseInt(no_pago) + 1;

                            var pago = 'COLLECT ON BOARD'; 
                            var tipo_pago = 'CHECK';

                            if(balance_due <= "0"){

                            document.getElementById('pago_driver').value = "0.00"; 
                            document.getElementById("btnPagolinea").disabled = true;
                            document.getElementById("btnPagolinea").style.display = "none";
                            document.getElementById("btndecline").style.display = "none"; 
                            document.getElementById("btncancol").style.display = "none";             
                            document.getElementById("btnAceptar").disabled = true;
                            document.getElementById("btnAceptar").style.background = "lightgray";   

                            alert("Este pago no puede ser Procesado!!!");
                            Exit();

                             }else{
                                 
                            $("#no_pago").val(no_pago);
                            collect = parseFloat(collect) + parseFloat(total);
                            $("#collect").val((collect).toFixed(2));
                            $("#pago_driver").val((total).toFixed(2));                            
                            $("#PAP").val((valor).toFixed(2));
                            
                            
                            if(no_pago == 1){
                                                          
                            document.getElementById("pago_1").value = no_pago;
                            document.getElementById("pago1").value = pago;
                            document.getElementById("tipo_pago1").value= tipo_pago;
                            $("#pagado1").val((kollect).toFixed(2));

                            }else if(no_pago == 2){

                                document.getElementById("pago_2").value = no_pago;
                                document.getElementById("pago2").value = pago;
                                document.getElementById("tipo_pago2").value= tipo_pago;
                                $("#pagado2").val((kollect).toFixed(2));

                            }else if(no_pago == 3){

                                document.getElementById("pago_3").value = no_pago;
                                document.getElementById("pago3").value = pago;
                                document.getElementById("tipo_pago3").value= tipo_pago;
                                $("#pagado3").val((kollect).toFixed(2));

                            }else if(no_pago == 4){

                                document.getElementById("pago_4").value = no_pago;
                                document.getElementById("pago4").value = pago;
                                document.getElementById("tipo_pago4").value= tipo_pago;
                                $("#pagado4").val((kollect).toFixed(2));

                            }else if(no_pago == 5){

                                document.getElementById("pago_5").value = no_pago;
                                document.getElementById("pago5").value = pago;
                                document.getElementById("tipo_pago5").value= tipo_pago;
                                $("#pagado5").val((kollect).toFixed(2));

                            }else if(no_pago == 6){

                                document.getElementById("pago_6").value = no_pago;
                                document.getElementById("pago6").value = pago;
                                document.getElementById("tipo_pago6").value= tipo_pago;
                                $("#pagado6").val((kollect).toFixed(2));

                            }else if(no_pago == 7){

                                document.getElementById("pago_7").value = no_pago;
                                document.getElementById("pago7").value = pago;
                                document.getElementById("tipo_pago7").value= tipo_pago;
                                $("#pagado7").val((kollect).toFixed(2));

                            }else if(no_pago == 8){

                                document.getElementById("pago_8").value = no_pago;
                                document.getElementById("pago8").value = pago;
                                document.getElementById("tipo_pago8").value= tipo_pago;
                                $("#pagado8").val((kollect).toFixed(2));

                            }else if(no_pago == 9){

                                document.getElementById("pago_9").value = no_pago;
                                document.getElementById("pago9").value = pago;
                                document.getElementById("tipo_pago9").value= tipo_pago;
                                $("#pagado9").val((kollect).toFixed(2));

                            }else if(no_pago == 10){

                                document.getElementById("pago_10").value = no_pago;
                                document.getElementById("pago10").value = pago;
                                document.getElementById("tipo_pago10").value= tipo_pago;
                                $("#pagado10").val((kollect).toFixed(2));

                            }


                            document.getElementById("op_pago_id1").disabled = true;
                            document.getElementById("pago_driver").disabled = true;
                            document.getElementById('pago_driver').style.color = '#848484';
                            
                            document.getElementById("btndecline").disabled = true;
                            document.getElementById("btndecline").style.display = "none";
                            document.getElementById("btndecline").style.cursor = '';

                            document.getElementById("btncancol").disabled = false;
                            document.getElementById("btncancol").style.display = "";
                            document.getElementById("btncancol").style.cursor = 'pointer';


                            document.getElementById('btnAceptar').style.cursor = 'pointer';
                            document.getElementById("btnAceptar").disabled = false;
                            document.getElementById('btnAceptar').style.background = '#006400';
                            document.getElementById('btnAceptar').style.color = '#fff';
                            
                            document.getElementById('op_pago_id').value = 9;
                            document.getElementById('opcionpago').value = 9;
                            
                            valida_clase();                            
                            
                            }

                        } else {
                            // Do nothing!
                            //exit;
                            Exit2();
                        }

                    }



                }
            </script>

            <script type="text/javascript">
                function Exit()
                {
                    var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray"; 
                    ventana2.style.display = 'none'; // Y lo hacemos invisible

                }
            </script>


            <script type="text/javascript">
                function Exit2()
                {
                    var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    //reset();
                    //mostrarVentana2();
                    abrirVentana2();

                }
            </script>

            <script type="text/javascript">
                function ClkPay_Amount()
                {

                    var clone = document.getElementById('otheramount').value;
                    var pd = document.getElementById('paid_driver').value;


                    if (clone == '') {

                        document.getElementById('otheramount').value = '0.00';
                        document.getElementById('etb').value = '0.00';

                    }

                    if (clone == '0.0') {

                        document.getElementById('otheramount').value = '0.00';
                        document.getElementById('etb').value = '0.00';
                    }


                    if (clone == '.00') {

                        document.getElementById('otheramount').value = '0.00';
                        document.getElementById('etb').value = '0.00';
                    }

                    if (clone > 0) {


                        document.getElementById('saldoactual').value = clone;
                        document.getElementById('paid_driver').value = pd;

                        $("#saldoactual").val((clone).toFixed(2));

                        setTimeout(function () {

                            //$('#paid_driver').click();
                            calcularTotalPago();

                        }, 0.001);


                        //$("#balance_due").val((clone-pd).toFixed(2));



                    }

                    if (clone == '0.') {

                        document.getElementById('otheramount').value = '0.00';
                        document.getElementById('etb').value = '0.00';
                    }


                    if (clone == '0') {

                        document.getElementById('otheramount').value = '0.00';
                        document.getElementById('etb').value = '0.00';
                    }
                    setTimeout(function () {
                        
                        //$('#paid_driver').click();
                        calcularTotalPago();

                    }, 0.001);


                }
            </script>

            <script type="text/javascript">
                function aplicar_pago() {
                    //alert('mostrar');
                    var ventana = document.getElementById('miVentana'); // Accedemos al contenedor

                    var totalamount = document.getElementById('totalAmount').value;

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

                function mostrarVentana2() {

                    
//                    selector();
//                    captura(); 
//                    passenger_balance();


                    if (window.screen.availWidth <= 640) {

                        window.parent.document.body.style.zoom = "62%";
                        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                        ventana2.style.marginTop = "-0.5px"; // Definimos su posición vertical.        
//                        ventana2.style.marginLeft = "0.6px"; // Definimos su posición horizontal
                        ventana2.style.display = 'block'; // Y lo hacemos visible
//                        ventana2.style.position = 'absolute';
                        ventana2.style.height = '174px';
                    }

                    if (window.screen.availWidth == 800) {

                        window.parent.document.body.style.zoom = "78%";
                        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                        ventana2.style.marginTop = "-0.5px"; // Definimos su posición vertical.        
//                        ventana2.style.marginLeft = "0.6px"; // Definimos su posición horizontal
                        ventana2.style.display = 'block'; // Y lo hacemos visible
//                        ventana2.style.position = 'absolute';
                        ventana2.style.height = '174px';
                    }
                    if (window.screen.availWidth == 1024) {

                        window.parent.document.body.style.zoom = "100%";
                        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                        ventana2.style.marginTop = "-0.5px"; // Definimos su posición vertical.        
//                        ventana2.style.marginLeft = "0.6px"; // Definimos su posición horizontal
                        ventana2.style.display = 'block'; // Y lo hacemos visible
//                        ventana2.style.position = 'absolute';
                        ventana2.style.height = '174px';


                    }

                    if (window.screen.availWidth == 1366 && (z == 1 || z == 2 || z == 3)) {


                        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                        ventana2.style.marginTop = "-1px"; // Definimos su posición vertical.   
//                        ventana2.style.top = "1140px"; // Definimos su posición vertical.      
//                        ventana2.style.marginLeft = "-86.4px"; // Definimos su posición horizontal
//                        ventana2.style.left = "756px"; // Definimos su posición horizontal
                        ventana2.style.display = 'block'; // Y lo hacemos visible
//                        ventana2.style.position = 'absolute';
                        ventana2.style.height = '174px';

                    }

                    if (window.screen.availWidth == 1440 && (z == 1 || z == 2 || z == 3)) {


                        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                        ventana2.style.marginTop = "6px"; // Definimos su posición vertical.        
//                        ventana2.style.marginLeft = "-277.4px"; // Definimos su posición horizontal
                        ventana2.style.display = 'block'; // Y lo hacemos visible
//                        ventana2.style.position = 'absolute';
                        ventana2.style.height = '174px';

                    }

                    if (window.screen.availWidth == 1600 && (z == 1 || z == 2 || z == 3)) {


                        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                        ventana2.style.marginTop = "6px"; // Definimos su posición vertical.        
//                        ventana2.style.marginLeft = "-277.4px"; // Definimos su posición horizontal
                        ventana2.style.display = 'block'; // Y lo hacemos visible
//                        ventana2.style.position = 'absolute';
                        ventana2.style.height = '174px';

                    }

                    if (window.screen.availWidth == 1680 && (z == 1 || z == 2 || z == 3)) {


                        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                        ventana2.style.marginTop = "6px"; // Definimos su posición vertical.        
//                        ventana2.style.marginLeft = "-277.4px"; // Definimos su posición horizontal
                        ventana2.style.display = 'block'; // Y lo hacemos visible
//                        ventana2.style.position = 'absolute';
                        ventana2.style.height = '174px';

                    }

                    if (window.screen.availWidth > 1680 && (z == 1 || z == 2 || z == 3)) {


                        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  


//                        ventana2.style.marginTop = "-16px"; // Definimos su posición vertical.        
//                        ventana2.style.marginLeft = "0.6px"; // Definimos su posición horizontal
//                        ventana2.style.top = "1132px"; // Definimos su posición vertical.        
//                        ventana2.style.left = "842px"; // Definimos su posición horizontal
                        ventana2.style.display = 'block'; // Y lo hacemos visible
//                        ventana2.style.position = 'absolute';
                        ventana2.style.height = '174px';



                    }


                    document.getElementById("pago_driver").disabled = false;
                    document.getElementById('pago_driver').value = '';
                    document.getElementById('pago_driver').style.color = '#848484';
                    document.getElementById('pago_driver').style.background = '#fff';
                    $("#pago_driver").focus(); 

                    document.getElementById('op_pago_id1').value = 0;
                    //document.getElementById('op_pago_id').value = 8;
                    document.getElementById('opcion_pago_2').value = 2;
                    //document.getElementById('opcion_pago_3').value = 2;

                    document.getElementById('btnAceptar').style.background = 'lightgray';
                    document.getElementById('btnAceptar').style.background = '';
                    document.getElementById('btnAceptar').style.color = '#000';
                    document.getElementById('btnAceptar').style.cursor = '';

                    //capturar();
                    //$('#pago_driver').val()='0.00';
                }


                function ocultarVentana2()
                {

                    AsignarParque();
                    AsignarRutas();
                    
                                        
                    var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor


                    var opcion_pago = $('#opcion_pago_id').val();
                    var pago_driver = $('#pago_driver').val();
                    var collect = $('#collect').val();
                    var prepaid = $('#prepaid').val();

                    var opcion = $("#op_pago_id1").val();

                    //PRED-PAID////////////////////////////////////////////
                    //Credit Card with fee

                    if (opcion === '0') {

//            document.getElementById('paid_driver').value = '0.00';
//            document.getElementById('pay_amount').value = '0.00';
//            document.getElementById('paid_drivert').value = '0.00';
//            document.getElementById('pred_paid_amountt').value = '0.00';


                        setTimeout(function () {
                            //$('#pay_amount').click();
                            calcularTotalPago();

                        }, 0.001);

                        setTimeout(function () {
                            //$('#paid_driver').click();
                            calcularTotalPago();

                        }, 0.001);

                        $("#pago_driver").focus();


                    }

                    if (opcion === '1') {

//            document.getElementById('paid_driver').value = '0.00';
//            document.getElementById('pay_amount').value = '0.00';
//            document.getElementById('paid_drivert').value = '0.00';
//            document.getElementById('pred_paid_amountt').value = '0.00';

                        setTimeout(function () {
                            //$('#pay_amount').click();
                            calcularTotalPago();

                        }, 0.001);

                        setTimeout(function () {
                            //$('#paid_driver').click();
                            calcularTotalPago();

                        }, 0.001);

                        $("#pago_driver").focus();

                    }

                    //*****************************PRED-PAID**********************//////////
                    //************************************************************/////////

                    //CREDIT CARD NO FEE
                    if (opcion === '20') {

                        if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                            document.getElementById('pay_amount').value = prepaid;

                            document.getElementById('pred_paid_amountt').value = prepaid;

                            var prep = parseFloat($("#pred_paid_amountt").val());

                            var coll = parseFloat($("#paid_drivert").val());
                            
//                            $("#p_d_e").val((coll).toFixed(2));
//                            $("#p_a_e").val((prep).toFixed(2));

                            $("#tot_amount_paid").val((prep + coll).toFixed(2));

                            setTimeout(function () {
                                //$('#pay_amount').click();
                                calcularTotalPago();
                                
                                document.getElementById('pay_amount').style.color = "#FFFFFF";
                                document.getElementById('pay_amount').className = "flashit2";
//                                document.getElementById('guardar').className = "flashit2";
                                document.getElementById('pay_amount').style.backgroundColor = "#E21F26";
                                
                                document.getElementById("btndecline").style.display = "none"; 
                                document.getElementById("btnAceptar").disabled = true;
                                document.getElementById("btnAceptar").style.background = "lightgray";
                        
                                //make_charge();

                            }, 0.001);
                            
                            
                            $("#pago_driver").focus();
                            

                            Exit();

                        } else {
                            // Do nothing!
                            var no_prep =  document.getElementById("no_prep").value;
                
                            if(no_prep == 1){
                                document.getElementById("no_prep").value = 0;
                                document.getElementById('pago_pre1').value = '0';
                                document.getElementById('pagopre1').value = '';
                                document.getElementById('tipo_pagopre1').value = '';
                                document.getElementById('pagadopre1').value = '0.00';                    

                            }else if(no_prep == 2){
                                document.getElementById("no_prep").value = 1;
                                document.getElementById('pago_pre2').value = '0';
                                document.getElementById('pagopre2').value = '';
                                document.getElementById('tipo_pagopre2').value = '';
                                document.getElementById('pagadopre2').value = '0.00';     

                            }else if(no_prep == 3){
                                document.getElementById("no_prep").value = 2;
                                document.getElementById('pago_pre3').value = '0';
                                document.getElementById('pagopre3').value = '';
                                document.getElementById('tipo_pagopre3').value = '';
                                document.getElementById('pagadopre3').value = '0.00';     

                            }else if(no_prep == 4){
                                document.getElementById("no_prep").value = 3;
                                document.getElementById('pago_pre4').value = '0';
                                document.getElementById('pagopre4').value = '';
                                document.getElementById('tipo_pagopre4').value = '';
                                document.getElementById('pagadopre4').value = '0.00';     

                            }else if(no_prep == 5){
                                document.getElementById("no_prep").value = 4;
                                document.getElementById('pago_pre5').value = '0';
                                document.getElementById('pagopre5').value = '';
                                document.getElementById('tipo_pagopre5').value = '';
                                document.getElementById('pagadopre5').value = '0.00';     

                            }else if(no_prep == 6){
                                document.getElementById("no_prep").value = 5;
                                document.getElementById('pago_pre6').value = '0';
                                document.getElementById('pagopre6').value = '';
                                document.getElementById('tipo_pagopre6').value = '';
                                document.getElementById('pagadopre6').value = '0.00';     

                            }else if(no_prep == 7){
                                document.getElementById("no_prep").value = 6;
                                document.getElementById('pago_pre7').value = '0';
                                document.getElementById('pagopre7').value = '';
                                document.getElementById('tipo_pagopre7').value = '';
                                document.getElementById('pagadopre7').value = '0.00';     

                            }else if(no_prep == 8){
                                document.getElementById("no_prep").value = 7;
                                document.getElementById('pago_pre8').value = '0';
                                document.getElementById('pagopre8').value = '';
                                document.getElementById('tipo_pagopre8').value = '';
                                document.getElementById('pagadopre8').value = '0.00';     

                            }else if(no_prep == 9){
                                document.getElementById("no_prep").value = 8;
                                document.getElementById('pago_pre9').value = '0';
                                document.getElementById('pagopre9').value = '';
                                document.getElementById('tipo_pagopre9').value = '';
                                document.getElementById('pagadopre9').value = '0.00';     

                            }else if(no_prep == 10){
                                document.getElementById("no_prep").value = 9;
                                document.getElementById('pago_pre10').value = '0';
                                document.getElementById('pagopre10').value = '';
                                document.getElementById('tipo_pagopre10').value = '';
                                document.getElementById('pagadopre10').value = '0.00';     

                            }
                            
                            
                            $("#pago_driver").focus();
                            
                            Exit();


                        }



                    }

                    //CREDIT CARD WITH FEE
                    if (opcion === '21') {
                        
                        

                        if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                            //document.getElementById('opcion_pago').value = 8;
                            document.getElementById('pay_amount').value = prepaid;
                            document.getElementById('pay_amountp').value = prepaid;
                            document.getElementById('pred_paid_amountt').value = prepaid;

                            var prep = parseFloat($("#pred_paid_amountt").val());

                            var coll = parseFloat($("#paid_drivert").val());
                            
                            var result = parseFloat(prep) + parseFloat(coll); 
                            
                            $("#tot_amount_paid").val((prep + coll).toFixed(2));

                            setTimeout(function () {
//                                $('#pay_amount').click();
//                                make_charge();

                            calcularTotalPago();
                            
                            document.getElementById('pay_amount').style.color = "#FFFFFF";
                            document.getElementById('pay_amount').className = "flashit2";
//                            document.getElementById('guardar').className = "flashit2";
                            document.getElementById('pay_amount').style.backgroundColor = "#E21F26";

                            document.getElementById("btndecline").style.display = "none"; 
                            document.getElementById("btnAceptar").disabled = true;
                            document.getElementById("btnAceptar").style.background = "lightgray";

                            }, 0.001);
                            
                            
                            $("#pago_driver").focus();


                            Exit();


                        } else {
                            // Do nothing!
                            var no_prep =  document.getElementById("no_prep").value;
                
                            if(no_prep == 1){
                                document.getElementById("no_prep").value = 0;
                                document.getElementById('pago_pre1').value = '0';
                                document.getElementById('pagopre1').value = '';
                                document.getElementById('tipo_pagopre1').value = '';
                                document.getElementById('pagadopre1').value = '0.00';                    

                            }else if(no_prep == 2){
                                document.getElementById("no_prep").value = 1;
                                document.getElementById('pago_pre2').value = '0';
                                document.getElementById('pagopre2').value = '';
                                document.getElementById('tipo_pagopre2').value = '';
                                document.getElementById('pagadopre2').value = '0.00';     

                            }else if(no_prep == 3){
                                document.getElementById("no_prep").value = 2;
                                document.getElementById('pago_pre3').value = '0';
                                document.getElementById('pagopre3').value = '';
                                document.getElementById('tipo_pagopre3').value = '';
                                document.getElementById('pagadopre3').value = '0.00';     

                            }else if(no_prep == 4){
                                document.getElementById("no_prep").value = 3;
                                document.getElementById('pago_pre4').value = '0';
                                document.getElementById('pagopre4').value = '';
                                document.getElementById('tipo_pagopre4').value = '';
                                document.getElementById('pagadopre4').value = '0.00';     

                            }else if(no_prep == 5){
                                document.getElementById("no_prep").value = 4;
                                document.getElementById('pago_pre5').value = '0';
                                document.getElementById('pagopre5').value = '';
                                document.getElementById('tipo_pagopre5').value = '';
                                document.getElementById('pagadopre5').value = '0.00';     

                            }else if(no_prep == 6){
                                document.getElementById("no_prep").value = 5;
                                document.getElementById('pago_pre6').value = '0';
                                document.getElementById('pagopre6').value = '';
                                document.getElementById('tipo_pagopre6').value = '';
                                document.getElementById('pagadopre6').value = '0.00';     

                            }else if(no_prep == 7){
                                document.getElementById("no_prep").value = 6;
                                document.getElementById('pago_pre7').value = '0';
                                document.getElementById('pagopre7').value = '';
                                document.getElementById('tipo_pagopre7').value = '';
                                document.getElementById('pagadopre7').value = '0.00';     

                            }else if(no_prep == 8){
                                document.getElementById("no_prep").value = 7;
                                document.getElementById('pago_pre8').value = '0';
                                document.getElementById('pagopre8').value = '';
                                document.getElementById('tipo_pagopre8').value = '';
                                document.getElementById('pagadopre8').value = '0.00';     

                            }else if(no_prep == 9){
                                document.getElementById("no_prep").value = 8;
                                document.getElementById('pago_pre9').value = '0';
                                document.getElementById('pagopre9').value = '';
                                document.getElementById('tipo_pagopre9').value = '';
                                document.getElementById('pagadopre9').value = '0.00';     

                            }else if(no_prep == 10){
                                document.getElementById("no_prep").value = 9;
                                document.getElementById('pago_pre10').value = '0';
                                document.getElementById('pagopre10').value = '';
                                document.getElementById('tipo_pagopre10').value = '';
                                document.getElementById('pagadopre10').value = '0.00';     

                            }

                            
                            $("#pago_driver").focus();

                            Exit();

                        }

                    }

                    //CASH
                    if (opcion === '22') {

                        if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                            document.getElementById('pay_amount').value = prepaid;
                            document.getElementById('pred_paid_amountt').value = prepaid;
                            var prep = parseFloat($("#pred_paid_amountt").val());
                            var coll = parseFloat($("#paid_drivert").val());

                            $("#tot_amount_paid").val((prep + coll).toFixed(2));

                            setTimeout(function () {
                                //$('#pay_amount').click();
                                calcularTotalPago();
                                document.getElementById('pay_amount').style.color = "#FFFFFF";
                                document.getElementById('pay_amount').className = "flashit2";
//                                document.getElementById('guardar').className = "flashit2";
                                document.getElementById('pay_amount').style.backgroundColor = "#E21F26";
                                document.getElementById('pay_amount').title ="Pago sin Guardar"; 

                                document.getElementById("btndecline").style.display = "none"; 
                                document.getElementById("btnAceptar").disabled = true;
                                document.getElementById("btnAceptar").style.background = "lightgray";
                                

                            }, 0.001);


                            Exit();

                        } else {
                            // Do nothing!
                            
                            var no_prep =  document.getElementById("no_prep").value;
                
                            if(no_prep == 1){
                                document.getElementById("no_prep").value = 0;
                                document.getElementById('pago_pre1').value = '0';
                                document.getElementById('pagopre1').value = '';
                                document.getElementById('tipo_pagopre1').value = '';
                                document.getElementById('pagadopre1').value = '0.00';                    

                            }else if(no_prep == 2){
                                document.getElementById("no_prep").value = 1;
                                document.getElementById('pago_pre2').value = '0';
                                document.getElementById('pagopre2').value = '';
                                document.getElementById('tipo_pagopre2').value = '';
                                document.getElementById('pagadopre2').value = '0.00';     

                            }else if(no_prep == 3){
                                document.getElementById("no_prep").value = 2;
                                document.getElementById('pago_pre3').value = '0';
                                document.getElementById('pagopre3').value = '';
                                document.getElementById('tipo_pagopre3').value = '';
                                document.getElementById('pagadopre3').value = '0.00';     

                            }else if(no_prep == 4){
                                document.getElementById("no_prep").value = 3;
                                document.getElementById('pago_pre4').value = '0';
                                document.getElementById('pagopre4').value = '';
                                document.getElementById('tipo_pagopre4').value = '';
                                document.getElementById('pagadopre4').value = '0.00';     

                            }else if(no_prep == 5){
                                document.getElementById("no_prep").value = 4;
                                document.getElementById('pago_pre5').value = '0';
                                document.getElementById('pagopre5').value = '';
                                document.getElementById('tipo_pagopre5').value = '';
                                document.getElementById('pagadopre5').value = '0.00';     

                            }else if(no_prep == 6){
                                document.getElementById("no_prep").value = 5;
                                document.getElementById('pago_pre6').value = '0';
                                document.getElementById('pagopre6').value = '';
                                document.getElementById('tipo_pagopre6').value = '';
                                document.getElementById('pagadopre6').value = '0.00';     

                            }else if(no_prep == 7){
                                document.getElementById("no_prep").value = 6;
                                document.getElementById('pago_pre7').value = '0';
                                document.getElementById('pagopre7').value = '';
                                document.getElementById('tipo_pagopre7').value = '';
                                document.getElementById('pagadopre7').value = '0.00';     

                            }else if(no_prep == 8){
                                document.getElementById("no_prep").value = 7;
                                document.getElementById('pago_pre8').value = '0';
                                document.getElementById('pagopre8').value = '';
                                document.getElementById('tipo_pagopre8').value = '';
                                document.getElementById('pagadopre8').value = '0.00';     

                            }else if(no_prep == 9){
                                document.getElementById("no_prep").value = 8;
                                document.getElementById('pago_pre9').value = '0';
                                document.getElementById('pagopre9').value = '';
                                document.getElementById('tipo_pagopre9').value = '';
                                document.getElementById('pagadopre9').value = '0.00';     

                            }else if(no_prep == 10){
                                document.getElementById("no_prep").value = 9;
                                document.getElementById('pago_pre10').value = '0';
                                document.getElementById('pagopre10').value = '';
                                document.getElementById('tipo_pagopre10').value = '';
                                document.getElementById('pagadopre10').value = '0.00';     

                            }

                            
                            $("#pago_driver").focus();

                            Exit();

                        }

                    }

                    //CHECK
                    if (opcion === '23') {

                        if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                            document.getElementById('pay_amount').value = prepaid;
                            document.getElementById('pred_paid_amountt').value = prepaid;
                            var prep = parseFloat($("#pred_paid_amountt").val());
                            var coll = parseFloat($("#paid_drivert").val());
                            
                            $("#tot_amount_paid").val((prep + coll).toFixed(2));

                            setTimeout(function () {
                                //$('#pay_amount').click();
                                calcularTotalPago();
                                document.getElementById('pay_amount').style.color = "#FFFFFF";
                                document.getElementById('pay_amount').className = "flashit2";
//                                document.getElementById('guardar').className = "flashit2";
                                document.getElementById('pay_amount').style.backgroundColor = "#E21F26";
                                document.getElementById('pay_amount').title ="Pago sin Guardar"; 

                                document.getElementById("btndecline").style.display = "none"; 
                                document.getElementById("btnAceptar").disabled = true;
                                document.getElementById("btnAceptar").style.background = "lightgray";
                                

                            }, 0.001);

                            
                            $("#pago_driver").focus();


                            Exit();

                        } else {
                            // Do nothing!
                            var no_prep =  document.getElementById("no_prep").value;
                
                            if(no_prep == 1){
                                document.getElementById("no_prep").value = 0;
                                document.getElementById('pago_pre1').value = '0';
                                document.getElementById('pagopre1').value = '';
                                document.getElementById('tipo_pagopre1').value = '';
                                document.getElementById('pagadopre1').value = '0.00';                    

                            }else if(no_prep == 2){
                                document.getElementById("no_prep").value = 1;
                                document.getElementById('pago_pre2').value = '0';
                                document.getElementById('pagopre2').value = '';
                                document.getElementById('tipo_pagopre2').value = '';
                                document.getElementById('pagadopre2').value = '0.00';     

                            }else if(no_prep == 3){
                                document.getElementById("no_prep").value = 2;
                                document.getElementById('pago_pre3').value = '0';
                                document.getElementById('pagopre3').value = '';
                                document.getElementById('tipo_pagopre3').value = '';
                                document.getElementById('pagadopre3').value = '0.00';     

                            }else if(no_prep == 4){
                                document.getElementById("no_prep").value = 3;
                                document.getElementById('pago_pre4').value = '0';
                                document.getElementById('pagopre4').value = '';
                                document.getElementById('tipo_pagopre4').value = '';
                                document.getElementById('pagadopre4').value = '0.00';     

                            }else if(no_prep == 5){
                                document.getElementById("no_prep").value = 4;
                                document.getElementById('pago_pre5').value = '0';
                                document.getElementById('pagopre5').value = '';
                                document.getElementById('tipo_pagopre5').value = '';
                                document.getElementById('pagadopre5').value = '0.00';     

                            }else if(no_prep == 6){
                                document.getElementById("no_prep").value = 5;
                                document.getElementById('pago_pre6').value = '0';
                                document.getElementById('pagopre6').value = '';
                                document.getElementById('tipo_pagopre6').value = '';
                                document.getElementById('pagadopre6').value = '0.00';     

                            }else if(no_prep == 7){
                                document.getElementById("no_prep").value = 6;
                                document.getElementById('pago_pre7').value = '0';
                                document.getElementById('pagopre7').value = '';
                                document.getElementById('tipo_pagopre7').value = '';
                                document.getElementById('pagadopre7').value = '0.00';     

                            }else if(no_prep == 8){
                                document.getElementById("no_prep").value = 7;
                                document.getElementById('pago_pre8').value = '0';
                                document.getElementById('pagopre8').value = '';
                                document.getElementById('tipo_pagopre8').value = '';
                                document.getElementById('pagadopre8').value = '0.00';     

                            }else if(no_prep == 9){
                                document.getElementById("no_prep").value = 8;
                                document.getElementById('pago_pre9').value = '0';
                                document.getElementById('pagopre9').value = '';
                                document.getElementById('tipo_pagopre9').value = '';
                                document.getElementById('pagadopre9').value = '0.00';     

                            }else if(no_prep == 10){
                                document.getElementById("no_prep").value = 9;
                                document.getElementById('pago_pre10').value = '0';
                                document.getElementById('pagopre10').value = '';
                                document.getElementById('tipo_pagopre10').value = '';
                                document.getElementById('pagadopre10').value = '0.00';     

                            }

                            $("#pago_driver").focus();

                            Exit();

                        }

                    }
                    //******************************************************************//
                    //**********************COLLECT ON BOARD****************************//
                    //******************************************************************//


                    //CREDIT CARD NO FEE
                    if (opcion === '24') {



                        if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                            document.getElementById('paid_driver').value = collect;
                            document.getElementById('paid_drivert').value = collect;

                            var prep = parseFloat($("#pred_paid_amountt").val());
                            var coll = parseFloat($("#paid_drivert").val());
                            
                            $("#tot_amount_paid").val((prep + coll).toFixed(2));

                            setTimeout(function () {
                                
                                calcularTotalPago();
                                document.getElementById('paid_driver').style.color = "#FFFFFF";
                                document.getElementById('paid_driver').className = "flashit";
//                                document.getElementById('guardar').className = "flashit";
                                document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
                                document.getElementById('paid_driver').title ="Pago sin Guardar"; 

                                document.getElementById("btncancol").style.display = "none"; 
                                document.getElementById("btnAceptar").disabled = true;
                                document.getElementById("btnAceptar").style.background = "lightgray";

                            }, 0.001);

                            $("#pago_driver").focus();


                            Exit();
                            // Save it!
                        } else {
                            // Do nothing!
                            
                            var no_pago =  document.getElementById("no_pago").value;
                
                            if(no_pago == 1){
                                document.getElementById("no_pago").value = 0;
                                document.getElementById('pago_1').value = '0';
                                document.getElementById('pago1').value = '';
                                document.getElementById('tipo_pago1').value = '';
                                document.getElementById('pagado1').value = '0.00';                    

                            }else if(no_pago == 2){
                                document.getElementById("no_pago").value = 1;
                                document.getElementById('pago_2').value = '0';
                                document.getElementById('pago2').value = '';
                                document.getElementById('tipo_pago2').value = '';
                                document.getElementById('pagado2').value = '0.00';     

                            }else if(no_pago == 3){
                                document.getElementById("no_pago").value = 2;
                                document.getElementById('pago_3').value = '0';
                                document.getElementById('pago3').value = '';
                                document.getElementById('tipo_pago3').value = '';
                                document.getElementById('pagado3').value = '0.00';     

                            }else if(no_pago == 4){
                                document.getElementById("no_pago").value = 3;
                                document.getElementById('pago_4').value = '0';
                                document.getElementById('pago4').value = '';
                                document.getElementById('tipo_pago4').value = '';
                                document.getElementById('pagado4').value = '0.00';     

                            }else if(no_pago == 5){
                                document.getElementById("no_pago").value = 4;
                                document.getElementById('pago_5').value = '0';
                                document.getElementById('pago5').value = '';
                                document.getElementById('tipo_pago5').value = '';
                                document.getElementById('pagado5').value = '0.00';     

                            }else if(no_pago == 6){
                                document.getElementById("no_pago").value = 5;
                                document.getElementById('pago_6').value = '0';
                                document.getElementById('pago6').value = '';
                                document.getElementById('tipo_pago6').value = '';
                                document.getElementById('pagado6').value = '0.00';     

                            }else if(no_pago == 7){
                                document.getElementById("no_pago").value = 6;
                                document.getElementById('pago_7').value = '0';
                                document.getElementById('pago7').value = '';
                                document.getElementById('tipo_pago7').value = '';
                                document.getElementById('pagado7').value = '0.00';     

                            }else if(no_pago == 8){
                                document.getElementById("no_pago").value = 7;
                                document.getElementById('pago_8').value = '0';
                                document.getElementById('pago8').value = '';
                                document.getElementById('tipo_pago8').value = '';
                                document.getElementById('pagado8').value = '0.00';     

                            }else if(no_pago == 9){
                                document.getElementById("no_pago").value = 8;
                                document.getElementById('pago_9').value = '0';
                                document.getElementById('pago9').value = '';
                                document.getElementById('tipo_pago9').value = '';
                                document.getElementById('pagado9').value = '0.00';     

                            }else if(no_pago == 10){
                                document.getElementById("no_pago").value = 9;
                                document.getElementById('pago_10').value = '0';
                                document.getElementById('pago10').value = '';
                                document.getElementById('tipo_pago10').value = '';
                                document.getElementById('pagado10').value = '0.00';     

                            }

                    
                    $("#pago_driver").focus();


                            Exit();

                        }


                    }
                    //CREDIT CARD WITH FEE
                    if (opcion === '25') {

                        if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                            var otheramount = document.getElementById('otheramount').value;
                            var pd = document.getElementById('paid_driver').value;

                            document.getElementById('paid_driver').value = collect;
                            document.getElementById('paid_drivert').value = collect;

                            var prep = parseFloat($("#pred_paid_amountt").val());
                            var coll = parseFloat($("#paid_drivert").val());

                            $("#tot_amount_paid").val((prep + coll).toFixed(2));

                            setTimeout(function () {

                                //$('#paid_driver').click();
                                calcularTotalPago();
                                document.getElementById('paid_driver').style.color = "#FFFFFF";
                                document.getElementById('paid_driver').className = "flashit";
//                                document.getElementById('guardar').className = "flashit";
                                document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
                                document.getElementById('paid_driver').title ="Pago sin Guardar"; 
                                document.getElementById("btncancol").style.display = "none"; 
                                document.getElementById("btnAceptar").disabled = true;
                                document.getElementById("btnAceptar").style.background = "lightgray";

                            }, 0.001);

                            $("#pago_driver").focus();
          
                            Exit();

                        } else {
                            // Do nothing!
                            
                            var no_pago =  document.getElementById("no_pago").value;
                
                            if(no_pago == 1){
                                document.getElementById("no_pago").value = 0;
                                document.getElementById('pago_1').value = '0';
                                document.getElementById('pago1').value = '';
                                document.getElementById('tipo_pago1').value = '';
                                document.getElementById('pagado1').value = '0.00';                    

                            }else if(no_pago == 2){
                                document.getElementById("no_pago").value = 1;
                                document.getElementById('pago_2').value = '0';
                                document.getElementById('pago2').value = '';
                                document.getElementById('tipo_pago2').value = '';
                                document.getElementById('pagado2').value = '0.00';     

                            }else if(no_pago == 3){
                                document.getElementById("no_pago").value = 2;
                                document.getElementById('pago_3').value = '0';
                                document.getElementById('pago3').value = '';
                                document.getElementById('tipo_pago3').value = '';
                                document.getElementById('pagado3').value = '0.00';     

                            }else if(no_pago == 4){
                                document.getElementById("no_pago").value = 3;
                                document.getElementById('pago_4').value = '0';
                                document.getElementById('pago4').value = '';
                                document.getElementById('tipo_pago4').value = '';
                                document.getElementById('pagado4').value = '0.00';     

                            }else if(no_pago == 5){
                                document.getElementById("no_pago").value = 4;
                                document.getElementById('pago_5').value = '0';
                                document.getElementById('pago5').value = '';
                                document.getElementById('tipo_pago5').value = '';
                                document.getElementById('pagado5').value = '0.00';     

                            }else if(no_pago == 6){
                                document.getElementById("no_pago").value = 5;
                                document.getElementById('pago_6').value = '0';
                                document.getElementById('pago6').value = '';
                                document.getElementById('tipo_pago6').value = '';
                                document.getElementById('pagado6').value = '0.00';     

                            }else if(no_pago == 7){
                                document.getElementById("no_pago").value = 6;
                                document.getElementById('pago_7').value = '0';
                                document.getElementById('pago7').value = '';
                                document.getElementById('tipo_pago7').value = '';
                                document.getElementById('pagado7').value = '0.00';     

                            }else if(no_pago == 8){
                                document.getElementById("no_pago").value = 7;
                                document.getElementById('pago_8').value = '0';
                                document.getElementById('pago8').value = '';
                                document.getElementById('tipo_pago8').value = '';
                                document.getElementById('pagado8').value = '0.00';     

                            }else if(no_pago == 9){
                                document.getElementById("no_pago").value = 8;
                                document.getElementById('pago_9').value = '0';
                                document.getElementById('pago9').value = '';
                                document.getElementById('tipo_pago9').value = '';
                                document.getElementById('pagado9').value = '0.00';     

                            }else if(no_pago == 10){
                                document.getElementById("no_pago").value = 9;
                                document.getElementById('pago_10').value = '0';
                                document.getElementById('pago10').value = '';
                                document.getElementById('tipo_pago10').value = '';
                                document.getElementById('pagado10').value = '0.00';     

                            }


                            $("#pago_driver").focus();


                            Exit();

                        }



                    }
                    //CASH
                    if (opcion === '26') {

                        if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                            document.getElementById('paid_driver').value = collect;
                            document.getElementById('paid_drivert').value = collect;

                            var prep = parseFloat($("#pred_paid_amountt").val());
                            var coll = parseFloat($("#paid_drivert").val());   
                            $("#tot_amount_paid").val((prep + coll).toFixed(2));

                            setTimeout(function () {
                               
                                calcularTotalPago();
                                document.getElementById('paid_driver').style.color = "#FFFFFF";
                                document.getElementById('paid_driver').className = "flashit";
//                                document.getElementById('guardar').className = "flashit";
                                document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
                                document.getElementById('paid_driver').title ="Pago sin Guardar"; 
                                document.getElementById("btncancol").style.display = "none"; 
                                document.getElementById("btnAceptar").disabled = true;
                                document.getElementById("btnAceptar").style.background = "lightgray";


                            }, 0.001);

                            $("#pago_driver").focus();


                            Exit();

                        } else {
                            // Do nothing!
                            
                            var no_pago =  document.getElementById("no_pago").value;
                
                            if(no_pago == 1){
                                document.getElementById("no_pago").value = 0;
                                document.getElementById('pago_1').value = '0';
                                document.getElementById('pago1').value = '';
                                document.getElementById('tipo_pago1').value = '';
                                document.getElementById('pagado1').value = '0.00';                    

                            }else if(no_pago == 2){
                                document.getElementById("no_pago").value = 1;
                                document.getElementById('pago_2').value = '0';
                                document.getElementById('pago2').value = '';
                                document.getElementById('tipo_pago2').value = '';
                                document.getElementById('pagado2').value = '0.00';     

                            }else if(no_pago == 3){
                                document.getElementById("no_pago").value = 2;
                                document.getElementById('pago_3').value = '0';
                                document.getElementById('pago3').value = '';
                                document.getElementById('tipo_pago3').value = '';
                                document.getElementById('pagado3').value = '0.00';     

                            }else if(no_pago == 4){
                                document.getElementById("no_pago").value = 3;
                                document.getElementById('pago_4').value = '0';
                                document.getElementById('pago4').value = '';
                                document.getElementById('tipo_pago4').value = '';
                                document.getElementById('pagado4').value = '0.00';     

                            }else if(no_pago == 5){
                                document.getElementById("no_pago").value = 4;
                                document.getElementById('pago_5').value = '0';
                                document.getElementById('pago5').value = '';
                                document.getElementById('tipo_pago5').value = '';
                                document.getElementById('pagado5').value = '0.00';     

                            }else if(no_pago == 6){
                                document.getElementById("no_pago").value = 5;
                                document.getElementById('pago_6').value = '0';
                                document.getElementById('pago6').value = '';
                                document.getElementById('tipo_pago6').value = '';
                                document.getElementById('pagado6').value = '0.00';     

                            }else if(no_pago == 7){
                                document.getElementById("no_pago").value = 6;
                                document.getElementById('pago_7').value = '0';
                                document.getElementById('pago7').value = '';
                                document.getElementById('tipo_pago7').value = '';
                                document.getElementById('pagado7').value = '0.00';     

                            }else if(no_pago == 8){
                                document.getElementById("no_pago").value = 7;
                                document.getElementById('pago_8').value = '0';
                                document.getElementById('pago8').value = '';
                                document.getElementById('tipo_pago8').value = '';
                                document.getElementById('pagado8').value = '0.00';     

                            }else if(no_pago == 9){
                                document.getElementById("no_pago").value = 8;
                                document.getElementById('pago_9').value = '0';
                                document.getElementById('pago9').value = '';
                                document.getElementById('tipo_pago9').value = '';
                                document.getElementById('pagado9').value = '0.00';     

                            }else if(no_pago == 10){
                                document.getElementById("no_pago").value = 9;
                                document.getElementById('pago_10').value = '0';
                                document.getElementById('pago10').value = '';
                                document.getElementById('tipo_pago10').value = '';
                                document.getElementById('pagado10').value = '0.00';     

                            }


                            $("#pago_driver").focus();


                            Exit();
                        }


                    }

                    //CHECK
                    if (opcion === '27') {

                        if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                            document.getElementById('paid_driver').value = collect;

                            document.getElementById('paid_drivert').value = collect;

                            var prep = parseFloat($("#pred_paid_amountt").val());
                            var coll = parseFloat($("#paid_drivert").val());
                            

                            $("#tot_amount_paid").val((prep + coll).toFixed(2));

                            setTimeout(function () {
                               
                                calcularTotalPago();
                                document.getElementById('paid_driver').style.color = "#FFFFFF";
                                document.getElementById('paid_driver').className = "flashit";
//                                document.getElementById('guardar').className = "flashit";
                                document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
                                document.getElementById('paid_driver').title ="Pago sin Guardar"; 
                                document.getElementById("btncancol").style.display = "none"; 
                                document.getElementById("btnAceptar").disabled = true;
                                document.getElementById("btnAceptar").style.background = "lightgray";

                            }, 0.001);

                            $("#pago_driver").focus();


                            Exit();

                        } else {
                            // Do nothing!
                            
                            var no_pago =  document.getElementById("no_pago").value;
                
                            if(no_pago == 1){
                                document.getElementById("no_pago").value = 0;
                                document.getElementById('pago_1').value = '0';
                                document.getElementById('pago1').value = '';
                                document.getElementById('tipo_pago1').value = '';
                                document.getElementById('pagado1').value = '0.00';                    

                            }else if(no_pago == 2){
                                document.getElementById("no_pago").value = 1;
                                document.getElementById('pago_2').value = '0';
                                document.getElementById('pago2').value = '';
                                document.getElementById('tipo_pago2').value = '';
                                document.getElementById('pagado2').value = '0.00';     

                            }else if(no_pago == 3){
                                document.getElementById("no_pago").value = 2;
                                document.getElementById('pago_3').value = '0';
                                document.getElementById('pago3').value = '';
                                document.getElementById('tipo_pago3').value = '';
                                document.getElementById('pagado3').value = '0.00';     

                            }else if(no_pago == 4){
                                document.getElementById("no_pago").value = 3;
                                document.getElementById('pago_4').value = '0';
                                document.getElementById('pago4').value = '';
                                document.getElementById('tipo_pago4').value = '';
                                document.getElementById('pagado4').value = '0.00';     

                            }else if(no_pago == 5){
                                document.getElementById("no_pago").value = 4;
                                document.getElementById('pago_5').value = '0';
                                document.getElementById('pago5').value = '';
                                document.getElementById('tipo_pago5').value = '';
                                document.getElementById('pagado5').value = '0.00';     

                            }else if(no_pago == 6){
                                document.getElementById("no_pago").value = 5;
                                document.getElementById('pago_6').value = '0';
                                document.getElementById('pago6').value = '';
                                document.getElementById('tipo_pago6').value = '';
                                document.getElementById('pagado6').value = '0.00';     

                            }else if(no_pago == 7){
                                document.getElementById("no_pago").value = 6;
                                document.getElementById('pago_7').value = '0';
                                document.getElementById('pago7').value = '';
                                document.getElementById('tipo_pago7').value = '';
                                document.getElementById('pagado7').value = '0.00';     

                            }else if(no_pago == 8){
                                document.getElementById("no_pago").value = 7;
                                document.getElementById('pago_8').value = '0';
                                document.getElementById('pago8').value = '';
                                document.getElementById('tipo_pago8').value = '';
                                document.getElementById('pagado8').value = '0.00';     

                            }else if(no_pago == 9){
                                document.getElementById("no_pago").value = 8;
                                document.getElementById('pago_9').value = '0';
                                document.getElementById('pago9').value = '';
                                document.getElementById('tipo_pago9').value = '';
                                document.getElementById('pagado9').value = '0.00';     

                            }else if(no_pago == 10){
                                document.getElementById("no_pago").value = 9;
                                document.getElementById('pago_10').value = '0';
                                document.getElementById('pago10').value = '';
                                document.getElementById('tipo_pago10').value = '';
                                document.getElementById('pagado10').value = '0.00';     

                            }


                            $("#pago_driver").focus();


                            Exit();

                        }

                    }
                    

                }
            </script>



            <script type="text/javascript">

                function ocultarmenu() {
                    div = document.getElementById('menu-bar');
                    div.style.display = 'none';
                    div2 = document.getElementById('hd-menu');
                    div2.style.display = 'none';

                }

            </script>



  

            <script type="text/javascript">
                function AsignarParque()
                {

                    document.getElementById('group_park').value = document.getElementById('group_park1').value;
                    var gp = group_park1.value;

                    //carga de parques

                    if (gp == 1) {
                        document.getElementById("wdwus").checked = true;
                    }

                    if (gp == 2) {
                        document.getElementById("wphol").checked = true;
                    }

                    if (gp == 3) {
                        document.getElementById("kspc").checked = true;
                    }
                    group_park2.value = group_park1.value;

                }
            </script>


            <script type="text/javascript">
                function AsignarRutas()
                {


                    document.getElementById('fromt').value = document.getElementById('from').value
                    document.getElementById('tot1').value = document.getElementById('to').value


                    document.getElementById('fromt2').value = document.getElementById('to').value
                    document.getElementById('tot2').value = document.getElementById('to2').value

                }
            </script>




            <script type="text/javascript">
                function dupliac()
                {
                    //duplicar amount to collect  en otheramount
                    var dupliam = document.getElementById('saldoactual').value;
                    var paid_driver = $("#paid_driver").val();
                    var apagare1 = apagare;

                    var apagar1 = parseFloat(apagare1);
                    var balance = parseFloat(apagar1) - parseFloat(paid_driver);
                    var duplicado = (parseFloat(dupliam)).toFixed(2);        
                    var other = 0;

                    document.getElementById('otheramount').value = duplicado;
                    document.getElementById('otheramountp').value = duplicado;
                    document.getElementById('balance_due').value = dupliam;


                    if (dupliam == '') {

                        setTimeout(function () {

                            //click al boton Balance_Due para hacer el calculo de passenger Balance Due  
                            //$('#paid_driver').click();
                            $("#saldoactual").val((apagar1).toFixed(2));
                            $("#balance_due").val((balance).toFixed(2));
                            $("#otheramount").val((other).toFixed(2));
                            $("#otheramountp").val((other).toFixed(2));
                            CalcularTotalPago();

                        }, 100);

                    }
                    
                    if (dupliam == "0") {

                        setTimeout(function () {

                            //click al boton Balance_Due para hacer el calculo de passenger Balance Due  
                            //$('#paid_driver').click();

                             $("#saldoactual").val((apagar1).toFixed(2));
                             $("#balance_due").val((balance).toFixed(2));
                             $("#otheramount").val((other).toFixed(2));
            //                $("#otheramountp").val((other).toFixed(2));
                             calcularTotalPago();

                        }, 100);

                    }

                    if (dupliam > 0) {


                        setTimeout(function () {

                            //click al boton Balance_Due para hacer el calculo de passenger Balance Due 

                            //$('#paid_driver').click();
                             calcularTotalPago();
                            //document.getElementById('op_pago_conductor').value = 8;

                        }, 1250);

                    }


                }

            </script>

                        
<!--<script language="JavaScript">
  window.onbeforeunload = confirmExit;
  function confirmExit()
  {
    return "You have attempted to leave this page.  If you have made any changes to the fields without clicking the Save button, your changes will be lost.  Are you sure you want to exit this page?";
  }
</script>-->
            
<!--<script type="text/javascript">
    var bPreguntar = true;

    window.onbeforeunload = preguntarAntesDeSalir;

    function preguntarAntesDeSalir()
    {
        if (bPreguntar == true){
            $("#puestosEnUso").load("<?php /*echo $data['rootUrl'];*/ ?>admin/reservas/ocuparPuestoUsuario/4"); 
            return "Salir de la ventana o actualizarla, Evitara que no se guarden los nuevos cambios hechos en esta reserva de Oneday Tours.";
        }
    }
</script>                        -->
            
<script type="text/javascript">
    
    var bPreguntar = true;

    //window.onbeforeunload = preguntarAntesDeSalir;

    function preguntarAntesDeSalir()
    {
        if (bPreguntar === true){
            $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/4");
            return "Salir de la ventana o actualizarla, generara un nuevo codigo de reserva."; 
        }
            
    }
    

    
</script>

            
            
                        
                        <script>
                            $("#btnPagolinea").click(function () {
                            //$("#pago_agente").click(function () {
                            
                                document.getElementById('btnPagolinea').style.display = 'none';
                                document.getElementById("btndecline").disabled = false;
                                document.getElementById("btndecline").style.display = "";
                                document.getElementById("btndecline").style.cursor = 'pointer';
                                
                                var paid_driver = $("#paid_driver").val();
                                var pay_amount = $("#pay_amount").val();

                                //var cantidad = $("#pay_amount").val();
                                var cantidad = $("#pago_tarjeta").val();
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

                            $(window).load(function () {

                                ocultarmenu();
                                comprobarScreen();
                                sur_2015();
                                
                                AsignarRutas();
                                estado_trf_out();
                                
                                //fecha_transfer_out();
                                //estado_trf_out();    
                                //fechale2();
                                
                                selector();
                                captura();   
                                facturado();
                                fechatrip();

                                //passenger_balance();
                                                                
                                //document.getElementById('btnAceptar').style.background = '#f20707';                           
//                                document.getElementById("cambiar_tikete").value = document.getElementById('incl_ticket').value;
                                document.getElementById('otheramountp').value = document.getElementById('otheramount').value;
                                
                                $("#content").css("opacity", "1");
                                var sel_payment = '<?php echo $reserva->op_pago; ?>';
                                $("#op_pago_id option[value=" + sel_payment + "]").attr("selected", "selected");
                                calcularTotalPago();
                                AsignarParque();


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
                                $("#fec_retor").val(fecha_salida);
                                fechale2();

                                if (!Validar(fecha_salida)) {
                                    $('#fecha_salida').focus();
                                } else {
                                    var fecha_retorno = $('#fecha_retorno').val();
                                }


                            });

                            $("#fecha_retorno").change(function () {
                                var fecha_retorno = $('#fecha_retorno').val();

                                $("#fecha_retorno").val(fecha_retorno);
                                $("#fec_retor").val(fecha_retorno);
                                if (!Validar(fecha_retorno)) {
                                    $('#fecha_retorno').focus();
                                } else {
                                    var fecha_salida = $('#fecha_salida').val();
                                }


                            });


                            function poner(id, id2) {
                                var id = id;
                                var id2 = id2;
                                $("#userr").load('<?php echo $data["rootUrl"]; ?>admin/tours/cargardatos/' + id + '/' + id2);


                            }


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
                                    
                                    cargando();
                                    
                                    var adultos = $("#adult").val();  
                                    var chicos = $("#child").val();
                                    var id = $("#from").val();
                                    var total_pax = parseInt(adultos) + parseInt(chicos);                                      
                                    
                                    var adultos_bck = "<?php echo $adultos; ?>";
                                    var chicos_bck = "<?php echo $ninos; ?>";
                                    
                                    var nuevos_adultos = parseInt(adultos) - parseInt(adultos_bck);
                                    var nuevos_chicos = parseInt(chicos) - parseInt(chicos_bck);
                                    
                                    var total_pasajeros = "<?php echo $total_pasajeros; ?>";
                                    var nuevos_pasajeros = parseInt(total_pax) - parseInt(total_pasajeros);
                                    
                                    var fecha = $("#fecha_salida").val();
                                    var fechatrip = $("#fecha_trip").val();
                                    
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
                                        

                                        $("#reserveprices").load(encodeURI('<?php echo $data['rootUrl'] ?>admin/oneday/getcosttransf/' + $("#type_rate").val() + '/' + fecha + '/' + id_agencia + '/' + total_pax), function () {


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
                                        $("#btn-load").load(encodeURI('<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuesto/' + 301 + '/' + 1 + '/' + fechatrip + '/' + nuevos_pasajeros + '/' + 1)); 
                                        $("#btn-load").load(encodeURI('<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuesto/' + 300 + '/' + 2 + '/' + fechatrip + '/' + nuevos_pasajeros + '/' + 1)); 
                                        $("#schedule1").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/1/' + $("#from").val() + '/' + $("#fecha_salida").val() + '/' + nuevos_adultos + '/' + nuevos_chicos));
                                        $("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#from").val() + '/' + $("#fecha_salida").val() + '/' + nuevos_adultos + '/' + nuevos_chicos));
                                    }
                                });

                                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                $("#to2").change(function (evt) {
                                
                                    var id = $("#to2").val();                                    
                                    var adultos = $("#adult").val();  
                                    var chicos = $("#child").val();
                                    var id = $("#from").val();
                                    var total_pax = parseInt(adultos) + parseInt(chicos);                                      
                                    
                                    var adultos_bck = "<?php echo $adultos; ?>";
                                    var chicos_bck = "<?php echo $ninos; ?>";
                                    
                                    var nuevos_adultos = parseInt(adultos) - parseInt(adultos_bck);
                                    var nuevos_chicos = parseInt(chicos) - parseInt(chicos_bck);
                                    
                                    var total_pasajeros = "<?php echo $total_pasajeros; ?>";
                                    var nuevos_pasajeros = parseInt(total_pax) - parseInt(total_pasajeros);
                                    
                                    var fecha = $("#fecha_salida").val();
                                    var fechatrip = $("#fecha_trip").val();
                                    
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
                                        
                                        $("#schedule1").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/1/' + $("#from").val() + '/' + $("#fecha_salida").val() + '/' + nuevos_adultos + '/' + nuevos_chicos));
                                        $("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#from").val() + '/' + $("#fecha_salida").val() + '/' + nuevos_adultos + '/' + nuevos_chicos));
                                    }

                                   
                                    if (Validar($("#fecha_salida").val())) {
                                        
                                        $("#schedule1").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/1/' + $("#from").val() + '/' + $("#fecha_salida").val() + '/' + nuevos_adultos + '/' + nuevos_chicos));
                                        $("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#from").val() + '/' + $("#fecha_salida").val() + '/' + nuevos_adultos + '/' + nuevos_chicos));
                                        
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

                            var apagare
                            
                            function calcularTotalPago() {

                                var priceadults = $("#priceadults").val();
                                var pricechilds = $("#pricechilds").val();
                                var paid_driver = $("#paid_driver").val();
                                var otheramount = $("#otheramount").val();
                                var saldoactual = $("#saldoctual").val();
                                var balance_due = $("#balance_due").val();                          
                                var totalamount = $("#totalAmount").val();
                                var pay_amount = $("#pay_amount").val();
                                var total_amount_paid = $("#tot_amount_paid").val();
                                var agency_balance_due = $("#agency_balance_due").val();                                
                                var temp = parseFloat($("#temp").val());
                                var prep = parseFloat($("#pred_paid_amountt").val());
                                var coll = parseFloat($("#paid_drivert").val());

                                var pagado = <?php echo $pagado; ?>;


                                //        var total_initial = calcCom();

                                var total_initial = calcCom() - parseFloat($("#rastrocom").val());

                                if (parseFloat($("#extra").val()) > 0) {
                                    total_initial += parseFloat($("#extra").val());
                                }
                                var total_total = total_initial;
                                
                                if (parseFloat($("#descuento_valor").val()) > 0) {
                                    /* total_total -= parseFloat($("#descuento_valor").val()); */
                                    if (parseFloat($("#otheramount").val()) > 0) {
                                        
                                        //actualizacion
                                        total_total -= parseFloat($("#descuento_valor").val());
                                        //
                                        total_initial -= parseFloat($("#descuento_valor").val());
                                    } else {
                                        total_total -= parseFloat($("#descuento_valor").val());
                                        total_initial -= parseFloat($("#descuento_valor").val());
                                    }
                                }

                                if (parseFloat($("#descuento").val())) {
                                    if (parseFloat($("#otheramount").val()) > 0) {
                                        
                                        //actualizacion
                                        total_total = total_total - ((total_total) * (parseFloat($("#descuento").val()) / 100));
                                        //            
                                        total_initial = total_initial - ((total_initial) * (parseFloat($("#descuento").val()) / 100));
                                    } else {
                                        total_total = total_total - ((total_total) * (parseFloat($("#descuento").val()) / 100));
                                        total_initial = total_initial - ((total_initial) * (parseFloat($("#descuento").val()) / 100));
                                    }
                                }
                                if (parseFloat($("#otheramount").val()) > 0) {
                                    //total_total = parseFloat($("#otheramount").val());
                                    //actualizacion
                                    otheramount = parseFloat($("#otheramount").val());
                                    //
                                }

                                apagare = total_total;
                                
                                var tipo_pago = 0;
                                var prepago = 0;

                                var fee = 0;
                                var tipo_pago = $("#op_pago_id option:selected").val();
                                
                                
                                var fee_n = 0;

                                prepago = $("#opcion_pago_2 option:selected").val();//pred paid

                                var opcion = $("#op_pago_id1").val();

                                //opcion add payment   codigo de envio al controlador para aumento de cargos

                                document.getElementById('opc_ap').value = opcion;



                                <?php
                                if ($data['tour']->id < 1655) {
                                    echo "fee_n = 0.03;";
                                } else {
                                    echo "fee_n = 0.04;";
                                }
                                ?>
                                




//                                if (tipo_pago == 1) {
//                                    if (parseFloat(total_total) > 0) {
//                                        fee = total_total * fee_n;
//                                    } else {
//                                        fee = total_initial * fee_n;
//                                    }
//                                    total_initial += fee;
//                                    total_total += fee;
//                                }
                                //agregando comision

                                if (parseFloat($("#rastrocom").val()) > 0) {
                                    total_total += parseFloat($("#rastrocom").val());
                                }
                                //        alert(total_initial);
                                //        exit;

                                $("#total_first").val(total_initial);
                                $("#total_total").val(total_total);
                                //$("#saldoporpagar").val((total_initial).toFixed(2));
                                //document.getElementById('saldoporpagar').value = total_initial;
                                //$("#totalAmount").html('$ ' + total_initial.toFixed(2));
                               // $("#totalAmount").val((total_initial).toFixed(2));

                                var saldoac = total_total - pay_amount;

                                if ($("input[name='opcion_saldo']:checked").val() == "1") {
                                    //$("#saldoporpagar").html("$ " + parseFloat($("#total_total").val()).toFixed(2));
                                    $("#saldoactual").val(parseFloat($("#total_total").val()).toFixed(2));

                                } else {
                                    //$("#saldoporpagar").html("$ " + (parseFloat($("#total_total").val()) - parseFloat($("#rastrocom").val())).toFixed(2));
                                    $("#saldoactual").val((parseFloat($("#total_total").val()) - parseFloat($("#rastrocom").val())).toFixed(2));


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
                                    //$("#saldoactual").html('$0.00');
                                    $("#saldoactual").val('0.00');
                                } else {
                                    //$("#saldoactual").html('$' + (diff).toFixed(2));
                                    // $("#saldoactual").val((diff).toFixed(2));

                                    ///paid driver mayor que cero //////////////////////////////

                                    var totalbalance = 0.00;

                                    //CREDIT CARD WITH FEE
                                if (tipo_pago == 3) {

                                   
                                //artificio para enviar el valor de paid_driver, pay_amount y tot_amount_paid  por POST ya que paid_driver, pay_amount y tot_amount_paid reciben valores de la tabla tours_oneday de la bd
                                
                                var otheramount = parseFloat($("#otheramount").val());   
                                var temp = parseFloat($("#temp").val());   
                                var temp_driver = parseFloat($("#temp_driver").val());
                                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                                var paid_driver = parseFloat($("#paid_driver").val());                
                                var pay_amount = parseFloat($("#pay_amount").val());
                                var total_amount = parseFloat($("#totalAmount").val());
                                var total_amount_paid = parseFloat($("#tot_amount_paid").val());
                               

                                if (pay_amount == 0 && paid_driver == 0 && otheramount == 0) {
                                    
                                var result = parseFloat(total_total) + parseFloat(temp_driver) +  parseFloat(temp_prepaid);
                                var totalbalance = ((result) - (paid_driver)) - (pay_amount);                    

                                if (totalbalance < 0) {

                                        var tembalance = 0;
                                        $("#saldoactual").val((tembalance).toFixed(2));
                                        $("#balance_due").val((tembalance).toFixed(2));
                                        $("#totalAmount").val((result).toFixed(2));                        
                                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                                    } else {
                                        
                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());
                                        var paid_driver = parseFloat($("#paid_driver").val());
                                        var pay_amount = parseFloat($("#pay_amount").val()); 
                                        var op_pag_conduct = parseFloat($("#selectcond").val());
                                        var result = parseFloat(total_total) +  parseFloat(temp_driver)+ parseFloat(temp_prepaid);
//                                        var result = parseFloat(total_total) + parseFloat(temp);
                                        var bd = parseFloat(result) - parseFloat(paid_driver);  



                                        $("#saldoactual").val((result).toFixed(2));
                                        $("#balance_due").val((bd).toFixed(2));
                                        $("#totalAmount").val((result).toFixed(2));                       
                                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                                        if(op_pag_conduct == "3"){

                                            setTimeout(function () {                               

                                                          var balance = parseFloat($("#balance_due").val());
                                                          var porcbal = balance*0.04;
                                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                          $("#balance_due").val((tot_balance).toFixed(2));


                                            }, 0.01);

                                        }

                                    }


                                }

                                if (pay_amount == 0 && paid_driver > 0 && otheramount == 0) {
                                
                                
                                var temp = parseFloat($("#temp").val());
                                var temp_driver = parseFloat($("#temp_driver").val());                  
                                var pay_amount = parseFloat($("#pay_amount").val());
                                var paid_driver = parseFloat($("#paid_driver").val());
                                var op_pag_conduct = parseFloat($("#selectcond").val());
                                var saldoporpagar = parseFloat(total_total) +  parseFloat(temp_driver);
                                var result = parseFloat(total_total) + parseFloat(temp_driver);
                                var bd = parseFloat(saldoporpagar) - parseFloat(paid_driver);  
                                var agbd = (result - paid_driver).toFixed(2); 
                                var total = parseFloat(agbd) - parseFloat(pay_amount);

                                $("#saldoactual").val((saldoporpagar).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalAmount").val((result).toFixed(2));               
                                $("#agency_balance_due").val((total).toFixed(2));

                                    if(op_pag_conduct == "3"){

                                            setTimeout(function () {                               

                                                          var balance = parseFloat($("#balance_due").val());
                                                          var porcbal = balance*0.04;
                                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          
                                                          $("#balance_due").val((tot_balance).toFixed(2));

                                            }, 0.01);

                                    }

                                }
                                
                                if (pay_amount > 0 && paid_driver == 0 && otheramount == 0) {
                                    
                                
                                var pay_amount = parseFloat($("#pay_amount").val());
                                var paid_driver = parseFloat($("#paid_driver").val());
                                var temp = parseFloat($("#temp").val());
                                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                                var totalbalance = ((total_total + temp_prepaid) - (paid_driver)) - (pay_amount);                    
                                var result = parseFloat(total_total) + parseFloat(temp_prepaid);


                                if (totalbalance < 0) {

                                    var tembalance = 0;
                                    $("#saldoactual").val((tembalance).toFixed(2));
                                    $("#balance_due").val((tembalance).toFixed(2));
                                    $("#totalAmount").val((result).toFixed(2));
                                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                                } else {

                                    var pay_amount = parseFloat($("#pay_amount").val());                        
                                    var paid_driver = parseFloat($("#paid_driver").val());                        
                                    var temp = parseFloat($("#temp").val());
                                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                          
                                    var op_pag_conduct = parseFloat($("#selectcond").val());                        
                                    var result = parseFloat(total_total) + parseFloat(temp_prepaid);
                                    //var total = parseFloat(apagar) + parseFloat(temp);

                                    $("#saldoactual").val((result).toFixed(2));
                                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                                    $("#totalAmount").val((result).toFixed(2));                                            
                                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                                    if(op_pag_conduct == "3"){

                                        setTimeout(function () {                               

                                                      var balance = parseFloat($("#balance_due").val());
                                                      var porcbal = balance*0.04;
                                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                      $("#balance_due").val((tot_balance).toFixed(2));


                                        }, 0.01);

                                        }

                                    }                                     

                                }
                                
                                if(pay_amount > 0 && paid_driver > 0 && otheramount == 0){

                                var temp = parseFloat($("#temp").val());
                                var temp_driver = parseFloat($("#temp_driver").val());
                                var temp_prepaid = parseFloat($("#temp_prepaid").val());                      
                                var pay_amount = parseFloat($("#pay_amount").val());                        
                                var paid_driver = parseFloat($("#paid_driver").val());
                                var op_pag_conduct = parseFloat($("#selectcond").val());                   

                                var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                  
            //                    var tot_amount = parseFloat(paid_driver) + parseFloat(pay_amount);
                                var agbd = (result - paid_driver).toFixed(2);                   
                                var total = parseFloat(agbd) - parseFloat(pay_amount);


                                $("#saldoactual").val((result).toFixed(2));
                                $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                                $("#totalAmount").val((result).toFixed(2));                        
                                $("#agency_balance_due").val((total).toFixed(2));

                                if(op_pag_conduct == "3"){

                                    setTimeout(function () {                               

                                                      var balance = parseFloat($("#balance_due").val());
                                                      var porcbal = balance*0.04;
                                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);      
                                                      $("#balance_due").val((tot_balance).toFixed(2));

                                        }, 0.01);

                                    }                   



                                }

                                var otheramount = parseFloat($("#otheramount").val());
                
                                if (otheramount > 0 && paid_driver == 0 && pay_amount == 0) {

                                    var op_pag_conduct = parseFloat($("#selectcond").val());
                                    var pay_amount = parseFloat($("#pay_amount").val());
                                    var temp = parseFloat($("#temp").val());
                                    var temp_driver = parseFloat($("#temp_driver").val());
                                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                                    var apagar_2 = parseFloat(otheramount);

                                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                                    var balance = parseFloat(result) - parseFloat(paid_driver);                    
                                    var resultado = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);


                                    if(op_pag_conduct == "3")  { 

                                        $("#saldoactual").val((result).toFixed(2));                 
                                        $("#balance_due").val((balance).toFixed(2));
                                        $("#totalAmount").val((resultado).toFixed(2));
                                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));

                                        setTimeout(function () {                               

                                                      var balanceo = parseFloat($("#balance_due").val());
                                                      var porcbal = balanceo*0.04;
                                                      var tot_balance = parseFloat(balanceo) + parseFloat(porcbal);          

                                                      $("#balance_due").val((tot_balance).toFixed(2));                                                                 

                                        }, 0.01);


                                    }else{    
                                        $("#saldoactual").val((result).toFixed(2));                 
                                        $("#balance_due").val((balance).toFixed(2));
                                        $("#totalAmount").val((resultado).toFixed(2));                        
                                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                                    }

                                }
                                
                                if (otheramount > 0 && paid_driver == 0 && pay_amount > 0) {

                                var temp = parseFloat($("#temp").val());
                                var temp_driver = parseFloat($("#temp_driver").val());                                  
                                var temp_prepaid = parseFloat($("#temp_prepaid").val());                    
                                var op_pag_conduct = parseFloat($("#selectcond").val());                                       
                                var apagar_2 = parseFloat(otheramount);
                                var result = parseFloat(apagar_2) +  parseFloat(temp_driver);
                                var apagar1 = parseFloat(total_total)
                                //+ parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
            //                    var result1 = parseFloat(apagar1) + parseFloat(temp_prepaid);
                                var resultado = parseFloat(apagar1) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                                var bd = parseFloat(result) - parseFloat(paid_driver); 

                                if(op_pag_conduct == "3")  { 


                                    $("#saldoactual").val((result).toFixed(2));                 
                                    $("#balance_due").val((bd).toFixed(2));
                                    $("#totalAmount").val((resultado).toFixed(2));                       
                                    $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));

                                   setTimeout(function () {                               

                                              var balanceo = parseFloat($("#balance_due").val());
                                              var porcbal = balanceo*0.04;
                                              var tot_balance = parseFloat(balanceo) + parseFloat(porcbal);        
                                              $("#balance_due").val((tot_balance).toFixed(2));


                                    }, 0.01);



                                }else{    

                                    $("#saldoactual").val((result).toFixed(2));
                                    $("#balance_due").val((bd).toFixed(2));
                                    $("#totalAmount").val((resultado).toFixed(2));                       
                                    $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));

                                    }


                                }
                                
                                var otheramount = parseFloat($("#otheramount").val());

                                if(otheramount > 0 && paid_driver > 0 && pay_amount == 0){                        

                                    var temp = parseFloat($("#temp").val());                    
                                    var temp_driver = parseFloat($("#temp_driver").val());                   
                                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                     
                                    var op_pag_conduct = parseFloat($("#selectcond").val());
                                    var apagar_2 = parseFloat(otheramount);
                                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);                   
                                    var resultado = parseFloat(total_total) + parseFloat(temp_prepaid) + parseFloat(temp_driver) ;                    
                                    var bd = parseFloat(result) - parseFloat(paid_driver);  

                                    if(op_pag_conduct == "3"){ 

                                        $("#saldoactual").val((result).toFixed(2));                 
                                        $("#balance_due").val((bd).toFixed(2));
                                        $("#totalAmount").val((resultado).toFixed(2));                       
                                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));

                                        setTimeout(function () {                               

                                                  var balance = parseFloat($("#balance_due").val());
                                                  var porcbal = balance*0.04;
                                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                  $("#balance_due").val((tot_balance).toFixed(2));                                                                   

                                        }, 0.01);



                                    }else{    

                                        $("#saldoactual").val((result).toFixed(2));
                                        $("#balance_due").val((bd).toFixed(2));                       
                                        $("#totalAmount").val((resultado).toFixed(2));                       
                                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                                    }


                                }
                                
                                if (otheramount > 0 && paid_driver > 0 && pay_amount > 0) {

                                    var temp = parseFloat($("#temp").val());
                                    var temp_driver = parseFloat($("#temp_driver").val());                    
                                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                    
                                    var op_pag_conduct = parseFloat($("#selectcond").val());                           
                                    var apagar_2 = parseFloat(otheramount);
                                    var pay_amount = parseFloat($("#pay_amount").val());
                                    var paid_driver = parseFloat($("#paid_driver").val());
                                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);                      
                                    var resultado = parseFloat(total_total) + parseFloat(temp_prepaid) + parseFloat(temp_driver);                                       
                                    var bd = parseFloat(result) - parseFloat(paid_driver);                                       
                                    var totalbalance = parseFloat(result) - parseFloat(paid_driver);    
                                    var tot_amount_paid = parseFloat(paid_driver) + parseFloat(pay_amount);  
                                    var agbd = (resultado - paid_driver).toFixed(2);                   
                                    var total = parseFloat(agbd) - parseFloat(pay_amount);



                                        if (totalbalance < 0) {

                                            alert('Pago excedido');                   

                //                          $("#saldoporpagar").val((bal).toFixed(2));
                //                          $("#paid_driver").val((bal).toFixed(2));
                                            $("#balance_due").val(((result) - (paid_driver)).toFixed(2));
                                            $("#totalAmount").text((resultado).toFixed(2));      
                                            $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
                                            $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));

                                        }

                                        if (totalbalance >= 0){

                                            if(op_pag_conduct == "3")  { 


                                                $("#saldoactual").val((result).toFixed(2));                 
                                                $("#balance_due").val((bd).toFixed(2));                                
                                                $("#totalAmount").val((resultado).toFixed(2)); 
                                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
                                                $("#agency_balance_due").val((total).toFixed(2));
                                                
                                                setTimeout(function () {                               

                                                  var balanceo = parseFloat($("#balance_due").val());
                                                  var porcbal = balanceo*0.04;
                                                  var tot_balance = parseFloat(balanceo) + parseFloat(porcbal);          

                                                  $("#balance_due").val((tot_balance).toFixed(2));


                                                }, 0.01);


                                            }else{    

                                                $("#saldoactual").val((result).toFixed(2));
                                                $("#balance_due").val((bd).toFixed(2));
                                                $("#totalAmount").val((resultado).toFixed(2));                       
                                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2)); 
                                                $("#agency_balance_due").val((total).toFixed(2));
                                            }
                                        }


                                }
                                
                                document.getElementById('op_pago_id1').value = 0;
                                document.getElementById('paid_driverp').value = paid_driver;
                                document.getElementById('pay_amountp').value = pay_amount;
                                document.getElementById('tot_amount_paidp').value = total_amount_paid;


                                }

                                
                                //CREDIT CARD NO FEE                                
                                if (tipo_pago == 8) {
                                    
                                                                     
                                    var pay_amount = $("#pay_amount").val();
                                    var paid_driver = $("#paid_driver").val();
                                    var otheramount = parseFloat($("#otheramount").val());
                                    var total_amount_paid = parseFloat($("#tot_amount_paid").val());
//                                    var saldoactual = document.getElementById('saldoactual').value;
                                    
                                   
                                    if (pay_amount == 0 && paid_driver == 0 && otheramount == 0) {

                                        var op_pag_conduct = parseFloat($("#selectcond").val());                    
                                        var temp = parseFloat($("#temp").val());
                                        var paid_driver = parseFloat($("#paid_driver").val());
                                        var pay_amount = parseFloat($("#pay_amount").val());
                                        
                                        var result = parseFloat(total_total) + parseFloat(temp);      
                                        
                                        //cambio julio 18 de 2018 pm*************************************************************
                                        //var result = parseFloat(total_total);

                                        $("#saldoactual").val((result).toFixed(2));
                                        $("#balance_due").val((((result) - (paid_driver))- (pay_amount)).toFixed(2));
                                        $("#totalAmount").val((total_total).toFixed(2));
                                        $("#agency_balance_due").val((((total_total) - (paid_driver)) - (pay_amount)).toFixed(2));

                                        if(op_pag_conduct == "3"){

                                            setTimeout(function () {                               

                                                          var balance = parseFloat($("#balance_due").val());
                                                          var porcbal = balance*0.04;
                                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                          $("#balance_due").val((tot_balance).toFixed(2));


                                            }, 0.01);

                                        }

                                    }
                                    
                                    if (pay_amount == 0 && paid_driver > 0 && otheramount == 0) {
                                        
                                                                               
                                       
                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());       
                                        var op_pag_conduct = parseFloat($("#selectcond").val());
                                        
                                        var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                                        var agbd = (result - paid_driver).toFixed(2);                   
                                        var total = parseFloat(agbd) - parseFloat(pay_amount);
                                        
                                        //alert(agbd);
                                       

                                        $("#saldoactual").val((result).toFixed(2));
                                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                                        $("#totalAmount").val((result).toFixed(2));
                                        $("#agency_balance_due").val((total).toFixed(2));


                                        if(op_pag_conduct == "3"){


                                            setTimeout(function () {                               

                                                          var balance = parseFloat($("#balance_due").val());
                                                          var porcbal = balance*0.04;
                                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                          $("#balance_due").val((tot_balance).toFixed(2));
                    //                                      $("#bal_duep").val((tot_balance).toFixed(2));                                  

                                                }, 0.01);

                                        }                     
                                                                        

                                    }
                                    
                                    if (pay_amount > 0 && paid_driver == 0 && otheramount == 0) {
                                        
                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());  
                                        var op_pag_conduct = parseFloat($("#selectcond").val());                    
                                        var result = parseFloat(total_total) + parseFloat(temp_prepaid);                      
                                        var balance_due = parseFloat($("#balance_due").val());
                                        var pay_amount = parseFloat($("#pay_amount").val());                                   

                                        var totalbalance = ((result) - (paid_driver)) - (pay_amount);
                                        var agbd = (result - paid_driver).toFixed(2);                   
                                        var total = parseFloat(agbd) - parseFloat(pay_amount);    


                                        if (totalbalance < 0) {

                                            var tembalance = 0;
                                            $("#saldoactual").val((tembalance).toFixed(2));
                                            $("#balance_due").val((tembalance).toFixed(2));
                                            $("#totalAmount").val((result).toFixed(2));                      
                                            $("#agency_balance_due").val((total).toFixed(2));

                                        } else {

                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                                            $("#totalAmount").val((result).toFixed(2));                     
                                            $("#agency_balance_due").val((total).toFixed(2));

                                            if(op_pag_conduct == "3"){

                                            setTimeout(function () {                               

                                                          var balance = parseFloat($("#balance_due").val());
                                                          var porcbal = balance*0.04;
                                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                          $("#balance_due").val((tot_balance).toFixed(2));


                                                }, 0.01);

                                            }


                                        }                                      
                                        
                                        
                                    }

                                    if (pay_amount > 0 && paid_driver > 0 && otheramount == 0) {
                                        
                                        //alert("aqui");
//                                        var temp = parseFloat($("#temp").val());
//                                        var temp_driver = parseFloat($("#temp_driver").val());
//                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                   
//                                        var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                    
//                                        var op_pag_conduct = parseFloat($("#selectcond").val());
//                                        var agbd = parseFloat(result) - parseFloat(paid_driver);                   
//                                        var total = parseFloat(agbd) - parseFloat(pay_amount);
//                                        
//                                        $("#saldoactual").val((result).toFixed(2));
//                                        $("#balance_due").val((total).toFixed(2));
//                                        $("#totalAmount").val((result).toFixed(2));                    
//                                        $("#agency_balance_due").val((total).toFixed(2));
//                                                                               
                                        
                                        
                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                  

                                        var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                                        var op_pag_conduct = parseFloat($("#selectcond").val());
                                        var agbd = (result - paid_driver).toFixed(2);                   
                                        var total = parseFloat(agbd) - parseFloat(pay_amount);

                                        $("#saldoactual").val((result).toFixed(2));
                                        $("#balance_due").val((total).toFixed(2));
                                        $("#totalAmount").val((result).toFixed(2));                    
                                        $("#agency_balance_due").val((total).toFixed(2));

                                        if(op_pag_conduct == "3"){

                                            setTimeout(function () {                               

                                                          var balance = parseFloat($("#balance_due").val());
                                                          var porcbal = balance*0.04;
                                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                          $("#balance_due").val((tot_balance).toFixed(2));


                                                }, 0.01);

                                        }

                                        if(op_pag_conduct == "3"){

                                            setTimeout(function () {                               

                                                          var balance = parseFloat($("#balance_due").val());
                                                          var porcbal = balance*0.04;
                                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                          $("#balance_due").val((tot_balance).toFixed(2));

                                                }, 0.01);

                                        }
                                    }
                                    
                                    /*****************************************************************/
                                    

                                    var otheramount = parseFloat($("#otheramount").val());

                                    if (otheramount > 0 && paid_driver == 0 && pay_amount == 0) {
                                        
                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                                     
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                     
                                        var op_pag_conduct = parseFloat($("#selectcond").val());                
                                        var apagar_2 = parseFloat(otheramount);
                                        var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                                        var bd = parseFloat(result) - parseFloat(paid_driver);                      
                                        var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);



                                        if(op_pag_conduct == "3")  {


                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));                       
                                            $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                                           setTimeout(function () {                               

                                                    var balance = parseFloat($("#balance_due").val());
                                                    var porcbal = balance*0.04;
                                                    var tot_balance = parseFloat(balance) + parseFloat(porcbal);    

                                                    $("#balance_due").val((tot_balance).toFixed(2));                                                     

                                           }, 0.01);



                                        }else{

                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));                       
                                            $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                                        }
                                    }
                                    
                                    if (otheramount > 0 && paid_driver == 0 && pay_amount > 0) {

                                        var pay_amount = parseFloat($("#pay_amount").val());
                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                           
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                    
                                        var op_pag_conduct = parseFloat($("#selectcond").val());                    
                                        var apagar_2 = parseFloat(otheramount);                    
                                        var result = parseFloat(apagar_2) + parseFloat(temp_driver);                     
                                        var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                   
                                        var bd = parseFloat(result) - parseFloat(paid_driver);   
                                        var agbd = (res_total - paid_driver).toFixed(2);                   
                                        var total = parseFloat(agbd) - parseFloat(pay_amount);

                                        if(op_pag_conduct == "3")  {

                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));                     
                                            $("#agency_balance_due").val((total).toFixed(2));


                                            setTimeout(function () {                               

                                                      var balance = parseFloat($("#balance_due").val());
                                                      var porcbal = balance*0.04;
                                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                      $("#balance_due").val((tot_balance).toFixed(2));


                                            }, 0.01);

                                        }else{

                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));                      
                                            $("#agency_balance_due").val((total).toFixed(2));                        


                                        }
                                        


                                    }
                                    
                                    if (otheramount > 0 && paid_driver > 0 && pay_amount == 0) {
                                        
                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                                   
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                     
                                        var op_pag_conduct = parseFloat($("#selectcond").val());                    
                                        var pay_amount = parseFloat($("#pay_amount").val());
                                        var paid_driver = $("#paid_driver").val();
                                        var apagar_2 = parseFloat(otheramount);
                                        var result = parseFloat(apagar_2) + parseFloat(temp_driver); 
                                        var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                    
                                        var bd = parseFloat(result) - parseFloat(paid_driver);  
                                        var agbd = (res_total - paid_driver).toFixed(2);                   
                                        var total = parseFloat(agbd) - parseFloat(pay_amount);


                                        if(op_pag_conduct == "3")  {


                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));                      
                                            $("#agency_balance_due").val((total).toFixed(2));

                                            setTimeout(function () {                               

                                                      var balance = parseFloat($("#balance_due").val());
                                                      var porcbal = balance*0.04;
                                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                      $("#balance_due").val((tot_balance).toFixed(2));


                                            }, 0.01);



                                        }else{

                                            $("#saldoactual").val((result).toFixed(2));                    
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").text((res_total).toFixed(2));                      
                                            $("#agency_balance_due").val((total).toFixed(2));

                                        }                   
                   
                                        
                                    }
                                    
                                    if (otheramount > 0 && paid_driver > 0 && pay_amount > 0) {


                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                                     
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                                                 
                                        var op_pag_conduct = parseFloat($("#selectcond").val());                    
                                        var pay_amount = parseFloat($("#pay_amount").val());
                                        var paid_driver = $("#paid_driver").val();
                                        var apagar_2 = parseFloat(otheramount);                    
                                        var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                                        var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);  
                                        var tot_amount_paid = parseFloat(paid_driver) + parseFloat(pay_amount);
                                        var bd = parseFloat(result) - parseFloat(paid_driver); 
                                        var agbd = (res_total - paid_driver).toFixed(2);                   
                                        var total = parseFloat(agbd) - parseFloat(pay_amount);

                                        if (bd < 0) {

                                                alert('Pago excedido');                   

                    //                          $("#saldoactual").val((bal).toFixed(2));
                    //                          $("#paid_driver").val((bal).toFixed(2));
                                                $("#balance_due").val((bd).toFixed(2));
                                                $("#totalAmount").val((res_total).toFixed(2));  
                                                $("#agency_balance_due").val((total).toFixed(2));

                                            }
                                            if(bd >= 0) {

                                                if(op_pag_conduct == "3")  {


                                                    $("#saldoactual").val((result).toFixed(2));
                                                    $("#balance_due").val((bd).toFixed(2));
                                                    $("#totalAmount").val((res_total).toFixed(2));                             
                                                    $("#agency_balance_due").val((total).toFixed(2));

                                                    setTimeout(function () {                               

                                                      var balance = parseFloat($("#balance_due").val());
                                                      var porcbal = balance*0.04;
                                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                      $("#balance_due").val((tot_balance).toFixed(2));


                                                    }, 0.01);




                                                }else{
                    //                                
                                                    $("#saldoactual").val((result).toFixed(2));                    
                                                    $("#balance_due").val((bd).toFixed(2));
                                                    $("#totalPagar").text((res_total).toFixed(2));
                                                    $("#totaltotal").text((res_total).toFixed(2));
                                                    //$("#tot_amount_paid").val((tot_amount_paid).toFixed(2));   
                    //                                $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                                                    $("#agency_balance_due").val((total).toFixed(2));
                                                }

                                            }

                                    }                 
                                    
                                    //artificio para enviar el valor de paid_driver, pay_amount y tot_amount_paid  por POST ya que paid_driver, pay_amount y tot_amount_paid reciben valores de la tabla tours_oneday de la bd

                                    document.getElementById('paid_driverp').value = paid_driver;
                                    document.getElementById('pay_amountp').value = pay_amount;
                                    document.getElementById('tot_amount_paidp').value = total_amount_paid;                                    

                                    document.getElementById('op_pago_id1').value = 0;
                                    
                                   


                                }

                                //CASH
                                if (tipo_pago == 4) {
                                    
                                    var paid_driver = parseFloat($("#paid_driver").val());
                                    var pay_amount = parseFloat($("#pay_amount").val());                
                                    var otheramount = parseFloat($("#otheramount").val());
                                    
                                    if (pay_amount == 0 && paid_driver == 0 && otheramount == 0) {
                                        
                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                                       
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                      
                                        var op_pag_conduct = parseFloat($("#selectcond").val());
                                        var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                                        $("#saldoactual").val((result).toFixed(2));
                                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                                        $("#totalAmount").val((result).toFixed(2));                 
                                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                                        if(op_pag_conduct == "3"){

                                            setTimeout(function () {                               

                                                          var balance = parseFloat($("#balance_due").val());
                                                          var porcbal = balance*0.04;
                                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                          $("#balance_due").val((tot_balance).toFixed(2));


                                            }, 0.01);

                                        }                                        
                                        
                   
                                    }   
                                    
                                     if (pay_amount == 0 && paid_driver > 0 && otheramount == 0) {

                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                                     
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                       
                                        var op_pag_conduct = parseFloat($("#selectcond").val());
                                        var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                                        $("#saldoactual").val((result).toFixed(2));
                                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                                        $("#totalAmount").val((result).toFixed(2));
                                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                                        if(op_pag_conduct == "3"){

                                            setTimeout(function () {                               

                                                          var balance = parseFloat($("#balance_due").val());
                                                          var porcbal = balance*0.04;
                                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                          $("#balance_due").val((tot_balance).toFixed(2));


                                                }, 0.01);

                                        }                

                                    }
                                    
                                    if (pay_amount > 0 && paid_driver == 0 && otheramount == 0) {
                                        
                                        
                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                                
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                       
                                        var op_pag_conduct = parseFloat($("#selectcond").val());
                                        var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                 
                                        var totalbalance = ((result) - (paid_driver)) - (pay_amount);

                                        if (totalbalance < 0) {

                                            var tembalance = 0;
                                            $("#saldoactual").val((tembalance).toFixed(2));
                                            $("#balance_due").val((tembalance).toFixed(2));
                                            $("#totalAmount").val((result).toFixed(2));                       
                                            $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                                        } else {

                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                                            $("#totalAmount").val((result).toFixed(2));                        
                                            $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                                            if(op_pag_conduct == "3"){

                                            setTimeout(function () {                               

                                                          var balance = parseFloat($("#balance_due").val());
                                                          var porcbal = balance*0.04;
                                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                          $("#balance_due").val((tot_balance).toFixed(2));


                                                }, 0.01);

                                            }


                                        }

                                    }
                                    
                                    if (pay_amount > 0 && paid_driver > 0 && otheramount == 0) {

                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                    
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                                    
                                        var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                                        var op_pag_conduct = parseFloat($("#selectcond").val());

                                        $("#saldoactual").val((result).toFixed(2));
                                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                                        $("#totalAmount").val((result).toFixed(2));                   
                                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                                        if(op_pag_conduct == "3"){

                                            setTimeout(function () {                               

                                                          var balance = parseFloat($("#balance_due").val());
                                                          var porcbal = balance*0.04;
                                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                          $("#balance_due").val((tot_balance).toFixed(2));


                                                }, 0.01);

                                        }

                                    }
                                    
                                    var otheramount = parseFloat($("#otheramount").val());
                                    
                                    if (otheramount > 0 && paid_driver == 0 && pay_amount == 0) {

                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                    
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                                 
                                        var op_pag_conduct = parseFloat($("#selectcond").val());
                                        //var other_amount = $("#otheramount").val();
                                        var apagar_2 = parseFloat(otheramount);
                                        var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                                        var bd = parseFloat(result) - parseFloat(paid_driver);   
                                        //var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                                        var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                                        if(op_pag_conduct == "3")  {


                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));                        
                                            $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                                           setTimeout(function () {                               

                                                    var balance = parseFloat($("#balance_due").val());
                                                    var porcbal = balance*0.04;
                                                    var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                    $("#balance_due").val((tot_balance).toFixed(2));


                                           }, 0.01);



                                        }else{

                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));                        
                                            $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                                        }

                                    }
                                    
                                    if (otheramount > 0 && paid_driver == 0 && pay_amount > 0) {

                                        var pay_amount = parseFloat($("#pay_amount").val());
                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                               
                                        var op_pag_conduct = parseFloat($("#selectcond").val());                    
                                        var apagar_2 = parseFloat(otheramount);                    
                                        var result = parseFloat(apagar_2) + parseFloat(temp_driver) ;                     
                                        var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                   
                                        var bd = parseFloat(result) - parseFloat(paid_driver);   
                                        var agbd = (res_total - paid_driver).toFixed(2);                   
                                        var total = parseFloat(agbd) - parseFloat(pay_amount);

                                        if(op_pag_conduct == "3")  {

                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));             
                                            $("#agency_balance_due").val((total).toFixed(2));

                                            setTimeout(function () {                               

                                                      var balance = parseFloat($("#balance_due").val());
                                                      var porcbal = balance*0.04;
                                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                      $("#balance_due").val((tot_balance).toFixed(2));


                                            }, 0.01);

                                        }else{

                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));                        
                                            $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));



                                        }
                                       

                                    }

                                    if (otheramount > 0 && paid_driver > 0 && pay_amount == 0) {
                                        
                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                    
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                                
                                        var op_pag_conduct = parseFloat($("#selectcond").val());                    
                                        var pay_amount = parseFloat($("#pay_amount").val());
                                        var paid_driver = $("#paid_driver").val();
                                        var apagar_2 = parseFloat(otheramount);
                                        var result = parseFloat(apagar_2) + parseFloat(temp_driver); 
                                        var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                    
                                        var bd = parseFloat(result) - parseFloat(paid_driver);    
                                        var agbd = (res_total - paid_driver).toFixed(2);                   
                                        var total = parseFloat(agbd) - parseFloat(pay_amount);

                                        if(op_pag_conduct == "3")  {


                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));
                                            $("#agency_balance_due").val((total).toFixed(2));

                                            setTimeout(function () {                               

                                                      var balance = parseFloat($("#balance_due").val());
                                                      var porcbal = balance*0.04;
                                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                      $("#balance_due").val((tot_balance).toFixed(2));


                                            }, 0.01);



                                        }else{

                                            $("#saldoactual").val((result).toFixed(2));                    
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));                        
                                            $("#agency_balance_due").val((total).toFixed(2));

                                        }
                                        
                                    }
                                    
                                    if (otheramount > 0 && paid_driver > 0 && pay_amount > 0) {
                                        
                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                    
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                                  
                                        var op_pag_conduct = parseFloat($("#selectcond").val());                    
                                        var pay_amount = parseFloat($("#pay_amount").val());
                                        var paid_driver = $("#paid_driver").val();
                                        var apagar_2 = parseFloat(otheramount);                    
                                        var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                                        var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);  
                                        var tot_amount_paid = parseFloat(paid_driver) + parseFloat(pay_amount);
                                        var bd = parseFloat(result) - parseFloat(paid_driver);   
                                        var agbd = (res_total - paid_driver).toFixed(2);                   
                                        var total = parseFloat(agbd) - parseFloat(pay_amount);


                                        if (bd < 0) {

                                                alert('Pago excedido');                   

                    //                          $("#saldoporpagar").val((bal).toFixed(2));
                    //                          $("#paid_driver").val((bal).toFixed(2));
                                                $("#balance_due").val((bd).toFixed(2));
                                                $("#totalAmount").val((res_total).toFixed(2));
                                                $("#agency_balance_due").val((total).toFixed(2));

                                            }
                                            if(bd >= 0) {

                                                if(op_pag_conduct == "3")  {


                                                    $("#saldoactual").val((result).toFixed(2));
                                                    $("#balance_due").val((bd).toFixed(2));
                                                    $("#totalAmount").val((res_total).toFixed(2));                                
                                                    $("#agency_balance_due").val((total).toFixed(2));

                                                    setTimeout(function () {                               

                                                      var balance = parseFloat($("#balance_due").val());
                                                      var porcbal = balance*0.04;
                                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                      $("#balance_due").val((tot_balance).toFixed(2));


                                                    }, 0.01);




                                                }else{
                    //                                
                                                    $("#saldoactual").val((result).toFixed(2));                    
                                                    $("#balance_due").val((bd).toFixed(2));
                                                    $("#totalAmount").val((res_total).toFixed(2));                                
                                                    $("#agency_balance_due").val((total).toFixed(2));
                                                }

                                            }

                                    }


                                    
                                    

                                        //artificio para enviar el valor de paid_driver, pay_amount y tot_amount_paid  por POST ya que paid_driver, pay_amount y tot_amount_paid reciben valores de la tabla tours_oneday de la bd
                                        document.getElementById('paid_driverp').value = paid_driver;
                                        document.getElementById('pay_amountp').value = pay_amount;
                                        document.getElementById('tot_amount_paidp').value = total_amount_paid;
                                        document.getElementById('op_pago_id1').value = 0;



                                }

                                //paid
                                if (tipo_pago == 6) {
                                    
                                                                      
                                    var temp = parseFloat($("#temp").val());  
                                    var pay_amount = parseFloat($("#pay_amount").val());
                                    var totalamount = parseFloat($("#totalAmount").val());
                                    var paid_driver = parseFloat($("#paid_driver").val());
                                    var otheramount = parseFloat($("#otheramount").val());
                                    
                                    var pay_porc = (pay_amount) - (pay_amount/1.04);
                                    var totalAmt = total_total + pay_porc;
                                    var totale = parseFloat(totalAmt) -  parseFloat(pay_amount);
                                    var cv = 0;

                                    
                                    
                                    $("#saldoactual").val((cv).toFixed(2));
                                    $("#paid_driver").val((cv).toFixed(2));
                                    $("#balance_due").val((cv).toFixed(2));
                                    $("#totalAmount").val((totalAmt).toFixed(2));                                    
                                    $("#agency_balance_due").val((totale).toFixed(2));
                                    
                                    
                                    if (pay_amount > 0 && paid_driver == 0 && otheramount == 0) {
                                        
                                        
                                       
                                        var pay_amount = parseFloat($("#pay_amount").val());
                                        var paid_driver = parseFloat($("#paid_driver").val());
                                        var totalamount = parseFloat($("#totalAmount").val());
                                        var temp = parseFloat($("#temp").val());
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());
                                        var totalbalance = ((total_total + temp_prepaid) - (paid_driver)) - (pay_amount);                    
                                        var result = parseFloat(total_total) + parseFloat(temp_prepaid);
                                        var saldoporpagar = parseFloat(total_total) + parseFloat(temp_prepaid);
                                        
                                        //alert(totalbalance);

                                        if (totalbalance < 0) {

                                            var tembalance = 0;
                                            $("#saldoactual").val((tembalance).toFixed(2));
                                            $("#paid_driver").val((tembalance).toFixed(2));
                                            $("#balance_due").val((tembalance).toFixed(2));
                                            $("#totalAmount").val((totalAmt).toFixed(2));                       
                                            $("#agency_balance_due").val((((totalAmt) - (paid_driver)) - (pay_amount)).toFixed(2));

                                        } else {

                                            
                                            
                                            var temp = parseFloat($("#temp").val());  
                                            var pay_amount = parseFloat($("#pay_amount").val());
                                            var totalamount = parseFloat($("#totalAmount").val());
                                            var paid_driver = parseFloat($("#paid_driver").val());
                                            var otheramount = parseFloat($("#otheramount").val());

                                            var pay_porc = (pay_amount) - (pay_amount/1.04);
                                            var totalAmt = total_total + pay_porc;
                                            var totale = parseFloat(totalAmt) -  parseFloat(pay_amount);
                                            var cv = 0;
                                                                                       
                                            
                                            $("#saldoactual").val((cv).toFixed(2));
                                            $("#paid_driver").val((cv).toFixed(2));
                                            $("#balance_due").val((cv).toFixed(2));
                                            $("#totalAmount").val((totalAmt).toFixed(2));                                          
                                            $("#agency_balance_due").val((totale).toFixed(2));



                                        }

                                    }


                                }
                                //CREDIT VOUCHER
                                if (tipo_pago == 5) {
                                    
                                    var temp = parseFloat($("#temp").val());  
                                    var pay_amount = parseFloat($("#pay_amount").val());
                                    var totalamount = parseFloat($("#totalAmount").val());
                                    var totale = parseFloat(totalamount) -  parseFloat(pay_amount);
                                    var cv = 0;

                                    $("#saldoactual").val((cv).toFixed(2));
                                    $("#paid_driver").val((cv).toFixed(2));
                                    $("#balance_due").val((cv).toFixed(2));
                                    $("#totalAmount").val((total_total).toFixed(2));
                                    $("#pay_amount").text((cv).toFixed(2));
                                    $("#agency_balance_due").val((totale).toFixed(2));

                                    if (pay_amount > 0 && paid_driver == 0 && otheramount == 0) {


                                        var pay_amount = parseFloat($("#pay_amount").val());
                                        var paid_driver = parseFloat($("#paid_driver").val());
                                        var temp = parseFloat($("#temp").val());
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());
                                        var totalbalance = ((total_total + temp_prepaid) - (paid_driver)) - (pay_amount);                    
                                        var result = parseFloat(total_total) + parseFloat(temp_prepaid);
                                        var saldoporpagar = parseFloat(total_total) + parseFloat(temp_prepaid);

                                        if (totalbalance < 0) {

                                            var tembalance = 0;
                                            $("#saldoactual").val((tembalance).toFixed(2));
                                            $("#paid_driver").val((tembalance).toFixed(2));
                                            $("#balance_due").val((tembalance).toFixed(2));
                                            $("#totalAmount").val((result).toFixed(2));                       
                                            $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                                        } else {

                                            var cv = 0;
                                            var pay_amount = parseFloat($("#pay_amount").val());                        
                                            var paid_driver = parseFloat($("#paid_driver").val());                        
                                            var temp = parseFloat($("#temp").val());
                                            var temp_prepaid = parseFloat($("#temp_prepaid").val());                          
                                            var op_pag_conduct = parseFloat($("#selectcond").val());                        
                                            var result = parseFloat(total_total) + parseFloat(temp_prepaid);
                                            //var total = parseFloat(apagar) + parseFloat(temp);

                                            $("#saldoactual").val((cv).toFixed(2));
                                            $("#paid_driver").val((cv).toFixed(2));
                                            $("#balance_due").val((cv).toFixed(2));
                                            $("#totalAmount").val((result).toFixed(2));                                          
                                            $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));



                                        }

                                    }


                                }

                                //CHECK
                                if (tipo_pago == 9) {
                                    
                                    var temp = parseFloat($("#temp").val());
                                    var paid_driver = parseFloat($("#paid_driver").val());
                                    var pay_amount = parseFloat($("#pay_amount").val());
                                    
                                    
                                    if (pay_amount == 0 && paid_driver == 0 && otheramount == 0) {

                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                    
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                    
                                        var op_pag_conduct = parseFloat($("#selectcond").val());
                                        var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                                        var agbd = (result - paid_driver).toFixed(2);   
                                        var total = parseFloat(agbd) - parseFloat(pay_amount);

                                        $("#saldoactual").val((result).toFixed(2));
                                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                                        $("#totalAmount").val((result).toFixed(2));                   
                                        $("#agency_balance_due").val((total).toFixed(2));

                                        if(op_pag_conduct == "3"){

                                            setTimeout(function () {                               

                                                          var balance = parseFloat($("#balance_due").val());
                                                          var porcbal = balance*0.04;
                                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                          $("#balance_due").val((tot_balance).toFixed(2));


                                            }, 0.01);

                                        }
                   
                                    }   
                                    
                                    if (pay_amount == 0 && paid_driver > 0 && otheramount == 0) {

                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                                       
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                        
                                        var op_pag_conduct = parseFloat($("#selectcond").val());
                                        var result = parseFloat(total_total) + parseFloat(temp_driver);

                                        $("#saldoactual").val((result).toFixed(2));
                                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                                        $("#totalAmount").val((result).toFixed(2));                    
                                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                                        if(op_pag_conduct == "3"){

                                            setTimeout(function () {                               

                                                          var balance = parseFloat($("#balance_due").val());
                                                          var porcbal = balance*0.04;
                                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                          $("#balance_due").val((tot_balance).toFixed(2));


                                                }, 0.01);

                                        }

                                    }
                                    
                                    if (pay_amount > 0 && paid_driver == 0 && otheramount == 0) {

                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                                      
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                      
                                        var pay_amount = parseFloat($("#pay_amount").val());
                                        var paid_driver = parseFloat($("#paid_driver").val());  
                                        var op_pag_conduct = parseFloat($("#selectcond").val());
                                        var result = parseFloat(total_total) + parseFloat(temp_prepaid) + parseFloat(temp_driver) ;               
                                        var balance = apagar + temp_prepaid + temp_driver;        
                                        var totalbalance = ((balance) - (paid_driver)) - (pay_amount);

                                        var agbd = (result - paid_driver).toFixed(2);                   
                                        var total = parseFloat(agbd) - parseFloat(pay_amount);


                                        if (totalbalance < 0) {

                                            var tembalance = 0;

                                            $("#saldoactual").val((tembalance).toFixed(2));
                                            $("#balance_due").val((tembalance).toFixed(2));
                                            $("#totalAmount").val((result).toFixed(2));                       
                                            $("#agency_balance_due").val((total).toFixed(2));

                                        } else {

                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                                            $("#totalAmount").val((result).toFixed(2));                      
                                            $("#agency_balance_due").val((total).toFixed(2));

                                            if(op_pag_conduct == "3"){

                                                setTimeout(function () {                               

                                                          var balance = parseFloat($("#balance_due").val());
                                                          var porcbal = balance*0.04;
                                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                          $("#balance_due").val((tot_balance).toFixed(2));


                                                }, 0.01);

                                            }

                                        }

                                    }
                                    
                                    if (pay_amount > 0 && paid_driver > 0 && otheramount == 0) {
                                        
                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                  

                                        var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                                        var op_pag_conduct = parseFloat($("#selectcond").val());
                                        var agbd = (result - paid_driver).toFixed(2);                   
                                        var total = parseFloat(agbd) - parseFloat(pay_amount);

                                        $("#saldoactual").val((result).toFixed(2));
                                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                                        $("#totalAmount").val((result).toFixed(2));                    
                                        $("#agency_balance_due").val((total).toFixed(2));

                                        if(op_pag_conduct == "3"){

                                            setTimeout(function () {                               

                                                          var balance = parseFloat($("#balance_due").val());
                                                          var porcbal = balance*0.04;
                                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                          $("#balance_due").val((tot_balance).toFixed(2));


                                                }, 0.01);

                                        }
                                        
                                    }
                                    
                                    //var otheramount = $("#otheramount").val();
                                    var otheramount = parseFloat($("#otheramount").val());
                                    
                                    if (otheramount > 0 && paid_driver == 0 && pay_amount == 0) {

                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                    
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                      
                                        var op_pag_conduct = parseFloat($("#selectcond").val());
                                        //var other_amount = $("#otheramount").val();
                                        var apagar_2 = parseFloat(otheramount);
                                        var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                                        var bd = parseFloat(result) - parseFloat(paid_driver);   
                                        //var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                                        var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);

                                        if(op_pag_conduct == "3")  {


                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));                        
                                            $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                                           setTimeout(function () {                               

                                                    var balance = parseFloat($("#balance_due").val());
                                                    var porcbal = balance*0.04;
                                                    var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                    $("#balance_due").val((tot_balance).toFixed(2));


                                           }, 0.01);



                                        }else{

                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));                        
                                            $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));


                                        }

                                    }
                                    
                                    if (otheramount > 0 && paid_driver == 0 && pay_amount > 0) {

                                        var pay_amount = parseFloat($("#pay_amount").val());
                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                                
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                       
                                        var op_pag_conduct = parseFloat($("#selectcond").val());                    
                                        var apagar_2 = parseFloat(otheramount);                    
                                        var result = parseFloat(apagar_2) + parseFloat(temp_driver);                     
                                        var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                   
                                        var bd = parseFloat(result) - parseFloat(paid_driver);   
                                        var agbd = (res_total - paid_driver).toFixed(2);                   
                                        var total = parseFloat(agbd) - parseFloat(pay_amount);

                                        if(op_pag_conduct == "3")  {

                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));                        
                                            $("#agency_balance_due").val((total).toFixed(2));


                                            setTimeout(function () {                               

                                                      var balance = parseFloat($("#balance_due").val());
                                                      var porcbal = balance*0.04;
                                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                      $("#balance_due").val((tot_balance).toFixed(2));


                                            }, 0.01);

                                        }else{

                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));
                                            $("#agency_balance_due").val((total).toFixed(2));                       

                                        }
                                        

                                    }

                                    if (otheramount > 0 && paid_driver > 0 && pay_amount == 0) {
                                        
                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                                        
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                       
                                        var op_pag_conduct = parseFloat($("#selectcond").val());                    
                                        var pay_amount = parseFloat($("#pay_amount").val());
                                        var paid_driver = $("#paid_driver").val();
                                        var apagar_2 = parseFloat(otheramount);
                                        var result = parseFloat(apagar_2) + parseFloat(temp_driver); 
                                        var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                    
                                        var bd = parseFloat(result) - parseFloat(paid_driver);    
                                        var agbd = (res_total - paid_driver).toFixed(2);                   
                                        var total = parseFloat(agbd) - parseFloat(pay_amount);


                                        if(op_pag_conduct == "3")  {


                                            $("#saldoactual").val((result).toFixed(2));
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));                       
                                            $("#agency_balance_due").val((total).toFixed(2));

                                            setTimeout(function () {                               

                                                      var balance = parseFloat($("#balance_due").val());
                                                      var porcbal = balance*0.04;
                                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                      $("#balance_due").val((tot_balance).toFixed(2));


                                            }, 0.01);



                                        }else{

                                            $("#saldoactual").val((result).toFixed(2));                    
                                            $("#balance_due").val((bd).toFixed(2));
                                            $("#totalAmount").val((res_total).toFixed(2));                        
                                            $("#agency_balance_due").val((total).toFixed(2));

                                        }                                         

                                    }
                                    
                                    if (otheramount > 0 && paid_driver > 0 && pay_amount > 0) {
                                        
                                        var temp = parseFloat($("#temp").val());
                                        var temp_driver = parseFloat($("#temp_driver").val());                                      
                                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                        
                                        var op_pag_conduct = parseFloat($("#selectcond").val());                    
                                        var pay_amount = parseFloat($("#pay_amount").val());
                                        var paid_driver = $("#paid_driver").val();
                                        var apagar_2 = parseFloat(otheramount);                    
                                        var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                                        var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);  
                                        var tot_amount_paid = parseFloat(paid_driver) + parseFloat(pay_amount);
                                        var bd = parseFloat(result) - parseFloat(paid_driver); 
                                        var agbd = (res_total - paid_driver).toFixed(2);                   
                                        var total = parseFloat(agbd) - parseFloat(pay_amount);

                                        if (bd < 0) {

                                                alert('Pago excedido');                   

                    //                          $("#saldoactual").val((bal).toFixed(2));
                    //                          $("#paid_driver").val((bal).toFixed(2));
                                                $("#balance_due").val((bd).toFixed(2));
                                                $("#totalAmount").val((res_total).toFixed(2));                         
                                                $("#agency_balance_due").val((total).toFixed(2));


                                            }
                                            if(bd >= 0) {

                                                if(op_pag_conduct == "3")  {


                                                    $("#saldoactual").val((result).toFixed(2));
                                                    $("#balance_due").val((bd).toFixed(2));
                                                    $("#totalAmount").val((res_total).toFixed(2));                                
                                                    $("#agency_balance_due").val((total).toFixed(2));


                                                    setTimeout(function () {                               

                                                      var balance = parseFloat($("#balance_due").val());
                                                      var porcbal = balance*0.04;
                                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                                      $("#balance_due").val((tot_balance).toFixed(2));


                                                    }, 0.01);




                                                }else{
                    //                                
                                                    $("#saldoactual").val((result).toFixed(2));                    
                                                    $("#balance_due").val((bd).toFixed(2));
                                                    $("#totalAmount").val((res_total).toFixed(2));                                
                                                    $("#agency_balance_due").val((total).toFixed(2));


                                                    }

                                             }
                                        
                                        
                                    }

                                    //artificio para enviar el valor de paid_driver, pay_amount y tot_amount_paid  por POST ya que paid_driver, pay_amount y tot_amount_paid reciben valores de la tabla tours_oneday de la bd
                                    document.getElementById('paid_driverp').value = paid_driver;
                                    document.getElementById('pay_amountp').value = pay_amount;
                                    document.getElementById('tot_amount_paidp').value = total_amount_paid;                                   

                                    document.getElementById('op_pago_id1').value = 0;                                    



                                }
  


                                    //$("#agency_balance_due").val((diff).toFixed(2));
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
                                                        $("#park_transport").html('$ ' + (tkxp_total_su).toFixed(2));

                                                    } else {//es un decimal

                                                        //$("#park_admision").html('$ ' + tkxp_total); 
                                                        $("#park_transport").html('$ ' + (tkxp_total_su).toFixed(2));

                                                    }


                                                    //$("#park_admision").html('$ ' + Math.ceil(tkxp_total) + '.00');

                                                    //$("#park_admision").html('$ ' + tkxp_total + '.00');

                                                    if (tkxp_total % 1 == 0) {//es un entero

                                                        //$("#park_admision").html('$ ' + tkxp_total + '.00');
                                                        $("#park_admision").html('$ ' + (tkxp_total).toFixed(2));

                                                    } else {//es un decimal

                                                        //$("#park_admision").html('$ ' + tkxp_total); 
                                                        $("#park_admision").html('$ ' + (tkxp_total).toFixed(2));

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
                                        $("#incl_ticket").val(1);
//                                        $("#cambiar_tikete").val(1);
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
                                            $("#park_transport").html('$ ' + (tkxp_total_su).toFixed(2));

                                        } else {//es un decimal

                                            //$("#park_admision").html('$ ' + tkxp_total); 
                                            $("#park_transport").html('$ ' + (tkxp_total_su).toFixed(2));

                                        }

                                        //$("#park_admision").html('$ ' + tkxp_total + '.00');

                                        if (tkxp_total % 1 == 0) {//es un entero

                                            //$("#park_admision").html('$ ' + tkxp_total + '.00');
                                            $("#park_admision").html('$ ' + (tkxp_total).toFixed(2));

                                        } else {//es un decimal

                                            //$("#park_admision").html('$ ' + tkxp_total); 
                                            $("#park_admision").html('$ ' + (tkxp_total).toFixed(2));

                                        }

                                    } else {
                                        //            alert("2");
                                        console.log("here2");
                                        $("#adm_selector").attr("checked", false);
                                        $("#incl_ticket").val(0);
//                                        $("#cambiar_tikete").val(0);
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
                                
                                     bPreguntar = false;
                                     preguntarAntesDeSalir();
                                     console.log('problema');               

                                     if (valid()) {
                                     $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/3");
                                     $("#content").css("display", "none");                 
                                     $("#form1").attr('target', '_parent').submit();
                                    }    
//                                    if (valid()) {
//                                        $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/3");
//                                        $("#content").css("display", "none");
//                                        bPreguntar = false;
//                                        $("#form1").submit();
//                                    }
                                });
                                $("#btn-save1").click(function () {
                                    if (valid()) {
                                        location.href = "<?php echo $data['rootUrl'] ?>admin/onedaytour/"
                                    }
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
                                ////////////////////////EVITAR BLOQUEO DE CAJA DE TEXTO//////////
//                                $('#descuento_valor').keydown(function (evt) {
//                                    var actual = parseFloat($(this).val());
//                                    var pres = String.fromCharCode(evt.which);
//                                    var total = parseFloat($("#total_first").val());
//                                    if (parseFloat(actual + pres) > total) {
//                                        evt.preventDefault();
//                                    }
//                                });
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
                                
                                //validar Notas
                                if ($("#comments").val() == ""){
                                    alert("Please Type One Note");
                                    $("#comments").focus();
                                    return false;
                                }

                              
                                if (!$("#opcion_pago_Cash_2").is(':checked') && !$("#opcion_pago_passager_2").is(':checked') && !$("#opcion_pago_predpaid_check").is(':checked') && !$("#opcion_pago_complementary").is(':checked') && (!$("#opcion_pago_passager").is(':checked') && !$("#opcion_pago_agency").is(':checked') && !$("#opcion_pago_predpaid_cash").is(':checked') && !$("#opcion_pago_CrediFee").is(":checked") && !$("#opcion_pago_Cash").is(':checked') && !$("#opcion_pago_Voucher").is(':checked'))) {
                                    alert('Please select a payment option');
                                    $("#opcion_pago_passager").focus();
                                    return false;
                                }
                                return at_point;
                            }

                            $(document).ready(function () {                                  
                                
                                
                                //document.getElementById("cambiar_tikete").value = document.getElementById('incl_ticket').value;
                                 
                                $("#wdwus").click(function () {

                                    if ($("#wdwus").is(':checked')) {


                                        document.getElementById("from").value = document.getElementById('fromt').value;
                                        document.getElementById("to2").value = document.getElementById('tot2').value;

                                        document.getElementById("a_pickup1").value = document.getElementById('pickup').value;
                                        document.getElementById("d_pickup1").value = document.getElementById('dropoff').value;



                                        setTimeout(function () {

                                            var precio1 = '<?php echo $price_adult_wdw; ?>';
                                            var precio2 = '<?php echo $price_child_wdw; ?>';

                                            var adult = $("#adult").val();
                                            var child = $("#child").val();

                                            document.getElementById("adult").disabled = '';
                                            document.getElementById("child").disabled = '';

                                            document.getElementById("priceadults").value = precio1;
                                            document.getElementById("pricechilds").value = precio2;

                                            var tres = ((parseFloat($("#priceadults").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricechilds").val()) * parseFloat($("#child").val())) / 2).toFixed(2);
                                            

                                            $("#price_transport1pp").html("$" + tres);
                                            $("#price_transport2pp").html("$" + tres);


                                            $("#wdwus").focus();


                                        }, 100);


                                    }
                                });


                                $("#wphol").click(function () {

                                    if ($("#wphol").is(':checked')) {


                                        document.getElementById("from").value = document.getElementById('fromt').value;
                                        document.getElementById("to2").value = document.getElementById('tot2').value;

                                        document.getElementById("a_pickup1").value = document.getElementById('pickup').value;
                                        document.getElementById("d_pickup1").value = document.getElementById('dropoff').value;


                                        setTimeout(function () {

                                            var precio3 = '<?php echo $price_adult_WATERP; ?>';
                                            var precio4 = '<?php echo $price_child_WATERP; ?>';

                                            var adult = $("#adult").val();
                                            var child = $("#child").val();

                                            document.getElementById("adult").disabled = '';
                                            document.getElementById("child").disabled = '';

                                            document.getElementById("priceadults").value = precio3;
                                            document.getElementById("pricechilds").value = precio4;



                                            var tres = ((parseFloat($("#priceadults").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricechilds").val()) * parseFloat($("#child").val())) / 2).toFixed(2);
                                            

                                            $("#price_transport1pp").html("$" + tres);
                                            $("#price_transport2pp").html("$" + tres);

                                            $("#wphol").focus();



                                        }, 100);

                                    }
                                });
                                
//                $("#incl_ticket").change(function () {
//                
//                    document.getElementById("incluir_tickete").value = document.getElementById('incl_ticket').value;
//                    
//                });
                                
                $("#adult, #child").change(function () {
                                       
                            var saldo_actual =  $("#saldoactual").val();

                            if(saldo_actual != "0.00"){         

                            var adultos = $("#adult").val();  
                            var chicos = $("#child").val();           
                            var id = $("#from").val();                            
                            var total_pax = parseInt(adultos) + parseInt(chicos);
                            var fecha = $("#fecha_salida").val();
                            var id_agencia = $("#id_agency").val();

//                            $("#pricexadult").val(0);
//                            $("#pricexchild").val(0);
//                            $("#pricexadult1").val(0);
//                            $("#pricexchild1").val(0);
//                            $("#pricexadult2").val(0);
//                            $("#pricexchild2").val(0);

                            document.getElementById("wdwus").checked = false;   
                            document.getElementById("wphol").checked = false; 
                            document.getElementById("kspc").checked = false;
                            document.getElementById('from').disabled = true;
                            document.getElementById('from').value = '0';
                            document.getElementById('from').style.background = '#CCC';
                            document.getElementById('to2').disabled = true;
                            document.getElementById('to2').value = '0';
                            document.getElementById('to2').style.background = '#CCC';
        //                    document.getElementById('to2').disabled = "false";
                            document.getElementById('a_pickup1').value = '';
                            document.getElementById('d_pickup1').value = '';

                            $("#totalreserve").val(0);
                            $("#totalreserver").val(0);

                            $("#price_transport1pp").html("$" + "0.00");
                            $("#price_transport2pp").html("$" + "0.00");

                            $("#totalAmount").val("0.00");
                            $("#saldoporpagar").html("0.00");

                            $("#saldoactual").val("0.00");

                            //document.getElementById("categoria_park").value = "4";
                            document.getElementById("park_name").disabled = false;
                            document.getElementById('park_name').style.background = '#FFFFFF';
                            document.getElementById("park_name").value = "";
                            $('#delete_park').click();
                            $("#adm_selector").attr("checked", false);           
                            $("#park_admision").html('$ 0.00');
                            
                            //$("#total_parks").val(parseFloat($("#trpark").val()) + parseFloat($("#admpark").val()));
                            $("#price_transport1pp").html("$" + "0.00");
                            $("#price_transport2pp").html("$" + "0.00");
 
                            calcularTotalPago();
                            //$("#saldoactual").val("0.00");
                            //$("#totalAmount").val("0.00");
                            //$("#paid_driver").val("0.00");
                            //$("#balance_due").val("0.00");
                            //$("#pay_amount").val("0.00");
                            //$("#agency_balance_due").val("0.00"); 

                            $("#adult").focus();
                            $("#from").val(0);
                            $("#to2").val(0);    

        //                    $("#schedule1").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/1/' + $("#from").val() + '/' + $("#fecha_salida").val() + '/' + $("#adult").val() + '/' + $("#child").val()));
        //                    $("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#to2").val() + '/' + $("#fecha_retorno").val() + '/' + $("#adult").val() + '/' + $("#child").val()));

                            document.getElementById('trp301').style.display = 'none';
                            document.getElementById('trp300').style.display = 'none';
                            
                            $("#adult").focus();

                            }


                    });



                                $("#kspc").click(function () {

                                    if ($("#kspc").is(':checked')) {


                                        document.getElementById("from").value = document.getElementById('fromt').value;
                                        document.getElementById("to2").value = document.getElementById('tot2').value;

                                        document.getElementById("a_pickup1").value = document.getElementById('pickup').value;
                                        document.getElementById("d_pickup1").value = document.getElementById('dropoff').value;

                                        setTimeout(function () {


                                            var precio5 = '<?php echo $price_adult_KENNEDYSPC; ?>';
                                            var precio6 = '<?php echo $price_child_KENNEDYSPC; ?>';

                                            var adult = $("#adult").val();
                                            var child = $("#child").val();

                                            document.getElementById("adult").disabled = '';
                                            document.getElementById("child").disabled = '';

                                            document.getElementById("priceadults").value = precio5;
                                            document.getElementById("pricechilds").value = precio6;


                                            var tres = ((parseFloat($("#priceadults").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricechilds").val()) * parseFloat($("#child").val())) / 2).toFixed(2);
                                            

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
                                        //$("#uagency").attr('disabled', true);
                                        $('#uagency').val('');
                                        $('#id_auser').val('');
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


                                if (z == 1) {



                                    var precio1 = '<?php echo $price_adult_wdw; ?>';


                                    var precio2 = '<?php echo $price_child_wdw; ?>';



                                    var adult = $("#adult").val();
                                    var child = $("#child").val();
                                    var grupo_parque = document.getElementById("group_park").value;


                                    document.getElementById("price_transport1pp").innerHTML = (((precio1 * adult) + (precio2 * child)) / 2).toFixed(2);
                                    document.getElementById("price_transport2pp").innerHTML = (((precio1 * adult) + (precio2 * child)) / 2).toFixed(2);


                                    document.getElementById("priceadults").value = precio1;
                                    document.getElementById("pricechilds").value = precio2;

                                    setTimeout(function () {

                                        $('#from').change();
                                        $('#to2').change();
                                        document.getElementById('save2').style.display = "none";
                                        document.getElementById('save3').style.display = "none";

                                        document.getElementById('a_pickup1').value = "<?php echo $pickup1; ?>";
                                        document.getElementById('d_pickup1').value = "<?php echo $dropoff1; ?>";
                                        document.getElementById('a_id_pickup1').value = "<?php echo $a_id_pickup1; ?>";
                                        document.getElementById('d_id_pickup1').value = "<?php echo $d_id_pickup1; ?>";
                                        document.getElementById('from').value = "<?php echo $fromt; ?>";
                                        document.getElementById('to2').value = "<?php echo $tot2; ?>";
                                        document.getElementById("categoria_park").value = "4";
                                        document.getElementById("park_name").value = "";

                                        if (grupo_parque != 1) {
                                            $('#delete_park').click();
                                        }

                                    }, 100);

                                }

                                if (z == 2) {


                                    var precio3 = '<?php echo $price_adult_WATERP; ?>';
                                    var precio4 = '<?php echo $price_child_WATERP; ?>';

                                    var adult = $("#adult").val();
                                    var child = $("#child").val();
                                    var grupo_parque = document.getElementById("group_park").value;


                                    document.getElementById("price_transport1pp").innerHTML = (((precio3 * adult) + (precio4 * child)) / 2).toFixed(2);
                                    document.getElementById("price_transport2pp").innerHTML = (((precio3 * adult) + (precio4 * child)) / 2).toFixed(2);

                                    document.getElementById("priceadults").value = precio3;
                                    document.getElementById("pricechilds").value = precio4;


                                    setTimeout(function () {

                                        $('#from').change();
                                        $('#to2').change();
                                        document.getElementById('save2').style.display = "none";
                                        document.getElementById('save3').style.display = "none";
                                        document.getElementById('a_pickup1').value = "<?php echo $pickup1; ?>";
                                        document.getElementById('d_pickup1').value = "<?php echo $dropoff1; ?>";
                                        document.getElementById('a_id_pickup1').value = "<?php echo $a_id_pickup1; ?>";
                                        document.getElementById('d_id_pickup1').value = "<?php echo $d_id_pickup1; ?>";
                                        document.getElementById('from').value = "<?php echo $fromt; ?>";
                                        document.getElementById('to2').value = "<?php echo $tot2; ?>";
                                        document.getElementById("categoria_park").value = "7";
                                        document.getElementById("park_name").value = "";

                                        if (grupo_parque != 2) {
                                            $('#delete_park').click();
                                        }



                                    }, 100);

                                }

                                if (z == 3) {


                                    var precio5 = '<?php echo $price_adult_KENNEDYSPC; ?>';
                                    var precio6 = '<?php echo $price_child_KENNEDYSPC; ?>';


                                    var adult = $("#adult").val();
                                    var child = $("#child").val();
                                    var grupo_parque = document.getElementById("group_park").value;

                                    document.getElementById("price_transport1pp").innerHTML = (((precio5 * adult) + (precio6 * child)) / 2).toFixed(2);
                                    document.getElementById("price_transport2pp").innerHTML = (((precio5 * adult) + (precio6 * child)) / 2).toFixed(2);

                                    document.getElementById("priceadults").value = precio5;
                                    document.getElementById("pricechilds").value = precio6;


                                    setTimeout(function () {

                                        $('#from').change();
                                        $('#to2').change();
                                        document.getElementById('save2').style.display = "none";
                                        document.getElementById('save3').style.display = "none";
                                        document.getElementById('a_pickup1').value = "<?php echo $pickup1; ?>";
                                        document.getElementById('d_pickup1').value = "<?php echo $dropoff1; ?>";
                                        document.getElementById('a_id_pickup1').value = "<?php echo $a_id_pickup1; ?>";
                                        document.getElementById('d_id_pickup1').value = "<?php echo $d_id_pickup1; ?>";
                                        document.getElementById('from').value = "<?php echo $fromt; ?>";
                                        document.getElementById('to2').value = "<?php echo $tot2; ?>";
                                        document.getElementById("categoria_park").value = "11";
                                        document.getElementById("park_name").value = "";

                                        if (grupo_parque != 3) {
                                            $('#delete_park').click();
                                        }




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

                                if (window.screen.availWidth > 1680) {
                                    window.parent.document.body.style.zoom = "125%";

                                }
                                
                            }

                        </script>

                        <script type="text/javascript">
                            function validate(evt) {
                                var theEvent = evt || window.event;
                                var key = theEvent.keyCode || theEvent.which;
                                key = String.fromCharCode(key);
                                var regex = /[0-9]|\.|\-/;
                                if (!regex.test(key)) {
                                    theEvent.returnValue = false;
                                    if (theEvent.preventDefault)
                                        theEvent.preventDefault();
                                }
                            }
                        </script>


                        <script type="text/javascript">

                            function resetextra()
                            {

                                var extra_cargo = document.getElementById('extra').value;


                                if (extra_cargo == "") {

                                    document.getElementById('extra').value = '0.00';
                                    
                                    calcularTotalPago();

                                    $("#extra").focus();

                                }

                                if (extra_cargo == "0") {

                                    document.getElementById('extra').value = "0.00";
                                    
                                    calcularTotalPago();

                                    $("#extra").focus();

                                }
                                
                                if (extra_cargo > "0") {

                                    setTimeout(function () {

                                        calcularTotalPago();               

                                     }, 0.01);   

                                    $("#extra").focus();

                                }


                            }

                        </script>

<script type="text/javascript">
    
                function fecha_transfer_out()
                {

                    var opcone = $("#estado_transfer_out").val();

                    //CONFIRMED
                    if(opcone == '1'){

                        document.getElementById('estado_transfer_out').value = "1";
                        document.getElementById('estado_trf_out').value = "1";
                        document.getElementById('fec_retor').value = document.getElementById('fecha_retorno').value;
                        
                        document.getElementById('estado_transfer_out').style.background = "#98FB98"; 
                        document.getElementById('estado_transfer_out').style.color = "#000";
                        document.getElementById('estado_transfer_out').style.border = "2px solid #FFFFFF";
                        
                        fechale2();
                        


                    //CANCELED
                    }else if(opcone == '2'){

                        document.getElementById('estado_transfer_out').value = "2";

                        document.getElementById('fec_retor').value = "CANC";
                        document.getElementById('estado_trf_out').value = "2";
                        document.getElementById('estado_transfer_out').style.background = "#DC143C";  
                        document.getElementById('estado_transfer_out').style.color = "#FFFFFF";
                        document.getElementById('estado_transfer_out').style.border = "2px solid #FFFFFF";

                        

                    //NO SHOW
                    }else if(opcone == '3'){

                        document.getElementById('estado_transfer_out').value = "3";
                        document.getElementById('estado_trf_out').value = "3";

                        document.getElementById('fec_retor').value = "N/S";
                        
                        document.getElementById('estado_transfer_out').style.background = "#00BFFF";  
                        document.getElementById('estado_transfer_out').style.color = "#000";
                        document.getElementById('estado_transfer_out').style.border = "2px solid #FFFFFF";

                       
              
                    } else{

                       

                    document.getElementById('fecha_retorno').value = "<?php
                    
                    if ($reserva->fecha_retorno == 'N/A') {
                        echo 'N/S';
                    }else if($reserva->fecha_retorno == 'C'){
                        echo 'CANC';
                    }else {
                        if (isset($reserva)) {
                            echo ($reserva->fecha_retorno == "0000-00-00" ? "00-00-0000" : date('m-d-Y', strtotime($reserva->fecha_retorno)));
                        }
                    }
                    ?>"

                    }


                }

            </script>
            
            <script type="text/javascript">                
                
                function fechale2()
                {

                    var fecha2 = document.getElementById('fecha_salida').value;                    
                    var d = new Date(fecha2); 
                    var dia = ("0" + (d.getDate())).slice(-2);                                               
                    var mes = ("0" + (d.getMonth() + 1)).slice(-2);                                                               
                    var yyy = d.getFullYear();
                    var fechita = yyy + '-' + mes + '-' + dia;

                    $("#fec_retor").val(fechita);              
                   
                }
            </script>
            
            <script type="text/javascript">

                function estado_trf_out()
                {

                    //var est_trf_out = document.getElementById('estado_trf_out').value;
                    var est_trf_out = "<?php echo $estado_transf_out; ?>";
                    
                    document.getElementById('estado_transfer_out').value = est_trf_out;  

                    //CONFIRMED
                    if(est_trf_out == 1){

                       document.getElementById('estado_transfer_out').style.background = "#98FB98"; 
                       document.getElementById('estado_transfer_out').style.color = "#000";
                       document.getElementById('estado_transfer_out').style.border = "2px solid #FFFFFF";

                    //CANCELED
                    }else if(est_trf_out == 2){

                       document.getElementById('estado_transfer_out').style.background = "#DC143C";  
                       document.getElementById('estado_transfer_out').style.color = "#FFFFFF";
                       document.getElementById('estado_transfer_out').style.border = "2px solid #FFFFFF";

                    //NO SHOW
                    }else if(est_trf_out == 3){

                       document.getElementById('estado_transfer_out').style.background = "#00BFFF";  
                       document.getElementById('estado_transfer_out').style.color = "#000";
                       document.getElementById('estado_transfer_out').style.border = "2px solid #FFFFFF";

                    }



                }
            </script>

<script type="text/javascript">
    
    function cancelar(){/*PAGOS PREPAGADOS*/


       var pago_driver = parseFloat($("#pago_driver").val());
//       var pago_driver = document.getElementById("pago_driver").value;
       
       var temp_prepaid = parseFloat($("#temp_prepaid").val());       
       var prepaid = parseFloat($("#prepaid").val());  
       
       if (pago_driver % 1 == 0) { /*valor entero*/
           
            var result2 = parseFloat(prepaid) - parseFloat(pago_driver);  

            //$("#temp_driver").val((result).toFixed(2));
            $("#prepaid").val((result2).toFixed(2));
        

       } else { /*valor decimal*/
                                    
           var temp_prepaid = parseFloat($("#temp_prepaid").val());             
           var prepaid = parseFloat($("#prepaid").val());  
           var parte_entera = (parseFloat(pago_driver))/1.04;           
           var cargo = (parseFloat(pago_driver) - parseFloat(parte_entera)).toFixed(2);       
           var result = parseFloat(temp_prepaid) - parseFloat(cargo);             
           var result2 = prepaid - pago_driver;

           $("#temp_prepaid").val((result).toFixed(2));
           $("#prepaid").val((result2).toFixed(2));
       
        }
       
       var no_prep =  document.getElementById("no_prep").value;
       var no_pago =  document.getElementById("no_pago").value;
                
                if(no_prep == 1){
                    document.getElementById("no_prep").value = 0;
                    document.getElementById('pago_pre1').value = '0';
                    document.getElementById('pagopre1').value = '';
                    document.getElementById('tipo_pagopre1').value = '';
                    document.getElementById('pagadopre1').value = '0.00';                    
                    
                }else if(no_prep == 2){
                    document.getElementById("no_prep").value = 1;
                    document.getElementById('pago_pre2').value = '0';
                    document.getElementById('pagopre2').value = '';
                    document.getElementById('tipo_pagopre2').value = '';
                    document.getElementById('pagadopre2').value = '0.00';     
                    
                }else if(no_prep == 3){
                    document.getElementById("no_prep").value = 2;
                    document.getElementById('pago_pre3').value = '0';
                    document.getElementById('pagopre3').value = '';
                    document.getElementById('tipo_pagopre3').value = '';
                    document.getElementById('pagadopre3').value = '0.00';     
                    
                }else if(no_prep == 4){
                    document.getElementById("no_prep").value = 3;
                    document.getElementById('pago_pre4').value = '0';
                    document.getElementById('pagopre4').value = '';
                    document.getElementById('tipo_pagopre4').value = '';
                    document.getElementById('pagadopre4').value = '0.00';     
                    
                }else if(no_prep == 5){
                    document.getElementById("no_prep").value = 4;
                    document.getElementById('pago_pre5').value = '0';
                    document.getElementById('pagopre5').value = '';
                    document.getElementById('tipo_pagopre5').value = '';
                    document.getElementById('pagadopre5').value = '0.00';     
                    
                }else if(no_prep == 6){
                    document.getElementById("no_prep").value = 5;
                    document.getElementById('pago_pre6').value = '0';
                    document.getElementById('pagopre6').value = '';
                    document.getElementById('tipo_pagopre6').value = '';
                    document.getElementById('pagadopre6').value = '0.00';     
                    
                }else if(no_prep == 7){
                    document.getElementById("no_prep").value = 6;
                    document.getElementById('pago_pre7').value = '0';
                    document.getElementById('pagopre7').value = '';
                    document.getElementById('tipo_pagopre7').value = '';
                    document.getElementById('pagadopre7').value = '0.00';     
                    
                }else if(no_prep == 8){
                    document.getElementById("no_prep").value = 7;
                    document.getElementById('pago_pre8').value = '0';
                    document.getElementById('pagopre8').value = '';
                    document.getElementById('tipo_pagopre8').value = '';
                    document.getElementById('pagadopre8').value = '0.00';     
                    
                }else if(no_prep == 9){
                    document.getElementById("no_prep").value = 8;
                    document.getElementById('pago_pre9').value = '0';
                    document.getElementById('pagopre9').value = '';
                    document.getElementById('tipo_pagopre9').value = '';
                    document.getElementById('pagadopre9').value = '0.00';     
                    
                }else if(no_prep == 10){
                    document.getElementById("no_prep").value = 9;
                    document.getElementById('pago_pre10').value = '0';
                    document.getElementById('pagopre10').value = '';
                    document.getElementById('tipo_pagopre10').value = '';
                    document.getElementById('pagadopre10').value = '0.00';     
                    
                }
                
                if(no_pago == 1){
                    document.getElementById("no_pago").value = 0;
                    document.getElementById('pago_1').value = '0';
                    document.getElementById('pago1').value = '';
                    document.getElementById('tipo_pago1').value = '';
                    document.getElementById('pagado1').value = '0.00';                    

                }else if(no_pago == 2){
                    document.getElementById("no_pago").value = 1;
                    document.getElementById('pago_2').value = '0';
                    document.getElementById('pago2').value = '';
                    document.getElementById('tipo_pago2').value = '';
                    document.getElementById('pagado2').value = '0.00';     

                }else if(no_pago == 3){
                    document.getElementById("no_pago").value = 2;
                    document.getElementById('pago_3').value = '0';
                    document.getElementById('pago3').value = '';
                    document.getElementById('tipo_pago3').value = '';
                    document.getElementById('pagado3').value = '0.00';     

                }else if(no_pago == 4){
                    document.getElementById("no_pago").value = 3;
                    document.getElementById('pago_4').value = '0';
                    document.getElementById('pago4').value = '';
                    document.getElementById('tipo_pago4').value = '';
                    document.getElementById('pagado4').value = '0.00';     

                }else if(no_pago == 5){
                    document.getElementById("no_pago").value = 4;
                    document.getElementById('pago_5').value = '0';
                    document.getElementById('pago5').value = '';
                    document.getElementById('tipo_pago5').value = '';
                    document.getElementById('pagado5').value = '0.00';     

                }else if(no_pago == 6){
                    document.getElementById("no_pago").value = 5;
                    document.getElementById('pago_6').value = '0';
                    document.getElementById('pago6').value = '';
                    document.getElementById('tipo_pago6').value = '';
                    document.getElementById('pagado6').value = '0.00';     

                }else if(no_pago == 7){
                    document.getElementById("no_pago").value = 6;
                    document.getElementById('pago_7').value = '0';
                    document.getElementById('pago7').value = '';
                    document.getElementById('tipo_pago7').value = '';
                    document.getElementById('pagado7').value = '0.00';     

                }else if(no_pago == 8){
                    document.getElementById("no_pago").value = 7;
                    document.getElementById('pago_8').value = '0';
                    document.getElementById('pago8').value = '';
                    document.getElementById('tipo_pago8').value = '';
                    document.getElementById('pagado8').value = '0.00';     

                }else if(no_pago == 9){
                    document.getElementById("no_pago").value = 8;
                    document.getElementById('pago_9').value = '0';
                    document.getElementById('pago9').value = '';
                    document.getElementById('tipo_pago9').value = '';
                    document.getElementById('pagado9').value = '0.00';     

                }else if(no_pago == 10){
                    document.getElementById("no_pago").value = 9;
                    document.getElementById('pago_10').value = '0';
                    document.getElementById('pago10').value = '';
                    document.getElementById('tipo_pago10').value = '';
                    document.getElementById('pagado10').value = '0.00';     

                }
                
               

                
                
                
       //document.getElementById('prepaid').value = "0.00"; 
       //document.getElementById('temp_prepaid').value = "0.00"; 
       document.getElementById("pago_driver").disabled = false;
       document.getElementById('pago_driver').placeholder = "0.00"; 
       document.getElementById('pago_tarjeta').value = "0.00"; 
       document.getElementById("btnPagolinea").disabled = true;
       document.getElementById("btnPagolinea").style.display = "none";
       document.getElementById("btndecline").style.display = "none"; 
       document.getElementById("btnAceptar").disabled = true;
       document.getElementById("btnAceptar").style.background = "lightgray"; 
       
        //calcularTotalPago();
       
       $("#pago_driver").focus();
                
        //mostrarVentana2();
        abrirVentana2();

       
    
    }
    
</script>

<script type="text/javascript">
    
    function cancelar_collect_on_board(){
        
       
       var pago_driver = parseFloat($("#pago_driver").val());      
       var temp_driver = parseFloat($("#temp_driver").val());       
       var collect = parseFloat($("#collect").val());    
       
       if (pago_driver % 1 == 0) { /*valor entero*/           
                                   
            var result2 = parseFloat(collect) - parseFloat(pago_driver);          
            //$("#temp_driver").val((result).toFixed(2));
            $("#collect").val((result2).toFixed(2));
        

       } else { /*valor decimal*/         
                   
           var parte_entera = parseFloat(pago_driver)/1.04;           
             
           var cargo = (parseFloat(pago_driver) - parseFloat(parte_entera)).toFixed(2);           
           var result = parseFloat(temp_driver) - parseFloat(cargo);  
           var result2 = collect - pago_driver;

           $("#temp_driver").val((result).toFixed(2));
           $("#collect").val((result2).toFixed(2));
       
        }
       
       
       var no_pago =  document.getElementById("no_pago").value;
                
                if(no_pago == 1){
                    document.getElementById("no_pago").value = 0;
                    document.getElementById('pago_1').value = '0';
                    document.getElementById('pago1').value = '';
                    document.getElementById('tipo_pago1').value = '';
                    document.getElementById('pagado1').value = '0.00';                    
                    
                }else if(no_pago == 2){
                    document.getElementById("no_pago").value = 1;
                    document.getElementById('pago_2').value = '0';
                    document.getElementById('pago2').value = '';
                    document.getElementById('tipo_pago2').value = '';
                    document.getElementById('pagado2').value = '0.00';     
                    
                }else if(no_pago == 3){
                    document.getElementById("no_pago").value = 2;
                    document.getElementById('pago_3').value = '0';
                    document.getElementById('pago3').value = '';
                    document.getElementById('tipo_pago3').value = '';
                    document.getElementById('pagado3').value = '0.00';     
                    
                }else if(no_pago == 4){
                    document.getElementById("no_pago").value = 3;
                    document.getElementById('pago_4').value = '0';
                    document.getElementById('pago4').value = '';
                    document.getElementById('tipo_pago4').value = '';
                    document.getElementById('pagado4').value = '0.00';     
                    
                }else if(no_pago == 5){
                    document.getElementById("no_pago").value = 4;
                    document.getElementById('pago_5').value = '0';
                    document.getElementById('pago5').value = '';
                    document.getElementById('tipo_pago5').value = '';
                    document.getElementById('pagado5').value = '0.00';     
                    
                }else if(no_pago == 6){
                    document.getElementById("no_pago").value = 5;
                    document.getElementById('pago_6').value = '0';
                    document.getElementById('pago6').value = '';
                    document.getElementById('tipo_pago6').value = '';
                    document.getElementById('pagado6').value = '0.00';     
                    
                }else if(no_pago == 7){
                    document.getElementById("no_pago").value = 6;
                    document.getElementById('pago_7').value = '0';
                    document.getElementById('pago7').value = '';
                    document.getElementById('tipo_pago7').value = '';
                    document.getElementById('pagado7').value = '0.00';     
                    
                }else if(no_pago == 8){
                    document.getElementById("no_pago").value = 7;
                    document.getElementById('pago_8').value = '0';
                    document.getElementById('pago8').value = '';
                    document.getElementById('tipo_pago8').value = '';
                    document.getElementById('pagado8').value = '0.00';     
                    
                }else if(no_pago == 9){
                    document.getElementById("no_pago").value = 8;
                    document.getElementById('pago_9').value = '0';
                    document.getElementById('pago9').value = '';
                    document.getElementById('tipo_pago9').value = '';
                    document.getElementById('pagado9').value = '0.00';     
                    
                }else if(no_pago == 10){
                    document.getElementById("no_pago").value = 9;
                    document.getElementById('pago_10').value = '0';
                    document.getElementById('pago10').value = '';
                    document.getElementById('tipo_pago10').value = '';
                    document.getElementById('pagado10').value = '0.00';     
                    
                }
                
       //document.getElementById('prepaid').value = "0.00"; 
       //document.getElementById('temp_prepaid').value = "0.00"; 
       document.getElementById("pago_driver").disabled = false;
       document.getElementById('pago_driver').placeholder = "0.00";        
       document.getElementById("btnPagolinea").disabled = true;
       document.getElementById("btnPagolinea").style.display = "none";
       document.getElementById("btndecline").style.display = "none"; 
       document.getElementById("btncancol").style.display = "none"; 
       document.getElementById("btnAceptar").disabled = true;
       document.getElementById("btnAceptar").style.background = "lightgray";  
       $("#pago_driver").focus();
                
        //mostrarVentana2();
        abrirVentana2();

       
    
    }
    
</script>
    
<script type="text/javascript">
    
    function valida_clase(){
        
        
        $('#paid_driver').click();
       
    
    }
    
    </script>
    
    
    <script type="text/javascript">
    
    function valida_clase2(){
        
               
        $('#pay_amount').click();
            
    
    }
    
    </script>
    
    <script type="text/javascript">
    
    function valida_pago(obj,abc){
    
    //valida la clase activa en el pago al conductor
    //alert($(obj).attr('class'));
    
    //alert($(obj).attr('class'));
    
        if($(obj).attr('class')=="flashit"){
//            alert("Hay un Pago pendiente Por Guardar");
//            Exit();

        }
        
    
    }
    
    </script>
    
    <script type="text/javascript">
    
    //valida la clase activa en el pago prepagado
    function valida_pago2(obj,def){
        
    //alert($(obj).attr('class'));
    
        if($(obj).attr('class')=="flashit2"){
//            alert("Hay un Pago pendiente Por Guardar");
//            Exit();
        }    
    
    
    }
    
    </script>




                        <script type="text/javascript">

                            function desval()
                            {


                                var dcval = document.getElementById('descuento_valor').value;

                                if (dcval == "") {

                                    document.getElementById('descuento_valor').value = "0.00";
                                    calcularTotalPago();
                                    $("#descuento_valor").focus();
                                }



                                if (dcval == "0") {

                                    document.getElementById('descuento_valor').value = "0.00";
                                    calcularTotalPago();
                                    $("#descuento_valor").focus();

                                }
                                
                                if (dcval > "0") {                           

                                  setTimeout(function () {            

                                    calcularTotalPago();

                                  }, 0.01);                          

                                  $("#descuento_valor").focus();

                                }  


                            }
                        </script>

                        <script type="text/javascript">

                            function desporc()
                            {


                                var dcporc = document.getElementById('descuento').value;

                                if (dcporc == "") {

                                    document.getElementById('descuento').value = "0";
                                    calcularTotalPago();
                                    $("#descuento").focus();
                                }



                                if (dcporc == "0") {

                                    document.getElementById('descuento').value = "0";
                                    calcularTotalPago();
                                    $("#descuento_valor").focus();
                                }
                                
                                if (dcporc > "0") {
                            
                                setTimeout(function () {

                                    calcularTotalPago();

                                }, 0.01);

                                $("#descuento").focus();

                                }



                            }
                        </script>

                        <script type="text/javascript">
                            function reseteo()
                            {
                                document.getElementById('otheramount').value = '0.00';
                                document.getElementById('balance_due').value = '0.00';
//                                div = document.getElementById('menu-bar');
                            }
                        </script>

                        <script type="text/javascript">
                            function pago_conductor()
                            {
                                document.getElementById('otheramount').value = '0.00';
                                document.getElementById('balance_due').value = '0.00';
//                                div = document.getElementById('menu-bar');
                            }
                        </script>


                        <script type="text/javascript">
                            function bal_due()
                            {

                                var priceadults = $("#priceadults").val();

                                var pricechilds = $("#pricechilds").val();

                                var paid_driver = $("#paid_driver").val();

                                var saldoactual = $("#saldoctual").val();

                                var balance_due = $("#balance_due").val();

                                var totalamount = $("#totalAmount").val();

                                var tot_amount_paid = $("#tot_amount_paid").val();

                                var pay_amount = $("#pay_amount").val();

                                var temp = parseFloat($("#temp").val());

                                var prep = parseFloat($("#pred_paid_amountt").val());

                                var coll = parseFloat($("#paid_drivert").val());

                                var tap = parseFloat($("#tot_amount_paid").val());

                                var pagado = <?php echo $pagado; ?>;


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

                                    //artificio para enviar el valor de paid_driver, pay_amount y tot_amount_paid  por POST ya que paid_driver, pay_amount y tot_amount_paid reciben valores de la tabla tours_oneday de la bd
                                    document.getElementById('paid_driverp').value = paid_driver;
                                    document.getElementById('pay_amountp').value = pay_amount;
                                    document.getElementById('tot_amount_paidp').value = tot_amount_paid;

//
//                                    alert(total_total-fee);
//                                    exit;

//                                paid_driver='0.00';
                                    var salact = (total_total - fee);
//                                alert(salact);
//                                exit;

                                    $("#saldoactual").val((salact).toFixed(2));
//
                                    $("#balance_due").val(Math.abs(((total_total) - pay_amount) - paid_driver).toFixed(2));
//
                                    $("#totalAmount").val((total_total + temp - fee).toFixed(2));
//
//                                $("#tot_amount_paid").val((tot_amount_paid).toFixed(2));
//
//                                $("#agency_balance_due").val(((total_total + temp) - (tap)).toFixed(2));


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
                                //        alert(total_initial);
                                //        exit;

                                $("#total_first").val(total_initial);
                                $("#total_total").val(total_total);
                                //$("#saldoporpagar").val((total_initial).toFixed(2));
                                //document.getElementById('saldoporpagar').value = total_initial;
                                //$("#totalAmount").html('$ ' + total_initial.toFixed(2));
                                //$("#totalAmount").val((total_initial).toFixed(2));

                                var saldoac = total_total - pay_amount;

                                if ($("input[name='opcion_saldo']:checked").val() == "1") {
                                    //$("#saldoporpagar").html("$ " + parseFloat($("#total_total").val()).toFixed(2));
                                    $("#saldoactual").val(parseFloat($("#total_total").val()).toFixed(2));

                                } else {
                                    //$("#saldoporpagar").html("$ " + (parseFloat($("#total_total").val()) - parseFloat($("#rastrocom").val())).toFixed(2));
                                    $("#saldoactual").val((parseFloat($("#total_total").val()) - parseFloat($("#rastrocom").val())).toFixed(2));


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
                                    //$("#saldoactual").html('$0.00');
                                    $("#saldoactual").val('0.00');
                                } else {
                                    //$("#saldoactual").html('$' + (diff).toFixed(2));
                                    $("#saldoactual").val((diff).toFixed(2));
                                }



                            }
                        </script>

<script type="text/javascript">
    function agen_bal_due()
    {


        var tnk2 = parseFloat($("#totalAmount").text());
        var tap2 = parseFloat($("#tot_amount_paid").val());


//                                var a_b_d = (parseFloat(tnk2) - parseFloat(tap2)).toFixed(2);

        var a_b_d = tnk2 - tap2;

        //document.getElementById('agency_balance_due').value = a_b_d;

        document.getElementById('agency_balance_due').value = '0.00';


        //$("#agency_balance_due").val(((a_b_d)).toFixed(2));                


    }
</script>


<script type="text/javascript">
    
    function calc_other()

    {

        var duplic3 = document.getElementById('otheramount').value;

        var totalcargo3 = document.getElementById('tot_charge').value;

        var etb = parseFloat(totalcargo3);

        var etb2 = parseFloat(duplic3);

        var toti3 = parseFloat(etb2 + etb);

        $("#etb").val((toti3).toFixed(2));


        var sp = toti3.toFixed(2);


        document.getElementById('saldoactual').value = sp;

        bal_due();

    }
                            
                            
    </script>
                        
    <script type="text/javascript">

    function passenger_balance()
    {

        //$('op_pago_conductor option[value="<?php /*echo $op_pago_conductor;*/ ?>"]').attr("selected", true);
        
        //credit card with fee
        if (rup == 3) {  
            
                        
            document.getElementById('op_pago_conductor').value = "3"; 
            document.getElementById('op_pago_id').value = "3";
            
            setTimeout(function () {

                
                var balance = parseFloat($("#balance_due").val());
                var porcbal = balance*0.04;
                var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                $("#balance_due").val((tot_balance).toFixed(2));


            }, 0.01);

        //credit card no fee
        }else if (rup == 8) {              
                          
             document.getElementById('op_pago_conductor').value = "8";
             document.getElementById('op_pago_id').value = "8";
             calcularTotalPago()
             
        //cash
        }else if (rup == 4) {      
           
            document.getElementById('op_pago_conductor').value = "4";
            document.getElementById('op_pago_id').value = "4";
            calcularTotalPago()  
            
        //check
        }else if (rup == 9) {                        
            
            
            document.getElementById('op_pago_conductor').value = "9";
            document.getElementById('op_pago_id').value = "9";
            calcularTotalPago()
            
        //credit voucher
        }else if (rup == 5) {                        
            
           
            document.getElementById('op_pago_conductor').value = "5";
            document.getElementById('op_pago_id').value = "5";
            
            setTimeout(function () {
                
                var cv = 0;
                $("#saldoactual").val((cv).toFixed(2));
                $("#paid_driver").val((cv).toFixed(2));
                $("#balance_due").val((cv).toFixed(2));
                
            }, 0.01);
            
        //paid   
        }else if (rup == 6) {                        
            
           
            document.getElementById('op_pago_conductor').value = "6";
            document.getElementById('op_pago_id').value = "6";
            
            setTimeout(function () {
                
                var cv = 0;
                $("#saldoactual").val((cv).toFixed(2));
                $("#paid_driver").val((cv).toFixed(2));
                $("#balance_due").val((cv).toFixed(2));
                $("#otheramount").val((cv).toFixed(2));
                $("#otheramountp").val((cv).toFixed(2));
                
            }, 0.01);
            
           
        }
        
        
        
  //complementary       
//    else if (rup == 7) {
//            
//            document.getElementById('op_pago_conductor').value = "7";
//            
//            setTimeout(function () {
//                
//                var cv = 0;
//                $("#saldoactual").val((cv).toFixed(2));
//                $("#paid_driver").val((cv).toFixed(2));
//                $("#balance_due").val((cv).toFixed(2));
//                $("#totalAmount").val((cv).toFixed(2));
//                //$("#totaltotal").text((cv).toFixed(2));
//                $("#pay_amount").val((cv).toFixed(2));
//                $("#tot_amount_paid").val((cv).toFixed(2));
//                $("#agency_balance_due").val((cv).toFixed(2));
//                $("#otheramount").val((cv).toFixed(2));
//                
//            }, 0.01);    
//            
//        }

    }

</script>

                        
        
        <script type="text/javascript">

            var rup

            function captura()
            {

                var result = document.getElementsByName("op_pago_conductor")[0].value;

                rup = document.getElementById("result").innerHTML = " \ " + result;      
                
                $("#selectcond").val(result);



            }
        </script>

<script type="text/javascript">


            function selector()
            {

                var pc = "<?php echo $op_pago_conductor; ?>";

                if(pc == 8){        
                    document.getElementById("op_pago_conductor").selectedIndex = 0;
                }else if(pc == 3){
                    document.getElementById("op_pago_conductor").selectedIndex = 1; 
                }else if(pc == 4){
                    document.getElementById("op_pago_conductor").selectedIndex = 2; 
                }else if(pc == 9){
                    document.getElementById("op_pago_conductor").selectedIndex = 3;
                }else if(pc == 5){
                    document.getElementById("op_pago_conductor").selectedIndex = 4;
                }else if(pc == 6){
                    document.getElementById("op_pago_conductor").selectedIndex = 5;
                }else if(pc == 7){
                    document.getElementById("op_pago_conductor").selectedIndex = 6;
                }


            }

</script>
        
        
<script type="text/javascript"> 
       function redondea(sVal, nDec){ 
           
        var n = parseFloat(sVal); 
        var s = ""; 
        
//        setTimeout(function () {
            if (!isNaN(n)){ 
             n = Math.round(n * Math.pow(10, nDec)) / Math.pow(10, nDec); 
             s = String(n); 
             s += (s.indexOf(".") == -1? ".": "") + String(Math.pow(10, nDec)).substr(1); 
             s = s.substr(0, s.indexOf(".") + nDec + 1); 
                } 
                return s; 
//          }, 2000);
        } 

       function ponDecimales(nDec){ 
          
        setTimeout(function () {
           
        //document.form1.pago_driver.value = redondea(document.form1.pago_driver.value, nDec); 
        document.form1.descuento_valor.value = redondea(document.form1.descuento_valor.value, nDec); 
        document.form1.extra.value = redondea(document.form1.extra.value, nDec);
        document.form1.saldoactual.value = redondea(document.form1.saldoactual.value, nDec); 
//        document.formula.balance_due.value = redondea(document.formula.balance_due.value, nDec); 
        
         }, 1000);
       
       } 
    </script> 
    
    <script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function soloNumeros(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;
 
        // capturamos el contenido del input
        var valor=document.getElementById("saldoactual").value;
        
        // 45 = tecla simbolo menos (-)
        // Si el usuario pulsa la tecla menos, y no se ha pulsado anteriormente
        // Modificamos el contenido del mismo añadiendo el simbolo menos al
        // inicio
//        if(teclaPulsada==45 && valor.indexOf("-")==-1)
//        {
//            document.getElementById("saldoactual").value="-"+valor;
//        }
 
        // 13 = tecla enter
        // 46 = tecla punto (.)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
        {
            return true;
        }
 
        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
</script>
    
<script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function solopagodriver(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;
 
        // capturamos el contenido del input
        
        var valor=document.getElementById("pago_driver").value;
        
        // 45 = tecla simbolo menos (-)
        // Si el usuario pulsa la tecla menos, y no se ha pulsado anteriormente
        // Modificamos el contenido del mismo añadiendo el simbolo menos al
        // inicio
//        if(teclaPulsada==45 && valor.indexOf("-")==-1)
//        {
//            document.getElementById("saldoactual").value="-"+valor;
//        }
 
        // 13 = tecla enter
        // 46 = tecla punto (.)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
        {
            return true;
        }
 
        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
</script>

<script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function solodescuento(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;
 
        // capturamos el contenido del input
        
        var valor=document.getElementById("descuento_valor").value;
        
        // 45 = tecla simbolo menos (-)
        // Si el usuario pulsa la tecla menos, y no se ha pulsado anteriormente
        // Modificamos el contenido del mismo añadiendo el simbolo menos al
        // inicio
//        if(teclaPulsada==45 && valor.indexOf("-")==-1)
//        {
//            document.getElementById("saldoactual").value="-"+valor;
//        }
 
        // 13 = tecla enter
        // 46 = tecla punto (.)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
        {
            return true;
        }
 
        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
</script>
    
<script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function descuentoporc(evt)
    {
//        function validate(evt) {
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /[0-9]/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault)
                    theEvent.preventDefault();
           }
    }
</script>
    
<script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function soloextra(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;
 
        // capturamos el contenido del input
        
        var valor=document.getElementById("extra").value;
        
        // 45 = tecla simbolo menos (-)
        // Si el usuario pulsa la tecla menos, y no se ha pulsado anteriormente
        // Modificamos el contenido del mismo añadiendo el simbolo menos al
        // inicio
//        if(teclaPulsada==45 && valor.indexOf("-")==-1)
//        {
//            document.getElementById("saldoactual").value="-"+valor;
//        }
 
        // 13 = tecla enter
        // 46 = tecla punto (.)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
        {
            return true;
        }
 
        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
</script>
    
<script type="text/javascript">
    
    function checkDecimals(fieldName, fieldValue) {

    decallowed = 2; // how many decimals are allowed?

    if (isNaN(fieldValue) || fieldValue == "") {
        alert("El número no es válido. Prueba de nuevo.");
        fieldName.select();
        fieldName.focus();
    }
    else {
    if (fieldValue.indexOf('.') == -1) fieldValue += ".";
    dectext = fieldValue.substring(fieldValue.indexOf('.')+1, fieldValue.length);

    if (dectext.length > decallowed)
    {
        alert ("Por favor, digita un número con " + decallowed + " números decimales.");
        fieldName.select();
        fieldName.focus();
          }
    else {
    alert ("Número validado satisfactoriamente.");
          }
       }
    }
    // End -->
</script>

<script type="text/javascript">
    
    function valida_voucher(){
        

                 
    var idagencia = document.getElementById('idagencia').value;
       
        if(idagencia == "1"){
           
           
           document.getElementById('op_pago_conductor')[4].disabled = false; 
           //document.getElementById('op_pago_conductor').options[5].disabled = true; 
           
       }else{
           
         
           document.getElementById('op_pago_conductor')[4].disabled = true; 
           
           
       }       
             
   

    }
    
</script> 

<script type="text/javascript">
    
    function facturado() {
        
        var estado = "<?php echo $estado_onetour; ?>";
        
        if (estado == 'INVOICED'){
            
            document.getElementById('invoice').style.display = "";
            document.getElementById('lbl_invoice').style.display = "";
            document.getElementById('lbl_creation').style.display = "";
            document.getElementById('facturas').style.background = "#F5F5F5";
            
            
        }else{
            
            document.getElementById('invoice').style.display = "none";
            document.getElementById('lbl_invoice').style.display = "none";
            document.getElementById('lbl_creation').style.display = "none";
            document.getElementById('facturas').style.background = "#FFFFFF";
        }

    
    }
    
</script>

<script type="text/javascript">
    function preguntaTrip2() {        
        
        $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/4");
   
    }
</script>

<script type="text/javascript">
    
    function fechatrip()
    {
        
        var fecha1 = document.getElementById('fecha_salida').value; 
        
        var d = new Date(fecha1); 
        var dia = ("0" + (d.getDate())).slice(-2);                                               
        var mes = ("0" + (d.getMonth() + 1)).slice(-2);                                                               
        var yyy = d.getFullYear();
        var fechita = yyy + '-' + mes + '-' + dia;

        $("#fecha_trip").val(fechita);   
//        alert(fechita);
       

    }
</script>

<script type="text/javascript">
    
    function sur_2015()
    {     
        var fecha_creacion = "<?php echo $fecha_crea; ?>";
        
         if(fecha_creacion < '2018-05-31 00:00:00'){       
            document.getElementById('sur2015').style.display = "";         
         }else{           
            document.getElementById('sur2015').style.display = "none";
         }       
        
        
    }

</script>

<script type="text/javascript">
    
    function abrirVentana2()
    {
        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
        ventana2.style.display = ''; // Y la hacemos visible

        document.getElementById("pago_driver").disabled = false;
        document.getElementById('pago_driver').value = '';
        document.getElementById('pago_driver').style.color = '#848484';
        document.getElementById('pago_driver').style.background = '#fff';
        $("#pago_driver").focus(); 

        document.getElementById('op_pago_id1').value = 0;
        //document.getElementById('op_pago_id').value = 8;
        document.getElementById('opcion_pago_2').value = 2;
        //document.getElementById('opcion_pago_3').value = 2;

        document.getElementById('btnAceptar').style.background = 'lightgray';
        document.getElementById('btnAceptar').style.background = '';
        document.getElementById('btnAceptar').style.color = '#000';
        document.getElementById('btnAceptar').style.cursor = '';

    }
    
</script>





