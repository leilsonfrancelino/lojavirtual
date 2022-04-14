<!doctype html>
<?php 
	require("include/config.php");
	require("include/crud.php");
	require("include/biblio.php");
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
	$idSubcat = (int) $_GET["s"];	
	$subcat_selecionada = selecionar ("select * from subcategoria where id_subcategoria = $idSubcat and ativo_subcategoria = 'S' ");
    $lst_produtos = consultar("produto", "id_subcategoria = $idSubcat and ativo_produto='S'");

?>
<div class="conteudo">
<?php include "menu-lateral.php"?>

<div class="lado-dir">
<div class="base-home">
<!-- com tres produtos-->	
		<div class="cx-base-home categoria">			
			<h1><span><?php echo $subcat_selecionada[0]["subcategoria"]?></span></h1>
			
			<?php
				if($lst_produtos) {
				foreach($lst_produtos as $lst_produto) {
			?>
				
				<div class="quatro-colunas-cat sub">
					<div class="cx-img">
						<a href="<?php echo URL_BASE ."produto/?p=".$lst_produto["id_produto"]?>"><img src="<?php echo URL_BASE ?>produtos/<?php echo $lst_produto["imagem"]?>" title="<?php echo $lst_produto["produto"]?>"></a>
					</div>	
						<h2><a href="<?php echo URL_BASE ."produto/?p=".$lst_produto["id_produto"]?>"><?php echo limita_caracteres($lst_produto["produto"],40)?></a></h2>
						<div class="prc-ant">De <small>R$ <?php echo $lst_produto["preco_alto"]?></small> <font> Por</font></div>
					    <h3>R$ <?php echo $lst_produto["preco"]?></h3>
															
					<div class="cx-botoes">
						<form id="form1" name="frmcarrinho" method="post" action="<?php echo URL_BASE ?>carrinho">
							<input name="txt_preco" 	type="hidden" id="txt_preco" value = "<?php echo $lst_produto["preco"]?>" />
							<input name="txt_qtde" 		type="hidden" id="txt_qtde" value = "1" />
							<input type="hidden" 		name="id_produto" value = "<?php echo $lst_produto["id_produto"]?>"/>
							<input type="submit" 		name="imageField" class="bot-comprar" value="Comprar"  />
						</form>
						<a href="<?php echo URL_BASE ?>/produto" class="bot-detalhe">Detalhes</a>
						<div class="cx-frete"><b class="frete">FRETE</b><b class="val-frete">GRÁTIS</b></div>
						<div class="bandeiras none"><font>Em até <b>10x</b> nos cartões</font><img src="<?php echo URL_BASE ?>/imagens/bandeiras2.png"></div>
					</div>
				
				</div>
				<?php } } else
					echo "Sem produto"?>
		</div>	
		
</div>
				
			
					
			<!--sidebar-->
			<?php include"sidebar.php" ?>
			
</div>
</div>

		


<?php include"rodape.php"?>

</body>
</html>