
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-clock-o"></i> Frequência <small></small>
                            <a href="<?php print base_url('main/frequencia/adicionar'); ?>" class="btn btn-primary btn-lg" style="float: right"><i class="fa fa-plus"></i> Nova Sessão</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-clock-o"></i> Frequência
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
                                <div class="dataTable_wrapper">
                                    <table class="table-responsive table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                            	<th width="">Nome do Vereador</th>
	                                           	<th>Partido</th>
                                            	<th width="100">Ação</th>
                                            </tr>
                                        </thead>
                                        <?php print_r($row); ?>
                                        <tbody>
                                        <?php foreach($vereador as $evento): ?>
                                            <tr>
                                                <td><?php echo $evento -> nome; ?></td>
                                                <td><?php echo $evento -> sigla; ?></td>
                                                <td class="botoes">
											<div class="btn-group btn-group-md" role="group" aria-label="...">
											<input type="hidden" name="url" value="<?php echo base_url('main/frequencia/marcar') ?>" />
											<input type="hidden" name="id_sessao" value="<?php echo $evento->id_sessao; ?>" />
											<input type="hidden" name="id_vereador" value="<?php echo $evento->vereador_id; ?>" />
											<input type="hidden" name="local" value="<?php echo current_url() ?>" />
  											<button name="presente" type="button" value="1" class="btn marcacao <?php echo ($evento->status == 1) ? 'btn-success' : 'btn-default' ?>"><span class="glyphicon glyphicon-ok-sign"></span></button>
  	                                        <button name="falta"  type="button" value="2" class="btn marcacao <?php echo ($evento->status == 2) ? 'btn-danger' : 'btn-default' ?>"><span class="glyphicon glyphicon-remove-sign"></span></button>
											</div>
											</td>
                                            </tr>
                                       	<?php endforeach; ?>
                                        </tbody>
                                        <tfooter>

                                        <tr>
                                        	<td colspan="7" class="text-center"><?php echo paginacao(base_url('main/frequencia/gerenciar'), 'frequencia', "", 14); ?></td>
                                        </tr>
                                        </tfooter>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <script>
					$(document).ready(function() {
						$('#dataTables-example').DataTable({
							responsive : true
						});
					});
			    </script>