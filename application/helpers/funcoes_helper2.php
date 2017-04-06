<?php defined('BASEPATH') OR exit('No direct script access allowed');

//carrega um modulo do sistema a tela solicitada painel
function load_modulo_site($modulo = NULL, $tela = NULL, $diretorio = 'site') {
	$CI = &get_instance();
	if ($modulo != NULL) :
		return $CI -> load -> view("$diretorio/$modulo", $tela, TRUE);
	else :
		return FALSE;
	endif;
}

//carrega um modulo do sistema a tela solicitada site
function load_modulo_main($modulo = NULL, $tela = NULL, $diretorio = 'main') {
	$CI = &get_instance();
	if ($modulo != NULL) :

		return $CI -> load -> view("$diretorio/$modulo", $tela, TRUE);
	else :
		return FALSE;
	endif;
}

//seta valores do array tema
function set_tema($prop, $valor, $replace = TRUE) {
	$CI = &get_instance();

	$CI -> load -> library('sistema');

	if ($replace) :
		$CI -> sistema -> tema[$prop] = $valor;
	else :
		if (!isset($CI -> sistema -> tema[$prop]))
			$CI -> sistema -> tema[$prop] = '';
		$CI -> sistema -> tema[$prop] .= $valor;
	endif;
}

//retorna os valores do array Tema da classe sistema
function get_tema() {

	$CI = &get_instance();
	$CI -> load -> library('sistema');
	return $CI -> sistema -> tema;
}

//Inicializa o painel adm carregando os recursos necessários
function init_site() {

	$CI = &get_instance();

	$CI -> load -> library(array('sistema', 'session', 'form_validation', 'parser'));
	$CI -> load -> helper(array('form', 'url', 'array', 'text', 'html', 'date'));

	set_tema('titulo', 'X-ON');

	set_tema('rodape', '<p class="rodape">X-ON &copy; 2016</p>');

	set_tema('template', 'site_view');
	set_tema('headerinc', load_css(array('bootstrap.min', 'font-awesome/css/font-awesome', 'app')), FALSE);
	set_tema('footerinc', load_js(array('bootstrap.min')), FALSE);
}

function init_main() {
	$CI = &get_instance();
	$CI -> load -> library(array('sistema', 'session', 'form_validation', 'parser'));
	$CI -> load -> helper(array('form', 'url', 'array', 'text', 'html', 'date'));

	set_tema('titulo', 'X-ON PAINEL ADM');

	set_tema('rodape', '<p class="rodape">X-ON &copy; 2016</p>');

	set_tema('template', 'main_view');
	set_tema('headerinc', load_css(array('ckeditor.samples','bootstrap.min','sb-admin','font-awesome/css/font-awesome', 'app','dataTables.bootstrap','dataTables.responsive')), FALSE);
	set_tema('footerinc', load_js(array('ckeditor','ckeditor.sample','jquery-1.11.min','bootstrap.min','jquery.dataTables','dataTables.bootstrap.min')), FALSE);
}

//carrega um template passando uma array tem como parametro
function load_template() {
	$CI = &get_instance();
	$CI -> load -> library('sistema');
	$CI -> parser -> parse($CI -> sistema -> tema['template'], get_tema());

}

//gera os breadcrumb com base no controller atual
function breadcrumb() {
	$CI = &get_instance();
	$CI -> load -> helper('url');
	$classe = ucfirst($CI -> router -> class);

	if ($classe == 'Principal') :
		$classe = anchor($CI -> router -> class, 'Atendimento');
	else :
		$classe = anchor($CI -> router -> class, $classe);
	endif;

	$metodo = ucfirst(str_replace('_', ' ', $CI -> router -> method));

	if ($metodo == 'Index') :
		$metodo = anchor($CI -> router -> class, $classe);
	else :
		$metodo = anchor($CI -> router -> class, $metodo);
	endif;

	if ($CI -> router -> class == 'principal') {
		return '<li>' . anchor('principal', 'Ínicio') . '</li>' . '<li><span class="show-for-sr">Current: </span>' . $classe;
	} else {
		return '<li>' . anchor('principal', 'Ínicio') . '</li>' . '<li class="disabled">' . $classe . '<li><span class="show-for-sr">Current: </span>' . $metodo . '</li>';
	}

}

//carrega os arquivos css

