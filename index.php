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
			</div> <!--.nav-collapse -->
			</div>
		    </nav>


	    <div class="container">
	    	<div class="col-md-3"></div>
	    	<div class="col-md-8">
		    	<h2>Controle Médico</h2>
		    	<div class="col-md-8 panel panel-default">
					<form method="post" action="login.php" id="formLogin">
						<div class="form-group panel-body">
							<input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário"/>
						</div>
						<div class="form-group panel-body">
							<input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha"/>
						</div>
						<div class="form-group panel-body">
							<button type="buttom" class="btn btn-primary" name="btn" id="btn_login">Entrar</button>
						</div>
					</form>
					<?php
						if($erro == 1){
							echo '<font color="#FF0000">Usuário e/ou senha inválido(s)</font>';
						} ?>
				</div>
			</div>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</body>
</html>