if (isset($_POST['users_id'])) {
    if ($_POST['users_id'] != "") { 
        /* Checking User Uploaded or Followed any Product or Not*/
        $check_user_uploaded_product = "SELECT `product_id` FROM `po_product` WHERE `product_usersID` =".$_POST['users_id']." UNION SELECT `following_productID` FROM `po_following` WHERE `following_usersID` = ".$_POST['users_id'];        
		$check_product_status = mysql_query($check_user_uploaded_product, $link) or die('Errant query:  ' . $check_user_uploaded_product);        
        
		if (mysql_num_rows($check_product_status) == 0) {  
            $posts = array('status'=>"0",'error_code' => '157');
        } else {
            /* Fetching User Uploaded or Followed Product_Id If Any */
            $users_product = "SELECT `product_id` FROM `po_product` WHERE `product_usersID` =".$_POST['users_id']." UNION SELECT `following_productID` FROM `po_following` WHERE `following_usersID` = ".$_POST['users_id'];            
			$result = mysql_query($users_product) or die('Errant query:  ' . $users_product);
            $cnt=0;
            
			while($row = mysql_fetch_array($result)) {
                    /* Fetching Notification List According to User Upload or follow*/
                    /* ------------------------------------------- */
                    $notification = "SELECT p.`product_id`, p.`product_name`, p.`product_image_thumbnail`, nm.`notifications_id`, nm.`notifications_usersID`, nm.`notifications_action`, nm.`notifications_users_name` FROM `po_product` p, `po_notifications` nm WHERE nm.`notifications_productID` = p.`product_id` AND nm.`notifications_productID` =".$row['product_id']." AND `notifications_status`=0 AND `notifications_usersID` = ".$_POST['users_id'];
					$notification_msg = mysql_query($notification) or die('Errant query:  ' . $notification);
					if(mysql_num_rows($notification_msg) == 0) {                        
						$posts["status"] = "0";
                        $posts["error_code"] = "157";
					} else {
						while($noti_msg = mysql_fetch_array($notification_msg)) {
							if ($notification) { $cnt=1;
							$posts["status"] = "1";
							$posts["error_code"] = "158";
							$posts["data"]["Notifications_list"][] = array(
                                                 'Product_Id' => $noti_msg['product_id'],
                                                 'User_name' => $noti_msg['notifications_users_name'],
                                                 'Notifications_Action' => $noti_msg['notifications_action'],
                                                 'Product_Subject' => $noti_msg['product_name'], 
                                                 'Product_Image_thumbnail' => $noti_msg['product_image_thumbnail'], 
                                                 );
                                                 //'Product_Video' => $noti_msg['product_video']
                        
							/* Updating Notification's Status */
							$update_notification = "UPDATE `po_notifications` SET `notifications_status`=1 WHERE `notifications_id` =".$noti_msg['notifications_id'];
							$update_noti = mysql_query($update_notification) or die('Errant query:  ' . $update_notification);
							} else {
								$posts = array('Status'=>"0",'error_code' => '159');
								//$posts["data"] = array('Mes' => 'Error to get Notifications');
							}
                    }
                    
                }if($cnt==1){
                        $posts["status"] = "1";
                        $posts["error_code"] = "158";
                    }
                    
                    /* ------------------------------------------- */
            }
                /* Showing Total Number of Notifications */
            }
            header('Content-type: application/json');
            echo json_encode($posts);
        /* disconnect from the db */
        @mysql_close($link);
    } else {
        $posts = array('status'=>"0",'error_code' => '104');
        //$posts["data"] = array("Mes" => 'Invalid service details');
        header('Content-type: application/json');
        echo json_encode($posts);
    }
} else {
    $posts = array('status'=>"0",'error_code' => '104');
    //$posts["data"] = array("Mes" => 'Invalid service details');
    header('Content-type: application/json');
    echo json_encode($posts);
}
@mysql_close($link);