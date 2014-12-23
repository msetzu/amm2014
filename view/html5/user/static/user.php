<!DOCTYPE html>
<html>
    
    <head>
        
        <meta charset="utf-8">
        <meta lang="en">
        
        <meta name="application-name" content="amm2014 - setzuMattia">
        <meta name="author" content="tia" >
        
        <meta name="description" content="Clinic case viewer and editor, user page.">
        <meta keywords="amm2014,setzuMattia,patients">        
        
        <link rel="stylesheet" href="<?php echo dirname('.')?>/../view/css/user.css"/>
        
    </head>
    
    <body>

        <?php
            
            //session_start();
            
			require_once dirname(__FILE__).'/../../../../model/factories/settings.php';
            require_once dirname(__FILE__).'/../../../../model/entities/patient.php';
            
            require dirname(__FILE__).'/top_bar.php';
            require dirname(__FILE__).'/left_bar.php';
            require dirname(__FILE__).'/../content/content.php';

        ?>   
        
    </body>
    
</html>
