<?php 
	if ($_SERVER['REQUEST_METHOD']=='POST') {

		/*Receber informações do usuario*/
		$arquivo = $_POST["arquivocsv"];

  		//validando as informações
		if ($arquivo!="") {
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
	<title>Cadastrar produtos</title>
</head>

<body>
	<div>
		<h1>Cadastrar produtos por arquivo .csv</h1>
		<form action="CadastrarProdutos.php" method="post">
			<fieldset>
			Nome do arquivo:<input type="text" name="arquivocsv"><br><br>
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

		/*abrindo arquivo*/
		$handle = fopen($arquivo, 'r');

		while ($line = fgetcsv($handle,1000,";")) {

			//obtendo os campos que serão inseridos no banco
			$nome = utf8_encode($line[0]);
			$descricao = utf8_encode($line[1]);
			$preco = utf8_encode($line[2]);
			$quantidade = utf8_encode($line[3]);
			$pesog = utf8_encode($line[4]);	
			
			//inserindo valor no banco
			$result = $conn->query("INSERT INTO produto (nome,descricao,preco,quantidade,pesog) VALUES ('$nome','$descricao','$preco','$quantidade','$pesog')");
		}
		
		//verificando se a inserção teve sucesso
		if ($result) {
			echo "<br>Dados inseridos com sucesso";
		}else{
			echo "<br>falha na inserção";
		}
		fclose($handle);

	}
?>