<div class="patients">
    
    <ul>
        
        <?php            
        
            foreach($patients as $currentPatient){
                
                $id=$currentPatient->getId();
                
                echo "
                    <li>
                        <div class=\"birth_record\">
                            <p class=\"name\">".$currentPatient->getName()." ".$currentPatient->getSurname()."</p>
                            <p>Età: ".$currentPatient->getBirthday()->diff(new DateTime("now"))->y." anni</p>
                        </div>

                        <hr/>

                        <div class=\"hospital_data\">
                            <p>Ward: ".$currentPatient->getWard()."</p>
                            <p>Bed number: ".$currentPatient->getBedNumber()."</p>
                        </div>
                        
                        <form method=\"get\" target=\"_blank\">
                            
                            <input type=\"image\" src=\"../../icons/clinic_case_grey.svg\" name=\"in\" value=\"$id\" />

                        </form>

                    </li>
                    ";
                
            }
        
        ?>
        
    </ul>
    
</div>