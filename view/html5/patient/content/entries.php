<div class="entries">
    
    <ul>
        <?php
        
            foreach($entries as $currentEntry){
                
                $start=$currentEntry->getStart()->format("Y-m-d H:i:s");
                $end=$currentEntry->getEnd()->format("Y-m-d H:i:s");
                $description=$currentEntry->getDescription();
                
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
                                <input type=\"button\" value=\"edit\"/>
                                <input type=\"button\" value=\"delete\"/>
                            </div>
                        </div>

                        <hr/>

                        <div class=\"description\">
                        
                            <p>$description</p>
                            
                        </div>

                    </div>

                </li>
                    ";
                
            }
        
        ?>       
        
        
    </ul>
    
</div>