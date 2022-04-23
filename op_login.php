<?php 
	session_start();	
	//unset($_SESSION["LJCLIENTE"]);
	require("include/config.php");
	require("include/crud.php");
	require("include/biblio.php");
	$url_sucesso = URL_BASE."index";
	$url_erro = URL_BASE."nao-logado";
	

	$email = strip_tags((filter_input(INPUT_POST, "tx_email")));
	$senha = strip_tags((filter_input(INPUT_POST, "tx_senha")));
	
	$data = date ("Y-m-d");	
		
		
	if(($senha) && ($email)) {
		$cliente = consultar("cliente", "email = '$email' and senha = '$senha'");

				
		if($cliente) {
			foreach ($cliente as $c)
			$_SESSION["LJCLIENTE"] = $c;
			echo "<script languague='javaScript'> window.location='$url_sucesso'</script>";
		}elseif (($senha!="senha") && ($email!="email")) {
				print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_erro'>
				 <script type = 'text/javascript'> alert ('Usuário ou senha inválidos') </script>";
		}else{
				print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_erro'>
				 <script type = 'text/javascript'> alert ('Usuário não localizado') </script>";
			}
	
	}
					
?>