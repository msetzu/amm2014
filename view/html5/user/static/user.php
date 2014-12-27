<!DOCTYPE html>
<html>
    
    <head>
        
        <meta charset="utf-8">
        <meta lang="en">
        
        <meta name="application-name" content="amm2014 - setzuMattia">
        <meta name="author" content="ma.setzu2@studenti.unica.it" >
        
        <meta name="description" content="Clinic case viewer and editor, user page.">
        <meta keywords="amm2014,setzuMattia,patients">        
        
        <link rel="stylesheet" href="<?php echo dirname('.')?>/../view/css/user.css"/>
        
        <script type="text/javascript"src="<?php echo dirname('.')?>/../controller/js/lib/jquery-2.0.js"></script>
        <script type="text/javascript" src="<?php echo dirname('.')?>/../controller/js/bed_checker.js"></script>

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
