<?php

    /*
    *   @author Owen Morgan (OM Solutions)
    *   @copyright OM Solutions 2018
    */
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 16);

if($permCheck == false OR !isset($_GET['voi'])){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	$voiInfo = getVoiInfo($_GET['voi']);
  $vehicleInfo = getVehicleInfo($voiInfo['vehicle_id']);
?>

<title>WMRPC - Edit Voi: <?php echo $vehicleInfo['vehicle']; ?> - <?php echo $vehicleInfo['vrm']; ?></title>

<div class="container-fluid" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="card custom-card">
				<div class="card-header">
					Edit VOI: <?php echo $vehicleInfo['vehicle']; ?> - <?php echo $vehicleInfo['vrm']; ?>
				</div>
				<div class="card-body">
					<?php
						if(isset($_POST['updateVoi'])) { 
			  	  	updateVoi($_GET['voi'],$_POST['image'],$_POST['reason'],$_POST['notes']);
          ?>
                    <div class="alert alert-success"><b>VOI Updated</b> The VOI has been updated.</div>
          <?php
						}
					?>
          <?php
            if(isset($_POST['clearVoi'])) { 
              clearVoi($_GET['voi']);
          ?>
                    <div class="alert alert-danger"><b>VOI Cleared</b> The VOI has been cleared.</div>
          <?php
            echo '<meta http-equiv="refresh" content="0; url=intel-vois.php" />';
            }
          ?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?voi=<?php echo $voiInfo['id']; ?>" method="post">
  						<div class="row">
                          <div class="form-group col-md-12">
                              <label for="channel">Image</label>
                              <input type="text" class="form-control" name="image" value="<?php echo $voiInfo['image']; ?>" required>
                          </div>
	                        <div class="form-group col-md-12">
    	                        <label for="channel">Reason</label>
                              <textarea class="form-control" name="reason" required><?php echo $voiInfo['reason']; ?></textarea>
            	            </div>
                	        <div class="form-group col-md-12">
    	                        <label for="channel">Notes</label>
        	                    <textarea class="form-control" name="notes" required><?php echo $voiInfo['notes']; ?></textarea>
            	            </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name='updateVoi' class="btn btn-success btn-block" value="Update VOI Record">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name='clearVoi' class="btn btn-danger btn-block" value="Clear VOI">
                        </div>
                      </div>
					</form>