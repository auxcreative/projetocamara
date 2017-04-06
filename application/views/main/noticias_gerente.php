
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            
                           <i class="fa fa-newspaper-o"></i> Notícias <small>Artigos, posts, notícias</small>
                            <a href="<?php print base_url('main/noticias/adicionar'); ?>" class="btn btn-primary btn-lg" style="float: right"><i class="fa fa-plus"></i> Nova Notícia</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-newspaper-o"></i> Notícias
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row --> 
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12"> 
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                <?php if($noticias !=null):  ?>    
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                            	<th width="6%">Publicar</th>
                                                <th width="45%">Título</th>
                                                <th width="10%">Status</th>
                                                <th width="10%">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($noticias as $noticia): ?>
                                            <tr>
                                                <td><?php echo ($noticia->data_postagem) ? arruma_data($noticia->data_postagem) : 'A definir'; ?></td>
                                                <td><?php echo $noticia->titulo; ?></td>
                                                <td><?php echo ($noticia->status == 'p') ? '<span class="glyphicon glyphicon-ok"></span> Pub.' : '<span class="glyphicon glyphicon-remove"></span> Não Pub.'; ?></td>
                                                <td>
                                                	<div class="text-center">
																<a 
																<?php 
																echo (substr($this->session->userdata('user_perfil'), 3,1) == 1) ?' href="noticias/publicar/'.codificarString($noticia->id).'"' : 'disabled="" href="#"';
																?>
																class="btn <?php echo ($noticia->status == 'p') ? 'btn-default' : 'btn-warning'; ?>" alt="Editar" data-toggle="tooltip" title="Publicar Postagem"><i class="fa fa-newspaper-o"></i></a>
                                                                <a href="noticias/editar/<?php echo codificarString($noticia->id) ?>" class="btn btn-default" alt="Editar" data-toggle="tooltip" title="Editar postagem"><i class="fa fa-pencil"></i></a>
                                                                <a href="noticias/removerItem/<?php echo codificarString($noticia->id) ?>" class="btn btn-danger" alt="Excluir" data-toggle="tooltip" title="Remover Postagem"><i class="fa fa-trash"></i></a>
		                                            </div>
                                                </td>
                                            </tr>
                                       	<?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                        	<tr>
                                        		<td colspan="4" class="text-center"><small>Lista de postagens</small></td>
                                        	</tr>
                                        </tfoot>
                                    </table>
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
               


