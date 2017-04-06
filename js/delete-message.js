/**
 * @author Elesbao
 */
       $(document).ready(function(){
                    $('.deletareg').click(function() {
                        if(confirm("Deseja relamente excluír este registro\nEsta operação não podera ser desfeita")) return true; 
                        else                        
                        return false;
                    });
                    
                });