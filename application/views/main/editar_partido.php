
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-plus"></i> Editar Partido <small></small>                            
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-newspaper-o"></i> Editar Partido
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
                                <div class="container-fluid">
                               	<form action="<?php echo current_url(); ?>" method="POST" class="form-group" enctype="multipart/form-data">                 
                               	<div class="row">
                                <div class="col-lg-2">
                                	<label>Logo: </label>
                                	<?php echo ($partido->imagem == "") ? '<span class="glyphicon glyphicon-picture"></span>': "<img src='".base_url('uploads/partidos/'.$partido->imagem)."' width='90' height='82' />"; ?> 
                                	<input type="file" name="p#imagem" />
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group"> 
                                                <label>Nome: </label>
                                                <input class="form-control" required  name="p#nome_partido" placeholder="" value="<?php echo $partido->nome_partido; ?>">
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Sigla: </label>
                                                <input class="form-control" required  name="p#sigla" placeholder="" value="<?php print $partido->sigla ?>">
                                            </div> 
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Status:</label>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="p#status" value="A" 
                                                            <?php echo ($partido->status == 'A') ? "checked='checked'": ''; ?>/>Ativo
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="p#status" value="N" 
                                                               <?php echo ($partido->status == 'N') ? "checked='checked'": ''; ?>/>Não ativo
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                                </div>
                                
                                <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit"  class="btn btn-success"><i class="fa fa-check"></i> Avançar</button>
                                	<a class="btn btn-default" href="<?php echo base_url('main/partido') ?>"> Voltar</a>
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