<div class="view">   

    <div class="row">
        <div class="col-md-12">
            <h3 class="text-green"><?php echo CHtml::encode($model->hourlyonhire_initials); ?> <?php echo CHtml::encode($model->hourlyonhire_passengername); ?></h3>
            <hr/>   
            <h4><strong>Order Number:</strong> <?php Booking::getOrderNoForList($model->hourlyonhire_pickupdatetime, $model->hourlyonhire_id) ?></h4>
        </div>
    </div>

    <h4 class="text-dark-blue">Basic Information:</h4>
    <hr/>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">            
            <tbody>
                <tr>
                    <th style="width: 200px;"><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_model')); ?></th>
                    <td><?php echo CHtml::encode(Booking::model()->getBookingCarModelByID($model->hourlyonhire_model)); ?></td>                                                        
                </tr>                
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_pickupdatetime')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_pickupdatetime); ?></td>
                    <th style="width: 200px;"><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_pickuppoint')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_pickuppoint); ?></td>
                </tr>               
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_noofhours')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_noofhours); ?></td>  
                    <th><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_totalhours')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_totalhours); ?></td>  
                </tr>               
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_noofpassengers')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_noofpassengers); ?></td>               
                    <th><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_noofluggages')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_noofluggages); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_created_date')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_created_date); ?></td>                
                    <th><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_updated_date')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_updated_date); ?></td>
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
                    <th style="width: 200px;"><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_passengername')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_initials . ' ' . $model->hourlyonhire_passengername); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_userID')); ?></th>
                    <td><?php echo CHtml::encode(User::model()->getUserName($model->hourlyonhire_userID)); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_email')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_email); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_contactno')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_contactno); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <h4 class="text-dark-blue">Fare Information:</h4>
    <hr/>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">            
            <tbody>                
                <tr>
                    <th style="width: 200px;"><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_originalamount')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_originalamount); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_discount')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_discount); ?></td>
                </tr>        
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_paidamount')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_paidamount); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_parkingfee')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_parkingfee); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_toll')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_toll); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_tolls')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_tolls); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('hourlyonhire_surcharge')); ?></th>
                    <td><?php echo CHtml::encode($model->hourlyonhire_surcharge); ?></td>
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
                    <th>
                        <?php
                        if (!empty($model->hourlyonhire_remark)) {
                            echo CHtml::encode($model->hourlyonhire_remark);
                        } else {
                            echo 'No remark found.';
                        }
                        ?>
                    </th>
                </tr>                
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr/>
            <h4 class="text-right text-green">
                Total Amount to be Paid: HK($) 
                <?php echo CHtml::encode($model->hourlyonhire_paidamount + $model->hourlyonhire_parkingfee + $model->hourlyonhire_toll + $model->hourlyonhire_tolls + $model->hourlyonhire_surcharge); ?>
            </h4>
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