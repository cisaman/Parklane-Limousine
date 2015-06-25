<?php $this->pageTitle = Yii::t('lang', 'parklane') . ' | View Hourly On Hire Record' . '(#' . $model->hourlyonhire_id . ')'; ?>

<!-- begin PAGE TITLE AREA -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">            
            <ol class="breadcrumb">
                <li><h1><i class="fa fa-booking"></i> View Hourly On Hire Record | <small><a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('hourlyonhire/index'); ?>">Back to Listing</a></small></h1></li>
            </ol>
        </div>
    </div>    
</div>
<!-- end PAGE TITLE AREA -->

<div class="row">
    <div class="col-lg-12">

        <div class="portlet portlet-default">
            <div class="portlet-body">
                <ul id="bookingTab" class="nav nav-tabs">
                    <li class="active"><a href="#hourlyonhire-view" data-toggle="tab">View Hourly On Hire Record(#<?php echo $model->hourlyonhire_id; ?>)</a></li>
                </ul>
                <div id="bookingTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="hourlyonhire-view">                            
                        <div class="row">
                            <div class="col-md-12">

                                <?php $this->renderPartial('_view', array('model' => $model)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>    
</div>