<?php
	session_start();
	if(isset($_POST['btn'])){
		require_once('db.class.php');

		$usuario = $_POST['usuario'];
		$senha = $_POST['senha'];

		$sql = " SELECT * FROM medicos WHERE usuario = '$usuario' AND senha = '$senha' ";

		$objDb = new db();
		$link = $objDb->conecta_mysql();

		$resultado_id = mysqli_query($link, $sql);

		if($resultado_id){
			$dados_usuario = mysqli_fetch_array($resultado_id);

			if($usuario == $dados_usuario['usuario']){
				if($senha == $dados_usuario['senha']){
					$_SESSION['logado'] = true;
					$_SESSION['nomeMedico'] = $dados_usuario['nomeMedico'];
					$_SESSION['idmedicos'] = $dados_usuario['idmedicos'];				
					header("location: home.php");
				}
				else header("Location: index.php?erro=1");
			}else header("Location: index.php?erro=1");
		} else echo 'Erro na execução da consulta, favor entrar em contato com o admin do site';
	}
?>
