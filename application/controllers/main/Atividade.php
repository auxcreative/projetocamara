<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Atividade extends CI_Controller {

    public function __construct(){
        parent::__construct();
        init_main();
				
    }    
	/**
	 * X-On
	 * Sistema: Portal da Transparencia - Coelho Neto
	 * Controlador: atividade
	 */
	public function index()	{
		
		$this->home();
	
	}
	
	public function home() {
  	
	//set_tema('conteudo', load_modulo_main('view_home'));
    //load_template();
    
    $this->setItem();
      
  }
	
	public function getItem($cod = null){
		
		$this->load->model('crud_model');
		
		if($cod == null){ //Select de todas tuplas 
			$parametrosItem = array(
	            "select" => "*",
	            "table" => "xon_atividade",
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
				
			} else {
				//carrega view informando que não há dados a serem exibidos
			}
			
		} else { //Select de tupla específica
			
			$parametrosItem = array(
	            "select" => "*",
	            "table" => "xon_atividade",
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
	
	public function setItem($cod = null) {
		
		$this->load->model('crud_model');

		if($cod == null) { //Verifica se é operacao de update ou insert 
			if($_POST){ //Verifica se há dados a inserir

				$dados = array();
				foreach ($_POST as $key => $value) { //Povoa o array para persistencia
					$operando = explode('#', $key);	
					if($operando[0] == 'p') {
						$dados[$operando[1]] = $value;
					}
				}
							   
		        $result = $this->crud_model->insert("xon_atividade", $dados);
				//carrega prox view
				if(!is_array($result)) {
					//$result retorna  o ID do item inserido
					
				} else {
					//array $result e carrega proxima view enviando erro para depuração
				}
				
			} else {
				//rediciona para o formulario de cadastro
				
			}
		} else {
		
			if($_POST){ //Verifica se há dados a atualizar
				
				$dados = array();
				foreach ($_POST as $key => $value) { //Povoa o array para persistencia
					$operando = explode('#', $key);	
					if($operando[0] == 'p') {
						$dados[$operando[1]] = $value;
					}
				}
				
		        $result = $this->crud_model->update("xon_atividade","id", $dados);
			if($result) {
				if($result['code'] == 0) {//Query executada com sucesso
					//Carrega proxima view
					
				} else {
					//Carrega proxima view enviando erro para depuração  (array $result)
					
				}
			}
				
			} else {
				//redireciona para o formulario de edição

			}
			
		}
	}
	
	public function removerItem($cod = null){
		
		if($cod != null) {
			$this->load->model('crud_model');
			
			$result = $this->crud_model->delete("xon_atividade", "id", array("id" => $cod));
			if($result) {
				if($result['code'] == 0) {//Query executada com sucesso
					//Carrega proxima view
					
				} else {
					//Carrega proxima view enviando erro para depuração  (array $result)
					
				}
			}
		} else {
			//redireciona informando que um item precisa ser selecionado para remoção
		}
	}
	
}