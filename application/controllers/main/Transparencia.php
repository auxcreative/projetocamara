<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transparencia extends CI_Controller {

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
            
                $parametrosItem = array(
                    "distinct" =>null,
	            "select" => "xon_transparencia.id, xon_transparencia.data_inc, xon_transparencia.id_item,xon_transparencia.ano, 
	            				xon_transparencia.mes, xon_transparencia.id_destino, xon_item_transparencia.nome, 
	            				xon_vereador.id as vereador_id, xon_vereador.nome as destino", 
	            "table" => "xon_transparencia",
	            "where" => "",
	            "where_not_in"=>null,
	            "order_by" => "xon_transparencia.id desc",
	            "like" => "",
	            "limit" => array($limit, $offset),
	            "group_by" => "",
	            "join" => array('xon_item_transparencia' => 'xon_item_transparencia.id = xon_transparencia.id_item',
								'xon_vereador' => 'xon_vereador.id = xon_transparencia.id_destino')
			
                );
		
	        $dados = getItem($parametrosItem)->result();  
	            
                
                if($dados != false) {
                	                    //carrega view com os dados buscados
                    $dados['transparencia'] = $dados;
                    $dados['pagina'] = 'transparencia';
					
					
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                } else {
                    //carrega view
                    $dados['transparencia'] = null;
                    $dados['pagina'] = 'transparencia';
                    set_msg('notificacao', 'Nenhum registro de transparência cadastrado', 'info');
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                }
            

	}
        
        public function adicionar() {

                $this->form_validation->set_rules('p#id_item','Texto','required|trim');

            if($this->form_validation->run()){
            	
		               	
		// definimos o path onde o arquivo será gravado
        $path = "./uploads/transparencia/";
 
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
			$_POST['p#arquivo'] = $data['dadosArquivo']['file_name'];
		} 
                
                $_POST['p#data_inc'] = date("Y-m-d H:i:s");
                setItem(null,"xon_transparencia",$_POST, "main/transparencia");

            } else {
                                  
                    $parametrosItem = array(
                        "distinct" =>null,
                        "select" => "*",
                        "table" => "xon_item_transparencia",
                        "where" => array('status' => 'a'),
                        "where_not_in"=>null,
                        "order_by" => "nome asc",
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
                        "where" => "",
                        "order_by" => "nome asc",
                        "like" => "",
                        "limit" => "",
                        "group_by" => "",
                        "join" => array("xon_partido" => "xon_partido.id = xon_vereador.id_partido")
                    );
                
                $dados['pagina'] = "novo_registro_transparencia";
                $dados['itens'] = getItem($parametrosItem)->result();
                $dados['vereadores'] = getItem($parametrosVereador)->result();
                
                set_tema('tinymce', load_js(array('plugins/tinymce/tinymce.min','tinyMCE')), FALSE);
                set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                load_template();
            } 
	}
        
        public function editar($cod = null){

            if($cod != null) {

      $this->form_validation->set_rules('p#id_item','Texto','required|trim');

      if($this->form_validation->run()){
								
	// definimos o path onde o arquivo será gravado
        $path = "./uploads/transparencia/";
 
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
			$_POST['p#arquivo'] = $data['dadosArquivo']['file_name'];
		} 								
                			
             
       setItem($cod,"xon_transparencia",$_POST, current_url());

       } else {
                    
                    $parametrosTransparencia = array(
                        "distinct" =>null,
                        "select" => "*",
                        "table" => "xon_transparencia",
                        "where" => array('id' => decodificarString($cod)),
                        "where_not_in"=>null,
                        "order_by" => "",
                        "like" => "",
                        "limit" => "",
                        "group_by" => "",
                        "join" => ""
                    );
                    
                    $parametrosItem = array(
                        "distinct" =>null,
                        "select" => "*",
                        "table" => "xon_item_transparencia",
                        "where" => array('status' => 'A'),
                        "where_not_in"=>null,
                        "order_by" => "nome asc",
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
                        "where" => "",
                        "where_not_in"=>null,
                        "order_by" => "nome asc",
                        "like" => "",
                        "limit" => "",
                        "group_by" => "",
                        "join" => array("xon_partido" => "xon_partido.id = xon_vereador.id_partido")
                    );

                    $dados['pagina'] = "editar_registro_transparencia";		
                    $dados['transparencia'] = getItem($parametrosTransparencia)->row();
                    $dados['vereadores'] = getItem($parametrosVereador)->result();
                    $dados['itens'] = getItem($parametrosItem)->result();
                    
                    set_tema('tinymce', load_js(array('plugins/tinymce/tinymce.min','tinyMCE')), FALSE);
                    set_tema('conteudo', load_modulo_main('editar_registro_transparencia', $dados), FALSE);
                    load_template();
                } 
            }

        }

	public function remover($cod = null){
		
		if($cod != null) {
			$this->load->model('crud_model');
			$cod = decodificarString($cod);
			$result = $this->crud_model->delete("xon_transparencia", "id", array("id" => $cod));
			if($result) {
				if($result['code'] == 0) {//Query executada com sucesso
					//Carrega proxima view
					set_msg('notificacao', 'Registro removido com sucesso', 'success');
                                        redirect("main/transparencia");
				} else {
					//Carrega proxima view enviando erro para depuração  (array $result)
					
				}
			}
		} else {
			//redireciona informando que um item precisa ser selecionado para remoção
                        redirect("main/transparencia");
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