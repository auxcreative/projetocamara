
                <!-- Page Heading -->
                <div class="row">
                	<div class="col-lg-12"><?php get_msg('msgerro'); ?></div>
                    <div class="col-lg-12">                    	
                        <h1 class="page-header">
                           <i class="fa fa-pencil"></i> Editar Lei <small></small>                            
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-pencil"></i> Editar Lei
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<!-- AREA DE NOTIFICAÇÃO -->

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                    	
                        <div class="panel panel-default" style="height: auto">
                            <div class="panel-body">
                                <div class="container-fluid">
                               	<form action="<?php echo current_url(); ?>" method="POST" class="form-group" enctype="multipart/form-data">
                               
                               	<div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label>Título: </label>
                                                <input class="form-control" required value="<?php print $lei->titulo; ?>" name="p#titulo" placeholder="">
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Número: </label>
                                                <input class="form-control" type="text" required value="<?php print $lei->numero; ?>" name="p#numero" placeholder="">
                                            </div> 
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Ano: </label>
                                                <input class="form-control" type="text" required value="<?php print $lei->ano; ?>" name="p#ano" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Publicação: </label>
                                                <input class="form-control" type="text" value="<?php echo arruma_data($lei->publicacao); ?>" name="p#publicacao" placeholder="EX: 01/01/2017">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Arquivo: </label>
                                                <input  type="file"  name="p#arquivo" />
                                                <?php echo (!empty($lei->arquivo)) ? anchor(base_url('main/lei/download/documentos/'.$lei->arquivo),'<span class="glyphicon glyphicon-eye-open"></span> Ver documento'): '' ; ?>
                                            </div>
                                        </div>
                                        
                                    </div> 
                                    <div class="row">
                                   	<div class="col-md-5">
                                        <div class="form-group">
                                        	<label>Ementa:</label>
                                        	<textarea type="text" class="form-control" name="p#ementa"><?php echo $lei->ementa ?></textarea>
                                        </div>
                                        </div>
                                   	<div class="col-md-5">
                                        <div class="form-group">
                                        	<label>Autor:</label>
                                        	<textarea type="text" class="form-control" name="p#autor"><?php echo $lei->autor ?></textarea>
                                        </div>
                                        </div>
                                    </div> 
                                </div>
                                </div>
                                
                                <div class="row">
                                <div class="col-lg-12">
                                    
                                     <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Avançar</button>
                                    <a href="<?php echo base_url('main/lei'); ?>" class="btn btn-default"> Sair</a>
                                </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </form>
                            </div>
                            <!-- /.row (nested) -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->