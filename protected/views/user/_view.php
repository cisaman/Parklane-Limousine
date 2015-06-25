<?php $utils = new Utils; ?>

<div class="view">   

    <h3 class="text-green"><?php echo CHtml::encode($model->user_intial_name); ?> <?php echo CHtml::encode($model->user_name); ?></h3>
    <hr/>   

    <h4>Basic Information:</h4>
    <hr/>   
    <div class="table-responsive">
        <table class="table table-bordered table-striped">            
            <tbody>
                <tr>
                    <th style="width: 250px"><?php echo CHtml::encode($model->getAttributeLabel('user_name')); ?></th>
                    <td class="text-green"><?php echo CHtml::encode($model->user_name); ?></td>                    
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('user_email')); ?></th>
                    <td class="text-green"><?php echo CHtml::encode($model->user_email); ?></td>                    
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('user_country_code')); ?></th>
                    <td><?php echo CHtml::encode($model->user_country_code); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('user_mobile')); ?></th>
                    <td><?php echo CHtml::encode($model->user_mobile); ?></td>                    
                </tr>                
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('user_created_date')); ?></th>
                    <td><?php echo CHtml::encode($model->user_created_date); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <h4>VISA Card Information:</h4>
    <hr/>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">            
            <tbody>
                <tr>
                    <th style="width: 250px"><?php echo CHtml::encode($model->getAttributeLabel('user_payment_type')); ?></th>
                    <td><?php echo CHtml::encode($model->user_payment_type); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('user_type')); ?></th>
                    <td class="text-green"><?php echo CreditCard::model()->getCreditCardType($model->user_type); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('user_cardholder_name')); ?></th>
                    <td><?php echo CHtml::encode($model->user_cardholder_name); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('user_credit_card')); ?></th>
                    <td><?php echo CHtml::encode($model->user_credit_card); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('user_expiry_month')); ?></th>
                    <td><?php echo CHtml::encode($model->user_expiry_month); ?></td>
                </tr>
                <tr>
                    <th><?php echo CHtml::encode($model->getAttributeLabel('user_expiry_year')); ?></th>
                    <td><?php echo CHtml::encode($model->user_expiry_year); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <h4>Remark:</h4>
    <hr/>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">            
            <tbody>
                <tr>                    
                    <td>
                        <?php
                        if (!empty($model->user_remark)) {
                            echo CHtml::encode($model->user_remark);
                        } else {
                            echo 'No remark found.';
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style type="text/css">

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