<?php defined('BASEPATH') OR exit('No direct script access allowed');

//carrega um modulo do sistema a tela solicitada painel
    function load_modulo_sistema($modulo=NULL, $tela=NULL, $diretorio='sistema'){
	$CI = &get_instance();
	if ($modulo != NULL) :
		return $CI -> load -> view("$diretorio/$modulo", $tela, TRUE);
	else :
		return FALSE;
	endif;
}

//carrega um modulo do sistema a tela solicitada painel
    function load_modulo_site($modulo=NULL, $tela=NULL, $diretorio='site'){
	$CI = &get_instance();
	if ($modulo != NULL) :

		return $CI -> load -> view("$diretorio/$modulo", $tela, TRUE);
	else :
		return FALSE;
	endif;
}

     //seta valores do array tema
     function set_tema($prop, $valor, $replace=TRUE){
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
    function get_tema(){

           $CI =& get_instance();
           $CI->load->library('sistema');
           return $CI->sistema->tema;
}
    //Inicializa o painel adm carregando os recursos necessários
//Inicializa o painel adm carregando os recursos necessários
function init_site() {
	$CI = &get_instance();
	$CI -> load -> library(array('sistema', 'session', 'form_validation', 'parser'));
	$CI -> load -> helper(array('form', 'url', 'array', 'text', 'html', 'date'));
	set_tema('titulo', 'X-ON');
	set_tema('rodape', '<p class="rodape">Câmara Municipal de Coelho Neto - MA; 2017</p>');
	set_tema('template', 'site_view');
	set_tema('headerinc', load_css(array('bootstrap.min', 'font-awesome/css/font-awesome', 'app')), FALSE);
	set_tema('footerinc', load_js(array('jquery.min','bootstrap.min')), FALSE);
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
    function load_template(){
        $CI =& get_instance();
        $CI->load->library('sistema');
        $CI->parser->parse($CI->sistema->tema['template'], get_tema());
               
    }

//gera os breadcrumb com base no controller tual
function breadcrumb(){
    $CI =& get_instance();
    $CI->load->helper('url');
    
    $classe = ucfirst($CI->router->class);
    
    if($classe=='pricipal'):
        $classe = anchor($CI->router->class, $classe);
    else:
        $classe = anchor($CI->router->class, $classe);
    endif;
    
    $metodo = ucfirst(str_replace('_', ' ', $CI->router->method));
	
    if ($metodo == 'Index'):
	
        $metodo = anchor($CI->router->class."/inicio",'inicio');
    else: 
        $metodo = anchor($CI->router->class.'/'.$metodo,$metodo);
    endif;
	
    return '<ol class="breadcrumb">'.
    			'<li>'.anchor(base_url('principal'),'Principal').'</li>'.
    			'<li>'.$classe.'</li>'.
    			'<li class="active">'.$metodo.'</li>'.
    			'</ol>';
    
}

    //carrega os arquivos css
    
    function load_css($arquivo=NULL, $pasta='css', $media='all'){
        if ($arquivo != NULL):
            $CI =& get_instance();
            $CI->load->helper('url');
            $retorno = '';
        if (is_array($arquivo)):
        foreach ($arquivo as $css):
        $retorno .= '<link rel="stylesheet" type="text/css" href="'.base_url("$pasta/$css.css").'" media="'.$media.'" />';
        endforeach;
            else:
        $retorno = '<link rel="stylesheet" type="text/css" href="'.base_url("$pasta/$arquivo.css").'" media="'.$media.'" />';        
            endif;
        endif;
        return $retorno;
}

    //carrega um ou vários .js de uma pasta ou servidor
    function load_js($arquivo=NULL, $pasta='js', $remoto=FALSE){
         if ($arquivo != NULL):
            $CI =& get_instance();
            $CI->load->helper('url');
            $retorno = '';
            if (is_array($arquivo)):
                foreach ($arquivo as $js):
             if($remoto):
                  $retorno .= '<script type="text/javascript" src="'.$js.'"></script>';
             else:
                  $retorno .= '<script type="text/javascript" src="'.base_url("$pasta/$js.js").'"></script>';        
            endif;
            endforeach;
        else:
             if($remoto):
                  $retorno .= '<script type="text/javascript" src="'.$arquivo.'"></script>';
             else:
                  $retorno .= '<script type="text/javascript" src="'.base_url("$pasta/$arquivo.js").'"></script>';        
            endif;
          endif;
        endif;
        return $retorno;
       
    }

    
    //Mostra errosde validação
    function erros_validacao($name=NULL){
        
    if(validation_errors()) echo form_error($name,'<small class="error erro-ci">','</small>');   
       
    }

//Verificar se usuário está logado no sistema
function esta_logado($redir = TRUE) {
	$CI = &get_instance();
	$CI -> load -> library('session');
	$status = $CI -> session -> userdata('user_logado');

	if (!isset($status) || $status != TRUE) :
		if ($redir) :
			set_msg('errologado', '<b>Faça seu login</b>', 'info');
			redirect('welcome/logoff');
		else :
			return FALSE;
		endif;
	else :
		return TRUE;
	endif;
}

//seta um registro para auditoria
function auditoria($operacao, $obs, $query = TRUE) {
	$CI = &get_instance();
	$CI -> load -> library('session');
	$CI -> load -> model('usuarios_model', 'usuarios');
	$CI -> load -> model('auditoria_model', 'auditoria');
	
	
	if (esta_logado(FALSE)) :
		$user_id = $CI -> session -> userdata('user_id');
		$user_login = $CI->usuarios->get_byid($user_id)->row()->login;
	else :
		$user_login = 'Desconhecido';
	endif;
	if ($query) :
		$last_query = $CI->db->last_query();
	else :
		$last_query = '';
	endif;

	$dados = array('usuario' => $user_login, 'operacao'=>$operacao, 'query' => $last_query, 'obs' => $obs);
	$CI->auditoria->do_insert($dados);
}


//Define mensagem das telas
function set_msg($id = 'msgerro', $msg = NULL, $tipo = '') {
	$CI = &get_instance();

	$CI -> session -> set_flashdata($id, '<div class="alert alert-' . $tipo . ' alert-dismissible" role="alert">'.
	'<button type="button" class="close" data-dismiss="alert" arial-label="Close"><span arial-hidden="true">&times;
	<span></button>'.$msg.'</div>');

}
    
//verifica se existe uma mensagem para ser exibida na tela
function get_msg($id, $printar=TRUE){
	$CI =& get_instance();
    if ($CI->session->flashdata($id)):
        if($printar):
            echo $CI->session->flashdata($id);
            return TRUE;
        else:
            return $CI->session->flashdata($id);
        endif;
   endif;
   return FALSE;
}


//Retorna a validação de erro do foundation.abide
function load_small($nome=NULL,$id=''){
    
    if($nome != ''):
    echo form_error($nome,'<span id="'.$id.'" class="help-block">','</span>');
    else:
    return '<small class="error">Este campo deve ser preenchido</small>'; 
    endif; 
}

//ajusta data para ser salva no banco de dados
function load_data($data=NULL){
		if($data != NULL):
		$dia = substr($data,0,2);
		$mes = substr($data,3,2);
		$ano = substr($data,6,4);
		
		$retorno = $ano."-".$mes."-".$dia;
				return $retorno;
	
		else:
		return NULL;
		
		endif;
}

//Arruma a data para ser visualizada
function arruma_data($data=NULL){
		if($data != NULL):
		$dia = substr($data,8,2);
		$mes = substr($data,5,2);
		$ano = substr($data,0,4);
		
		$retorno = $dia."/".$mes."/".$ano;
				return $retorno;
	
		else:
		return NULL;
	endif;
}

function arruma_hora($hora=NULL){
		if($hora != NULL):
                    //00:00
                    //01 34
		$_hora = substr($hora, 0, 2);
                $_minuto = substr($hora, 3, 2);
                
		return $_hora.':'.$_minuto;
	
		else:
		return NULL;
	endif;
}

function get_documento($Cliente, $id_empresa){
	
	$CI =& get_instance();
	
	$query = $CI->db->query("select distinct numero_documento from myc_conta where id_empresa ='$id_empresa'");
	
		
	if($query->num_rows() == 0){		
		return str_pad(1, 8, "0", STR_PAD_LEFT).date('y').'/'.$Cliente;
	} else {
		return str_pad($query->num_rows()+1, 8, "0", STR_PAD_LEFT).date('y').'/'.$Cliente;
	}
}

function calcula_juros($id_empresa=NULL,$subtotal=0,$atrazo=0){
			
	$CI =& get_instance();
	$CI->load->model('conta_model','conta');
	
	if($id_empresa != NULL){
				
		$juro = $CI->conta->get_juros($id_empresa)->row();
		
		$taxaPorDia = ($juro->taxa_juro) / 30;
		$retorno = $subtotal * $taxaPorDia * $atrazo;
				
		return $retorno;
		
	}	
}

function get_num_venda(){
	
	$CI =& get_instance();
	$CI->load->model('checkout_model','checkout');
	
	$cod = $CI->checkout->get_byNumCupon($CI->session->userdata('user_id_empresa'));
	
	if($cod->num_rows() == 0){
		return 1;
	} else {	
	return $cod->num_rows()+1;
	}
	
	
}
		
function calcula_atrazo($data1=NULL, $data2=NULL){		

	$data1 = date_create($data1);
	$data2 = date_create($data2);
	
	$dias = date_diff($data1, $data2);
	
	if($dias->format("%R%a") <= 0){
		
		return 0;		
	} else {
	
	return str_replace('+','',$dias->format("%R%a"));	
	}	
}

function calcula_desconto($total=NULL){
	
	$CI =& get_instance();
	
	$desconto = $CI -> db -> get_where('configuracoes',array('id_empresa' => $CI -> session -> userdata('user_id_empresa'))) -> row();	
	
	$max = $desconto->taxa_desconto * $total;
	
	return $max;
	
	
}
