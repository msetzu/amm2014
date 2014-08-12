<div class="profile">

    <div class="name">
        
        <p><?= $_SESSION['user_name'] ?> <?= $_SESSION['user_surname'] ?></p>
        
    </div>

    <hr/>

    <div class="hospital_data">
        
        <p>Anni: <?= $years ?></p>
        <p>Reparto: <?= $_SESSION['user_ward'] ?></p>
        
    </div>

    <hr/>

    <div class="send_email">
        
        <p><a href="mailto:<?= $_SESSION['user_email'] ?>" >Invia email</a></p>
        
    </div>

</div>