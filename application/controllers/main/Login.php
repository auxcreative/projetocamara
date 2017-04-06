<?php

/**
* Controlador - Login
* X-On Sistemas
*/
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Login extends CI_Controller {
	
    private $loginUsuario;
    private $senhaUsuario;
    private $dadosAutenticados;
    
        public function __construct(){
        parent::__construct();
        init_login();		
    }

    public function index()     {
        
	    set_tema('conteudo', load_modulo_main('login_view'), FALSE);
        load_template();
    }
	
	/** Obtem usuario  */
    public function setAcesso($loginUsuario){
        $this->loginUsuario = $loginUsuario;
    }

    /** Obtem senha  */
    public function setSenha($senhaUsuario){
        $this->senhaUsuario = $senhaUsuario;
    }
  
    private function validaAutenticacaoAcesso()  {
        // Verifica dados informados
		
        if ($this->loginUsuario && $this->senhaUsuario){
        	
            $parametros = array(
            	"distinct"=>null,
                "select" => "usuario.*, perfil.*, perfil.id as perfil_id",
                "table" => "xon_usuario",
        		"where" => array(		   "login" => $this->anti_injection($this->loginUsuario),
                                   "senha" => $this->senhaUsuario,
							   	   "usuario.status"=>'A'),
				"where_not_in"=>null,
                "order_by" => "",
                "like" => "",
                "limit" => "",
                "group_by" => "",
                "join" => array('perfil'=>'perfil.id=usuario.id_perfil')
            );

            // Carrega dados
            $this->load->model('crud_model');
            $dadosAutenticados = $this->crud_model->select($parametros)->row();
            
            if ($dadosAutenticados){

               return $dadosAutenticados; 
            }
            
        }
    }
    
    // remove palavras que contenham sintaxe sql
    private function anti_injection($sqlinj)
    {
        $sqlinj = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|'|´|\*|--|\\\\)/i", '', $sqlinj);
        $sqlinj = trim($sqlinj); //limpa espaços vazio
        $sqlinj = strip_tags($sqlinj); //tira tags html e php
        return $sqlinj;
    }

    public function autenticacao()    {
	
	$this->setAcesso($this->input->post('usuario'));
	$this->setSenha(sha1($this->input->post('senha')));

	$dados = $this->validaAutenticacaoAcesso();
		
        if ($dados) {
            $dados = array(
                'user_nome' => $dados->nome,
                'user_perfil' => $dados->cadastrar.$dados->editar.$dados->deletar.$dados->liberar,
                'user_logado' => true
            );
            
            $this -> session -> set_userdata($dados);
			
			redirect(base_url('main/home'));
        }
        else {
        	set_msg('msgerrologin','Usuário e senha incorretos','warning');
           redirect(base_url('main/login'));
        }
    }
    
    public function fechar_sessao($codNoti,$baseUrl){
		/* Encerra a sessão */
		@session_start();
		$_SESSION = array(); 			 
		session_destroy();

                set_msg('notificacao', 'Sessão encerrada com sucesso', 'success');
                redirect(base_url('main/login'));
		
    }
}
