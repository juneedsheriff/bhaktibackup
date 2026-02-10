<?php ob_start();
include_once './includes/header.php';
include_once './class/fileUploader.php';

if($_REQUEST['form_action'] == "Add")
{
	$id= $xssClean->clean_input($_REQUEST['get_id']);	
	$name= $xssClean->clean_input($_REQUEST['name']);
	$mobile=$xssClean->clean_input($_REQUEST['mobile']);
	$address=  $xssClean->clean_input($_REQUEST['address']);
	$username= trim($xssClean->clean_input($_REQUEST['username']));
	$designation=$xssClean->clean_input($_REQUEST['designation']);
	$password=base64_encode($_REQUEST['password']);	

	if($id>0){
		$DatabaseCo->dbLink->query("UPDATE `staff` SET `name` = '$name', `mobile` = '$mobile', `address` = '$address', `designation` = '$designation', `password` = '$password' WHERE `index_id` = '$id'") or die(mysqli_error($DatabaseCo->dbLink));
	} else {
		$DatabaseCo->dbLink->query("INSERT INTO `staff` (`name`,`mobile`,`address`,`username`,`password`,`designation`) VALUES ('$name','$mobile','$address','$username','$password','$designation')") or die(mysqli_error($DatabaseCo->dbLink));
    	$id=mysqli_insert_id($DatabaseCo->dbLink);
    	// $DatabaseCo->dbLink->query("INSERT INTO `staff_privilege` (`staff_id`, `driver_view`, `driver_add`, `driver_edit`, `driver_delete`, `driver_approval`, `agency_view`, `agency_add`, `agency_edit`, `agency_delete`, `agency_approval`, `vehicle_view`, `vehicle_add`, `vehicle_edit`, `vehicle_delete`, `vehicle_approval`, `wallet_update`, `wallet_approval`, `affiliates_view`, `affiliates_add`, `affiliates_edit`, `affiliates_delete`, `affiliates_approval`, `packages_view`, `packages_update`, `packages_delete`, `trips_live`, `trips_history`) VALUES ('$id', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0','0', '0', '0', '0', '0')");
    }

	$uploadimage = new ImageUploader($DatabaseCo);
    $photos = is_uploaded_file($_FILES['photos']["tmp_name"])?$uploadimage->upload($_FILES['photos'],"staff"):'';
    if($photos!=''){
		$DatabaseCo->dbLink->query("UPDATE `staff` SET photos='$photos' WHERE index_id='$id'");
	}		
}

if($_REQUEST['action']=='Update')
{
	$id= $xssClean->clean_input($_REQUEST['staff_id']);
    $newpass=trim($_REQUEST['newpassword']);
    $newpass=base64_encode($newpass);    

    $sql="update staff set `password`='$newpass' where `index_id`='$id'";
    $go=mysqli_query($DatabaseCo->dbLink,$sql);
    echo "Password is updated successfully.";
}

if($_REQUEST['form_action']=='privilege_save')
{
	$id=$xssClean->clean_input($_REQUEST['staff_id']);
	$DatabaseCo->dbLink->query("UPDATE `staff_privilege` SET `driver_view`='".$_REQUEST['driver_view']."',`driver_add`='".$_REQUEST['driver_add']."',`driver_edit`='".$_REQUEST['driver_edit']."',`driver_delete`='".$_REQUEST['driver_delete']."',`driver_approval`='".$_REQUEST['driver_approval']."',`driver_reject`='".$_REQUEST['driver_reject']."',`agency_view`='".$_REQUEST['agency_view']."',`agency_add`='".$_REQUEST['agency_add']."',`agency_edit`='".$_REQUEST['agency_edit']."',`agency_delete`='".$_REQUEST['agency_delete']."',`agency_approval`='".$_REQUEST['agency_approval']."',`agency_reject`='".$_REQUEST['agency_reject']."',`vehicle_view`='".$_REQUEST['vehicle_view']."',`vehicle_add`='".$_REQUEST['vehicle_add']."',`vehicle_edit`='".$_REQUEST['vehicle_edit']."',`vehicle_delete`='".$_REQUEST['vehicle_delete']."',`vehicle_approval`='".$_REQUEST['vehicle_approval']."',`vehicle_reject`='".$_REQUEST['vehicle_reject']."',`wallet_update`='".$_REQUEST['wallet_update']."',`wallet_approval`='".$_REQUEST['wallet_approval']."',`affiliates_view`='".$_REQUEST['affiliates_view']."',`affiliates_add`='".$_REQUEST['affiliates_add']."',`affiliates_edit`='".$_REQUEST['affiliates_edit']."',`affiliates_delete`='".$_REQUEST['affiliates_delete']."',`affiliates_approval`='".$_REQUEST['affiliates_approval']."',`packages_view`='".$_REQUEST['packages_view']."',`packages_update`='".$_REQUEST['packages_update']."',`packages_delete`='".$_REQUEST['packages_delete']."',`trips_live`='".$_REQUEST['trips_live']."',`trips_history`='".$_REQUEST['trips_history']."' WHERE `staff_id`='$id'");
}
?>