<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        init_main();		
    }    
	/**
	 * X-On
	 * Sistema: Portal da Transparencia - Coelho Neto
	 * Controlador: Menu
	 */
	public function index()	{
		
		esta_logado();
		
        $this->home();
	
	}
	
	public function home() {
		
		esta_logado();
		
			$parametrosItem = array(
                "distinct" =>null,
	            "select" => "*",
	            "table" => "noticias",
	            "where" => array("status"=>"n"),
	             "where_not_in"=>null,
	             
	            "order_by" => "id desc",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => "");
		
	       
	       
	     $dados['noticias'] = getItem($parametrosItem)->result(); 
		 $dados['pagina'] = 'home';              
			
		set_tema('conteudo', load_modulo_main('home', $dados), FALSE);
        load_template();
      
        }

	
	public function removerItem($cod = null){
		
		esta_logado();
		
		if($cod != null) {
			$this->load->model('crud_model');
			
			$result = $this->crud_model->delete("xon_menu", "id", array("id" => $cod));
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

	
	public function adicionar() {
		
		esta_logado();
		
		acesso('insert');
		
			if($this->session->userdata('code')  == '') $this->session->set_userdata('code', random_string('alnum',7));

            $this->form_validation->set_rules('p#titulo','Título','required|trim');

            if($this->form_validation->run()){

                				
				
				$_POST['p#data_postagem'] = load_data($_POST['p#data_postagem']);
				$_POST['p#slug'] = str_replace(' ', '-', convert_accented_characters(strtolower($_POST['p#titulo'])));
				$_POST['p#resumo'] =$_POST['p#resumo'];
				
                $this->session->unset_userdata(array('code','tab'));
							
                setItem(null,"xon_noticias",$_POST, "main/noticias");
				

            } else {
            	
	           $parametrosItem = array(
                "distinct" =>null,
	            "select" => "*",
	            "table" => "banco_de_imagem",
	            "where" => array('code'=>strtoupper($this->session->userdata('code'))),
	             "where_not_in"=>null,
	            "order_by" => "id desc",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
	    );
		
	        	$dados['banco'] = getItem($parametrosItem)->result();
				
                $dados['pagina'] = "nova_noticia";

                set_tema('headerinc', load_js(array('plugins/tinymce/tinymce.min','tinyMCE')), FALSE);
                set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                load_template();
            } 
            
	}
	
	public function editar($cod = null){
		
		esta_logado();
		acesso('control');
		acesso('edit');
		
        if($cod != null) {

            $this->form_validation->set_rules('p#titulo','Título','required|trim');

            if($this->form_validation->run()){
				
			

				$_POST['p#data_postagem'] = load_data($_POST['p#data_postagem']);
				$_POST['p#slug'] = str_replace(' ', '-', convert_accented_characters($_POST['p#titulo']));
				$_POST['p#resumo'] =$_POST['p#resumo'];
								
				$this->session->unset_userdata(array('code','tab'));
				
                setItem($cod,"noticias",$_POST,current_url());
				

            } else {
                
                $parametrosItem = array(
                
                "distinct" =>null,
	            "select" => "*",
	            "table" => "noticias",
	            "where" => array("id" => decodificarString($cod)),
	             "where_not_in"=>null,
	            "order_by" => "id desc",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => "");
				
				$dados['noticia'] = getItem($parametrosItem)->row();
				
				$parametrosCode = array(
                "distinct" =>null,
	            "select" => "*",
	            "table" => "banco_de_imagem",
	            "where" => array('code'=>$dados['noticia']->code),
	             "where_not_in"=>null,
	            "order_by" => "id desc",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
	    );

                $dados['pagina'] = "noticia_editar";
				
				$dados['banco'] = getItem($parametrosCode)->result();		
                
                
                set_tema('headerinc', load_js(array('plugins/tinymce/tinymce.min','tinyMCE')), FALSE);
                set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                load_template();
            } 
	}
        	
    }


	public function publicar($cod=null){
			
			esta_logado();
			acesso('control');
			
			$parametrosCode = array(
                "distinct" =>null,
	            "select" => "*",
	            "table" => "noticias",
	            "where" => array('id' => decodificarString($cod)),
	             "where_not_in"=>null,
	            "order_by" => "",
	            "like" => "",
	            "limit" => "",
	            "group_by" => "",
	            "join" => ""
	    );
			
			$status['p#status'] = (getItem($parametrosCode)->row('status') == 'n') ? 'p' : 'n';
			
			setItem($cod, "noticias", $status, base_url('main/noticias'));
			
			
			
		
	}

        public function banco_de_imagem($cod='') {


            	                	
		// definimos o path onde o arquivo será gravado
        $path = "./uploads/noticias/";
 
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
        if (!$this->upload->do_upload('p#url')){
            // em caso de erro retornamos os mesmos para uma variável
            // e enviamos para a home
            
			$msg =  'Arquivo incompatível ou não enviado';
            set_msg('msgerro',$msg,'info');
			
        }
        else
        {
            //se correu tudo bem, recuperamos os dados do arquivo
            $data['dadosArquivo'] = $this->upload->data();			
			$_POST['p#url'] = $data['dadosArquivo']['file_name'];
		}  
            //salva as alterações
            
            
			
			if($this->session->userdata('tab') != 'active') $this->session->set_userdata('tab','active');
			
			$url_volta = ($cod != '') ? 'main/noticias/editar/'.$cod : 'main/noticias/adicionar';
						
            setItem(null,"xon_banco_de_imagem",$_POST, $url_volta);
            
	}
	
}