<div class="patients">
    
    <ul>
        
        <?php            

            foreach($patients as $currentPatient){
                $bd = $currentPatient->getBirthday();
                
                echo "
                    <li>
                        <div class=\"birth_record\">
                            <p class=\"name\">".$currentPatient->getName()." ".$currentPatient->getSurname()."</p>
                            <p>Età: ".$bd->diff(new DateTime("now", new DateTimeZone('Europe/Rome')))->y." anni</p>
                        </div>

                        <hr/>

                        <div class=\"hospital_data\">
                            <p>Ward: ".$currentPatient->getWard()."</p>
                            <p>Bed number: ".$currentPatient->getBedNumber()."</p>
                        </div>
                        
                        <form action=\"".dirname('.')."/../controller/index.php\" method=\"get\" target=\"_blank\">
                            
                            <input type=\"image\" src=\"".dirname('.')."/../view/html5/icons/clinic_case_grey.svg\"/>
                            <input type=\"hidden\" name=\"id\" value=\"".$currentPatient->getId()."\"/>
                            <input type=\"hidden\" name=\"user\" value=\"patient\"/>
                            <input type=\"hidden\" name=\"wants\" value=\"clinic_folder\"/>
                            
                        </form>

                    </li>
                    ";
                
            }
        
        ?>
        
    </ul>
    
</div>