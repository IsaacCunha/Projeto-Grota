<!DOCTYPE html>
<html>
<head>
	<title>Amigos</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../assets/reset.css">
	<link rel="stylesheet" type="text/css" href="../assets/amigos.css">
</head>
<body>

	<section class="box-amigos">

<?php

	session_start();

	include('../conexao.php');

	$sql_foto = 'SELECT * FROM amigos INNER JOIN fotos ON fotos.id_fotos = amigos.id_conta;';
	$sql_exec_fotos = mysqli_query($conexao, $sql_foto);
	$sql_result = mysqli_fetch_array($sql_exec_fotos);

	$dir = "../fotos/";

	$sql_amigos = 'SELECT * FROM fotos;';
	$sql_exec_amigos = mysqli_query($conexao, $sql_amigos);


	$sql_ver = 'SELECT * FROM amigos INNER JOIN contas ON amigos.id_amigo = contas.id where id_conta = "'.$_SESSION['id'].'";';
	$sql_exec = mysqli_query($conexao, $sql_ver);

	$linhas = mysqli_num_rows($sql_exec);

?>

<table>

<?php

	while ($con = mysqli_fetch_array($sql_exec)){

	echo ('

		<tr>
			<td><img src="'.$dir.$con['fk_nome_fotos'].'" class="icon"></td>
			<td>'.$con['nome'].'</td>
			<td>'.$con['apelido'].'</td>
			<td>'.$con['email'].'</td>
			<td><a href="amigos.php?chat='.$con['id'].'"> <img src="../imgs/chat.png" alt="Conversar" width="30px" height="30px"> </a></td>
			<td><a href="amigos.php?id='.$con['id'].'"> <img src="../imgs/negar.png" alt="Deletar amizade" width="30px" height="30px"> </a></td>
		</tr>
		');
	}

	if(isset($_GET['id'])){
		$id_amigo = $_GET['id'];

			$sql_del_amigo = 'DELETE FROM amigos where id_amigo = "'.$id_amigo.'";';
			$sql_del_conta = 'DELETE FROM amigos where id_conta = "'.$id_amigo.'";';

			$sql_exec = mysqli_query($conexao, $sql_del_amigo);
			$sql_exec = mysqli_query($conexao, $sql_del_conta);

			header('location:amigos.php');
	}

	if(isset($_GET['chat'])){
		$_SESSION['id_amigo'] = $_GET['chat'];

			header('location:chat_individual.php');
	}

?>
</table>
	</section>
</body>
</html>



