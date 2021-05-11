<?php  

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styleCadastro.css">
	<title>Listar todos Clientes</title>
</head>

<body>
	<div>
		<h1>Listar todos Clientes</h1>
		<form action="ListarTodosClientes.php" method="post">
			<input type="submit" name="enviar"><br><br>
		</form>
	</div>
	<br>
	<a href="MenuCliente.html"><button>Voltar</button></a>
</body>
</body>
</html>
<?php 
	//LISTAR TODOS
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

			$query = "SELECT * FROM cliente";

			// executa a query
			$dados = mysqli_query($conn,$query) or die(mysqli_error());

			// transforma os dados em um array
			$linha = mysqli_fetch_assoc($dados);

			// calcula quantos dados retornaram
			$total = mysqli_num_rows($dados);

			// se o número de resultados for maior que zero, mostra os dados
			if($total > 0) {
				// inicia o loop que vai mostrar todos os dados
				do {
		?>
					<p><?=$linha['id']?> / <?=$linha['nome']?> / <?=$linha['cpf']?> / <?=$linha['endereco']?> / <?=$linha['cep']?>/ <?=$linha['cidade']?>/ <?=$linha['estado']?></p>
		<?php
				// finaliza o loop que vai mostrar os dados
				}while($linha = mysqli_fetch_assoc($dados));
			// fim do if
			}else{
				echo "<br>Tabela vazia!!";
			}
		}

?>