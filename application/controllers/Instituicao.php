<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Instituicao extends CI_Controller {

	public function __construct() {
		parent::__construct();
		init_site();
		//$this -> load -> model('produto_model', 'produto');

	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		
		redirect(base_url());
	}

	public function presidencia_da_camara() {
		
		
		$mesaDiretora = array(
                "distinct" => null,
	            "select" => "*",
	            "table" => "mesa_diretora",
	            "where" => array('mesa_diretora.status' => 'a','funcao'=>'Presidente'),
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => array("vereador"=>'vereador.id=mesa_diretora.id_vereador')
        	);
			
		$dados['mesa'] = getItem($mesaDiretora)->row(); 
				
		
		set_tema('conteudo', load_modulo_site('view_presidencia', $dados), FALSE);
		//set_tema('footerinc', load_js(array('loadPageDevoloper')), FALSE);
		load_template();
	}
	
		public function centro_de_memoria() {		
		
		set_tema('conteudo', load_modulo_site('view_memoria'));
		//set_tema('footerinc', load_js(array('loadPageDevoloper')), FALSE);
		load_template();
	}
		
		public function mesa_diretora() {		
		
		set_tema('conteudo', load_modulo_site('view_mesa_diretora'));
		//set_tema('footerinc', load_js(array('loadPageDevoloper')), FALSE);
		load_template();
		
	}

		public function regimento_interno() {
				
		set_tema('conteudo', load_modulo_site('view_regimento_interno'));
		//set_tema('footerinc', load_js(array('loadPageDevoloper')), FALSE);
		load_template();
	}
		
		public function ordem_do_dia() {
			
		$ordemID = array(
                "distinct" => null,
	            "select" => "*",
	            "table" => "evento",
	            "where" => "",
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => array("nome"=>"Ordem do Dia"),
	            "limit" => "1,0",
	            "group_by" => "",
	            "join" => ""
        	);
			
		$ordemID = getItem($ordemID)->row('id'); 
		
		$ordemList = array(
                "distinct" => null,
	            "select" => "*",
	            "table" => "agenda",
	            "where" => array('id_evento' => $ordemID,'data'=>date('Y-m-d'),'status'=>'A'),
	            "where_not_in"=>null,
	            "order_by" => "horaInicio asc",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
        	);
			
		$dados['ordem'] = getItem($ordemList)->result();			
				
		set_tema('conteudo', load_modulo_site('view_ordem_do_dia', $dados));
		//set_tema('footerinc', load_js(array('loadPageDevoloper')), FALSE);
		load_template();
	}

		public function download() {
			

        // recuperamos o terceiro segmento da url, que é o nome do arquivo
        $arquivo = $this->uri->segment(4);
        // recuperamos o segundo segmento da url, que é o diretório
        $diretorio = $this->uri->segment(3);
		
		if(!empty($arquivo)){
		
        // definimos original path do arquivo
        $arquivoPath = './uploads/'.$diretorio."/".$arquivo;
 
        // forçamos o download no browser 
        // passando como parâmetro o path original do arquivo
        force_download($arquivoPath,null);
		
		}

		
	}







}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
