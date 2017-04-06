
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
                                            	<th width="">Descrição</th>
	                                           	<th width="">Semana<br />Data/Hora</th>
                                            	<th width="">Total<br />Presentes</th>
                                                <th width="">Total<br />Ausentes</th>
                                                <th class="text-center" width="">Justificativas</th>
                                                <th width="110">Atividade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($frequencia as $evento): ?>
                                            <tr>
                                                <td><?php echo $evento -> descricao; ?></td>
                                                <td><?php echo arruma_data($evento -> data).' '.$evento->hora; ?></td>
                                                <td><?php echo ''; ?></td>
                                                <td><?php echo '';  ?></td>
                                                <td>&nbsp;</td>
                                                <td>
                                                	<div class="text-center">
                                                		 <a href="<?php echo base_url('main/frequencia/editar/'.codificarString($evento->id)) ?>" title="Editar sessão" class="btn btn-default" alt="Editar">
                                                		 	<i class="fa fa-pencil"></i></a>
		                                            	<a href="<?php echo base_url('main/frequencia/adicionar_frequencia/'.codificarString($evento->id)) ?>" class="btn btn-info" alt="Fazer frequência"><span class="glyphicon glyphicon-th-list"></span></a>
		                                            </div>
                                                </td>
                                            </tr>
                                       	<?php endforeach; ?>
                                        </tbody>
                                        <tfooter>

                                        <tr>
                                        	<td colspan="7" class="text-center"><?php echo paginacao(base_url('main/frequencia/gerenciar'), 'frequencia', "", 5); ?></td>
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