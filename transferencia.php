<!doctype html>
<?php
	session_start();
	require("include/config.php");
	require("include/crud.php");
	require("include/biblio.php");
	
	$idCliente = $_SESSION ["LJCLIENTE"]["id_cliente"];
	$idPedido = $_SESSION["LJPEDIDO"];
	$data = date("Y-m-d");
	$dadosVenda = array("id_cliente" => $idCliente, "data_venda" => $data, "pago" => 'N', "forma_pagamento" =>"transferencia");
	
	$idVenda = inserir("venda", $dadosVenda, true);
	
	$lst_carrinho = consultar("carrinho", "id_pedido = $idPedido");
	
	foreach ($lst_carrinho as $carrinho) {
		$subTotal = $carrinho["valor"] * $carrinho["qtde"];
		inserir("itens", array("id_venda" => $idVenda,
							  "id_produto" => $carrinho["id_produto"],
							  "valor_item" => $carrinho["valor"],
							  "qtde_item" => $carrinho["qtde"],
							  "subtotal" => $subTotal));
	}
	
	deletar("carrinho", "id_pedido = $idPedido");
	deletar("pedido", "id_pedido = $idPedido");
	unset($_SESSION["LJPEDIDO"]);
	unset($_SESSION["LJQTDE"]);
	$idPedido = null;
	
	echo "<script type='text/javaScript'> location.href='".URL_BASE."compra-finalizada/?v=$idVenda'</script>";
	
?>
<html>
<head>
<meta charset="utf-8">
<title>Projeto Integrador</title>
<link href="<?php echo URL_BASE?>css/reset.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_BASE?>css/estilo.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_BASE?>css/estilo-m.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script type="text/javascript" src="<?php echo URL_BASE?>js/jquery-1.11.2.min.js"></script>
<!--menu mobile-->  
<script>
	$(function(){
		$('.mobmenu').click (function(){
		$('.navmenu .conteudo').slideToggle();
		$(this).toggleClass('active');
			return false;
		});
	});
</script>


</head>

<body>

<?php include "cabecalho.php"?>

<?php include"rodape.php"?>

</body>
</html>

