
<?php

    $login = $_SESSION['loginagency'];
    //$usuario = $login->usuario_pago;
    $user = $this->data['users'];
    $nombre = $login->nombre;
    //$pin = $login->pin_pago;
    //echo $pin;
    $vehiculos100 = 1;
    //echo $nombre;
    /*if($nombre == 'Sanchez Ruth' && $pin ='9S1M59'){
        $codigoHTML.=' <div id="duelo" style="position:absolute; z-index: 1; margin-left:383px; margin-top:148px;"><img src="https://www.supertours.com/duelo.png" alt="" style="width: 63px; height: 74px; margin-left: 9px; margin-top: 5px;" /></div>';
        echo $codigoHTML;
    }*/
    // print_r($user);
    // die;
 $mjs = null;
 if (isset($_GET['msj'])) {
     $msj = $_GET['msj'];
 }
?>
<style>
input[type="file"]#imgicon {
 width: 0.1px;
 height: 0.1px;
 opacity: 0;
 overflow: hidden;
 position: absolute;
 z-index: -1;
 }

 label[for="imgicon"] {
 font-size: 14px;
 font-weight: 600;
 color: #fff;
 background-color: #106BA0;
 display: inline-block;
 transition: all .5s;
 cursor: pointer;
 padding: 15px 40px !important;
 text-transform: uppercase;
 width: 100%;
 text-align: center;
 }

 label[for="imgicon"]:hover{
   background:#289AA9;
 }
 .circulo {
     width: 10px;
     height: 10px;
     margin: 5px 0px -15px 20px;
     -moz-border-radius: 50%;
     -webkit-border-radius: 50%;
     border-radius: 50%;
     background: #5cb85c;
}
</style>
<script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jquery/dist/jquery.min.js"></script>
      <script>
    var $jq = jQuery.noConflict();
    // alert($jq.fn.jquery);
    </script>
    <!-- jQuery Cookie-->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jquery/src/jquery.cookie.js"></script>
    <!-- Bootstrap -->
<script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/Flot/jquery.flot.resize.js"></script>

    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/ResponsiveSlides/responsiveslides.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo $data['rootUrl']; ?>global/startjs/sweetalert2.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/build/js/custom.js"></script>

    <script src="<?php echo $data['rootUrl']; ?>protected/viewc/agency/agency/vendors/intro.js/js/intro.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js"></script>
<script>
    // var $j = jQuery.noConflict();
    // alert($jq.fn.jquery);
    // </script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.multiselect.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/menubar/js/menu.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/prettify.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/ajaxfileupload.js"></script>
 

