<?php
    $pdo = new PDO('mysql:host=localhost;dbname=parking', 'root', '');

    if(isset($_POST['client'])){
        $client = $_POST['client'];
        $modelCar = $_POST['modelCar'];
        $licensePlate = $_POST['licensePlate'];
        $id = (int)$_GET['id'];

        $sql = $pdo->prepare("UPDATE parked SET client=?, modelCar=?, licensePlate=? WHERE id=?");
        $sql->execute([$client, $modelCar, $licensePlate, $id]);
        echo '<script>alert("Alterado com sucesso!")</script>';
        header('Location: /estacionamento');
    }
?>

<form action="" method="post"> 
    <?php print   '<input type="text" name="client" id="client" value="'.$_GET['client'].'">'; ?>
    <?php print   '<input type="text" name="modelCar" id="modelCar" value="'.$_GET['modelCar'].'">'; ?>
    <?php print   '<input type="text" name="licensePlate" id="licensePlate" value="'.$_GET['licensePlate'].'">'; ?>
    <input type="submit" value="editar">
</form>

