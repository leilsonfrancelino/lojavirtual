<!doctype html>
<?php 
	session_start();
	require("include/config.php");
	require("include/crud.php");
	require("include/biblio.php");
	$idCliente = $_SESSION ["LJCLIENTE"]["id_cliente"];
	$idPedido = @$_SESSION["LJPEDIDO"];
	//unset($_SESSION["LJCLIENTE"]);	
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

<?php
    
    if((@$idCliente =="") || (is_null(@$idCliente))){
        $url = URL_BASE."nao-logado";
        echo "<script languague='javaScript'> window.location='$url'</script>";
        
    }
     

?>
<div class="conteudo margin-topo">
	<!-- menu lateral-->
	<?php include"menu-lateral.php"?>
	
	<div class="lado-dir">
	<title class="migalha">Minha Área</title>
	<div class="base-cadastro dados-cliente">
		
		<form action="op_cliente.php" method="post">
		<h1><span>Meus dados</span></h1>	
		
<div class="caixa-carrinho clientes">			
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<thead>
	  <tr>
		<th align="center">Nome</th>
		<th align="center">Email</th>
		<th align="center">Endereço</th>
		<th align="center">Bairro</th>
		<th align="center">CEP</th>
		<th align="center">Cidade</th>
		<th align="center">Telefone</th>
		<th align="center">UF</th>
	  </tr>
	  </thead>
	  <tbody>
	  <tr>
		<td><?php echo @$_SESSION["LJCLIENTE"]["cliente"] ?></td>
		<td><?php echo @$_SESSION["LJCLIENTE"]["email"] ?></td>
		<td><?php echo @$_SESSION["LJCLIENTE"]["endereco"] ?></td>
		<td><?php echo @$_SESSION["LJCLIENTE"]["bairro"] ?></td>
		<td><?php echo @$_SESSION["LJCLIENTE"]["cep"] ?></td>
		<td><?php echo @$_SESSION["LJCLIENTE"]["cidade"] ?></td>
		<td><?php echo @$_SESSION["LJCLIENTE"]["fone"] ?></td>
		<td><?php echo @$_SESSION["LJCLIENTE"]["uf"] ?></td>
	  </tr>
	  <tr>
	    <td colspan="8" align="right"><a href="<?php echo URL_BASE ?>cadastro" class="botao">Alterar dados</a></td>
	    </tr>
	  </tbody>
</table>
</div>			
			
	</form>
	</div>	
	<div class="limpar"></div>
<title class="migalha">Meus pedidos</title>
<div class="base-carrinho lista-carrinho">
			<p>&nbsp;</p>

<div class="caixa-carrinho lista">	
              <?php              
				$lst_mcompras = selecionar ("SELECT * FROM venda WHERE id_cliente = $idCliente");
											
                foreach ($lst_mcompras as $mcompra){      
					$idVenda = $mcompra["id_venda"];
                ?>
				
				<div class="pedidos">			
					<p>Pedido:<p>			
						<div class="meus-pedidos">				
							<span><?php echo  $mcompra["id_venda"] ?></span>						
						</div>				
					<p>Data da compra:<p>
						<div class="meus-pedidos">					
							<span><?php echo  $mcompra["data_venda"] ?></span>					
						</div>
					<p>Forma de pagamento:<p>
						<div class="meus-pedidos">					
							<span><?php echo  $mcompra["forma_pagamento"] ?></span>
						</div>
				</div>					
			
		

		<div class="caixa-carrinho lista">
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
						$lst_mcomprasitens = selecionar ("SELECT i.*, p.* FROM itens i, produto p WHERE i.id_produto = p.id_produto and id_venda = $idVenda");											
						foreach ($lst_mcomprasitens as $mcompraitens){                      
					 ?>
						<tr>
							<td><img src="<?php echo URL_BASE ?>produtos/<?php echo $mcompraitens["imagem"] ?>" title="<?php echo $mcompraitens["produto"] ?>" rel="<?php echo $mcompraitens["produto"] ?>"><?php echo $mcompraitens["produto"] ?></td>							
							<td align="center"><h3><?php echo $mcompraitens["qtde_item"] ?></h3></td>
							<td align="center"><h3>R$ <?php echo $mcompraitens["valor_item"] ?></h3></td>
							<td align="center">R$ <?php echo $mcompraitens["subtotal"]?></h3></td>
						</tr>
					<?php }?> 
				
				</tbody>	  	
		
			</table>
		</div>
	
<?php  }?>	
	</div>
		
	</div>
</div>

		
</div>

</div>

<?php include"rodape.php"?>

</body>
</html>