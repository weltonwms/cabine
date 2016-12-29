<?php if(!isset($this->pdf)):?>
<div class="edicoes_anteriores">
    <?php $link= JRoute::_("index.php?option=com_notimp&view=notimps");?>
    <a href="<?php echo $link?>">Edições Anteriores <i class="icon-chevron-right"></i></a>
</div>
<?php endif;?>

<?php if($this->item):?>


<h4 class="notimpe_nr_notimpe">Notimpe 
    <?php
    echo $this->item->nr_notimpe .
    "/{$this->item->ano} - ".JHtml::_('date', $this->item->data, JText::_('DATE_FORMAT_LC4'));

    
    ?>
</h4>
<?php if(!isset($this->pdf)):?>
<a class="btn" href="<?php echo JRoute::_("index.php?option=com_notimp&view=notimp&id={$this->item->id}&format=pdf");?>">Imprimir PDF</a>
<?php endif;?>
<div class="notimpe_ancoras">
    <?php foreach ($this->item->veiculos as $veiculo): ?>

        <a href="<?php echo "#titulo_veiculo" . $veiculo->id ?>" class="nome_veiculo_ancora"><?php echo $veiculo->nome ?></a>
        <?php foreach ($veiculo->artigos as $artigo): ?>
            <p class="titulo_artigo_ancora">
                <a href="<?php echo "#titulo_artigo" . $artigo->id ?>">
                    <?php echo $artigo->title ?>
                </a>
            </p>
            
        <?php endforeach; ?>
    <?php endforeach; ?>

</div>
<br><br>

<div class="notimpe_detalhado">
    <?php foreach ($this->item->veiculos as $veiculo): ?>
        <div class="grupo_veiculo">
            <p class="titulo_veiculo" id="titulo_veiculo<?php echo $veiculo->id?>">
                <img src="<?php echo $veiculo->imagem ?>" alt="<?php echo $veiculo->nome ?>"/>
            </p>
            <?php foreach ($veiculo->artigos as $artigo): ?>
                <h4 class="titulo_artigo" id="titulo_artigo<?php echo $artigo->id ?>"><?php echo $artigo->title ?></h4>
                <div class="notimpe_artigo_texto">
                   
                        <?php echo $artigo->introtext ?>
                        <?php echo $artigo->fulltext ?>
                   
                </div>
           
        <?php endforeach; ?>
                 </div>
    <?php endforeach; ?>

</div> 


<?php endif;



?>

