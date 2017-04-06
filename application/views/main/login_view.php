<br /><br /><br />
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            	<?php get_msg('msgerrologin') ?>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading" style="text-align: center">
                    	<div class="thumbnail">
                    	<img src="<?php echo base_url('images/brasao-coelho-neto.png') ?>"   />   
                    	</div>                     
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo base_url('main/login/autenticacao') ?>" method="post">                          
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="usuario" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="senha" type="password" value="">
                                </div>
                             
                                <!-- Change this to a button or input when using this as a form -->
								<button type="submit" class="btn btn-lg btn-success btn-block"><i class="fa fa-check"></i> Entrar</button>
								
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

