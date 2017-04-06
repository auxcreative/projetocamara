<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends CI_Controller {
	
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

		
		$parametrosItem = array(
                "distinct" => null,
	            "select" => "agenda.*, evento.id as eventos_id, evento.nome as nome_evento",
	            "table" => "agenda",
	            "where" => "",
	            "where_not_in"=>null,
	            "order_by" => "data desc",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => array("evento"=>'evento.id=agenda.id_evento')
        	);
                
           $dados['agenda'] = getItem($parametrosItem)->result();
			
			
			set_tema('conteudo', load_modulo_site('view_agenda', $dados));
			load_template();
	
	
		
	
}
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */