<!--mais vendidos-->
	<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<h1>Novidades</h1>
			
			<?php
				$lst_destaques = consultar("produto","destaque = 'S' and ativo_produto = 'S' order by rand() limit 3");
				foreach ($lst_destaques as $lst_destaque) {
			?>
							
				<div class="col-md-4 col-xs-6">	
					<div class="shop" style="widght: 345px; height: 240px;"><a href="<?php echo URL_BASE ?>/produto/?p=2"><img src="<?php echo URL_BASE ?>/produtos/<?php echo $lst_destaque["imagem"]?>" title="<?php echo $lst_destaque["produto"]?>"></a>
					
						<div class="shop-body">
							<h3 style="font-size: 18px;" href="<?php echo URL_BASE ?>/produto/?p=<?php echo $lst_destaque["id_produto"]?>"><?php echo limita_caracteres($lst_destaque["produto"],20)?></h3>
							
							<h4>R$ <?php echo $lst_destaque["preco"]?></h4>
							
							<form id="form1" name="frmcarrinho" method="post" action="<?php echo URL_BASE ?>/carrinho">
								
								<input name="txt_preco" 	type="hidden" id="txt_preco" value = "<?php echo $lst_destaque["preco"]?>" />
								<input name="txt_qtde" 		type="hidden" id="txt_qtde" value = "1" />
								<input type="hidden" 		name="id_produto" value = "<?php echo $lst_destaque["id_produto"]?>"/>
								<input type="submit" 		name="imageField" class="btn btn-default" value="Adicionar"  />
								
							</form>		
							
						</div>
						
<<<<<<< HEAD
		<div class="cx-maisvendido">
			<div class="prod"><a href="<?php echo URL_BASE ?>/produto/?p=2"><img src="<?php echo URL_BASE ?>/produtos/<?php echo $lst_destaque["imagem"]?>" title="<?php echo $lst_destaque["produto"]?>"></a></div>
				<div class="del">
				<h2><a href="<?php echo URL_BASE ?>/produto/?p=<?php echo $lst_destaque["id_produto"]?>"><?php echo limita_caracteres($lst_destaque["produto"],40)?></a></h2>
				<div class="prc-ant">De <small>R$ <?php echo $lst_destaque["preco_alto"]?></small><font> Por</font></div>
				<span>R$ <?php echo $lst_destaque["preco"]?></span>
				<form id="form1" name="frmcarrinho" method="post" action="<?php echo URL_BASE ?>/carrinho">
					<input name="txt_preco" 	type="hidden" id="txt_preco" value = "<?php echo $lst_destaque["preco"]?>" />
					<input name="txt_qtde" 		type="hidden" id="txt_qtde" value = "1" />
					<input type="hidden" 		name="id_produto" value = "<?php echo $lst_destaque["id_produto"]?>"/>
					<input type="submit" 		name="imageField" class="comprar" value="Comprar"  />
				</form>
				<div class="cx-frete"><b class="frete">FRETE</b><b class="val-frete">GRÁTIS</b></div>
				
=======
					</div>
>>>>>>> dcb1d5e377d419f5eeb608ddf2980a4a56eb09f5
				</div>
			<?php } ?>
			
		</div>
	</div>
</div>

<div class="conteudo">
	<div class="lado-dir">
		<div class="base-home">		
	
				
			<!-- com quatro produtos-->	
			
			<!-- <?php 
				$lst_categorias = selecionar("select * from categoria where id_categoria in (select distinct id_categoria from produto)"
								." order by rand() limit 5");
								
				foreach($lst_categorias as $lst_categoria) {
			?>
						
			<div class="cx-base-home">
				<h1><span><?php echo $lst_categoria["categoria"]?></span></h1>
				
				<?php
					$idCategoria = $lst_categoria["id_categoria"];
					$lst_produtos = consultar("produto","id_categoria = $idCategoria limit 6");
					foreach ($lst_produtos as $lst_produto) {
				?>
				
				<div class="caixa-prod-home quatro-colunas">
					<div class="cx-img">
						<a href="<?php echo URL_BASE ?>produto/?p=4"><img src="produtos/<?php echo $lst_produto["imagem"]?>" title="<?php echo $lst_produto["produto"]?>"</a>
						</div>		
								<h2><a href="<?php echo URL_BASE ?>produto/?p=<?php echo $lst_produto["id_produto"]?>">
								<?php echo limita_caracteres($lst_produto["produto"],40)?></a></h2>
								<div class="prc-ant">De <small>R$ <?php echo $lst_produto["preco_alto"]?></small> Por</div>
									<h3>R$ <?php echo $lst_produto["preco"]?></h3>
												
							<div class="cx-botoes">
								<form id="form1" name="frmcarrinho" method="post" action="<?php echo URL_BASE ?>carrinho">
									<input name="txt_preco" 	type="hidden" id="txt_preco" value = "<?php echo $lst_produto["preco"]?>" />
									<input name="txt_qtde" 		type="hidden" id="txt_qtde" value = "1" />
									<input type="hidden" 		name="id_produto" value = "<?php echo $lst_produto["id_produto"]?>"/>
									<input type="submit" 		name="imageField" class="bot-comprar" value="Comprar"  />
								</form>
								<div class="cx-frete"><b class="frete">FRETE</b><b class="val-frete">GRÁTIS</b></div>
								<div class="bandeiras none" ><font><b>10x</b> nos cartões</font><img src="imagens/bandeiras2.png"></div>
							</div>
						</div>

					<?php } ?>

				</div>					
				
				<?php } ?>

			</div> -->
			
			<!-- <?php include"sidebar.php"?> -->
		</div>			
	</div>
</div>