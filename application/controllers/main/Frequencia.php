<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Frequencia extends CI_Controller {

    public function __construct(){
        parent::__construct();
	init_main();			
    }    
	/**
	 * 
	 * Sistema: Portal da Transparencia - Coelho Neto
	 * Controlador: agenda
	 */
	 public function index(){
	 	
		$this->gerenciar();
	 	
	 }
	 
	public function gerenciar($offset=0, $limit=3)	{
		
		esta_logado();
		
		
		$parametrosItem = array(
                "distinct" => null,
	            "select" => "*",
	            "table" => "sessao",
	            "where" => "",
	            "where_not_in" =>null,
	            "order_by" => "data desc",
	            "like" => "",
	            "limit" => array($limit, $offset),
	            "group_by" => "",
	            "join" => "");
		
			
            
                $dados['frequencia'] = getItem($parametrosItem)->result();
				$dados['pagina'] = 'frequencia';
                
                   if($dados != false) {
                    //carrega view com os dados buscados
                   
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                    } else {
                    //carrega view
                    set_msg('notificacao', 'Nenhum item de agenda encontrado', 'info');
				/*	set_tema('headerinc', load_css(array('bootstrap-datepicker')), FALSE);
					set_tema('headerinc', load_js(array('bootstrap-datepicker')), FALSE); */
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                    }
	}


  public function adicionar_frequencia($id=NULL,$status=0) {
       	
       		esta_logado();
			acesso('control');
			acesso('insert');
			acesso('edit');
			
			//Verifica se uma frequencia já foi adicionada
			$ParametroSessao = array(
			
				"distinct"=>NULL,
	            "select" => "*, where id not in (select xon_frequencia.id_vereador from xon_frequencia where xon_frequencia.id_sessao = ".decodificarString($id).") as vereador",
	            "table" => "vereado",
	            "where" => array(	'status'=>'A'),
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
	        );
			
			$sessao = getItem($ParametroSessao);
			
			if($sessao->num_rows() != 0){			
	
			$lista = getItem($ParametroSessao)->result();
			
			$dados = array('p#id_sessao'=>decodificarString($id),'p#status'=>0);
			
			foreach($lista as $frequencia):
			 $dados['p#id_vereador'] = $frequencia->id;			 
			 setItem(null,"frequencia",$dados, null);			 
			endforeach;			
			};
			
		$lista_vereador = array(
				"distinct"=>NULL,
	            "select" => "frequencia.*, 
	            			vereador.id as vereador_id, 
	            			vereador.status as vereador_status, 
	            			vereador.legislatura, vereador.nome, 
	            			vereador.id_partido, 
	            			partido.id as partido_id, 
	            			partido.sigla", 
	            "table" => "frequencia",
	            "where" => array('vereador.status'=>'A','frequencia.id_sessao'=>decodificarString($id)),
	            "where_not_in" =>null,
	            "order_by" => "",
	            "like" => array('vereador.legislatura'=>date('Y')),
	            "limit" => "",
	            "group_by" => "",
	            "join" => array("vereador"=>'vereador.id=frequencia.id_vereador',
	            				"partido"=>'partido.id = vereador.id_partido')
	        );

	   if($status != NULL){            	
		    //Arruma a data paro o banco de dados								
			$dados['p#status'] = $status;
			//salva as alterações            
		
                setItem($id,"frequencia",$dados,'main/frequencia/adicionar_frequencia/'.$id);

            } else {
            	$dados['row'] = $sessao->num_rows();
				$dados['vereador'] = getItem($lista_vereador)->result();
                $dados['pagina'] = "adicionar_frequencia";
                set_tema('footerinc', load_js(array('set_presenca')),FALSE);
                set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                load_template();
            } 
	}

       public function adicionar() {
       		esta_logado();
			acesso('insert');
       	
        	

        $this->form_validation->set_rules('p#data','Data','required|trim');

       if($this->form_validation->run()){
            	
		    //Arruma a data paro o banco de dados								
			$_POST['p#data'] = load_data($this->input->post('p#data'));
            //salva as alterações
            
		
                setItem(NULL,"sessao",$_POST, "main/frequencia");

            } else {
            	
                       
                $dados['pagina'] = "nova_frequencia";
                
				set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                load_template();
            } 
	}
	   
		public function marcar(){
        	
			esta_logado();
			acesso('control');
			acesso('edit');
			
              $this->form_validation->set_rules('p#id_vereador','Vereador','required|trim');
			  
              if($this->form_validation->run()){
              	              	              	
				$dados['p#status'] = $_POST['p#status'];
				  
                setItem(array('id_vereador'=>$_POST['p#id_vereador'],'id_sessao'=>$_POST['p#id_sessao']),
                			  "frequencia", $dados, NULL);
				

			  }

        }
        
        public function editar($cod = null){
        	
			
			esta_logado();
			acesso('control');
			acesso('edit');
			

            if($cod != null) {

              $this->form_validation->set_rules('p#data','Data','required|trim');

              if($this->form_validation->run()){
              	

		
			//Arruma a data paro o banco de dados								
			$_POST['p#data'] = load_data($this->input->post('p#data'));
            //salva as alterações
		
                setItem($cod,"sessao",$_POST, current_url());

                } else {
                   
              $parametros = array(
                "distinct" => null,
	            "select" => "*",
	            "table" => "sessao",
	            "where" => array('id'=>decodificarString($cod)),
	            "where_not_in" =>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
        	);
                    
                $dados['pagina'] = "editar_frequencia";		
                $dados['frequencia'] = getItem($parametros)->row();
                set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                load_template();
                } 
            }

        }
        
	public function removerItem($cod = null){
		
		esta_logado();
		acesso('control');
		acesso('del');
		
		if($cod != null) {
			$this->load->model('crud_model');
			
			$result = $this->crud_model->delete("xon_agenda", "id", array("id" => $cod));
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