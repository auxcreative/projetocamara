<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mesa_diretora extends CI_Controller {

    public function __construct(){
        parent::__construct();
        init_main();
				
    }    
	/**
	 * X-On
	 * Sistema: Portal da Transparencia - Coelho Neto
	 * Controlador: partido
	 */
	public function gerenciar($offset=0, $limt=10)	{
		
		esta_logado();
            
      $parametrosItem = array(
                    "distinct" =>null,
	            "select" => "xon_mesa_diretora.id, xon_mesa_diretora.funcao, xon_mesa_diretora.bienio, xon_mesa_diretora.status, xon_mesa_diretora.id_vereador,"
                              . "xon_vereador.nome", 
	            "table" => "mesa_diretora",
	            "where" => "",
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => array($limt, $offset),
	            "group_by" => "",
	            "join" => array('xon_vereador' => 'xon_vereador.id = xon_mesa_diretora.id_vereador'));
		
	        	$dados['mesa'] = getItem($parametrosItem)->result();
            	$dados['pagina'] = 'mesa_diretora';
                set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                load_template();
            

	}
	
	public function  index(){
		
		esta_logado();
		
		$this->gerenciar();
		
		
	}
        
        public function adicionar() {

                $this->form_validation->set_rules('p#id_vereador','Vereador','required|trim');
                $this->form_validation->set_rules('p#funcao','Função','required|trim');

            if($this->form_validation->run()){
                
                setItem(null,"mesa_diretora",$_POST, "main/mesa_diretora");

            } else {
                                  
                    $parametrosVereador = array(
                        "distinct" =>null,
                        "select" => "vereador.id, vereador.nome, vereador.id_partido,"
                                  . "partido.sigla",
                        "table" => "vereador",
                        "where" => array('vereador.status' => 'a'),
                        "where_not_in"=>null,
                        "order_by" => "vereador.nome asc",
                        "like" => "",
                        "limit" => "",
                        "group_by" => "",
                        "join" => array("partido" => "partido.id = vereador.id_partido")
                    );
                
                $dados['pagina'] = "novo_membro_mesa";
                $dados['vereadores'] = getItem($parametrosVereador)->result();
                
                set_tema('conteudo', load_modulo_main('novo_membro_mesa', $dados),FALSE);
                load_template();
            } 
	}
        
        public function editar($cod = null){

            if($cod != null) {

                $this->form_validation->set_rules('p#id_vereador','Vereador','required|trim');
                $this->form_validation->set_rules('p#funcao','Função','required|trim');

                if($this->form_validation->run()){
             
                    setItem($cod,"xon_mesa_diretora",$_POST, current_url());

                } else {
                    
                    $parametrosMembro = array(
                        "distinct" =>null,
                        "select" => "*",
                        "table" => "xon_mesa_diretora",
                        "where" => array('id' => decodificarString($cod)),
                        "where_not_in"=>null,
                        "order_by" => "",
                        "like" => "",
                        "limit" => "",
                        "group_by" => "",
                        "join" => ""
                    );
                    
                    $parametrosVereador = array(
                        "distinct" =>null,
                        "select" => "xon_vereador.id, xon_vereador.nome, xon_vereador.id_partido,"
                                  . "xon_partido.sigla",
                        "table" => "xon_vereador",
                        "where" => array('xon_vereador.status' => 'a'),
                        "where_not_in"=>null,
                        "order_by" => "nome asc",
                        "like" => "",
                        "limit" => "",
                        "group_by" => "",
                        "join" => array("xon_partido" => "xon_partido.id = xon_vereador.id_partido")
                    );

                    $dados['pagina'] = "editar_membro_mesa";		
                    $dados['membro'] = getItem($parametrosMembro)->row();
                    $dados['vereadores'] = getItem($parametrosVereador)->result();
                    
                    set_tema('tinymce', load_js(array('plugins/tinymce/tinymce.min','tinyMCE')), FALSE);
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                } 
            }

        }

	public function remover($cod = null){
		
		if($cod != null) {
			$this->load->model('crud_model');
			$cod = decodificarString($cod);
			$result = $this->crud_model->delete("xon_mesa_diretora", "id", array("id" => $cod));
			if($result) {
				if($result['code'] == 0) {//Query executada com sucesso
					//Carrega proxima view
					set_msg('notificacao', 'Registro removido com sucesso', 'success');
                                        redirect("main/mesaDiretora");
				} else {
					//Carrega proxima view enviando erro para depuração  (array $result)
					
				}
			}
		} else {
			//redireciona informando que um item precisa ser selecionado para remoção
                        redirect("main/mesaDiretora");
		}
	}
	
}