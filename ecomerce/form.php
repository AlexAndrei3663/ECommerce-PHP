<?php 
		$conn = mysqli_connect("localhost", "root", "", "pdi") or die ("erro ao conectar ao banco de dados");
		
		$msgErroSucesso = "";
		 
		$inserindo = false;
		if(isset($_POST['inserindo'])){
			$inserindo =true;
		}
		
		if($inserindo){
		
		$insert = "INSERT INTO produto (nome, descricao, resumo, preco) VALUES (";
		
		if (!empty($_POST ['nome'])) {
			$insert = $insert."'".$_POST["nome"]."',";
		}
		else{
			$msgErroSucesso = "ERRO!";
		}
		
		$insert = $insert."'".$_POST["descricao"]."',";
		
		$insert = $insert."'".$_POST["resumo"]."',";
		
		if (!empty($_POST ['preco'])) {
			$insert = $insert."'".$_POST["preco"]."'";
		}
		else{
			$msgErroSucesso = "ERRO!";
		}
		
		$insert = $insert .")";
		
		$res = mysqli_query($conn, $insert);
		
			if($res){
				$msgErroSucesso .= "<span style ='font-color: #0f0; font-weight: bold;'> Cadastro Feito com Sucesso!</span>";
			}
			else{
				$msgErroSucesso .= "<span style ='font-color: #f00; font-weight: bold;'> Ocorreu um erro ao tentar cadastrar a tarefa!</span>";
			}
		
		}
?>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
	
		<title> EComerce </title>
		<!-- Bootstrap Core CSS -->
		<link href="css2/bootstrap.min.css" rel="stylesheet">
		<!-- MetisMenu CSS -->
		<link href="css2/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="css2/sb-admin-2.css" rel="stylesheet">
		<!-- Custom Fonts -->
		<link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	
		<h1>Formulário de Cadastro</h1><br />
		
		<div> <?php echo $msgErroSucesso;?> </div>
		
			<form method="post">
				<div class="form-group">
					<label>Nome:</label>
					<input name ="nome" class="form-control" width="50"><br />
					<label>Descricao:</label>
					<textarea name ="descricao" class="form-control" rows="3"></textarea><br />
					<label>Resumo:</label>
					<input name ="resumo" class="form-control"><br />
					<label>Preco:</label>
					<input name ="preco" class="form-control">
					<input type="hidden" name="inserindo" value="1">
					<p class="help-block">Exemplo: 99.99</p><br />
				</div>
				
				<input type="submit" value="Cadastrar"/>
			</form>
	</body>
</html>