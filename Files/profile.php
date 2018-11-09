<?php

    /*
    *   @author Owen Morgan (OM Solutions)
    *   @copyright OM Solutions 2018
    */
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 1);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	if(isset($_GET['id'])){
		$userInfo = getUserInfo($_GET['id']);
	}else{
		$userInfo = getUserInfo($UserArray['userid']);
	}
?>

<title>WMRPC - <?php echo $userInfo['first_name']; ?> <?php echo $userInfo['surname']; ?></title>

<div class="container" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-12">
			<div class="card custom-card">
				<div class="profile-header">
				</div>
				<div class="profile-avatar">
					<img src="./_assets/img/logo.png" class="avatar img-thumbnail">
				</div>
			</div>
            <div class="row">
                <div class="col-md-4">
                	<br>
	                <div class="card custom-card">
	                	<table class="table table-responsive-xl" id="refreshDiv">
	                		<thead class="thead-light">
	                			<tr>
	                				<th scope="col" colspan="2">About <?php echo $userInfo['surname']; ?></th>
	                			</tr>
	                		</thead>
	                		<tbody>
	                			<tr>
	                				<td><i class="fa fa-user"></i> <b>UserID:</b></td>
	                				<td>#<?php echo $userInfo['userid']; ?></td>
	                			</tr>
	                			<tr>
	                				<td><i class="fa fa-user"></i> <b>Collar Number:</b></td>
	                				<td><?php echo $userInfo['collar']; ?></td>
	                			</tr>
	                			<tr>
	                				<td><i class="fa fa-user"></i> <b>Registered:</b></td>
	                				<td><?php echo date('jS F Y', $userInfo['joindate']); ?></td>
	                			</tr>
	                		</tbody>
	                	</table>
            	    </div>
            	</div>
            	<?php
            	$permCheck = haveGeneralPerm($UserArray['userid'], 256);

				if($permCheck == true){
            	?>
            	<div class="col-md-4">
            	<?php
            	}else{
            	?>
            	<div class="col-md-8">
            	<?php
            	}
            	?>
            		<Br>
            		<div class="alert alert-danger panic" style="text-align: center;"><b>Hey You!</b> Nothing to show here!</div>
            	</div>
            	<?php
            	$permCheck = haveGeneralPerm($UserArray['userid'], 256);

				if($permCheck == true){
            	?>
            	<div class="col-md-4">
                	<br>
	                <div class="card custom-card">
	                	<table class="table table-responsive-xl" id="refreshDiv">
	                		<thead class="thead-light">
	                			<tr>
	                				<th scope="col">Quick Links</th>
	                			</tr>
	                		</thead>
	                		<tbody>
	                			<tr>
	                				<td><i class="fa fa-users"></i> <a href="./editUser.php?uid=<?php echo $userInfo['userid']; ?>" style="color: #212529;">Modify User</a></td>
	                			</tr>
	                		</tbody>
	                	</table>
            	    </div>
            	</div>
            	<?php
            	}
            	?>
			</div>
		</div>
	</div>
</div>