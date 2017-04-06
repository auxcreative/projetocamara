
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-plus"></i> Novo Partido <small></small>                            
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-newspaper-o"></i> Novo Partido
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
                                <div class="col-lg-2">
                                    <div style="height: 120px; margin-top: 10px; text-align: center" class="panel panel-default">
                                        <a style="font-size: 6em;"><i class="fa fa-picture-o"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Nome: </label>
                                                <input class="form-control" required  name="p#nome_partido" placeholder="">
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Sigla: </label>
                                                <input class="form-control" required  name="p#sigla" placeholder="">
                                            </div> 
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Status:</label>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="p#status" checked="" value="A" />Ativo
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="p#status" value="N" />Não ativo
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