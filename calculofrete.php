<?php
	$valores = array();
	$valores["nCdEmpresa"] = "" ;
	$valores["sDsSenha"] = "";
	$valores["nCdServico"] = $_POST["tipo"];
	$valores["sCepOrigem"] = "70002900";
	$valores["sCepDestino"] = $_POST["cep"];
	$valores["nVlPeso"] = "1";
	$valores["nCdFormato"] = "1";
	$valores["nVlComprimento"] = "30";
	$valores["nVlAltura"] = "30";
	$valores["nVlLargura"] = "30";
	$valores["nVlDiametro"] = "0";
	$valores["sCdMaoPropria"] = "n";
	$valores["nVlValorDeclaracao"] = "0";
	$valores["sCdAvisoRecebimento"] = "n";
	$valores["StrRetorno"] = "xml";

	$valores = http_build_query($valores);
	$url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx";
	$curl = curl_init($url."?".$valores);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	$retorno = curl_exec($curl);
	$retorno = simplexml_load_string($retorno);
	
	foreach ($retorno as $resultado) {
		if ($resultado->Erro == 0)
			echo $resultado->Valor;
		else
			echo $resultado->MsgErro;
	}
		

?>