<script src='<?php echo $data['rootUrl']?>global/startjs/jquery.bootstrap-touchspin.js'></script>
    <script src='<?php echo $data['rootUrl']?>global/startjs/moment.min.js'></script>
    <script src='<?php echo $data['rootUrl']?>global/startjs/lightpick.js'></script>


    <?php if(isset($_SESSION['loginagency']) AND $login->admon == 1) { ?>
<div class="right_col" role="main" >
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Settings<small>save changes before leaving.</small></h2>

                    <?php  // echo '<pre>'; print_r($login); echo '</pre>'; ?>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-2 col-sm-2 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <?php if(isset($_SESSION['loginagency']) AND $login->img != '') {?>
              <img class="img-responsive avatar-view" src="<?php echo $data['rootUrl']; ?>global/logo_agency/<?php echo $login->img?>" alt="Avatar" title="Change the avatar">
              <?php }else{?>
              <img class="img-responsive avatar-view" src="<?php echo $data['rootUrl']; ?>logo.png" alt="Avatar" title="Change the avatar">
                <?php }?>

                        </div>
                      </div>



                  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <form action="<?php echo $data['rootUrl'] ?>admin/reservas/changeicon" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Change Logo</h4>
                        </div>
                        <div class="modal-body">
                            <!-- <img id="im" src="" height="200" style="width: 100%;" alt="Image preview..."> -->
                            <center><img id="im" width="200" alt="Logo" src="<?php echo $data['rootUrl']; ?>global/logo_agency/<?php echo $login->img?>" alt="" srcset=""></center>
                            <p>
                            <label for="imgicon" >Upload Your Logo</label>
                            <input id="imgicon" onchange="previewFile()" name="imgicon" type="file" > </p>
                            <div id="logoname"></div>
                        </div>
                        <div class="modal-footer">
                          <!-- <a type="button" class="btn btn-default" data-dismiss="modal">Close</a> -->
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>



                      <h2><?php print_r($login->firstname) ?> <?php print_r($login->lastname) ?></h2>

                      <ul class="list-unstyled user_data">
                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $login->company_name ?>
                        </li>

                        <li><i class="fa fa-globe user-profile-icon"></i> <?php echo $login->country ?>, <?php echo $login->city ?>
                        </li>

                        <li><i class="fa fa-globe user-profile-icon"></i> <?php echo $login->address ?>
                        </li>
                        <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $login->zipcode ?>
                        </li>

                        <li><i class="fa fa-phone user-profile-icon"></i> <?php echo $login->phone1 ?>
                        </li>
                        <li><i class="fa fa-fax user-profile-icon"></i> <?php echo $login->fax ?>
                        </li>
                        <li><i class="fa fa-user user-profile-icon"></i> <?php echo $login->manager ?>
                        </li>
                      </ul>
                      <br />


                    </div>
                <div class="col-md-10 col-sm-10 col-xs-12"  >

                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">profile</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Users</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Settings</a>
                          </li>
                        </ul>

                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                          <?php
                        if (isset($_GET['msj'])) {
                        ?>
                            <p>
                            <div class="alert alert-info alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <?php echo $msj?>
                            </div>
                            </p>
                            <?php
                        }
                        ?>
                            <!-- start recent activity -->
                            <ul class="messages">
                              <li>
                                <!-- <img src="images/img.jpg" class="avatar" alt="Avatar"> -->
                                <div class="message_wrapper">
                                  <h4 class="heading">Web Page</h4>
                                  <a href="http://<?php echo $login->web_page ?>" target="_blank"><blockquote class="message"><?php echo $login->web_page?>.</blockquote></a>
                                  <br />
                                  <h4 class="heading">Address</h4>
                                  <blockquote class="message"><?php print_r($login->address) ?> <?php print_r($login->lastname) ?>.</blockquote>
                                  <br />
                                  <h4 class="heading">Email</h4>
                                  <blockquote class="message"><?php echo $login->main_email?>.</blockquote>
                                  <br />
                                  <h4 class="heading">Phone</h4>
                                  <blockquote class="message"><?php echo $login->phone1?>.</blockquote>
                                  <br />
                                  <h4 class="heading">fax</h4>
                                  <blockquote class="message"><?php echo $login->fax?>.</blockquote>
                                  <br />
                                  <h4 class="heading">Manager</h4>
                                  <blockquote class="message"><?php print_r($login->firstname) ?> <?php print_r($login->lastname) ?>.</blockquote>
                                  <br />

                                </div>
                              </li>

                            </ul>
                            <!-- end recent activity -->

                          </div>
      <div role="tabpane2" class="tab-pane fade in" id="tab_content2" aria-labelledby="profile-tab3">
          <div class="col-md-12 col-sm-12 col-xs-12" id="tablauser">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Users</h2>
                    <a id="agregar" onclick="agregar()" type="button"  class="btn btn-success btn-flat pull-right" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i></a>
                    <a data-toggle="tooltip" data-placement="top" title="See All" id="seall" type="button"  class="btn btn-info btn-flat pull-right" onclick="buscar('clean')" data-toggle="modal"><i class="fa fa-th-list"></i></a>
                    <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" id="search" placeholder="Name, Lastname Or Email">
                    <span class="input-group-btn">
                      <button data-toggle="tooltip" data-placement="top" title="Search Now!" class="btn btn-default" style="background-color: antiquewhite;" type="button" id="buscar" onclick="buscar('buscar')">Search!</button>
                    </span>
                  </div>
                </div>
              </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar scroll-eric" >
                      <table class="table table-bordered jambo_table bulk_action mb-0 ">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">First Name </th>
                            <th class="column-title">Last Name </th>
                            <th class="column-title">Email </th>
                            <th class="column-title mostrar" >Password </th>
                            <th class="column-title " >Status</th>
                            <th class="column-title mostrar" >Admin </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>

                          </tr>
                        </thead>
                        <?php foreach ($user as $info) { ?>
                        <tbody id="tablefiltre" style="<?php echo ($info['activo'] == 0)? 'color:#DADADA;' : '' ; ?>">
                        <tr >
                        <td class="mostr" id="togglename<?php echo $info['id']?>">
                        <i data-toggle="tooltip" data-placement="top" title="This User is A Manager <?php echo ($info['activo'] == 1)? '' : 'But is inactive' ;?>" style="margin-top: 3px;" class="<?php echo ($info['admon'] == 1 )? 'fa fa-star pull-left ' : '' ;  ?>"  aria-hidden="true"></i>
                        <?php if( false /*$info['online'] == 1*/){ ?>  <div class="circulo" title="asd"></div> <?php } ?>

                       <?php echo $info['firstname']?>
                      </td>
                      <td class="ocultr" id="togglename2<?php echo $info['id']?>">
                      <label for="">First Name</label>
                      <input class="form-control" type="text" value="" id="nameinp<?php echo $info['id']?>"></td>

                      <td class="mostr" id="togglelast<?php echo $info['id']?>" ><?php echo $info['lastname']?></td>

                      <td class="ocultr" id="togglelast2<?php echo $info['id']?>">
                      <label for="">Last Name</label>
                      <input class="form-control" type="text" value="" id="lastinp<?php echo $info['id']?>"></td>

                      <td class="mostr" id="toggleemail<?php echo $info['id']?>"><?php echo $info['email']?></td>
                      <td class="ocultr" id="toggleemail2<?php echo $info['id']?>">
                      <label for="">Email</label>
                      <input class="form-control" type="text" value="" id="emailinp<?php echo $info['id']?>"></td>

                      <td class="ocultr" id="togglepass2<?php echo $info['id']?>">
                      <label for="">PassWord</label>
                      <input class="form-control" type="text" value="" id="passinp<?php echo $info['id']?>"></td>

                      <td class="mostr" id="togglestatus<?php echo $info['id']?>"><span class="<?php echo ($info['activo'] == 1)? 'label label-success' : 'label label-danger' ;  ?>"><?php echo ($info['activo'] == 1)? 'Active' : 'Inactive' ;  ?></span></td>
                      <td class="ocultr" id="togglestatus2<?php echo $info['id']?>">
                      <label for="">Active</label>

                      <input style="margin-top: 10px;" type="checkbox" id="statusinp<?php echo $info['id']?>">
                      </td>

                      <td class="ocultr" id="toggleadmin2<?php echo $info['id']?>">
                      <label for="">Admin</label>
                      <input style="margin-top: 10px;" type="checkbox" id="admininp<?php echo $info['id']?>">

                      </td>


                      <td>
                        <div class="editdeletbtnall" id="editdeletbtnall<?php echo $info['id']?>" >
                        <div class="editdeletbtn<?php echo $info['id']?>"  >

                            <a data-toggle="tooltip" data-placement="top" title="Update this user" class="btn btn-warning btn-flat btn-xs" id="edit" onclick="getinfo('on',<?php echo $info['id']?>,'<?php echo $info['firstname']?>','<?php echo $info['lastname']?>','<?php echo $info['email']?>','<?php echo $info['activo']?>','<?php echo $info['admon']?>','<?php echo $info['password']?>')"><i class="fa fa-edit"></i></a>
                            <?php if($login->iduser != $info['id'] AND $info['admon'] != 1) { ?>
                            <a id="btndelete" data-toggle="tooltip" data-placement="top" title="Delete this user" onclick="del(<?php echo $info['id']?>)" class="btn btn-danger btn-flat btn-xs"><i class="fa fa-trash"></i></a>
                            <?php } ?>
                        </div>
                        </div>

                        <div class="updatebanbtnall" id="updatebanbtnall<?php echo $info['id']?>">
                        <div class="updatebanbtn<?php echo $info['id']?>"  >
                            <a data-toggle="tooltip" data-placement="top" title="Save the change" class="btn btn-success btn-flat btn-xs" id="update" onclick="setinfo(<?php echo $info['id']?>)"><i class="fa fa-check"></i></a>

                            <a id="btndban" data-toggle="tooltip" data-placement="top" title="Cancel" onclick="closew('off',<?php echo $info['id']?>)" class="btn btn-danger btn-flat btn-xs"><i class="fa fa-ban"></i></a>
                        </div>
                        </div>

                      </td>
                      </tr>
                        </tbody>
                        <script>
                          function previewFile() {
                          var preview = document.querySelector('#im');
                          var file    = document.querySelector('input[type=file]').files[0];
                          var name    = document.querySelector('input[type=file]').files[0].name;
                          // alert(name);
                          if (file != undefined) {
                            var reader  = new FileReader();
                            console.log(file);

                          reader.onloadend = function () {
                          preview.src = reader.result;
                          }

                          if (file) {
                          reader.readAsDataURL(file);
                          $jq('#logoname').html(' <small><p><b>Logo name: </b>'+name+'</p></small>');
                          } else {
                          preview.src = "";
                          }
                          }

                          }
                        </script>
                        <script>
                      $jq(document).ready(function(){
                        // $jq('#closeall').hide();
                        var id2 = '<?php echo $info['id']?>';
                        $jq('.editdeletbtn'+id2).show();
                          $jq('.updatebanbtn'+id2).hide();
                          $jq('#seall').hide();

                      })
                        // $jq('#edit').click(function(){
                        //   $jq('#nameinp').val
                        // });

                        var cont = 0;
                        function getinfo(opc,id,name,lastname,email,status,admon,password){
                          var iduserlogin = '<?php echo $login->iduser?>';
                          // if ($(".editdeletbtnall").css("display") == 'block' && $(".updatebanbtnall").css("display") == 'none') {
                          if (opc == 'on') {
                              $jq('#editdeletbtnall'+id).hide();
                              $jq('#updatebanbtnall'+id).show();
                              // debugger;
                                }
                                console.log($jq.cookie("cont"));

                                if($jq.cookie("cont")){
                                  var inc = ++cont;
                                }else{
                                  var inc = 1;
                                }
                                console.log(inc);
                               $jq.cookie("cont",inc);
                               $jq('.editdeletbtn'+id).hide();
                          $jq('.updatebanbtn'+id).show();
                          // var name = ;
                          //alert(id+", "+name+" , "+lastname+" , "+email+" , "+ status+" , "+admon+" , "+password);
                          if (admon == '1') {
                            $jq('#admininp'+id).prop('checked',true);
                            if (id == iduserlogin) {
                              $jq('#admininp'+id).prop('disabled',true);
                            }
                          }
                          if (status == '1') {
                            $jq('#statusinp'+id).prop('checked',true);
                            if (id == iduserlogin) {
                              $jq('#statusinp'+id).prop('disabled',true);
                            }
                          }
                          $jq('#nameinp'+id).val(name);
                          $jq('#lastinp'+id).val(lastname);
                          $jq('#emailinp'+id).val(email);
                          // $jq('#statusinp'+id).val(status);
                          $jq('#passinp'+id).val(password);
                          // $jq('#admininp'+id).val(check);
                          // alert(r);
                          $jq('#togglename'+id).hide();
                          $jq('#togglename2'+id).show();

                          $jq('#togglelast'+id).hide();
                          $jq('#togglelast2'+id).show();

                          $jq('#toggleemail'+id).hide();
                          $jq('#toggleemail2'+id).show();

                          $jq('#togglestatus'+id).hide();
                          $jq('#togglestatus2'+id).show();

                          $jq('#togglepass2'+id).show();

                          $jq('#toggleadmin2'+id).show();

                          $jq('.mostrar').show();

                          $jq('#closeall').show();

                          $jq('#nameinp'+id).focus();
                        }

                        function closew(opc,id){
                          if (opc == 'off') {
                            $jq('#editdeletbtnall'+id).show();
                            $jq('#updatebanbtnall'+id).hide();
                          }

                          // $jq('.editdeletbtnall').show();
                          // $jq('.updatebanbtnall').hide();

                          // $jq('#nameinp'+id).val('');
                          // $jq('#lastinp'+id).val('');
                          // $jq('#emailinp'+id).val('');
                          // $jq('#statusinp'+id).val(0);
                          // $jq('#passinp'+id).val('');
                          // $jq('#admininp'+id).val(0);

                          $jq('#togglename'+id).show();
                          $jq('#togglename2'+id).hide();

                          $jq('#togglelast'+id).show();
                          $jq('#togglelast2'+id).hide();

                          $jq('#toggleemail'+id).show();
                          $jq('#toggleemail2'+id).hide();

                          $jq('#togglestatus'+id).show();
                          $jq('#togglestatus2'+id).hide();

                          $jq('#togglepass2'+id).hide();

                          $jq('#toggleadmin2'+id).hide();
                          //alert($jq(".editdeletbtnall").css("display"));

                          // if($jq.cookie("cont")){
                                  var dec = --cont;
                          //       }else{
                          //         var dec = 0;
                          //       }
                          //       console.log(dec);
                          $jq.cookie("cont",dec)
                          if ( $jq.cookie("cont") < 0) {
                          $jq('.mostrar').hide();
                          }
                          console.log($jq.cookie("cont"));

                          $jq('.editdeletbtn'+id).show();
                          $jq('.updatebanbtn'+id).hide();
                        }

                        function setinfo(id){

                          var name = $jq('#nameinp'+id).val();
                          var lastname = $jq('#lastinp'+id).val();
                          var email = $jq('#emailinp'+id).val();
                          var status =  $jq('#statusinp'+id).prop('checked');
                          var admon = $jq('#admininp'+id).prop('checked');
                          var password = $jq('#passinp'+id).val();
                          var stado = (status === true)? 1 : 0;
                          var admin =  (admon === true)? 1 : 0;
                          var msj = '';
                          var iduserlogin = '<?php echo $login->iduser?>';

                          console.log("iduserlogin: "+iduserlogin+"---id: "+id);

                          if (admon == false && id == iduserlogin) {
                            msj += "&squf; You can not deactivate this option (Active) because you are currently active on the web.<br>";

                          }
                          if (stado == false && id == iduserlogin) {
                            msj += "&squf; You can not deactivate this option (Status)  because you are currently active on the web.<br>";

                          }

                          if (name == '') {
                            msj += '&squf; The name is required.<br>';

                          }
                          if (lastname == '') {
                            msj += '&squf; The last name is required.<br>';

                          }
                          if (email == '') {
                            msj += '&squf; The Email is required.<br>';

                          }
                          if (password == '') {
                            msj += '&squf; The Password is required.';

                          }
                          if (msj != '') {
                            swal.fire( 'Hey!', msj, 'warning')
                          return false;
                          }
                          //alert(id+", "+name+" , "+lastname+" , "+email+" , "+ status+" , "+admon+" , "+password);


                          const swalWithBootstrapButtons = Swal.mixin({
                          customClass: {
                            cancelButton: 'btn btn-danger',
                            confirmButton: 'btn btn-success'
                          },
                          buttonsStyling: false,
                        })

                        swalWithBootstrapButtons.fire({
                          title: 'Confirmation?',
                          html:'<h3>You try to change the following information</h3><hr>' +
                        '<b>First Name: </b>'+name+'<br><b>Last Name: </b>'+lastname+'<br><b>Email: </b>'+email+'<br><b>Status: </b>'+status+'<br><b>Admin: </b>'+admon+'<br><b>Password: </b>'+password+'<hr> ' +
                        'Please make sure the changes are correct.',
                          type: 'info',
                          showCancelButton: true,
                          cancelButtonText: 'No, cancel!',
                          confirmButtonText: 'Yes, Update it!',
                          reverseButtons: true,
                        }).then((result) => {
                          if (result.value) {
                            $.ajax({
                                url: "<?php echo $data['rootUrl'] ?>admin/setting_agency/setinfo/'"+id+"'/'"+name+"'/'"+lastname+"'/'"+email+"'/"+stado+"/"+admin+"/'"+password+"'/",
                                method: "POST",
                                beforeSend: function () {
                                    $jq("#resultado").html("");
                                }
                            }).done(function(data) {
                              if (data == 'ok') {
                                swalWithBootstrapButtons.fire(
                              'UPDATED!',
                              'Your file has been UPDATED.',
                              'success'
                            )
                              }else{
                                swalWithBootstrapButtons.fire(
                              'Ups',
                              'Something is whrong Please Try again later.',
                              'error'
                            )
                              }

                          console.log(this);
                          $jq("#tablauser").load(" #tablauser",function(){
                            $jq.removeCookie("cont");
                            cont = 0;
                          $jq('.mostrar').hide();
                          $jq('.editdeletbtn'+id).show();
                          $jq('.updatebanbtn'+id).hide();
                          // $jq('#agregarinputs').hide();
                          $jq('#nameinp'+id).val('');
                          $jq('#lastinp'+id).val('');
                          $jq('#emailinp'+id).val('');
                          $jq('#statusinp'+id).val(0);
                          $jq('#passinp'+id).val('');
                          $jq('#admininp'+id).val(0);
                          $('#seall').hide();

                          $jq('#togglename'+id).show();
                          $jq('#togglename2'+id).hide();

                          $jq('#togglelast'+id).show();
                          $jq('#togglelast2'+id).hide();

                          $jq('#toggleemail'+id).show();
                          $jq('#toggleemail2'+id).hide();

                          $jq('#togglestatus'+id).show();
                          $jq('#togglestatus2'+id).hide();

                          $jq('#togglepass2'+id).hide();

                          $jq('#toggleadmin2'+id).hide();

                          // $jq('.mostrar').hide();
                            // alert($(".editdeletbtnall").css("display") );
                          $jq('.editdeletbtnall').show();
                          $jq('.updatebanbtnall').hide();

                          $('.ocultr').hide();
                          $('.mostr').show();
                          });
                            });

                          } else if (
                            // Read more about handling dismissals
                            result.dismiss === Swal.DismissReason.cancel
                          ) {
                            swalWithBootstrapButtons.fire(
                              'Cancelled',
                              'the process has been canceled',
                              'error'
                            )
                          }
                        })

                        }
                        </script>
                      <?php } ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

                        <!-- GUARDAR CLIENTE -->
            <div class="modal fade bs-example-modal-lg" id="add" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <form  >
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">New User</h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <label>First Name <b class="text-danger">*</b></label>
                        <input  name="firstname" type="text" class="form-control" id="fname" placeholder="First Name" required>
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <label>Last Name <b class="text-danger">*</b></label>
                        <input  name="lastname" type="text" class="form-control" id="lname" placeholder="Last Name" required>
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <label>E-mail <b class="text-danger">*</b></label>
                        <input  name="email" type="email" class="form-control" id="email" placeholder="Email@..com" required>
                        <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                        </div>

                        <!-- <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <label>Password <b class="text-danger">*</b></label>
                        <input  name="pass" type="text" class="form-control" id="pass" placeholder="********" required>
                        <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
                        </div> -->

                        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <label>Password <b class="text-danger">*</b></label>
                        <div class="input-group col-md-10 col-sm-11 col-xs-11">
                            <!-- <input type="text" class="form-control" placeholder="**********" name="pass" id="pass" required="" /> -->
                            <input  name="pass" type="text" class="form-control" id="pass" placeholder="********" required>
                            <span class="input-group-btn">
                              <a title="Generate a New Password" type="button" class="btn btn-default btn-flat"  style=" margin: 0% 0% 0% 0%;" id="reloadpass"><i class="fa fa-retweet" ></i></a>
                            </span>
                          </div>
                        </div>



                        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <i id="adminico"  title='This User is A Manager' data-toggle='tooltip' data-placement='top'></i> <label>Admin <b class="text-danger">*</b></label>
                        <select id="admin" name="admin" class="col-md-4 col-sm-4 col-xs-12 form-control has-feedback vigilante"  style="background: #fff;" autocomplete="off" required>
                          <option  value="1">Yes</option>
                          <option Selected value="0">No</option>
                      </select>
                        <span class="fa fa-id-card form-control-feedback right" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <label>Status <b class="text-danger">*</b></label>
                        <select id="status" name="status" class="col-md-4 col-sm-4 col-xs-12 form-control has-feedback vigilante" style="background: #fff;" autocomplete="off" required>
                          <option  value="1">Active</option>
                          <option  value="0">Inactive</option>
                      </select>
                        <span class="fa fa-check form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <div class="modal-footer">
                          <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                          <a type="submit" class="btn btn-primary" id="guardar">Save changes</a>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>


         <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
        <form class="form-horizontal form-label-left input_mask" action="<?php echo $data['rootUrl'] ?>admin/reservas/saveprofileag" method="POST">
                <input type="hidden" name="id" value="<?php echo $login->id ?>">
            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
            <label>Company Name <b class="text-danger">*</b></label>
            <input value="<?php echo $login->company_name ?>" name="company_name" type="text" class="form-control" id="inputSuccess3" placeholder="Address" required>
            <span class="fa fa-briefcase form-control-feedback right" aria-hidden="true"></span>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
            <label>Address <b class="text-danger">*</b></label>
            <input value="<?php echo $login->address ?>" name="address" type="text" class="form-control" id="inputSuccess3" placeholder="Address" required>
            <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
            <label>E-Mail <b class="text-danger">*</b></label>
            <input value="<?php echo $login->main_email ?>" type="email" name="email_company" class="form-control" id="inputSuccess5" placeholder="Email" required>
            <span  class="fa fa-envelope  form-control-feedback right" aria-hidden="true"></span>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
            <label>Country <b class="text-danger">*</b></label>
            <select name="country" id="inputcountry" class="select2_single form-control vigilante"  required>
            <?php
            $sql2 = "SELECT id, name FROM country ORDER BY name DESC;";
            $rs2 = Doo::db()->query($sql2, array(9));
            $country = $rs2->fetchAll();
            foreach ($country as $ctr) {
                if ($login->country == $ctr['name']) {
                echo '<option selected value="' . $ctr['name'] . '" ' . (( 9 == $ctr['id']) ? 'select' : '' ) . '>' . $ctr['name'] . '</option>';
                }
                    echo '<option value="' . $ctr['name'] . '" ' . (( 9 == $ctr['id']) ? 'select' : '' ) . '>' . $ctr['name'] . '</option>';

            }
            ?>
        </select>
            <span class="fa fa-globe  form-control-feedback right" aria-hidden="true"></span>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
            <label>State <b class="text-danger"></b></label>
            <select id="inputState" name="state" class="col-md-4 col-sm-4 col-xs-12 form-control has-feedback vigilante" style="background: #fff;" autocomplete="off" >
            <option selected value="<?php echo (isset($idstate))? $idstate : '';?>"><?php echo $statename; ?></option>
            <?php
            $sql3 = "SELECT id, name,abb FROM state;";
            $rs3 = Doo::db()->query($sql3, array(9));
            $state = $rs3->fetchAll();
            foreach ($state as $std) {
                if ($login->state ==  $std['abb']) {
                    echo '<option selected value="' . $std['abb'] . '" ' . (( 9 == $std['id']) ? 'select' : '' ) . '>' . $std['name'] . '</option>';
                }
                echo '<option value="' . $std['abb'] . '" ' . (( 9 == $std['id']) ? 'select' : '' ) . '>' . $std['name'] . '</option>';
            }
            ?>

        </select>
            <span class="fa fa-globe form-control-feedback right" aria-hidden="true"></span>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
            <label>City <b class="text-danger">*</b></label>
            <input name="city" value="<?php echo $login->city ?>" type="text" class="form-control" id="inputSuccess5" placeholder="Phone" required>
            <span  class="fa fa-globe form-control-feedback right" aria-hidden="true"></span>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
            <label>Zip Code <b class="text-danger">*</b></label>
            <input name="zip" value="<?php echo $login->zipcode ?>" type="text" class="form-control" id="inputSuccess5" placeholder="Zip" required>
            <span  class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
            </div>



            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
            <label>Phone <b class="text-danger">*</b></label>
            <input name="phone" value="<?php echo $login->phone1 ?>"  type="text" class="form-control" id="inputSuccess5" placeholder="Phone" required>
            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
            <label>Fax <b class="text-danger">*</b></label>
            <input name="pax" value="<?php echo $login->fax ?>" type="text" class="form-control" id="inputSuccess5" placeholder="fax" required>
            <span class="fa fa-fax form-control-feedback right" aria-hidden="true"></span>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
            <label>Web Page <b class="text-danger">*</b></label>
            <input name="webp" value="<?php echo $login->web_page ?>" type="text" class="form-control" id="inputSuccess5" placeholder="webpage" required>
            <span  class="fa fa-chrome form-control-feedback right" aria-hidden="true"></span>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
            <label>Manager <b class="text-danger"></b></label>
            <input name="manager" value="<?php echo $login->firstname ?> <?php echo $login->lastname ?>" type="text" class="form-control" id="inputSuccess5" placeholder="Manager" readonly>
            <span  class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
            <label>Logo <b class="text-danger"></b></label>
            <button type="button"  class="btn btn-info btn-flat btn-block" data-toggle="modal" data-target=".bs-example-modal-sm">Change Logo</button>

            </div>

