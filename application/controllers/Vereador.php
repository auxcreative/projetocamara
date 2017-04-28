<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vereador extends CI_Controller {

    public function __construct(){
		parent::__construct();
		init_site();

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
	public function index()	{

		$this->dados_e_contatos();


	}

	public function dados_e_contatos($cod = null){

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

			set_tema('conteudo', load_modulo_site('view_vereador', $dados));
			load_template();

	}

	public function mesa_diretora($ano = null, $mes=null){


		if($ano == null){ //Select de todas tuplas

			$parametrosItem = array(
			    "distinct"=>TRUE,
	            "select" => "mes",
	            "table" => "transparencia",
	            "where" => array('ano'=>$ano),
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
	        );

			//Obem matriz com os dados
			$dadosItem = getItem($parametrosItem)->result();

			//carrega view com os dados buscados
			$dados['ano'] = $dadosItem;
			set_tema('conteudo', load_modulo_site('view_prestacao_de_contas_mesa_diretora', $dados));
			load_template();


		} else { //Select de tupla específica

			$parametrosAno = array(
				"distinct"=>true,
	            "select" => "ano",
	            "table" => "transparencia",
	            "where"=> array('ano'=>$ano),
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
        	);

			$parametrosMes = array( //Select com filtro especifico
				"distinct"=>true,
	            "select" => "mes, ano",
	            "table" => "xon_transparencia",
	            "where" => array('ano' => $ano),
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
        	);
			$parametrosContas = array( //Select com filtro especifico
				"distinct"=>false,
	            "select" => "*",
	            "table" => "transparencia",
	            "where" => array('ano' => $ano, 'mes'=>$mes),
	            "where_not_in"=>null,
	            "order_by" => "texto desc",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
        	);

		//Obem matriz com os dados
		$dados['mes'] = getItem($parametrosMes)->result();
		$dados['ano'] = getItem($parametrosAno)->result();
		$dados['prestacao'] = getItem($parametrosContas)->result();


		//carrega view com os dados buscados

		set_tema('conteudo', load_modulo_site('view_prestacao_de_contas_mesa_diretora', $dados));
		load_template();

		}

	}

	public function vereadores($cod = null, $id_vereador=null){
		$this->load->model('crud_model');

		if($cod == null && $id_vereador==null){ //Select de todas tuplas

		$parametrosItem = array(
				"distinct"=>TRUE,
	            "select" => "ano",
	            "table" => "transparencia",
	            "where_not_in"=>null,
	            "where"=>"",
	            "order_by" => "",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
        	);

			$parametrosMes = array( //Select com filtro especifico
				"distinct"=>FALSE,
	            "select" => "*",
	            "table" => "transparencia",
	            "where" => array('ano' => $cod),
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
        	);

		$parametrosContas = array( //Select com filtro especifico
				"distinct"=>TRUE,
	            "select" => "ano,mes,",
	            "table" => "transparencia",
	            "where" => array('ano' => $cod),
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
        	);

			//Obem matriz com os dados
			$dados['ano'] = getItem($parametrosItem)->result();
			$dados['mes']= getItem($parametrosMes)->result();
			$dados['contas']= getItem($parametrosContas)->result();


			//carrega view com os dados buscados


			set_tema('conteudo', load_modulo_site('view_prestacao_de_contas_vereadores', $dados));
			load_template();



		} else { //Select de tupla específica

			$parametrosItem = array(
				"distinct"=>TRUE,
	            "select" => "ano",
	            "table" => "transparencia",
	            "where"=>"",
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
        	);

			$parametrosVereador = array( //Select com filtro especifico
				"distinct"=>TRUE,
	            "select" => "*",
	            "table" => "vereador",
	            "where" => "",
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => array("legislatura"=>$cod),
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
        	);

			$parametrosFiltro = array( //Select com filtro especifico
				"distinct"=>FALSE,
	            "select" => "*",
	            "table" => "vereador",
	            "where" => "",
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
        	);

		//Obem matriz com os dados
		$dados['ano']  = getItem($parametrosItem)->result();
		$dados['vereador'] = getItem($parametrosVereador)->result();
				//carrega view com os dados buscados

			set_tema('conteudo', load_modulo_site('view_prestacao_de_contas_vereadores', $dados));
			load_template();

		}

	}
	
	
	public function biografia($cod=null){
				
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

			set_tema('conteudo', load_modulo_site('view_vereador_biografia', $dados));
			load_template();			
		
	}




}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
