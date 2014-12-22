<!DOCTYPE html>
<html>
    
    <head>
        
        <meta charset="utf-8">
        <meta lang="en">
        
        <meta name="application-name" content="amm2014 - setzuMattia">
        <meta name="author" content="ma.setzu2@studenti.unica.it">
        
        <meta name="description" content="Clinic case viewer and editor.">
        <meta keywords="amm2014,setzuMattia">
        
        <link rel="stylesheet" media="(max-width:320px)" href="../../css/login-320.css">
        <link rel="stylesheet" media="(min-width:321px) and (max-width:480px)" href="../../css/login-480.css">
        <link rel="stylesheet" media="(min-width:481px) and (max-width:800px)" href="../../css/login-800.css">
        <link rel="stylesheet" media="(min-width:801px) and (max-width:1024px)" href="../../css/login-1024.css">
        <link rel="stylesheet" media="(min-width:1025px) and (max-width:1366px)" href="../../css/login-1366.css">
        <link rel="stylesheet" media="(min-width:1367px)" href="../../css/login-hd.css">

    </head>
    
    <body>
        
        <header>
            <a href="./signup.php">Sign up</a>
        </header>
        
        <div class="login_box">
            <div class="image">
                <img src="../icons/caduceus.svg"/>
            </div>
            <div class="login_form">
                <form action="<?php echo dirname('.')?>/../../../controller/index.php" method="get" target="_self">
                    <input type="text" name="email" placeholder="Type in your email" autofocus>
                    <input type="password" name="password" placeholder="Type in your password">
                    <input type="submit" value="submit">  
                    <input type="hidden" name="wants" value="login">
					<input type="hidden" name="user" value="guest">        
                </form>
            </div>
        </div>
    
        <footer>
            <a href="./who_we_are.html">Who we are</a>
            <a href="./credits.html">Credits</a>
            <a href="./infos.html">Infos</a>
        </footer>
        
    </body>
    
</html>
