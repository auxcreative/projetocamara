<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    public function do_insert($dados=NULL, $redir=TRUE){
       if($dados != NULL):
           $dados['status'] = 'A';
           $this->db->insert('usuario',$dados);
           set_msg('msgok','Cadastro efetuado com sucesso','sucesso');
           if($redir) redirect(current_url());
       endif;
    }

    public function do_insert_perfil($dados=NULL, $redir=TRUE){
       if($dados != NULL):
           $this->db->insert('perfil',$dados);
           set_msg('msgok','Cadastro efetuado com sucesso','sucesso');
           if($redir) redirect(current_url());
       endif;
    }
    public function do_update_perfil($dados=NULL, $condicao=NULL, $redir=TRUE){
        if($dados != NULL && is_array($condicao)):
            $this->db->update('perfil',$dados, $condicao);
            set_msg('msgok','Alteração efetuada com sucesso','sucesso');
            if($redir) redirect('webplataforma/myusers/editar_perfil/'.$condicao['id']);
        endif;
    }   
    public function do_update($dados=NULL, $condicao=NULL, $redir=TRUE){
        if($dados != NULL && is_array($condicao)):
            $this->db->update('usuario',$dados,$condicao);
            set_msg('msgok','Alteração efetuada com sucesso','sucesso');
            if($redir) redirect('webplataforma/myusers/editar/'.$condicao['id']);
        endif;
    }

    public function delete_perfil($condicao=NULL, $redir=TRUE){
        if($condicao != NULL && is_array($condicao)):
        $this->db->delete('perfil',$condicao);
            if($this->db->affected_rows()>0):
             set_msg('msgok','Registro excluído com sucesso','sucesso');
            else:
             set_msg('msgerro','Erro ao tentar excluír registro','erro');
            endif;
            if($redir) redirect(current_url());
        endif;
    } 
    
    public function delete($condicao=NULL, $redir=TRUE){
        if($condicao != NULL && is_array($condicao)):
        $this->db->delete('usuario',$condicao);
            if($this->db->affected_rows()>0):
             set_msg('msgok','Registro excluído com sucesso','sucesso');
            else:
             set_msg('msgerro','Erro ao tentar excluír registro','erro');
            endif;
            if($redir) redirect('webplataforma/myusers/gerenciar');
        endif;
    }

	public function get_byusuario($id=NULL){

        if($id != NULL):
        return    $this->db->select('usuario.id, usuario.login, usuario.status, usuario.id_empresa,
        							usuario.cpf, usuario.login,	perfil.id as id_perfil')
						->from('usuario')
						->join('perfil','perfil.id=usuario.id_perfil')
       					->where('usuario.id', $id)						
                     	->limit(1)
             			->get();            
        else:
            return FALSE;
        endif;		

	}
	
	public function get_byempresa($id=NULL){
		
		if($id != NULL):
			return $this->db->select('empresa.id, empresa.fantasia,
									  revenda.id_cidade, revenda.id_bairro, 
									  revenda.id_uf, cidade.id as cidade_id')
						->from('revenda')
						->join('cidade','revenda.id_cidade=cidade.id')
						->where('revenda.id',$id)
						->get();
			endif;
		
	}
    
    public function do_login($usuario=NULL, $senha=NULL){
			
			if($usuario != NULL):
			$qry = ("SELECT * FROM xon_usuario WHERE (login = '$usuario' OR cpf = '$usuario') AND senha = '$senha' AND status = 'A' limit 1");
            
            $query = $this->db->query($qry);
			 
			if ($query->num_rows() == 1):
                    return TRUE;
                else:
                    return FALSE;
                endif; 
				
				 else:
					 return FALSE;
				endif;			                     
         
    }

    public function get_bylogin($login=NULL){
        if($login != NULL):
        return    $this->db->or_where(array('login'=>$login,'cpf'=>$login))						
                     ->limit(1)
             		->get('usuario');            
        else:
            return FALSE;
        endif;

    }

    public function get_byemail($email=NULL){
        if($email != NULL):
            $this->db->where('email',$email);
            $this->db->limit(1);
            return $this->db->get('usuario');
        else:
            return FALSE;
        endif;
    }

    //retorna user para alterar
    public function get_byidperfil($id=NULL){
                if($id != NULL):
            $this->db->where('id',$id)
                     ->limit(1);
            return $this->db->get('perfil');
            
        else:
            return FALSE;
        endif;      
                
    }
    
    //retorna user para alterar
    public function get_byid($id=NULL){
                if($id != NULL):
            $this->db->where('id',$id)
                     ->limit(1);
            return $this->db->get('usuario');
            
        else:
            return FALSE;
        endif;      
                
    }

    //Retorna o perfil
    public function get_usuario(){
    	
        	return $this->db->get('usuario');
		
    }
     		
    //Retorna o perfil
    public function get_perfil(){
    	
        	return $this->db->get('perfil');
		
    }
    }
/* End of file usuarios.php */
/* Location */