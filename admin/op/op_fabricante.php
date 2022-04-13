<?php
	require_once '../../include/config.php';
	require_once '../../include/crud.php';
	
	$id = $_POST["id"];
	$acao = $_POST["acao"];
	
	$txt_fabricante = $_POST["txt_fabricante"];
	$txt_ativo = $_POST["txt_ativo"];
	
	$dados = array(
			"fabricante"       => $txt_fabricante,
			"ativo_fabricante" => $txt_ativo
	);
	$op = false;
	$url_sucesso = URL_ADMIN ."index.php?link=6";
	$url_erro = URL_ADMIN ."index.php?link=7";
	
	if($acao=="Cadastrar")
			$op = inserir("fabricante", $dados);
	elseif($acao=="Alterar")
			$op = alterar("fabricante", $dados, "id_fabricante = $id");
	elseif($acao=="Excluir")
			$op = deletar("fabricante", "id_fabricante = $id");
	
	
	if ($op)
		print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_sucesso'>
					<script type = 'text/javascript'> alert('Operação realizada com sucesso') </script>";
	else
		print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_erro'>
					<script type = 'text/javascript'> alert('Operação não foi realizada') </script>";