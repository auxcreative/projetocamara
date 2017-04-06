$(document).ready(function(){
	$("#tabelagerente").dataTable({
		"language":{
			"sSearch": "Pesquisar:",
			"sInfo":"_START_ a _END_ de _TOTAL_",
			"paginate": {
        	"previous": "<a class='btn btn-default' href='#' role='button'><span class='glyphicon glyphicon-arrow-left'></span></a>  ",
        	"sNext": "  <a class='btn btn-default' href='#' role='button'><span class='glyphicon glyphicon-arrow-right'></span></a>",
        	"sFiltered": "A",
        	"lengthMenu": "Display _MENU_ records"        	
     },
      
		}, 
		
	});

});

