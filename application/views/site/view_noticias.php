<div class=container-fluid">
    <h2> Notícias</h2>
    <br/>
    
</div>

	<div class="col-md-12">
  <h1><?php echo $noticia->titulo ?></h1>
  <br />
  <div class="row">
  <?php echo $noticia->texto ?>
	</div>
 
 <a href='whatsapp://send?text=<?php echo $noticia->titulo?> site: <?php echo base_url("noticias/acesso/".$noticia->slug) ?>'>compartilhar</a>
 
</div>