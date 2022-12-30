<!DOCTYPE html>
<html>
<head>
	<title>Logar-se</title>
</head>
<body>

	<form name="login" method="POST" action="#">

		<input type="email" name="email" placeholder="qual seu email?"> <br> <br>
		<input type="password" name="senha" placeholder="********"> <br> <br>
		
		<input type="submit" name="logar" value="logar">

	</form>

</body>
</html>

<?php 

	include('../conexao.php');
	session_start();

	if(isset($_POST['logar'])){

		$email = $_POST['email'];
		$senha = $_POST['senha'];

		$sql_log = 'SELECT * FROM contas WHERE email = "'.$email.'" AND senha = "'.sha1($senha).'";';
		$sql_exec = mysqli_query($conexao, $sql_log);
		$sql_result = mysqli_fetch_array($sql_exec);
		$linhas = mysqli_num_rows($sql_exec);

		if($linhas > 0){

			$_SESSION['id'] = $sql_result['id'];
			header('location:../index.php');
		}else{
			echo ('<script>window.alert("Não conseguiu logar!");window.location="#";</script>');
		}



	}

?>