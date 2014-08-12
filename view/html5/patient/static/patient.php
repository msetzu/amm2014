<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta lang="en">

        <meta name="application-name" content="amm2014 - setzuMattia">
        <meta name="author" content="ma.setzu2@studenti.unica.it">

        <meta name="description" content="Clinic case viewer and editor, patient page.">
        <meta keywords="amm2014,setzuMattia,patient">

        <link rel="stylesheet" href="../../../css/patient.css" />
        
        <?php
        
            include_once("/home/amm/development/amm2014/model/factories/settings.php");
            
            include_once(Settings::baseDirectory()."model/entities/patient.php");
            include_once(Settings::baseDirectory()."model/entities/case_entry.php");
            
            
            $patient=new Patient("Mario", "Rossi", new DateTime("12-12-2012 12:12:12"), "None", 13, 13);
            $entries=array();
            
            $entries[]=new CaseEntry(new DateTime("12-12-2012 12:12:12"), new DateTime("12-12-2012 12:12:12"), "Description1", 5, 5);
            $entries[]=new CaseEntry(new DateTime("12-12-2012 12:12:12"), new DateTime("11-11-1011 11:11:11"), "Description2", 5, 5);
            $entries[]=new CaseEntry(new DateTime("12-12-2012 12:12:12"), new DateTime("12-12-2012 12:12:12"), "Description3", 5, 5);
            $entries[]=new CaseEntry(new DateTime("12-12-2012 12:12:12"), new DateTime("12-12-2012 12:12:12"), "Description4", 5, 5);
            $entries[]=new CaseEntry(new DateTime("12-12-2012 12:12:12"), new DateTime("12-12-2012 12:12:12"), "Description5", 5, 5);
            
            include_once(Settings::baseDirectory()."model/entities/patient.php");
            include_once(Settings::baseDirectory()."model/entities/case_entry.php");

        ?>

    </head>

    <body>

        <?php
        
            $content="patient";
        
            require "header.php";
            require "../content/content.php";

        ?>

    </body>

</html>