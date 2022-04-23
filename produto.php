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
<script type="text/javascript" src="<?php echo URL_BASE?>js/jquery-1.11.2.min.js"></script>

<style>
ul{list-style:none; padding-left:10px;}

.abas li{float:left; border:1px solid #ccc; border-bottom:0; margin-right:10px; padding:10px; border-top-left-radius:5px; border-top-right-radius:5px; -moz-border-radius-topleft:5px; -moz-border-radius-topright:5px; -webkit-border-radius-topleft:5px; -webkit-border-radius-topright:5px; }

.abas li:hover{box-shadow:0 -2px 3px #DFDFDF; -moz-box-shadow:0 -2px 3px #DFDFDF; -webkit-box-shadow:0 -2px 3px #DFDFDF; font-weight:bold; border-color:#c0c0c0;}

.ativo{background-color:#ccc; border-color:#333;}

.ativo a{color:#fff; font-weight:bold; text-shadow:0 0 5px #999;}

.abas li a {color:#333; }

#noticia{position:relative; width:auto; height:auto; padding:10px; clear:both; border:1px solid #ccc; -moz-box-shadow:0 -1px 3px #ccc;}

#noticia div{display:none;}

.credito{font-size:1.1em; position:absolute; right:0; bottom:-40px; margin-top:15px;}

.credito a{font-size:1.1em;}

</style>
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

<script>
$(function(){
    $('#conteudo').hide();
    var noticia;    
    var hash = window.location.hash;
    if (hash !='')
    {
        noticia = $(hash).html();
        $('.abas li a[href="' + hash + '"]').parent().addClass('ativo');        
    } else {
        noticia = $('#conteudo div:first-child').html();            
        $('.abas li:first-child').addClass('ativo');        
    }
    $('#noticia').append('<div>' + noticia + '</div>').find('div').slideDown();
    $('.abas li a').click(function(){
        $('.abas li').removeClass('ativo');
        $(this).parent().addClass('ativo');
        var ancora = $(this).attr('href');
        var nome = ancora.substr(1, ancora.length);
        noticia = $('#conteudo div[id="' + nome + '"]').html();
        $('#noticia').empty();
        $('#noticia').append('<div>' + noticia + '</div>').find('div').slideDown();
    return false();
    })
})
</script>
</head>

<body>

<?php include "cabecalho.php"?>
	
	<?php
		$idProduto = (int) $_GET["p"];
		$produto = consultar("produto", "id_produto = $idProduto");
	?>
			
	<div class="conteudo margin-topo">
	<!-- menu lateral-->
	<?php include"menu-lateral.php"?>
	
	<div class="lado-dir">
	<title class="migalha"><?php echo $produto[0]["produto"] ?></title>
		<div class="base-detalhes">
		
			<div class="imagem"><img src="<?php echo URL_BASE ?>produtos/<?php echo $produto[0]["imagem"] ?>"></div>
			<div class="cx-opcoes">
				<h3><?php echo $produto[0]["produto"] ?></h3>
				<div class="cx-preco">
					<span class="preco-antigo">De R$ <?php echo $produto[0]["preco_alto"] ?></span> <span class="desconto">por apenas</span>
					<h2>R$ <?php echo $produto[0]["preco"] ?></h2>
					<span>em até 10x nos cratões</span>
					<i class="bandeiras"></i>
				</div>
				
				<form id="form1" name="frmcarrinho" method="post" action="<?php echo URL_BASE ?>carrinho">
					<input name="txt_preco" 	type="hidden" id="txt_preco" value = "<?php echo $produto[0]["preco"] ?>" />
					<input name="txt_qtde" 		type="hidden" id="txt_qtde" value = "1" />
					<input type="hidden" 		name="id_produto" value = "<?php echo $produto[0]["id_produto"] ?>"/>
					<input type="submit" 		name="imageField" class="carrinho" value="Adicionar ao carrinho"  />
				</form>
			</div>
		</div>	


<ul class="abas" >
    <li><a href="#descricao" >Descrição</a></li>
    <li><a href="#detalhes">Detalhes</a></li>    
</ul>

<div id="noticia"></div>

<div id="conteudo" >
	<div id="descricao" >    
		<p><?php echo $produto[0]["descricao"] ?></p>
	</div>

	<div id="detalhes">    
		<p><?php echo $produto[0]["detalhes"] ?></p>
	</div>
</div>		
		
		<!--Recomendados para você-->	
		<div class="recomendamos">
						
		<div class="cx-base-home">
			<h1><span>Recomendados para você</span></h1>
			
			<?php
				$recomendados = consultar ("produto", "id_categoria = ".$produto[0]["id_categoria"]
											." order by rand() limit 4");
				foreach ($recomendados as $recomendado) {
			?>
			
				<div class="caixa-prod-home quatro-colunas">
				<div class="cx-img">
						<a href="<?php echo URL_BASE ?>produto/?p=<?php echo $recomendado["id_produto"] ?>"><img src="<?php echo URL_BASE ?>produtos/<?php echo $recomendado["imagem"] ?>"title="<?php echo $recomendado["produto"]?>"></a>
				</div>
				<div class="limpar"></div>		
					<h2><a href="<?php echo URL_BASE ?>produto/?p=<?php echo $recomendado["id_produto"] ?>"><?php echo limita_caracteres($recomendado["produto"],40) ?></a></h2>
						<div class="prc-ant">De <small>R$ <?php echo $recomendado["preco_alto"] ?></small>&nbsp; Por</div>
							<h3>R$ <?php echo $recomendado["preco"] ?></h3>
										
					<div class="cx-botoes">
						<form id="form1" name="frmcarrinho" method="post" action="<?php echo URL_BASE ?>carrinho">
							<input name="txt_preco" 	type="hidden" id="txt_preco" value = "<?php echo $recomendado["preco"] ?>" />
							<input name="txt_qtde" 		type="hidden" id="txt_qtde" value = "1" />
							<input type="hidden" 		name="id_produto" value = "<?php echo $recomendado["id_produto"] ?>"/>
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
		


<?php include"rodape.php"?>

</body>
</html>