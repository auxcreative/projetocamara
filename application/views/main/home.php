
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-newspaper-o"></i> xPanel - Início <small></small>
                            <a href="?/main/Noticias/adicionarNoticia" class="btn btn-primary btn-lg" style="float: right"><i class="fa fa-plus"></i> Nova Notícia</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-newspaper-o"></i> Início
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row --> 
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                    	<div class="row">
                    		<div class="col-md-6 col-md-offset-3 text-center"><?php get_msg('msgacesso'); ?></div>
                    	</div> 
                        <div class="panel panel-default">                        	
                            <div class="panel-body">
                                              <div class="row">
                    <div class="col-lg-12"> 
                        <div class="panel panel-default">
                            <div class="panel-body">
                            	<div class="row">
                            		<div class="col-md-8">
                                <div class="table-responsive">
                                <?php if($noticias !=null):  ?>    
                                    <table class="table table-hover table-striped">
                                    	<legend>Postagens para edição</legend>
                                        <thead>
                                            <tr>
                                            	<th>Título</th>
                                                <th>&nbsp;</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($noticias as $noticia): ?>
                                            <tr>
                                            	<td>
                                                <?php echo ($noticia->data_postagem) ? arruma_data($noticia->data_postagem).' - '.$noticia->titulo.br() : 'A definir'.' - '.$noticia->titulo.br(); ?>
														<a 
																<?php 
																echo (substr($this->session->userdata('user_perfil'), 3,1) == 1) ?' href="noticias/publicar/'.codificarString($noticia->id).'"' : 'disabled="" href="#"';
																?>
																class="btn <?php echo ($noticia->status == 'p') ? 'btn-default' : 'btn-warning'; ?>" alt="Editar" data-toggle="tooltip" title="Publicar"><i class="fa fa-newspaper-o"></i></a>
                                                                <a href="home/editar/<?php echo codificarString($noticia->id) ?>" class="btn btn-default" alt="Editar" data-toggle="tooltip" title="Visualizar Post"><i class="fa fa-eye"></i></a>
                                                                <a href="home/removerItem/<?php echo codificarString($noticia->id) ?>" class="btn btn-default" alt="Excluir" data-toggle="tooltip" title="Remover Postagem"><i class="fa fa-trash"></i></a>
											   </td>
                                                <td><i class="fa fa-clock-o"></i></td>
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
                    </div>
                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
               


