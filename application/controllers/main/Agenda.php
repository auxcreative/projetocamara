<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

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
	            "select" => "agenda.*, evento.id as eventos_id, evento.nome as nome_evento",
	            "table" => "agenda",
	            "where" => "",
	            "where_not_in"=>null,
	            "order_by" => "data desc",
	            "like" => "",
	            "limit" => array($limit, $offset),
	            "group_by" => "",
	            "join" => array("evento"=>'evento.id=agenda.id_evento'));
			
            
                $dados['agenda'] = getItem($parametrosItem)->result();
				$dados['pagina'] = 'agenda';
                
                if($dados != false) {
                    //carrega view com os dados buscados
                   
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                } else {
                    //carrega view
                    set_msg('notificacao', 'Nenhum item de agenda encontrado', 'info');
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                }
	}

       public function adicionar() {
       		esta_logado();
			acesso('insert');
       	
        	

        $this->form_validation->set_rules('p#evento','Evento','required|trim');

       if($this->form_validation->run()){
            	
		                	
		/* definimos o path onde o arquivo será gravado
        $path = "./uploads/documentos/";
 
        // verificamos se o diretório existe
        // se não existe criamos com permissão de leitura e escrita
        if ( ! is_dir($path)) {
        mkdir($path, 0777, $recursive = true);
    }
 
        // definimos as configurações para o upload
        // determinamos o path para gravar o arquivo
        $configUpload['upload_path']   = $path;
        // definimos - através da extensão - 
        // os tipos de arquivos suportados
        $configUpload['allowed_types'] = 'jpeg|jpg|png|gif|pdf|zip|rar|doc|xls|docx|xlsx';
        // definimos que o nome do arquivo
 
        // passamos as configurações para a library upload
        $this->upload->initialize($configUpload);
 		
		//Verifica se foi enviado arquivo			
		// verificamos se o upload foi processado com sucesso
        if (!$this->upload->do_upload('p#arquivo')){
            // em caso de erro retornamos os mesmos para uma variável
            // e enviamos para a home
            
			$msg =  'Arquivo incompatível ou não enviado';
            set_msg('msgerro',$msg,'info');
			
        }
        else
        {
            //se correu tudo bem, recuperamos os dados do arquivo
            $data['dadosArquivo'] = $this->upload->data();			
			$post['p#arquivo'] = $data['dadosArquivo']['file_name'];
		}  */
		

		
			//Arruma a data paro o banco de dados								
			$_POST['p#data'] = load_data($this->input->post('p#data'));
            //salva as alterações
		
                setItem(null,"xon_agenda",$_POST, "main/agenda");

            } else {
            	
			$parametrosItem = array(
                "distinct" => null,
	            "select" => "*",
	            "table" => "xon_evento",
	            "where" => "",
	            "where_not_in"=>null,
	            "order_by" => "xon_evento.nome asc",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
        	);
                       
                $dados['pagina'] = "nova_agenda";
				$dados['eventos'] = getItem($parametrosItem)->result();
                
                set_tema('tinymce', load_js(array('plugins/tinymce/tinymce.min','tinyMCE')), FALSE);
                set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                load_template();
            } 
	}
        
        public function editar($cod = null){
        	
			
			esta_logado();
			acesso('control');
			acesso('edit');
			

            if($cod != null) {

              $this->form_validation->set_rules('p#evento','Evento','required|trim');

              if($this->form_validation->run()){
              	
		/*Array com valores do formulário
		$post = elements(array('p#titulo','p#numero','p#ementa','p#autor','p#ano'), $this->input->post());	
				
                	
		// definimos o path onde o arquivo será gravado
        $path = "./uploads/documentos/";
 
        // verificamos se o diretório existe
        // se não existe criamos com permissão de leitura e escrita
        if ( ! is_dir($path)) {
        mkdir($path, 0777, $recursive = true);
    }
 
        // definimos as configurações para o upload
        // determinamos o path para gravar o arquivo
        $configUpload['upload_path']   = $path;
        // definimos - através da extensão - 
        // os tipos de arquivos suportados
        $configUpload['allowed_types'] = 'jpeg|jpg|png|gif|pdf|zip|rar|doc|xls|docx|xlsx';
        // definimos que o nome do arquivo
 
        // passamos as configurações para a library upload
        $this->upload->initialize($configUpload);
 		
		//Verifica se foi enviado arquivo			
		// verificamos se o upload foi processado com sucesso
        if (!$this->upload->do_upload('p#arquivo')){
            // em caso de erro retornamos os mesmos para uma variável      
			$msg =  'Arquivo incompatível ou não enviado';
            set_msg('msgerro',$msg,'info');
			
        }
        else
        {
            //se correu tudo bem, recuperamos os dados do arquivo
            $data['dadosArquivo'] = $this->upload->data();			
			$post['p#arquivo'] = $data['dadosArquivo']['file_name'];
		} */
		
			//Arruma a data paro o banco de dados								
			$_POST['p#data'] = load_data($this->input->post('p#data'));
            //salva as alterações
		
                setItem($cod,"xon_agenda",$_POST, current_url());

                } else {
                   
              $parametrosAgenda = array(
                "distinct" => null,
	            "select" => "*",
	            "table" => "xon_agenda",
	            "where" => array('id'=>decodificarString($cod)),
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
        	);
                    
             $parametrosItem = array(
                "distinct" => null,
	            "select" => "*",
	            "table" => "evento",
	            "where" => "",
	            "order_by" => "evento.nome asc",
	            "where_not_in"=>null,
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
        	);
                       
                
				$dados['eventos'] = getItem($parametrosItem)->result();
                $dados['pagina'] = "editar_agenda";		
                $dados['agenda'] = getItem($parametrosAgenda)->row();
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