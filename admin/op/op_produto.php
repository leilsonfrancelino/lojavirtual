<?php
	require_once '../../include/config.php';
	require_once '../../include/crud.php';
	
	$id = $_POST["id"];
	$acao = $_POST["acao"];
	
		
	$dados = array(
			"id_categoria"      => trim($_POST["txt_id_categoria"]),
			"id_subcategoria"   => trim($_POST["txt_id_subcategoria"]),
			"id_fabricante"     => trim($_POST["txt_id_fabricante"]),
			"produto"           => trim($_POST["txt_produto"]),
			"ativo_produto"     => trim($_POST["txt_ativo"]),			
			"imagem"            => trim($_POST["txt_imagem"]),
			"preco_alto"        => trim($_POST["txt_preco_alto"]),
			"preco"             => trim($_POST["txt_preco"]),
			"descricao"         => trim($_POST["txt_descricao"]),
			"detalhes"          => trim($_POST["txt_detalhes"]),
			"destaque"          => trim($_POST["txt_destaque"]),
	);
	
	
	$op = false;
	$url_sucesso = URL_ADMIN ."index.php?link=8";
	$url_erro = URL_ADMIN ."index.php?link=9";
	
	if($acao=="Cadastrar")
			$op = inserir("produto", $dados);
	elseif($acao=="Alterar")
			$op = alterar("produto", $dados, "id_produto = $id");
	elseif($acao=="Excluir")
			$op = deletar("produto", "id_produto = $id");
	
	
	if ($op)
		print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_sucesso'>
					<script type = 'text/javascript'> alert('Operação realizada com sucesso') </script>";
	else
		print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_erro'>
					<script type = 'text/javascript'> alert('Operação não foi realizada') </script>";