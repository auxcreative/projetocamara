
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-certificate"></i> Vereadores <small></small>
                            <a href="<?php print base_url('main/vereador/adicionar'); ?>" class="btn btn-primary btn-lg" style="float: right"><i class="fa fa-plus"></i> Novo Vereador</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-newspaper-o"></i> Vereadores
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
		<!-- AREA DE NOTIFICAÇÃO -->

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                    	<?php get_msg('msgerro') ?>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table">
                                    <?php if($vereadores!=null):  ?>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                            	<th width="">Nome</th>
                                                <th width="">Partido</th>
                                                <th width="">Celular</th>
                                                <th width="">Status</th>
                                                <th width="">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($vereadores as $vereador): ?>
                                            <tr>
                                                <td><?php print $vereador->nome; ?></td>
                                                <td><?php print $vereador->sigla; ?> - <?php print $vereador->nome_partido; ?></td>
                                                <td><?php print $vereador->celular; ?></td>
                                                <td><?php print $vereador->status; ?></td>
                                                <td>
                                                    <div class="text-right">
                                                        <a href="vereador/editar/<?php print codificarString($vereador->id) ?>" title="Editar" class="btn btn-primary" alt="Editar"><i class="fa fa-pencil"></i></a>
                                                        <a href="vereador/remover/<?php print codificarString($vereador->id) ?>" title="Excluir" class="btn btn-danger" alt="Excluir"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                       	<?php endforeach; ?>
                                        </tbody>
                                       <tfooter>
                                        <tr>
                                        	<td colspan="5" class="text-center"><?php echo paginacao(base_url('main/vereador/gerenciar'), 'vereador', "", 13); ?></td>
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



