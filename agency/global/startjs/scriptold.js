$(document).ready(function(){
        // $('.tlt').textillate();
  var nuevoCSS = { "background": '#C4C4C4', "font-weight" : 'bold' };
  $('[data-toggle="tooltip"]').tooltip()
  $('#btnmandar').prop('disabled', true);
  $("#btnmandar").addClass("er-btn-desabled");
  $("#opcstate").hide();
  $("#msjwhy1").hide();
  $("#msjwhy2").hide();

  $("#whysend").show();

//   $('#btnmandar').prop('title', 'debes aceptar los terminos');
  
  $("#name").keyup(function(){
      var valname = $("#name").val();
      $("#passname").val(valname);
  });
  $("#lastname").keyup(function(){
    var vallast = $("#lastname").val();
    $("#passlast").val(vallast);
});


// CHECKBOX DE TERMINOS Y CONDICIONES SI NO LO ACTIVA NO DEJARA MANDAR FORMULARIO
$('#condiciones').click(function(){
    var email1 = $("#email1").val();
    var email2 = $("#email2").val();
    var cond = $('#condiciones').prop('checked');
    console.log(email1 + " - " + email2 +" - "+ cond);
    
    if (email1 == email2 && cond == true) 
    {
        $("#btnmandar").removeClass("er-btn-desabled");
        $("#btnmandar").addClass("er-btn-default");
        $('#btnmandar').removeAttr('disabled',false);
    }
    else
    {
        $("#btnmandar").removeClass("er-btn-default");
        $("#btnmandar").addClass("er-btn-desabled");
        $('#btnmandar').prop('disabled', true);
    }
})

// VALIDACION DE EMAIL SIMILARES SI NO ESTAN IGUALES NO DEJARA MANDAR FORMULARIO
$("#email2").blur(function(){
    var email1 = $("#email1").val();
    var email2 = $("#email2").val();
    var cond = $('#condiciones').prop('checked');
    console.log(email1 + " - " + email2 +" - "+ cond);
    
    if (email2 != "") {
        if (email1 == email2) {
            $("#email2").removeClass("form-control is-invalid");
            $("#email2").addClass("form-control");
        }else{
            $("#email2").removeClass("form-control");
            $("#email2").addClass("form-control is-invalid");
        }
        if (email1 == email2 && cond == true) 
        {
            $("#btnmandar").removeClass("er-btn-desabled");
            $("#btnmandar").addClass("er-btn-default");
            $('#btnmandar').removeAttr('disabled',false);
        }
        else
        {
            $("#btnmandar").removeClass("er-btn-default");
            $("#btnmandar").addClass("er-btn-desabled");
            $('#btnmandar').prop('disabled', true);
        }
    }
});
$("#email1").blur(function(){
    var email1 = $("#email1").val();
    var email2 = $("#email2").val();
    console.log(email2);
    
    if (email1 != "") {
        if (email1 == email2) {
            $("#email2").removeClass("form-control is-invalid");
            $("#email2").addClass("form-control");
        }else{
            $("#email2").removeClass("form-control");
            $("#email2").addClass("form-control is-invalid");
        }
        if (email1 == email2 && cond == true) 
        {
            $("#btnmandar").removeClass("er-btn-desabled");
            $("#btnmandar").addClass("er-btn-default");
            $('#btnmandar').removeAttr('disabled',false);
        }
        else
        {
            $("#btnmandar").removeClass("er-btn-default");
            $("#btnmandar").addClass("er-btn-desabled");
            $('#btnmandar').prop('disabled', true);
        }
    }
});

$("#inputcountry").change(function(){
    var combo1 = $("#inputcountry").val();
    var valor = $("#inputcountry option:selected").html();
    $("#countryval").val(valor);
    if (combo1 == 51) {
        $("#opcstate").show();
    }else{
        $("#opcstate").hide();
        $("#stateval").val("OTHER");
    }
})

$("#inputState").change(function(){
    var combo2 = $("#inputState").val();
    var valor = $("#inputState option:selected").html();
    if (combo2 == "") {
        $("#stateval").val("OTHER");
    }else{
        $("#stateval").val(valor);
    }
})

$("#whysend").click(function(){
    var email1 = $("#email1").val();
    var email2 = $("#email2").val();
    var cond = $('#condiciones').prop('checked');
    console.log(email1 + " - " + email2 +" - "+ cond);
    
   
        if (email1 != email2 || email1 == "" || email2== "") {
           document.getElementById("msjwhy1").innerHTML= "The emails should be same";
           $("#msjwhy1").show();
        }else{
            $("#msjwhy1").hide();
        }
        if (cond == false) {
             document.getElementById("msjwhy2").innerHTML= "accept the terms of service";
        $("#msjwhy2").show();
        }else{
            $("#msjwhy2").hide();
        }
})

});