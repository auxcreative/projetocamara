<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
    <title>{titulo}</title>

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

		<div class="row topslide">
		<div id="carousel-topo" class="carousel slide" data-ride="carousel">
		<div class="col-sm-12 topbar">
			<div class="row">			
			<div class="col-sm-2 col-md-2 hidden-xs logo-topbar">
  				<img src="<?php echo base_url('images/camara-logo-circle.png'); ?>" class="img-responsive" />
  			</div>	
 
		<!-- Single button -->
<div class="col-sm-2 col-sm-offset-7 col-md-2 col-md-offset-8 col-xs-6 col-xs-offset-6 portal-transparencia">
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <img src="<?php echo base_url('images/transparencia-icon.png') ?>" />&nbsp;Transparência&nbsp;<span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><?php echo anchor(base_url('lei_de_acesso_a_informacao'),'Lei de acesso à informação') ?></li>
    <li role="separator" class="divider"></li>
    <li><?php echo anchor('http://barrosoptr.dcfiorilli.com.br:2024/SCPIWEB_CMCOELHONETO/','Prestação de contas') ?></li>
    <li role="separator" class="divider"></li>
    <li><?php echo anchor(base_url('prestacao_de_contas/recursos_humanos'),'Recursos Humanos') ?></li>
    <li><?php echo anchor(base_url('prestacao_de_contas/atos_administrativos'),'Atos administartivos') ?></li>
   </ul>
</div>
</div>
	</div>		
</div>
			<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img src="<?php echo base_url('uploads/topbar/cidade2.jpg') ?>" alt="...">
					</div>
					<div class="item">
						<img src="<?php echo base_url('uploads/topbar/cidade1.jpg') ?>" alt="...">
				</div>
			</div>
		</div> 	
  		</div>  
  	<div class="row">		
  	  <nav class="navbar navbar-default hidden-lg hidden-md">
        <div class="container-fluid ">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img class="img-responsive" src="<?php echo base_url('images/brasao-icon.png') ?>" width="20" height="21" /> </a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
           
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
  	</div>
  	<div class="conteudo container">
  		<div class="row">
  		<div class="col-md-3 hidden-sm hidden-xs">
  		<div class="list-group">
  		<a href="#" class="list-group-item active">
    	<strong>Instituíção</strong>
  		</a>
  		<a href="<?php echo base_url('instituicao/presidencia_da_camara'); ?>" class="list-group-item">Presidente da Câmara</a>
  		<!-- Retirar momentaneamente
  		<a href="<?php echo base_url('instituicao/centro_de_memoria'); ?>" class="list-group-item">Centro de Memória</a>--> 		 		
  		<a href="<?php echo base_url('instituicao/mesa_diretora'); ?>" class="list-group-item">Mesa Diretora</a>
  		<a href="<?php echo base_url('instituicao/regimento_interno'); ?>" class="list-group-item">Regimento Interno</a>
  		<a href="<?php echo base_url('instituicao/ordem_do_dia'); ?>" class="list-group-item">Ordem do Dia</a>  		
  		</div>
  		<div class="list-group">
  		<a href="#" class="list-group-item active">
    	<strong>Vereadores</strong>
  		</a> 
		<a href="<?php echo base_url('vereador/dados_e_contatos'); ?>" class="list-group-item">Dados e Contatos</a>
  		<a href="<?php echo base_url('vereador/lista_de_presenca'); ?>" class="list-group-item">Lista de Presença</a>  		 		
  		<a href="<?php echo base_url('vereador/liderancas'); ?>" class="list-group-item">Lideranças</a> 	
  		</div>
  		<div class="list-group">
  		<a href="#" class="list-group-item active">
    	<strong>Leis e Projetos</strong>
  		</a> 
		<a href="<?php echo base_url('leis/lei_organica'); ?>" class="list-group-item">Lei Orgânica Municipal</a>
  		<a href="<?php echo base_url('leis/legislacao_municipal'); ?>" class="list-group-item">Legislação Municipal</a>  		 		
  		<a href="<?php echo base_url('leis/dados_e_contatos'); ?>" class="list-group-item">Legislação Estadual</a> 
  		<a href="<?php echo base_url('leis/dados_e_contatos'); ?>" class="list-group-item">Legislação Federal</a>	
		</div>
  		</div>
  		<div class="col-md-9">
  		{conteudo}
  		</div>
  		</div>
  	</div>
  	<!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
    {footerinc}
  </body>
</html>

