<?php

// 
// session_start();
// echo '<pre>';
// print_r($_SESSION['servicios']);
// echo '</pre>';
// die;
if (isset($_SESSION['servicios'])) {
  $serviciosV = $_SESSION['servicios'];
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />
https://www.localhost/web/agency/admin/reservas/new/add
    <title>Gentelella Alela! | </title> -->

     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="<?php echo $data['rootUrl']?>global/images/background/icon.png" />
        <title><?php echo (isset($_SESSION['loginagency']->company_name)) ? $_SESSION['loginagency']->company_name : 'Agency' ;?></title>
        <link href="<?php echo $data['rootUrl']; ?>global/css/panel.css" rel="stylesheet" type="text/css" />
<!--        <link rel="stylesheet" type="text/css" href="<?php/* echo $data['rootUrl']; */?>global/css/blitzer/jquery-ui-1.8.23.custom.css" />-->
        <link href="<?php echo $data['rootUrl']; ?>global/css/jquery.multiselect.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $data['rootUrl']; ?>global/js/menubar/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $data['rootUrl']; ?>global/css/toolbar.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $data['rootUrl']; ?>global/css/prettify.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $data['rootUrl']; ?>global/css/jquery.Jcrop.css" type="text/css" rel="stylesheet">

        <!-- Estilos y importaciones de javascript-->

    <!-- Bootstrap -->
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

     <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/animate.css/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/build/css/custom.css" rel="stylesheet">

    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/intro.js/css/introjs.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Fullscreen/css/jquery.loadingModal.css"/>
    
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/slick/slick.css" rel="stylesheet">
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/slick/slick-theme.css" rel="stylesheet">

    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/ResponsiveSlides/responsiveslides.css" rel="stylesheet">
    <!-- BOOTSTRAp spin -->

    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <link href="<?php echo $data['rootUrl']; ?>global/css/estiloseric/out/jquery.bootstrap-touchspin.css" rel="stylesheet">
    <link href="<?php echo $data['rootUrl']; ?>global/css/estiloseric/out/sweetalert2.css" rel="stylesheet">
    <link href="<?php echo $data['rootUrl']; ?>global/css/estiloseric/out/lightpick.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/load/css/normalize.css">
    <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/load/css/main.css">
    <!--<link rel="stylesheet" href="//resources/demos/style.css">-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/panel.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/autocompletar/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>
<!--<link rel="stylesheet" type="text/css" href="<?php /*echo $data['rootUrl']; */?>global/css/web.css"/>-->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">



  </head>
  <?php
  // echo '<pre>';
  // print_r( $this->data['res']->codconf);
  // echo '</pre>';
  if (isset($this->data['res']->codconf) AND $this->data['res']->codconf != '') {
    $codconf = 'EDIT RESERVATION # '.$this->data['res']->codconf;
  }else{
      if (isset($_SESSION['reserva_edit']) and $_SESSION['reserva_edit'] != '') {
        $codconf = 'EDIT RESERVATION # '.$_SESSION['reserva_edit']->codconf;
      }else{
        $codconf = '';
      }
  }
  // die;
  // var_dump($data['content'] != 'configuracion/frm_reservas.php' AND $data['content'] != 'configuracion/frm_reservas_edit.php');
  // if ($data['content'] != 'configuracion/frm_reservas.php' AND $data['content'] != 'configuracion/frm_reservas_edit.php' ) {
  //   unset($_SESSION['reserva_edit']);
  //   unset($_SESSION['codconf']);
  // }
 $login = $_SESSION['loginagency'];
// if (isset($_SESSION['reserva_edit']) and $_SESSION['reserva_edit'] != '') {
//     $codconf = 'EDIT RESERVATION # '.$_SESSION['reserva_edit']->codconf;
// }elseif(isset($_SESSION['codconf']) and $_SESSION['codconf'] != ''){
//      //$codconf = 'RESERVATION # '.$_SESSION['codconf'];
//      $codconf = '';
// }else{
//     // $codconf = 'Wait For Reservation';
//     $codconf = '';
// }
// echo '<pre>';
//  print_r($_SESSION);
//  echo '</pre>';
// die;
?>
<style>
.profile_info {
    width: 100%;
}
.profile_info span {
    font-size: 14px;
}
</style>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
            <?php if(isset($_SESSION['loginagency']) AND $login->img != '') {?>
              <a href="#" class="site_title"><img src="<?php echo $data['rootUrl']; ?>global/logo_agency/<?php echo $login->img?>"></a>
              <?php }else{?>
                <a href="#" class="site_title"><img src="<?php echo $data['rootUrl']; ?>logo.png"></a>
                <?php }?>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <!-- <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div> -->
              <div class="profile_info">
                <h4>
                <p><span>Welcome, <?php echo $login->firstname." ". $login->lastname?></span></p>
                <p> <span><?php echo $login->company_name ?></span></p>
                </h4>


              </div>
            </div>
            <!-- /menu profile quick info -->

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Options</h3>
                <ul class="nav side-menu">

                <li><a href="<?php echo $data['rootUrl'] ?>admin/home"><i class="fa fa-home"></i> Home</a></li>
                <?php if(isset($_SESSION['loginagency'])) {?>
                  <!--  -->
                  <li class=""><a><i class="fa fa-plus"></i> New Reservation<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" >
                    <?php if($serviciosV->serv_transp == 1) {?>
                      <li><a href="<?php echo $data['rootUrl'] ?>admin/reservas/new/add"><i class="fa fa-bus"></i>Transportation</a></li>
                      <?php }?>
                      <?php if($serviciosV->serv_oneday == 1) {?>
                      <li><a href="<?php echo $data['rootUrl'] ?>admin/reservas/newone/add"><i class="fa fa-bus"></i> One Day Tour  <span class="label label-success pull-right">new</span></a></li>
                      <!-- <li><a href="<?php echo $data['rootUrl'] ?>admin/reservas/newmulti/add"><i class="fa fa-bus"></i> Multiday Tours <span class="label label-info pull-right">Coming Soon</span></a></li> -->
                      <!-- <li><a href="javascript:void(0)"><i class="fa fa-bus"></i> One Day Tour  <span class="label label-info pull-right">Coming Soon</span></a></li> -->
                      <?php }?>
                      <?php if($serviciosV->serv_multiday == 1) {?>
                      <li><a href="<?php echo $data['rootUrl'] ?>admin/reservas/newmulti/add"><i class="fa fa-bus"></i> Multiday Tours <span class="label label-success pull-right">new</span></a></li>
                      <?php }?>
                    </ul>
                  </li>
                  <!-- <li><a href="javascript:void(window.open('<?php echo $data['rootUrl'] ?>admin/reservas/new/add','RESERADD',''))"><i class="fa fa-plus"></i> New Reservation</a></li> -->
                  <?php //if(isset($_SESSION['loginagency']) AND $login->admon == 1) { ?>

                    <li class=""><a><i class="fa fa-search"></i>Find Reservation<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" >
                      <?php if($serviciosV->serv_transp == 1) {?>
                      <li><a href="<?php echo $data['rootUrl'] ?>admin/reservas"><i class="fa fa-search"></i>Transportation</a></li>
                      <?php }?>
                      <?php if($serviciosV->serv_oneday == 1) {?>
                      <li><a href="<?php echo $data['rootUrl'] ?>admin/onedaytour"><i class="fa fa-search"></i> One Day Tour  <span class="label label-success pull-right">new</span></a></li>
                      <?php }?>
                      <?php if($serviciosV->serv_multiday == 1) {?>
                      <li><a href="javascript:void(0)"><i class="fa fa-search"></i> Multiday Tours <span class="label label-success pull-right">new</span></a></li>
                      <?php }?>
                    </ul>
                  </li>

                  <!-- <li><a href="<?php echo $data['rootUrl'] ?>admin/reservas"><i class="fa fa-search"></i> Find Reservation</a></li> -->
                  <?php //} ?>


                <?php } ?>
                  <li><a href="<?php echo $data['rootUrl'] ?>admin/faq"><i class="fa fa-question"></i> Faq</a></li>
                  <li><a href="<?php echo $data['rootUrl'] ?>admin/contacto"><i class="fa fa-phone"></i> Contact Us</a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <!-- <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a> -->
              <a data-toggle="tooltip" data-placement="top" title="Return Home" href="<?php echo $data['rootUrl']; ?>../">
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
<style>
.senial{
  position: absolute;
    width: 8px;
    height: 8px;
    background: red;
    padding: 3px;
    z-index: 2;
    border-radius: 80px 0px 80px 80px;
    top: 23px;
    left: 118px;
    transform: rotate(130deg);
}
.senial2{
  position: absolute;
    width: 8px;
    height: 8px;
    background: red;
    padding: 3px;
    z-index: 2;
    border-radius: 80px 0px 80px 80px;
    top: 15px;
    left: 203px;
    transform: rotate(130deg);
}
</style>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                <?php if(isset($_SESSION['loginagency'])) {?>
                  <a href="javascript:void(0);" class="user-profile dropdown-toggle opciones" data-toggle="dropdown" aria-expanded="false">
                    <?php print_r($login->firstname) ?> <?php print_r($login->lastname) ?>
                    <!-- <div class="hola"></div>-->
                    <span class="fa fa-angle-down"></span> 
                    <!-- <span></span> -->
                  </a>

                  <ul class="dropdown-menu dropdown-usermenu pull-right ">
                    <!-- <li><a href="javascript:;"> Profile</a></li> -->
                    <?php if(isset($_SESSION['loginagency']) AND $login->admon == 1) {?>
                    <li class=""><a href="<?php echo $data['rootUrl']; ?>admin/setting_agency"><i class="fa fa-cog pull-right ">
                    </i>My Profile <i class='opciones2'><span></span></i></a></li>
                    <?php } ?>
                    <li><a href="<?php echo $data['rootUrl']; ?>admin/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
                  <?php }else{?>
                    <a href="<?php echo $data['rootUrl']; ?>admin/login_agency" class="dropdown-toggle info-number" >
                    Login 
                    <i class="fa fa-sign-in"></i>
                    <span class="badge bg-green"></span>
                    <!-- <i></i> -->
                  </a>
                    <?php }?>
                    <li style="background-color: #4b5f71 !important; height: 57px; padding: 19px 10px 1px 10px;" ><span href="javascript:void(0)"><b style="color: #fff;"><div id="mensajeTrip"  style="color: coral;font-size: 1.3em;"></div></b></span></li>

                    <li style="background-color: #4b5f71 !important; height: 57px; padding: 19px 10px 1px 10px;" ><div id="mensajeTrip"  style="color: coral;"></div><span href="javascript:void(0)"><b style="color: #fff;"><?php echo $codconf ?></b></span></li>

                <!-- <li role="presentation" class="dropdown"> -->
                  <!-- <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a> -->
                  <!-- <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    </li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul> -->
                <!-- </li> -->
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
          

        <!-- page content -->

        <?php
        include $data['content']; ?>
<style>
.input-search, div.input input[type="text"], input[type="password"], select{
  height: auto;
}
</style>

<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalaviso">Large modal</button> -->
<?php if(isset($_SESSION['loginagency']->p) AND $_SESSION['loginagency']->p == 'admin'){ ?>
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modalaviso">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                  </button>
                  <h3 class="modal-title" id="myModalLabel">Change Password</h3>
                </div>
                <div class="modal-body">
                <p>You need to change the password </p><p>(6 character min, 20 character max)</p>

                    <div class="container">
                    <form id="form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">password<span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <input type="password" id="password" required="required" class="form-control col-md-7 col-xs-12" name="password">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">confirm password<span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <input type="password" id="password2" name="password2" required="required" class="form-control col-md-7 col-xs-12" name="password2">
                        </div>
                      </div>
                      
                <small>(it's a good idea to use a strong password that you don't use elsewhere)</small>
                      <div class="form-group">
                        <div class="modal-footer">
                          <a type="button" class="btn btn-primary" onsubmit='sendpass()' id='sendpass'>Change Password</a>
                        </div>
                      </div>


                      </form>
                    </div>
                </div>

              </div>
            </div>
          </div>
          <script>

        // $jq(document).ready(function(){
          // var p = '<?php echo $_SESSION['loginagency']->p?>';
          // alert(p);
          // if (p == 'admin') {
            // $jq('.opciones').children().addClass('senial');
            // $jq('.opciones2').children().addClass('senial2');
          // }else{
            // $jq('.opciones').children().addClass('fa fa-angle-down');
          // }
        // })
  $jq('#sendpass').click(function(){
         var pas = $jq('#password').val();
         var pas2 = $jq('#password2').val();
    console.log("pas => ",pas, " pas2 => ",pas2);
    
    if (pas.toLowerCase() != pas2.toLowerCase() || pas.toLowerCase() == '' || pas2.toLowerCase() == '' ) {
        let msn = (pas == '')? 'The Input Password Is required!' : 'The password Should Be Same!, please Try again' ;
      const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    cancelButton: 'btn btn-danger',
                    confirmButton: 'btn btn-danger'
                  },
                  buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                  title: 'Ups!',
                  text: msn,
                  type: 'error',
                  showCancelButton: false,
                  confirmButtonText: 'Okay',
                  reverseButtons: true
                }).then((result) => {
                  // window.location="<?php echo $data['rootUrl']; ?>admin/home";
                })
           return false;
         }

        //  console.log('pas.length', pas.length);
        //  debugger

         if (pas.length < 6 || pas.length > 20 ) {
      const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    cancelButton: 'btn btn-danger',
                    confirmButton: 'btn btn-danger'
                  },
                  buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                  title: 'Ups!',
                  text: 'Please Enter a Value Between 6 and 20 characters long',
                  type: 'error',
                  showCancelButton: false,
                  confirmButtonText: 'Okay',
                  reverseButtons: true
                }).then((result) => {
                  // window.location="<?php echo $data['rootUrl']; ?>admin/home";
                })
           return false;
         }


        $jq.ajax({
          url:'<?php echo $data['rootUrl']; ?>admin/agency/rechangepass',
          method:'POST',
          cache:false,
          data:{
            pass:pas
          }
        })
        .done(function(data){
          if (data == 'ok') {
            Swal.fire('Password Updated!','Your Password has been changed successfully','success');
          $jq('#modalaviso').modal('hide');
          // $jq('.opciones').children().removeClass('senial');
          // $jq('.opciones2').children().removeClass('senial2');
          // $jq('.opciones').children().addClass('fa fa-angle-down');
          }else{
            alert('something is whrong please try again');
          }

        })
  })
          </script>
<?php } ?>
        <!-- /page content -->
                    <br>
        <!-- footer content -->
        <footer>
          <div class="pull-right">
          &copy; 1989 - <?php echo date('Y');?> Supertours Of Orlando, INC . All Rights Reserved.
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>



  </body>
</html>
