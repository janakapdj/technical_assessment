<?php
   require APPROOT . '/views/includes/head.php';
?>
<div id="section-landing-campaign">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
    <div class="container-campaign">
        <div class="wrapper-campaign">
            <?php
                require APPROOT . '/views/campaigns/campaign_filter.php';
            ?>
        </div>
    </div>
</div>