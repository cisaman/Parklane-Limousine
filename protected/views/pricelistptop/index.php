<?php
$this->pageTitle = Yii::t('lang', 'parklane') . ' | ' . Yii::t('lang', 'manage') . ' ' . Yii::t('lang', 'pricelistptop');

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pricelistptop-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

function getVerticalString($string) {
    $strArr = explode("\r\n", $string);
    $max = max(array_map('strlen', $strArr));
    $vertical = '';

    for ($i = 0; $i < $max; $i++) {
        for ($x = 0; $x < count($strArr); $x++) {
            $strVal = $strArr[$x];
            $y = $i - ($max - strlen($strVal));
            $vertical .= strlen(trim($strVal[$y])) <> 0 ? $strVal[$y] . "<br/> " : "<br/> ";
        }
        $vertical .="\n";
    }
    echo $vertical;
}
?>

<!-- begin PAGE TITLE AREA -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">            
            <ol class="breadcrumb">
                <li><h1><i class="fa fa-user"></i> <?php echo Yii::t('lang', 'manage') . ' ' . Yii::t('lang', 'pricelistptop'); ?></h1></li>
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
                    <div class="col-md-12">                                
                        <div class="table-responsive" style="height: 580px; width: 100%;overflow: scroll" id="setall">
                            <?php
                            $getCountry = Country::model()->findAll();
                            $countCountry = count($getCountry);

                            $countDistrict = array();
                            $sum = 0;
                            for ($i = 0; $i < $countCountry; $i++) {
                                $getGroups = Countrydistrictgroup::model()->findAll('group_countryID=' . $getCountry[$i]->country_id);
                                $countDistrict[$i] = count($getGroups);
                                $sum += $countDistrict[$i];
                            }

                            $text_colors = array(0 => 'text-blue', 1 => 'text-purple', 2 => 'text-green', 3 => 'text-blue', 4 => 'text-purple', 5 => 'text-green');
                            $bg_colors = array(0 => 'bg-blue', 1 => 'bg-purple', 2 => 'bg-green', 3 => 'bg-blue', 4 => 'bg-purple', 5 => 'bg-green');
                            $classes = array(0 => 'classA', 1 => 'classB', 2 => 'classC', 3 => 'classA', 4 => 'classB', 5 => 'classC');
                            ?>

                            <div class="mybox" id="set1" style="z-index: 99999;">
                                <div class="col-md-10 col-md-offset-2" style="padding-left: 5px;">
                                    <table class="table table-bordered" style="background-color: #fff;">
                                        <tr>                                             
                                            <?php for ($i = 0; $i < $countCountry; $i++) { ?>
                                                <th class="text-center <?php echo $bg_colors[$i] ?> <?php echo $classes[$i]; ?>" colspan="<?php echo $countDistrict[$i]; ?>">
                                                    <?php if (Yii::app()->user->getState('lang') == 'en') { ?>
                                                        <?php echo $getCountry[$i]->country_name_en; ?>
                                                    <?php } else { ?>
                                                        <?php echo $getCountry[$i]->country_name_ch; ?>
                                                    <?php } ?>
                                                </th>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <?php for ($i = 0; $i < $countCountry; $i++) { ?>
                                                <?php
                                                $country_id = $getCountry[$i]->country_id;
                                                $getGroups = Countrydistrictgroup::model()->findAll('group_countryID=' . $country_id);
                                                ?>
                                                <?php foreach ($getGroups as $group) { ?>                                                    
                                                    <td align="center" class="<?php echo $classes[$i]; ?>">
                                                        <div class="districtWidth <?php echo $text_colors[$i] ?>">
                                                            <?php
                                                            $g = explode(',', $group->group_cities); //Group City Array
                                                            $s = ''; //City String
                                                            for ($j = 0; $j < count($g); $j++) {
                                                                $r = District::model()->getDistrictName($g[$j]); //City Name Result                                                               
                                                                //$s.=$r . ' /<br/>';
                                                                $s.=$r . ' / ';
                                                            }
                                                            echo $s = rtrim($s, ' / ');
                                                            ?>
                                                        </div>
                                                    </td>                                                   
                                                <?php } ?>
                                            <?php } ?>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="mybox" id="set2" style="z-index: 99;">                                        
                                <div class="col-md-2" style="padding: 0;">
                                    <table class="table table-bordered" style="background-color: #fff;">    
                                        <?php $arrGroup = array(); ?>
                                        <?php $k = 0; ?>
                                        <?php for ($i = 0; $i < $countCountry; $i++) { ?>
                                            <?php
                                            $country_id = $getCountry[$i]->country_id;
                                            $getGroups = Countrydistrictgroup::model()->findAll('group_countryID=' . $country_id);
                                            ?>
                                            <?php
                                            $names = array();

                                            foreach ($getGroups as $group) {
                                                $arrGroup[$k] = $group->group_id;

                                                $g = explode(',', $group->group_cities); //Group City Array
                                                $s = ''; //City String
                                                for ($j = 0; $j < count($g); $j++) {
                                                    $r = District::model()->getDistrictName($g[$j]); //City Name Result                                                    
                                                    $s.=$r . ' / ';
                                                }
                                                $s = rtrim($s, ' / ');
                                                $names[] = $s;
                                                $k++;
                                            }
                                            ?> 

                                            <tr>
                                                <th class="text-center <?php echo $bg_colors[$i] ?> <?php echo $classes[$i]; ?>" rowspan="<?php echo $countDistrict[$i]; ?>" width="30px">
                                                    <?php //if (Yii::app()->user->getState('lang') == 'en') { ?>                                                    
                                                    <?php getVerticalString($getCountry[$i]->country_name_en); ?>
                                                    <?php //} else { ?>
                                                    <?php //getVerticalString($getCountry[$i]->country_name_ch); ?>
                                                    <?php //} ?>
                                                </th>

                                                <td class="fixRows <?php echo $classes[$i]; ?>">
                                                    <div class="<?php echo $text_colors[$i] ?>">
                                                        <?php echo $names[0]; ?>
                                                    </div>                                                    
                                                </td>

                                            </tr>

                                            <?php for ($z2 = 0; $z2 < $countDistrict[$i] - 1; $z2++) { ?>
                                                <tr>
                                                    <td class="fixRows <?php echo $classes[$i]; ?>">
                                                        <div class="<?php echo $text_colors[$i] ?>">
                                                            <?php echo $names[$z2 + 1]; ?>
                                                        </div>
                                                    </td>                                                    
                                                </tr>
                                            <?php } ?>

                                        <?php } ?>

                                    </table>                                            
                                </div>
                            </div>

                            <div class="mybox" id="set3" style="z-index: 99;">                                        
                                <div class="col-md-10" style="padding-left: 5px;">
                                    <table class="table table-bordered">

                                        <?php for ($i = 0; $i < $sum; $i++) { ?>
                                            <tr>                                                
                                                <?php for ($j = 0; $j < $sum; $j++) { ?>      
                                                    <?php
                                                    $set = 2;
                                                    if ($arrGroup[$i] == $arrGroup[$j]) {
                                                        $set = 0;
                                                    }
                                                    ?>
                                                    <td class="fixRows classD">
                                                        <div>
                                                            <?php $getPrice = Pricelistptop::model()->getPriceByFromTo($arrGroup[$i], $arrGroup[$j]); ?>
                                                            <p style="font-weight: bold; font-size: 26px;">
                                                                HK$<span id="id_<?php echo $arrGroup[$i] . '_' . $arrGroup[$j]; ?>"><?php echo $getPrice; ?></span>
                                                            </p>
                                                            <p>
                                                                <a 
                                                                    class="myInput" 
                                                                    href="javascript:void(0);" 
                                                                    group-from="<?php echo $arrGroup[$i]; ?>"
                                                                    group-to="<?php echo $arrGroup[$j]; ?>"                                                                         
                                                                    >                                                                        
                                                                    <i class="fa fa-edit fa-2x <?php echo $text_colors[$set]; ?>"></i>
                                                                </a>
                                                            </p>
                                                        </div>                                                            
                                                    </td>
                                                <?php } ?>        
                                            </tr>                                            
                                        <?php } ?>

                                    </table>
                                </div>                                        
                            </div>                                    

                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>    
</div>


<!-- Modal -->
<div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title text-center text-blue" id="standardModalLabel" style="font-weight: bold;">Set Fare</h4>
            </div>
            <div class="modal-body">
                <div id="message" class="text-center"></div>
                <table class="table table-bordered">
                    <tr>
                        <td align="center" width="50%">
                            <p class="text-blue">From : <span id="lblCountryFrom"></span><hr/></p>
                        </td>
                        <td align="center">
                            <p class="text-blue">To : <span id="lblCountryTo"></span><hr/></p>
                        </td>
                    </tr>                    
                    <tr>
                        <td align="center" width="50%"><p id="lblGroupFrom"></p></td>
                        <td align="center"><p id="lblGroupTo"></p></td>
                    </tr>
                    <tr>
                        <td><p style="margin-top: 5px; margin-bottom: 5px; font-weight: bold; text-align: center;">Amount HK($)</p></td>
                        <td>
                            <input type="text" id="txtPrice" maxlength="5" class="form-control numeric" style="text-align: left;" placeholder="Enter Amount HK($)" data-from="" data-to=""/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>                            
                            <button type="button" class="btn btn-success" id="btnSave">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>                            
                        </td>
                    </tr>
                </table>
            </div>            
        </div>        
    </div>    
</div>
<!-- Modal -->


<style type="text/css">
    hr{margin: 0px ! important;border-color: #34495e ! important;}
    .text-green, .text-blue, .text-purple{font-weight: bold;}
    .bg-blue, .bg-green, .bg-purple{color: #FFF;}
    .bg-blue{background-color: #2980b9;}
    .bg-green{background-color: #16a085;}
    .bg-purple{background-color: #8e44ad;}
    input{text-align: center;}
    .fixRows {
        height: 180px;
        max-height: 300px;
        overflow: auto;    
        text-align: center;
    }
    .districtWidth{
        width: 200px;        
        max-height: 300px;
        overflow: auto;
    }    
    .fixRows > div {
        width: 200px;
        height: 290px;
        max-height: 400px;
        vertical-align: middle;
        display: table-cell;
    }  
    .fixRows > div > p{
        width: 200px;
    }
    .col-md-offset-2 {
        margin-left: 21.667%;
    }
    .col-md-2 {
        width: 21.667%;
    }
    .col-md-10{
        width: 75.333%;
    }

    .classA{border: 1px solid #2980b9 !important;}
    .classB{border: 1px solid #8e44ad !important;}
    .classC{border: 1px solid #16a085 !important;}
    .classD{border: 1px solid rgb(52,73,94) !important;}
    .modal-backdrop{z-index: 99999;}
    #inputModal{z-index: 999999;}
</style>

<script type="text/javascript">

        $('#setall').scroll(function () {
        var scrollTop = $(this).scrollTop();
        var hh = $('#set1').height();
        $('#set1').css('position', 'relative').css('top', scrollTop + hh);

        var scrollLeft = $(this).scrollLeft();
    $('#set2').css('position', 'relative').css('left', scrollLeft);
    });

        $(document).ready(function () {
            $('.myInput').click(function () {

            var from = $(this).attr('group-from');
            var to = $(this).attr('group-to');

            $('#message').removeClass('alert alert-danger');
            $('#message').html('');

                $.ajax({
                url: '<?php echo Utils::getBaseUrl() ?>/pricelistptop/getAllDetailsForPrice',
                data: {from: from, to: to},
                type: 'POST',
                    success: function (response) {
                    response = JSON.parse(response);
                    //console.log(response);
                    $('#lblCountryFrom').html(response.from.fromCountry);
                    $('#lblCountryTo').html(response.to.toCountry);
                    $('#lblGroupFrom').html(response.from.fromDistricts);
                    $('#lblGroupTo').html(response.to.toDistricts);
                    $('#txtPrice').attr('data-from', response.from.fromGroupId);
                    $('#txtPrice').attr('data-to', response.to.toGroupId);
                    $('#txtPrice').val($('#id_' + from + '_' + to).html());

                $("#inputModal").modal("show");
            }
        });
        });


            $('#btnSave').click(function () {
            var txtPrice = $('#txtPrice').val();

            $('#message').removeClass('alert alert-danger');
            $('#message').html('');

                if (txtPrice != '') {

                var fromId = $('#txtPrice').attr('data-from');
                var toId = $('#txtPrice').attr('data-to');

                    $.ajax({
                    url: '<?php echo Utils::getBaseUrl() ?>/pricelistptop/savefare',
                    data: {from: fromId, to: toId, price: txtPrice},
                    type: 'POST',
                        success: function (response) {
                        response = JSON.parse(response);
                        //console.log(response);
                            if (response.success == 0) {
                            $('#message').addClass('alert alert-danger');
                        $('#message').html(response.message);
                            } else {
                            $('#id_' + fromId + '_' + toId).html(txtPrice);
                            $('#statusMsg').addClass('alert alert-success');
                            $('#statusMsg').html(response.message);
                        $("#inputModal").modal("hide");
                    }
                }
            });
                } else {
                $('#message').addClass('alert alert-danger');
            $('#message').html('Please enter Amount.');
        }
        });

         /*----------------------------------------------------------------------------------------------------------------------------------------------
         Block Alphabets
        ----------------------------------------------------------------------------------------------------------------------------------------------*/
        /* Block Alphabets, Eg. for Contact Field */
            jQuery('.numeric').keydown(function (e) {
            // If you want decimal(.) please use 190 in inArray.
            // Allow: backspace, delete, tab, escape, enter.
                    if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                            // Allow: Ctrl+A
                            (e.keyCode == 65 && e.ctrlKey === true) ||
                                    // Allow: home, end, left, right, down, up
                        (e.keyCode >= 35 && e.keyCode <= 40)) {
                        // let it happen, don't do anything
                    return;
                    }
                    // Ensure that it is a number and stop the keypress
                        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
        });
        /*----------------------------------------------------------------------------------------------------------------------------------------------*/

    $("#statusMsg").animate({opacity: 1.0}, 3000).fadeOut("slow");

    });

</script>