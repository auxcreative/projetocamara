
function loadData(){
	
	$('.data').on('change',function() {
		
		var data = $(this).val();
		
		location.replace('http://boladanogol.com.br/principal/gerenciar/'+data);		
		
	});
	
};

$(loadData);
