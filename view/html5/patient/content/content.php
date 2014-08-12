<div class="content">
    
    <?php
        
        $start_date="2012-12-12";
        $end_date="2012-12-12";
        
        $start_time="12:12";
        $end_time="12:12";
    
        
        switch($content){
            
            case "patient":
                
                require("patient.php");
                
            break;
        
            case "edit_entry":
                
                require("edit_entry.php");
                
            break;
            
        }
    
    ?>
    
</div>