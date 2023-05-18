$(document).ready(function(){
        // $('.tlt').textillate();
  $('[data-toggle="tooltip"]').tooltip()
  $('#btnmandar').prop('disabled', true);
  $("#btnmandar").addClass("er-btn-desabled");
  $("#opcstate").hide();
  $("#msjwhy1").hide();
  $("#msjwhy2").hide();
  $("#msjwhy3").hide();
  $("#msjwhy4").hide();
  $("#msjwhy5").hide();
  $("#whysend").show();
  $("#inputcountry").val(51);
  $("#opcstate").show();
  $('#inputState').prop('required', true);

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
    
    if (email1.toLowerCase() == email2.toLowerCase() && cond == true && email1.toLowerCase() != "" && email2.toLowerCase() != "") 
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

// VALIDACION DE REPEATEMAIL SIMILARES SI NO ESTAN IGUALES NO DEJARA MANDAR FORMULARIO
$("#email2").keyup(function(){
    var email1 = $("#email1").val();
    var email2 = $("#email2").val();
    var cond = $('#condiciones').prop('checked');
    console.log(email1 + " - " + email2 +" - "+ cond);
    
    if (email2 != "" ) {
        if (email1.toLowerCase() == email2.toLowerCase()) {
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

$("#email1").keyup(function(){
    var email1 = $("#email1").val();
    var email2 = $("#email2").val();
    var cond = $('#condiciones').prop('checked');
    console.log(email1 + " - " + email2 +" - "+ cond);
    
    if (email1 != "") {
        if (email1.toLowerCase() == email2.toLowerCase()) {
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
        $('#inputState').prop('required', true);
    }else{
        $("#opcstate").hide();
        $("#stateval").val("OTHER");
        $('#inputState').prop('required', false);
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
    var name = $("#name").val();
    var lastname = $("#lastname").val();
    var city = $("#city").val();
    console.log(city);
    var cond = $('#condiciones').prop('checked');
    console.log(email1 + " - " + email2 +" - "+ cond);
    
   
        if (email1 != email2 || email1 == "" || email2== "") {
           document.getElementById("msjwhy1").innerHTML= "The emails should be same";
           $("#msjwhy1").show();
        }else{
            $("#msjwhy1").hide();
        }
        if (name== "") {
            document.getElementById("msjwhy3").innerHTML= "The name is required";
            $("#msjwhy3").show();
         }else{
             $("#msjwhy3").hide();
         }

         if (lastname== "") {
            document.getElementById("msjwhy4").innerHTML= "The last name is required";
            $("#msjwhy4").show();
         }else{
             $("#msjwhy4").hide();
         }

         if (city== "") {
            document.getElementById("msjwhy5").innerHTML= "The city is required";
            $("#msjwhy5").show();
         }else{
             $("#msjwhy5").hide();
         }

        if (cond == false) {
             document.getElementById("msjwhy2").innerHTML= "accept the terms of service";
        $("#msjwhy2").show();
        }else{
            $("#msjwhy2").hide();
        }


            $('#phone').mask();
})

// BOTON UP
// var btn = $('#up').val();

// $(window).scroll(function(){
//     if ($(wondow).scrollTop()>300) {
//         $("#up").addClass("show");
//     }else{
//         $("#up").removeClass("show");
//     }
// })

// $("#up").click(function(e){
//     $('html, body').animate({scrollTop:0},'300');
// })
setInterval( function(){
    // alert();
    if ($('#headingTwo').hasClass('animated pulse')) {
        $("#headingTwo").removeClass("animated pulse");
    }else{
        $("#headingTwo").addClass("animated pulse");
    }
}, 3000);

// $.ajax({
//     method:"POST",
//     url: "a.php",
//     data:{ id: info }
// })

// $("#btnguest").click(function(){
//     alert();

// })

// $("#btnfill").click(function(){
//     var input = [];
// console.log("HOLA MUNDO");
// document.getElementById("hey").innerHTML = "HEY";
// });

$("#emailpass").keyup(function(){
    var emailpass = $("#emailpass").val();
    console.log(emailpass.toLowerCase());
})

});

// function btnguest(){
//     $.ajax({
//     method:"POST",
//     url: "<?php echo $data['rootUrl']; ?>booking/pickup-dropoff/autentication/guest",
//     beforeSend: function(){
//         console.log("mandando...");
//     }
//     }).done(function(data){
//         console.log("REDIRECCIONADO");
//     })
// }

// $.ajax({
//     url: "<?php echo $data['rootUrl'] ?>recover/recoverPass/"+remember,
//     method: "POST",
//     beforeSend: function () {
//         $("#recover").html("");
//     }
// }).done(function(data) {
//     $("#recover").html("");
// })
// console.log("Correo Correcto");
// document.getElementById("remberEmailt1").value = "";


// var input = [];
// function addfill(){
//     var fill = input.push([{}]);
//         while (fill < 5) {
    
//             document.getElementById("saludo").innerHTML = 'HOLA';
//         }
//     console.log(fill);
    
// }