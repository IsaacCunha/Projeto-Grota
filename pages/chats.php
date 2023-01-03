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

<?php

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

			<section class="container-main">

				<section class="container-amigos">

					
						<?php
						

						while ($con = mysqli_fetch_array($sql_exec)){	


							echo ('
								
									<section class="primeiro-dentro">
										<img src="'.$dir.$con['fk_nome_fotos'].'" class="foto" style="padding-top: 15px;">
										<p style="margin-left: 70px; margin-top: -55px;">'.$con['nome'].'</p>
										<img src="../imgs/deslogar.png" class="img-dentro">
											
										
									</section>
									

							');
						}?>
					</section>


				<section class="container-mensagens">

					
					
				

			<?php
				if(isset($_GET['id'])){
				$id_amigo = 3;

					$sqlacc = "SELECT * FROM contas INNER JOIN fotos ON contas.id = fotos.id_fotos Where id= ". $_SESSION['id'] .";";
				    $sql_exec = mysqli_query($conexao, $sqlacc);
				    $sql_result = mysqli_fetch_array($sql_exec);

				    $dir = "../fotos/";
				    $nome_fotos = $sql_result['nome_fotos'];
					$id_conta = $sql_result['id'];

					$_SESSION['email'] = $sql_result['email'];

					echo ('<table><tr><td></td></tr>'); //correto acima

		        	$sql_code = 'SELECT * FROM chats WHERE id_mensagem ORDER BY id_mensagem ASC;';
		        	$sql_exec = mysqli_query($conexao, $sql_code);
		        	$sql_result = mysqli_fetch_array($sql_exec);

					while ($con = mysqli_fetch_array($sql_exec)){
						$nova_foto = $con['fk_nome_fotos'];
						
					//a linha abaixo puxa a foto de quem mandou a mensagem abaixo e mansagem
					echo('<tr><td rowspan="2">'.'<img src="'.$dir.$nova_foto.'">'.'</td><td class="chat-nome">'.$con['fk_apelido'].'</td></tr><tr><td class="chat-mensagem">'.$con['mensagem'].'</td></tr>'); 			
					}

					echo ('</table>');

				if (isset($_POST['enviar-mensagem'])) {

				   $sqlacc = "SELECT * FROM contas INNER JOIN fotos ON contas.id = fotos.id_fotos Where id= ". $_SESSION['id'] .";";
				    $sql_exec = mysqli_query($conexao, $sqlacc);
				    $sql_result = mysqli_fetch_array($sql_exec);

				    $dir = "..\fotos/";
				    $nome_fotos = $sql_result['nome_fotos'];
				    $apelido = $sql_result['apelido'];
					$id_conta = $sql_result['id'];

					$_SESSION['email'] = $sql_result['email'];
					
		    		// Recupera os dados dos campos
					$mensagens = $_POST['mensagem'];
					$_SESSION['nome'] = $sql_result['nome'];
					 

					$sqlcad = 'insert into chats(id_conta, id_amigo, mensagem, fk_nome_fotos, fk_apelido) values ("'.$id_conta.'", "'.$id_amigo.'", "'.$mensagens.'", "'.$nome_fotos.'","'.$apelido.'");';
		            $sql_exec = mysqli_query($conexao, $sqlcad);

		        	/*Foto de perfil e nome de perfil */
		        	echo ('<table><tr><td></td></tr>'); //correto acima
		        	
		        	$sql_code = 'SELECT * FROM chats WHERE id_mensagem = 1;';
		        	$sql_exec = mysqli_query($conexao, $sql_code);
		        	$sql_result = mysqli_fetch_array($sql_exec);
		        	$linhas = mysqli_num_rows($sql_exec);
		        	$mensagem = $sql_result['mensagem'];


					$nova_foto = $sql_result['fk_nome_fotos'];
					

					
					

					echo('<section style="margin-top: 300px;"><tr style="margin-top: 500px;"><td rowspan="2">'.'<img src="'.$dir.$nova_foto.'">'.'</td><td class="chat-nome">'.$sql_result['fk_apelido'].'</td></tr><tr><td class="chat-mensagem">'.$mensagem.'</td></tr></section>'); 			
					

					echo ('</table>');
					}
}
	?>



	<section class="container-enviar-mensagens">
						<form>
							<input type="text" name="enviar-mensagem" class="enviar-mensagem">
						</form>
					</section>
	</section>

			</section>
</body>
</html>