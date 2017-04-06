function retorno(numero) {

	if (numero >= 0) {
		return 1;
		//Positivo
	} else {
		return 0;
		//Negativo
	}
};
function mostraTroco() {

	var pago = $(this).val().replace('R$ ', '').replace('.', '').replace(',', '.');
	var subtotal = $('#subtotal').val().replace('R$ ', '').replace('.', '').replace(',', '.');
	var troco = $('#troco');

	var valorTroco = parseFloat(pago) - parseFloat(subtotal);

	//Escreve o valor do troco
	troco.val('R$ ' + valorTroco.toFixed(2).replace('.', ','));

	if (retorno(valorTroco) == 1) {
		troco.removeClass('negativo');
		troco.addClass('positivo');
	} else {
		troco.removeClass('positivo');
		troco.addClass('negativo');

	}

};

function formadePagamento() {

	var valPay = $('input[name="id_forma_de_pagamento"]:checked').val();
	var subTotal = $('input[name="subtotal"]').val();
	if (valPay > 1) {
		$('.troco').hide(500);
		$('#pago').val(subTotal);
		$('#troco').val('R$ 0,00');
	} else {
		$('.troco').show(500);
		$('#pago').val('R$ 0,00');
		$('#troco').val('R$ 0,00');
		$('#troco').removeClass('positivo');
		$('#troco').removeClass('negativo');
	}
}

function validacao() {

	var subtotal = $('#subtotal').val().replace('R$ ', '').replace('.', '').replace(',', '.');
	var pago = $('#pago').val().replace('R$ ', '').replace('.', '').replace(',', '.');

	if (confirm("DESEJA REALMENTE FECHAR ESTE CUPOM?\nESSAA OPERAÇÃO NÃO PODERÁ SER MAIS DESFEITA!")) {

		if (parseFloat(subtotal) == 0.00) {
			alert('O VALOR RECEBIDO NÃO PODE SER ZERO');
			return false;
		} else {
			if (parseFloat(pago) < parseFloat(subtotal)) {

				alert('O VALOR RECEBIDO É MENOR DO QUE O TOTAL DO CUMPOM');
				return false;

			} else {
				return true;
			}
		}
	} else {
		return false;
	}
};

function cancela_venda() {

	if (confirm("PARA CANCELAMENTO DESTE CUPOM\nCLIQUE NO BOTÃO OK")) {
		location.replace('http://localhost/xbar/checkout/zera_carrinho');
	} else {
		return false;
	}

};

function comecarCodigo() {

	$('.formaPagamento').on('click', (formadePagamento));
	$('#pago').on('keyup', (mostraTroco));
	$('.pay').on('click', (validacao));
	$('.cancel').on('click', (cancela_venda));

	$('.btn-block').on('click', function() {
		$('#pago').val('R$ 0,00');
		$('#troco').val('R$ 0,00');
		$('#troco').removeClass('positivo');
		$('#troco').removeClass('negativo');
	});

}

$(comecarCodigo);

