<?php 
	session_start();	
	//unset($_SESSION["LJCLIENTE"]);
	require("include/config.php");
	require("include/crud.php");
	require("include/biblio.php");
	if($_GET["venda"]=="s")
		$url_sucesso = URL_BASE ."pagamento";
	else
		$url_sucesso = URL_BASE ."index";
	
	$url_erro = URL_BASE ."cadastro";
	

	$nome = strip_tags((filter_input(INPUT_POST, "txt_cliente")));
	$email = strip_tags((filter_input(INPUT_POST, "txt_email")));
	
	$data = date ("Y-m-d");
	
	
		
	$dados = array(
			"cliente"           => trim(strip_tags((filter_input(INPUT_POST,"txt_cliente")))),
			"endereco"          => trim(strip_tags((filter_input(INPUT_POST,"txt_endereco")))),
			"bairro"            => trim(strip_tags((filter_input(INPUT_POST,"txt_bairro")))),
			"cep"               => trim(strip_tags((filter_input(INPUT_POST,"txt_cep")))),
			"cidade"            => trim(strip_tags((filter_input(INPUT_POST,"txt_cidade")))),			
			"fone"              => trim(strip_tags((filter_input(INPUT_POST,"txt_fone")))),
			"uf"                => trim(strip_tags((filter_input(INPUT_POST,"txt_uf")))),
			"email"             => trim(strip_tags((filter_input(INPUT_POST,"txt_email")))),
			"senha"             => trim(strip_tags((filter_input(INPUT_POST,"txt_senha")))),
			"ativo_cliente"     => "S",
			"data_cadastro"     => $data
	);
	
if(($nome!="") && ($email!="")) {				
			$cliente = selecionar ("SELECT * FROM cliente WHERE email = '$email'");	
			
			if($cliente) {				
				print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_erro'>
		               <script type = 'text/javascript'> alert ('Email já existe') </script>";
			}else{
				inserir("cliente", $dados);
				$cliente = consultar("cliente", "email = '$email'");
				foreach ($cliente as $c)
					$_SESSION["LJCLIENTE"] = $c;
						print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_sucesso'>
								<script type = 'text/javascript'> alert ('Operação realizada com sucesso') </script>";
			}
		
	}else{
		print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_erro'>
		               <script type = 'text/javascript'> alert ('Nome e usuário são obrigatórios') </script>";
			
	}
	
	
					
?>