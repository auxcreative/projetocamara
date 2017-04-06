                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-plus"></i> Nova Notícia <small></small>                            
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-newspaper-o"></i> Nova notícia
                            </li>
                        </ol>
                    </div>
                </div>
                <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" <?php echo ($this->session->userdata('tab') != 'active') ? 'class="active"' : ''; ?>><a href="#news" aria-controls="news" role="tab" data-toggle="tab">Nova Notícias</a></li>
    <li role="presentation" <?php echo ($this->session->userdata('tab') == 'active') ? 'class="active"' : ''; ?>><a href="#image" aria-controls="image" role="tab" data-toggle="tab">Banco de Imagem</a></li>

  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" <?php echo ($this->session->userdata('tab') != 'active') ? 'class=" tab-pane active"' : 'class="tab-pane"'; ?> id="news">
                <div class="row">
                    <div class="col-lg-12">                    	
                        <div class="panel panel-default"m style="height: auto">
                            <div class="panel-body">
                                <div class="container-fluid">
                               	<form action="<?php echo current_url(); ?>" method="POST" class="form-group">
                               
                               	<div class="row">
                               		<div class="col-md-2">
                               			<div class="form-group">
                               				<label>Codigo da Pub.</label>
                               				<input type="hidden" name="p#code" value="<?php echo  strtoupper($this->session->userdata('code'));  ?>" />
                               				<input type="text" class="form-control text-center"  value="<?php echo  strtoupper($this->session->userdata('code'));  ?>" readonly="" />
                               			</div>
                               		</div>
                               		
                               		<div class="col-md-2">
                               			<div class="form-group">
                               				<label> Data Pub:</label>
                               				<input type="date" name="p#data_postagem" value="" class="form-control" />
                               			</div>
                               		</div>
                               		                               
                               <div class="col-md-1">                                   
                                            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="p#status" value="n" checked="" >Edição.
                                                </label>
                                            </div>
                               </div>
                               <?php 
                               $controle = $this->session->userdata('user_perfil');
							   if (substr($controle, 3,1) == 1) : ?>
                               <div class="col-md-1">                         
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="p#status" value="p" >Publicar
                                                </label>
                                            </div>
                                </div>	
                            <?php endif; ?>
                               		
                               	</div>
                               	<div class="row">
                                <div class="col-md-12">
                                	<div class="form-group">
                                            <label>Titulo: </label>
                                            <input class="form-control" required  name="p#titulo" placeholder="">
                                        </div>
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-md-12">
                                	<div class="form-group">
                                            <label>Resumo:</label>
                                            <textarea name="p#resumo" class="form-control" rows="2"></textarea>
                                    </div>                          
                                </div>

                                </div>
                                <div class="row">
                                <div class="col-lg-12">
                                	<div class="form-group">
                                            <label>Texto da Notícia:</label>
                                            <textarea name="p#texto" class="form-control" id="editor" rows="8">
											</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-default"><i class="fa fa-check"></i> Cadastrar Notícia</button>
                                	<a href="<?php echo base_url('main/noticias') ?>" class="btn btn-default"><span class="glyphicon glyphicon-triangle-left" ></span> Voltar</a>
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
    </div>
    <!-- Banco de imagens -->
    <div role="tabpanel" <?php echo ($this->session->userdata('tab') == 'active') ? 'class=" tab-pane active"' : 'class="tab-pane"'; ?>   id="image">
    	<div class="row">
    		<div class="col-md-12">
    			<form  action="<?php echo base_url('main/noticias/banco_de_imagem');  ?>" method="POST" enctype="multipart/form-data">
    			<div class="row">
    				<div class="col-md-5">
    					<div class="form-group">
    					<input type="hidden" name="p#code" value="<?php echo  strtoupper($this->session->userdata('code')); ?>" />
    					<input type="file" name="p#url" />
    				</div>
    				</div>
    			</div>     
    				<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-ok"></span> Enviar</button>    	    					
    			</form>
    		</div>    		
    	</div>
    	<br />
    	<div class="row">
    		<div class="col-md-12">
    			<h3>Banco de Imagens</h3>
    			<table class="table">
    				<thead>
    					<tr>
    						<th width="5#">#</th>
    						<th width="12%">Imagem</th>
    						<th width="80%">Url</th>
    					</tr>
    				</thead>
    				<tbody>
    					
    			<?php 
    			$i = 1;
    			foreach($banco as $imagem): ?>
    			<tr>
    				<td><?php echo $i ?></td>
    			<td>
    				<div class="col-md-11">
    				<div class="thumbnail">
    				<img src="<?php echo base_url('uploads/noticias/'.$imagem->url) ?>" />
    				</div>
    				</div>
    			</td>
    			<td>
    				<div class="row">
    					<div class="col-md-6">
    				<input name="url" type="text" class="form-control" readonly="" value="<?php echo base_url('uploads/noticias/'.$imagem->url); ?>" />
    				</div>
    				</div>
    			</td>
    			</tr>
    			<?php 
    			$i++;
    			endforeach; ?>
    			
    			 
    				</tbody>
    			</table>
    		</div>
    	</div>

    	
    </div>
  </div>
</div>
      




