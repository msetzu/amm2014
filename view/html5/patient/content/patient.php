    <?php
    
        require "patient_info.php";
        require "entries.php";

    ?>
    
    <label for="add_entry">Add entry</label> <input type="radio" value="Add entry" id="add_entry"/>
    
    <div class="add_entry">
        
        <form method="post" target="_self">
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


            <textarea placeholder="Write here..."></textarea>

            <input type="submit" value="Add"/>
        </form>
        
    </div>