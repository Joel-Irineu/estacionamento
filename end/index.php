<?php
    $pdo = new PDO('mysql:host=localhost;dbname=parking', 'root', '');

    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        
        date_default_timezone_set('America/Sao_Paulo');
        $dateTime = date('y-m-d h:i:s a', time());
        
        $sql = $pdo->prepare("UPDATE parked SET timeEnd=? WHERE id=?");
        $sql->execute([$dateTime, $id]);

        $sql = $pdo->prepare("SELECT timeStart, timeEnd FROM parked WHERE id=$id");
        $sql->execute();

        $fetchParked = $sql->fetchObject();

        $timeStart = new DateTime($fetchParked->timeStart);
        $timeEnd = new DateTime($fetchParked->timeEnd);

        $timeDif = $timeStart->diff($timeEnd);

        if($timeDif->format('%h') <= 0 && $timeDif->format('%d') <= 0 && $timeDif->format('%h') > 20){
            $time = 1;
        }else{
            $time = $timeDif->format('%h');
        }

        

        $price = $time * 3.5;

        $sql = $pdo->prepare("UPDATE parked SET price=? WHERE id=?");
        $sql->execute([$price, $id]);

        print $price;
        header('Location: /estacionamento');
    }
?>

<h1>Carregando...</h1>