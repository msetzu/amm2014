<div class="content">    

    <?php
        
        /* Set up birthday format */
        $dateTime=new DateTime($_SESSION['user_birthday']);                
        
        
        switch($content){
            
            case "profile":
                
                $age=$dateTime->diff(new DateTime("now"));
                $years=$age->y;
                
                require "profile.php";
                
            break;
        
            case "edit_profile":
                
                $birthday=$dateTime->format("Y-m-d");
                
                require "edit_profile.php";
                
            break;
        
            case "patients":
                
                require "patients.php";
                
            break;
        
            case "add_patient":
                
                require "add_patient.php";
                
            break;
        
            case "patients_search_result":
                
                require "search.php";
                
            break;
            
            case "patient_search":
                
                require "search_form.php";
                
            break;
        
        }

    ?>   
    
</div>