<div class="left_bar">
    
    <img src="<?php echo dirname('.')?>/../view/html5/icons/user_logo.svg"/>
    
    <form action="<?php echo dirname('.')?>/../controller/index.php" method="post">
        
        <input type="image" src="<?php echo dirname('.')?>/../view/html5/icons/patients.svg" name="wants" value="patients"/>
        <input type="image" src="<?php echo dirname('.')?>/../view/html5/icons/profile.svg" name="wants" value="profile"/>
        <input type="image" src="<?php echo dirname('.')?>/../view/html5/icons/add_white.svg" name="wants" value="add_patient"/>
        <input type="image" src="<?php echo dirname('.')?>/../view/html5/icons/edit.svg" name="wants" value="edit_profile"/>
        <input type="hidden" name="user" value="user">

    </form>
    
</div>
