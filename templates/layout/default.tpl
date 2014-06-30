<?=$this->doctype(); ?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <?=$this->headTitle('Reptception - reports aggregation for Codeception tests.'); ?>
        <?=$this->headLink()
                ->prependStylesheet('/css/style.css')
                ->prependStylesheet('/css/font-awesome.min.css')
                ->prependStylesheet('/css/bootstrap-theme.min.css')
                ->prependStylesheet('/css/bootstrap.min.css')?>
        
    </head>
    <body>
        
        <div class="container">
            <?=$this->partial('includes/navbar.tpl');?>
            <?=$this->content?>
        
            <?=$this->partial('includes/footer.tpl');?>
        </div>
        
        <!-- Scripts -->
        <?=$this->headScript()
            ->prependFile('/js/bootstrap.min.js')
            ->prependFile('/js/jquery-2.1.1.min.js'); ?>
    </body>
</html>