function load_css($arquivo = NULL, $pasta = 'css', $media = 'all') {
	if ($arquivo != NULL) :
		$CI = &get_instance();
		$CI -> load -> helper('url');
		$retorno = '';
		if (is_array($arquivo)) :
			foreach ($arquivo as $css) :
				$retorno .= '<link rel="stylesheet" type="text/css" href="' . base_url("$pasta/$css.css") . '" media="' . $media . '" />';
			endforeach;
		else :
			$retorno = '<link rel="stylesheet" type="text/css" href="' . base_url("$pasta/$arquivo.css") . '" media="' . $media . '" />';
		endif;
	endif;
	return $retorno;
}

//carrega um ou vários .js de uma pasta ou servidor
function load_js($arquivo = NULL, $pasta = 'js', $remoto = FALSE) {
	if ($arquivo != NULL) :
		$CI = &get_instance();
		$CI -> load -> helper('url');
		$retorno = '';
		if (is_array($arquivo)) :
			foreach ($arquivo as $js) :
				if ($remoto) :
					$retorno .= '<script type="text/javascript" src="' . $js . '"></script>';
				else :
					$retorno .= '<script type="text/javascript" src="' . base_url("$pasta/$js.js") . '"></script>';
				endif;
			endforeach;
		else :
			if ($remoto) :
				$retorno .= '<script type="text/javascript" src="' . $arquivo . '"></script>';
			else :
				$retorno .= '<script type="text/javascript" src="' . base_url("$pasta/$arquivo.js") . '"></script>';
			endif;
		endif;
	endif;
	return $retorno;

}

//Verificar se usuário está logado no sistema
function esta_logado($redir = TRUE) {

	$CI = &get_instance();

	$CI -> load -> library('session');

	$status = $CI -> session -> userdata('user_logado');

	if (!isset($status) || $status != TRUE) :

		if ($redir) :
			set_msg('errologado', '<b>Faça seu login</b>', 'alert');
			redirect('welcome/loggof');
		else :
			return FALSE;
		endif;
	else :
		return TRUE;
	endif;
}

//Verificar se usuário está logado no sistema

//seta um registro para auditoria
function auditoria($operacao, $obs, $query = TRUE) {
	$CI = &get_instance();
	$CI -> load -> library('session');
	$CI -> load -> model('usuarios_model', 'usuarios');
	$CI -> load -> model('auditoria_model', 'auditoria');

	if (esta_logado(FALSE)) :
		$user_id = $CI -> session -> userdata('user_id');
		$user_login = $CI -> usuarios -> get_byid($user_id) -> row();
	else :
		$user_login = 'Desconhecido';
	endif;
	if ($query) :
		$last_query = $CI -> db -> last_query();
	else :
		$last_query = '';
	endif;

	$dados = array('usuario' => $user_login -> login, 'operacao' => $operacao, 'query' => $last_query, 'obs' => $obs);

	$CI -> auditoria -> do_insert($dados);
}

