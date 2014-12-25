<div class="entries">
    
    <ul>
        <?php
            
            foreach($entries as $currentEntry){
                
                $start=$currentEntry->getStart()->format("Y-m-d H:i:s");
                $end=$currentEntry->getEnd()->format("Y-m-d H:i:s");
                $description=$currentEntry->getDescription();
                $entryId = $currentEntry->getId();
                $patientId = $patient->getId();

                if($end=="1011-11-11 11:11:11"){
                    
                    $time="Occurent, started on $start";
                    
                }else{
                    
                    $time="From $start to $end";
                    
                }
                
                
                echo "
                    <li>
            
                    <div class=\"entry\">

                        <div class=\"time\">
                            <p>$time</p>
                            <div class=\"buttons\">
                            <form action=\"".dirname('.')."/../controller/index.php\" method=\"post\" target=\"_self\">
                                <input type=\"submit\" name=\"wants\" value=\"delete\"/>
                                <input type=\"hidden\" name=\"user\" value=\"patient\"/>
                                <input type=\"hidden\" name=\"entry_id\" value=\"$entryId\"/>
                                <input type=\"hidden\" name=\"patient_id\" value=\"$patientId\"/>
                                <input type=\"hidden\" name=\"entry_id\" value=".$entryId."/>
                            </form>
                            </div>
                        </div>

                        <hr/>

                        <div class=\"description\">
                        
                            <p>".$description."</p>
                            
                        </div>

                    </div>

                </li>
                    ";
                
            }
        
        ?>       
        
        
    </ul>
    
</div>