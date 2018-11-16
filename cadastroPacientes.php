<?php
	session_start();

	if(isset($_POST['btn_cancela'])){
		header('Location: home.php');
	}

	if(isset($_POST['btn_cadastra'])){
		
		require_once('db.class.php');

	    $nomePaciente = $_POST['nomePaciente'];
	    $dataNasc = $_POST['dataNascimento'];
	    $sexo = $_POST['sexo'];
	    $idmedico = $_SESSION['idmedicos'];

	    $objDb = new db();
	    $link = $objDb->conecta_mysql();

	    $sql = "INSERT INTO pacientes (idpacientes, medicos_idmedicos, nomePaciente, dataNascimento, sexo) VALUES ('NULL', '$idmedico','$nomePaciente', '$dataNasc', '$sexo') ";

	    //executar a query
	    if(mysqli_query($link, $sql)){
	        echo "Usuário registrado com sucesso!";

	    }else{
	        echo "Erro ao registrar o usuário!";
	    }
	}


?>