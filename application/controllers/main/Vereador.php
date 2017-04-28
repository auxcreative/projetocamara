<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vereador extends CI_Controller {

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

	public function gerenciar($offset=0, $limit=13)	{

		esta_logado();

                $parametrosItem = array(
                    "distinct" =>null,
	            "select" => "xon_vereador.id, xon_vereador.nome,
	            			xon_vereador.id_partido, xon_vereador.status, xon_vereador.celular,
                          xon_partido.nome as nome_partido, xon_partido.sigla",
	            "table" => "xon_vereador",
	            "where" => array('vereador.status'=>'A'),
	            "where_not_in"=>null,
	            "order_by" => "xon_vereador.nome asc",
	            "like" => "",
	            "limit" => array($limit, $offset),
	            "group_by" => "",
	            "join" => array('xon_partido' => 'xon_partido.id = xon_vereador.id_partido')
                );

	        $dados = getItem($parametrosItem)->result();

                if($dados != false) {
                    //carrega view com os dados buscados
                    $dados['vereadores'] = $dados;
                    $dados['pagina'] = 'vereador';
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                } else {
                    //carrega view
                    $dados['vereadores'] = null;
                    $dados['pagina'] = 'vereador';
                    set_msg('notificacao', 'Nenhum vereador cadastrado', 'info');
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados), FALSE);
                    load_template();
                }


	}

        public function adicionar() {
        	esta_logado();
			acesso('insert');
			acesso('control');

                $this->form_validation->set_rules('p#nome','Nome','required|trim');

            if($this->form_validation->run()){


		// definimos o path onde o arquivo será gravado
        $path = "./uploads/biografias/";

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
        $configUpload['allowed_types'] = 'jpeg|jpg|png|gif|pdf|zip|rar|doc|xls';
        // definimos que o nome do arquivo

        // passamos as configurações para a library upload
        $this->upload->initialize($configUpload);

        // verificamos se o upload foi processado com sucesso
        if ( ! $this->upload->do_upload('p#imagem'))
        {
            // em caso de erro retornamos os mesmos para uma variável
            // e enviamos para a home
            $data= array('error' => $this->upload->display_errors());
            set_msg('msgerro',$data,'warning');
        }
        else
        {
            //se correu tudo bem, recuperamos os dados do arquivo
            $data['dadosArquivo'] = $this->upload->data();

		}

				$post = elements(array('p#status','p#nome','p#id_partido','p#biografia','p#logradouro','p#cep','p#cidade',
				'p#lideranca_partido','p#legislatura','p#email','p#telefone_fixo','p#celular','p#site'), $this->input->post());

				$post['p#imagem'] = $data['dadosArquivo']['file_name'];


                setItem(null,"xon_vereador",$post, "main/vereador");

            } else {

                    $parametrosPartido = array(
                        "distinct" =>null,
                        "select" => "*",
                        "table" => "partido",
                        "where" => "",
                        "where_not_in"=>null,
                        "order_by" => "nome asc",
                        "like" => "",
                        "limit" => "",
                        "group_by" => "",
                        "join" => ""
                );

                $dados['pagina'] = "novo_vereador";
                $dados['partidos'] = getItem($parametrosPartido)->result();

				set_tema('headerinc', load_css(array('summernote')), FALSE);
				set_tema('footerinc', load_js(array('summernote.min','ckEditorload')), FALSE);    
                set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                load_template();
            }
	}

        public function editar($cod = null){
        	esta_logado();
			acesso('edit');

            if($cod != null) {

                $this->form_validation->set_rules('p#nome','Nome','required|trim');
                $this->form_validation->set_rules('p#id_partido','Partido','required|trim');

        if($this->form_validation->run()){



			$post = elements(array('p#status','p#nome','p#id_partido','p#biografia', 'p#logradouro','p#cep','p#cidade',
				'p#lideranca_partido','p#legislatura','p#email','p#telefone_fixo','p#celular','p#site'), $this->input->post());

        // definimos o path onde o arquivo será gravado
        $path = "./uploads/biografias/";

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
        $configUpload['allowed_types'] = 'jpeg|jpg|png|gif|pdf|zip|rar|doc|xls';
        // definimos que o nome do arquivo

        // passamos as configurações para a library upload
        $this->upload->initialize($configUpload);

        // verificamos se o upload foi processado com sucesso
        if ( ! $this->upload->do_upload('p#imagem'))
        {
            // em caso de erro retornamos os mesmos para uma variável
            // e enviamos para a home
            $data= array('error' => $this->upload->display_errors());
            set_msg('msgerro',$data,'warning');
        }
        else
        {


            //se correu tudo bem, recuperamos os dados do arquivo
            $data['dadosArquivo'] = $this->upload->data();
			$post['p#imagem'] = $data['dadosArquivo']['file_name'];


		}

                    setItem($cod,"xon_vereador",$post, current_url());

                } else {

                    $parametrosItem = array(
                        "distinct" =>null,
                        "select" => "*",
                        "table" => "vereador",
                        "where" => array("id" => decodificarString($cod)),
                        "where_not_in"=>null,
                        "order_by" => "",
                        "like" => "",
                        "limit" => "",
                        "group_by" => "",
                        "join" => ""
                    );

                    $parametrosPartido = array(
                        "distinct" =>null,
                        "select" => "*",
                        "table" => "partido",
                        "where" => "",
                        "where_not_in"=>null,
                        "order_by" => "nome asc",
                        "like" => "",
                        "limit" => "",
                        "group_by" => "",
                        "join" => ""
                    );

                    $dados['pagina'] = "editar_vereador";
                    $dados['vereador'] = getItem($parametrosItem)->row();
                    $dados['partidos'] = getItem($parametrosPartido)->result();

                    set_tema('headerinc', load_css(array('summernote')), FALSE);
					set_tema('footerinc', load_js(array('summernote.min','ckEditorload')), FALSE);    
                    set_tema('conteudo', load_modulo_main($dados['pagina'], $dados));
                    load_template();
                }
            }

        }

	public function remover($cod = null){

		esta_logado();
		acesso('del');
		acesso('control');

		if($cod != null) {
			$this->load->model('crud_model');
			$cod = decodificarString($cod);
			$result = $this->crud_model->delete("xon_vereador", "id", array("id" => $cod));
			if($result) {
				if($result['code'] == 0) {//Query executada com sucesso
					//Carrega proxima view
					set_msg('notificacao', 'Registro removido com sucesso', 'success');
                                        redirect("main/vereador");
				} else {
					//Carrega proxima view enviando erro para depuração  (array $result)

				}
			}
		} else {
			//redireciona informando que um item precisa ser selecionado para remoção
                        redirect("main/vereador");
		}
	}

}
