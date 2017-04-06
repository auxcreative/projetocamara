<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticias extends CI_Controller {
	
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
	public function index($cod=null)
	{

		
		$this->acesso();
	
}
	public function acesso($slug=null){
			
		$parametrosItem = array(
                "distinct" => null,
	            "select" => "*",
	            "table" => "noticias",
	            "where" => array('slug'=>$slug),
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
        	);
                
           $dados['noticia'] = getItem($parametrosItem)->row();
			
			
			set_tema('conteudo', load_modulo_site('view_noticias', $dados));
			load_template();
		
	}
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */