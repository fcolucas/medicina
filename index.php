<?php
	$erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Controle Médico</title>
	
	<!-- jquery - link cdn -->
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

	<!-- bootstrap - link cdn -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<script>
		$(document).ready(function(){
			//verificar se os campos de usuário e senha foram devidamente preenchidos
			$('#btn_login').click(function(){
				var campo_vazio = false;

				if($('#campo_usuario').val() == ''){
					$('#campo_usuario').css({'border-color': '#A94442'});
					campo_vazio = true;
				} else {
					$('#campo_usuario').css({'border-color': '#CCC'});
				}

				if($('#campo_senha').val() == ''){
					$('#campo_senha').css({'border-color': '#A94442'});
					campo_vazio = true;
				} else {
					$('#campo_senha').css({'border-color': '#CCC'});
				}

				if(campo_vazio) return false;
			});
		});				
		</script>
</head>
<body>
	<h1>Controle Médico</h1>
		<div class="col-md-12">
			<form method="post" action="login.php" id="formLogin">
				<div class="form-group">
					<input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" style="width: 176px; height: 39px;" />
				</div>
				<div class="form-group">
					<input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" style="width: 176px; height: 39px;" />
				</div>
				<button type="buttom" class="btn btn-primary" name="btn" id="btn_login">Entrar</button>			
			</form>
			<?php
				if($erro == 1){
					echo '<font color="#FF0000">Usuário e/ou senha inválido(s)</font>';
				}
			?>
		</form>
</html>