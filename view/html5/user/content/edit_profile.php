<div class="edit_profile">
    
    <form action="<?php echo dirname('.')?>/../controller/index.php" method="get" target="_self">
        
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value=<?= $_SESSION['user_name'] ?> autofocus/>
        <label for="surname">Surname:</label>
        <input type="text" name="surname" id="surname"  value=<?= $_SESSION['user_surname'] ?> />
        <label for="birthday">Birthday:</label>
        <input type="date" name="birthday" id="birthday" value=<?= $birthday ?> />
        <label for="ward">Ward:</label>
        <input type="text" name="ward" id="ward" value=<?= $_SESSION['user_ward'] ?> />
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value=<?= $_SESSION['user_email'] ?> />
        <label for="password_entry1">Password:</label>
        <input type="password" name="password" id="password"  value=<?= $_SESSION['user_password'] ?> />

        <input type="submit" value="submit"/>
        <input type="hidden" name="user" value="user">
        <input type="hidden" name="wants" value="update_profile">
    </form>
    
</div>