<?php
   require APPROOT . '/views/includes/head.php';
?>
<div id="section-landing-campaign">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>

	<div class="container-campaign">
        <div class="wrapper-campaign">
			
				<div class="col-md-12">
					<div class="col-md-8">
						<h2><?php echo $data['campaign_type']; ?> Campaign Data:</h2> <br>
						<table class="table">
							<tr>
								<th>Campaign Id</th>
								<th>Campaign Name</th>
								<th>Total Revenue</th>
							</tr>
							<?php
							if($data['campaigns']) {
								// output data of each row
								foreach($data['campaigns'] as $campaign) { ?>
									<tr>
										<td><?php echo $campaign->id; ?></td>
										<td><?php echo $campaign->campaign_name; ?></td>
										<td><?php echo $campaign->total_revenue; ?></td>
									</tr>
								<?php
								}
							}else { ?>
								<tr>
									<td colspan="3">No Data</td>
								</tr>
							<?php
							} ?>
						</table>
					</div>
					<div class="col-md-4">
						<?php
							require APPROOT . '/views/campaigns/campaign_filter.php';
						?>
					</div>
				</div>
    	</div>
	</div>
</div>