<?php
	session_start();

	if(isset($_POST['btn_cancela'])){
		header('Location: home.php');
	}

	if(isset($_POST['btn_cadastra'])){
		require_once('db.class.php');

	    $idPaciente = $_POST["idPaciente"];
		$idMedicamento = $_POST["idMedicamento"];
		$dosagem = $_POST["dosagem"];
		$intervalo = $_POST["intervalo"];
		$tipoIntervalo = $_POST["tipoIntervalo"];
		$observacoes = $_POST["observacoes"];
		$idmedico = $_SESSION['idmedicos'];
		date_default_timezone_set('America/Fortaleza');
		$data = date('Y/m/d');
		$hora = date('H:i:s');

	    $objDb = new db();
	    $link = $objDb->conecta_mysql();

	    $sql = "INSERT INTO receituarios VALUES (NULL, '$idPaciente', '$idmedico', '$data', '$hora', '$observacoes')";

	    //executar a query
	    if(mysqli_query($link, $sql)){
	    	$sql_id = "SELECT LAST_INSERT_ID()";
	    	$reg = mysqli_fetch_assoc(mysqli_query($link, $sql_id));
	    	$idreceituarios = $reg['LAST_INSERT_ID()'];
	    	$inc = 0;
	    	while($inc < count($idMedicamento)){
	    		$sql = "INSERT INTO prescricao VALUES (NULL, '$idreceituarios', '$idMedicamento[$inc]', '$dosagem[$inc]', '$intervalo[$inc]', '$tipoIntervalo[$inc]')";
	    		mysqli_query($link, $sql) or die("Erro ao cadastrar prescrição");
	    		$inc++;
	    }
	    }else{
	        echo "Erro ao registrar o usuário!";
	    }
	}
?>

<?php

    if(isset($_SESSION['logado']) && $_SESSION['logado']==true){}
    else header('Location: index.php');
?>

	<!DOCTYPE HTML>
	<html lang="pt-br">
		<head>
			<meta charset="UTF-8">

			<title>Receituário Cadastrado</title>
			
			<!-- jquery - link cdn -->
			<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

			<!-- bootstrap - link cdn -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		
		</head>

		<body> 
			<!--Static navbar -->
		    <nav class="navbar navbar-default navbar-static-top">
		      <div class="container">
		        <div class="navbar-header">
		          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            <span class="sr-only">Toggle navigation</span>
		          </button>
		        </div>
		        
		        <div id="navbar" class="navbar-collapse collapse">
		          <ul class="nav navbar-nav navbar-right">
		          	<li><a href="cadastroPacientes.php">Cadastrar Paciente</a></li>
		          	<li><a href="listaPacientes.php">Listar Pacientes</a></li>
		          	<li><a href="criarReceituario.php">Criar Receituário</a></li>
		            <li><a href="?Sair=1">Sair</a></li>
		            	<?php	
						if(isset($_GET['Sair']) && $_GET['Sair']==1){
							unset($_SESSION['logado']);
							session_destroy();
							header('Location: index.php');
						}
						?>
		          </ul>
		        </div> <!--.nav-collapse -->
		      </div>
		    </nav>
		    <div class="container">
		    	<br /><br />
		    	<div class="col-md-4"></div>
		    	<div class="col-md-6">
		    		<h2> Prescrição cadastrada com Sucesso! </h2>
		    		<br />
		    		<?php
		    			$sql = "SELECT nomePaciente FROM pacientes WHERE (idpacientes = $idPaciente)";
		    			$reg = mysqli_fetch_assoc(mysqli_query($link, $sql));
		    			$sqlR = "SELECT * FROM receituarios WHERE (idreceituarios = $idreceituarios)";
						$regR = mysqli_fetch_assoc(mysqli_query($link, $sqlR));
		    		?>
		    		<strong>Nome: </strong><?= $reg['nomePaciente'] ?> <br />
		    		<strong>Data: </strong><?= date($regR['data'])?> <br />
					<strong>Hora: </strong><?= $regR['hora']?> <br /> <br />
					<strong>Observações: </strong><?= $regR['observacoes']?> <br /> <br />
					<table class="col-md-8">
						<tr>
							<th>Medicamento</th>
							<th>Dosagem</th>
							<th>Unidade</th>
							<th>Intervalo</th>
						</tr>
						<?php
							$sqlP = "SELECT nomeMedicamento, dosagem, unidade, intervalo, tipoIntervalo FROM medicamentos, prescricao WHERE (receituarios_idreceituarios = $idreceituarios) AND (idmedicamentos = medicamentos_idmedicamentos)";
							$res = mysqli_query($link, $sqlP);
							while($regP = mysqli_fetch_assoc($res)){
								echo "<tr>";
								echo "<td>".$regP['nomeMedicamento']."</td>";
								echo "<td>".$regP['dosagem']."</td>";
								echo "<td>".$regP['unidade']."</td>";
								echo "<td>".$regP['intervalo']." ".$regP['tipoIntervalo']."</td>";
								echo "</tr>";
							}
						?>
					</table>
				</div>
			<form method='post' action="home.php">
				<button type="submit" class="btn btn-primary" name="voltar">Voltar para Home</button>
			</form>
			</div>
		</body>
	</html>