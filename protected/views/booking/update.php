<?php $this->pageTitle = Yii::t('lang', 'parklane') . ' | Modify and Remark (' . Booking::getBookingServiceTypeByID($model->booking_type) . ')' . '(#' . $model->booking_id . ')'; ?>

<!-- begin PAGE TITLE AREA -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">            
            <ol class="breadcrumb">
                <li>
                    <h1>
                        <i class="fa fa-booking"></i> Modify and Remark (<?php echo Booking::getBookingServiceTypeByID($model->booking_type); ?>) | <small>
                            <?php if ($model->booking_type == 1) { ?>
                                <a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('booking/arrival'); ?>">Back to Listing</a>
                            <?php } else { ?>
                                <a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('booking/departure'); ?>">Back to Listing</a>
                            <?php } ?>
                        </small>
                    </h1>
                </li>
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
                    <li class="active"><a href="#booking-update" data-toggle="tab">Modify and Remark (<?php echo Booking::getBookingServiceTypeByID($model->booking_type); ?>)</a></li>
                </ul>
                <div id="bookingTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="booking-update">                            
                        <div class="row">
                            <div class="col-md-12">

                                <?php $this->renderPartial('_form', array('model' => $model)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>    
</div>