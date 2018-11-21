<?php
    session_start();

    if(isset($_SESSION['logado']) && $_SESSION['logado']==true){}
    else header('Location: index.php');

	require_once('db.class.php');
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Consultório Médico - Receituário</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
	</head>

	<body>

		<nav class="navbar navbar-default navbar-static-top">
		      <div class="container">
		        <div class="navbar-header">
		          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            <span class="sr-only">Toggle navigation</span>
		          </button>
		        </div>
		        
		        <div id="navbar" class="navbar-collapse collapse">
		          <ul class="nav navbar-nav navbar-right">
		          	<li><a href="cadastroPacientes.html">Cadastrar Paciente</a></li>
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
	    	
	    	<br /> <br />
	    	
	    	<div class="col-md-4"></div>
	    	<div class="col-md-4">
	    		<h2>Receituário</h2>
	    		<br />
				<form method="post" action="criarReceituario.php" id="criaReceituario">
					<div class="form-group">
						Nome do Paciente:
						<select name="nomePaciente" class="form-control">
							<option>Selecione Paciente...</option>
							<?php
							$idmedico = $_SESSION['idmedicos'];
							$result_pacientes = "SELECT * FROM pacientes WHERE medicos_idmedicos = $idmedico";
							$objDb = new db();
							$link = $objDb->conecta_mysql();
							$res_pacientes = mysqli_query($link, $result_pacientes) or die("Erro na consulta!");
							while($row_pacientes = mysqli_fetch_assoc($res_pacientes)){ ?>
							<option value="<?= $row_pacientes['idpacientes']; ?>"> <?= $row_pacientes['nomePaciente']; ?></option> <?php
						}
					?>
						</select>
					</div>
					<!-- Parte a ser mudada!! -->
					<div class="form-group">
						Data de Nascimento: <input type="date" class="form-control" name="dataNascimento" >
					</div>

					<div class="form-group">
						Sexo:
						<input type="radio" name="sexo" value="M" />Masculino
						<input type="radio" name="sexo" value="F" />Feminino <br/>
					</div>
					
					<button type="submit" class="btn btn-primary" name="btn_cadastra">Cadastrar</button>
					<button type="submit" class="btn btn-primary" name="btn_cancela">Cancelar</button>
					<!-- Parte a ser mudada!! -->

				</form>
			</div>
	
	</body>
</html>