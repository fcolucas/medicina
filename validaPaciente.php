<?php
	session_start();
	require_once('db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$id = isset($_GET['sucess']) ? $_GET['sucess'] : 0;
	if(!$id){
		if(isset($_POST['btn_cancela'])){
			header('Location: home.php');
		}
	
		if(isset($_POST['btn_cadastra'])){
		    $nomePaciente = $_POST['nomePaciente'];
		    $dataNasc = $_POST['dataNascimento'];
		    $sexo = $_POST['sexo'];
		    $idmedico = $_SESSION['idmedicos'];

		    $sql = "INSERT INTO pacientes (idpacientes, medicos_idmedicos, nomePaciente, dataNascimento, sexo) VALUES ('NULL', '$idmedico','$nomePaciente', '$dataNasc', '$sexo') ";
	
		    //executar a query
		    if(mysqli_query($link, $sql)){
		    	$sql_id = "SELECT LAST_INSERT_ID()";
	    		$reg = mysqli_fetch_assoc(mysqli_query($link, $sql_id));
	    		$id = $reg['LAST_INSERT_ID()'];
		    	header('Location: validaPaciente.php?sucess='.$id);
		    }else{
		        echo "Erro ao registrar o usuário!";
		    }
		}
	}

    if(isset($_SESSION['logado']) && $_SESSION['logado']==true){}
    else header('Location: index.php');
?>

	<!DOCTYPE HTML>
	<html lang="pt-br">
		<head>
			<meta charset="UTF-8">

			<title>Paciente Cadastrado</title>
			
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
		    	<div class="col-md-4"></div>
		    	<div class="col-md-8">
		    		<h2> Paciente cadastrado com sucesso! </h2>
		    		<div class="col-md-8 panel panel-default">
			    		<?php
			    			$sql = "SELECT * FROM pacientes WHERE (idpacientes = '$id')";
			    			$res = mysqli_query($link, $sql);
			    			$reg = mysqli_fetch_array($res);
			    		?>
			    		<label>Nome: </label><?= $reg['nomePaciente'] ?> <br />
			    		<label>Data de Nascimento: </label><?= date($reg['dataNascimento'])?> <br />
						<label>Sexo: </label><?= $reg['sexo']?> <br />
						<div class="form-group panel-body">
							<form method='post' action="home.php">
								<button type="submit" class="btn btn-primary" name="voltar">Voltar para Home</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		</body>
	</html>