<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estacionamento</title>
    
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
           
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
    <div class="container">
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

<div class="row">
    <h3>Sistema de estacionamento </h3>
    <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s4">
          <i class="material-icons prefix">account_circle</i>
          <input id="client" type="text" class="validate" name="client">
          <label for="client">Nome do Cliente</label>
        </div>
        <div class="input-field col s4">
          <i class="material-icons prefix">directions_car</i>
          <input id="modelCar" type="tel" class="validate" name="modelCar">
          <label for="modelCar">Modelo do carro</label>
        </div>
        <div class="input-field col s4">
          <i class="material-icons prefix">fiber_pin</i>
          <input id="licensePlate" type="tel" class="validate" name="licensePlate">
          <label for="licensePlate">Placa</label>
        </div>
      </div>
      <input class="waves-effect waves-light btn text-white" style="color: #fff !important" type="submit" value="enviar">
    </form>
  </div>
        

<!-- <form action="" method="post"> 
    <input type="text" placeholder="Nome do cliente" name="client" id="client">
    <input type="text" placeholder="Modelo do carro" name="modelCar" id="modelCar">
    <input type="text" placeholder="Placa do carro" name="licensePlate" id="licensePlate">
    <input type="submit" value="enviar">
</form> -->

<?php
    $sql = $pdo->prepare("SELECT * FROM parked ORDER BY id DESC");
    $sql->execute();

    $fetchParked = $sql->fetchAll();
    $test = 'oia';
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
            <th colspan="3">Ações</th>
        </tr>
<?php
    foreach($fetchParked as $key => $parked){
        print'<tr>';
        print   '<td>'.$parked['id'].'</td>';
        print   '<td>'.$parked['client'].'</td>';
        print   '<td>'.$parked['modelCar'].'</td>';
        print   '<td>'.$parked['licensePlate'].'</td>';
        print   '<td>'.$parked['timeStart'].'</td>';
        if($parked['timeEnd'] == ''){
            print '<td>Em utilização</td>';
            print '<td>Não Finalizado</td>';
        }else{
            print   '<td>'.$parked['timeEnd'].'</td>';
            print   '<td> R$'.$parked['price'].'</td>';
        }
        print   '<td><a class="waves-effect waves-light btn yellow lighten-1 text-black" title="Editar" href="edit/?id='.$parked['id'].'&client='.$parked['client'].'&modelCar='.$parked['modelCar'].'&licensePlate='.$parked['licensePlate'].'"><i class="material-icons right">create</i> </a></td>';
        
        if($parked['timeEnd'] == ''){
            print   '<td><a class="waves-effect waves-light btn" title="Finalizar" href="end/?id='.$parked['id'].'"> <i class="material-icons right">done_all</i> </a></td>';
        }else{
            print   '<td><i class="material-icons right waves-effect waves-light btn grey lighten-1" title="Finalizar">done_all</i></td>';
        }
        if($parked['timeEnd'] == ''){
            print   '<td><i class="material-icons right waves-effect waves-light btn grey lighten-1" title="Imprimir comprovante">local_printshop</i></td>';
        }else{
            print   '<td><a class="waves-effect waves-light btn" href="print/?id='.$parked['id'].'" target="_blank" title="Imprimir comprovante"><i class="material-icons right">local_printshop</i></a></td>';
        }
        print'<tr>';
    }
?>
    </table>
    </div>
</body>
</html>