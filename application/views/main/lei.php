
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-file"></i> Leis <small></small>
                            <a href="<?php print base_url('main/lei/adicionar'); ?>" class="btn btn-primary btn-lg" style="float: right"><i class="fa fa-plus"></i> Nova Lei</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-newspaper-o"></i> Leis
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
                                <div class="table-responsive">
                                    <?php if($leis!=null):  ?>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                            	<th width="">Número</th>
                                                <th width="">Título</th>
                                                <th width="">Ano</th>
                                                <th width="">Arquivo</th>
                                                <th width="">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($leis as $lei): ?>
                                            <tr>
                                                <td><?php print $lei->numero; ?></td>
                                                <td><?php print $lei->titulo; ?></td>
                                                <td><?php print $lei->ano; ?></td>
                                                <td> <?php echo (!empty($lei->arquivo)) ? anchor(base_url('main/lei/download/documentos/'.$lei->arquivo),'<span class="glyphicon glyphicon-eye-open"></span> Ver documento'): '<span class="glyphicon glyphicon-alert"></span> Sem arquivo' ; ?></td>
                                                <td>
                                                    <div class="text-right">
                                                        <a href="lei/editar/<?php print codificarString($lei->id) ?>" title="Editar" class="btn btn-default" alt="Editar"><i class="fa fa-pencil"></i></a>
                                                        <a href="lei/remover/<?php print codificarString($lei->id) ?>" title="Excluir" class="btn btn-danger" alt="Excluir"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                       	<?php endforeach; ?>
                                        </tbody>
										<tfooter>
                                        <tr>
                                        	<td colspan="5" class="text-center"><?php echo paginacao(base_url('main/lei/gerenciar'), 'lei', "", 10); ?></td>
                                        </tr>
                                        </tfooter>
                                    </table>
                                    <?php endif;  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->



