<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
    {titulo}

    <!-- Bootstrap -->

    {headerinc}

    <!-- HTML5 shim e Respond.js para suporte no IE8 de elementos HTML5 e media queries -->
    <!-- ALERTA: Respond.js não funciona se você visualizar uma página file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php base_url('main/home') ?>">xPanel - Painel de Administração</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata('user_nome'); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Perfil </a>
                        </li>
                        <li>
                        	
                            <a href="<?php echo base_url('main/login/fechar_sessao') ?>"><i class="fa fa-fw fa-power-off"></i> Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="<?php print isActive($pagina,"home") ?>">
                        <a href="<?php print base_url("main/home"); ?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="<?php print isActive($pagina,"noticias") ?>">
                        <a href="<?php print base_url("main/noticias"); ?>"><i class="fa fa-fw fa-newspaper-o"></i> Notícias</a>
                    </li>
                    <li class="<?php print isActive($pagina,"frequencia") ?>">
                        <a href="<?php print base_url("main/frequencia"); ?>"><i class="fa fa-fw fa-clock-o"></i> Frequência</a>
                    </li>
                    <li class="<?php print isActive($pagina,"agenda") ?>">
                        <a href="<?php print base_url("main/agenda"); ?>"><i class="fa fa-fw fa-calendar"></i> Agenda</a>
                    </li>
                    <li class="<?php print isActive($pagina,"partido") ?>">
                        <a href="<?php print base_url("main/partido"); ?>"><i class="fa fa-fw fa-flag"></i> Partidos</a>
                    </li>
                    <li class="<?php print isActive($pagina,"vereador") ?>">
                        <a href="<?php print base_url("main/vereador"); ?>"><i class="fa fa-fw fa-certificate"></i> Vereadores</a>
                    </li>
                    <li class="<?php print isActive($pagina,"servidor_publico") ?>">
                        <a href="<?php print base_url("main/servidorPublico"); ?>"><i class="fa fa-fw fa-users"></i> Servidores Públicos</a>
                    </li>
                    <li class="<?php print isActive($pagina,"lei") ?>">
                        <a href="<?php print base_url("main/lei"); ?>"><i class="fa fa-fw fa-files-o"></i> Leis</a>
                    </li>
                    <li class="<?php print isActive($pagina,"transparencia") ?>">
                        <a href="<?php print base_url("main/transparencia"); ?>"><i class="fa fa-fw fa-adjust"></i> Transparência</a>
                    </li>
                    <li class="<?php print isActive($pagina,"mesa_diretora") ?>">
                        <a href="<?php print base_url("main/mesa_diretora"); ?>"><i class="fa fa-fw fa-star"></i> Mesa Diretora</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
	<div class="row">
	<div class="col-md-12">
	<div class="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading 
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                        
                        
                    </div>
                </div>
                -->
                      
      
      <?php
      if(getNotificacao() != false) { 
         print getNotificacao();
      } ?>
      <div class="row">
               {conteudo}
                <!-- /.row -->
				</div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  </div>
 </div>
 </div>
 </div>
      
      
      

{footerinc}

  </body>
</html>