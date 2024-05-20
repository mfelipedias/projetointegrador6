<?php
// Conecta ao banco de dados
$servername = "univesp.mysql.uhserver.com";
$username = "univesp";
$password = "Pr@jeto4";
$dbname = "univesp";
$resposta = 0;
$conn = new mysqli($servername, $username, $password, $dbname);

// Checa se a conexão está ok
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Insere os dados na tabela 'dados_sensor'
$luminosidade = $_POST['luminosidade'];
$temperatura = $_POST['temperatura'];
$tensao = $_POST['tensao'];
$corrente = $_POST['corrente'];
$potencia = $_POST['potencia'];

$sql = "INSERT INTO dados_usina (luminosidade, temperatura, tensao, corrente, potencia) VALUES ('$luminosidade', '$temperatura', '$tensao', '$corrente', '$potencia')";

if ($conn->query($sql) === TRUE) {
    include 'db.php';
    $sql = "SELECT * FROM `dados_usina` ORDER BY registro DESC LIMIT 1";
    $busca = mysqli_query($db, $sql);

    while ($array = mysqli_fetch_array($busca)) {
        $analiseregistro = $array['registro'];
        }
        $hora=intval(date('G', strtotime($analiseregistro)));
        $minuto = intval(date('i', strtotime($analiseregistro)));
        $segundo = intval(date('s', strtotime($analiseregistro)));
        echo $resposta=$hora.$minuto.$segundo;
        
        } else {
            echo 0;
        }
$conn->close();
?>