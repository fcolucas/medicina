<?php
$idPaciente = $_POST["idPaciente"];
$idMedicamento = $_POST["idMedicamento"];
$dosagem = $_POST["dosagem"];
$intervalo = $_POST["intervalo"];
$tipoIntervalo = $_POST["tipoIntervalo"];

var_dump($idPaciente);
echo '<br />';
var_dump($idMedicamento);
echo '<br />';
var_dump($dosagem);
echo '<br />';
var_dump($intervalo);
echo '<br />';
var_dump($tipoIntervalo);
echo '<br />';
/*
$i = 0;
$strcon = mysqli_connect('localhost', 'root', '', 'banco_teste') or die('<br>Não foi possível conectar as páginas');

while($i < count($nome)){
	$sql = "INSERT INTO cadastro VALUES ('$nome[$i]', '$sobrenome[$i]', '$sexo[$i]')";
	mysqli_query($strcon, $sql) or die("Erro ao cadastrar registro!");
	$i++;
}
mysqli_close($strcon);
echo "Cadastrado com sucesso";
echo '<form action="cadastroclientes.php" method="POST">';
echo '<input type="button" name="voltar" value="voltar" />';
echo '</form>';
*/
?>