<?php if(isset($_SESSION['uagency'])){ 
    $session = unserialize($_SESSION['uagency']);  
 ?> 

<div  style="width:40%;">
            <?php if(isset($_SESSION['amensage'])){ ?>
     
     
     <script>
	 
     jQuery.noticeAdd({
        text: '<? echo $_SESSION['amensage']; ?>',
        stay: true
});
     </script>
    <?php } ?>
            <form action="<?php echo $data['rootUrl']; ?>agency/profile" name="form1" id="form1" method="post" >
               <table width="100%" border="0">
  <tr>
    <td width="42%" height="43">First Name:    </td>
    <td width="58%">
      <input name="firstname" type="text"  id="firstname" size="25" maxlength="25"  value="<? echo $session->firstname; ?>" readonly="readonly"/>
    </td>
  </tr>
  <tr>
    <td height="32">Last Name:</td>
    <td>
      <input name="lastname" type="text"  id="lastname" size="25" maxlength="25" value="<? echo $session->lastname; ?>" readonly="readonly"/>
    </td>
  </tr>
  <tr>
    <td height="39">Birth Date:(m/d)</td>
    <td>
      <input name="birthdate" type="text"  id="birthdate" size="15" maxlength="15" value="<? echo $session->birthdate; ?>" readonly="readonly"/>
    </td>
  </tr>
  <tr>
    <td height="37">E-Mail / User:</td>
    <td>
      <input name="email" type="text"  id="email" size="25" maxlength="25"  value="<? echo $session->email; ?>"  readonly="readonly"/>
    </td>
  </tr>
  <tr>
    <td height="36">
      Old Password:    </td>
    <td>
      <input name="password" type="password"  id="password" size="15" maxlength="15" value="" />
    </td>
  </tr>
  <tr>
    <td height="39">New Password:</td>
    <td>
      <input name="newpassword" type="password"  id="newpassword" size="15" maxlength="15" value=""/>
   </td>
  </tr>
  <tr>
    <td height="38">
      Cofir Password:    </td>
    <td>
      <input name="password1" type="password"  id="password1" size="15" maxlength="15" value=""/>
    </td>
  </tr>
</table>

            
             <p align="right">
         <button  class="btn" id="btn-continue">Save</button>
         
       </p>
       </form>
            </fieldset>
             
        </div>
            </div>
          </div>
        </div>
     <?php } ?>   