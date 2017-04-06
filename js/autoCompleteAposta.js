/**
 * @author Elesbao
 */

var valorReal = function(tamanho, valor, tipo) {

	//Para o tipo é positivo
	if (tipo == 1) {

		switch(tamanho) {

		case 4:
		case 5:
		case 6:

			//R$ 0,00 a 999,99
			return valor.replace('.', ',');
			break;

		case 7:
			//R$ 1.000,00 a 9.999,99
			var debitoMilhar = valor.toString().slice(0, 1);
			var debitoCentena = valor.toString().slice(-6);

			return debitoMilhar + '.' + debitoCentena.replace('.', ',');
			;
			break;

		case 8:
			//R$ 10.000,00 a 99.999,99
			var debitoMilhar = valor.toString().slice(0, 2);
			var debitoCentena = valor.toString().slice(-6);

			return debitoMilhar + '.' + debitoCentena.replace('.', ',');
			;
			break;

		case 9:
			//R$ 100.000,00 a 999.999,99
			var debitoMilhar = valor.toString().slice(0, 3);
			var debitoCentena = valor.toString().slice(-6);

			return debitoMilhar + '.' + debitoCentena.replace('.', ',');
			;
			break;

		case 10:
			//R$ 1.000.000,00 a 9.999.999,99
			var debitoMilhao = valor.toString().slice(0, 1);
			var debitoMilhar = valor.toString().slice(0, 4);
			var debitoCentena = valor.toString().slice(-6);

			return debitoMilhao + '.' + debitoMilhar + '.' + debitoCentena.replace('.', ',');
			;
			break;

		default:
			'Algum Erro';
			break;
		}

		//Para o tipo Negativo
	} else {

		//Troca o ponto por virgula

		switch(tamanho) {

		case 5:
		case 6:
		case 7:
			//R$ -0,00 a -999,99

			return valor.replace('.', ',');
			break;

		case 8:
			//R$ -1.000,00 a -9.999,99
			var debitoMilhar = valor.toString().slice(0, 2);
			var debitoCentena = valor.toString().slice(-6);

			return debitoMilhar + '.' + debitoCentena.replace('.', ',');
			;
			break;

		case 9:
			//R$ -10000,00 a -99.999,99
			var debitoMilhar = valor.toString().slice(0, 3);
			var debitoCentena = valor.toString().slice(-6);

			return debitoMilhar + '.' + debitoCentena.replace('.', ',');
			;
			break;

		case 10:
			//R$ -100000,00 a -999.999,99
			var debitoMilhar = valor.toString().slice(0, 4);
			var debitoCentena = valor.toString().slice(-6);

			return debitoMilhar + '.' + debitoCentena.replace('.', ',');
			;
			break;

		case 11:
			//R$ -1.000.000,00 a -9.999.999,99
			var debitoMilhao = valor.toString().slice(0, 2);
			var debitoMilhar = valor.toString().slice(0, 5);
			var debitoCentena = valor.toString().slice(-6);

			return debitoMilhao + '.' + debitoMilhar + '.' + debitoCentena.replace('.', ',');
			;
			break;

		}
	}

};

var retorno = function(numero) {

	if (numero >= 0) {
		return 1;
	} else {
		return 0;
	}
};

function calculaPremio(){
	
	var total = $('.cotacao-total').val();
	var cotacao = $('#cotacaoMin').val();
	var premioMax = $('#premioMax').val();
	
	var lance = $(this).val();
	var premio = parseFloat(total).toFixed(2) * parseFloat(lance).toFixed(2);
	
	


	//Se o valor da entrada for maior que o principal
	if (parseFloat(lance) < parseFloat(cotacao)) {
		$('#cotacao-lance').val(cotacao);
		$('.cotacao-premio').val(parseFloat(total)* parseFloat(cotacao).toFixed(2));
		alert('O valor mínimo de aposta é de R$ '+cotacao);
		//Retorna o resto a pagar
	} else {
		
	if(parseFloat(premio) > parseFloat(premioMax)){
		var totalPremio = parseFloat(total)* parseFloat(cotacao);
		$('#cotacao-lance').val(cotacao);
		$('.cotacao-nome').val('');
		$('.cotacao-premio').val(totalPremio.toFixed(2));
		alert('Diminua suas apostas de modo que o prêmio não\n ultrapasse o valor de R$ '+premioMax);
	} else {		
		$('.cotacao-premio').val(parseFloat(premio).toFixed(2));	
		$('.botao-fim').show();
	}
		
		
	}	
		
};

function mostraJogo(){
//Tras os produtos
$.getJSON('http://boladanogol.com.br/principal/get_jogos', function(data) {
	
	var option = new Array;

	$(data).each(function(i, obj) {
		option[i] = obj.id + ' - '+ obj.prefixo +' '+ obj.data +' '+ obj.hora + ' - '+ obj.casa+' (X) ' + obj.fora;
	});

	$('#buscar').autocomplete({
		source : option
	});
});
};

function showJogos() {

	var item = $('#buscar').val().split(' - ');
	var id = item[0];


		$.getJSON('http://boladanogol.com.br/principal/get_cotacao/'+id, function(data, status) {

			if(status === 'success'){						
				location.replace('http://boladanogol.com.br/principal');
			} else {				
				alert('Não foi possível se comunicar com\n o banco de dados de eventos');
			}
			});

};


function comecarCodigo(){
	
	$(window).load(calculaPremio);
	
	$(mostraJogo);
	
	$('#buscar').on('dblclick', function(){
		$(this).val('');
	});
	
	$('#buscar').on('keypress', function(event) {		
		if (event.which == 13) {
			if ($('#buscar').val() != '') {
				$(showJogos);
			} else {
				alert('Escolha um jogo para aposar!');
			};
		};
	});	
		
	
	$('#cotacao-lance').on('blur',(calculaPremio));
	
	
}

$(comecarCodigo);

