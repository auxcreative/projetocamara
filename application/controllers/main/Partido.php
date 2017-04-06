<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Partido extends CI_Controller {

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
	            "table" => "xon_partido",
	            "where" => array("status"=>"A"),
	            "where_not_in"=>null,
	            "order_by" => "id desc",
	            "like" => "",
	            "limit" => array($limit,$offset),
	            "group_by" => "",
	            "join" => ""
	    );
		
	        $dados = getItem($parametrosItem)->result();
                
                if($dados != false) {
                    //carrega view com os dados buscados
                    $dados['partidos'] = $dados;
                    $dados['pagina'] = 'partido';
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                } else {
                    //carrega view
                    $dados['partidos'] = NULL;
                    $dados['pagina'] = 'partido';
                    set_msg('notificacao', 'Nenhum partido cadastrado', 'info');
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                }
            

	}
        
        public function adicionarPartido() {
        				
        		esta_logado();
        		acesso('insert');

                $this->form_validation->set_rules('p#nome','Nome','required|trim');

            if($this->form_validation->run()){
            	
					// definimos o path onde o arquivo será gravado
        $path = "./uploads/partidos/";
 
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
        $configUpload['allowed_types'] = 'jpeg|jpg|png|gif';
        // definimos que o nome do arquivo
 
        // passamos as configurações para a library upload
        $this->upload->initialize($configUpload);
 		
		//Verifica se foi enviado arquivo			
		// verificamos se o upload foi processado com sucesso
        if (!$this->upload->do_upload('p#imagem')){
            // em caso de erro retornamos os mesmos para uma variável      
			$msg =  'Arquivo incompatível ou não enviado';
            set_msg('msgerro',$msg,'info');
			
        }
        else
        {
            //se correu tudo bem, recuperamos os dados do arquivo
            $data['dadosArquivo'] = $this->upload->data();			
			$_POST['p#imagem'] = $data['dadosArquivo']['file_name'];
		} 

                setItem(null,"partido",$_POST, "main/partido");

            } else {

                $dados['pagina'] = "novo_partido";

                
                set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                load_template();
            } 
	}
        
        public function editarPartido($cod = null){
        	
			esta_logado();
			acesso('edit');

            if($cod != null) {

                $this->form_validation->set_rules('p#nome_partido','Nome','required|trim');

                if($this->form_validation->run()){
                	
						// definimos o path onde o arquivo será gravado
        $path = "./uploads/partidos/";
 
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
        $configUpload['allowed_types'] = 'jpeg|jpg|png|gif';
        // definimos que o nome do arquivo
 
        // passamos as configurações para a library upload
        $this->upload->initialize($configUpload);
 		
		//Verifica se foi enviado arquivo			
		// verificamos se o upload foi processado com sucesso
        if (!$this->upload->do_upload('p#imagem')){
            // em caso de erro retornamos os mesmos para uma variável      
			$msg =  'Arquivo incompatível ou não enviado';
            set_msg('msgerro',$msg,'info');
			
        }
        else
        {
            //se correu tudo bem, recuperamos os dados do arquivo
            $data['dadosArquivo'] = $this->upload->data();			
			$_POST['p#imagem'] = $data['dadosArquivo']['file_name'];
		} 

                    setItem($cod,"xon_partido",$_POST, current_url());

                } else {

                    $parametrosItem = array(
                        "distinct" =>null,
                        "select" => "*",
                        "table" => "partido",
                        "where" => array("id" => decodificarString($cod)),
                        "where_not_in"=>null,
                        "order_by" => "",
                        "like" => "",
                        "limit" => "",
                        "group_by" => "",
                        "join" => ""
                    );

                    $dados['pagina'] = "editar_partido";		
                    $dados['partido'] = getItem($parametrosItem)->row();

                    
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                } 
            }

        }

	public function removerItem($cod = null){
		
		esta_logado();
		acesso('del');
		
		if($cod != null) {
			$this->load->model('crud_model');
			$cod = decodificarString($cod);
			$result = $this->crud_model->delete("xon_partido", "id", array("id" => $cod));
			if($result) {
				if($result['code'] == 0) {//Query executada com sucesso
					//Carrega proxima view
					set_msg('notificacao', 'Registro removido com sucesso', 'success');
                                        redirect("main/partido");
				} else {
					//Carrega proxima view enviando erro para depuração  (array $result)
					
				}
			}
		} else {
			//redireciona informando que um item precisa ser selecionado para remoção
                        redirect("main/partido");
		}
	}
	
}