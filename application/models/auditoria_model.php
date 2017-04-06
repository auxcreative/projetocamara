<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auditoria_model extends CI_Model {

    public function do_insert($dados=NULL, $redir=FALSE){
       if($dados != NULL):
           $this->db->insert('auditoria',$dados);
           set_msg('msgok','Cadastro efetuado com sucesso','sucesso');
           if($redir) redirect(current_url());
       endif;
    }
    public function get_all(){
        return $this->db->get('auditoria');
    }
    
    //retorna user para alterar
    public function get_byid($id=NULL){
                if($id != NULL):
            $this->db->where('id',$id)
                     ->limit(1);
            return $this->db->get('auditoria');
            
        else:
            return FALSE;
        endif;      
                
    }
    }
/* End of file auditoria_model.php */
/* Location application/models/auditoria_model.php*/