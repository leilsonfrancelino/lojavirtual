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
	<title class="migalha">Login / Cadastro</title>
	<p>&nbsp;</p>
	<div class="base-cadastro finaliza">	
		<form action="op_login.php" method="post">
			<h1><span>Acesse sua conta</span><br/><p>Se você já possui uma conta, informe seus dados.</p></h1>
			<label>
				<strong>Email:</strong>
				<input type="text" name="tx_email">
			</label>
			
			<label>
				<strong>Senha:</strong>
				<input type="password" name="tx_senha">
			</label>
			
			<label><a href="index.php?link=10" class="relembrar">Esqueceu sua senha?</a></label>						
			<label>
				<input type="hidden" name="venda" value="S">
				<input type="submit" class="cadastrar logar" value="Entrar">
			</label>
		</form>
	</div>
		<div class="limpar"></div>
			<div class="separa"><span>OU</span></div>
		<div class="limpar"></div>
	<div class="base-cadastro finaliza">
		<h1><span>Cadastre-se aqui</span><br/><p>Se ainda não é cadastrado, cadastre-se aqui.</p></h1>
		<form action="op_cliente.php" method="post">
			<label>
				<strong>Cliente:</strong>
				<input type="text" name="txt_cliente" required="true">
			</label>
			<label class="fl">
				<strong>Endereço:</strong>
				<input type="text" name="txt_endereco">
			</label>
			<label class="fl">
				<strong>Bairro:</strong>
				<input type="text" name="txt_bairro">
			</label>
			
			<label class="fl">
				<strong>CEP:</strong>
				<input type="text" name="txt_cep">
			</label>
			<label class="fl">
				<strong>Cidade:</strong>
				<input type="text" name="txt_cidade">
			</label>
			
			<label class="fl">
				<strong>Telefone:</strong>
				<input type="text" name="txt_fone">
			</label>
			<label class="fl">
				<strong>UF:</strong>
				<input type="text" name="txt_uf">
			</label>
			<label class="fl">
				<strong>Email:</strong>
				<input type="text" name="txt_email">
			</label>
			<label class="fl">
				<strong>Senha:</strong>
				<input type="text" name="txt_senha">
			</label>			
			<label>
			<input type="submit" class="cadastrar" value="Cadastrar">
			</label>
			</form>
	</div>
						
		
	
	</div>
</div>

<?php include"rodape.php"?>

</body>
</html>