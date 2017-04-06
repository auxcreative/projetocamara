function carregaload() {

	var divCotacao = $('#cotacao');
	var botao = $("#checkbox1");

	if (botao.is(':checked') == true) {
		divCotacao.hide();		
		$('.formato').val('0,00');		
	} else {
		divCotacao.show();
	}	
};

function chamaCotacao() {

	var divCotacao = $('#cotacao');
	var botao = $(this);

	if (botao.is(':checked') == true) {
		divCotacao.hide(250);
		$('.formato').val('0,00');
	} else {
		divCotacao.show(500);
	}
	
};

function comecarCodigo() {
	$('#checkbox1').on('click', (chamaCotacao));
	$(window).load(carregaload);

}

$(comecarCodigo);
