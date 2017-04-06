<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>XPanel - X-on Sistemas</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php print base_url(); ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php print base_url(); ?>css/sb-admin.css" rel="stylesheet">


</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading" style="text-align: center">
                    	<img src=""  style="alignment-baseline: central" />
                        <p> </p>
                        <h3 class="panel-title">XPanel</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php print base_url(); ?>/loginController/autenticacao" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="loginUsuario" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="senhaUsuario" type="password">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
								<button type="submit" class="btn btn-lg btn-success btn-block"><i class="fa fa-check"></i> Entrar</button>
								
				

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php print base_url(); ?>/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php print base_url(); ?>/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php print base_url(); ?>/js/sb-admin-2.js"></script>

</body>

</html>