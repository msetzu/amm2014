    <?php
    
        require dirname(__FILE__)."/patient_info.php";
        require dirname(__FILE__)."/entries.php";

    ?>
    
    <label for="add_entry">Add entry</label> <input type="radio" value="Add entry" id="add_entry"/>
    
    <div class="add_entry">
        
        <form action="<?php echo dirname('.');?>/../controller/index.php" method="post" target="_self">
            <label for="start_time">Started on:</label>
            <input type="date" name="start_date" id="start_time"/>
            <input type="time" name="start_time"/>

            <br/>

            <label for="occurrent">Occurent</label>
            <input type="checkbox" name="occurent"/>

            <br/>

            <label for="end_time">Ended on:</label>
            <input type="date" name="end" id="end_time"/>
            <input type="time" name="end_time"/>


            <textarea placeholder="Write here..." name="description" id="description"></textarea>

            <input type="submit" value="Add"/>
            <input type="hidden" name="id" value="<?=$_REQUEST['id'] ?>">
            <input type="hidden" name="user" value="patient">
            <input type="hidden" name="wants" value="add_entry">
        </form>
        
    </div>