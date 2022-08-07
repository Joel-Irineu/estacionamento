<?php
    $pdo = new PDO('mysql:host=localhost;dbname=parking', 'root', '');
?>

<form action="" method="post"> 
    <input type="text" name="name" id="name">
    <input type="text" name="modelCar" id="modelCar">
    <input type="text" name="licensePlate" id="licensePlate">
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
        print   '<td>'.$parked['timeEnd'].'</td>';
        print   '<td>'.$parked['price'].'</td>';
        print   '<td><a href="#"> editar </a></td>';
        print   '<td><a href="#"> Finalizar </a></td>';
        print'<tr>';
    }
?>
    </table>