
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-star"></i> Mesa Diretora <small></small>
                            <a href="<?php print base_url('main/mesa_diretora/adicionar'); ?>" class="btn btn-primary btn-lg" style="float: right"><i class="fa fa-plus"></i> Novo membro</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-star"></i> Mesa Diretora
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
                                    <?php if($mesa!=null):  ?>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                            	<th width="">Função</th>
                                                <th width="">Vereador</th>
                                                <th width="">Biênio</th>
                                                <th width="">Status</th>
                                                <th width="">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($mesa as $_mesa): ?>
                                            <tr>
                                                <td><?php print $_mesa->funcao; ?></td>
                                                <td><?php print $_mesa->nome; ?></td>
                                                <td><?php print $_mesa->bienio; ?></td>
                                                <td><?php print $_mesa->status; ?></td>
                                                <td>
                                                    <div class="text-right">
                                                        <a href="mesa_diretora/editar/<?php print codificarString($_mesa->id) ?>" title="Editar" class="btn btn-default" alt="Editar"><i class="fa fa-pencil"></i></a>
                                                        <a href="mesa_diretora/remover/<?php print codificarString($_mesa->id) ?>" title="Excluir" class="btn btn-danger" alt="Excluir"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                       	<?php endforeach; ?>
                                        </tbody>
                                       <tfooter>
                                        <tr>
                                        	<td colspan="5" class="text-center"><?php echo paginacao(base_url('main/mesa_diretora/gerenciar'), 'mesa_diretora', "", 10); ?></td>
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



