<?php 
//LISTAR UM
if ($_SERVER['REQUEST_METHOD']=='POST') {
		
		//Receber informações do usuario
		$id = $_POST["id"];

		//validar informações do usuario
		if ($id != "" ) {
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
	<title>Listar um Cliente</title>
</head>

<body>
	<div>
		<h1>Listar um Cliente</h1>
		<form action="ListarCliente.php" method="post">
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
		$query = "SELECT id,nome,cpf,endereco,cep,cidade,estado FROM cliente WHERE id='$id'";
		$result_query = mysqli_query( $conn,$query ) or die(' Erro na query:' . $query . ' ' . mysql_error() );
 
		//percorrendo e exibindo o array com a listagem
		$verifica = 0;
		while ($row = mysqli_fetch_array( $result_query )) {

			echo "<br>[id] = $row[id]";
			echo "<br>[nome] = $row[nome]";
			echo "<br>[cpf] = $row[cpf]";
			echo "<br>[endereco] = $row[endereco]";
			echo "<br>[cep] = $row[cep]";
			echo "<br>[cidade] = $row[cidade]";
			echo "<br>[estado] = $row[estado]";
			$verifica = 1;
		}


		//verificar se achou o id pesquisado pelo usuario 
		if ($verifica == 0) {
			die("Cliente não encontrado!!");
		}

	}
?>