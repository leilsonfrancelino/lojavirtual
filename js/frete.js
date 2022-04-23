$(function(){
	valor = parseFloat($("#valorcompra").text());
	console.log(valor);
	$("#btnfrete").click(function() {
		var cep = $("#cep").val();
		var tipoServico = $("#tipoServico").val();
		$.ajax({
			url: "calculofrete.php",
			type: "post",
			data: {cep:cep, tipo:tipoServico},
			success: function(data) {
				soma = realParaNumero(data) + valor;
				$("#valorfrete").html(data);
				$("#valortotal").html(numeroParaReal(soma));
			}
		})
	})
});	

function numeroParaReal(num) {
	return "R$ " + num.toFixed(2) .replace(".",",");
}

function realParaNumero(num) {
	return parseFloat(num.replace("R$ ","") .replace(",","."));
}