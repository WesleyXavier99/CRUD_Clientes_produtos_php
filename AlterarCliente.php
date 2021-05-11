<?php
//ALTERAR
if ($_SERVER['REQUEST_METHOD']=='POST') {
		
		//Receber informações do usuario
		$id = $_POST["idcliente"];
		$op = $_POST["op"];
		$novo = $_POST["novocampo"];

		//validar informações do usuario
		if ($id != "" and $op !="" and $novo !="") {
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
	<title>Alterar um Cliente</title>
</head>

<body>
	<div>
		<h1>Alterar um Cliente</h1>
		<form action="AlterarCliente.php" method="post">
			<fieldset>
			id:<input type="text" name="idcliente"><br><br><br>
			
			nome<input type="radio" name="op" value="nome">
			cpf<input type="radio" name="op" value="cpf">
			endereco<input type="radio" name="op" value="endereco">
			cep	<input type="radio" name="op" value="cep">
			cidade<input type="radio" name="op" value="cidade">
			estado<input type="radio" name="op" value="estado">
			<br><br><br>
			novo valor do campo:<input type="text" name="novocampo"><br><br><br>
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
		/*verificar validação*/
		if ($validacão == 0) {
			die("<br>Erro! Preencha os campos corretamente!");
		}

		/*realizar conexão com o banco*/

		//parametros para conexão com banco
		$servidor = "localhost";
		$baseDados = "vendas";
		$username = "root" ;
		$senha = "" ;

		//conectando com o banco
		$conn = mysqli_connect($servidor,$username,$senha,$baseDados);

		//verificar conexão
		if (!$conn) {
			die("<br>Falha na conexão!");
		}

		/*verificar se o id procurado existe no banco*/

		//pesquisando dentro do banco o id 
		$query = "SELECT id FROM cliente WHERE id='$id'";
		$result_query = mysqli_query( $conn,$query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );

		$remove = 0;
		//resultados encontrados
		while ($row = mysqli_fetch_array( $result_query )) {

			if ($row[id]==$id) {
				$remove = 1;
			}
		}

		//verificar se achou o id pesquisado pelo usuario 
		if ($remove == 0) {
			die("<br>Cliente não encontrado!!");
		}

		//alterando de acordo com o campo escolhido pelo usuário
		switch ($op) {
			case "nome":
				$sql = "UPDATE cliente SET nome = '$novo' WHERE id = '$id'";
				break;

			case 'cpf':
				$sql = "UPDATE cliente SET cpf = '$novo' WHERE id = '$id'";
				break;

			case 'endereco':
				$sql = "UPDATE cliente SET endereco = '$novo' WHERE id = '$id'";
				break;

			case 'cep':
				$sql = "UPDATE cliente SET cep = '$novo' WHERE id = '$id'";
				break;

			case 'cidade':
				$sql = "UPDATE cliente SET cidade = '$novo' WHERE id = 'id'";
				break;

			case 'estado':
				$sql = "UPDATE cliente SET estado = '$novo' WHERE id = 'id'";
				break;
			
			default:
				break;
		}


		//alterando e vericando
		if (mysqli_query($conn,$sql)) {
			echo "<br>Dados alterados com sucesso!";
		}else{
			die("<br>Falha na alteração da linha<br><br>" . $sql . "<br><br>" . mysqli_error($conn));
		}
	}
	

?>