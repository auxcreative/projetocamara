<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lei extends CI_Controller {

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
	 
	 
	public function gerenciar($offset=0, $limit=10)	{
		
		esta_logado();
            
          $parametrosItem = array(
                "distinct" =>null,
	            "select" => "*", 
	            "table" => "lei",
	            "where" => "",
	            "where_not_in"=>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => array($limit, $offset),
	            "group_by" => "",
	            "join" => ""
                );
		
	        $dados = getItem($parametrosItem)->result();
			;
                
                if($dados != false) {
                    //carrega view com os dados buscados
                    $dados['leis'] = $dados;
                    $dados['pagina'] = 'lei';
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                } else {
                    //carrega view
                    $dados['leis'] = null;
                    $dados['pagina'] = 'lei';
                    set_msg('notificacao', 'Nenhuma lei cadastrada', 'info');
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                }
            

	}
        
        public function adicionar() {

                $this->form_validation->set_rules('p#numero','Numero','required|trim');

            if($this->form_validation->run()){
            	
		//Array com valores do formulário
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
            // e enviamos para a home
            
			$msg =  'Arquivo incompatível ou não enviado';
            set_msg('msgerro',$msg,'info');
			
        }
        else
        {
            //se correu tudo bem, recuperamos os dados do arquivo
            $data['dadosArquivo'] = $this->upload->data();			
			$post['p#arquivo'] = $data['dadosArquivo']['file_name'];
		}  
		
			//Arruma a data paro o banco de dados								
			$post['p#publicacao'] = load_data($this->input->post('p#publicacao'));
            //salva as alterações
		
                setItem(null,"xon_lei",$post, "main/lei");

            } else {
                                  
                $dados['pagina'] = "nova_lei";
                
                set_tema('tinymce', load_js(array('plugins/tinymce/tinymce.min','tinyMCE')), FALSE);
                set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                load_template();
            } 
	}
        
        public function editar($cod = null){

            if($cod != null) {

              $this->form_validation->set_rules('p#numero','Numero','required|trim');

              if($this->form_validation->run()){
              	
		//Array com valores do formulário
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
		}  
		
			//Arruma a data paro o banco de dados								
			$post['p#publicacao'] = load_data($this->input->post('p#publicacao'));
            //salva as alterações
            setItem($cod,"xon_lei",$post, current_url());

                } else {

                    $parametrosItem = array(
                        "distinct" =>null,
                        "select" => "*",
                        "table" => "xon_lei",
                        "where" => array("id" => decodificarString($cod)),
                        "order_by" => "",
                        "like" => "",
                        "limit" => "",
                        "group_by" => "",
                        "join" => ""
                    );
                    

                    $dados['pagina'] = "editar_lei";		
                    $dados['lei'] = getItem($parametrosItem)->row();
                    
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
			$result = $this->crud_model->delete("xon_lei", "id", array("id" => $cod));
			if($result) {
				if($result['code'] == 0) {//Query executada com sucesso
					//Carrega proxima view
					set_msg('notificacao', 'Registro removido com sucesso', 'success');
                                        redirect("main/lei");
				} else {
					//Carrega proxima view enviando erro para depuração  (array $result)
					
				}
			}
		} else {
			//redireciona informando que um item precisa ser selecionado para remoção
                        redirect("main/lei");
		}
	}
	
	
public function download() {			
		
		// recuperamos o segundo segmento da url, que é o diretório
        $diretorio = $this->uri->segment(4);
        // recuperamos o terceiro segmento da url, que é o nome do arquivo
        $arquivo = $this->uri->segment(5);
        
		
		if(!empty($arquivo)){
		
        // definimos original path do arquivo
        $arquivoPath = './uploads/'.$diretorio."/".$arquivo;
 
        // forçamos o download no browser 
        // passando como parâmetro o path original do arquivo
        force_download($arquivoPath,null);
		
		}

		
	}
	
}