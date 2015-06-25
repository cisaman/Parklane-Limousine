<div id="maincontent">
    <?php
    $this->pageTitle = Yii::t('lang', 'parklane') . ' | Manage Hourly On Hire Service';

    Yii::app()->clientScript->registerScript('search', "
        $('.search-button').click(function(){
            $('.search-form').toggle();
            return false;
        });
        $('.search-form form').submit(function(){
            $('#hourlyonhire-grid').yiiGridView('update', {
                data: $(this).serialize()
            });        
            return false;
        });
    ");
    ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="page-title">            
                <ol class="breadcrumb">
                    <li><h1><i class="fa fa-user"></i> Manage Hourly On Hire Service</h1></li>
                </ol>
            </div>
        </div>    
    </div>   

    <div class="row">
        <div class="col-lg-12">

            <div class="portlet portlet-default">
                <div class="portlet-body">

                    <div id="statusMsg"></div>

                    <?php if (Yii::app()->user->hasFlash('message')): ?>
                        <div class="alert alert-<?php echo Yii::app()->user->getFlash('type'); ?> alert-dismissable" id="successmsg">
                            <?php echo Yii::app()->user->getFlash('message'); ?>
                        </div>
                    <?php endif; ?>

                    <ul id="userTab" class="nav nav-tabs">                    
                        <li class="active"><a href="#hourlyonhire-list" data-toggle="tab">List of Records</a></li>                    
                    </ul>
                    <div id="userTabContent" class="tab-content">                    
                        <div class="tab-pane fade active in" id="hourlyonhire-list">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <label style="width: 100%; margin: 0px; text-align: right; font-weight: bold ! important; line-height: 34px;">
                                                Search:
                                            </label>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" placeholder="Pickup Date" class="form-control" id="search_by_pickupdate"/>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="button" class="btn btn-success" id="search_hourlyonhirerecord" value="Search" style="margin: 0px; line-height: 21px; width: 60px;"/>
                                            <input type="button" class="btn btn-danger" id="search_hourlyonhirereset" value="Reset" style="margin: 0px; line-height: 21px; width: 60px;"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">                                
                                    <div class="table-responsive">
                                        <form action="<?php echo Utils::getBaseUrl() ?>/hourlyonhire/confirm" method="post">
                                            <?php
                                            $this->widget('zii.widgets.grid.CGridView', array(
                                                'id' => 'hourlyonhire-grid',
                                                'htmlOptions' => array('class' => 'dataTables_wrapper sampleScroll', 'role' => 'grid'),
                                                'dataProvider' => $model->search(),
                                                'filter' => $model,
                                                'columns' => array(
                                                    array(
                                                        'header' => 'S. No.',
                                                        'name' => 'S. No.',
                                                        'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                                                        'htmlOptions' => array('style' => 'text-align:center'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:60px'),
                                                    ),
                                                    array(
                                                        'header' => 'Order No.',
                                                        'name' => 'Order No.',
                                                        'value' => 'Booking::getOrderNoForList($data->hourlyonhire_pickupdatetime, $data->hourlyonhire_id)',
                                                        'htmlOptions' => array('style' => 'text-align:center'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:150px'),
                                                    ),
                                                    array(
                                                        'name' => 'hourlyonhire_userID',
                                                        'value' => 'User::model()->getUserName($data->hourlyonhire_userID)',
                                                        'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:200px'),
                                                        'filter' => CHtml::activeDropDownList($model, 'hourlyonhire_userID', CHtml::listData(User::model()->findAll(array('distinct' => true)), 'user_id', 'user_name'), array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' => $model->getAttributeLabel('hourlyonhire_userID')))
                                                    ),
                                                    array(
                                                        'name' => 'hourlyonhire_passengername',
                                                        'value' => '$data->hourlyonhire_initials." ".$data->hourlyonhire_passengername',
                                                        'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:200px'),
                                                        'filter' => CHtml::activeTextField($model, 'hourlyonhire_passengername', array('placeholder' => $model->getAttributeLabel('hourlyonhire_passengername'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control')),
                                                    ), array(
                                                        'name' => 'hourlyonhire_model',
                                                        'type' => 'raw',
                                                        'value' => 'CHtml::link(Booking::model()->getBookingCarModelByID($data->hourlyonhire_model), "", array("class" => "text-green text-bold"))',
                                                        'htmlOptions' => array('style' => 'text-align:center;-ms-word-break: break-all;word-break: break-all;'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:150px'),
                                                        'filter' => CHtml::activeDropDownList($model, 'hourlyonhire_model', Booking::model()->getBookingCarModel(), array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' => $model->getAttributeLabel('hourlyonhire_model')))
                                                    ),
                                                    array(
                                                        'name' => 'hourlyonhire_pickupdatetime',
                                                        'value' => '$data->hourlyonhire_pickupdatetime',
                                                        'htmlOptions' => array('style' => 'text-align:center;-ms-word-break: break-all;word-break: break-all;'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:180px'),
                                                        'filter' => CHtml::activeTextField($model, 'hourlyonhire_pickupdatetime', array('placeholder' => $model->getAttributeLabel('hourlyonhire_pickupdatetime'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                                    ),
                                                    array(
                                                        'name' => 'hourlyonhire_pickuppoint',
                                                        'value' => '$data->hourlyonhire_pickuppoint',
                                                        'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:150px'),
                                                        'filter' => CHtml::activeTextField($model, 'hourlyonhire_pickuppoint', array('placeholder' => $model->getAttributeLabel('hourlyonhire_pickuppoint'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                                    ),
                                                    array(
                                                        'name' => 'hourlyonhire_noofhours',
                                                        'value' => '$data->hourlyonhire_noofhours',
                                                        'htmlOptions' => array('style' => 'text-align:center;-ms-word-break: break-all;word-break: break-all;'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:150px'),
                                                        'filter' => ''
                                                    ),
                                                    array(
                                                        'name' => 'hourlyonhire_totalhours',
                                                        'value' => '$data->hourlyonhire_totalhours',
                                                        'htmlOptions' => array('style' => 'text-align:center;-ms-word-break: break-all;word-break: break-all;'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:150px'),
                                                        'filter' => ''
                                                    ),
                                                    array(
                                                        'name' => 'hourlyonhire_originalamount',
                                                        'value' => '$data->hourlyonhire_originalamount',
                                                        'htmlOptions' => array('style' => 'text-align:right;-ms-word-break: break-all;word-break: break-all;'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:250px'),
                                                        'filter' => ''
                                                    ),
                                                    array(
                                                        'name' => 'hourlyonhire_discount',
                                                        'value' => '$data->hourlyonhire_discount',
                                                        'htmlOptions' => array('style' => 'text-align:center;-ms-word-break: break-all;word-break: break-all;'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:140px'),
                                                        'filter' => ''
                                                    ),
                                                    array(
                                                        'name' => 'hourlyonhire_paidamount',
                                                        'value' => '$data->hourlyonhire_paidamount',
                                                        'htmlOptions' => array('style' => 'text-align:right;-ms-word-break: break-all;word-break: break-all;'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:250px'),
                                                        'filter' => ''
                                                    ),
                                                    array(
                                                        'name' => 'hourlyonhire_parkingfee',
                                                        'value' => '$data->hourlyonhire_parkingfee',
                                                        'htmlOptions' => array('style' => 'text-align:right;-ms-word-break: break-all;word-break: break-all;'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:200px'),
                                                        'filter' => ''
                                                    ),
                                                    array(
                                                        'name' => 'hourlyonhire_toll',
                                                        'value' => '$data->hourlyonhire_toll',
                                                        'htmlOptions' => array('style' => 'text-align:right;-ms-word-break: break-all;word-break: break-all;'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:150px'),
                                                        'filter' => ''
                                                    ),
                                                    array(
                                                        'name' => 'hourlyonhire_tolls',
                                                        'value' => '$data->hourlyonhire_tolls',
                                                        'htmlOptions' => array('style' => 'text-align:right;-ms-word-break: break-all;word-break: break-all;'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:150px'),
                                                        'filter' => ''
                                                    ),
                                                    array(
                                                        'name' => 'hourlyonhire_surcharge',
                                                        'value' => '$data->hourlyonhire_surcharge',
                                                        'htmlOptions' => array('style' => 'text-align:right;-ms-word-break: break-all;word-break: break-all;'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:150px'),
                                                        'filter' => ''
                                                    ),
                                                    array(
                                                        'header' => 'Total Amount (HK$)',
                                                        'value' => '$data->hourlyonhire_paidamount + $data->hourlyonhire_parkingfee + $data->hourlyonhire_toll + $data->hourlyonhire_tolls + $data->hourlyonhire_surcharge',
                                                        'htmlOptions' => array('style' => 'text-align:right;-ms-word-break: break-all;word-break: break-all;'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:200px'),
                                                        'filter' => ''
                                                    ),
                                                    array(
                                                        'name' => 'hourlyonhire_created_date',
                                                        'value' => '$data->hourlyonhire_created_date',
                                                        'htmlOptions' => array('style' => 'text-align:center;-ms-word-break: break-all;word-break: break-all;'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:150px'),
                                                        'filter' => CHtml::activeTextField($model, 'hourlyonhire_created_date', array('placeholder' => $model->getAttributeLabel('hourlyonhire_created_date'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                                    ),
                                                    array(
                                                        'header' => 'Token',
                                                        'type' => 'raw',
                                                        'value' => 'Hourlyonhire::getTokenForList($data->hourlyonhire_id)',
                                                        'htmlOptions' => array('style' => 'text-align:center'),
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:150px'),
                                                    ),
                                                    array(
                                                        'header' => 'View',
                                                        'class' => 'CButtonColumn',
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:70px'),
                                                        'htmlOptions' => array('style' => 'text-align:center;'),
                                                        'template' => '{view}',
                                                        'buttons' => array
                                                            (
                                                            'view' => array
                                                                (
                                                                'label' => '<i class="fa fa-search"></i>',
                                                                'options' => array('title' => 'View'),
                                                                'imageUrl' => FALSE
                                                            ),
                                                        ),
                                                    ),
                                                    array(
                                                        'header' => 'Modify',
                                                        'class' => 'CButtonColumn',
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:70px'),
                                                        'htmlOptions' => array('style' => 'text-align:center;'),
                                                        'template' => '{update}',
                                                        'buttons' => array
                                                            (
                                                            'update' => array
                                                                (
                                                                'label' => '<i class="fa fa-edit"></i>',
                                                                'options' => array('title' => 'Change Car Model'),
                                                                'imageUrl' => FALSE
                                                            ),
                                                        ),
                                                    ),
                                                    array(
                                                        'header' => 'Delete',
                                                        'class' => 'CButtonColumn',
                                                        'deleteConfirmation' => 'Do you really want to delete this Record?',
                                                        'afterDelete' => 'function(link,success,data){ if(success) { $("#statusMsg").css("display", "block"); $("#statusMsg").html(data); $("#statusMsg").animate({opacity: 1.0}, 3000).fadeOut("fast");}}',
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:70px'),
                                                        'htmlOptions' => array('style' => 'text-align:center;'),
                                                        'template' => '{delete}',
                                                        'buttons' => array
                                                            (
                                                            'delete' => array
                                                                (
                                                                'label' => '<i class="fa fa-times"></i>',
                                                                'options' => array('title' => 'Delete', 'class' => 'remove'),
                                                                'imageUrl' => FALSE
                                                            )
                                                        ),
                                                    ),
                                                    array(
                                                        'header' => 'Send',
                                                        'class' => 'CButtonColumn',
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:70px'),
                                                        'htmlOptions' => array('style' => 'text-align:center;'),
                                                        'template' => '{send}',
                                                        'buttons' => array
                                                            (
                                                            'send' => array
                                                                (
                                                                'label' => '<i class="fa fa-send text-green"></i>',
                                                                'options' => array(
                                                                    'title' => 'Send Notification',
                                                                    'class' => 'sendMsg',
                                                                    'data' => '4'
                                                                ),
                                                                'imageUrl' => FALSE,
                                                                'url' => 'Yii::app()->createUrl("webservice/sendnotification", array("id" => $data->hourlyonhire_id))'
                                                            ),
                                                        ),
                                                    ),
                                                    array(
                                                        'header' => '<input type="checkbox" id="selectAll"/>',
                                                        'type' => 'raw',
                                                        'value' => 'Hourlyonhire::getCheckBoxForList($data->hourlyonhire_id)',
                                                        'headerHtmlOptions' => array('style' => 'text-align: center;width:30px'),
                                                        'htmlOptions' => array('style' => 'text-align:center;'),
                                                    )
                                                ),
                                                'rowCssClassExpression' => 'Utils::getColorClass($data->hourlyonhire_statuscode)',
                                                'itemsCssClass' => 'table table-bordered table-green dataTable',
                                                'pagerCssClass' => 'dataTables_paginate paging_bootstrap',
                                                'summaryCssClass' => 'dataTables_info',
                                                'template' => '{items}<div class = "row"><div class = "col-xs-6">{summary}</div><div class = "col-xs-6">{pager}</div></div>',
                                                'pager' => array(
                                                    'htmlOptions' => array('class' => 'pagination', 'id' => ''),
                                                    'header' => '',
                                                    'cssFile' => false,
                                                    'selectedPageCssClass' => 'active',
                                                    'previousPageCssClass' => 'prev',
                                                    'nextPageCssClass' => 'next',
                                                    'hiddenPageCssClass' => 'disabled',
                                                    'maxButtonCount' => 5,
                                                ),
                                                'emptyText' => '<span class="text-danger text-center">No Record Found!</span>',
                                            ));
                                            ?>
                                            <div class="row" style="padding: 10px 0px;">
                                                <div class="col-sm-12 text-right">
                                                    <input type="submit" value="E-mail" class="btn btn-green"/>
                                                    <input type="submit" value="Reject" class="btn btn-red"/>
                                                    <input type="submit" value="Push" class="btn btn-blue"/>
                                                    <input type="submit" value="Confirm" class="btn btn-red" id="btnConfirm"/>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>                   
                    </div>
                </div>            
            </div>
        </div>    
    </div>

    <style type="text/css">
        .text-bold {font-weight: bold;}
        .portlet .portlet-body {padding: 5px !important;}
        .sampleScroll table {width: 3400px;}
    </style>

    <div class="modal fade" id="showModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">Driver Details</h4>
                </div>
                <div class="modal-body">
                    <p id="lblMsg"></p>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-4"><label for="driver_name" style="margin: 5px 0 0">Driver Name</label></div>
                            <div class="col-sm-8">
                                <input type="text" id="driver_name" placeholder="Driver Name" class="form-control" style="margin-bottom: 10px;"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4"><label for="license_number" style="margin: 5px 0 0">Licence Number</label></div>
                            <div class="col-sm-8">
                                <input type="text" id="license_number" placeholder="Licence Number" class="form-control" style="margin-bottom: 10px;"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4"><label for="contact" style="margin: 5px 0 0">Contact</label></div>
                            <div class="col-sm-8">
                                <input type="text" id="contact" placeholder="Contact" class="form-control"/>
                            </div>
                        </div>                
                    </div>

                    <input type="hidden" id="txtUrl"/>
                    <input type="hidden" id="txtType"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="sendMessage">Send</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

</div>

<style type="text/css">
    .datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-top {top:227px !important;}
</style>

<link href="<?php echo Yii::app()->request->baseUrl ?>/bootstrap/dashboard/css/bootstrap-datepicker.min.css" rel="stylesheet" media="screen"/>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/bootstrap/dashboard/js/bootstrap-datepicker.min.js" charset="UTF-8"></script>

<script type="text/javascript">
    $(document).ready(function () {

        $('#search_by_pickupdate').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: 1,
            todayHighlight: 1
        });

        $('#selectAll').on('click', function (event) {
            if (this.checked) {
                $('.checkAll').each(function () {
                    this.checked = true;
                });
            } else {
                $('.checkAll').each(function () {
                    this.checked = false;
                });
            }
        });

        $('.sendMsg').click(function () {
            $('#showModal').modal('show');
            $('#txtUrl').val($(this).attr('href'));
            $('#txtType').val($(this).attr('data'));
            $('#lblMsg').removeClass('alert alert-danger');
            $('#lblMsg').html('');
            return false;
        });

        $('#sendMessage').click(function () {
            if ($('#driver_name').val() == '') {
                $('#lblMsg').addClass('alert alert-danger');
                $('#lblMsg').html('Please enter Driver Name');
                $('#driver_name').focus();
                return false;
            }

            if ($('#license_number').val() == '') {
                $('#lblMsg').addClass('alert alert-danger');
                $('#lblMsg').html('Please enter License Number');
                $('#license_number').focus();
                return false;
            }

            if ($('#contact').val() == '') {
                $('#lblMsg').addClass('alert alert-danger');
                $('#lblMsg').html('Please enter Contact Number');
                $('#contact').focus();
                return false;
            }

            $('#lblMsg').removeClass('alert alert-danger');
            $('#lblMsg').html('');

            $.ajax({
                url: $('#txtUrl').val(),
                data: {
                    driver_name: $('#driver_name').val(),
                    license_number: $('#license_number').val(),
                    contact: $('#contact').val(),
                    type: $('#txtType').val()
                },
                type: "POST",
                success: function (response) {
                    $('#txtMessage').val('');
                    //console.log(response);
                    $('#lblMsg').addClass('alert alert-success');
                    $('#lblMsg').html('Notification Sent Successfully.');
                }
            });

        });

        $('#sendiPhone').click(function () {
            if ($('#txtsendMessage').val() == '') {
                $('#lblsendMessage').addClass('alert alert-danger');
                $('#lblsendMessage').html('Please enter Message to be sent.');
            } else {
                $('#lblsendMessage').removeClass('alert alert-danger');
                $('#lblsendMessage').html('');
                $.ajax({
                    url: '/webservice/sendnotification',
                    data: {message: $('#txtsendMessage').val(), phone: "2"},
                    type: "POST",
                    success: function (response) {
                        $('#txtsendMessage').val('');
                        //console.log(response);
                        $('#lblsendMessage').addClass('alert alert-success');
                        $('#lblsendMessage').html('Notification Sent Successfully.');
                    }
                });
            }
        });

        $('#btnConfirm').click(function () {
            var status = 0;
            $('.checkAll').each(function () {
                if (this.checked) {
                    status++;
                }
            });
            if (status == 0) {
                alert('Please select at least one record to Confirm!');
                return false;
            } else {
                return confirm('Are you sure you want to Confirm the above selected Bookings?');
            }
        });

        $("#search_hourlyonhirerecord").click(function () {
            var eta = $('#search_by_pickupdate').val();
            if (eta == '') {
                alert('Please Pickup Date for Search!')
                return false;
            }

            var link = 'index?Hourlyonhire[hourlyonhire_pickupdatetime]=' + eta + '&Hourlyonhire_page=1&ajax=hourlyonhire-grid';
            $.ajax({
                url: link,
                type: "GET",
                success: function (out_res) {
                    $("#maincontent").html(out_res);
                    $('#search_by_pickupdate').val(eta);
                    $('html, body').animate({
                        scrollTop: $(".breadcrumb").offset().top - 10
                    }, 1000);
                }
            });
        });
        $("#search_hourlyonhirereset").click(function () {
            $('#search_by_pickupdate').val('');
            var link = 'index?ajax=hourlyonhire-grid&Hourlyonhire_page=1';
            $.ajax({
                url: link,
                type: "GET",
                success: function (out_res) {
                    $("#maincontent").html(out_res);
                    $('html, body').animate({
                        scrollTop: $(".breadcrumb").offset().top - 10
                    }, 1000);
                }
            });
        });
    });
</script>

