<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar-se</title>
	<meta charset="utf-8">
</head>
<body>

	<form name="cadastro" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">

		<input type="text" name="nome" placeholder="como você se chama?"> <br> <br>
		<input type="text" name="apelido" placeholder="como quer ser chamado?"> <br> <br>
		<input type="email" name="email" placeholder="qual seu email?"> <br> <br>
		<input type="password" name="senha" placeholder="********"> <br> <br>
		<input type="text" name="descricao" placeholder="Nos conte sobre você"> <br> <br>
		<input type="date" name="data" placeholder="Em que ano você nasceu?"> <br> <br>
		<input type="file" name="foto">

		<input type="submit" name="cadastrar" value="cadastrar">

	</form>

</body>
</html>

<?php 

session_start();

include('../conexao.php');

if(isset($_POST['cadastrar'])){

	$nome = $_POST['nome'];
	$apelido = $_POST['apelido'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$SalvarSenha = $_POST['senha'];
	$descricao = $_POST['descricao'];
	$data = $_POST['data'];
	$foto = $_FILES['foto'];

	if(empty($foto["name"])){

		echo ('<script>window.alert("Insira uma imagem para perfil");window.location="cadastro_estudante.php";</script>');

	}else{

		$sql_acc = 'SELECT * FROM contas order by id desc;';
		$sql_exec = mysqli_query($conexao, $sql_acc);
		$sql_result = mysqli_fetch_array($sql_exec);

		$id = $sql_result['id'];
		$emailtab = $sql_result['email'];

		$dir = "../fotos/";
		$foto = $_FILES['foto'];

			$fotoext = explode(".", $foto['name']); // coleta tudo do ponto em diante, exemplo: .jpg ou .png
			$ext1 = $fotoext[sizeof($fotoext) -1 ]; // coleta tudo depois do ponto, exemplo: jpg ou png

			$_SESSION['foto'] = $dir;

			$nova_foto = $email . '_imagem.' . $ext1;

			$largura = 9999999;

			$altura = 9999999;

			$tamanho = 9999999;

			$erro  = array();

			// verifica se há algum email no banco igual ao email digitado
			if( $emailtab == $email){

				echo ('<script>window.alert("Este email já está cadastrado!");window.location="cadastro_estudante.php";</script>');
			}else{


			// Pega as dimensões da imagem
				if(!preg_match("/^image\/(jpeg|jpeg|png|gif|bmp|jfif)$/", $foto["type"])){
					echo ('<script>window.alert("Arquivo não é uma imagem");window.location="cadastro_estudante.php";</script>');
				}else{

					$dimensoes = getimagesize($foto["tmp_name"]);

					// Verifica se a largura da imagem é maior que a largura permitida
					if($dimensoes[0] > $largura) {
						echo ('<script>window.alert("Largura precisa ser menor ou igual à '.$largura.'");window.location="cadastro_estudante.php";</script>');
					}else{

            		 // Verifica se a altura da imagem é maior que a altura permitida
						if($dimensoes[1] > $altura) {
							echo ('<script>window.alert("Altura precisa ser menor ou igual à '.$altura.'");window.location="cadastro_estudante.php";</script>');
						}else{

        // Verifica se o tamanho da imagem é maior que o tamanho permitido
							if($foto["size"] > $tamanho) {
								echo ('<script>window.alert("tamanho precisa ser menor ou igual à '.$tamanho.'");window.location="cadastro_estudante.php";</script>');
							}else{
                            //validação de senha abaixo
								if (strlen($SalvarSenha) < 8) {
									echo ('<script>window.alert("senha deve conter no mínimo 8 digitos!");window.location="cadastro_estudante.php";</script>');
                            //validação de senha acima    
								}else{
									if (strlen($SalvarSenha) > 36) {
										echo ('<script>window.alert("senha deve conter no máximo 36 digitos!");window.location="cadastro_estudante.php";</script>');
                            //validação de senha acima    
									}else{

										if (!preg_match('/[A-Za-z]/', $SalvarSenha) || !preg_match('/[0-9]/', $SalvarSenha)){
											echo ('<script>window.alert("senha deve conter letras e números");window.location="cadastro_estudante.php";</script>');
										}else{	

            								// se não houver erros
											if ($dimensoes[0] <= $largura && $dimensoes[1] <= $altura && $foto["size"] <= $tamanho){

												$sql_cad = 'INSERT INTO contas (nome, apelido, email, senha, descricao, data) values ("'.$nome.'", "'.$apelido.'", "'.$email.'", "'.sha1($senha).'", "'.$descricao.'", "'.$data.'");';

												$sql_exec = mysqli_query($conexao, $sql_cad);

                            						// Pega extensão da imagem
												preg_match("/\.(gif|bmp|png|jpg|jpeg|jfif){1}$/i", $foto["name"], $ext);

                           					 		// Gera um nome único para a imagem para impedir sobreposição de arquivo
												$nome_foto = md5(uniqid(time())) . "." . $ext[1];

                            						// Caminho de onde ficará a imagem
												$caminho_foto = "..\fotos/" . $nome_foto;

                            						// Insere os dados no banco
												$sql_foto = 'INSERT INTO fotos(nome_fotos, data) VALUES ("'.$nova_foto.'", NOW());';
												$sql_exec = mysqli_query($conexao, $sql_foto);


            				// cria o arquivo na pasta
                            move_uploaded_file($foto['tmp_name'], $dir.$nova_foto); // Exemplo:  $dir.$nova_foto = fotos/Juam@gmail_foto.png

                            header('location:login.php');
                        }
                    }
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

