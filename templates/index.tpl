<div class="row">
    <?php /* @var $project Reptception\ProjectModel */?>
    <?php foreach($this->projects as $project):?>
        <div class="col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h4 class="text-center"><?=$project->getName()?></h4>
                </div>
                <div class="panel-body text-center">
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: 75%">
                            <span class="progress-type"><i class="fa fa-check"></i> 75%</span>
                            <span class="sr-only">75% Complete (success)</span>
                        </div>
                        <div class="progress-bar progress-bar-danger" style="width: 25%">
                            <span class="progress-type"><i class="fa fa-exclamation-circle"></i> 25%</span>
                            <span class="sr-only">25% Complete (danger)</span>
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item"></i>run at <i class="fa fa-calendar"></i> <mark><?=$project->getLastRunDateFormat()?></mark></li>
                    <li class="list-group-item"><mark><?=$project->getExecutionTime()?></mark> executed</li>
                    <li class="list-group-item"><mark>22</mark> Acceptance Tests</li>
                    <li class="list-group-item"><mark>32</mark> Selenium Tests</li>
                    <li class="list-group-item">
                        <a href="#" class="btn btn-default btn-xs" target="_blank"><i class="fa fa-hand-o-up"></i> Run manually</i></i></a>
                        <a href="#" class="btn btn-info btn-xs" target="_blank">Detailed report <i class="fa fa-external-link"></i></a>
                    </li>
                </ul>
                <div class="panel-footer">
                    <h2><span class="label label-danger center-block"><i class="fa fa-exclamation-circle"></i> Fail</span></h2>
                </div>
            </div>
        </div>
    <?php endforeach;?>
    
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4 class="text-center">project 2</h4>
            </div>
            <div class="panel-body text-center">
                <div class="progress">
                    <div class="progress-bar progress-bar-success" style="width: 100%">
                        <span class="progress-type"><i class="fa fa-check"></i> 100%</span>
                        <span class="sr-only">100% Complete (success)</span>
                    </div>
                    <div class="progress-bar progress-bar-danger" style="width: 0%">
                        <span class="progress-type">0%</span>
                        <span class="sr-only">0% Complete (danger)</span>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush text-center">
                <li class="list-group-item"></i>run at <i class="fa fa-calendar"></i> <mark>2014-06-29 12:39</mark></li>
                <li class="list-group-item"><mark>28.1s</mark> executed</li>
                <li class="list-group-item"><mark>21</mark> Acceptance Tests</li>
                <li class="list-group-item"><mark>19</mark> Selenium Tests</li>
                <li class="list-group-item">
                    <a href="#" class="btn btn-default btn-xs" target="_blank"><i class="fa fa-hand-o-up"></i> Run manually</i></i></a>
                    <a href="#" class="btn btn-info btn-xs" target="_blank">Detailed report <i class="fa fa-external-link"></i></a>
                </li>
            </ul>
            <div class="panel-footer">
                <h2><span class="label label-success center-block"><i class="fa fa-check"></i> Success</span></h2>
            </div>
        </div>
    </div>
</div>