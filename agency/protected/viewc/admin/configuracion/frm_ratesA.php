<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css" />
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<?php $ratesroom = $data["ratesroom"]; ?>
    
<!--<html>-->
    <head>
        <title>RATES A</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/tarifasestilo/css/bootstrap-responsive.css"/>
        <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/tarifasestilo/css/bootstrap-responsive.min.css"/>
        <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/tarifasestilo/css/bootstrap.css"/>
        <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/tarifasestilo/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/tarifasestilo/css/jquery-ui.css">
        <script src="<?php echo $data['rootUrl']; ?>global/tarifasestilo/js/jquery-1.10.2.js"></script>
        <script src="<?php echo $data['rootUrl']; ?>global/tarifasestilo/js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/tarifasestilo/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/tarifasestilo/js/bootstrap.min.js"></script>
        <meta charset="UTF-8">
        <script>
            $(function () {
                $("#from").datepicker({
                    defaultDate: "+1w",
                    dateFormat: 'm-d-yy',
                    changeMonth: false,
                    numberOfMonths: 2,
                    onClose: function (selectedDate) {
                        $("#to").datepicker("option", "minDate", selectedDate);
                    }
                });
                $("#to").datepicker({
                    defaultDate: "+1w",
                    dateFormat: 'm-d-yy',
                    changeMonth: false,
                    numberOfMonths: 2,
                    onClose: function (selectedDate) {
                        $("#from").datepicker("option", "maxDate", selectedDate);
                    }
                });
            });
        </script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <table width="1%" height="1%" class="table table-bordered" style=" ">

                        <tr style="text-align: left; background: #0174DF; color: #fff; padding: 1px;">
                            <td width="1%" height="1" colspan="1 style="width: 1%;">
                               
                                Start Day &nbsp;<i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;
                                    <input type="text" id="from" name="from" style="width: 40%; color: #000; margin-left: 0px; margin-top: 15px;">
                                    
                                    <br>
                                  
                               
                                    End Day &nbsp;&nbsp;<i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;
                                    <input type="text" id="to" name="to" value="" style="width: 40%;color: #000; margin-left: 0px; margin-top:10px;">
                                
