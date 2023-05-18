<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "config/lang/".Doo::conf()->lang.".php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Supertours Of Orlando inc.</title>
        <link href="<?php echo $data['rootUrl']; ?>global/css/panel.css" rel="stylesheet" type="text/css" />
    </head>

    <body class="bg-gray">

        <div id="login2">
            <div id="hd-login">
                <div class="logo"></div>
                <br class="clear" />
                <div class="hd-login-bar">Admin Panel</div>
                <div class="hd-login-bar" style="background-color: #39C029;">Si no puedes  ingresar intenta con tu nombre y número de cedula.  </div>
            </div>

            <div id="bd-login">

                <?php if (isset($data['error'])) {
                ?>
                    <div class="error"><?php echo $data['error'] ?></div>
                <?php } ?>

                <form name="form1" action="<?php echo $data['rootUrl']; ?>admin/login" method="post">
                    <div id="user-info">

                        <p class="input">
                            <label style="width:150px">Username</label>
                            <input name="usuario" type="text" size="25" maxlength="10" class="inputText" id="usuario" />
                        </p>

                        <p class="input" style="margin-top:15px;">
                            <label style="width:150px">Password</label>
                            <input name="password" type="password" size="25" maxlength="15" class="inputText" id="password" />                       </p>

                    </div>

                    <br  class="clear"/>

                    <div class="button-bar center">
                        <button class="button"><span class="icon-login16">Login</span></button>
                    </div>

                </form>

            </div>

        </div>

    </body>
</html>
