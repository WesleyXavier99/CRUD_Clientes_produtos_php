<?php 
//REMOVER
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		
		//Receber informações do usuario
		$id = $_POST["id"];

		//validar informações do usuario
		if ($id != "") {
			$validacão = 1;
		}else{
			$validacão = 0;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styleCadastro.css">
	<title>Remover um Cliente</title>
</head>

<body>
	<div>
		<h1>Remover um Cliente</h1>
		<form action="RemoverCliente.php" method="post">
			<fieldset>
			id:<input type="text" name="id"><br><br>
			<input type="submit" name="enviar">
			</fieldset>
		</form>
	</div>
	<br>
	<a href="MenuCliente.html"><button>Voltar</button></a>
</body>
</body>
</html>
<?php 
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		//verificar validação
		if ($validacão == 0) {
			die("<br>Erro! Preencha os campos corretamente!");
		}

		//realizar conexão com o banco
		$servidor = "localhost";
		$baseDados = "vendas";
		$username = "root" ;
		$senha = "" ;

		//fazendo conexão
		$conn = mysqli_connect($servidor,$username,$senha,$baseDados);

		//verificar conexão
		if (!$conn) {
			die("<br>Falha na conexão!".$conn->connect-error );
		}

		/*verificar se o id pesquisado está dentro do banco*/

		//pesquisando dentro do banco o id 
		$query = "SELECT id FROM cliente WHERE id='$id'";
		$result_query = mysqli_query( $conn,$query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
 	
 		//verificando se o aluno foi achado
		if (!mysqli_fetch_array( $result_query )) {
			die("<br>Cliente nao encontrado!!");
		}


		//realizar remoção
		$sql = "DELETE FROM cliente WHERE id='$id' ";

		if (mysqli_query($conn,$sql)) {
			echo "<br>Cliente removido com sucesso!";
		}else{
			die("<br>Falha na remoção do Cliente<br><br>" . $sql . "<br><br>" . mysqli_error($conn));
		}
	}
?>