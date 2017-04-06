
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-adjust"></i> Transparência Pública <small></small>
                            <a href="<?php print base_url('main/transparencia/adicionar'); ?>" class="btn btn-primary btn-lg" style="float: right"><i class="fa fa-plus"></i> Novo registro</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-newspaper-o"></i> Transparência Pública
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
                                <div class="table">
                                    <?php if($transparencia!=null):  ?>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                            	<th width="">Tipo</th>
                                                <th width="">Ano</th>
                                                <th width="">Mês</th>
                                                <th width="">Destino</th>
                                                <th width="">Arquivo</th>
                                                <th width="">Data</th>
                                                <th width="">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($transparencia as $_transparencia): ?>
                                            <tr>
                                                <td><?php print $_transparencia->nome; ?></td>
                                                <td><?php print $_transparencia->ano; ?></td>
                                                <td><?php print $_transparencia->mes; ?></td>
                                                <td><?php echo $_transparencia->destino; ?></td>
                                                <td class="text-center"> <?php echo (!empty($_transparencia->arquivo)) ? anchor(base_url('main/trasparencia/download/transparencia/'.$_transparencia->arquivo),'<span class="glyphicon glyphicon-eye-open"></span> Ver'): '<span class="glyphicon glyphicon-alert"></span>' ; ?></td>
               
                                                <td><?php print $_transparencia->data_inc; ?></td>
                                                <td>
                                                    <div class="text-right">
                                                        <a href="<?php echo base_url('main/transparencia/editar/'.codificarString($_transparencia->id)); ?>" title="Editar" class="btn btn-default" alt="Editar"><i class="fa fa-pencil"></i></a>
                                                        <a href="<?php echo base_url('main/transparencia/remover/'.codificarString($_transparencia->id)); ?>" title="Excluir" class="btn btn-default" alt="Excluir"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                       	<?php endforeach; ?>
                                        </tbody>
                                        <tfooter>
                                        <tr>
                                        	<td colspan="7" class="text-center"><?php echo paginacao(base_url('main/transparencia/gerenciar'), 'transparencia', "", 10); ?></td>
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



