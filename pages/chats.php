<?php 

session_start();
include('../conexao.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Chats</title>
		<link rel="stylesheet" type="text/css" href="../assets/index.css">
		<link rel="stylesheet" type="text/css" href="../assets/fonts.css">
		<link rel="stylesheet" type="text/css" href="../assets/chat.css">
</head>
<body>

	<header class="header-container">
		<a href="../index.php"><img src="../imgs/logo.png" class="icon"></a>

		<ul style="display: inline;">
			<li><a class="link-header a" href="../index.php">Home</a></li>
			<li><a class="link-header a" href="amigos.php">Amigos</a></li>
			<li><a class="link-header a" href="#">Página 3</a></li>
		</ul>

		<section class="action">

			<section class="profile" onclick=" menuToggle();">

				<?php

				if(isset($_SESSION['id'])){
					$sql_acc = 'SELECT * FROM contas INNER JOIN fotos ON contas.id = fotos.id_fotos where id = "'.$_SESSION['id'].'";';
					$sql_exec = mysqli_query($conexao, $sql_acc);
					$sql_result = mysqli_fetch_array($sql_exec);

					$dir = '../fotos/';
					$nova_foto = $sql_result['nome_fotos'];
					$nome = $sql_result['nome'];
					$funcao = 'estudante';

					$apelido_conta = $sql_result['apelido'];

					?>

					
					<img class="icon" src=<?php echo '"'.$dir.$nova_foto.'" ';?>> 
					<?php } 
					if(!isset($_SESSION['id'])){?>
					<img class="icon" style="width: 100%; height: 100%;" src="../imgs/icon.png">
				<?php } ?>

			</section>
			<section class="menu">
				<?php if(isset($_SESSION['id'])){ ?>
					<h3>Bem vindo(a) <?php echo ($nome); ?><br><span>Conta <?php echo ($funcao); ?></h1>
						<ul>
							<li><a href="pages/perfil.php"><img src="../imgs/icon.png"></a><a href="perfil.php">Meu perfil</a></li>
							<li><a href="pages/ajuda.php"><img src="../imgs/ajuda.png"></a><a href="ajuda.php">Ajuda</a></li>
							<li><a href="pages/logout.php"><img src="../imgs/deslogar.png"></a><a href="logout.php">Deslogar-se</a></li>
						</ul>
					<?php } ?>
					</section>	
				</section>
				<script>
					function menuToggle(){
						const toggleMenu = document.querySelector('.menu');
						toggleMenu.classList.toggle('active');
					}
				</script>		
			</header>

			<section class="container-main">

				<section class="container-amigos">

					<section class="primeiro-dentro">
						<img src="../imgs/icon" class="foto">
						<p style="margin-left: 70px; margin-top: -55px;">nome do usuário</p> <br>
					</section>

					<section class="dentro">
						<img src="../imgs/icon" class="foto">
						<p style="margin-left: 70px; margin-top: -55px;">nome do usuário</p>
					</section>

					<section class="dentro">
						<img src="../imgs/icon" class="foto">
						<p style="margin-left: 70px; margin-top: -55px;">nome do usuário</p>
					</section>

					<section class="dentro">
						<img src="../imgs/icon" class="foto">
						<p style="margin-left: 70px; margin-top: -55px;">nome do usuário</p>
					</section>

					<section class="dentro">
						<img src="../imgs/icon" class="foto">
						<p style="margin-left: 70px; margin-top: -55px;">nome do usuário</p>
					</section>

					<section class="dentro">
						<img src="../imgs/icon" class="foto">
						<p style="margin-left: 70px; margin-top: -55px;">nome do usuário</p>
					</section>

					<section class="dentro">
						<img src="../imgs/icon" class="foto">
						<p style="margin-left: 70px; margin-top: -55px;">nome do usuário</p>
					</section>

					<section class="dentro">
						<img src="../imgs/icon" class="foto">
						<p style="margin-left: 70px; margin-top: -55px;">nome do usuário</p>
					</section>

					<section class="dentro">
						<img src="../imgs/icon" class="foto">
						<p style="margin-left: 70px; margin-top: -55px;">nome do usuário</p>
					</section>

					<section class="dentro">
						<img src="../imgs/icon" class="foto">
						<p style="margin-left: 70px; margin-top: -55px;">nome do usuário</p>
					</section>
				</section>

				<section class="container-mensagens">
					<section class="container-enviar-mensagens">
						<form>
						<input type="text" name="enviar-mensagem" class="enviar-mensagem">
					</form>
						
					</section>
					
				</section>

			</section>

</body>
</html>