/**
 * @author Elesbao Pinto, Guilherme Daniel
 * 
 */

//tempo em milisegundos 1000 = 1 segundo
var	tempoSegundo = 25000;

function loadPage(){
	//Faz um reload na página corrente
	location.reload();
};

function startCode(){
	
//Faz um reload na página no tempo epecificado na variável de tempoSegundo
setTimeout(loadPage, tempoSegundo);	
}

// Chama a função somente após a página ser carregada
$(startCode);