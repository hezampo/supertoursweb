<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
 <link type="text/css" href="/astorbr-re/add/js/jquery/themes/ui-lightness/ui.all.css" rel="stylesheet" />

        <link type="text/css" href="/astorbr-re/add/js/jquery/themes/ui-lightness/jquery-ui-1.8.custom.css" rel="stylesheet" />



        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

    <link rel="stylesheet" href="/astorbr-re/estilos6.css">


<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<script language="JavaScript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js" type="text/JavaScript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>

		

    <style type="text/css">

    body {

	background-color: #FFF;

}

    </style>
</head>

<body>
<div id="container" style="height: 600px;">

           <div id="topo" onClick="Javascript:location.href='http://www.redcoachusa.com/';"> </div>

            <div id="mainContent"  style="width: 980px; height: 460px;  margin-left: 0px; margin-top: -10px;">

                <div id="caixaCadastro">

                   <form method="post" enctype="multipart/form-data" id="form" action="/booking/pickupdropoff/signup/add" >

                       <!--<div id="titulo"> <h1> Usuário Registrado </h1> </div> -->

                       <div id="titulo"> <h1> Registration </h1> </div>

                       <div id="caixa" style="height: 54    px; padding-top: 1px;">

                            <p> If you are new to our store, please take a moment to register with us.<br>

                            By registering with us you avoid reentering your contact information the next time you purchase from us.</p>

                 </div>

                       <div id="caixa" style="height: 350px;">

                            <input type="hidden" name="op" value="reg2"  />

                            <div style="margin-left: 35px; *margin-left: 20px;">

                                <fieldset style="width: 170px;">

                                    <span> User name / E-Mail </span>

                                    <input type="text" name="username" id="username" style="width: 180px;">

                                </fieldset>



                                <fieldset style="width: 170px;">

                                    <span> Password </span>

                                    <input type="password" name="password" id="password" style="width: 180px;">

                                </fieldset>



                                <fieldset style="width: 170px;">

                                    <span> Confirm  password</span>

                                    <input type="password" name="confirm_password" id="confirm_password" style="width: 180px;">

                                </fieldset>



                            </div>



                            <!-- Dados pessoais -->



                            <div style="width: 500px; height: 290px;">

                                <fieldset style="width: 220px;">

                                    <span> First name </span>

                                    <input type="text" name="firstname" id="nombre" style="width: 220px;">

                                </fieldset>

                                

                                <fieldset style="width: 220px;">

                                    <span> Last name </span>

                                    <input type="text" name="lastname" id="extra_lastname" style="width: 220px;">

                              </fieldset>



                                <fieldset style="width: 95px; *width: 85px;">

                                    <span> Phone </span>

                                    <input type="text" value="" id="phone" name="telefono" style="width: 95px;">

                                </fieldset>



                                <fieldset style="width: 95px;">

                                    <span> Cel. Phone </span>

                                    <input type="text" name="celphone" id="celular" style="width: 95px;">

                                </fieldset>



                                <fieldset style="width: 95px;">
                                </fieldset>

                                

                                
                                <fieldset style="width: 170px;">
                                </fieldset>



                                
                                <fieldset  style="width: 140px;">

                                    <span> Zip</span>

                                    <input type="text" name="cpostal" value="" id="cep" style="width: 140px;">

                                </fieldset>



                                <fieldset style="width: 95px;">

                                    <span> City </span>

                                    <input type="text" name="city" id="cidade" style="width: 95px;">

                                </fieldset>



                                <fieldset  style="width: 95px;">

                                    <span> State </span>

                                <select name="provincia" id="state"  style="width: 95px;">

                                      <OPTION VALUE="0">----

                                      <OPTION VALUE="AL">Alabama

                                      <OPTION VALUE="AK">Alaska

                                      <OPTION VALUE="AZ">Arizona

                                      <OPTION VALUE="AR">Arkansas

                                      <OPTION VALUE="CA">California

                                      <OPTION VALUE="CO">Colorado

                                      <OPTION VALUE="CT">Connecticut

                                      <OPTION VALUE="DE">Delaware

                                      <OPTION VALUE="DC">District of Colombia

                                      <OPTION VALUE="FL">Florida

                                      <OPTION VALUE="GA">Georgia

                                      <OPTION VALUE="GU">Guam

                                      <OPTION VALUE="HI">Hawaii

                                      <OPTION VALUE="ID">Idaho

                                      <OPTION VALUE="IL">Illinois

                                      <OPTION VALUE="IN">Indiana

                                      <OPTION VALUE="IA">Iowa

                                      <OPTION VALUE="KS">Kansas

                                      <OPTION VALUE="KY">Kentucky

                                      <OPTION VALUE="LA">Louisiana

                                      <OPTION VALUE="ME">Maine

                                      <OPTION VALUE="MD">Maryland

                                      <OPTION VALUE="MA">Massachusetts

                                      <OPTION VALUE="MI">Michigan

                                      <OPTION VALUE="MN">Minnesota

                                      <OPTION VALUE="MS">Mississippi

                                      <OPTION VALUE="MO">Missouri

                                      <OPTION VALUE="MT">Montana

                                      <OPTION VALUE="NE">Nebraska

                                      <OPTION VALUE="NV">Nevada

                                      <OPTION VALUE="NH">New Hampshire

                                      <OPTION VALUE="NJ">New Jersey

                                      <OPTION VALUE="NM">New Mexico

                                      <OPTION VALUE="NY">New York

                                      <OPTION VALUE="NC">North Carolina

                                      <OPTION VALUE="ND">North Dakota

                                      <OPTION VALUE="OH">Ohio

                                      <OPTION VALUE="OK">Oklahoma

                                      <OPTION VALUE="OR">Oregon

                                      <OPTION VALUE="PA">Pennsylvania

                                      <OPTION VALUE="PR">Puerto Rico

                                      <OPTION VALUE="RI">Rhode Island

                                      <OPTION VALUE="SC">South Carolina

                                      <OPTION VALUE="SD">South Dakota

                                      <OPTION VALUE="TN">Tennessee

                                      <OPTION VALUE="TX">Texas

                                      <OPTION VALUE="UT">Utah

                                      <OPTION VALUE="VT">Vermont

                                      <OPTION VALUE="VI">Virgin Islands (US)

                                      <OPTION VALUE="VA">Virginia

                                      <OPTION VALUE="WA">Washington

                                      <OPTION VALUE="WV">West Virginia

                                      <OPTION VALUE="WI">Wisconsin

                                      <OPTION VALUE="WY">Wyoming

                                      <OPTION VALUE="AB">Alberta

                                      <OPTION VALUE="BC">British Columbia

                                      <OPTION VALUE="MB">Manitoba

                                      <OPTION VALUE="NB">New Brunswick

                                      <OPTION VALUE="NF">Newfoundland and Labrador

                                      <OPTION VALUE="NT">Northwest Territories

                                      <OPTION VALUE="NS">Nova Scotia

                                      <OPTION VALUE="NU">Nunavut

                                      <OPTION VALUE="ON">Ontario

                                      <OPTION VALUE="PE">Prince Edward Island

                                      <OPTION VALUE="QC">Quebec

                                      <OPTION VALUE="SK">Saskatchewan

                                      <OPTION VALUE="OTHER">Other

                                </SELECT>

                              </fieldset>



                                <fieldset style="width: 95px;">

                                    <span> Country </span>

                                <select name="country"  style="width: 95px;">

                                      <OPTION VALUE=""> - </OPTION>

                                      <OPTION VALUE=AFG>AFGHANISTAN</OPTION>

                                      <OPTION VALUE=ALB>ALBANIA</OPTION>

                                      <OPTION VALUE=DZA>ALGERIA</OPTION>

                                      <OPTION VALUE=ASM>AMERICAN SAMOA</OPTION>

                                      <OPTION VALUE=AND>ANDORRA</OPTION>

                                      <OPTION VALUE=AGO>ANGOLA</OPTION>

                                      <OPTION VALUE=AIA>ANGUILLA</OPTION>

                                      <OPTION VALUE=ATA>ANTARCTICA</OPTION>

                                      <OPTION VALUE=ATG>ANTIGUA</OPTION>

                                      <OPTION VALUE=ARG>ARGENTINA</OPTION>

                                      <OPTION VALUE=ARM>ARMENIA</OPTION>

                                      <OPTION VALUE=ABW>ARUBA</OPTION>

                                      <OPTION VALUE=AUS>AUSTRALIA</OPTION>

                                      <OPTION VALUE=AUT>AUSTRIA</OPTION>

                                      <OPTION VALUE=AZE>AZERBAIJAN</OPTION>

                                      <OPTION VALUE=BHS>BAHAMAS</OPTION>

                                      <OPTION VALUE=BHR>BAHRAIN</OPTION>

                                      <OPTION VALUE=BGD>BANGLADESH</OPTION>

                                      <OPTION VALUE=BRB>BARBADOS</OPTION>

                                      <OPTION VALUE=BLR>BELARUS</OPTION>

                                      <OPTION VALUE=BEL>BELGIUM</OPTION>

                                      <OPTION VALUE=BLZ>BELIZE</OPTION>

                                      <OPTION VALUE=BEN>BENIN</OPTION>

                                      <OPTION VALUE=BMU>BERMUDA</OPTION>

                                      <OPTION VALUE=BTN>BHUTAN</OPTION>

                                      <OPTION VALUE=BOL>BOLIVIA</OPTION>

                                      <OPTION VALUE=BIH>BOSNIA-HERZEGOWINA</OPTION>

                                      <OPTION VALUE=BWA>BOTSWANA</OPTION>

                                      <OPTION VALUE=BVT>BOUVET ISLAND</OPTION>

                                      <OPTION VALUE=BRA>BRAZIL</OPTION>

                                      <OPTION VALUE=BRN>BRUNEI DARUSSALAM</OPTION>

                                      <OPTION VALUE=BGR>BULGARIA</OPTION>

                                      <OPTION VALUE=BFA>BURKINA FASO</OPTION>

                                      <OPTION VALUE=BDI>BURUNDI</OPTION>

                                      <OPTION VALUE=KHM>CAMBODIA</OPTION>

                                      <OPTION VALUE=CMR>CAMEROON</OPTION>

                                      <OPTION VALUE=CAN>CANADA</OPTION>

                                      <OPTION VALUE=CPV>CAPE VERDE</OPTION>

                                      <OPTION VALUE=CYM>CAYMAN ISLANDS</OPTION>

                                      <OPTION VALUE=CAF>CEN. AFRICAN REP.</OPTION>

                                      <OPTION VALUE=TCD>CHAD</OPTION>

                                      <OPTION VALUE=CHL>CHILE</OPTION>

                                      <OPTION VALUE=CHN>CHINA</OPTION>

                                      <OPTION VALUE=CXR>CHRISTMAS ISL.</OPTION>

                                      <OPTION VALUE=CCK>COCOS  ISLANDS</OPTION>

                                      <OPTION VALUE=COL>COLOMBIA</OPTION>

                                      <OPTION VALUE=COM>COMOROS</OPTION>

                                      <OPTION VALUE=COG>CONGO</OPTION>

                                      <OPTION VALUE=COK>COOK ISLANDS</OPTION>

                                      <OPTION VALUE=CRI>COSTA RICA</OPTION>

                                      <OPTION VALUE=CIV>COTE D'IVOIRE</OPTION>

                                      <OPTION VALUE=HRV>CROATIA</OPTION>

                                      <OPTION VALUE=CUB>CUBA</OPTION>

                                      <OPTION VALUE=CYP>CYPRUS</OPTION>

                                      <OPTION VALUE=CZE>CZECH REPUBLIC</OPTION>

                                      <OPTION VALUE=DNK>DENMARK</OPTION>

                                      <OPTION VALUE=DJI>DJIBOUTI</OPTION>

                                      <OPTION VALUE=DMA>DOMINICA</OPTION>

                                      <OPTION VALUE=DOM>DOMINICAN REP.</OPTION>

                                      <OPTION VALUE=TMP>EAST TIMOR</OPTION>

                                      <OPTION VALUE=ECU>ECUADOR</OPTION>

                                      <OPTION VALUE=EGY>EGYPT</OPTION>

                                      <OPTION VALUE=SLV>EL SALVADOR</OPTION>

                                      <OPTION VALUE=GNQ>EQUATORIAL GUINEA</OPTION>

                                      <OPTION VALUE=ERI>ERITREA</OPTION>

                                      <OPTION VALUE=EST>ESTONIA</OPTION>

                                      <OPTION VALUE=ETH>ETHIOPIA</OPTION>

                                      <OPTION VALUE=FLK>FALKLAND ISLANDS</OPTION>

                                      <OPTION VALUE=FRO>FAROE ISLANDS</OPTION>

                                      <OPTION VALUE=FJI>FIJI</OPTION>

                                      <OPTION VALUE=FIN>FINLAND</OPTION>

                                      <OPTION VALUE=FRA>FRANCE</OPTION>

                                      <OPTION VALUE=GUF>FRENCH GUIANA</OPTION>

                                      <OPTION VALUE=PYF>FRENCH POLYNESIA</OPTION>

                                      <OPTION VALUE=GAB>GABON</OPTION>

                                      <OPTION VALUE=GMB>GAMBIA</OPTION>

                                      <OPTION VALUE=GEO>GEORGIA</OPTION>

                                      <OPTION VALUE=DEU>GERMANY</OPTION>

                                      <OPTION VALUE=GHA>GHANA</OPTION>

                                      <OPTION VALUE=GIB>GIBRALTAR</OPTION>

                                      <OPTION VALUE=GRC>GREECE</OPTION>

                                      <OPTION VALUE=GRL>GREENLAND</OPTION>

                                      <OPTION VALUE=GRD>GRENADA</OPTION>

                                      <OPTION VALUE=GLP>GUADELOUPE</OPTION>

                                      <OPTION VALUE=GUM>GUAM</OPTION>


                                      <OPTION VALUE=GTM>GUATEMALA</OPTION>

                                      <OPTION VALUE=GIN>GUINEA</OPTION>

                                      <OPTION VALUE=GNB>GUINEA-BISSAU</OPTION>

                                      <OPTION VALUE=GUY>GUYANA</OPTION>

                                      <OPTION VALUE=HTI>HAITI</OPTION>

                                      <OPTION VALUE=VAT>HOLY SEE</OPTION>

                                      <OPTION VALUE=HND>HONDURAS</OPTION>

                                      <OPTION VALUE=HKG>HONG KONG</OPTION>

                                      <OPTION VALUE=HUN>HUNGARY</OPTION>

                                      <OPTION VALUE=ISL>ICELAND</OPTION>

                                      <OPTION VALUE=IND>INDIA</OPTION>

                                      <OPTION VALUE=IDN>INDONESIA</OPTION>

                                      <OPTION VALUE=IRN>IRAN</OPTION>

                                      <OPTION VALUE=IRQ>IRAQ</OPTION>

                                      <OPTION VALUE=IRL>IRELAND</OPTION>

                                      <OPTION VALUE=ISR>ISRAEL</OPTION>

                                      <OPTION VALUE=ITA>ITALY</OPTION>

                                      <OPTION VALUE=JAM>JAMAICA</OPTION>

                                      <OPTION VALUE=JPN>JAPAN</OPTION>

                                      <OPTION VALUE=JOR>JORDAN</OPTION>

                                      <OPTION VALUE=KAZ>KAZAKHSTAN</OPTION>

                                      <OPTION VALUE=KEN>KENYA</OPTION>

                                      <OPTION VALUE=KIR>KIRIBATI</OPTION>

                                      <OPTION VALUE=PRK>KOREA, DPR</OPTION>

                                      <OPTION VALUE=KOR>KOREA, REP. OF</OPTION>

                                      <OPTION VALUE=KWT>KUWAIT</OPTION>

                                      <OPTION VALUE=KGZ>KYRGYZSTAN</OPTION>

                                      <OPTION VALUE=LAO>LAO PDR</OPTION>

                                      <OPTION VALUE=LVA>LATVIA</OPTION>

                                      <OPTION VALUE=LBN>LEBANON</OPTION>

                                      <OPTION VALUE=LSO>LESOTHO</OPTION>

                                      <OPTION VALUE=LBR>LIBERIA</OPTION>

                                      <OPTION VALUE=LBY>LIBYA</OPTION>

                                      <OPTION VALUE=LIE>LIECHTENSTEIN</OPTION>

                                      <OPTION VALUE=LTU>LITHUANIA</OPTION>

                                      <OPTION VALUE=LUX>LUXEMBOURG</OPTION>

                                      <OPTION VALUE=MAC>MACAU</OPTION>

                                      <OPTION VALUE=MDG>MADAGASCAR</OPTION>

                                      <OPTION VALUE=MWI>MALAWI</OPTION>

                                      <OPTION VALUE=MYS>MALAYSIA</OPTION>

                                      <OPTION VALUE=MDV>MALDIVES</OPTION>

                                      <OPTION VALUE=MLI>MALI</OPTION>

                                      <OPTION VALUE=MLT>MALTA</OPTION>

                                      <OPTION VALUE=MHL>MARSHALL ISL.</OPTION>

                                      <OPTION VALUE=MTQ>MARTINIQUE</OPTION>

                                      <OPTION VALUE=MRT>MAURITANIA</OPTION>

                                      <OPTION VALUE=MUS>MAURITIUS</OPTION>

                                      <OPTION VALUE=MYT>MAYOTTE</OPTION>

                                      <OPTION VALUE=MEX>MEXICO</OPTION>

                                      <OPTION VALUE=FSM>MICRONESIA</OPTION>

                                      <OPTION VALUE=MDA>MOLDOVA</OPTION>

                                      <OPTION VALUE=MCO>MONACO</OPTION>

                                      <OPTION VALUE=MNG>MONGOLIA</OPTION>

                                      <OPTION VALUE=MSR>MONTSERRAT</OPTION>

                                      <OPTION VALUE=MAR>MOROCCO</OPTION>

                                      <OPTION VALUE=MOZ>MOZAMBIQUE</OPTION>

                                      <OPTION VALUE=MMR>MYANMAR</OPTION>

                                      <OPTION VALUE=MNP>N. MARIANA ISL.</OPTION>

                                      <OPTION VALUE=NAM>NAMIBIA</OPTION>

                                      <OPTION VALUE=NRU>NAURU</OPTION>

                                      <OPTION VALUE=NPL>NEPAL</OPTION>

                                      <OPTION VALUE=NLD>NETHERLANDS</OPTION>

                                      <OPTION VALUE=NCL>NEW CALEDONIA</OPTION>

                                      <OPTION VALUE=NZL>NEW ZEALAND</OPTION>

                                      <OPTION VALUE=NIC>NICARAGUA</OPTION>

                                      <OPTION VALUE=NER>NIGER</OPTION>

                                      <OPTION VALUE=NGA>NIGERIA</OPTION>

                                      <OPTION VALUE=NIU>NIUE</OPTION>

                                      <OPTION VALUE=NFK>NORFOLK ISLAND</OPTION>

                                      <OPTION VALUE=NOR>NORWAY</OPTION>

                                      <OPTION VALUE=OMN>OMAN</OPTION>

                                      <OPTION VALUE=PAK>PAKISTAN</OPTION>

                                      <OPTION VALUE=PLW>PALAU</OPTION>

                                      <OPTION VALUE=  P>PALESTINIAN TERR.</OPTION>

                                      <OPTION VALUE=PAN>PANAMA</OPTION>

                                      <OPTION VALUE=PNG>PAPUA NEW GUINEA</OPTION>

                                      <OPTION VALUE=PRY>PARAGUAY</OPTION>

                                      <OPTION VALUE=PER>PERU</OPTION>

                                      <OPTION VALUE=PHL>PHILIPPINES</OPTION>

                                      <OPTION VALUE=PCN>PITCAIRN</OPTION>

                                      <OPTION VALUE=POL>POLAND</OPTION>

                                      <OPTION VALUE=PRT>PORTUGAL</OPTION>

                                      <OPTION VALUE=PRI>PUERTO RICO</OPTION>

                                      <OPTION VALUE=QAT>QATAR</OPTION>

                                      <OPTION VALUE=REU>REUNION</OPTION>

                                      <OPTION VALUE=ROM>ROMANIA</OPTION>

                                      <OPTION VALUE=RUS>RUSSIAN FED.</OPTION>

                                      <OPTION VALUE=RWA>RWANDA</OPTION>

                                      <OPTION VALUE=KNA>SAINT KITTS</OPTION>

                                      <OPTION VALUE=LCA>SAINT LUCIA</OPTION>

                                      <OPTION VALUE=VCT>SAINT VINCENT</OPTION>

                                      <OPTION VALUE=WSM>SAMOA</OPTION>

                                      <OPTION VALUE=SMR>SAN MARINO</OPTION>

                                      <OPTION VALUE=SAU>SAUDI ARABIA</OPTION>

                                      <OPTION VALUE=SEN>SENEGAL</OPTION>

                                      <OPTION VALUE=SYC>SEYCHELLES</OPTION>

                                      <OPTION VALUE=SLE>SIERRA LEONE</OPTION>

                                      <OPTION VALUE=SGP>SINGAPORE</OPTION>

                                      <OPTION VALUE=SVK>SLOVAKIA</OPTION>

                                      <OPTION VALUE=SVN>SLOVENIA</OPTION>

                                      <OPTION VALUE=SLB>SOLOMON ISLANDS</OPTION>

                                      <OPTION VALUE=SOM>SOMALIA</OPTION>

                                      <OPTION VALUE=ZAF>SOUTH AFRICA</OPTION>

                                      <OPTION VALUE=ESP>SPAIN</OPTION>

                                      <OPTION VALUE=LKA>SRI LANKA</OPTION>

                                      <OPTION VALUE=SHN>ST. HELENA</OPTION>

                                      <OPTION VALUE=SDN>SUDAN</OPTION>

                                      <OPTION VALUE=SUR>SURINAME</OPTION>

                                      <OPTION VALUE=SWZ>SWAZILAND</OPTION>

                                      <OPTION VALUE=SWE>SWEDEN</OPTION>

                                      <OPTION VALUE=CHE>SWITZERLAND</OPTION>

                                      <OPTION VALUE=SYR>SYRIAN ARAB REP.</OPTION>

                                      <OPTION VALUE=TWN>TAIWAN</OPTION>

                                      <OPTION VALUE=TJK>TAJIKISTAN</OPTION>

                                      <OPTION VALUE=TZA>TANZANIA</OPTION>

                                      <OPTION VALUE=THA>THAILAND</OPTION>

                                      <OPTION VALUE=TGO>TOGO</OPTION>

                                      <OPTION VALUE=TKL>TOKELAU</OPTION>

                                      <OPTION VALUE=TON>TONGA</OPTION>

                                      <OPTION VALUE=TTO>TRINIDAD AND TOBAGO</OPTION>

                                      <OPTION VALUE=TUN>TUNISIA</OPTION>

                                      <OPTION VALUE=TUR>TURKEY</OPTION>

                                      <OPTION VALUE=TKM>TURKMENISTAN</OPTION>

                                      <OPTION VALUE=TCA>TURKS AND CAICOS</OPTION>

                                      <OPTION VALUE=TUV>TUVALU</OPTION>

                                      <OPTION VALUE=ARE>U.A.E.</OPTION>

                                      <OPTION VALUE=UGA>UGANDA</OPTION>

                                      <OPTION VALUE=UKR>UKRAINE</OPTION>

                                      <OPTION VALUE=GBR>UNITED KINGDOM</OPTION>

                                      <OPTION VALUE=USA SELECTED>UNITED STATES</OPTION>

                                      <OPTION VALUE=URY>URUGUAY</OPTION>

                                      <OPTION VALUE=UZB>UZBEKISTAN</OPTION>

                                      <OPTION VALUE=VUT>VANUATU</OPTION>

                                      <OPTION VALUE=VEN>VENEZUELA</OPTION>

                                      <OPTION VALUE=VNM>VIET NAM</OPTION>

                                      <OPTION VALUE=VGB>VIRGIN ISLANDS (BR)</OPTION>

                                      <OPTION VALUE=VIR>VIRGIN ISLANDS (US)</OPTION>

                                      <OPTION VALUE=ESH>WESTERN SAHARA</OPTION>

                                      <OPTION VALUE=YEM>YEMEN</OPTION>

                                      <OPTION VALUE=YUG>YUGOSLAVIA</OPTION>

                                      <OPTION VALUE=ZMB>ZAMBIA</OPTION>

                                      <OPTION VALUE=ZWE>ZIMBABWE</OPTION>

                                </SELECT>

                              </fieldset>



                                <fieldset style="width: 350px;">

                                    <span> <SPAN title="" closure_uid_bwt91v="116" Xc="endere&ccedil;o" Yc="address">Address</SPAN></span>

                                    <input type="text" name="address"  style="width: 350px;" id="endereco">

                                </fieldset>

                                

                                <fieldset style="width: 150px; float: right; margin-top: 0px;">

                                    <input type="submit" name="send" value="" class="enviar">

                                </fieldset>



                                <fieldset style="display: none;">

                                    <span> Newspaper </span>

                                    <input type="checkbox" name="gacetilla">

                                </fieldset>



                                <fieldset style="display: none;">

                                    <span> Extra </span>

                                    <input type="text" name="extra">

                                </fieldset>

								

                            </div>

                       </div>

                  </form>



                </div>

           </div>

           <div id="Rodape">

               <div id="ComoComprar" onClick="javascript:openCentered('/astorbr-re/add/comoComprar.html','comocomprar',580,432,'toolbar=auto,location=no,status=no,menubar=no,scrollbars=yes,resizable=no')"></div>

               <div id="ComoComprar">  </div>

           </div>

        </div>





















  <script type="text/javascript">

        /*$(document).ready(function() {

            //!$('#cep').mask("99.999-999");

            //!$('#telefone').mask("(99) 9999 9999");

            //!$('#celular').mask("(99) 9999 9999");

            //!$('#comercial').mask("(99) 9999 9999");

            $('#nasc').mask("99/99/9999");



           /* $("#form").validate({

                    //errorLabelContainer: $("#errors"),

                    //wrapper: 'li',

                    rules: {

                            email: {

                                    required: true,

                                    email: true

							},

                            extra_lastname: {

                                    required: true,

                                    minlength: 2

                            },

                            password: {

                                    required: true,

                                    minlength: 5

                            },

                            confirm_password: {

                                    required: true,

                                    minlength: 5,

                                    equalTo: "#password"

                            },

                            nombre: {

                                    required: true,

                                    minlength: 2

                            },

                            numero: {

                                required: false

                            },

                            nasc: {

                                required: false

                            },

                            telefono: {

                                required: false

                            },

                            ciudad: {

                                required: false

                            },

                            direccion: {

                                required: false

                            },

                            extra_numero: {

                                required: false

                            }

                    },

                    messages: {

                            email: {

                                    required: "Required.",

                                    email: "Invalid e-mail."

                            },

                            password: {

                                    required: "Required.",

                                    minlength: "At least 5 characters."

                            },

                            confirm_password: {

                                    required: "Required.",

                                    minlength: "At least 5 characters.",

                                    equalTo: "Enter de same password."

                            },

                            nombre: {

                                required: "Required.",

                                minlength: "At least 2 characters."

                            },

							extra_lastname: {

                                required: "Required.",

                                minlength: "At least 2 characters."

                            },

                            numero: {

                                required: "Required."

                            },

                            nasc: {

                                required: "Required."

                            },

                            telefono: {

                                required: "Required."

                            },

                            ciudad: {

                                required: "Required"

                            },

                            direccion: {

                                required: "Required."

                            },

                            extra_numero: {

                                required: "Required."

                            }



                    }

            });

        });
*/

/*
        function preencheData (date) {

            var data = explode('/', date);

            $('#extra_nacimiento_dia').val(data[0]);

            $('#extra_nacimiento_mes').val(data[1]);

            $('#extra_nacimiento_ano').val(data[2]);

        }

*/



    </script>

 <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33124456-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>