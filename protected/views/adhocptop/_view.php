<div class="view">   

    <div class="row">
        <div class="col-md-12">
            <h3 class="text-green"><?php echo CHtml::encode($model->adhocptop_initials); ?> <?php echo CHtml::encode($model->adhocptop_passengername); ?></h3>
            <hr/>   
        </div>
    </div>

    <h4 class="text-dark-blue">Basic Information:</h4>
    <hr/>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">            
            <tbody>
                <tr>
                    <th width="20%"><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_model')); ?></th>
                    <td width="30%"><?php echo CHtml::encode(Booking::model()->getBookingCarModelByID($model->adhocptop_model)); ?></td>                                                        
                </tr>                
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_pickupdatetime')); ?></th>
                    <td><?php echo CHtml::encode($model->adhocptop_pickupdatetime); ?></td>                    
                </tr>
                <tr>
                    <th width="20%"><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_noofpassengers')); ?></th>
                    <td width="30%"><?php echo CHtml::encode($model->adhocptop_noofpassengers); ?></td>               
                    <th width="20%"><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_noofluggages')); ?></th>
                    <td width="30%"><?php echo CHtml::encode($model->adhocptop_noofluggages); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_createddate')); ?></th>
                    <td><?php echo CHtml::encode($model->adhocptop_createddate); ?></td>                
                    <th><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_updateddate')); ?></th>
                    <td><?php echo CHtml::encode($model->adhocptop_updateddate); ?></td>
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
                    <th width="20%"><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_passengername')); ?></th>
                    <td width="80%"><?php echo CHtml::encode($model->adhocptop_initials . ' ' . $model->adhocptop_passengername); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_userID')); ?></th>
                    <td><?php echo CHtml::encode(User::model()->getUserName($model->adhocptop_userID)); ?></td>
                </tr>                
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_contactno')); ?></th>
                    <td><?php echo CHtml::encode($model->adhocptop_contactno); ?></td>
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
                    <th colspan="2" class="text-center text-blue" width="50%">From</th>
                    <th colspan="2" class="text-center text-blue" width="50%">To</th>
                </tr>
                <tr>
                    <th width="20%"><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_fromaddress')); ?></th>
                    <td width="30%"><?php echo CHtml::encode($model->adhocptop_fromaddress); ?></td>
                    <th width="20%"><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_fromaddress')); ?></th>
                    <td width="30%"><?php echo CHtml::encode($model->adhocptop_toaddress); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_fromdistrictID')); ?></th>
                    <td><?php echo CHtml::encode(District::model()->getDistrictName($model->adhocptop_fromdistrictID)); ?></td>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_todistrictID')); ?></th>
                    <td><?php echo CHtml::encode(District::model()->getDistrictName($model->adhocptop_todistrictID)); ?></td>
                </tr>                
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_fromcountryID')); ?></th>
                    <td><?php echo CHtml::encode(Country::model()->getCountryName($model->adhocptop_fromcountryID)); ?></td>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_tocountryID')); ?></th>
                    <td><?php echo CHtml::encode(Country::model()->getCountryName($model->adhocptop_tocountryID)); ?></td>
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
                    <th width="20%"><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_originalprice')); ?></th>
                    <td width="80%"><?php echo CHtml::encode($model->adhocptop_originalprice); ?></td>
                </tr>
                <tr>
                    <th width="20%"><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_discount')); ?></th>
                    <td width="80%"><?php echo CHtml::encode(empty($model->adhocptop_discount) ? '-' : $model->adhocptop_discount); ?></td>
                </tr>
                <tr>
                    <th width="20%"><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_paidamount')); ?></th>
                    <td width="80%"><?php echo CHtml::encode($model->adhocptop_paidamount); ?></td>
                </tr>
                <tr>
                    <th width="20%"><?php echo CHtml::encode($model->getAttributeLabel('adhocptop_surcharge')); ?></th>
                    <td width="80%"><?php echo CHtml::encode($model->adhocptop_surcharge); ?></td>
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
                        if (!empty($model->adhocptop_remark)) {
                            echo CHtml::encode($model->adhocptop_remark);
                        } else {
                            echo 'No remark found.';
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
            <h4 class="text-right text-green">Total Amount to be Paid: HK($) <?php echo CHtml::encode($model->adhocptop_paidamount + $model->adhocptop_surcharge); ?></h4>
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