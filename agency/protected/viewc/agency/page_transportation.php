<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/jquery-ui.css">
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<div id="tike" >  
    <div id="formularioH">
        <form action="<?php echo $data['rootUrl']; ?>questions" method="post" name="form1" target = "Right frame"> 
            <table width="200" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr>
                    <td height="5" colspan="4"></td>
                </tr>
                <tr>
                    <td colspan="4" class="titulos1forms"><img src="<?php echo $data['rootUrl']; ?>global/images/BUY-TICKETS - white.png"  /></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="niveltextoforms">Round Trip</span> <input name="tipo_ticket" type="radio" value="roundtrip" id="rd" checked  /></td>
                    <td colspan="2"><span class="niveltextoforms">One Way Trip</span> <input name="tipo_ticket" type="radio" value="oneway" id="ow"  />      </td>
                </tr>
                <tr>
                    <td colspan="2"><span class="niveltextoforms1"> From</span>:<br /></td>
                    <td colspan="2">
                        <select name="fromt" class="select" style="width:150px;" id="from">
                            <option value=""></option> 
                            <?php foreach ($data["areas"] as $e){ ?>
                                <option value="<?php echo $e["id"]; ?>" <?php echo ($e["nombre"] == trim("ORLANDO") ? 'selected' : ''); ?> ><?php echo $e["nombre"]; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><span class="niveltextoforms1"> To:</span></td>
                    <td colspan="2"> <select name="tot" class="select" id="to" style="width:150px;">

                        </select></td>
                </tr>
                <tr>
                    <td colspan="4" class="titulos1forms">  </td>
                </tr>
                <tr>
                    <td width="64"><span class="niveltextoforms">Departing <br />
                        </span></td>
                    <td width="20"><a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" width="19" height="20"  border="0"  /></a></td>
                    <td colspan="2" class="titulos2forms"><input name="fecha_salida" size="20" maxlength="10" class="input-text" id="fecha_salida" readonly="readonly" value="<?php echo date("m-d-Y") ?>"/></td>
                </tr>
                <tr>
                    <td height="38"><div id="dv_fr2"><span class="niveltextoforms">Returning: <br />
                            </span> </div></td>
                    <td><div id="dv_fr1"><a href="" id="dataclick2" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" width="19" height="20" border="0" /></a></div></td>
                    <td colspan="2" class="titulos2forms"> <div class="form-row" id="dv_fr">  <input name="fecha_retorno" size="20" maxlength="10" class="input-text" id="fecha_retorno" readonly="readonly"  value="<?php echo date('m-d-Y', time() + 84600); ?>"/></div></td>
                </tr>

                <tr>
                    <td colspan="4"><span class="niveltextoforms3"> Adult</span>
                        <input type="number" name="pax" size="2" maxlength="5" class="input-text" id="pax" value="1" style="width:50px" min="1" required="required"  onchange=" 
	       var a = document.getElementById('pax').value;
        	if (isNaN(a)) { 
            	 return false;
     		}else{
            	 var max = 16-a;
                 if(max<0){
                 	var valor = 16-$('#pax2').val();
                    document.getElementById('pax').value = valor;
                    $('#pax2').attr('max',valor);
                 }else{
                     $('#pax2').attr('max',max);
                     if($('#pax2').val()>max){
                        $('#pax2').attr('value',max);
                     }
                 }
            }"   /> 
                        <span class="niveltextoforms3">Child<span class="titulos2forms">
                                <input type="number" name="pax2" size="2" style="width:50px" maxlength="5" class="input-text" id="pax2"  value="0" min="0" required="required" onchange="
       		var a = document.getElementById('pax2').value;
        	if (isNaN(a)) { 
            	 return false;
     		}else{
           		 var max = 16-a;
                 if(max<=0){
                 	var valor = 16-$('#pax').val();
                    document.getElementById('pax2').value = valor;
                    $('#pax2').attr('max',valor);
                 }else{
                     if($('#pax').val()>max){
                        $('#pax').attr('value',max);
                     }
                 }
            }"/>
                            </span></span></td>
                </tr>
                <tr>
                    <td colspan="2"><button  class="btn" id="btn-search" onclick="this.form.target = '_blank';
                            return true;">Search</button></td>
                    <td colspan="2" class="titulos2forms">&nbsp;</td>
                </tr>
                <tr>
                    <td height="66" colspan="4" align="left" valign="top"></td>
                </tr>
            </table>
        </form>


    </div>
</div>
<div id="mres"> <div id="center-column" >

        <div id="filter-bar">
            <form name="agencia" method="post" action="<?php echo $data['rootUrl']; ?>agency/#transporte"  class="form" id="form1" >


                <select name="filtro" id="filtro" class="select2">
                    <option value="fecha_ini" <?php echo $data["filtro"] == 'fecha_ini' ? 'selected' : '' ?>>Date</option>
                    <option value="codconf" <?php echo $data["filtro"] == 'codconf' ? 'selected' : '' ?>>Code</option>
                    <option value="firsname" <?php echo $data["filtro"] == 'firsname' ? 'selected' : '' ?>>First Name</option>
                    <option value="lasname" <?php echo $data["filtro"] == 'lasname' ? 'selected' : '' ?>>Last Name</option>
                </select>

                <span class="search">
                    <input name="texto" type="text" size="30" maxlength="30" class="input-search" id="texto" value="<?php echo $data["texto"]; ?>"/>
                    <input type="button" class="search-btn" id="btn-find" />
            </form>
            </span>

        </div>

        <table width="100%" class="grid" cellspacing="1" >  
            <thead>
                <tr>
                    <th width="17%">Date</th>
                    <th width="4%">Code</th>
                    <th width="8%">Ticket </th>
                    <th width="19%">Departur Date</th>
                    <th width="16%">Leader Passenger</th>
                    <th width="16%">User </th>
                    <th width="4%">View</th>
                </tr>
            </thead> 

            <tbody>
                <?php
                if (count($data['datos']) > 0) {
                    $i = 0;
                    foreach ($data['datos'] as $e):
                        ?>
                        <tr class="row<?php echo $i ?>">

                            <td><?php echo $e['fecha_ini']; ?></td>
                            <td><?php echo $e['codconf']; ?></td>
                            <td><?php echo $e['tipo_ticket']; ?></td>
                            <td><?php echo date("M-d-Y", strtotime($e['fecha_salida'])); ?></td>
                            <td><?php echo $e['firsname'] . " " . $e['lasname']; ?></td>
                            <td><?php echo $e['firstname'] . " " . $e['lastname']; ?></td>
                         <!-- <td><div align="right"><?php echo "<a href='#ajaxs' onclick='ajaxs(" . $e['id'] . ");' >View</a>"; ?></div></td> -->
                            <td><div align="right"><?php echo "<a href=" . $data['rootUrl'] . "agency/ajaxs/" . $e['id'] . " ><img src=\"" . $data['rootUrl'] . "global/images/pdf.png\" /></a>"; ?></div></td>  
                        </tr>
                        <?php
                        $i = 1 - $i;
                    endforeach;
                } else {
                    ?><tr>
                        <td colspan="8">No reservations</td> 
                    </tr>  
                <?php } ?>  
            </tbody>
        </table>
        <div id="pagination">
            <?php echo $data['pager'] ?>
        </div> 

        <p>&nbsp;</p>
        <p align="center" class="titulopago"><br />
        </p>       

    </div>    
</div>
<script type="text/javascript">
    $("#transporte .paginate,#transporte .next,#transporte .prev").click(function() {
        $("#transporte").load(encodeURI($(this).attr('href')));
        return false;
    });
    $("#from").change(function() {

        var id = $("#from").val();
        if (id != "")
            $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
    });

    var id = $("#from").val();

    if (id != "")
        $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));

    var horas = <?php echo $this->data['hora']; ?>;
    var minutos = <?php echo $this->data['minutos']; ?>;
    var segundos = <?php echo $this->data['segundos']; ?>;


    $.timer(1000, function() {


        if (minutos == 60) {

            minutos = 0;
            horas += 1;
            $("#horas").html(minutos + ":");
        }

        if (segundos == 60) {

            segundos = 0;
            minutos += 1;
            $("#minutos").html(minutos + ":");
        }
        else
        {

            segundos += 1;

            $("#segundos").html(segundos);
        }


    });

    $("#horas").html(horas + ":");
    $("#minutos").html(minutos + ":");
    $("#segundos").html(segundos + "  ");


    $("#dataclick1").click(function(e) {



        e.preventDefault();



        $("#fecha_salida").datepicker("show");



    });

    $("#dataclick2").click(function(e) {



        e.preventDefault();



        $("#fecha_retorno").datepicker("show");



    });
</script>