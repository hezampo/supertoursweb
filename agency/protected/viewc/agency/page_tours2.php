<div id="tike" >  

    <table width="100%" border="0" cellpadding="10">
        <tr>
            <td width="54%"  valign="top" ><br />
                <div ><a  onclick="abrirVentanao();" style="cursor: pointer;" target="framename" ><img src="<?php echo $data['rootUrl']; ?>global/images/reserve-online.jpg" alt="Reserve Online" width="230px" border="0"/></a></div>
                <div><img src="<?php echo $data['rootUrl']; ?>global/images/verified.jpg"  width="230px" alt="Reserve Online" border="0"/></div>
        </tr>
    </table>

</div>
<div id="mres"> <div id="center-column" >

        <div id="filter-bar">
            <form name="agencia" method="post" action="<?php echo $data['rootUrl']; ?>agency/mytours/#tours"  class="form" id="form1">


                <select name="filtro" id="filtro" class="select2">
                    <option value="fecha_ini" <?php echo $data["filtro"] == 'fecha_ini' ? 'selected' : '' ?>>Date</option>
                    <option value="codconf" <?php echo $data["filtro"] == 'code_conf' ? 'selected' : '' ?>>Code</option>
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
                            <td><?php echo $e['code_conf']; ?></td>
                            <td><?php echo $e['tipo_ticket']; ?></td>
                            <td><?php echo date("M-d-Y", strtotime($e['fecha_salida'])); ?></td>
                            <td><?php echo $e['firsname'] . " " . $e['lasname']; ?></td>
                            <td><?php echo $e['firstname'] . " " . $e['lastname']; ?></td>
                         <!-- <td><div align="right"><?php echo "<a href='#ajaxs' onclick='ajaxs(" . $e['id'] . ");' >View</a>"; ?></div></td> -->
                            <td><div align="right"><?php echo "<a href=" . $data['rootUrl'] . "agency/ajaxsOneTours/" . $e['id'] . " ><img src=\"" . $data['rootUrl'] . "global/images/pdf.png\" /></a>"; ?></div></td>  
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
            <?php echo $data['pager']; ?>
        </div> 

        <p>&nbsp;</p>
        <p align="center" class="titulopago"><br />
        </p>     
    </div>    
</div>
<script type="text/javascript">
    $("#tours2 .paginate,#tours2 .next,#tours2 .prev").click(function() {
        $("#tours2").load(encodeURI($(this).attr('href')));
        return false;
    });
   ventana_secundaria = "";
    function abrirVentanao() {
//guardo la referencia de la ventana para poder utilizarla luego
        cerrarVentana();
        ventana_secundaria = window.open("<?php echo $data['rootUrl']; ?>one-day-tour");
    }
    function cerrarVentana() {
//la referencia de la ventana es el objeto window del popup. Lo utilizo para acceder al método close 
       
        if(ventana_secundaria != ""){
            ventana_secundaria.close();
        }
        
    }
</script>

