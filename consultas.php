<?php
session_start();
require_once('db.class.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<h2>Sua Busca</h2>
</body>
	<?php
		
		if(isset($_SESSION['logado']) && $_SESSION['logado']==true){}
		else header('Location: index.php');

		$idmedicos = $_SESSION['idmedicos'];
		$buscar = $_POST['buscar'];
		$result_pacientes = "SELECT * FROM pacientes WHERE (nomePaciente LIKE '%$buscar%') AND (medicos_idmedicos = $idmedicos) LIMIT 5";
		
		$objDb = new db();
		$link = $objDb->conecta_mysql();

		if ($resultado_pacientes = mysqli_query($link, $result_pacientes)) {
			while($rows_pacientes = mysqli_fetch_array($resultado_pacientes)){
				echo "Nome do paciente: ".$rows_pacientes['nomePaciente']."<br>";
			}
		} else echo "Falha na consulta!";
		
	?>

</html>