<div class="form-group">
</div>
<div class="ln_solid"></div>
<div class="form-group"><!--col-md-offset-9-->
  <div class="col-md-12 col-sm-12 col-xs-12 ">
    <button type="submit" class="btn btn-warning btn-flat">Save Changes</button>
  </div>
</div>

</form>


</div>

</div>
</div>

        </div>
</div>
</div>
</div>
</div>
</div>


    <script>

function del(id) {
 const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    cancelButton: 'btn btn-danger',
    confirmButton: 'btn btn-success'
  },
  buttonsStyling: false,
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "you want to delete this user?",
  type: 'warning',
  showCancelButton: true,
  cancelButtonText: 'No, cancel!',
  confirmButtonText: 'Yes, delete it!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
    $jq.ajax({
        url: "<?php echo $data['rootUrl'] ?>admin/setting_agency/delete/"+id,
        method: "POST",
        beforeSend: function () {
            $jq("#resultado").html("");
        }
    }).done(function(data) {
      swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
        console.log(this);
        console.log("CONFIRM");
        cont = 0;
        $jq.removeCookie("cont");
        // $jq("#tablauser").load(" #tablauser");
        $jq("#tablauser").load(" #tablauser",function(){
          // alert('.editdeletbtn'+id);
          $jq('.editdeletbtnall').show();
          $jq('.updatebanbtnall').hide();
                $('.ocultr').hide();
              $('.mostrar').hide();
              $('.mostr').show();
              $('#seall').hide();
              });

        // $jq('#agregarinputs').hide();
    });

  } else if (
    // Read more about handling dismissals
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'the process has been canceled',
      'error'
    )
  }
})
// alert('.editdeletbtn'+id);
//editdeletbtn27269

}



