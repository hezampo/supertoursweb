

<?php 



include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "config/lang/".Doo::conf()->lang.".php"; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title>Panel Administrativo</title>

        <link href="<?php echo $data['rootUrl']; ?>global/css/panel.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo $data['rootUrl']; ?>global/js/menubar/css/menu.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo $data['rootUrl']; ?>global/css/toolbar.css" rel="stylesheet" type="text/css" />

       <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js"></script>

        <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/menubar/js/menu.js"></script>

        

        <script type="text/javascript">

            $(document).ready(function() {

                $.menu();

                

              

            });

        </script>

        

    </head>



    <body class="bg-gray">

        <div id="container">



            <div id=header>

                <div class="logo"></div>

                <div style="display:inline; float:right;">

                <a class="home img-link" href="<?php echo $data['rootUrl']; ?>" id="home">Home</a>

     <?php if(isset($_SESSION['user'])){ ?>          

      <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>close/session">Cerrar Session</a>

     <?php } ?>

   </div>

           <!--     <div id="hd-menu">

                   <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>admin/logout"><?php echo BTN_LOGOUT ?></a>

                </div> -->

                <br class="clear" />

       

                <?php

                $login = $_SESSION['login'];

                echo $login->menu;

                ?> 	

           </div>

         

            <div id="content">

               <?php include $data['content']; ?>

            </div>



            <div id="footer">

              Copyright &copy; 2012

            </div>

        </div>

    </body>

</html>

