<div class="content">    

    <?php
        
        switch($content){
            
            case "profile":
                try {
                    $age=$_SESSION['user_birthday']->diff(new DateTime("now", new DateTimeZone('Europe/Rome')));
                    $years=$age->y;
                } catch (Exception $e) {
                    echo var_dump($e->getTrace());
                }
                
                require dirname(__FILE__).'/profile.php';
                
            break;
        
            case "edit_profile":

                $birthday=$_SESSION['user_birthday']->format("Y-m-d");
                
                require dirname(__FILE__)."/edit_profile.php";
                
            break;
        
            case "patients":
                
                require dirname(__FILE__)."/patients.php";
                
            break;
        
            case "add_patient":
                
                require dirname(__FILE__)."/add_patient.php";
                
            break;
        
            case "patients_search_result":
                
                require dirname(__FILE__)."/search.php";
                
            break;
            
            case "patient_search":
                
                require dirname(__FILE__)."/search_form.php";
                
            break;
        
        }

    ?>   
    
</div>
