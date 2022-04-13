<!doctype html>
<?php 
	session_start();
	//unset($_SESSION["LJPEDIDO"]);
	require("include/config.php");
	require("include/crud.php");
	require("include/biblio.php");
?>
<html>
<head>
<meta charset="utf-8">
<title>mjailton ligando você ao mundo do conhecimento</title>
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

<?php
	$idPedido = @$_SESSION["LJPEDIDO"];
	$idProduto = strip_tags(filter_input(INPUT_POST, "id_produto"));
	$preco = strip_tags(filter_input(INPUT_POST, "txt_preco"));
	$qtde = strip_tags(filter_input(INPUT_POST, "txt_qtde"));
	$data = date("Y-m-d");
	$id_cliente = 0;
	
	
	
	if(($idProduto!="") || ($idProduto!=0)) {
		if(($idPedido=="") || ($idPedido==0)) {
			$dados = array("data_pedido" => $data, "id_cliente" => $id_cliente);
			$idPedido = inserir("pedido", $dados, true);
			
			if ($idPedido)
				$_SESSION["LJPEDIDO"] = $idPedido;			
		}
		//verifica se o produto esta no carrinho de compras
		$existe = consultar("carrinho", "id_produto = $idProduto and id_pedido = $idPedido");
			if($existe) {
				executar("UPDATE carrinho SET qtde = qtde + 1 WHERE id_produto = $idProduto and id_pedido=$idPedido");
			}else{
				inserir("carrinho", array("id_produto" => $idProduto, "id_pedido" => $idPedido, "valor" => $preco, "qtde" =>1));
			}
		}
			
		if($idPedido) {
			if($_POST["atualiza"]=="S") {
				$valores = $_POST["codProduto"];
				
				$chave = array_keys($valores);
				
				for($i=0;$i<sizeof($chave);$i++) {
					$indice = $chave[$i];
					if($valores[$indice]["QTDE"]>0) {
						alterar("carrinho", array("qtde"=>$valores[$indice]["QTDE"]), "id_produto = ".$valores[$indice]["ID"] ." and id_pedido = $idPedido");
				}
			
			}
		}
			if ($_GET["p"]) {
				deletar("carrinho", "id_pedido = $idPedido and id_produto = " .$_GET["p"]);
			}
			$lst_carrinho = consultar("carrinho c, produto p", "c.id_produto = p.id_produto and id_pedido = $idPedido");
			
		}	
	
	    if($lst_carrinho) {
?>

<div class="conteudo">
<?php include"menu-lateral.php"?>
<div class="lado-dir">
	<title class="migalha">Lista de Produtos do seu Carrinho</title>
		<div class="base-carrinho">
			<div class="prog1"></div>
			<p>&nbsp;</p>


<div class="caixa-carrinho">			
<form action="" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<thead>
	  <tr>
		<th width="50%" align="center">Produto</th>
		<th width="14%" align="center">Quantidade</th>
		<th width="18%" align="center">Valor unitario</th>
		<th width="18%" align="center">Valor total</th>
	  </tr>
	  </thead>
	  <tbody>
			
			<?php
				$somaTotal = 0;
				$i = 0;
				foreach ($lst_carrinho as $carrinho) {
					$subTotal = $carrinho["valor"] * $carrinho["qtde"];
					$somaTotal = $somaTotal + $subTotal;
					
			?>
	  	  <tr>
		<td rowspan="2"><img src="<?php echo URL_BASE ?>produtos/<?php echo $carrinho["imagem"] ?>" title="<?php echo $carrinho["produto"] ?>" rel="<?php echo $carrinho["produto"] ?>"><?php echo $carrinho["produto"] ?></td>
		<td rowspan="2" align="center"><input type="Number" name="codProduto[<?php echo $i ?>][QTDE]" id="textfield" value="<?php echo $carrinho["qtde"] ?>" class="cont"/></td>
		<td rowspan="2" align="center"><h3>R$ <?php echo $carrinho["valor"] ?></h3></td>
		<td align="center"><h3>R$ <?php echo $carrinho["valor"] * $carrinho["qtde"] ?></h3></td>
		<input type="hidden" name ="codProduto[<?php echo $i ?>][ID]" value="<?php echo $carrinho["id_produto"] ?>">
		<input type="hidden" name="atualiza" value="S">
		</tr>
	  <tr>
	    <td align="center">
		<input type="submit" value="atualizar">
		
		<a href="<?php echo URL_BASE. "carrinho/?p=$carrinho[id_produto]"?>" class="excluir">Excluir</a></td>
	    </tr>
				<?php $i++; } ?>
	  	  </tbody>
</table>

<h3 class="total">Valor Total: R$ <?php echo $somaTotal ?> </h3>
	
<div class="limpar"></div>
<div class="base-btns">
	<a href="<?php echo URL_BASE ?>" class="produtos">ESCOLHER MAIS PRODUTOS</a>
	<div class="botoes">
	<a href="<?php echo URL_BASE ?>pagamento" class="comprar">Finalizar Compra</a>
	</div>
	
</div>


	</form>	
</div>
</div>

<!--Recomendados para você-->	
	<div class="recomendamos">
						
		<div class="cx-base-home">
			<h1><span>Recomendados para você</span></h1>
			
			<?php
				$recomendados = consultar ("produto", "id_categoria = ".$lst_carrinho[0]["id_categoria"]
											." order by rand() limit 4");
				foreach ($recomendados as $recomendado) {
			?>
			
				<div class="caixa-prod-home quatro-colunas">
				<div class="cx-img">
						<a href="<?php echo URL_BASE ?>produto/&p=41"><img src="<?php echo URL_BASE ?>produtos/<?php echo $recomendado["imagem"] ?>"></a>
				</div>
				<div class="limpar"></div>		
					<h2><a href="<?php echo URL_BASE ?>produto/&p=<?php echo $recomendado["id_produto"] ?>"><?php echo $recomendado["produto"] ?></a></h2>
						<div class="prc-ant">De <small>R$ <?php echo $recomendado["preco_alto"] ?></small>&nbsp; Por</div>
							<h3>R$ <?php echo $recomendado["preco"] ?></h3>
										
					<div class="cx-botoes">
						<form id="form1" name="frmcarrinho" method="post" action="<?php echo URL_BASE ?>carrinho">
							<input name="txt_preco" 	type="hidden" id="txt_preco" value = "900.00" />
							<input name="txt_qtde" 		type="hidden" id="txt_qtde" value = "1" />
							<input type="hidden" 		name="id_produto" value = "41"/>
							<input type="submit" 		name="imageField" class="bot-comprar" value="Comprar"  />
						</form>
						<div class="cx-frete"><b class="frete">FRETE</b><b class="val-frete">GRÁTIS</b></div>
					</div>
				</div>								
				<?php } ?>						
							</div>
		</div>
		
</div>
</div>
		<?php } else{ ?>
				<div class="conteudo margin-topo">
	<!-- menu lateral-->
	<?php include"menu-lateral.php"?>
	
	<div class="lado-dir">
	<title class="migalha">Carrinho/ vazio</title>
			
		<!---- carrinho vazio-------->
		<div class="base-carrinho">
			<div class="vazio">
			<img src="<?php echo URL_BASE ."imagens/img-carrinho-vazio.png"?>">
			<span>
			<h2>Seu carrinho está vazio</h2>
			<a href="index.php?link=1">Voltar para página inicial</a>
			</span>
			</div>
		</div>
		
</div>
		
</div>
		<?php } ?>

<?php include"rodape.php"?>

</body>
</html>