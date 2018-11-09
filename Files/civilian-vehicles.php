<?php

    /*
    *   @author Owen Morgan (OM Solutions)
    *   @copyright OM Solutions 2018
    */
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 16);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	$vehicles = getVehicles();
?>

<title>WMRPC - Manage Vehicles</title>

<div class="container-fluid" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-9">
			<div class="card custom-card">
				<div class="card-header">
					Existing Vehicles
				</div>
				<table class="table table-responsive-xl" id="refreshDiv">
					<thead class="thead-light">
   						<tr>
   							<th scope="col">Ref.</th>
   							<th scope="col">Vehicle</th>
	     					<th scope="col">VRM</th>
   							<th scope="col">Owner</th>
   							<th scope="col">Status</th>
   							<th scope="col">Insurer</th>
   							<th scope="col">Insurance No.</th>
   							<th scope="col">Markers</th>
   							<th scope="col">Allowed Driver</th>
 						</tr>
					</thead>
	  				<tbody>
	  					<?php
	  					foreach($vehicles as $vehicle){
	  					?>
    					<tr>
    						<th scope="row"><?php echo $vehicle['vehicleid']; ?> <a href="./civilian-vehicle-edit.php?vid=<?php echo $vehicle['vehicleid']; ?>"><i class="fa fa-pencil-alt"></i> <a href="./civilian-vehicle-licenced.php?vid=<?php echo $vehicle['vehicleid']; ?>"><i class="fa fa-car"></i></a>  <?php if(haveGeneralPerm($UserArray['userid'], 512) == true){ ?><a href="./civilian-vehicle-delete.php?vid=<?php echo $vehicle['vehicleid']; ?>"><i class="fa fa-trash"></i></a><?php } ?></th>
    						<th><?php echo $vehicle['vehicle']; ?></th>
    						<th><?php echo $vehicle['vrm']; ?></th>
    						<td><a href="pnc-check.php?cid=<?php echo getVehicleOwner($vehicle['owner'])['civid']; ?>"><?php echo getVehicleOwner($vehicle['owner'])['name']; ?></a></td>
	      					<td><?php echo $vehicle['status']; ?></td>
	      					<td><?php echo $vehicle['insurer']; ?></td>
	      					<td><?php echo $vehicle['insurance_number']; ?></td>
	      					<td><?php echo $vehicle['markers']; ?></td>
	      					<td>
	      					<?php
	      					$allowed_drivers = getAllowedDriversForVehicle($vehicle['vehicleid']);

	      					foreach($allowed_drivers as $driver){
	      					?>
    						<a href="pnc-check.php?cid=<?php echo $driver['civid']; ?>"><?php echo $driver['name']; ?></a>, 
    						<?php
    						}
    						?>
    						</td>
    					</tr>
    					<?php
    					}
    					?>
  					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card custom-card">
				<div class="card-header">
					Create Vehicle
				</div>
				<div class="card-body">
					<?php
						if(isset($_POST['createVehicle'])) { 
			  	  			createVehicle($UserArray['userid'],$_POST['name'],$_POST['vrm'],$_POST['owner'],$_POST['status'],$_POST['insurer'],$_POST['markers']);
                    ?>
                    <div class="alert alert-success"><b>Vehicle Created</b> This vehicle has been created and is ready for use.</div>
                    <?php
						}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group col-md-12">
    						<label for="channel">Vehicle Type</label>
    						<input type="text" class="form-control" name="name" required>
  						</div>
                        <div class="form-group col-md-12">
                            <label for="channel">VRM</label>
                            <input type="text" class="form-control" name="vrm" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Vehicle Owner</label>
                            <select name="owner" class="form-control">
                                <?php
                                $civs = getCivs();

                                foreach($civs as $civ){
                                ?>
                                <option value="<?php echo $civ['civid']; ?>"><?php echo $civ['name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Status</label>
                            <input type="text" class="form-control" name="status" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Insurer</label>
                            <input type="text" class="form-control" name="insurer" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Markers</label>
                            <input type="text" class="form-control" name="markers" required>
                        </div>
  						<div class="form-group" style="width: 100%;">
							<input type="submit" name='createVehicle' class="btn btn-success btn-block" value="Create Vehicle">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<script> 
function refreshDiv() { 

    $('#refreshDiv').load(document.URL +  ' #refreshDiv');

} 

function availableUnits(){
	$('#availableUnits').load(document.URL +  ' #availableUnits');
}

function panicSection(){
	$('#panicSection').load(document.URL +  ' #panicSection');
}

window.setInterval(refreshDiv, 1000);
window.setInterval(availableUnits, 1000);
window.setInterval(panicSection, 1000);
</script>