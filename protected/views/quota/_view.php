<div class="view">   

    <h4><?php echo CHtml::encode($model->quota_name); ?></h4>
    <hr/>   
    <?php echo $model->quota_desc; ?>

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