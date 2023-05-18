<form name="form1" method="post" action="<?php echo $data['rootUrl']; ?>admin/users"  class="form" id="form1">
             
        <div id="header_page" >
            <div class="header">Users</div>

        <div  id="toolbar">

            <div class="toolbar-list">
                <ul>

                    <li class="btn-toolbar">
                        <a href="<?php echo $data['rootUrl']; ?>admin/users/add" id="btn-add" class="link-button">
                            <span class="icon-new" title="New" >&nbsp;</span>
                            New
                        </a>
                    </li>

                    <li class="btn-toolbar">
                        <a href="<?php echo $data['rootUrl']; ?>admin/users/edit" id="btn-edit" class="link-button" >
                            <span class="icon-edit" title="Edit" >&nbsp;</span>
                            Edit
                        </a>
                    </li>

                    <li class="btn-toolbar">
                        <a href="<?php echo $data['rootUrl']; ?>admin/users/delete" id="btn-delete" class="link-button">
                            <span class="icon-delete" title="delete" >&nbsp;</span>
                            Delete
                        </a>
                    </li>

                    <li class="divider">&nbsp;</li>

                    <li class="btn-toolbar">
                        <a href="<?php echo $data['rootUrl']; ?>admin/home" id="btn-back" class="link-button">
                            <span class="icon-back" title="Regresar" >&nbsp;</span>
                            Back
                        </a>
                    </li>

                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
       </div>
<div id="form" >

        <div id="filter-bar">

            <label style="width:70px" class="filter-by">Filter by:</label>
            <select name="filtro" id="filtro" class="select">
               <option value="username">Username</option>
               <option value="email">Email</option>
            </select>

            <span class="search">
                <input name="texto" type="text" size="30" maxlength="30" class="input-search" id="texto" value="<?php echo $data["texto"] ?>"/>
                <input type="button" class="search-btn" id="btn-find" onclick="submitbutton('index');" />
            </span>

            <input name="mod" type="hidden" id="mod" value="roles" />
        
        </div>
        
        <div id="datagrid">
         
            <table class="grid" cellspacing="1" id="grid">
                 <thead>
                    <tr>
                        <th width="5%">&nbsp;</th>
                        <th width="15%">Username</th>
                        <th width="20%">Email</th>
                        <th width="20%">Name</th>
                        <th width="15%">Role</th>
                        <th width="5%">Active</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 0; ?>
                    <?php foreach($data['usuarios'] as $user) {?>
                        <tr class="row<?php echo $i?>">
                            <td><input name="item" type="radio" value="<?php echo $user->id ?>" /></td>
                            <td><?php echo $user->usuario ?></td>
                            <td><?php echo $user->email ?></td>
                            <td><?php echo $user->nombre ?></td>
                            <td><?php print $data['roles'][$user->role]?></td>
                            <td>
                                <?php if($user->estado == 1){ ?>
                                    <img src ="<?php echo $data['rootUrl']?>global/img/admin/check2.png" width="20px" height="20px">
                                <?php } else {?>
                                    <img src ="<?php echo $data['rootUrl']?>global/img/admin/x01.png" width="20px" height="20px">
                                <?php } ?>
                            </td>
                        </tr>
                        <?php $i = ($i == 0)? $i+1 : $i-1;?>
                    <?php } ?>
                </tbody>

                
            </table>

        </div>
    </div>
</form>



<script>
$('#grid tr').click(function() {
$(this).find('input[name="item"]').prop('checked', true)
   
});
    $('texto').keypress(function(e){
       if (e.keyCode==13)
           $('#form1').submit();
    })

    $('#btn-edit').click(function(e){
       item = $('input[name=item]:checked').attr('value');
        if (!item){
         alert('You must select an Item');
         e.preventDefault();
       }
       else {
           var action = $(this).attr("href") + "/" + item;
           $(this).attr("href",action);
       }
   });
 $('#btn-delete').click(function(e){
        n = $('input[name=item]:checked').attr('value');
        if (!n){
          alert('You must select an Item');
          e.preventDefault();
        }else {
            if (confirm("Are you sure of deleting this item? ..")){
               var action = $(this).attr("href") + "/" + n;
               $(this).attr("href",action);
            }else
			{
			return false;
			}
        }
    });

</script>