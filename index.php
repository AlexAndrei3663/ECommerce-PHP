<?php
	session_start();
	
	$conn = mysqli_connect("localhost", "root", "", "pdi") or die ("erro ao conectar com o banco de dados");
	
	// INSERÇÃO DOS DADOS QUE VIERAM DO FORMULÁRIO
	
	$insert = "INSERT INTO tarefas (nome, descricao, prazo, prioridade, concluida) VALUES (";
	
	if(isset($_POST['nome'])){
		$insert = $insert."\"".$_POST["nome"]."\"";
	}
	
	if(isset($_POST['descricao'])){
		$insert = $insert.", \"".$_POST["descricao"]."\"";
	}
	
	if(isset($_POST['prazo'])){
		$insert = $insert.", \"".$_POST["prazo"]."\"";
	}
	
	if(isset($_POST['prioridade'])){
		$insert = $insert.", \"".$_POST["prioridade"]."\"";
	}
	
	if(isset($_POST['concluida'])){
		$insert = $insert.", \"".$_POST["concluida"]."\"";
	}
	
	$insert = $insert.")";
	mysqli_query($conn, $insert);
	
	
	//CRIA A LISTA DE TAREFAS A PARTIR DO BANCO DE DADOS 
	
	$lista_tarefas = array();
	
	$sqlBusca = 'SELECT * FROM tarefas';
	$resultado = mysqli_query($conn,$sqlBusca);
	
	while($tarefa = mysqli_fetch_assoc($resultado)){
		$lista_tarefas[] = $tarefa;
	}
?>

<html>
	<head>
		<title>Gerenciador de Tarefas</title>
	</head>
	<body>
		<h1>Gerenciador de Tarefas</h1>
		<form method="post">
			<fieldset>
				<legend>Nova Tarefa</legend>
				<label>Tarefa: <input type="text" name="nome" /></label>
				<label>Descricao: <input type="text" name="descricao" /></label>
				<label>Prazo: <input type="text" name="prazo" /></label>
				<label>Prioridade: <input type="text" name="prioridade" /></label>
				<label>Concluida: <input type="text" name="concluida" /></label><br /><br />
				<input type="submit" value="Cadastrar">
			</fieldset>
		</form>
		
		<table>
			<?php foreach ($lista_tarefas as $tarefa) { ?>
			<tr>
				<td>Tarefa: <?php echo $tarefa["nome"]?></td>
				<td>Descricao: <?php echo $tarefa["descricao"]?></td>
				<td>Prazo: <?php echo $tarefa["prazo"]?></td>
				<td>Prioridade: <?php echo $tarefa["prioridade"]?></td>
				<td>Concluida <?php echo $tarefa["concluida"]?></td>
			</tr>
			<?php } ?>
		</table>
	</body>
</html>