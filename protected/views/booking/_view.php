<div class="view">   

    <div class="row">
        <div class="col-md-12">
            <h3 class="text-green"><?php echo CHtml::encode($model->booking_initials); ?> <?php echo CHtml::encode($model->booking_passenger_name); ?></h3>
            <hr/>   
            <h4><strong>Order Number:</strong> <?php Booking::getOrderNoForList($model->booking_eta, $model->booking_id) ?></h4>
        </div>
    </div>

    <h4 class="text-dark-blue">Basic Information:</h4>
    <hr/>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">            
            <tbody>
                <tr>
                    <th width="20%"><?php echo CHtml::encode($model->getAttributeLabel('booking_model')); ?></th>
                    <td width="30%"><?php echo CHtml::encode(Booking::model()->getBookingCarModelByID($model->booking_model)); ?></td>
                    <th width="20%"><?php echo CHtml::encode($model->getAttributeLabel('booking_type')); ?></th>
                    <td width="30%"><?php echo CHtml::encode(Booking::model()->getBookingServiceTypeByID($model->booking_type)); ?></td>
                </tr>
                <?php if ($model->booking_type == 1) { ?>                                
                    <tr>
                        <th><?php echo CHtml::encode($model->getAttributeLabel('booking_flight_no')); ?></th>
                        <td><?php echo CHtml::encode($model->booking_flight_no); ?></td>
                        <th><?php echo CHtml::encode($model->getAttributeLabel('booking_eta')); ?></th>
                        <td><?php echo CHtml::encode(Booking::getETAForList($model->booking_eta)); ?></td>
                    </tr>              
                <?php } else { ?>
                    <tr>
                        <th><?php echo CHtml::encode('拿起時間'); ?></th>
                        <td><?php echo CHtml::encode($model->booking_eta); ?></td>
                    </tr>              
                <?php } ?>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('booking_no_of_passenger')); ?></th>
                    <td><?php echo CHtml::encode($model->booking_no_of_passenger); ?></td>               
                    <th><?php echo CHtml::encode($model->getAttributeLabel('booking_no_of_luggage')); ?></th>
                    <td><?php echo CHtml::encode($model->booking_no_of_luggage); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('booking_created')); ?></th>
                    <td><?php echo CHtml::encode($model->booking_created); ?></td>                
                    <th><?php echo CHtml::encode($model->getAttributeLabel('booking_updated')); ?></th>
                    <td><?php echo CHtml::encode($model->booking_updated); ?></td>
                </tr>               
            </tbody>
        </table>
    </div>

    <h4 class="text-dark-blue">Contact Information:</h4>
    <hr/>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">            
            <tbody>                
                <tr>
                    <th  width="20%"><?php echo CHtml::encode($model->getAttributeLabel('booking_email')); ?></th>
                    <td  width="80%"><?php echo CHtml::encode($model->booking_email); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('booking_contact_no')); ?></th>
                    <td><?php echo CHtml::encode($model->booking_contact_no); ?></td>
                </tr>
            </tbody>
        </table>
    </div>


    <h4 class="text-dark-blue">Location Information:</h4>
    <hr/>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">            
            <tbody>                
                <tr>
                    <th width="20%"><?php echo CHtml::encode($model->getAttributeLabel('booking_countryID')); ?></th>
                    <td width="80%"><?php echo CHtml::encode(Country::model()->getCountryName($model->booking_countryID)); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('booking_districtID')); ?></th>
                    <td><?php echo CHtml::encode(District::model()->getDistrictName($model->booking_districtID)); ?></td>                    
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('booking_location')); ?></th>
                    <td><?php echo CHtml::encode($model->booking_location); ?></td>
                </tr>                
            </tbody>
        </table>
    </div>

    <h4 class="text-dark-blue">Remark:</h4>
    <hr/>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">            
            <tbody>
                <tr>                    
                    <td>
                        <?php
                        if (empty($model->booking_remark)) {
                            echo Yii::t('lang', 'no_remark_found');
                        } else {
                            echo CHtml::encode($model->booking_remark);
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr/>
            <h4 class="text-right text-green">Total Amount: HK($) <?php echo CHtml::encode($model->booking_paidamount); ?></h4>
            <hr/>
        </div>
    </div>

</div>

<style type="text/css">

    th{
        width: 150px;
    }

    @media (min-width:320px) and (min-width:360px) {
        .view {
            padding: 0 !important;
        }
    }

    @media (min-width:361px){
        .view {
            padding: 0 30px !important;
        }
    }
</style>