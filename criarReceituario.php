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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
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
	    	
	    	<br />
	    	<div class="col-md-4"></div>
	    	<div>
	    		<h2>Receituário</h2>
	    		<br />
				<form method="post" action="validaReceituario.php" id="criaReceituario">
					<div class="form-group">
						Nome do Paciente:
						<select name="idPaciente" class="form-control">
							<option>Selecione o Paciente...</option>
							<?php
							$idmedico = $_SESSION['idmedicos'];
							$result_pacientes = "SELECT * FROM pacientes WHERE medicos_idmedicos = $idmedico";
							$objDb = new db();
							$link = $objDb->conecta_mysql();
							$res_pacientes = mysqli_query($link, $result_pacientes) or die("Erro na consulta!");
							while($row_pacientes = mysqli_fetch_assoc($res_pacientes)){ ?>
							<option value="<?= $row_pacientes['idpacientes']; ?>"> <?= $row_pacientes['nomePaciente']; ?></option> <?php } ?>
						</select>
					</div>

					<div id='corpoReceita'>
						<table id='receituario'>
								<tr>
									<th> Medicamento </th>
									<th> Dosagem </th>
									<th> Intervalo </th>
									<th> Tipo de Intervalo </th>
									<th></th>
								</tr>
								<tr>
									<td>
										<select name="idMedicamento[]" class="form-control">
										<option>Selecione o medicamento...</option>
										<?php
											$result_remedios = "SELECT * FROM medicamentos";
											$res = mysqli_query($link, $result_remedios) or die("Erro na consulta!");
											while($row_remedios = mysqli_fetch_array($res)){ ?>
												<option value='<?= $row_remedios['idmedicamentos']; ?>'> <?= $row_remedios['nomeMedicamento']; ?></option> <?php } ?>
										</select> 
									</td>

									<td>
										<input type="text" class="form-control" name="dosagem[]" placeholder="Digite a dosagem">
									</td>

									<td>
										<input type="text" class="form-control" name="intervalo[]" placeholder="Digite o intervalo de medicação">
									</td>

									<td>
										<select name="tipoIntervalo[]" class="form-control">
											<option>Selecione o tipo de intervalo...</option>
											<option>minutos</option>
											<option>horas</option>
											<option>dias</option>
											<option>senamas</option>
										</select>
									</td>
									<td>
										<button type="button" class="btn btn-primary" id="add_campo"> + </button>
									</td>
								</tr> </div>
						</table>
					</div>
					<br />

					<button type="submit" class="btn btn-primary" name="btn_cadastra">Cadastrar</button>
					<button type="submit" class="btn btn-primary" name="btn_cancela">Cancelar</button>
					<!-- Parte a ser mudada!! -->

				</form>
				<script>
					//https://api.jquery.com/click/
            		$("#add_campo").click(function () {
					//https://api.jquery.com/append/
                		$("#receituario").append(
								'<tr>' +
									'<td>'+
										'<select name="idMedicamento[]" class="form-control">'+
										'<option>Selecione o medicamento...</option>'+
										'<?php
											$result_remedios = "SELECT * FROM medicamentos";
											$res = mysqli_query($link, $result_remedios) or die("Erro na consulta!");
											while($row_remedios = mysqli_fetch_assoc($res)){ ?>
												<option value="<?= $row_remedios['idmedicamentos']; ?>"> <?= $row_remedios['nomeMedicamento']; ?></option> <?php } ?>'+
										'</select>'+ 
									'</td>'+

									'<td>'+
										'<input type="text" class="form-control" name="dosagem[]" placeholder="Digite a dosagem">'+
									'</td>'+

									'<td>'+
										'<input type="text" class="form-control" name="intervalo[]" placeholder="Digite o intervalo de medicação">'+
									'</td>'+

									'<td>'+
										'<select name="tipoIntervalo[]" class="form-control">'+
											'<option>Selecione o tipo de intervalo...</option>'+
											'<option>minutos</option>'+
											'<option>horas</option>' +
											'<option>dias</option>' +
											'<option>senamas</option>'+
										'</select>'+
									'</td>'+
									'<td><button type="button" class="btn btn-primary" onclick="$(this).parent().parent().remove()"> - </button></td>'+
								'</tr>');
            		});
				</script>
			</div>
	</body>
</html>