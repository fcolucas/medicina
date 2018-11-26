<?php
	session_start();

	require_once('db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$id = isset($_GET['IDRec']) ? $_GET['IDRec'] : 0;
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Prescrição</title>
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
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
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
	    	<div class="col-md-3"></div>
	    	<div class="col-md-8">
		    	<div class="col-md-8 panel panel-default">
		    		<?php
		    			$sqlR = "SELECT nomePaciente, data, hora, observacoes FROM pacientes, receituarios WHERE (idpacientes = pacientes_idpacientes) AND (idreceituarios = $id)";
						$regR = mysqli_fetch_assoc(mysqli_query($link, $sqlR));
		    		?>
		    		<label>Nome: </label><?= $regR['nomePaciente'] ?> <br />
		    		<label>Data: </label><?= date($regR['data'])?> <br />
					<label>Hora: </label><?= $regR['hora']?> <br />
					<table class="col-md-10 panel-body input-group">
						<thead>
						<tr>
							<th>Medicamento</th>
							<th>Dosagem</th>
							<th>Unidade</th>
							<th>Intervalo</th>
						</tr> </thead>
						<tbody>
						<?php
							$sqlP = "SELECT nomeMedicamento, dosagem, unidade, intervalo, tipoIntervalo FROM medicamentos, prescricao WHERE (receituarios_idreceituarios = $id) AND (idmedicamentos = medicamentos_idmedicamentos)";
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
					</tbody> </table>
					<label>Observações: </label><?= $regR['observacoes']?>
					<div class="form-group panel-body">
						<form method='post' action="listaPacientes.php">
							<button type="submit" class="btn btn-primary" name="voltar">Voltar para Listar Pacientes</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</body>
</html>