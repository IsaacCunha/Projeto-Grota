<?php 

	session_start();
	include('../conexao.php');

	if(isset($_SESSION['id'])){

		$sql_acc = 'SELECT * FROM contas WHERE id = "'.$_SESSION['id'].'";';
		$sql_exec = mysqli_query($conexao, $sql_acc);
		$sql_result = mysqli_fetch_array($sql_exec);

		$nome = $_SESSION['nome'];
		$apelido = $_SESSION['apelido']; 
		$email = $_SESSION['email']; 
		$descricao = $_SESSION['descricao'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Perfil</title>
	<link rel="stylesheet" href="../assets/reset.css">
	<link rel="stylesheet" type="text/css" href="../assets/index.css">
</head>
<body>

	<header class="header-container">
		<a href="../index.php"><img src="../imgs/logo.png" class="logo"></a>
			<a href="../index.php" class="link-header a">Home</a>

			<!-- só aparece para deslogado -->
			<?php if(!isset($_SESSION['id'])){ ?>
				<a href="pages/login.php" class="link-header a">Logar-se</a>
				<a href="pages/cadastro.php" class="link-header a">Cadastrar-se</a>
			<?php } ?>
			<!-- só aparece para deslogado -->

			<a href="#" class="link-header a">Sobre Nós</a>

			<?php

				if(isset($_SESSION['id'])){
				$sql_acc = 'SELECT * FROM contas INNER JOIN fotos ON contas.id = fotos.id_fotos where id = "'.$_SESSION['id'].'";';
				$sql_exec = mysqli_query($conexao, $sql_acc);
				$sql_result = mysqli_fetch_array($sql_exec);

				$dir = '../fotos/';
				$nova_foto = $_SESSION['nome_fotos'];
			}
			?>
		<a href="#"><?php if(isset($_SESSION['id'])){ echo '<img class="icon" src="'.$dir.$nova_foto.'"'; }?></a>
	</header>

	<section class="container-perfil">

		<center><?php echo '<img class="icon" src="'.$dir.$nova_foto.'"'; ?></center> <br> <br> <br> <br> 

			<p><?php echo ($nome); ?></p>
			<p><?php echo ($apelido); ?></p>
			<p><?php echo ($email); ?></p>
			<p><?php echo ($descricao); ?></p>
		</section>
		
	
	

</body>
</html>