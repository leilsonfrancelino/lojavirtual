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
<link href="<?php echo URL_BASE?>css/estiloAbas.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_BASE?>css/reset.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_BASE?>css/estilo.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_BASE?>css/estilo-m.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script type="text/javascript" src="<?php echo URL_BASE?>js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo URL_BASE?>js/jquery-1.11.2.min.js"></script>
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
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
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
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
		
	<div class="tab">
		  <button class="tablinks" onclick="openCity(event, 'London')">Descrição</button>
		  <button class="tablinks" onclick="openCity(event, 'Paris')">Detalhes</button>  
	</div>

		<div id="London" class="tabcontent">
		   <p><?php echo $produto[0]["descricao"] ?></p>
		</div>

		<div id="Paris" class="tabcontent">
		  <p><?php echo $produto[0]["detalhes"] ?></p> 
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