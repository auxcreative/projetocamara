
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-flag"></i> Partidos <small></small>
                            <a href="<?php print base_url('main/partido/adicionarPartido'); ?>" class="btn btn-primary btn-lg" style="float: right"><i class="fa fa-plus"></i> Novo Partido</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-newspaper-o"></i> Partidos
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<!-- AREA DE NOTIFICAÇÃO -->



                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                      <?php echo get_msg('msgacesso'); ?>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <?php if($partidos !=null):  ?>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                            	<th width="50">Imagem</th>
                                                <th width="">Nome</th>
                                                <th width="">Sigla</th>
                                                <th width="">Status</th>
                                                <th width="9%">Ações</th>
                                            </tr>
                                        </thead>

                                        <?php foreach($partidos as $partido): ?>
                                            <tr>
                                                <td>
                                                <img src="<?php echo base_url("uploads/partidos/".$partido->imagem); ?>" width="40" height="32" />

                                                	</td>
                                                <td><?php print $partido->nome; ?></td>
                                                <td><?php print $partido->sigla; ?></td>
                                                <td><?php print $partido->status; ?></td>
                                                <td>
                                                    <div class="text-right">
                                                        <a href="partido/editarPartido/<?php print codificarString($partido->id) ?>" title="Editar" class="btn btn-default" alt="Editar"><i class="fa fa-pencil"></i></a>
                                                        <a href="partido/removerItem/<?php print codificarString($partido->id) ?>" title="Excluir" class="btn btn-danger" alt="Excluir"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                       	<?php endforeach; ?>
                                        </tbody>
                                        <tfooter>
                                        <tr>
                                        	<td colspan="5" class="text-center"><?php echo paginacao(base_url('main/partido/gerenciar'), 'partido', "", 10); ?></td>
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
