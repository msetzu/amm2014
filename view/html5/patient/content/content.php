<div class="content">
    
    <?php
        $content="profile";
        switch($content){
            
            case "profile":
                require dirname('.').'/profile.php';
            break;

            case "patient":                
                require dirname(__FILE__).'/patient.php';                
            break;
        
            case "edit_entry":                
                require dirname('.').'/edit_entry.php';                
            break;
            
            default:
                echo "Nothing";
            break;

        }
    
    ?>
    
</div>