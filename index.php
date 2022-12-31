<?php 

session_start();
include('conexao.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="assets/index.css">
	<link rel="stylesheet" type="text/css" href="assets/fonts.css">
</head>
<body>	
	
	<header class="header-container">
		<a href="index.php"><img src="imgs/logo.png" class="logo"></a>

		<ul>
			<li><a class="link-header a" href="pages/chat1.php">Página 1</a></li>
			<li><a class="link-header a" href="pages/ajuda.php">Página 2</a></li>
		</ul>

		<section class="action2">

			<section class="profile2" onclick=" menuToggle2();">

				<img class="img2" src="imgs/amigos.png"> 

			</section>
			<section class="menu2">

				<form name="amigos" method="POST"> 
					<h3 style="margin-top: -15px;">Amigos</h3>

					<p style="margin-top: -15px;">_________________________</p>
					<ul>
						<li><a href="pages/amigos.php"><img src="imgs/icon.png"></a><a href="pages/amigos.php">Listar amigos</a></li>
						<li><img src="imgs/hashtag.png"><input class="btn-amigos" type="submit" name="add" value="Adicionar amigos"></li>
						<li><a href="pages/pedidos_amizade.php"><img src="imgs/config.png"></a><a href="pages/pedidos_amizade.php">Pedidos de amizade</a></li>
					</ul>
				</form>

			</section>	
		</section>
		<script>
			function menuToggle2(){
				const toggleMenu2 = document.querySelector('.menu2');

				toggleMenu2.classList.toggle('active2');


			}
		</script>	

		<section class="action">

			<section class="profile" onclick=" menuToggle();">

				<?php

				if(isset($_SESSION['id'])){
					$sql_acc = 'SELECT * FROM contas INNER JOIN fotos ON contas.id = fotos.id_fotos where id = "'.$_SESSION['id'].'";';
					$sql_exec = mysqli_query($conexao, $sql_acc);
					$sql_result = mysqli_fetch_array($sql_exec);

					$dir = 'fotos/';
					$nova_foto = $sql_result['nome_fotos'];
					$nome = $sql_result['nome'];
					$funcao = 'estudante';

					$apelido_conta = $sql_result['apelido'];

					?>

					
					<img class="img" src=<?php echo '"'.$dir.$nova_foto.'"';?>> 
					<?php
				}if(!isset($_SESSION['id'])){?>
					<img class="logo" style="width: 80px; margin-left: -11px; margin-top: 5px;" src="imgs/icon.png">
				<?php } ?>

			</section>
			<section class="menu">
				<?php if(isset($_SESSION['id'])){ ?>
					<h3>Bem vindo(a) <?php echo ($nome); ?><br><span>Conta <?php echo ($funcao); ?></h1>
						<ul>
							<li><a href="pages/perfil.php"><img src="imgs/icon.png"></a><a href="pages/perfil.php">Meu perfil</a></li>
							<li><a href="pages/ajuda.php"><img src="imgs/ajuda.png"></a><a href="pages/ajuda.php">Ajuda</a></li>
							<li><a href="pages/logout.php"><img src="imgs/deslogar.png"></a><a href="pages/logout.php">Deslogar-se</a></li>
						</ul>
					<?php }else { ?>
						<h3>Perfil<br><span>Conta Visitante</h3>	
							<ul>
								<li><img src="login.png"><a href="pages/login.php">Logar-se</a></li>
								<li><img src="cadastro.png"><a href="pages/cadastro.php">Cadastrar-se</a></li>
								<li><img src="ajuda.png"><a href="#">Ajuda</a></li>
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

				<aside>
					<h2><span>Navege pela Grota</span></h2>
					<h2>Cadastre-se já</h2>
					<p>Aqui no projeto Grota você tera acesso à diversas interações com usuários reais e poderá desfrutar de muitas funções exclusivas desenvolvidas diretamente da caixola do desenvolvedor, cadastre-se para desfrutar de toda essa experiência incrivel :)</p>

					<form name="cadastro_index" method="POST" action="#">

						<input class="input-text" type="text" name="nome" placeholder="Insira seu nome">
						<input class="input-text" type="email" name="email" placeholder="Insira seu E-mail">

						<input class="btn-cadastrar" type="submit" name="next" value="Proxima etapa >>"> <br>

						<a style="align-self: center; font-size: 30px; color: cyan;" href="pages/login.php">Já tenho uma conta!</a>

					</form>

					<?php

						if(isset($_POST['next'])){
							$nome_next = $_POST['nome'];
							$_SESSION['nome_next'] = $nome_next;
							$_SESSION['email_next'] = $_POST['email'];

							header('Location:pages/cadastro.php');
						}

					?>
				</aside>
					<article>
						<img src="imgs/landing" alt="purple-woman">
					</article>
				</section>

				<section class="container-main2">
				<form>
					
					<h2 class="h2-medio">Aqui você verá diversas metodologias nas seguintes skills:</h2>
				</form>
			</section>
				<?php 

					if(isset($_POST['add'])){ ?>
						<section class='box-amigo-add'>
							<form name='add' method='POST'>
								<button name="fechar" class="btn-fechar">X</button>
								<h2>Insira o apelido do seu amigo:</h2> <br><br>
								<input type='text' name='apelido' class="
								input-amigos-add"> <br><br>
								<input type='submit' name='adicionar' value='Adicionar' class="btn-adicionar"> <br> <br>

								<img style="width: 300px; height: 200px;" src="imgs/amigos-vetor">

							</form> 
			

			
			

						<?php
					}

					if(isset($_POST['adicionar'])){

						$text_add = $_POST['apelido'];

						$apelido = $_POST['apelido'];

						$sql_amigo = 'SELECT * FROM contas WHERE id = "'.$_SESSION['id'].'";';
						$sql_exec = mysqli_query($conexao, $sql_amigo);
						$sql_result = mysqli_fetch_array($sql_exec);


						$apelido_conta = $sql_result['apelido'];

						$sql_amigo = 'SELECT * FROM contas WHERE apelido LIKE "'.$apelido.'%";';
						$sql_exec = mysqli_query($conexao, $sql_amigo);
						$sql_result = mysqli_fetch_array($sql_exec);

						$id_amigo = $sql_result['id'];
						$apelido_amigo = $sql_result['apelido'];

							// --------------------------------------

						$sql_amigo = 'SELECT * FROM notificacao INNER JOIN contas ON notificacao.id_amigo = contas.id where id_amigo = "'.$id_amigo.'";';
						$sql_exec = mysqli_query($conexao, $sql_amigo);
						$sql_result = mysqli_fetch_array($sql_exec);

						$linhas_soliacita = mysqli_num_rows($sql_exec);

							//----------------------------------------------

						$sql_amigo = 'SELECT * FROM amigos INNER JOIN contas ON amigos.id_amigo = contas.id where apelido_amigo = "'.$apelido_conta.'" and id_amigo = "'.$id_amigo.'";';
						$sql_exec = mysqli_query($conexao, $sql_amigo);
						$sql_result = mysqli_fetch_array($sql_exec);

						$linhas_amigos = mysqli_num_rows($sql_exec);

							//---------------------------------------------------

						if(empty($text_add)){
							echo ('<script>window.alert("Digite algum apelido!");window.location="index.php";</script>');
						}else{

							if($apelido == $apelido_conta){
								echo ('<script>window.alert("Você não pode se adicionar!");window.location="index.php";</script>');
							}else{

								if($linhas_soliacita > 0){
									echo ('<script>window.alert("Solicitação está pendente!");window.location="index.php";</script>');
								}else{

									if($linhas_amigos > 0){
										echo ('<script>window.alert("Você e '.$apelido.' já são amigos!");window.location="index.php";</script>');
									}else{

										$sql_amigo = 'SELECT * FROM notificacao INNER JOIN contas ON notificacao.id_amigo = contas.id where id_conta = "'.$_SESSION['id'].'";';
										$sql_exec = mysqli_query($conexao, $sql_amigo);
										$sql_result = mysqli_fetch_array($sql_exec);

										$id_solicitacao = $sql_result['id_amigo'];

										if ($id_amigo == $_SESSION['id']) {
											echo ('<script>window.alert("Você não pode se adicionar!");window.location="index.php";</script>');
										}else{

											if ($id_amigo == null) {
												echo ('<script>window.alert("O usuário não existe na tabela");window.location="index.php";</script>');
											}else{

												if ($id_amigo == $id_solicitacao) {
													echo ('<script>window.alert("Solicitação já está pendente!");window.location="index.php";</script>');
												}else{

													if(empty($apelido_tab)){

														$sql_notifica = 'INSERT INTO notificacao (id_conta, id_amigo, apelido) VALUES ("'.$_SESSION['id'].'", "'.$id_amigo.'", "'.$apelido_conta.'");';
														$sql_exec = mysqli_query($conexao, $sql_notifica);

														header('location:index.php');
													}

												}
											}
										}
										}
									}
								}
							}
						}
					?>
			</body>
			</html>