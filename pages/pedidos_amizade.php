<!DOCTYPE html>
<html>
<head>
	<title>Amigos</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../assets/reset.css">
	<link rel="stylesheet" type="text/css" href="../assets/index.css">
</head>
<body>

	<?php

	session_start();

include('../conexao.php');

$sql_ver = 'SELECT * FROM notificacao INNER JOIN contas ON contas.id = notificacao.id_conta where id_amigo = "'.$_SESSION['id'].'";';
$sql_exec = mysqli_query($conexao, $sql_ver);

$linhas = mysqli_num_rows($sql_exec);

$dir = "../fotos/";

			?>

			<?php
				echo '<center><h1>Solicitações pendentes: '.$linhas.'</h1>'
			?>

<table>

	<?php

while ($con = mysqli_fetch_array($sql_exec)){

echo ('

	<tr>
		<td>'.$con['nome'].'</td>
		<td>'.$con['apelido'].'</td>
		<td>'.$con['email'].'</td>
		<td><a href="pedidos_amizade.php?aceitar='.$con['id'].'"> <img src="../imgs/aceitar.png" alt="configurações" width="30px" height="30px"> </a></td>
		<td><a href="pedidos_amizade.php?negar='.$con['id'].'"> <img src="../imgs/negar.png" alt="configurações" width="30px" height="30px"> </a></td>
	</tr>
	');
}

if(isset($_GET['aceitar'])){
	$id_amigo = $_GET['aceitar'];

	$sql_amigo = 'SELECT * FROM fotos where id_fotos = "'.$id_amigo.'";';
	$sql_exec = mysqli_query($conexao, $sql_amigo);
	$sql_result = mysqli_fetch_array($sql_exec);

	$nome_fotos_conta = $sql_result['nome_fotos']; 

	//---------------------------------------------------

	$sql_amigo = 'SELECT * FROM fotos where id_fotos = "'.$_SESSION['id'].'";';
	$sql_exec = mysqli_query($conexao, $sql_amigo);
	$sql_result = mysqli_fetch_array($sql_exec);

	$nome_fotos_amigo = $sql_result['nome_fotos']; 

	//---------------------------------------------------

	$sql_amigo = 'SELECT * FROM notificacao where id_conta = "'.$id_amigo.'";';
	$sql_exec = mysqli_query($conexao, $sql_amigo);
	$sql_result = mysqli_fetch_array($sql_exec);

	$apelido_amigo = $sql_result['apelido'];

	//---------------------------------------------------

	$sql_amigo = 'SELECT * FROM contas where id = "'.$_SESSION['id'].'";';
	$sql_exec = mysqli_query($conexao, $sql_amigo);
	$sql_result = mysqli_fetch_array($sql_exec);

	$apelido_conta = $sql_result['apelido'];

	//---------------------------------------------------

	$sql_amigo = 'SELECT * FROM amigos INNER JOIN contas ON amigos.id_conta = contas.id where id_amigo = "'.$id_amigo.'";';
	$sql_exec = mysqli_query($conexao, $sql_amigo);
	$sql_result = mysqli_fetch_array($sql_exec);

	$linhas_amigos = mysqli_num_rows($sql_exec);

	//---------------------------------------------------

	if($linhas_amigos > 0){
		echo ('<script>window.alert("Você e '.$apelido.' já são amigos!");window.location="pedidos_amizade.php";</script>');

		$sql_del = 'DELETE FROM notificacao where apelido = "'.$apelido_amigo.'";';

		$sql_exec = mysqli_query($conexao, $sql_del);
	}else{


	$sql_cad = 'INSERT INTO amigos (id_conta, id_amigo, apelido_amigo, fk_nome_fotos) VALUES ("'.$_SESSION['id'].'", "'.$id_amigo.'", "'.$apelido_amigo.'", "'.$nome_fotos_conta.'");';

	$sql_cad2 = 'INSERT INTO amigos (id_conta, id_amigo, apelido_amigo, fk_nome_fotos) VALUES ("'.$id_amigo.'", "'.$_SESSION['id'].'", "'.$apelido_conta.'", "'.$nome_fotos_amigo.'");';

	$sql_exec = mysqli_query($conexao, $sql_cad);
	$sql_exec = mysqli_query($conexao, $sql_cad2);

	$sql_del = 'DELETE FROM notificacao where apelido = "'.$apelido_amigo.'";';

	$sql_exec = mysqli_query($conexao, $sql_del);
	
	header('location:../index.php');
}
}

if(isset($_GET['negar'])){
	$id_amigo = $_GET['negar'];

	$sql_amigo = 'SELECT * FROM notificacao where id_conta = "'.$id_amigo.'";';
	$sql_exec = mysqli_query($conexao, $sql_amigo);
	$sql_result = mysqli_fetch_array($sql_exec);

	$apelido_notifica = $sql_result['apelido'];

	$sql_del = 'DELETE FROM notificacao where apelido = "'.$apelido_notifica.'";';

	$sql_exec = mysqli_query($conexao, $sql_del);
	
	header('location:pedidos_amizade.php');
}

?>

</body>
</html>