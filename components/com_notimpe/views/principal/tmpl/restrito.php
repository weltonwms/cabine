<?php if(!isset($this->pdf)):?>
<div class="edicoes_anteriores">
    <?php $link= JRoute::_("?option=com_notimpe&view=principal&layout=edicoes_anteriores");?>
    <a href="<?php echo $link?>">Edições Anteriores <i class="icon-chevron-right"></i></a>
</div>
<?php endif;?>

<?php if($this->items):?>


<h4 class="notimpe_nr_notimpe">Notimpe <?php
    echo $this->dados_notimpe->nr_notimpe .
    "/{$this->dados_notimpe->ano} - {$this->dados_notimpe->data}";

    $url = JRoute::_("?option=com_notimpe&view=principal&layout=detail&id=" . JRequest::getVar('id'));
    ?>
</h4>
<?php if(!isset($this->pdf)):?>
<a class="btn" href="<?php echo "$url&format=pdf"?>">Imprimir PDF</a>
<?php endif;?>
<div class="notimpe_ancoras">
    <?php foreach ($this->items as $grupo_veiculo): ?>

        <a href="<?php echo $url . "#titulo_veiculo" . $grupo_veiculo->id_veiculo ?>" class="nome_veiculo_ancora"><?php echo $grupo_veiculo->nome_veiculo ?></a>
        <?php foreach ($grupo_veiculo->artigos_veiculo as $artigo): ?>
            <p class="titulo_artigo_ancora">
                <a href="<?php echo $url . "#titulo_artigo" . $artigo->id ?>">
                    <?php echo $artigo->title ?>
                </a>
            </p>
            
        <?php endforeach; ?>
    <?php endforeach; ?>

</div>
<br><br>
<div class="notimpe_detalhado">
    <?php foreach ($this->items as $grupo_veiculo): ?>
        <div class="grupo_veiculo">
            <p class="titulo_veiculo" id="titulo_veiculo<?php echo $grupo_veiculo->id_veiculo ?>">
                <img src="<?php echo $grupo_veiculo->imagem_veiculo ?>" alt="<?php echo $grupo_veiculo->nome_veiculo ?>"/>
            </p>
            <?php foreach ($grupo_veiculo->artigos_veiculo as $artigo): ?>
                <h4 class="titulo_artigo" id="titulo_artigo<?php echo $artigo->id ?>"><?php echo $artigo->title ?></h4>
                <div class="notimpe_artigo_texto">
                    <span class="<?php if($artigo->fulltext) echo "notimpe_subtitulo"?>">
                        <?php echo $artigo->introtext ?>
                    </span>
                    
                        <?php echo $artigo->fulltext ?>
                   
                </div>
           
        <?php endforeach; ?>
                 </div>
    <?php endforeach; ?>

</div> 

<?php endif;?>

