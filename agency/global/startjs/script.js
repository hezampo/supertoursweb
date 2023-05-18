$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip()
    $('#btnmandar').prop('disabled', true);
    var valor = $("#inputState option:selected").html();
    var valor2 = $("#inputcountry option:selected").html();
if (valor == 'Choose...') {
    var st = 'OTHERS';
}else{
    var st = valor;
}
$("#stat").val(st);
    var count = $("#inputcountry").val();
    console.log('valor : '+st );
        if (count && count == 248 ||count && count == '' ) {
    console.log("hola1");
            $('#count').val('UNITED STATES');
            $("#inputState").css({"background-color": "white","color": "black"});
            // document.getElementById("requizip").innerText = "*";
            // document.getElementById("requistate").innerText = "*";
            $( "#requizip" ).html( "*" );
            $( "#requistate" ).html( "*" );
            $('#zip').prop('required', true);
            $('#inputState').prop('disabled', false);
            $('#inputState').prop('required', true);
        }else{
            $('#count').val(valor2);
    console.log("hola2" );
            $("#inputState").css({"background-color": "#BDBDBD","color": "#DACDCD"});
            // document.getElementById("requizip").innerText = "";
            // document.getElementById("requistate").innerText = "";
            $( "#requizip" ).html( "" );
            $( "#requistate" ).html( "" );
            $('#inputState').val(9);
            $('#zip').prop('required', false);
            $('#inputState').prop('disabled', true);
            $('#inputState').prop('required', false);
        }
    console.log(count);

    // $("#inputState").val(9);

    $("#opcstate").show();
    $('#inputState').prop('required', true);
    $('#phone').mask('(000) 000-0000',{placeholder: "(xxx) xxx-xxxx"});



    // VALIDACION DE REPEATEMAIL SIMILARES SI NO ESTAN IGUALES NO DEJARA MANDAR FORMULARIO
    $("#email2").keyup(function(){
        var email1 = $("#email1").val();
        var email2 = $("#email2").val();
        var cond = $('#condiciones').prop('checked');
        console.log(email1 + " - " + email2 +" - "+ cond);

        if (email2 != "" || email2 != undefined) {
            if (email1.toLowerCase() == email2.toLowerCase()) {
                $("#email2").removeClass("form-control is-invalid");
                $("#email2").addClass("form-control");
            }else{
                $("#condiciones2").removeAttr('checked');
                $('#btnmandar').removeAttr('disabled',false);
                $('#btnmandar').prop('disabled', true);
                $("#email2").removeClass("form-control");
                $("#email2").addClass("form-control is-invalid");
            }
        }
    });
    
    $("#email1").keyup(function(){
        var email1 = $("#email1").val();
        var email2 = $("#email2").val();
        var cond = $('#condiciones2').prop('checked');

        if (email1 != "" || email1 != undefined) {
            if (email1.toLowerCase() == email2.toLowerCase()) {
                $("#email2").removeClass("form-control is-invalid");
                $("#email2").addClass("form-control");
            }else{
                $("#condiciones2").removeAttr('checked');
                $('#btnmandar').removeAttr('disabled',false);
                $('#btnmandar').prop('disabled', true);
                $("#email2").removeClass("form-control");
                $("#email2").addClass("form-control is-invalid");
            }
        }
    });
    

    // "VIGILANTE" SIRVE PARA ASEGURARSE DE QUE ODOS LOS CAMPOS ESTEN LLENOS SI ENCUENTRA ALGUNO VACIO SE DESACTIVA EL BOTON Y EL CHECKBOX (zip state los valido mas abajo ya que llevan otra logica)
    $(".vigilante").keyup(function(){
        var name = $('#name').val();
        var lastname = $('#lastname').val();
        var phone = $('#phone').val();
        var email1 = $('#email1').val();
        var email2 = $('#email2').val();
        var adress = $('#adress').val();
        var city = $('#city').val();
        var State = $('#inputState').val();
        var country = $('#inputcountry').val();
        var zip = $('#zip').val();
        var cond = $('#condiciones2').prop('checked');


        if (email1.toLowerCase() == email2.toLowerCase() && email1 != "" && email2 != "" && cond == true && name != "" && lastname != "" && phone != "" && adress != "" && city != "" && zip != "" && State != "lleno" && country == 248 || cond == true && email1.toLowerCase() == email2.toLowerCase() && email1 != "" && email2 != ""  && name != "" && lastname != "" && phone != "" && adress != "" && city != "" && country != 248){
            $('#btnmandar').removeAttr('disabled',false);
        }else{
            $("#condiciones2").removeAttr('checked');
            $('#btnmandar').prop('disabled', true);
        }
    })

