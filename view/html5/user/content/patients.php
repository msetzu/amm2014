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
                        
                        <form method=\"get\" target=\"_blank\">
                            
                            

                        </form>

                    </li>
                    ";
                
            }
        
        ?>
        
    </ul>
    
</div>