</script>
<script>

</script>
    <script>
    $jq(document).ready(function(){
      $jq.removeCookie("cont");
      $jq('.ocultr').hide();
      $jq('.mostrar').hide();
      // $jq('.editdeletbtn').show();
      // $jq('.updatebanbtn').hide();
    });


            // $jq(document).ready(function(){
            //   $jq('#agregarinputs').hide();
            //   $jq('#add').click(function(){
            //     $jq('#agregarinputs').show();
            //   });
            //   $jq('#cancel').click(function(){
            //     $jq('#agregarinputs').hide();
            //     $jq('#fname').val('');
            //     $jq('#lname').val('');
            //     $jq('#email').val('');
            //     $jq('#status').val(1);
            //   });
            // });
            function makeid(length) {
              var result           = '';
              var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
              var charactersLength = characters.length;
              for ( var i = 0; i < length; i++ ) {
                  result += characters.charAt(Math.floor(Math.random() * charactersLength));
              }
              return result;
            }


            // $jq('#agregar').click(function(){

              function agregar(){
                //$('#add').modal('show');
            // console.log(makeid(10));
              var passrandom = makeid(7);
             $jq('#fname').val('');
                $jq('#lname').val('');
                $jq('#email').val('');
                $jq('#status').val(1);
                $jq('#adminico').removeClass('fa fa-star');

                $jq('#pass').val(passrandom);
               $jq('#admin').val(0);
            }

            $jq('#reloadpass').click(function (){
              $jq('#pass').val(makeid(7));
            })


            $jq('#guardar').click(function(){

              var fname = $jq('#fname').val();
               var lname = $jq('#lname').val();
               var email = $jq('#email').val();
               var status= $jq('#status').val();
               var pass= $jq('#pass').val();
               var admin= $jq('#admin').val();

               var msj = '';
               if (fname == '') {
                 msj += 'The name is required,<br>';

               }
               if (lname == '') {
                 msj += 'The last name is required,<br>';

               }
               if (email == '') {
                 msj += 'The Email is required,<br>';

               }
               if (pass == '') {
                 msj += 'The Password is required<br>';

               }
               if (msj != '') {
                swal.fire( 'Hey!', msj, 'warning')
               return false;
               }

              // debugger;
                $jq.ajax({
                url: "<?php echo $data['rootUrl'] ?>admin/setting_agency/add/"+fname+"/"+lname+"/"+email+"/"+status+"/"+pass+"/"+admin,
                method: "POST",
                beforeSend: function () {
                    $jq("#resultado").html("");
                }
            }).done(function(data) {


              if (data == 'ok') {
                Swal.fire( 'Great!','The User saved success!','success');
                cont = 0;
                $jq.removeCookie("cont");
              $jq('#add').modal('hide');
              }else{
                Swal.fire( 'Ups!','Something Is whrong, Place Try Again Later!','error');
              $jq('#add').modal('hide');
              }
              $jq("#tablauser").load(" #tablauser",function(){
              $jq('#fname').val('');
                $jq('#lname').val('');
                $jq('#email').val('');
                $jq('#status').val(0);
                $('#seall').hide();
               $jq('#admin').val(0);

                $('.ocultr').hide();
              $('.mostrar').hide();
              $('.mostr').show();
              $jq('.editdeletbtnall').show();
              $jq('.updatebanbtnall').hide();
              });
                console.log(this);
                console.log("CONFIRM");
            });
            });
            </script>

            <script>
              // $('#search').keyup(function(){
              //   $('#buscar').focus();
              // })

                  function buscar(val){
                    if (val === 'clean') {
                    var value = '';
                    $jq('#search').val('');
                    $('#seall').hide();
                    }else{
                      var value = $jq('#search').val().toLowerCase();
                    }
                    if (value != '') {
                      $('#seall').show();
                    }else{
                      $('#seall').hide();
                    }
                    console.log(value.replace(/ /g, ""));
                    console.log(value);
                    $jq("#tablefiltre tr").filter(function() {
                      $jq(this).toggle($jq(this).text().toLowerCase().indexOf(value) > -1)
                    });

                  }
            </script>
            <?php }else{ ?>
              <script>
                const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    cancelButton: 'btn btn-danger',
                    confirmButton: 'btn btn-info'
                  },
                  buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                  title: 'You should not be here!',
                  text: "Return home immediately",
                  type: 'warning',
                  showCancelButton: false,
                  confirmButtonText: 'Okay, Return me home!',
                  reverseButtons: true
                }).then((result) => {
                  window.location="<?php echo $data['rootUrl']; ?>admin/home";
                })


                </script>
            <?php } ?>

            <script>
            $jq('#admin').change(function(){
              var admin = $("#admin option:selected").html();
              // alert(admin);
              if (admin == 'Yes') {

                $jq('#adminico').addClass('fa fa-star');
              }else{

                $jq('#adminico').removeClass('fa fa-star');


              }
            })
            </script>

            <script>
            // sesscon(); //se lanza a la primera vez
            // function sesscon() {
            //   var iduser = '<?php //echo $login->iduser; ?>';
            //     $.ajax({
            //         url: "<?php //echo $data['rootUrl'] ?>admin/Restart/"+iduser,
            //         method: "POST",
            //         beforeSend: function () {
            //         }
            //     }).done(function(data) {
            //         console.log(data);
            //     });
            // }
            // setInterval(function(){
            //     sesscon();
            // }, 1000);//Lanzará la petición cada 7 segundos
            </script>
