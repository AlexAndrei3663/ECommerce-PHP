<?php
	
	$conn = mysqli_connect("localhost", "root", "", "pdi") or die ("erro ao conectar ao banco de dados");
	
	echo "conexao efetuada com sucesso";
	
	$q = "INSERT INTO tarefas (nome, descricao, prazo, prioridade, concluida) VALUES ('Teste', 'teste', '".date("Y-m-d")."', 1, 1)";
	$resultado = mysqli_query($conn, $q);
	
	echo $resultado;
	
?>