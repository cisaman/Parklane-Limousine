<div id="maincontent">
    <?php
    $this->pageTitle = Yii::t('lang', 'parklane') . ' | ' . Yii::t('lang', 'manage') . ' ' . Yii::t('lang', 'airport_transfer') . ' ' . Yii::t('lang', 'service');

    Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function(){
                $('#arrival-grid').yiiGridView('update', {
                        data: $(this).serialize()
                });        
                return false;
        });
    ");
    ?>

    <!-- begin PAGE TITLE AREA -->
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title">            
                <ol class="breadcrumb">
                    <li><h1><i class="fa fa-user"></i> <?php echo Yii::t('lang', 'manage') . ' ' . Yii::t('lang', 'airport_transfer') . ' ' . Yii::t('lang', 'service') . ' - ' . Yii::t('lang', 'arrival'); ?></h1></li>
                </ol>
            </div>
        </div>    
    </div>
    <!-- end PAGE TITLE AREA -->

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

                    <div class="row">
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-1">
                                    <label style="width: 100%; margin: 0px; text-align: right; font-weight: bold ! important; line-height: 34px;">
                                        Search:
                                    </label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" placeholder="ETA" class="form-control" id="search_by_eta"/>
                                </div>
                                <div class="col-sm-3">
                                    <input type="button" class="btn btn-success" id="search_arrivalrecord" value="Search" style="margin: 0px; line-height: 21px; width: 60px;"/>
                                    <input type="button" class="btn btn-danger" id="search_arrivalreset" value="Reset" style="margin: 0px; line-height: 21px; width: 60px;"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-12">                                
                            <div class="table-responsive">
                                <form action="<?php echo Utils::getBaseUrl() ?>/booking/confirm" method="post">
                                    <?php
                                    $this->widget('zii.widgets.grid.CGridView', array(
                                        'id' => 'arrival-grid',
                                        'htmlOptions' => array('class' => 'dataTables_wrapper sampleScroll', 'role' => 'grid'),
                                        'dataProvider' => $model->search(1),
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
                                                'value' => 'Booking::getOrderNoForList($data->booking_eta, $data->booking_id)',
                                                'htmlOptions' => array('style' => 'text-align:center'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:150px'),
                                            ),
                                            array(
                                                'name' => 'booking_userID',
                                                'value' => 'User::model()->getUserName($data->booking_userID)',
                                                'htmlOptions' => array('style' => 'text-align:center;-ms-word-break: break-all;word-break: break-all;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:200px'),
                                                'filter' => CHtml::activeDropDownList($model, 'booking_userID', CHtml::listData(User::model()->findAll(array('distinct' => true)), 'user_id', 'user_name'), array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' => $model->getAttributeLabel('booking_userID')))
                                            ),
                                            array(
                                                'name' => 'booking_passenger_name',
                                                'value' => '$data->booking_initials." ".$data->booking_passenger_name',
                                                'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:220px'),
                                                'filter' => CHtml::activeTextField($model, 'booking_passenger_name', array('placeholder' => $model->getAttributeLabel('booking_passenger_name'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                            ),
                                            array(
                                                'name' => 'booking_model',
                                                'type' => 'raw',
                                                'value' => 'CHtml::link(Booking::model()->getBookingCarModelByID($data->booking_model), "", array("class" => "text-green text-bold"))',
                                                'htmlOptions' => array('style' => 'text-align:left;-ms-word-break: break-all;word-break: break-all;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:200px'),
                                                'filter' => CHtml::activeDropDownList($model, 'booking_model', Booking::model()->getBookingCarModel(), array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' => $model->getAttributeLabel('booking_model')))
                                            ),
                                            array(
                                                'name' => 'booking_flight_no',
                                                'value' => '$data->booking_flight_no',
                                                'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:200px'),
                                                'filter' => CHtml::activeTextField($model, 'booking_flight_no', array('placeholder' => $model->getAttributeLabel('booking_flight_no'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                            ),
                                            array(
                                                'name' => 'booking_eta',
                                                'value' => 'Booking::getETAForList($data->booking_eta)',
                                                'htmlOptions' => array('style' => 'text-align:center;-ms-word-break: break-all;word-break: break-all;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:250px'),
                                                'filter' => CHtml::activeTextField($model, 'booking_eta', array('placeholder' => $model->getAttributeLabel('booking_eta'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                            ),
                                            array(
                                                'name' => 'booking_districtID',
                                                'value' => 'District::model()->getDistrictName($data->booking_districtID)',
                                                'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:200px'),
                                                'filter' => CHtml::activeDropDownList($model, 'booking_districtID', District::model()->getDistrictList(), array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' => $model->getAttributeLabel('booking_districtID')))
                                            ),
                                            array(
                                                'name' => 'booking_paidamount',
                                                'value' => '"HK$ " . $data->booking_paidamount',
                                                'htmlOptions' => array('style' => 'text-align:center;-ms-word-break: break-all;word-break: break-all;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:200px'),
                                                'filter' => CHtml::activeTextField($model, 'booking_paidamount', array('placeholder' => $model->getAttributeLabel('booking_paidamount'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                            ),
                                            array(
                                                'name' => 'booking_created',
                                                'value' => '$data->booking_created',
                                                'htmlOptions' => array('style' => 'text-align:center;-ms-word-break: break-all;word-break: break-all;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:250px'),
                                                'filter' => CHtml::activeTextField($model, 'booking_created', array('placeholder' => $model->getAttributeLabel('booking_created'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                            ),
                                            array(
                                                'header' => 'Token',
                                                'type' => 'raw',
                                                'value' => 'Booking::getTokenForList($data->booking_id)',
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
                                                'deleteConfirmation' => 'Do you really want to delete this Booking?',
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
                                                //'visible' => Yii::app()->user->name == 'Super Admin',
                                                'buttons' => array
                                                    (
                                                    'send' => array
                                                        (
                                                        'label' => '<i class="fa fa-send text-green"></i>',
                                                        'options' => array(
                                                            'title' => 'Send Notification',
                                                            'class' => 'sendMsg',
                                                            'data' => '1'
                                                        ),
                                                        'imageUrl' => FALSE,
                                                        'url' => 'Yii::app()->createUrl("webservice/sendnotification", array("id" => $data->booking_id))'
                                                    ),
                                                ),
                                            ),
                                            array(
                                                'header' => '<input type="checkbox" id="selectAllArrivals"/>',
                                                'type' => 'raw',
                                                'value' => 'Booking::getCheckBoxForList(1, $data->booking_id)',
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:30px'),
                                                'htmlOptions' => array('style' => 'text-align:center;'),
                                            ),
                                        ),
                                        'rowCssClassExpression' => 'Utils::getColorClass($data->booking_statuscode)',
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
                                            <input type="hidden" name="type" value="1" />
                                            <input type="submit" value="E-mail" class="btn btn-green"/>
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
    </div><!-- /.modal -->

</div>

<script type="text/javascript">
    $(document).ready(function () {

        $('#selectAllArrivals').click(function (event) {
            if (this.checked) {
                $('.checkAllArrivals').each(function () {
                    this.checked = true;
                });
            } else {
                $('.checkAllArrivals').each(function () {
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
            $flag = 0;
            if ($('#driver_name').val() == '') {
                $('#lblMsg').addClass('alert alert-danger');
                $('#lblMsg').html('Please enter Driver Name');
                $('#driver_name').focus();
                return false;
            } else {
                $flag++;
            }

            if ($('#license_number').val() == '') {
                $('#lblMsg').addClass('alert alert-danger');
                $('#lblMsg').html('Please enter License Number');
                $('#license_number').focus();
                return false;
            } else {
                $flag++;
            }

            if ($('#contact').val() == '') {
                $('#lblMsg').addClass('alert alert-danger');
                $('#lblMsg').html('Please enter Contact Number');
                $('#contact').focus();
                return false;
            } else {
                $flag++;
            }

            $('#lblMsg').removeClass('alert alert-danger');
            $('#lblMsg').html('');
            if ($flag == 3) {
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
            }

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
    });</script>

<style type="text/css">
    .text-bold {font-weight: bold;}
    .portlet .portlet-body {padding: 5px !important;}
    .datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-top {top:227px !important;}
</style>

<link href="<?php echo Yii::app()->request->baseUrl ?>/bootstrap/dashboard/css/bootstrap-datepicker.min.css" rel="stylesheet" media="screen"/>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/bootstrap/dashboard/js/bootstrap-datepicker.min.js" charset="UTF-8"></script>

<script type="text/javascript">

    $(document).ready(function () {

        $('#search_by_eta').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: 1,
            todayHighlight: 1
        });

        $("#search_arrivalrecord").click(function () {
            var eta = $('#search_by_eta').val();
            if (eta == '') {
                alert('Please ETA for Search!')
                return false;
            }

            var link = 'arrival?Booking[booking_eta]=' + eta + '&Booking_page=1&ajax=Arrival-grid';
            $.ajax({
                url: link,
                type: "GET",
                success: function (out_res) {
                    $("#maincontent").html(out_res);
                    $('#search_by_eta').val(eta);
                    $('html, body').animate({
                        scrollTop: $(".breadcrumb").offset().top - 10
                    }, 1000);
                }
            });
        });
        $("#search_arrivalreset").click(function () {
            $('#search_by_eta').val('');
            var link = 'arrival?ajax=Arrival-grid&Booking_page=1';
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

        $('#btnConfirm').click(function () {
            var status = 0;
            $('.checkAllArrivals').each(function () {
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

    });
</script>
