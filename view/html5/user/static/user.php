<!DOCTYPE html>
<html>
    
    <head>
        
        <meta charset="utf-8">
        <meta lang="en">
        
        <meta name="application-name" content="amm2014 - setzuMattia">
        <meta name="author" content="ma.setzu2@studenti.unica.it">
        
        <meta name="description" content="Clinic case viewer and editor, user page.">
        <meta keywords="amm2014,setzuMattia,patients">        
        
        <link rel="stylesheet" href="../../../css/user.css"/>
        
    </head>
    
    <body>
        
        <?php
            
            session_start();
        
            $_SESSION['user_name']="Marco";
            $_SESSION['user_surname']="Rossi";
            $_SESSION['user_birthday']="12/12/2012";
            $_SESSION['user_ward']="None";
            $_SESSION['user_role']="Doctor";
            $_SESSION['user_email']="marco_rossi@doctor.com";
            $_SESSION['user_password']="password";
            
            $content="add_patient";
            
            require("/home/amm/development/amm2014/model/factories/settings.php");
            
            require(Settings::baseDirectory()."model/entities/patient.php");
            
            
            $patients=array();
            
            $patients[]=new Patient("Mario", "Rossi", new DateTime("12-12-2012 12:12:12"), "None", 13, 13);
            $patients[]=new Patient("Mario", "Rossi", new DateTime("12-12-2012 12:12:12"), "None", 13, 13);
            $patients[]=new Patient("Mario", "Rossi", new DateTime("12-12-2012 12:12:12"), "None", 13, 13);
            $patients[]=new Patient("Mario", "Rossi", new DateTime("12-12-2012 12:12:12"), "None", 13, 13);
            $patients[]=new Patient("Mario", "Rossi", new DateTime("12-12-2012 12:12:12"), "None", 13, 13);
            $patients[]=new Patient("Mario", "Rossi", new DateTime("12-12-2012 12:12:12"), "None", 13, 13);
            $patients[]=new Patient("Mario", "Rossi", new DateTime("12-12-2012 12:12:12"), "None", 13, 13);
            
            
            require "./top_bar.php";
            require "./left_bar.php";
            require "../content/content.php";
            
        ?>   
        
    </body>
    
</html>