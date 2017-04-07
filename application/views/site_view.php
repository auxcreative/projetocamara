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
  	<div class="conteudo container">
  		<div class="row bar-top">
  			<div class="col-md-3 col-sm-6 box-top">
  				<div class="row thumbnail logo">
  				<a href="<?php echo base_url(); ?>">
  				<img src="<?php echo base_url('images/brasao-camara-coelhoneto.png'); ?>" />
  				</a>
  				</div>
  				<div class="row texto">
  				<h6><?php echo 'Coelho Neto, 18 de Outubro de 2016'; ?></h6> 
  				</div>				
  			</div>
 
  				<!-- Single button -->
<div class="btn-group float-right transparencia">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <img src="<?php echo base_url('images/transparencia-icon.png') ?>" /> Portal Transparência <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><?php echo anchor(base_url('lei_de_acesso_a_informacao'),'Lei de acesso à informação') ?></li>
    <li role="separator" class="divider"></li>
    <li><?php echo anchor('http://barrosoptr.dcfiorilli.com.br:2024/SCPIWEB_CMCOELHONETO/','Prestação de contas') ?></li>
    <!--
    <li><?php echo anchor(base_url('prestacao_de_contas/orcamentos_e_financas'),'Orçamentos e finanças') ?></li>
    <li><?php echo anchor(base_url('prestacao_de_contas/licitacoes_e_contratos'),'Licitações e contratos') ?></li>
    -->
    <li role="separator" class="divider"></li>
    <li><?php echo anchor(base_url('prestacao_de_contas/recursos_humanos'),'Recursos Humanos') ?></li>
    <li><?php echo anchor(base_url('prestacao_de_contas/atos_administrativos'),'Atos administartivos') ?></li>
   </ul>
</div>
</div>

  		<div class="row">
  		<div class="col-md-3">
  		<div class="list-group">
  		<a href="#" class="list-group-item active">
    	<strong><span class="icon-caret-left"></span>Instituíção</strong>
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
