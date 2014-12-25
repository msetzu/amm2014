<div class="content">
    
    <?php
        
        switch($content){

            case "patient":                
                require dirname(__FILE__).'/patient.php';                
            break;
        
            case "edit_entry":
                require dirname(__FILE__).'/edit_entry.php';                
            break;
            
            case "entries":        
                require dirname(__FILE__).'/entries.php';           
            break;

        }
    
    ?>
    
</div>