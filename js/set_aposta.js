/**
 * @author Elesbao
 */

function marca_aposta() {

	var colunaBotoes = $(this).closest('.acoes div').contents('.btn-cotacao');
	var botaoClicado = $(this);
	
	var idItem = $(this).closest('.acoes').find('input:hidden.id').val();
	var cotacao = botaoClicado.text();	
	
	//
	if(botaoClicado.index() == 0){
	var idApostado = $(this).closest('.acoes').find('input:hidden.casa').val();
	} else if (botaoClicado.index() == 1){
	var idApostado = 0;
	} else if (botaoClicado.index() == 2) {
	var idApostado = $(this).closest('.acoes').find('input:hidden.fora').val();	
	}
	
	
		//Acrescenta sucesso e retira a classe secondary
	if (botaoClicado.hasClass('secondary')) {
		botaoClicado.removeClass('secondary').addClass('success');
		//Recebe dados
	$.post('http://boladanogol.com.br/tabelas/insere_jogo', {
			id : idItem,
			qty : 1,
			name : 'jogo',
			price : cotacao,
			id_apostado : idApostado			
		}, function(data, status){			
			alert(idItem+'\n'+cotacao+'\n'+idApostado);			
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
		//Recebe dados
	$.post('http://boladanogol.com.br/tabelas/insere_jogo', {
			id : idItem,
			qty : 0,
			name : 'jogo',
			price : cotacao,
			id_apostado : idApostado			
		}, function(data, status){			
			alert(idItem+'\n'+cotacao+'\n'+idApostado);			
		},'html');
		colunaBotoes.each(function(i) {
			if (i != botaoClicado.index()) {

				if (colunaBotoes.eq(i).hasClass('success') == true) {

					colunaBotoes.eq(i).removeClass('success').addClass('secondary');
				}
			}
		});
	}

};

function init_code() {
	$('.btn-cotacao').on('click', (marca_aposta));
}

$(init_code);
