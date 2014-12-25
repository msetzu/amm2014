    <?php
        require dirname(__FILE__).'/patient_info.php';
        var_dump($entryId);
    ?>

    <div class="edit_entry">
        
        <form action="<?php echo dirname('.')?>/../controller/index.php" method="post" target="_self">
            <label for="start_time">Started on:</label>
            <input type="date" name="start_date" id="start_time" value="<?= $start_date->format("Y-m-d") ?>" />
            <input type="time" name="start_time" value="<?= $start_date->format("H:i") ?>"/>

            <br/>
            <?php
                
                if ($end_date->format("Y-m-d H:i:s") == "1011-11-11 11:11:11"){

                    echo "
                        <label for=\"occurrent\">Occurrent</label>
                        <input type=\"checkbox\" name=\"occurrent\" checked \/>

                        <br/>

                        <label for=\"start_time\">Ended on:</label>
                        <input type=\"date\" name=\"end_date\" id=\"end_time\" value=\"".$end_date->format("Y-m-d")."\"\/>
                        <input type=\"time\" name=\"end_time\" value=\"".$end_date->format("H:i")."\"\/>
                    ";

                } else {

                    echo "

                        <label for=\"occurrent\">Occurrent</label>
                        <input type=\"checkbox\" name=\"occurrent\" \/>

                        <br/>

                        <label for=\"start_time\">Started on:</label>
                        <input type=\"date\" name=\"start_date\" id=\"start_time\" value=\"".$end_date->format("Y-m-d")."\"\/>
                        <input type=\"time\" name=\"start_time\" value=\"".$end_date->format("H:i")."\"\/>
                    ";

                }
            ?>


            <br/>

            <textarea placeholder="Write here..."></textarea>

            <input type="submit" value="submit"/>
            <input type="hidden" name="user" value="patient"/>
            <input type="hidden" name="wants" value="update_entry"/>
            <input type="hidden" name="entry_id" value="<?= $entryId ?>">
        </form>
        <?php echo "entry_id (edit_entry.php):".$entryId; ?>
    </div>