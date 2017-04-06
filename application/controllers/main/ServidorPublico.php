<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ServidorPublico extends CI_Controller {

    public function __construct(){
        parent::__construct();
        init_main();
				
    }    
	/**
	 * X-On
	 * Sistema: Portal da Transparencia - Coelho Neto
	 * Controlador: partido
	 */
	 
	public function index(){
		$this->gerenciar();
	}
	public function gerenciar($offset=0, $limte=10)	{
		
		esta_logado();
            
                $parametrosItem = array(
                    "distinct" =>null,
	            "select" => "xon_servidor_publico.id, xon_servidor_publico.nome, xon_servidor_publico.cpf, xon_servidor_publico.telefone, xon_servidor_publico.id_cargo,"
                              . "xon_cargos.cargo, xon_cargos.status", 
	            "table" => "xon_servidor_publico",
	            "where" => "",
	            "where_not_in"=>null,
	            "order_by" => "xon_servidor_publico.nome asc",
	            "like" => "",
	            "limit" => array($limte,$offset),
	            "group_by" => "",
	            "join" => array('xon_cargos' => 'xon_cargos.id = xon_servidor_publico.id_cargo')
                );
		
	        $dados = getItem($parametrosItem)->result();
                
                if($dados != false) {
                    //carrega view com os dados buscados
                    $dados['servidores'] = $dados;
                    $dados['pagina'] = 'servidor_publico';
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                } else {
                    //carrega view
                    $dados['servidores'] = null;
                    $dados['pagina'] = 'servidor_publico';
                    set_msg('notificacao', 'Nenhum servidor público cadastrado', 'info');
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                }
            

	}
        
        public function adicionar() {
        	
			esta_logado();
			acesso('insert');

                $this->form_validation->set_rules('p#nome','Nome','required|trim');

            if($this->form_validation->run()){

                setItem(null,"xon_servidor_publico",$_POST, "main/servidorPublico");

            } else {
                                  
                    $parametrosCargo = array(
                        "distinct" =>null,
                        "select" => "*",
                        "table" => "xon_cargos",
                        "where" => "",
                        "where_not_in"=>null,
                        "order_by" => "cargo asc",
                        "like" => "",
                        "limit" => "",
                        "group_by" => "",
                        "join" => ""
                );
                
                $dados['pagina'] = "novo_servidor";
                $dados['cargos'] = getItem($parametrosCargo)->result();
                
                set_tema('tinymce', load_js(array('plugins/tinymce/tinymce.min','tinyMCE')), FALSE);
                set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                load_template();
            } 
	}
        
        public function editar($cod = null){
        	esta_logado();
        	acesso('edit');   	

            if($cod != null) {

                $this->form_validation->set_rules('p#nome','Nome','required|trim');
                $this->form_validation->set_rules('p#id_cargo','Cargo','required|trim');

                if($this->form_validation->run()){

                    setItem($cod,"xon_servidor_publico",$_POST, current_url());

                } else {

                    $parametrosItem = array(
                        "distinct" =>null,
                        "select" => "*",
                        "table" => "xon_servidor_publico",
                        "where" => array("id" => decodificarString($cod)),
                        "where_not_in"=>null,
                        "order_by" => "",
                        "like" => "",
                        "limit" => "",
                        "group_by" => "",
                        "join" => ""
                    );
                    
                    $parametrosCargo = array(
                        "distinct" =>null,
                        "select" => "*",
                        "table" => "xon_cargos",
                        "where" => "",
                        "where_not_in"=>null,
                        "order_by" => "cargo asc",
                        "like" => "",
                        "limit" => "",
                        "group_by" => "",
                        "join" => ""
                    );

                    $dados['pagina'] = "editar_servidor";		
                    $dados['servidor'] = getItem($parametrosItem)->row();
                    $dados['cargos'] = getItem($parametrosCargo)->result();
                    
                    set_tema('tinymce', load_js(array('plugins/tinymce/tinymce.min','tinyMCE')), FALSE);
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                } 
            }

        }

	public function remover($cod = null){
		
		esta_logado();
		acesso('del');
		
		if($cod != null) {
			$this->load->model('crud_model');
			$cod = decodificarString($cod);
			$result = $this->crud_model->delete("xon_servidor_publico", "id", array("id" => $cod));
			if($result) {
				if($result['code'] == 0) {//Query executada com sucesso
					//Carrega proxima view
					set_msg('notificacao', 'Registro removido com sucesso', 'success');
                                        redirect("main/servidorPublico");
				} else {
					//Carrega proxima view enviando erro para depuração  (array $result)
					
				}
			}
		} else {
			//redireciona informando que um item precisa ser selecionado para remoção
                        redirect("main/servidorPublico");
		}
	}
	
}