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
<div class="conteudo margin-topo">
	<!-- menu lateral-->
	<?php include"menu-lateral.php"?>
	
	<div class="lado-dir">
	<title class="migalha">Carrinho/ vazio</title>
			
		<!---- carrinho vazio-------->
		<div class="base-carrinho">
			<div class="vazio">
			<img src="imagens/img-carrinho-vazio.png">
			<span>
			<h2>Seu carrinho está vazio</h2>
			<a href="index.php?link=1">Voltar para página inicial</a>
			</span>
			</div>
		</div>
		
</div>
		
</div>

<?php include"rodape.php"?>

</body>
</html>