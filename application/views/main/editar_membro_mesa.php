
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-pencil"></i> Editar Membro da Mesa Diretora <small></small>                            
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-pencil"></i> Editar Membro da Mesa Diretora
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

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
                                                
                                                
                                                <?php 
                                                $opt[''] = '--- Selecione a função ----';
												$opt['Presidente'] = 'Presidente';
												$opt['1º Vice-Presidente'] = '1º Vice-Presidente';
												$opt['2º Vice-Presidente'] = '2º Vice-Presidente';
												$opt['1º Secretário'] = '1º Secretário';
												$opt['2º Secretário'] = '2º Secretário';
												
												echo form_dropdown('p#funcao', $opt, set_value('p#funcao', $membro->funcao),'class="form-control"');
												?>
                                            </div>
                                        </div>
                                         <div class="col-md-3">
                                        	<div class="form-group">
                                        		<label>Biênio</label>
                                        		<input class="form-control" type="text" name="p#bienio" value="<?php echo $membro->bienio ?>" placeholder="EX: 2017-2018" />
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
                                                    	
                                                        <option <?php if($membro->id_vereador == $vereador->id) {print "selected";} ?> value="<?php print $vereador->id; ?>"><?php print $vereador->nome; ?> (<?php print $vereador->sigla; ?>)</option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Status:</label>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="p#status" value="a" <?php if($membro->status == 'a') {print " checked";} ?> />Ativo
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="p#status" value="n" <?php if($membro->status == 'n') {print " checked";} ?> />Não ativo
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
                                    <a href="<?php echo base_url('main/mesa_diretora/'); ?>" class="btn btn-default"> Sair</a>
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