// VALIDACION DEL INPUT DE ZIP SI EL PAIS SELECCIONADO ES CON EL ID 248 (estados unidos) ENOTNCES NO PUEDE IR VACIO SI ES OTRO PAIS SI PUEDE
    $('#zip').keyup(function(){
        var zip = $('#zip').val();
        var State = $('#inputState').val();
        var country = $('#inputcountry').val();
        var cond = $('#condiciones2').prop('checked');
        console.debug(zip+" - "+State+" - "+country);
        if ( country == 248 && State == '' && zip ==''  || country == 248 && State ==null && zip ==null ) {
            $("#condiciones2").removeAttr('checked');
            $('#btnmandar').prop('disabled', true);
        }else{
            console.debug(country+" - "+State+" - "+zip+"cond: "+cond);
            if (country == 248 && State != '' && zip != '' && cond == true) {
                $('#btnmandar').prop('disabled', false);
            }else{
                $("#condiciones2").removeAttr('checked');
            $('#btnmandar').prop('disabled', true);
            }
        }
    })

// VALIDACION DEL SELECT DE ESTADO SI EL PAIS SELECCIONADO ES CON EL ID 248 (estados unidos) ENOTNCES NO PUEDE IR VACIO SI ES OTRO PAIS SI PUEDE
    $("#inputState").change(function(){
        var zip = $('#zip').val();
        var State = $('#inputState').val();
        var country = $('#inputcountry').val();
        var cond = $('#condiciones2').prop('checked');
        console.debug(zip+" - "+State+" - "+country);
        if ( country == 248 && State == '' && zip ==''  || country == 248 && State ==null && zip ==null ) {
            $("#condiciones2").removeAttr('checked');
            $('#btnmandar').prop('disabled', true);
        }else{
            if (country == 248 && State != '' && zip != '' && cond == true) {
                $('#btnmandar').prop('disabled', false);
            }else{
            $("#condiciones2").removeAttr('checked');
            $('#btnmandar').prop('disabled', true);
            }
        }
    })

