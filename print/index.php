<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovante</title>
</head>
<body onload='print()'>
    
<?php
    $pdo = new PDO('mysql:host=localhost;dbname=parking', 'root', '');

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = $pdo->prepare("SELECT * FROM parked WHERE id=$id");
        $sql->execute();

        $fetchParked = $sql->fetchObject();

        print '
            <table border="1">
                <tr>
                    <th colspan="2"><h2>Comprovante #'.$fetchParked->id.'</h2></th>
                </tr>
                <tr>
                    <td><b>Nome do cliente:</b></td>
                    <td>'.$fetchParked->client.'</td>
                </tr>
                <tr>
                    <td><b>Carro:</b></td>
                    <td>'.$fetchParked->modelCar.' <b>-</b> '.$fetchParked->licensePlate.'</td>
                </tr>
                <tr>
                    <td><b>Entrada:</b></td>
                    <td>'.$fetchParked->timeStart.'</td>
                </tr>
                <tr>
                    <td><b>Saida:</b></td>
                    <td>'.$fetchParked->timeEnd.'</td>
                </tr>
                <tr>
                    <td><b>Tempo:</b></td>
                    <td>'.$fetchParked->price/3.5.'h</td>
                </tr>
                <tr>
                    <td><b>Preço:</b></td>
                    <td> R$'.$fetchParked->price.'</td>
                </tr>
                <tr>
                    <td><b>Ass. Controlador:</b></td>
                    <td></td>
                </tr>
            </table>
        ';
    }

?>
    <script>
        window.onload = ClosePrint();
        function ClosePrint(){
            setTimeout(function(){
                window.print();
            }, 500);
            window.onfocus = function(){ 
                setTimeout(function(){
                    window.close(); 
                }, 500);
            }
        }
    </script>
</body>
</html>