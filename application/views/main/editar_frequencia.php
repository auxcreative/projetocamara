
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-plus"></i> Nova Frequência <small></small>                            
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-newspaper-o"></i> Nova Frequência
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
                               	<form action="<?php echo current_url(); ?>" method="POST" class="form-group">
                                 <div class="row">
                                	<div class="col-md-2">
                                		<div class="form-group">
                                			<label>Data : </label>
											<input type="text" name="p#data" value="<?php echo arruma_data($frequencia->data) ?>" class="form-control" />
                                		</div>                                		
                                	</div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                            <label>Hora: </label>
                                            <input type="text" class="form-control" required  name="p#hora" placeholder="" value="<?php echo $frequencia->hora ?>" />
                                    </div>
                                </div>
                                </div>
                                
                                <div class="row">
                               <div class="col-lg-5">
                                    <div class="form-group">
                                            <label>Descrição </label>
                                            <textarea class="form-control" required  name="p#descricao" placeholder="Sessão ordinária"><?php echo $frequencia->descricao; ?></textarea>
                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-lg-12">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Avançar</button>
                                <a href="<?php echo base_url('main/frequencia/gerenciar') ?>" class="btn btn-default"> Voltar</a>
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



