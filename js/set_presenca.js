function insert() {
	
	var botao = $(this);
	var statusM = botao.val();

	var url = $(this).closest('td.botoes').find('input[name="url"]').val();
	var local = $(this).closest('td.botoes').find('input[name="local"]').val();
	var idSessao = $(this).closest('td.botoes').find('input[name="id_sessao"]').val();
	var idVereador = $(this).closest('td.botoes').find('input[name="id_vereador"]').val();
	
	$.post(url, {
		"p#status" : statusM,
		"p#id_sessao" : idSessao,
		"p#id_vereador" : idVereador
	}, function(data, status) {
		
		if(status == 'success'){
			
		var btn = botao.closest('td.botoes').find('.btn');
				
			
			
		btn.each(function(i){
			
			if(botao.val() == 1){//Quando clicar no botão de presente								
			if(btn.eq(i).hasClass('btn-default')){		
			   //Botao presente			
			   btn.eq(0).removeClass('btn-default').addClass('btn-success'); 
			   	//Botao faltou
			   	btn.eq(1).removeClass('btn-danger').addClass('btn-default');
			}
			}
			
			if(botao.val() == 2){//Quando clicar no botão de falta
												
			if(btn.eq(i).hasClass('btn-default')){		
			   //Botao presente			
			   btn.eq(1).removeClass('btn-default').addClass('btn-danger'); 
			   	//Botao faltou
			   	btn.eq(0).removeClass('btn-success').addClass('btn-default');
			   	
			}
			}
					
				});
				
									
				
			
			
		} else {
			alert('Não foi possível marcar a presença!');
		}

	}, "html"); 
};

function iniciaCode() {

	$('.btn').on('click', (insert));
};

$(iniciaCode);
