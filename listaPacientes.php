<?php
	session_start();
	require_once('db.class.php');

	if(isset($_SESSION['logado']) && $_SESSION['logado']==true){}
	else header('Location: index.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Lista de Pacientes</title>


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
	    	
	    	<br /> <br />
	    	
	    	<div class="row-md-4">
	    		<h1>Lista de Pacientes</h1>
	    		<br />
				<form method="POST" action="consultas.php">
					Buscar: <input type="text" class="form-control" name="buscar" placeholder="BUSCAR">
					<button type="submit" class="btn btn-primary" name="btn_ok">OK</button>
					<br /><br />

				</form>
			</div>
		</form>

		<?php

			//Receber o número da página
			$pagina_atual = filter_input(INPUT_GET, 'pagina',FILTER_SANITIZE_NUMBER_INT);

			$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

			//Setar a quantidade de itens por página
			$qtd_result_pg = 4;

			//Início da vizualização
			$inicio = ($qtd_result_pg * $pagina) - $qtd_result_pg;

			$idmedicos = $_SESSION['idmedicos'];
			$result_pacientes = "SELECT * FROM pacientes WHERE (medicos_idmedicos = $idmedicos) LIMIT $inicio, $qtd_result_pg";

			$objDb = new db();
			$link = $objDb->conecta_mysql();

			$resultado_pacientes = mysqli_query($link, $result_pacientes);
			while ($row_paciente = mysqli_fetch_assoc($resultado_pacientes)){
				echo "ID: " . $row_paciente['idpacientes'] . "<br>";
				echo "Nome: " . $row_paciente['nomePaciente'] . "<br>";
				echo "Data de nascimento: " . $row_paciente['dataNascimento'] . "<br>";
				echo "Sexo: " . $row_paciente['sexo'] . "<br><hr>";
			}

			//Paginação - Somar a quantidade de usuários
			$result_pg = "SELECT COUNT(idpacientes) AS num_result FROM pacientes";

			$resultado_pg = mysqli_query($link, $result_pg);
			$row_pg = mysqli_fetch_assoc($resultado_pg);
			//echo $row_pg['num_result'];
			//Quantidade de página
			$quantidade_pg = ceil($row_pg['num_result'] / $qtd_result_pg);

			//Limitar os links antes e depois
			$max_links = 2;

			echo "<a href='listaPacientes.php?pagina=1'>Primeira</a> ";

			for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
				if($pag_ant >= 1){
					echo "<a href='listaPacientes.php?pagina=$pag_ant'>$pag_ant</a> ";
				}
			}

			echo "$pagina ";
			for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
				if($pag_dep <= $quantidade_pg){
					echo "<a href='listaPacientes.php?pagina=$pag_dep'>$pag_dep</a> ";
				}
			}

			echo "<a href='listaPacientes.php?pagina=$quantidade_pg'>Ultima</a> ";

		?>

	</body>

</html>