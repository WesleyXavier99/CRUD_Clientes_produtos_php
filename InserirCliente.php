<?php 
	//INSERIR
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		
		/*Receber informações do usuario*/
		$nome = $_POST["nome"];
		$cpf = $_POST["cpf"];
		$endereco = $_POST["endereco"];
		$cep = $_POST["cep"];
		$cidade = $_POST["cidade"];
		$estado = $_POST["estado"];

		/*validar informações do usuario*/
		if ($nome !="" and $cpf !="" and $endereco !="" and $cep!=""  and $cidade!=""  and $estado!="") {

			$validacao = 1;
		}else{
			$validacao = 0;
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styleCadastro.css">
	<title>Inserir um Cliente</title>
</head>

<body>
	<div>
		<h1>Inserir um Cliente</h1>
		<form action="InserirCliente.php" method="post">
			<fieldset>
			Nome: <input type="text" name="nome" size="40px">
			cpf: <input type="text" name="cpf">
			endereço: <input type="text" name="endereco" size="35px"><br><br>
			CEP: <input type="text" name="cep">
			cidade: <input type="text" name="cidade">
			estado: <input type="text" name="estado"><br><br><br>
			<input type="submit" name="enviar">
			</fieldset>
		</form>
	</div>
		<br>
		<a href="MenuCliente.html"><button>Voltar</button></a>
</body>
</html>
<?php 
	if ($_SERVER['REQUEST_METHOD']=='POST') {

		//verificar validação
		if ($validacao == 0) {
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

		// verificar se conexão foi feita
		if (!$conn) {
			die("<br>Falha na conexão!");
		}

		/*Realizar inserção*/

		//comando que insere o valor
		$sql = "INSERT INTO cliente (nome,cpf,endereco,cep,cidade,estado) VALUES ('$nome','$cpf','$endereco','$cep','$cidade','$estado')";

		//inserindo e vericando
		if (mysqli_query($conn,$sql)) {
			echo "<br><h1>Cliente inserido com sucesso!<h1/>";
		}else{
			die("<br>Falha na criação da linha<br><br>" . $sql . "<br><br>" . mysqli_error($conn));
		}

	}

?>