
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
                                                <select required="" class="form-control" name="p#id_item">
                                                    <option value="" >--- Selecione um item ----</option>
                                                    <?php foreach ($itens as $item): ?>
                                                        <option value="<?php print $item->id; ?>"><?php print $item->nome; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Ano: </label>
                                                <input type="number" class="form-control" required  name="p#ano" value="<?php echo date('Y'); ?>" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Mês: </label>
                                                <input type="number" class="form-control" required  name="p#mes" value="<?php echo date('m') ?>" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Casa/Vereador: </label>
                                                <select required="" class="form-control" name="p#id_destino">
                                                    <option value="" >--- Selecione um destino ----</option>
                                                    <?php foreach ($vereadores as $vereador): ?>
                                                        <option value="<?php print $vereador->id; ?>"><?php print $vereador->nome; ?> (<?php print $vereador->sigla; ?>)</option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>URL: </label>
                                        <input class="form-control" name="p#url" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Arquivos: </label>
                                        <input name="p#arquivo" type="file">
                                    </div>
                                </div>
                                </div>
                                    <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Texto: </label>
                                        <textarea class="form-control" name="p#texto" rows="4"></textarea>
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