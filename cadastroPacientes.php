<?php
    session_start();

    if(isset($_SESSION['logado']) && $_SESSION['logado']==true){}
    else header('Location: index.php');
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Consultório Médico - Cadastro de Paciente</title>
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script>
		$(document).ready(function(){
			$('#btn_cadastra').click(function(){
				var campo_vazio = false;

				if($('#campo_nome').val() == ''){
					$('#campo_nome').css({'border-color': '#A94442'});
					campo_vazio = true;
				} else {
					$('#campo_nome').css({'border-color': '#CCC'});
				}

				if($('#campo_data').val() == ''){
					$('#campo_data').css({'border-color': '#A94442'});
					campo_vazio = true;
				} else {
					$('#campo_data').css({'border-color': '#CCC'});
				}

				if($('#campo_sexo').val() == ''){
					$('#campo_sexo').css({'border-color': '#A94442'});
					campo_vazio = true;
				} else {
					$('#campo_sexo').css({'border-color': '#CCC'});
				}

				if(campo_vazio) return false;
			});
		});				
		</script>
	
	</head>

	<body>

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
		    	<h2>Cadastro de Pacientes</h2>
		    	<div class="col-md-8 panel panel-default">
					<form method="post" action="validaPaciente.php" id="cadastraPaciente">
						<div class="form-group panel-body">
							<label>Nome do Paciente: </label><input type="text" class="form-control" id="campo_nome" name="nomePaciente" placeholder="Digite o nome">
						</div>

						<div class="form-group panel-body">
							<label>Data de Nascimento: </label><input type="date" class="form-control" id="campo_data" name="dataNascimento" >
						</div>

						<div class="form-group panel-body">
							<label>Sexo: </label>
							<select name="sexo" id="campo_sexo" class="form-control">
								<option value="">Selecione sexo...</option>
								<option value="M">Masculino</option>
								<option value="F">Feminino</option>
							</select>
						</div>
						
						<div class="form-group panel-body">
							<button type="submit" class="btn btn-primary" id="btn_cadastra" name="btn_cadastra">Cadastrar</button>
							<button type="submit" class="btn btn-primary" name="btn_cancela">Cancelar</button>
						</div>
					</form>
				</div>
			</div>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</body>
</html>