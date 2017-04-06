
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-calendar"></i> Agenda <small></small>
                            <a href="<?php print base_url('main/agenda/adicionar'); ?>" class="btn btn-primary btn-lg" style="float: right"><i class="fa fa-plus"></i> Novo Compromisso</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-calendar"></i> Agenda
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
                                            	<th width="">Tipo Evento</th>
                                            	<th width="">Evento</th>
                                            	<th width="">Local</th>
                                                <th width="100">Data</th>
                                                <th width="150">Hora</th>
                                                <th class="text-center" width="150">Status</span></th>
                                                <th width="120">Atividade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($agenda as $evento): ?>
                                            <tr>
                                                <td><?php echo $evento -> nome_evento.'     '.$evento->id; ?></td>
                                                <td><?php echo $evento -> evento; ?></td>
                                                <td><?php print $evento -> local; ?></td>
                                                <td><?php print arruma_data($evento -> data); ?></td>
                                                <td><?php print $evento -> horaInicio . ' - ' . $evento -> horaTermino; ?></td>
                                                <td class="text-center">
                                                	<?php 
                                                	
                                                	if($evento->data < date('Y-m-d')):														
														echo '<span class="glyphicon glyphicon-ok"> Encerrado</span>';
													else:
														echo ($evento -> horaTermino < date('H:i:s')) ? '<span class="glyphicon glyphicon-ok"> Encerrado</span>' : '<span class="glyphicon glyphicon-hourglass"> Aberto</span>';
													endif;?>
                                                	
                                                	</td>
                                                <td>
                                                	<div class="text-right">
                                                		 <a href="agenda/editar/<?php echo codificarString($evento->id) ?>" title="Editar" class="btn btn-default" alt="Editar">
                                                		 	<i class="fa fa-pencil"></i></a>
		                                            	<a class="btn btn-default" alt="Excluir"><i class="fa fa-search"></i></a>
		                                            </div>
                                                </td>
                                            </tr>
                                       	<?php endforeach; ?>
                                        </tbody>
                                        <tfooter>
                                        <tr>
                                        	<td colspan="7" class="text-center"><?php echo paginacao(base_url('main/agenda/gerenciar'), 'agenda', "", 3); ?></td>
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