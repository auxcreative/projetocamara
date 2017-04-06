
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-plus"></i> Novo Membro da Mesa Diretora <small></small>                            
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-newspaper-o"></i> Novo Membro da Mesa Diretora
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<!-- AREA DE NOTIFICAÇÃO -->

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                    	
                        <div class="panel panel-default" style="height: auto">
                            <div class="panel-body">
                                <div class="container-fluid">
                               	<form action="<?php echo current_url(); ?>" method="POST" class="form-group">
                               
                               	<div class="row">
                                <div class="col-lg-12">
                                    
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Função: </label>
                                                <select required class="form-control" name="p#funcao">
                                                    <option value="" >--- Selecione a função ----</option>
                                                    <option value="Presidente" >Presidente</option>
                                                    <option value="1º Vice-Presidente" >1º Vice-Presidente</option>
                                                    <option value="2º Vice-Presidente" >2º Vice_Presidente</option>
                                                    <option value="1º Secretário" >1º Secretário</option>
                                                    <option value="2º Secretário" >2º Secretário</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                        	<div class="form-group">
                                        		<label>Biênio</label>
                                        		<input type="text" class="form-control" name="p#bienio" value="" placeholder="EX: 2017-2018" />
                                        	</div>
                                        </div>
                                       </div>
                                        		
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Vereador: </label>
                                                <select required="" class="form-control" name="p#id_vereador">
                                                    <option value="" >--- Selecione um vereador ----</option>
                                                    <?php foreach ($vereadores as $vereador): ?>
                                                        <option value="<?php print $vereador->id; ?>"><?php print $vereador->nome; ?> (<?php print $vereador->sigla; ?>)</option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Status:</label>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="p#status" value="a" />Ativo
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="p#status" value="n" />Não ativo
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                                </div>
                                
                                <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Avançar</button>
                                    <a href="<?php echo base_url('main/mesa_diretora'); ?>" class="btn btn-default"> Sair</a>
                                </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </form>
                            </div>
                            <!-- /.row (nested) -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->