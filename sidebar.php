

<div class="sidebar cx-base-home">

	<div class="ultimo-lanc">
		<h2>ÚLTIMOS LANÇAMENTOS</h2>
		<?php
			$lst_destaques = consultar("produto","destaque = 'S' and ativo_produto = 'S' order by rand() limit 3");
			foreach ($lst_destaques as $lst_destaque) {
		?>
		<div class="caixa">
			<div class="prod"><a href="<?php echo URL_BASE ?>/produto/?p=2"><img src="<?php echo URL_BASE ?>/produtos/<?php echo $lst_destaque["imagem"]?>" title="<?php echo $lst_destaque["produto"]?>"></a></div>
				<div class="del">
				<h4><a href="<?php echo URL_BASE ?>/produto/?p=<?php echo $lst_destaque["id_produto"]?>"><?php echo limita_caracteres($lst_destaque["produto"],40)?></a></h4>
				<div class="prc-ant">De <small>R$ <?php echo $lst_destaque["preco_alto"]?></small><font> Por</font></div>
				<span>R$ <?php echo $lst_destaque["preco"]?></span>
				<form id="form1" name="frmcarrinho" method="post" action="<?php echo URL_BASE ?>/carrinho">
					<input name="txt_preco" 	type="hidden" id="txt_preco" value = "<?php echo $lst_destaque["preco"]?>" />
					<input name="txt_qtde" 		type="hidden" id="txt_qtde" value = "1" />
					<input type="hidden" 		name="id_produto" value = "<?php echo $lst_destaque["id_produto"]?>"/>
					<input type="submit" 		name="imageField" class="comprar" value="Comprar"  />
				</form>
				
				</div>
				
		</div>
		<?php } ?>
	</div>

	<a href="#"><img src="<?php echo  URL_BASE ?>imagens/img-publicidade.png"></a>
	<a href="#"><img src="<?php echo  URL_BASE ?>imagens/img-publicidade.png"></a>
	<a href="#"><img src="<?php echo  URL_BASE?>imagens/img-publicidade.png"></a>
	
</div>