// CHECKBOX DE TERMINOS Y CONDICIONES SI NO LO ACTIVA NO DEJARA MANDAR FORMULARIO
    $("#condiciones2").click(function(){
        var name = $('#name').val();
        var lastname = $('#lastname').val();
        var phone = $('#phone').val();
        var email1 = $('#email1').val();
        var email2 = $('#email2').val();
        var adress = $('#adress').val();
        var city = $('#city').val();
        var State = $('#inputState').val();
        var country = $('#inputcountry').val();
        var zip = $('#zip').val();
        var cond2 = $('#condiciones2').prop('checked');

        var card_number = $('#ssl_card_number').val();
        var cvv = $('#ssl_cvv2cvc2').val();
        var exp_date = $('#ssl_exp_date').val();
        var typecard = $('#typecard').val();


        console.log("email1:"+email1 + ", email2:"+email2 +", Condicion"+ cond2+", name:"+name+", lastname:"+lastname+", phone:"+phone+", adress:"+adress+", city:"+city+", estado:"+State+", country:"+country+", zip:"+zip);

        if (email1 != "") {
            $("#email1").removeClass("form-control mayusChar is-invalid");
            $("#email1").addClass("form-control mayusChar");
        }else{
            $("#email1").removeClass("form-control mayusChar");
            $("#email1").addClass("form-control mayusChar is-invalid");
        }
        if (email1.toLowerCase() == email2.toLowerCase()) {
            $("#email2").removeClass("form-control mayusChar is-invalid");
            $("#email2").addClass("form-control mayusChar");
        }else{
            $("#email2").removeClass("form-control mayusChar");
            $("#email2").addClass("form-control mayusChar is-invalid");
        }

        if (email2 != "") {
            $("#email2").removeClass("form-control mayusChar is-invalid");
            $("#email2").addClass("form-control mayusChar");
        }else{
            $("#email2").removeClass("form-control mayusChar");
            $("#email2").addClass("form-control mayusChar is-invalid");
        }

        if (name != "") {
            $("#name").removeClass("form-control mayusChar is-invalid");
            $("#name").addClass("form-control mayusChar");
        }else{
            $("#name").removeClass("form-control mayusChar");
            $("#name").addClass("form-control mayusChar is-invalid");
        }

        if (lastname != "") {
            $("#lastname").removeClass("form-control mayusChar is-invalid");
            $("#lastname").addClass("form-control mayusChar");
        }else{
            $("#lastname").removeClass("form-control mayusChar");
            $("#lastname").addClass("form-control mayusChar is-invalid");
        }
        
        if (phone != "") {
            $("#phone").removeClass("form-control mayusChar is-invalid");
            $("#phone").addClass("form-control mayusChar");
        }else{
            $("#phone").removeClass("form-control mayusChar");
            $("#phone").addClass("form-control mayusChar is-invalid");
        }

        if (adress != "") {
            $("#adress").removeClass("form-control mayusChar is-invalid");
            $("#adress").addClass("form-control mayusChar");
        }else{
            $("#adress").removeClass("form-control mayusChar");
            $("#adress").addClass("form-control mayusChar is-invalid");
        }

        if (city != "") {
            $("#city").removeClass("form-control is-invalid");
            $("#city").addClass("form-control");
        }else{
            $("#city").removeClass("form-control ");
            $("#city").addClass("form-control  is-invalid");
        }

        if (State == "" && country==248 || State == "" && country=="") {
            $("#inputState").removeClass("form-control mayusChar");
            $("#inputState").addClass("form-control mayusChar is-invalid");
        }else{
            $("#inputState").removeClass("form-control mayusChar is-invalid");
            $("#inputState").addClass("form-control mayusChar");
        }

        if (zip == "" && country==248 || zip == "" && country=="") {
            $("#zip").removeClass("form-control");
            $("#zip").addClass("form-control is-invalid");
        }else{
            $("#zip").removeClass("form-control is-invalid");
            $("#zip").addClass("form-control");
        }
        
        if (country != "" ) {
            $("#inputcountry").removeClass("form-control mayusChar is-invalid");
            $("#inputcountry").addClass("form-control mayusChar");
        }else{
            $("#inputcountry").removeClass("form-control mayusChar");
            $("#inputcountry").addClass("form-control mayusChar is-invalid");
        }

        if (card_number != "" ) {
            $("#ssl_card_number").removeClass("form-control mayusChar is-invalid");
            $("#ssl_card_number").addClass("form-control mayusChar");
        }else{
            $("#ssl_card_number").removeClass("form-control mayusChar");
            $("#ssl_card_number").addClass("form-control mayusChar is-invalid");
        }

        if (typecard != "" ) {
            $("#ssl_card_number").removeClass("form-control mayusChar is-invalid");
            $("#ssl_card_number").addClass("form-control mayusChar");
        }else{
            $("#ssl_card_number").removeClass("form-control mayusChar");
            $("#ssl_card_number").addClass("form-control mayusChar is-invalid");
        }

        if (cvv != "" ) {
            $("#ssl_cvv2cvc2").removeClass("form-control inputs-card-pago-class is-invalid");
            $("#ssl_cvv2cvc2").addClass("form-control inputs-card-pago-class");
        }else{
            $("#ssl_cvv2cvc2").removeClass("form-control inputs-card-pago-class");
            $("#ssl_cvv2cvc2").addClass("form-control inputs-card-pago-class is-invalid");
        }

        if (exp_date != "" ) {
            $("#ssl_exp_date").removeClass("form-control inputs-card-pago-class is-invalid");
            $("#ssl_exp_date").addClass("form-control inputs-card-pago-class");
        }else{
            $("#ssl_exp_date").removeClass("form-control inputs-card-pago-class");
            $("#ssl_exp_date").addClass("form-control inputs-card-pago-class is-invalid");
        }

        var statett =(State == "")?  'vacio' :  'lleno' ;
        var ziptt =(zip == "")?  'vacio' :  'lleno' ;
        console.log(statett+" - "+ziptt);


        if (typecard!= "" && card_number!="" && cvv!= "" && exp_date!= '' && email1.toLowerCase() == email2.toLowerCase() && email1 != "" && email2 != ""  && name != "" && lastname != "" && phone != "" && adress != "" && city != "" && ziptt == "lleno" && statett == "lleno" && country == 248 || typecard!="" && card_number!="" && cvv!= "" && exp_date!= '' && email1.toLowerCase() == email2.toLowerCase() && email1 != "" && email2 != ""  && name != "" && lastname != "" && phone != "" && adress != "" && city != "" && country != 248){
            $("#ssl_card_number").removeClass("form-control mayusChar is-invalid");
            $("#ssl_card_number").addClass("form-control mayusChar");

            $("#ssl_cvv2cvc2").removeClass("form-control inputs-card-pago-class is-invalid");
            $("#ssl_cvv2cvc2").addClass("form-control inputs-card-pago-class");

            $("#ssl_exp_date").removeClass("form-control inputs-card-pago-class is-invalid");
            $("#ssl_exp_date").addClass("form-control inputs-card-pago-class");

            $("#email1").removeClass("form-control mayusChar is-invalid");
            $("#email1").addClass("form-control mayusChar");
            
            $("#email2").removeClass("form-control mayusChar is-invalid");
            $("#email2").addClass("form-control mayusChar");
            
            $("#email2").removeClass("form-control mayusChar is-invalid");
            $("#email2").addClass("form-control mayusChar");
            
            $("#name").removeClass("form-control mayusChar is-invalid");
            $("#name").addClass("form-control mayusChar");
            
            $("#lastname").removeClass("form-control mayusChar is-invalid");
            $("#lastname").addClass("form-control mayusChar");
            
            $("#phone").removeClass("form-control mayusChar is-invalid");
            $("#phone").addClass("form-control mayusChar");
            
            $("#adress").removeClass("form-control mayusChar is-invalid");
            $("#adress").addClass("form-control mayusChar");
            
            $("#city").removeClass("form-control is-invalid");
            $("#city").addClass("form-control");
            
            $("#inputState").removeClass("form-control mayusChar is-invalid");
            $("#inputState").addClass("form-control mayusChar");
            
            $("#zip").removeClass("form-control is-invalid");
            $("#zip").addClass("form-control");

            $("#inputcountry").removeClass("form-control mayusChar is-invalid");
            $("#inputcountry").addClass("form-control mayusChar");

            console.log("si");
            if (cond2 == true) {
                $('#btnmandar').prop('disabled', false);
            }else{
                $('#btnmandar').prop('disabled', true);
            }

        }else{
            //!="" && ccv!= "" && exp_date!= ''
            // PARTE QUE SE DESACTIVA EL BOTON Y MUESTRA LOS MENSAJES DE LOS CAMPOS QUE SE DEBEN RELLENAR
            var msj1 = (email1 == "")? '<li>The Email Is required</li>':'<li></li>';
            var msj2 = (email2 == "")? '<li>The confirm Email Is required</li>':'<li></li>';
            var msj4 =(name == "")? '<li>The name Is required</li>':'<li></li>';
            var msj5 =(lastname == "")? '<li>The last name Is required</li>':'<li></li>';
            var msj6 =(phone == "")? '<li>The phone Is required</li>':'<li></li>';
            var msj7 =(adress == "")? '<li>The adress Is required</li>':'<li></li>';
            var msj8 =(city == "")? '<li>The city Is required</li>':'<li></li>';
            var msj9 =(country == "")? '<li>The country Is required</li>':'<li></li>';
            var msj10 =(zip == "" && country==248 || zip == "" && country=="")? '<li>The zip Is required</li>':'<li></li>';
            var msj11 =(State == "" && country==248 || State == "" && country=="")? '<li>The State Is required</li>':'<li></li>';
            var msj12 =(email1.toLowerCase() != email2.toLowerCase())? '<li>The email should be same</li>':'<li></li>';
            var msj13 =(card_number == "" )? '<li>The Credit Card Number Is required</li>':'<li></li>';
            var msj14 =(cvv == "")? '<li>The cvv Code Is Required</li>':'<li></li>';
            var msj15 =(exp_date == "")? '<li>The Expiration Date Is Required</li>':'<li></li>';
            var msj16 =(typecard == "" )? '<li>The Credit Card Is not valid, credit card available: visa / mastercard / american Express / Discover</li>':'<li></li>';

            new Toast({
                message: '<small><ol>'+msj4+msj5+msj6+msj1+msj2+msj7+msj8+msj9+msj11+msj10+msj12+msj13+msj14+msj15+msj16+'</ol></small>',
                type: 'danger',
                position:'top'
            });
            console.log("sino");
            $("#condiciones2").removeAttr('checked');
            $('#btnmandar').prop('disabled', true);
        }

    })

    new Cleave('.credit', {
		creditCard:true,
		delimiter:' ',
		onCreditCardTypeChanged : function(info){
            console.log('.fa-cc-'+info);
            if (info === 'unknown') {
                $('#typecard').val(null);
                $("#condiciones2").removeAttr('checked');
                $('#btnmandar').prop('disabled', true);
            }
            if (info != 'visa' &&  info != 'amex' && info != 'mastercard' && info != 'discover') {
                document.getElementById("typecard").value = null;
                // $('#typecard').val(null);
                $("#condiciones2").removeAttr('checked');
                $('#btnmandar').prop('disabled', true);
            }
			if (info === 'visa') {
                // $('.fa-cc-visa').addClass('active');
                document.querySelector('.fa-cc-visa').classList.add('active');
                document.getElementById("typecard").value = 1;
                // $('#typecard').val(1);
			}else{
                $("#condiciones2").removeAttr('checked');
                $('#btnmandar').prop('disabled', true);
				// $('.fa-cc-visa').removeClass('active');
				document.querySelector('.fa-cc-visa').classList.remove('active');
            }
            
			if (info === 'amex') {
                document.querySelector('.fa-cc-amex').classList.add('active');
                document.getElementById("typecard").value = 9;
                // $('#typecard').val(9);
				// $('.fa-cc-amex').addClass('active');
			}else{
				document.querySelector('.fa-cc-amex').classList.remove('active');
                $("#condiciones2").removeAttr('checked');
                $('#btnmandar').prop('disabled', true);
				// $('.fa-cc-amex').removeClass('active');
            }

			if (info === 'mastercard') {
                document.querySelector('.fa-cc-mastercard').classList.add('active');
                document.getElementById("typecard").value = 9;
                // $('#typecard').val(9);
				// $('.fa-cc-mastercard').addClass('active');
			}else{
				document.querySelector('.fa-cc-mastercard').classList.remove('active');
                $("#condiciones2").removeAttr('checked');
                $('#btnmandar').prop('disabled', true);
				// $('.fa-cc-mastercard').removeClass('active');
            }

            if (info === 'discover') {
                document.querySelector('.fa-cc-discover').classList.add('active');
                document.getElementById("typecard").value = 9;
                // $('#typecard').val(9);
				// $('.fa-cc-discover').addClass('active');
			}else{
				document.querySelector('.fa-cc-discover').classList.remove('active');
                $("#condiciones2").removeAttr('checked');
                $('#btnmandar').prop('disabled', true);
				// $('.fa-cc-discover').removeClass('active');
            }
            
		}
	});


    $('#condiciones').click(function(){
        var email1 = $("#email1").val();
        var email2 = $("#email2").val();
        var cond = $('#condiciones').prop('checked');
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

    $('#whysend2').click(function(){
        var cond = $('#condiciones2').prop('checked');
        if (cond == false) {
            document.getElementById("msjwhy2").innerHTML= "accept the terms of service";
            $("#msjwhy2").show();
        }else{
            $("#msjwhy2").hide();
        }
    })

    $("#whysend").click(function(){
        var email1 = $("#email1").val();
        var email2 = $("#email2").val();
        var name = $("#name").val();
        var lastname = $("#lastname").val();
        var inputcountry = $("#inputcountry").val();
        var city = $("#city").val();
        var cond = $('#condiciones2').prop('checked');

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

        if (inputcountry== "") {
            document.getElementById("msjwhy6").innerHTML= "The country is required";
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
    })

    $("#inputcountry").change(function(){
        var combo1 = $("#inputcountry").val(); //COUNTRY
        var valor = $("#inputcountry option:selected").html();
        var valor2 = $("#inputState option:selected").html();
        var State = $('#inputState').val();
        var zip = $('#zip').val();
        var cond = $('#condiciones2').prop('checked');
        // $("#countryval").val(valor);
        console.log(combo1);
        $("#count").val(valor);
        if (combo1 == 248  ) {
            $("#stat").val(valor2);
            
            $("#inputState").css({"background-color": "white","color": "black"});
            document.getElementById("requizip").innerText = "*";
            document.getElementById("requistate").innerText = "*";
            $('#zip').prop('required', true);
            $('#inputState').prop('disabled', false);
            $('#inputState').prop('required', true);
        }else{
            $("#stat").val("OTHERS");
            $("#inputState").css({"background-color": "#BDBDBD","color": "#DACDCD"});
            document.getElementById("requizip").innerText = "";
            document.getElementById("requistate").innerText = "";
            // $('#inputState').val(9);
            $('#zip').prop('required', false);
            $('#inputState').prop('disabled', true);
            $('#inputState').prop('required', false);
        }

        if (combo1 == 248 && zip == '' && State =='' || combo1 == 248 && zip == null && State ==null  ) {
            $("#condiciones2").removeAttr('checked');
            $('#btnmandar').prop('disabled', true);
        }else {
            if (zip == '' && State =='' && cond == true){
                $('#btnmandar').prop('disabled', false);
            }else{
                $("#condiciones2").removeAttr('checked');
                $('#btnmandar').prop('disabled', true);
            }
        }
    })

    $("#inputState").change(function(){
        var combo2 = $("#inputState").val();
        var valor = $("#inputState option:selected").html();
        if (combo2 == "") {
            $("#stat").val("OTHERS");
        }else{
            $("#stat").val(valor);
        }
        console.log(valor);
        
    })

});

