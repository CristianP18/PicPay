<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css"/>
    <title>Pedido de Oração!</title>
</head>
<body>
    <?php 
    require_once "includes/funcoes.php";
    require_once "includes/banco.php";
    require_once "includes/login.php";

    $ordem = $_GET['o'] ?? "nome";
    $chave = $_GET['c'] ?? "";
    ?>
    <div id="body">
    <?php include "topo.php"; ?>
    <h1>Escolha seu jogo</h1>
		
		<form method="get" action="pedidoDeOraçao.php">
		<p class= "pequeno"> Ordenar: <a href="index.php?o=n">Nome |</a> <a href="index.php?o=d">Distribuidora |</a> <a href="index.php?o=n1">Nota Alta |</a> <a href="index.php?o=n2">Nota Baixa |</a> Buscar:<input type="text" name="c" size="10" maxlength="40"/><input type="submit" value="Ok"/></p>
		</form>
		<table class="listagem">
			<?php
				$q = "SELECT * from pedidos ";
				if (!empty($chave)) {
					$q .= " WHERE j.nome like '%$chave%' OR p.produtora like '%$chave%' OR g.genero like '%$chave%'";
				}
				switch ($ordem) {
					case "d":
						$q .= " ORDER BY urgencia";
						break;
					case "n1":
						$q .= " ORDER BY cod DESC";
						break;
					case "n2":
						$q .= " ORDER BY cod ASC";
						break;
					default:
						$q .= " ORDER BY nome";
						break;
				}
				
				$busca = $banco->query($q);
				if (!$busca) {
					echo "Falhou! $banco->error";
				} else {
					echo msg_sucesso('Arquivo aberto com sucesso!');
				
					if ($busca->num_rows > 0) {
						while($reg = $busca->fetch_object()){
							# Carregar thumb
							echo "<tr><td>";
							$thumb = thumb($reg->capa);
							echo "<img src='$thumb' class='mini'/>";
							# Mostrar jogo
							echo "<td><a href='detalhes.php?cod=$reg->cod'>$reg->nome</a>";
							echo "<br> Classe: ($reg->urgencia) $reg->cod";
							if (is_admin()) {
								echo "<td><span class='material-symbols-outlined'>
								add_circle</span></a>";
								echo "<span class='material-symbols-outlined'>
								edit </span></a>";
								echo "<span class='material-symbols-outlined'>
								delete </span></a>";
							}elseif (is_editor()) {
								echo "<td>Alterar";
							}
						}
					} else {
						echo "<p>Nenhum registro encontrado...</p>";
					}						
				}
			?>
		</table>
    

    </div>
    <?php 
  echo voltar("Voltar"); ?>
    </div>
</body>
</html>