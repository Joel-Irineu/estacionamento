<?php
    $pdo = new PDO('mysql:host=localhost;dbname=parking', 'root', '');

    //insert
    if(isset($_POST['client'])){
        $sql = $pdo->prepare("INSERT INTO parked (id, client, modelCar, licensePlate, timeStart) VALUES (NULL,?,?,?,?)");

        date_default_timezone_set('America/Sao_Paulo');
        $dateTime = date('y-m-d h:i:s a', time());

        $sql->execute(array($_POST['client'],$_POST['modelCar'],$_POST['licensePlate'],$dateTime));
        echo '<script>alert("inserido com sucesso!")</script>';
    }

    
?>

<form action="" method="post"> 
    <input type="text" placeholder="Nome do cliente" name="client" id="client">
    <input type="text" placeholder="Modelo do carro" name="modelCar" id="modelCar">
    <input type="text" placeholder="Placa do carro" name="licensePlate" id="licensePlate">
    <input type="submit" value="enviar">
</form>

<?php
    $sql = $pdo->prepare("SELECT * FROM parked");
    $sql->execute();

    $fetchParked = $sql->fetchAll();
?>
    <table border='1'>
        <tr>
            <th>#id</th>
            <th>Cliente</th>
            <th>carro</th>
            <th>placa</th>
            <th>Entrada</th>
            <th>Saida</th>
            <th>Preço</th>
            <th colspan="2">Ações</th>
        </tr>
<?php
    foreach($fetchParked as $key => $parked){
        print'<tr>';
        print   '<td>'.$parked['id'].'</td>';
        print   '<td>'.$parked['client'].'</td>';
        print   '<td>'.$parked['modelCar'].'</td>';
        print   '<td>'.$parked['licensePlate'].'</td>';
        print   '<td>'.$parked['timeStart'].'</td>';
        if($parked['timeEnd'] == $parked['timeStart']){
            print '<td>Em utilização</td>';
            print '<td>Não Finalizado</td>';
        }else{
            print   '<td>'.$parked['timeEnd'].'</td>';
            print   '<td>'.$parked['price'].'</td>';
        }
        print   '<td><a href="edit/?id='.$parked['id'].'&client='.$parked['client'].'&modelCar='.$parked['modelCar'].'&licensePlate='.$parked['licensePlate'].'"> editar </a></td>';
        print   '<td><a href="end/?id='.$parked['id'].'"> Finalizar </a></td>';
        print'<tr>';
    }
?>
    </table>