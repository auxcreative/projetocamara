<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lei_de_acesso_a_informacao extends CI_Controller {
	
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
	public function index()
	{
		$this->getItem();
	}
	
	public function getItem($cod = null){
		
		$this->load->model('crud_model');
		
		if($cod == null){ //Select de todas tuplas 
			$parametrosItem = array(
				"distinct"=>FALSE,
	            "select" => "*",
	            "table" => "agenda",
	            "where" => "",
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
	        );
			
			//Obem matriz com os dados
			$dadosItem = $this->crud_model->select($parametrosItem);
			
			if($dadosItem) {
			//carrega view com os dados buscados
			$dados['agenda'] = $dadosItem;
			set_tema('conteudo', load_modulo_site('view_acesso_info', $dados));
			load_template();
				
				
			} else {
				//carrega view informando que não há dados a serem exibidos
			}
			
		} else { //Select de tupla específica
			
			$parametrosItem = array(
	            "select" => "*",
	            "table" => "xon_menu",
	            "where" => array('id' => $cod),
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
        	);
		
		//Obem matriz com os dados
		$dadosItem = $this->crud_model->select($parametrosItem);
		
		if($dadosItem) {
				//carrega view com os dados buscados
				
			} else {
				//carrega view informando que não há dados a serem exibidos para a consulta
				
			}
		}
		
	}
	

	
	
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */