<?php
	session_start();
	require_once('db.class.php');

	if(isset($_SESSION['logado']) && $_SESSION['logado']==true){}
	else header('Location: index.php');
	
	$idmedicos = $_SESSION['idmedicos'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();
?>

<!DOCTYPE html>
<html lang="eng">
	<head>
		<meta charset="UTF-8">

		<title>Lista de Pacientes</title>
		<link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
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
	    	<div class="col-md-6">
		    	<h2> Meus Pacientes </h2>
				<table id="table_pacientes">
					<thead>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>Data de Nascimento</th>
						<th>Sexo</th>
						<th>Ações</th>
					</tr>
					</thead>
					<tbody>
					<?php
						$result_pacientes = "SELECT * FROM pacientes WHERE (medicos_idmedicos = $idmedicos)";
						$res = mysqli_query($link, $result_pacientes);
						while($regP = mysqli_fetch_assoc($res)){
							echo "<tr>";
							echo "<td>".$regP['idpacientes']."</td>";
							echo "<td>".$regP['nomePaciente']."</td>";
							echo "<td>".$regP['dataNascimento']."</td>";
							echo "<td>".$regP['sexo']."</td>";
							echo "<td> <a href='listaPacientes.php?ID=".$regP['idpacientes']."'>Listar Receitas</a> </td>";
							echo "</tr>";
						}
					?>
					</tbody>
				</table>
			</div>
			<div class="col-md-6">
	    		<?php
	    			$id = isset($_GET['ID']) ? $_GET['ID'] : 0;
	    			if($id > 0){ ?>
			    		<h2> Receitas </h2>
						<table id="table_receituarios">
							<thead>
							<tr>
								<th>ID Receita</th>
								<th>Data</th>
								<th>Hora</th>
								<th>Ações</th>
							</tr>
							</thead>
							<tbody>
							<?php
								$result_receituarios = "SELECT idreceituarios, data, hora FROM receituarios WHERE (pacientes_idpacientes = $id)";
								$res = mysqli_query($link, $result_receituarios);
								while($regP = mysqli_fetch_assoc($res)){
									echo "<tr>";
									echo "<td>".$regP['idreceituarios']."</td>";
									echo "<td>".$regP['data']."</td>";
									echo "<td>".$regP['hora']."</td>";
									echo "<td> <a href='getPrescricao.php?IDRec=".$regP['idreceituarios']."'>Listar Prescriçâo</a> </td>";
									echo "</tr>";
								}
							?>
							</tbody>
						</table>
					<?php } ?>
	    	</div>
			<br/>
		</div>

  		<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
		<script>
		$(document).ready(function(){
		  $('#table_pacientes').DataTable({
		      "language": {
		            "lengthMenu": "Mostrando _MENU_ registros por página",
		            "zeroRecords": "Nada encontrado",
		            "info": "Mostrando página _PAGE_ de _PAGES_",
		            "infoEmpty": "Nenhum registro disponível",
		            "infoFiltered": "(filtrado de _MAX_ registros no total)"
		        }
		    });
		  $('#table_receituarios').DataTable({
		      "language": {
		            "lengthMenu": "Mostrando _MENU_ registros por página",
		            "zeroRecords": "Nada encontrado",
		            "info": "Mostrando página _PAGE_ de _PAGES_",
		            "infoEmpty": "Nenhum registro disponível",
		            "infoFiltered": "(filtrado de _MAX_ registros no total)"
		        }
		    });
		});
		</script>

	</body>

</html>