//Define mensagem das telas
function set_msg($id = 'msgerro', $msg = NULL, $tipo = '') {
	$CI = &get_instance();

	$CI -> session -> set_flashdata($id, '<div class="callout ' . $tipo . '" data-closable>
  <p>' . $msg . '</p>
  <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
    <span aria-hidden="true">&times;</span>
  </button>
</div>');

}

//verifica se existe uma mensagem para ser exibida na tela
function get_msg($id, $printar = TRUE) {
	$CI = &get_instance();
	if ($CI -> session -> flashdata($id)) :
		if ($printar) :
			echo $CI -> session -> flashdata($id);
			return TRUE;
		else :
			echo $CI -> session -> flashdata($id);
		endif;
	endif;
	return FALSE;
}

//Mostra errosde validação
function erros_validacao($name = NULL) {

	if (validation_errors())
		echo form_error($name, '<div class="alert callout" data-closable> <p>', '</p>
  		<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
    	<span aria-hidden="true"></p>
  		<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
    	<span aria-hidden="true">
        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
        <span aria-hidden="true">&times;</span>
       </button>
      </div>');

}

//Retorna a validação de erro do foundation.abide
function load_small($texto = NULL) {

	if ($texto != '') :
		return '<small class="error">' . $texto . '</small>';
	else :
		return '<small class="error">Este campo deve ser preenchido</small>';
	endif;
}

//ajusta data para ser salva no banco de dados
function load_data_bd($data = NULL) {

	if ($data != NULL) :
		$dia = substr($data, 0, 2);
		$mes = substr($data, 3, 2);
		$ano = substr($data, 6, 4);

		$retorno = $ano . "-" . $mes . "-" . $dia;
		return $retorno;
	else :
		return NULL;

	endif;
}

//Traduz as datas
function gerar_DataExtenso($dsemana, $dia, $mes, $ano) {

	switch ($dsemana) {
		case '0' :
			$dsemana = 'Dom, ';
			break;
		case '1' :
			$dsemana = 'Seg, ';
			break;
		case '2' :
			$dsemana = 'Ter, ';
			break;
		case '3' :
			$dsemana = 'Qua, ';
			break;
		case '4' :
			$dsemana = 'Qui, ';
			break;
		case '5' :
			$dsemana = 'Sex, ';
			break;
		case '6' :
			$dsemana = 'Sáb, ';
			break;
	}

	switch ($mes) {
		case '01' :
			return $dsemana . $dia . ' de Janeiro ' . $ano;
			break;
		case '02' :
			return $dsemana . $dia . ' de Fevereiro ' . $ano;
			break;
		case '03' :
			return $dsemana . $dia . ' de Março ' . $ano;
			break;
		case '04' :
			return $dsemana . $dia . ' de Abril ' . $ano;
			break;
		case '05' :
			return $dsemana . $dia . ' de Maio ' . $ano;
			break;
		case '06' :
			return $dsemana . $dia . ' de Junho ' . $ano;
			break;
		case '07' :
			return $dsemana . $dia . ' de Julho ' . $ano;
			break;
		case '08' :
			return $dsemana . $dia . ' de Agosto ' . $ano;
			break;
		case '09' :
			return $dsemana . $dia . ' de Setembro ' . $ano;
			break;
		case '10' :
			return $dsemana . $dia . ' de Outubro ' . $ano;
			break;
		case '11' :
			return $dsemana . $dia . ' de Novembro ' . $ano;
			break;
		case '12' :
			return $dsemana . $dia . ' de Dezembro ' . $ano;
			break;

		default :
			return 'Data ívalida';
			break;
	}

}

//Arruma a data para ser visualizada 1982-07-15
function arruma_data($data = NULL) {
	if ($data != NULL) :
		$dia = substr($data, 8, 2);
		$mes = substr($data, 5, 2);
		$ano = substr($data, 0, 4);

		$retorno = $dia . "/" . $mes . "/" . $ano;
		return $retorno;
	else :
		return NULL;
	endif;
}

function isActive($pagina = null,$parametro = null) {
	if($pagina == $parametro){
		return "active";
	} else {
		return null;
	}
}

function retirarAcentos($string = null){
	if($string != null){
		
		$arrayString = str_split(utf8_decode($string));	//Gera array apartir da string com utf8 decodificado
		//A decodificação é necessária para que o número posicoes criadas
		// seja igual ao numero de caracteres da string (na UTF-8)
		 
		$tmp = array();
		foreach ($arrayString as $char) {
			$tmp[] = substituiCaractere(utf8_encode($char));
		}
		
		return implode($tmp);
	}
}

function substituiCaractere($char){
	
	$strMap = array('á' => 'a','à' => 'a','ã' => 'a','ä' => 'a',
					'Á' => 'a','À' => 'a','Ã' => 'a','Ä' => 'a',
				    'é' => 'e','è' => 'e','ê' => 'e',
				    'É' => 'e','È' => 'e','Ê' => 'e',
				    'ì' => 'i','í' => 'i',
				    'Ì' => 'i','Í' => 'i',						   
				    'ó' => 'o','ò' => 'o','ô' => 'o','õ' => 'o','ö' => 'o',
				    'Ó' => 'o','Ò' => 'o','Ô' => 'o','Õ' => 'o','Ö' => 'o',						   
				    'ú' => 'u','ù' => 'u','ũ' => 'u','ü' => 'u',
				    'Ú' => 'u','Ù' => 'u','Ũ' => 'u','Ü' => 'u',
				    'ç' => 'c','Ç' => 'c',						   
				    'ñ' => 'n','Ñ' => 'n',						   
				    ' ' => '-', '?' => '','%' => '-porcento','@'=>'','['=>'',
				    ']' => '', '!' => '','(' => '', ')' => ''
				   );
	
	foreach ($strMap as $keyMap => $valueMap) {
				if($char == $keyMap){
					return $valueMap;
				}
	}
	return $char;	
}



