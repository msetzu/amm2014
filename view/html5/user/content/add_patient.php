<div class="new_patient">
    
    <form method="get" target="_self">
        
        <label for="name" >Name:</label>
        <input type="text" name="name" id="name" placeholder="No numbers accepted" autofocus/>
        <label for="surname" >Surname:</label>
        <input type="text" name="surname" id="surname" placeholder="No numbers accepted"/>
        <label for="birthday" >Birthday:</label>
        <input type="date" name="birthday" id="birthday"/>
        <label for="ward">Ward:</label>
        <input type="text" name="ward" id="ward"/>
        <label for="bed_number">Bed number (Type 0 if patient still hasn't a bed.):</label>
        <input type="number" min="0" max="3000" step="1" value="0" name="bedNumber" id="bed_number"/>

        <input type="submit" value="submit"/>
        
    </form>
    
</div>