<!--                                    Tour Length <br> <samll>Max. 4 guest per room</samll>-->
                            </td>
                        
                        <th width="1%" style="text-align: center;"><p style="margin-top: 10px;" >Hotel <br><i class="fa fa-h-square fa-2x" aria-hidden="true"></i> </p></th>
                        <th width="1%" style="text-align: center;"><p style="margin-top: 10px;">Single <br><i class="fa fa-bed" aria-hidden="true"></i></p></th>
                        <th width="1%" style="text-align: center;"><p style="margin-top: 10px;">Double <br><i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i></p></th>
                        <th width="1%" style="text-align: center;"><p style="margin-top: 10px;">Triple<br><i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i></p></th>
                        <th width="1%" style="text-align: center;"><p style="margin-top: 10px;">Quad <br><i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i></p></th>
                        <th width="1%" style="text-align: center;"><p style="margin-top: 10px;">Child<br> <i class="fa fa-child" aria-hidden="true"></i>&nbsp;(3 to 9)<br></p></th>
                        </tr>
                        
                        <tr>

                            <th style="text-align: center;background: #3AAA35; color: #fff;" rowspan="2" >2 DAYS / 1 NIGHT 2 PARKS</th>
                            <th style="background: #D2E0E4; color: #000; padding: 0px;text-align: right;">
                                VALUE&nbsp;
                            </th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" value="<?php echo $ratesroom->sgl; ?>" style="width: 35%; height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                        </tr>
                        <tr style="">

                            <th style="background: #0174DF; color: #fff;    padding: 0px;text-align: right;">MODERATE&nbsp;</th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%; height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            
                        </tr>
                        <tr style="">

                            <th style="text-align: center; background: #0174DF; color: #fff;   " rowspan="2">3 DAYS / 2 NIGHTS 3 PARKS</th>
                            <th style="background: #D2E0E4; color: #000;padding: 0px;text-align: right;">
                                VALUE&nbsp;
                            </th>
                             <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                        </tr>
                        <tr style="">
                            <th style="background: #0174DF; color: #fff;    padding: 0px;text-align: right;">MODERATE&nbsp;</th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>                           
                        </tr>
                        <tr>

                            <th style="text-align: center;background: #3AAA35; color: #fff;" rowspan="2">4 DAYS / 3 NIGHTS 4 PARKS</th>
                            <th style="background: #D2E0E4; color: #000;padding: 0px;text-align: right;">
                                VALUE&nbsp;
                            </th>
                             <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                        </tr>
                        <tr style="">

                            <th style=" background: #0174DF; color: #fff;padding: 0px;text-align: right;">MODERATE&nbsp;</th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%; height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            
                        </tr>
                        <tr>

                            <th style="text-align: center; background: #0174DF; color: #fff;" rowspan="2">5 DAYS / 4 NIGHTS 5 PARKS</th>
                            <th style="background: #D2E0E4; color: #000;padding: 0px;text-align: right;">
                                VALUE&nbsp;
                            </th>
                             <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%; height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                        </tr>
                        <tr style="">

                            <th style="background: #0174DF; color: #fff;padding: 0px;text-align: right;">MODERATE&nbsp;</th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            
                        </tr>
                        
                        <tr>

                            <th style="text-align: center;background: #3AAA35; color: #fff;" rowspan="2">6 DAYS / 5 NIGHTS 6 PARKS</th>
                            <th style="background: #D2E0E4; color: #000;padding: 0px;text-align: right;">
                                VALUE&nbsp;
                            </th>
                             <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20; "></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                        </tr>
                        <tr style="">

                            <th style=" background: #0174DF; color: #fff;padding: 0px;text-align: right;">MODERATE&nbsp;</th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width:35%;height:20px; margin-left:-20;"></th>
                            
                        </tr>
                        <tr>

                            <th style="text-align: center;background: #0174DF; color: #fff;" rowspan="2">7 DAYS / 6 NIGHTS 7 PARKS</th>
                            <th style="background: #D2E0E4; color: #000;padding: 0px;text-align: right;">
                                VALUE&nbsp;
                            </th>
                             <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%; height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width:35%;height:20px; margin-left:-20;"></th>
                        </tr>
                        <tr style="">

                           <th style="background: #0174DF; color: #fff;padding: 0px;text-align: right;">
                                MODERATE&nbsp; 
                            </th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            
                        </tr>
                        <tr>

                            <th style="text-align: center;background: #3AAA35; color: #fff;" rowspan="2">8 DAYS / 7 NIGHTS 8 PARKS</th>
                            <th style="background: #D2E0E4; color: #000;padding: 0px;text-align: right;">
                                VALUE&nbsp;
                            </th>
                             <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%; height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                        </tr>
                        <tr style="">

                            <th style="background: #0174DF; color: #fff;padding: 0px;text-align: right;">
                                MODERATE&nbsp;
                            </th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            
                        </tr>
                        <tr>

                            <th style="text-align: center;background: #0174DF; color: #fff;" rowspan="2">9 DAYS / 8 NIGHTS 9 PARKS</th>
                            <th style="background: #D2E0E4; color: #000;padding: 0px;text-align: right;">
                                VALUE&nbsp;
                            </th>
                             <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%; height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #D2E0E4; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                        </tr>
                        <tr style="">

                            <th style="background: #0174DF; color: #fff;padding: 0px;text-align: right;">
                                MODERATE&nbsp;
                            </th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            <th style="background: #0174DF; color: #000;"><i class="fa fa-usd" aria-hidden="true"></i> <input type="text" name="" style="width: 35%;height:20px; margin-left:-20;"></th>
                            
                        </tr>


                    </table>
                </div>
            </div>
        </div>
<!--    </body>
</html>-->
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">

		   $( "#fecha_ini" ).datepicker({
				dateFormat:'mm-dd-yy'
			});

			$( "#fecha_fin" ).datepicker({
				dateFormat:'mm-dd-yy'
			});

	

    function validateForm(){

        var sErrMsg = "";
        var flag = true;

        
       // sErrMsg += validateInt($('#capacity').val(),$('#l_capacity').html() , true);
        //sErrMsg += validateText($('#frecuency').val(),$('#l_frecuency').html() , true);

        if(sErrMsg != "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }
    
    $('#btn-save').click(function(){
        if (validateForm()){
          $('#form1').submit();
        }
    })

    $('#btn-cancel').click(function(){
       window.location = '<?php echo $data['rootUrl']; ?>admin/tours/room-rates';
    })

</script>


