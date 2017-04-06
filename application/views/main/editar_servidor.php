
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-pencil"></i> Editar Servidor Público<small></small>                            
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-pencil"></i> Editar Servidor Público
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
                               	<form action="<?php echo current_url(); ?>" method="POST" class="form-group">
                               
                               	<div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Nome: </label>
                                                <input class="form-control" value="<?php print $servidor->nome; ?>" required  name="p#nome" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>CPF: </label>
                                                <input class="form-control" value="<?php print $servidor->cpf; ?>" required  name="p#cpf" placeholder="">
                                            </div> 
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>RG: </label>
                                                <input class="form-control" required value="<?php print $servidor->rg; ?>"  name="p#rg" placeholder="">
                                            </div> 
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Telefone: </label>
                                                <input class="form-control" required value="<?php print $servidor->telefone; ?>" name="p#telefone" placeholder="">
                                            </div> 
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Data de Nascimento: </label>
                                                <input class="form-control" required value="<?php print $servidor->data_nascimento; ?>" name="p#data_nascimento" placeholder="">
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Endereço Completo: </label>
                                                <input class="form-control" required value="<?php print $servidor->logradouro; ?>" name="p#logradouro" placeholder="">
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>E-mail: </label>
                                                <input class="form-control" required value="<?php print $servidor->email; ?>" name="p#email" placeholder="">
                                            </div> 
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Cargo: </label>
                                                <select required="" class="form-control" name="p#id_cargo">
                                                    <option value="" >--- Selecione um cargo ----</option>
                                                    <?php foreach ($cargos as $cargo): ?>
                                                    <option <?php if($servidor->id_cargo == $cargo->id) {print "selected='selected'";} ?> value="<?php print $cargo->id; ?>"><?php print $cargo->cargo; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Salário: </label>
                                                <input class="form-control" required value="<?php print $servidor->salario; ?>" name="p#salario" placeholder="">
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                </div>
                                
                                <div class="row">
                                <div class="col-lg-12">
                                    
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Atualizar</button>
                               		<a class="btn btn-default" href="<?php echo base_url('main/servidorpublico'); ?>"> Voltar</a>
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