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
    ?>
    <div id="body">
    <?php include "topo.php"; ?>
    <table class="detalhes">
			<?php
				$cod = $_GET['cod'] ?? 0;
				$q = "SELECT * FROM pedidos WHERE cod = '$cod'";
				$busca = $banco->query($q);
				if (!$busca) {
					echo "Falhou! $banco->error";
				} else {
					if ($busca->num_rows > 0) {
						$reg = $busca->fetch_object();
						$thumb = thumb($reg->capa);
						echo "<tr><td rowspan='3'><img class='grande' src='$thumb'/>";
						echo "<td><h1>$reg->nome</h1>";
						echo "Pedido Numero: $reg->cod ";
						echo "<tr><td><p style padding: 20px;>$reg->pedido</p>";
					} else {
						echo "<p>Jogo não encontrado</p>";
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