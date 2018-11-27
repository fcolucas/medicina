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

        <script type="text/javascript">
        $(document).ready(function(){
			//verificar se os campos de usuário e senha foram devidamente preenchidos
			$('#btn_cadastra').click(function(){
				var campo_vazio = false;
				if($('#campo_paciente').val() == ''){
					$('#campo_paciente').css({'border-color': '#A94442'});
					campo_vazio = true;
				} else {
					$('#campo_paciente').css({'border-color': '#CCC'});
				}

				if($('#campo_medicamento').val() == ''){
					$('#campo_medicamento').css({'border-color': '#A94442'});
					campo_vazio = true;
				} else {
					$('#campo_medicamento').css({'border-color': '#CCC'});
				}

				if($('#campo_dosagem').val() == ''){
					$('#campo_dosagem').css({'border-color': '#A94442'});
					campo_vazio = true;
				} else {
					$('#campo_dosagem').css({'border-color': '#CCC'});
				}

				if($('#campo_intervalo').val() == ''){
					$('#campo_intervalo').css({'border-color': '#A94442'});
					campo_vazio = true;
				} else {
					$('#campo_intervalo').css({'border-color': '#CCC'});
				}

				if($('#campo_tipoInt').val() == ''){
					$('#campo_tipoInt').css({'border-color': '#A94442'});
					campo_vazio = true;
				} else {
					$('#campo_tipoInt').css({'border-color': '#CCC'});
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
	    	<div class="col-md-2"></div>
	    	<div class="col-md-8">
	    	<h2>Receituário</h2>
	    	<div class="col-md-12 panel panel-default">
				<form method="post" action="validaReceituario.php" id="criaReceituario">
					<div class="form-group panel-body">
						<label>Nome do Paciente:</label>
						<select name="idPaciente" id="campo_paciente" class="form-control">
							<option value="">Selecione o Paciente...</option>
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

					<div id='corpoReceita' class="panel-body input-group">
						<table id='receituario'>
							<thead>
								<tr>
									<th> Medicamento </th>
									<th> Dosagem </th>
									<th> Intervalo </th>
									<th> Tipo de Intervalo </th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<select name="idMedicamento[]" id="campo_medicamento" class="form-control">
										<option value="">Selecione o medicamento...</option>
										<?php
											$result_remedios = "SELECT * FROM medicamentos";
											$res = mysqli_query($link, $result_remedios) or die("Erro na consulta!");
											while($row_remedios = mysqli_fetch_array($res)){ ?>
												<option value='<?= $row_remedios['idmedicamentos']; ?>'> <?= $row_remedios['nomeMedicamento']." ".$row_remedios['quantidade']." ".$row_remedios['unidade']; ?></option> <?php } ?>
										</select> 
									</td>

									<td>
										<input type="text" class="form-control" name="dosagem[]" id="campo_dosagem" placeholder="Digite a dosagem">
									</td>

									<td>
										<input type="text" class="form-control" name="intervalo[]" id="campo_intervalo" placeholder="Digite o intervalo de medicação">
									</td>

									<td>
										<select name="tipoIntervalo[]" id="campo_tipoInt" class="form-control">
											<option value="">Selecione o tipo de intervalo...</option>
											<option>minutos</option>
											<option>horas</option>
											<option>dias</option>
											<option>senamas</option>
										</select>
									</td>
									<td>
										<button type="button" class="btn btn-primary" id="add_campo"> + </button>
									</td>
								</tr> 
							</tbody></table>
					</div>
						
					<div class="form-group panel-body">
						<label>Observações:</label>
						<textarea class="form-control" placeholder="Observações" cols="50" rows="3" name="observacoes"></textarea>
					</div>

					<div class="form-group panel-body">
						<button type="submit" class="btn btn-primary" id="btn_cadastra" name="btn_cadastra">Cadastrar</button>
						<button type="submit" class="btn btn-primary" name="btn_cancela">Cancelar</button>
					</div>
				</form>

				<script>
					//https://api.jquery.com/click/
            		$("#add_campo").click(function () {
					//https://api.jquery.com/append/
                		$("#receituario").append(
								'<tr>' +
									'<td>'+
										'<select name="idMedicamento[]" id="campo_medicamento" class="form-control">'+
										'<option value="">Selecione o medicamento...</option>'+
										'<?php
											$result_remedios = "SELECT * FROM medicamentos";
											$res = mysqli_query($link, $result_remedios) or die("Erro na consulta!");
											while($row_remedios = mysqli_fetch_assoc($res)){ ?>
												<option value="<?= $row_remedios['idmedicamentos']; ?>"> <?= $row_remedios['nomeMedicamento']." ".$row_remedios['quantidade']." ".$row_remedios['unidade']; ?></option> <?php } ?>'+
										'</select>'+ 
									'</td>'+

									'<td>'+
										'<input type="text" class="form-control" id="campo_dosagem" name="dosagem[]" placeholder="Digite a dosagem">'+
									'</td>'+

									'<td>'+
										'<input type="text" class="form-control" id="campo_intervalo" name="intervalo[]" placeholder="Digite o intervalo de medicação">'+
									'</td>'+

									'<td>'+
										'<select name="tipoIntervalo[]" id="campo_tipoInt" class="form-control">'+
											'<option value="">Selecione o tipo de intervalo...</option>'+
											'<option>minutos</option>'+
											'<option>horas</option>' +
											'<option>dias</option>' +
											'<option>senamas</option>'+
										'</select>'+
									'</td>'+
									'<td>'+
									'<button type="button" class="btn btn-primary" onclick="$(this).parent().parent().remove()"> - </button>'+
									'</td>'+
								'</tr>');
            		});
				</script>
			</div>
		</div>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</body>
</html>