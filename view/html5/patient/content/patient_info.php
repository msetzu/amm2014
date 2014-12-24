<div class="patient">

    <div class="birth_record">

        <p class="name"><?= $patient->getName() ?> <?= $patient->getSurname() ?></p>
        <p>Age: <?php
                    $bd = $patient->getBirthday();
                    $age=$bd->diff(new DateTime("now", new DateTimeZone('Europe/Rome')));
                    $years="";
                    $months="";
                    $days="";

                    switch($age->y){

                        case 1:
                            $years="$age->y year,";
                        break;
                        default:
                            $years="$age->y years,";
                        break;

                    }

                    switch($age->m){

                        case 1:
                            $months="$age->m month,";
                        break;
                        default:
                            $months="$age->m months,";
                        break;

                    }

                    switch($age->d){

                        case 1:
                            $days="and $age->d day.";
                        break;
                        default:
                            $days="$age->d days.";
                        break;

                    }


                    echo $years." ".$months." ".$days;

                ?>
        </p>
    </div>

    <hr/>

    <div class="hospital_data">

        <p>Ward: <?= $patient->getWard() ?></p>
        <p>Bed: <?= $patient->getBedNumber() ?></p>

    </div>

</div>
