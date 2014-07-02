<div class="row">
    <?php /* @var $project Reptception\ProjectModel */?>
    <?php foreach($this->projects as $project):?>
        <div class="col-md-4">
            <div class="panel <?= ($project->isSuccess()) ? 'panel-success' : 'panel-danger'; ?>">
                <div class="panel-heading">
                    <h4 class="text-center"><?=$project->getName()?></h4>
                </div>
                <div class="panel-body text-center">
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: <?=$project->getSuccesPercent()?>%">
                            <span class="progress-type"><i class="fa fa-check"></i> <?=$project->getSuccesPercent()?>%</span>
                            <span class="sr-only"><?=$project->getSuccesPercent()?>% Complete (success)</span>
                        </div>
                        <div class="progress-bar progress-bar-danger" style="width: <?=$project->getFailurePercent()?>%">
                            <span class="progress-type"><i class="fa fa-exclamation-circle"></i> <?=$project->getFailurePercent()?>%</span>
                            <span class="sr-only"><?=$project->getFailurePercent()?>% Complete (danger)</span>
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item"></i>run at <i class="fa fa-calendar"></i> <mark><?=$project->getLastRunDateFormat()?></mark></li>
                    <li class="list-group-item"><mark><?=$project->getExecutionTime()?>s</mark> executed</li>
                    <li class="list-group-item"><mark><?=$project->getAcceptanceTestsCount()?></mark> Acceptance Tests</li>
                    <li class="list-group-item"><mark><?=$project->getSeleniumTestsCount()?></mark> Selenium Tests</li>
                    <li class="list-group-item">
                        <a href="#" class="btn btn-default btn-xs" target="_blank"><i class="fa fa-hand-o-up"></i> Run manually</i></i></a>
                        <a href="#" class="btn btn-info btn-xs" target="_blank">Detailed report <i class="fa fa-external-link"></i></a>
                    </li>
                </ul>
                <div class="panel-footer">
                    <?php if ($project->isSuccess()): ?>
                        <h2><span class="label label-success center-block"><i class="fa fa-check"></i> Success</span></h2>
                    <?php else: ?>
                        <h2><span class="label label-danger center-block"><i class="fa fa-exclamation-circle"></i> Fail</span></h2>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach;?>
</div>