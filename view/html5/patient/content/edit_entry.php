    <?php

        require "patient_info.php";

    ?>

    <div class="edit_entry">
        
        <form method="post" target="_self">
            <label for="start_time">Started on:</label>
            <input type="date" name="start_date" id="start_time" value=<?= $start_date ?> />
            <input type="time" name="start_time" value=<?= $start_time ?> />

            <br/>

            <label for="occurrent">Occurent</label>
            <input type="checkbox" name="occurent"/>

            <br/>

            <label for="end_time">Ended on:</label>
            <input type="date" name="end" id="end_time" value=<?= $end_date ?> />
            <input type="time" name="end_time" value=<?= $end_time ?> />


            <textarea placeholder="Write here..."></textarea>

            <input type="submit" value="submit"/>
            
        </form>
        
    </div>