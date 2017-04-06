<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

	/** Modelo - Persistência de dados princial
	* ENCOCO 2016
	*/

class Crud_model extends CI_Model{

        public function __construct(){
        parent::__construct();
        $this->load->database();
	}


	public function select($parametros = array(), $opcao = TRUE){
        /* ---------------------------------------------------------------------
         * VERIFICAÇÕES DE CAMPOS NULOS 
         * --------------------------------------------------------------------- */
        if (!$parametros['select'])
        {
            show_error("Por favor, informe um parâmetro para a seleção", 500, "Sem parâmetro para que a pesquisa seja realizada");
            exit;
        }

        if (!$parametros['table'])
        {
            show_error("Por favor, informe uma tabela para a seleção", 500, "Sem parâmetro para que a pesquisa seja realizada");
            exit;
        }
        /* ---------------------------------------------------------------------
         * FIM DA VERIFICAÇÕES DE CAMPOS NULOS 
         * --------------------------------------------------------------------- */
         
         
  		//Faz busca com resultados distintos
		if ($parametros['distinct']){
				$this->db->distinct($parametros['distinct']);			
		}    
		

		
		
        // Seleciona os campos necessários mediante o parâmetro passado
        $this->db->select($parametros['select'], $opcao);

        //Seleciona a tabela para que os dados seja retornados
        $this->db->from($parametros['table']);

        /*
         * WHERE (CONDIÇÃO)
         * 
         * Se você configurá-lo para FALSE, CodeIgniter não vai tentar proteger 
         * o seu campo ou nomes de tabelas com acentos graves. 
         * Isso é útil se você precisar de uma declaração SELECT.
         */		
         if ($parametros['where_not_in'])
        {
            $this->db->where_not_in($parametros['where_not_in'][0], $parametros['where_not_in'][1]);
        }           
		
        if ($parametros['where'])
        {
            $this->db->where($parametros['where']);
        }
		
        // Ordena os resultado segundo o parâmetro passado
        if ($parametros['order_by'])
        {
            $this->db->order_by($parametros['order_by']);
        }
        
        // Ordena os resultado segundo o parâmetro passado
        if ($parametros['like'])
        {
            $this->db->like($parametros['like']);
        }

        // Retorna os resultado limitados ao parâmetro passado
        if ($parametros['limit'])
        {
            $retorno = $parametros['limit'];
            $this->db->limit($retorno[0], $retorno[1]);
        }

        // Retorna os resultado limitados ao parâmetro passado
        if ($parametros['group_by'])
        {
            $this->db->group_by($parametros['group_by']);
        }

        // Permite que você para escrever a parte do JOIN de sua consulta:
        if ($parametros['join'])
        {
            foreach ($parametros['join'] as $key => $value)
            {
                $this->db->join($key, $value, "inner");
            }
        }

        // retorna o resultado em forma de um array de objeto
        $query = $this->db->get();
        $result_erro = $this->db->error();
        if ($result_erro['code']!= 0) {
           return $this->db->error(); 
		}
        else {
            return $query;
        }
    }

	public function insert($table, $array) {
    $this->db->insert($table, $array);
    
	$result_erro = $this->db->error(); 
	// retorna o id a inserção
        if ($result_erro['code']!= 0 ) {
           return $this->db->error(); 

        }else {
        	return $this->db->insert_id();

        }   
    }
	
	public function count_rows($table, $all, $pm_a, $v_a, $pm_b, $v_b){
		
		if($all == true){
			$query = $this->db->query("SELECT * FROM $table");	
			return $query->num_rows();
		} else {
			$query = $this->db->query("SELECT * FROM $table WHERE $pm_a = '$v_a' AND $pm_b = '$v_b'");
			return $query->num_rows();
		}	
	
	}
	
	public function delete($table, $id_name, $array){
        if ($id_name != "")
        {
            $this->db->where($id_name, $array[$id_name]);
        }
        $this->db->delete($table);
        if ($this->db->error())
        {
           return $this->db->error(); 
        }
        else
        {
            return true;
        }
    }
	
	public function update($table, $parametro = "", $dados) {
		
		
		if(is_array($parametro)){
							
			$this->db->update($table, $dados, $parametro);
				
		if ($this->db->error()){
           return $this->db->error(); 
        }
        else
        {
            return true;
        }		
			
		} else {
		
       	$this->db->where($parametro, $dados[$parametro]);
        $this->db->update($table, $dados);
		
        if ($this->db->error()){
           return $this->db->error(); 
        }
        else
        {
            return true;
        }
    }
    
	
}
}
