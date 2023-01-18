<?php 

		session_start();
		
		$conn = mysqli_connect("localhost", "root", "", "pdi") or die ("erro ao conectar ao banco de dados");
		
		$msgErroSucesso = "";
		 
		$inserindo = false;
		if(isset($_POST['inserindo'])){
			$inserindo =true;
		}
		
		if($inserindo){
		
		$insert = "INSERT INTO tarefas (nome, descricao, prazo, prioridade, concluida) VALUES (";
		
		if (!empty($_POST ['nome'])) {
			$insert = $insert."'".$_POST["nome"]."',";
		}
		else{
			$msgErroSucesso = "ERRO!";
		}
		
		$insert = $insert."'".$_POST["descricao"]."',";
		
		if (empty($_POST ["prazo"])) {
			$insert = "null";
		}
		else{
			$insert = $insert.$_POST["prazo"].",";
		}
		
		if (!empty($_POST ['prioridade'])) {
			$insert = $insert.$_POST["prioridade"].",";
		}
		
		if (!empty($_POST ['concluida'])) {
			$insert = $insert.$_POST["concluida"];
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
		
		$lista_tarefas = array();
		
		$sqlBusca= 'SELECT *FROM tarefas';
		$resultado = mysqli_query($conn, $sqlBusca);
		
		while($tarefa = mysqli_fetch_assoc($resultado)){
			$lista_tarefas[] = $tarefa;
		
		};
		
		
	?>
	
<html>
<head>
	<title> Gerenciador de Tarefas</title>
</head>	
<body>	
	<h1> Gerenciador de Tarefas</h1>
	
	<div> <?php echo $msgErroSucesso;?></div>
	
	<form method="post">
		<fieldset>
			<legend> Nova Tarefa </legend>
				<label>Nome:<input type ="text" name ="nome"/></label>
				<label>Descricao:<input type ="text" name ="descricao"/></label>
				<label>Prazo:<input type ="text" name ="prazo"/></label>
				<label>Prioridade:<input type ="text" name ="prioridade"/></label>
				<label>Concluida:<input type ="text" name ="concluida"/></label>
				<input type="hidden" name ="inserindo" value="1">
				<input type="submit" value="Cadastrar"/>
		</fieldset>
	</form>
	
	<table>
		
		<?php foreach ($lista_tarefas as $tarefa) {?>
		<tr>
			<td> Tarefa: <?=$tarefa["nome"]?> </td>
			<td> Descricao: <?=$tarefa["descricao"]?> </td>
			<td> Prazo: <?=$tarefa["prazo"]?> </td>
			<td> Prioridade: <?=$tarefa["prioridade"]?> </td>
			<td> Concluida: <?=$tarefa["concluida"]?> </td>
			
		</tr>
		
		<?php } ?>
		
	
	</table>
	
	
	
</body>	
</html>
