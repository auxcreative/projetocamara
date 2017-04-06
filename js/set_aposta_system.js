/**
 * @author Elesbao
 */

function marca_aposta() {
	//recebe os dados para inserir no carrinho
	var colunaBotoes = $(this).closest('div.acoes').contents('.btn-cotacao');
	var botaoClicado = $(this);
	
	
	var cotacao = botaoClicado.text();	
	var idConfronto = $('input[name="idconfronto"]').val();
	var times = $('p#label').text().split(' - ');
	var confronto = times[2];
	var hora = times[1];
	
	//seleciona os dados da cotacao e id apostado
	if(botaoClicado.index() == 0){
	var idApostado = $('input[name="idcasa"]').val();
	var aposta = 'C';
	} else if (botaoClicado.index() == 1){
	var idApostado = 0;
	var aposta = 'E';
	} else if (botaoClicado.index() == 2) {
	var idApostado = $('input[name="idfora"]').val();
	var aposta = 'F';	
	}
	
		//Acrescenta sucesso e retira a classe secondary
	if (botaoClicado.hasClass('secondary')) {
		botaoClicado.removeClass('secondary').addClass('success');
		//Recebe dados
	$.post('http://boladanogol.com.br/principal/insere_jogo', {
			id : idConfronto,
			qty : 1,
			name : aposta,
			price : cotacao,
			id_apostado : idApostado,
			times : confronto,
			hora : hora			
		}, function(data, status){			
			//alert(idConfronto+'\n'+cotacao+'\n'+idApostado+'\n'+aposta+'\n'+times);
			location.replace('http://boladanogol.com.br/principal');			
		},'html');

		colunaBotoes.each(function(i) {
			if (i != botaoClicado.index()) {
				if (colunaBotoes.eq(i).hasClass('success')) {
					colunaBotoes.eq(i).removeClass('success').addClass('secondary');
				}
			}
		});

	} else {

		botaoClicado.removeClass('success').addClass('secondary');

		colunaBotoes.each(function(i) {
			
			if (i != botaoClicado.index()) {				
				if (colunaBotoes.eq(i).hasClass('success') == true) {
					colunaBotoes.eq(i).removeClass('success').addClass('secondary');
					//location.replace('http://boladanogol.com.br/principal/get_limpa');
				}
			}
		});
	}

};

function pagamento(){
	
	var code = $('#code').val();
	
	$.post('http://boladanogol.com.br/principal/salva_aposta', {
		code : code
	}, function(data, status){
		if(status == 'success'){
			location.replace('http://boladanogol.com.br/principal/get_limpa');
		} else {
			alert('Erro ao salvar');
		}
	},'html');
	
	
};

function init_code() {
	$('.btn-cotacao').on('click', (marca_aposta));
	$('#pay').on('click',(pagamento));
}

$(init_code);
