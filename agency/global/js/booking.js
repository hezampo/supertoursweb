$(document).ready(function() {
    $('#pax2').focus(function() {
        if ($(this).val() == '') {
            $(this).val('0');
        }
    });

    $('#pax').focus(function() {
        if ($(this).val() == '') {
            $(this).val('1');
        }
    });
    $('#btn-search').hover(function() {
        if ($('#pax').val() == '') {
            $('#pax').val('1');
        }
        if ($('#pax2').val() == '') {
            $('#pax2').val('0');
        }
    });
});

$(function() {
    var returning = function() {
        var ticket = $("input[name='tipo_ticket']:checked").attr('value');
        if (ticket == "oneway") {
            $("#dv_fr").hide();
            $("#dv_fr1").hide();
            $("#dv_fr2").css("opacity", 0);
            $("#fecha_retorno").val("");
        } else {
            $("#dv_fr").show();
            $("#dv_fr1").show();
            $("#dv_fr2").css("opacity", 1);
        }
    }

    returning();
    
    function restar(dia1, mes1, ano1, dia2, mes2, ano2)
    {
        fecha1 = new Date(ano1, mes1 - 1, dia1);
        fecha2 = new Date(ano2, mes2 - 1, dia2);
        var resta = (fecha2 - fecha1) / 1000 / 3600 / 24;
        return resta;
        
    }
    var f=new Date();
    var dato = restar(26, 5, 2016, f.getDate(), f.getMonth(), f.getFullYear());
    // $('#fecha_salida').datepicker(
    //         {
    //             dateFormat: 'mm-dd-yy',
    //            // maxDate: 188 - dato,
    //             minDate: 0
    //         }
    // );


    // $('#fecha_retorno').datepicker(
    //         {
    //             dateFormat: 'mm-dd-yy',
    //            // maxDate: 188 - dato,
    //             minDate: 0
    //         }
    // );

    $("#ow").click(returning);
    $("#rd").click(returning);
    $("#btn-search").click(function() {

        var ticket = $("input[name='tipo_ticket']:checked").attr('value');

        var d1 = new Date($('#fecha_salida').val());
        var d2 = new Date($('#fecha_retorno').val());
        var pax = parseInt($("#pax").val());
        var pax2 = parseInt($("#pax2").val());

        var msg = "";

        if ($("#from").val() == "") {
            msg += "The field From is required\n";
        }

        if ($("#to").val() == "") {
            msg += "The field To is required\n";
        }

        if ($("#fecha_salida").val() == "") {
            msg += "The field Departing is required\n";
        }

        if (ticket == "roundtrip") {
            if ($("#fecha_retorno").val() == "") {
                msg += "The field Returning is required\n";
            }
        }

        if (isNaN(pax)) {
            msg += "The field Passengers must be numeric\n";
        } else if (pax == 0) {
            msg += "the field Passenger must be greater than 0\n";
        }

        if (isNaN(pax2)) {
            msg += "The field Passengers must be numeric\n";
        }



        if (d2.getTime() < d1.getTime()) {
            msg += "The return date must be less than or equal to the departure date\n";
        }

        if (msg != "") {
            alert(msg);
            return false;
        }

        return true;

    })

})

function Validar(Cadena) {
    var Fecha = new String(Cadena)
    var RealFecha = new Date()
    // Cadena Año
    var Ano = new String(Fecha.substring(Fecha.length, Fecha.lastIndexOf("-") + 1))
    // Cadena Mes
    var Mes = new String(Fecha.substring(0, Fecha.indexOf("-")))
    // Cadena Día
    var Dia = new String(Fecha.substring(Fecha.indexOf("-") + 1, Fecha.lastIndexOf("-")))
    if (Ano == '' || Dia == '' || Mes == '') {
        return false;
    }
    // Valido el año
    if (isNaN(Ano) || Ano.length < 4 || parseFloat(Ano) < 1900) {
        return false
    }
    // Valido el Mes
    if (isNaN(Mes) || parseFloat(Mes) < 1 || parseFloat(Mes) > 12) {
        return false
    }
    // Valido el Dia
    if (isNaN(Dia) || parseInt(Dia, 10) < 1 || parseInt(Dia, 10) > 31) {
        return false
    }
    if (Mes == 4 || Mes == 6 || Mes == 9 || Mes == 11 || Mes == 2) {
        if (Mes != 2 && Dia > 30) {
            return false
        }
        if (Mes == 2 && Dia > 28 && Ano % 4 != 0) {
            return false
        }
        if (Mes == 2 && Dia > 29 && Ano % 4 == 0) {
            return false
        }
    }
    return true
}