<div class="edit_profile">
    
    <form method="get" target="_self">
        
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
        <input type="password" name="password_entry1" id="password_entry1"  value=<?= $_SESSION['user_password'] ?> />
        <label for="password_entry2">Confirm password:</label>
        <input type="password" name="password_entry2" id="password_entry2"  value=<?= $_SESSION['user_password'] ?> />

        <input type="submit" value="submit"/>
        
    </form>
    
</div>