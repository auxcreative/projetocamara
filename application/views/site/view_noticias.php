<div class="page">
    <h1 class="text-center">Notícias</h1> 
    <hr />
</div> 	

	<div class="col-sm-12 noticia">
  <h1 class="text-center"><?php echo $noticia->titulo ?></h1>
  <br />
  <div class="row">
  <div class="col-sm-6">
  <small><b>Por: Editorial</b></small><br />
  <small><?php echo arruma_data($noticia->data_postagem) ?></small>
  </div>
  <div class="col-sm-6">
  	<i class="fa fa-whatsapp fa-2x" aria-hidden="true"> <a href='whatsapp://send?text=<?php echo $noticia->titulo?> site: <?php echo base_url("noticias/acesso/".$noticia->slug) ?>'>compartilhar</a></i> I
  </div>
  </div>
  <div class="row">
  <?php echo $noticia->texto ?>
	</div>
	<br />
	<br />
	<br />
	

</div>