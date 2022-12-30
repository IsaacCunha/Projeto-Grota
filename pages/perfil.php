<!DOCTYPE html>
<html lang="en">
 
<head>
    <link rel="stylesheet" href="../assets/perfil.css">
    <link rel="preconnect"
        href="https://fonts.gstatic.com">
    <link href=
"https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap"
        rel="stylesheet">
</head>
 
<body>
    <section class="container">
        <section class="user-image">
            <img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20210223165952/gfglogo.png"
            alt="this image contains user-image">
        </section>
 
        <section class="content">
            <h3 class="name">Perfil de Isaac</h3>
            <p class="username">@geeks_for_geeks</p>

            <section class="infos">
            	<section class="infos-dentro">
            		
            	</section>
            	<p>ola</p>
            </section>


 
 
            <section class="links">
                <a class="facebook" href=
"https://www.facebook.com/geeksforgeeks.org/"
                    target="_blank" title="GFG_facebook">
                    <i class="fab fa-facebook"></i>
                </a>
 
                <a class="git" href=
"https://github.com/topics/geeksforgeeks"
                    title="GFG_github" target="_blank">
                    <i class="fab fa-github-square"></i>
                </a>
 
                <a class="linkedin" href=
"https://www.geeksforgeeks.org/tag/linkedin/"
                    title="GFG_linkedin" target="_blank">
                    <i class="fab fa-linkedin"></i>
                </a>
                 
                <a class="insta" href=
"https://www.instagram.com/geeks_for_geeks/?hl=en"
                    target="_blank" title="GFG_instagram">
                    <i class="fab fa-instagram-square"></i>
                </a>
            </section>
 
            <p class="details">
                Conheça meu trabalho!
            </p>
 
 
            <a class="effect effect-4" href="#">
                Conversar Agora!
            </a>
        </section>
    </section>
     
    <!-- This is link of adding small images
         which are used in the link section  -->
    <script src="https://kit.fontawesome.com/704ff50790.js"
        crossorigin="anonymous">
    </script>
</body>
 
</html>

<!-- <?php 

	/*session_start();
	include('../conexao.php');

	if(isset($_SESSION['id'])){

		$sql_acc = 'SELECT * FROM contas WHERE id = "'.$_SESSION['id'].'";';
		$sql_exec = mysqli_query($conexao, $sql_acc);
		$sql_result = mysqli_fetch_array($sql_exec);

		$nome = $sql_result['nome'];
		$apelido = $sql_result['apelido'];
		$email = $sql_result['email'];
		$descricao = $sql_result['descricao'];
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
				$nova_foto = $sql_result['nome_fotos'];
			}
			?>
		<a href="perfil.php"><?php if(isset($_SESSION['id'])){ echo '<img class="icon" src="'.$dir.$nova_foto.'"'; }?></a>
	</header>

	<section class="container-perfil">

		<center><?php echo '<img class="icon" src="'.$dir.$nova_foto.'"'; ?></center> <br> <br> <br> <br> 

			<h2><?php echo ($nome); ?></h2>
			<p><?php echo ($apelido); ?></p>
			<p><?php echo ($email); ?></p>
			<p><?php echo ($descricao); */?></p>
		</section>
		
	
	

</body>
</html> -->