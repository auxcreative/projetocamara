<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Home extends CI_Controller {

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
	public function index($cod=0) {

		$Agenda = array(
                "distinct" => null,
	            "select" => "agenda.*, evento.id as eventos_id, evento.nome as nome_evento",
	            "table" => "agenda",
	            "where" => "",
	            "where_not_in"=>null,
	            "order_by" => "data desc",
	            "like" => "",
	            "limit" => array(3,0),
	            "group_by" => "",
	            "join" => array("evento"=>'evento.id=agenda.id_evento')
        	);

		$notciasSlide = array(
                "distinct" => null,
	            "select" => "noticias.*, banco_de_imagem.url",
	            "table" => "noticias",
	            "where" => "",
	            "where_not_in"=>null,
	            "order_by" => "id desc",
	            "like" => "",
	            "limit" => array(3,0),
	            "group_by" => "",
	            "join" => array("banco_de_imagem"=>'banco_de_imagem.code=noticias.code')
        	);

		$noticiasMais = array(
                "distinct" => null,
	            "select" => "*",
	            "table" => "noticias",
	            "where" => array('status'=>'p'),
	            "where_not_in"=>null,
	            "order_by" => "data_postagem desc",
	            "like" => "",
	            "limit" => array(2,0),
	            "group_by" => "",
	            "join" => ""
        	);

		$parametrosItem = array(
						"distinct"=>NULL,
			            "select" => "*",
			            "table" => "vereador",
			            "where" => array('status'=>'A'),
			            "where_not_in"=>null,
			            "order_by" => "",
			            "like" => array('legislatura'=>date('Y')),
			            "limit" => "",
			            "group_by" => "",
			            "join" => ""
			        );

		$parametrosVereador = array(
						"distinct"=>NULL,
			            "select" => "*",
			            "table" => "vereador",
			            "where" => array('status'=>'A','id'=>decodificarString($cod)),
			            "where_not_in"=>null,
			            "order_by" => "",
			            "like" => array('legislatura'=>date('Y')),
			            "limit" => "",
			            "group_by" => "",
			            "join" => ""
			        );

					//Obem matriz com os dados
		$dados['vereador'] = getItem($parametrosItem)->result();
		$dados['vereadorLinha'] = getItem($parametrosVereador)->row();
		$dados['agenda'] = getItem($Agenda)->result();
		$dados['noticiasmais'] = getItem($noticiasMais)->result();
		$dados['noticia'] = getItem($notciasSlide)->result();


		set_tema('conteudo', load_modulo_site('view_inicio',$dados));
		//set_tema('footerinc', load_js(array('loadPageDevoloper')), FALSE);
		load_template();
	}






}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
