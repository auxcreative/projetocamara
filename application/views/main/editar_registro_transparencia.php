
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-plus"></i> Novo Registro de Transparência<small></small>                            
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-newspaper-o"></i> Novo Registro de Transparência
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<!-- AREA DE NOTIFICAÇÃO -->
                
                
                
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                    	
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="container-fluid">
                               	<form action="<?php echo current_url(); ?>" method="POST" class="form-group" enctype="multipart/form-data">
                               
                               	<div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Tipo de Item: </label>                                                
                                              <?php                                                    
                                                    echo $opt_item[''] = '--- Selecione um item ----';                                 
                                                    foreach ($itens as $item): 
													$opt_item[$item->id] = $item->nome;
													endforeach;												
												echo form_dropdown('p#id_item',$opt_item,set_value('p#id_item',$transparencia->id_item),'class="form-control"');
                                               ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Ano: </label>
                                                <input type="number" class="form-control" required  name="p#ano" value="<?php echo $transparencia->ano; ?>" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Mês: </label>
                                                <input type="number" class="form-control" required  name="p#mes" value="<?php echo $transparencia->mes ?>" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Casa/Vereador: </label>
                                                <?php                                                    
                                                    echo $opt_vereador[''] = '--- Selecione um item ----';                                 
                                                    foreach ($vereadores as $vereador): 
													$opt_vereador[$vereador->id] = $vereador->nome;
													endforeach;												
												echo form_dropdown('p#id_destino',$opt_vereador,set_value('p#id_item',$transparencia->id_destino),'class="form-control"');
                                               ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>URL: </label>
                                        <input class="form-control" name="p#url" placeholder="Ex: http://coelhoneto.ma.leg.br/documento.pdf" type="text" value="<?php echo $transparencia->url; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Arquivos: </label>
                                        <input name="p#arquivo" type="file">
                                         <?php echo (!empty($transparencia->arquivo)) ? anchor(base_url('main/transparencia/download/transparencia/'.$transparencia->arquivo),'<span class="glyphicon glyphicon-eye-open"></span> Ver documento'): '' ; ?>
                                    </div>
                                </div>
                                </div>
                                    <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Texto: </label>
                                        <textarea class="form-control" name="p#texto" rows="4"><?php echo $transparencia->texto; ?></textarea>
                                    </div>
                                </div>
                                </div>
                                
                                <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Atualizar</button>
                               		<a class="btn btn-default" href="<?php echo base_url('main/transparencia'); ?>"> Voltar</a>
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