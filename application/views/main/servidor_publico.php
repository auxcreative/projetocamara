
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-users"></i> Servidores Públicos <small></small>
                            <a href="<?php print base_url('main/servidorPublico/adicionar'); ?>" class="btn btn-primary btn-lg" style="float: right"><i class="fa fa-plus"></i> Novo Servidor</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-newspaper-o"></i> Servidores Públicos
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
                                    <?php if($servidores!=null):  ?>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                            	<th width="">Nome</th>
                                                <th width="">CPF</th>
                                                <th width="">Telefone</th>
                                                <th width="">Cargo</th>
                                                <th width="">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($servidores as $servidor): ?>
                                            <tr>
                                                <td><?php print $servidor->nome; ?></td>
                                                <td><?php print $servidor->cpf; ?></td>
                                                <td><?php print $servidor->telefone; ?></td>
                                                <td><?php print $servidor->cargo; ?></td>
                                                <td>
                                                    <div class="text-right">
                                                        <a href="<?php echo base_url('main/servidorpublico/editar/'.codificarString($servidor->id)) ?>" title="Editar" class="btn btn-default" alt="Editar"><i class="fa fa-pencil"></i></a>
                                                        <a href="servidorPublico/remover/<?php echo base_url('main/servidorpublico/remover/'.codificarString($servidor->id)); ?>" title="Excluir" class="btn btn-default" alt="Excluir"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                       	<?php endforeach; ?>
                                        </tbody>
										<tfooter>
                                        <tr>
                                        	<td colspan="5" class="text-center"><?php echo paginacao(base_url('main/servidorpublico/gerenciar'), 'servidor_publico', "", 10); ?></td>
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



