
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-pencil"></i> Editar Vereador<small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-pencil"></i> Editar Vereador
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                    <div class="container-fluid">
                               	<form action="<?php echo current_url(); ?>" method="POST" class="form-group" enctype="multipart/form-data">

                                <div class="row">
                                <div class="col-md-2">
                                    <div class=" thumbnail">
                                    	<?php  echo (!empty($vereador->imagem)) ? img(base_url('uploads/biografias/'.$vereador->imagem)) : '<a style="font-size: 6em;"><i class="fa fa-picture-o"></i></a>'; ?>
                                    </div>
                                    <input type="file" name="p#imagem" />
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Nome: </label>
                                                <input class="form-control" required value="<?php print $vereador->nome ?>" name="p#nome" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-6">
                                    		<div class="form-group">
                                    			<label>Logradouro</label>
                                    			<input type="text" name="p#logradouro" class="form-control" placeholder="Rua x, 1001, Centro" value="<?php print $vereador->logradouro ?>" />
                                    		</div>
                                    	</div>
                                    	                                    	<div class="col-lg-2">
                                    		<div class="form-group">
                                    			<label>CEP</label>
                                    			<input type="text" name="p#cep" class="form-control" placeholder="65620-000" value="<?php print $vereador->cep ?>" />
                                    		</div>
                                    	</div>
                                    	<div class="col-lg-3">
                                    		<div class="form-group">
                                    			<label>Cidade (UF)</label>
                                    			<input type="text" name="p#cidade" class="form-control" placeholder="Coelho Neto (MA)" value="<?php print $vereador->cidade ?>" />
                                    		</div>
                                    	</div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Partido: </label>
                                                <select required="" class="form-control" name="p#id_partido">
                                                    <option value="" >--- Selecione um partido ----</option>
                                                    <?php foreach ($partidos as $partido): ?>
                                                    <option <?php if($vereador->id_partido == $partido->id) {print "selected";} ?>  value="<?php print $partido->id; ?>"><?php print $partido->nome; ?> (<?php print $partido->sigla; ?>)</option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Liderança:</label>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="p#lideranca_partido" value="S" <?php if($vereador->lideranca_partido == 'S') {print " checked";} ?>  />Sim
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="p#lideranca_partido" value="N" <?php if($vereador->lideranca_partido == 'N') {print " checked";} ?> />Não
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Status:</label>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="p#status" value="A" <?php if($vereador->status == 'A') {print " checked";} ?>  />Ativo
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="p#status" value="D" <?php if($vereador->status == 'N') {print " checked";} ?> />Desligado
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-7">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Telefone Fixo: </label>
                                                <input class="form-control" required value="<?php print $vereador->telefone_fixo ?>" name="p#telefone_fixo" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Celular: </label>
                                                <input class="form-control"  value="<?php print $vereador->celular ?>" name="p#celular" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>E-mail: </label>
                                                <input class="form-control"  value="<?php print $vereador->email ?>" name="p#email" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    
                                    	</div>
                                    <div class="row">
                                    	<div class="col-md-5">
                                            <div class="form-group">
                                                <label>Legislatura: </label>
                                                <textarea class="form-control" name="p#legislatura" ><?php print $vereador->legislatura ?></textarea>
                                            </div>
                                    	</div>
                                        <div class="col-lg-6">
                                                <label>Site: </label>
                                                <input class="form-control"  value="<?php print $vereador->site ?>" name="p#site" placeholder="">
                                        </div>                                
                                </div>
                                  <div class="row">
                                 <div class="col-lg-12">
                                    <label>Biografia: </label>
                                    <textarea name="p#biografia" rows="4" class="form-control" id="editor" ><?php print $vereador->biografia ?></textarea>
                                </div>
                             	
                                  </div>
                                <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Avançar</button>
                                     <a class="btn btn-default" href="<?php echo base_url('main/vereador') ?>"> Voltar</a>
                                </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </form>
                            </div>
                            <!-- /.row (nested) -->

                    </div>
                </div>
                <!-- /.row -->
