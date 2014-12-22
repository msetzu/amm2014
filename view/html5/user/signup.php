<!DOCTYPE html>
<html>
    
    <head>
        
        <meta charset="utf-8">
        <meta lang="en">
        
        <meta name="application-name" content="amm2014 - setzuMattia">
        <meta name="author" content="ma.setzu2@studenti.unica.it">
        
        <meta name="description" content="Clinic case viewer and editor, signup.">
        <meta keywords="amm2014,setzuMattia,signup,registration">        
        
        <link rel="stylesheet" media="(min-width:1024px)" href="../../css/signup.css"/>
        <link rel="stylesheet" media="(max-width:1024px) and (min-width:400px)" href="../../css/signup-1024.css"/>
        <link rel="stylesheet" media="(max-width:400px)" href="../../css/signup-400.css"/>
        
    </head>
    
    <body>
        
        <div class="section_header">
            <p>Signup</p>
        </div>
        
        <?php
        
			$_REQUEST["user"] = "guest";
			$_REQUEST["wants"] = "signup";
        ?>
        
        <div class="signup_container">
            <form action="../../../controller/index.php" method="get" target="_self">
                <label for="name" >Name:</label>
                <input type="text" name="name" id="name" placeholder="No numbers accepted" autofocus/>
                <label for="surname" >Surname:</label>
                <input type="text" name="surname" id="surname" placeholder="No numbers accepted"/>
                <label for="birthday" >Birthday:</label>
                <input type="date" name="birthday" id="birthday"/>
                <p>Account:</p>
                    <label for="student">Student</label>
                    <input type="radio" name="role" value="Student" id="student"/>
                    <label for="doctor">Doctor</label>
                    <input type="radio" name="role" value="Doctor" id="doctor"/>
                <label for="ward" >Ward:</label>
                <input type="text" name="ward" id="ward"/>
                <label for="email" >Email:</label>
                <input type="text" name="email" id="email"/>
                <label for="password_entry1">Password:</label>
                <input type="password" name="password_entry1" id="password_entry1"/>
                <label for="password_entry2">Confirm password:</label>
                <input type="password" name="password_entry2" id="password_entry2"/>
                
                <input type="submit" value="submit"/>
            </form>
        </div>
        
    </body>
    
</html>
