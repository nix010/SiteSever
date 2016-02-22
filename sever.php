<?php
    $db=mysql_select_db('user_info',mysql_connect('localhost', 'root', '')) or die("Failed to connect to MySQL: " . mysql_error());
    if ($_POST['_action']=="add")
    {

    	$username = $_POST['_username'];
    	$password = $_POST['_password'];
    	$name = $_POST['_name'];
    	$email = $_POST['_email'];
    	
		$password = md5($password);
		if (mysql_num_rows(mysql_query("SELECT email FROM info_table WHERE email='$email'")) > 0){
    		echo "email";
	        exit;
	    }
    	if (mysql_num_rows(mysql_query("SELECT username FROM info_table WHERE username='$username'"))>0)
	    {
    		echo "username";
	        exit;
	    }
	    
   		
    	if(mysql_query("INSERT INTO `info_table`(`username`, `password`, `fullname`, `email`) VALUES('$username','$password','$name','$email')"))
    	{	
    		echo "complete";
			exit;
		}
    }else if($_POST['_action']=="delete")
    {
    	$username = $_POST['_username'];
    	if (mysql_num_rows(mysql_query("SELECT username FROM `info_table` WHERE username ='$username'"))==0)
	    {
    		echo "false";
	        exit;
	    }else	    
    		if (mysql_query("DELETE FROM `info_table` WHERE username='$username'"))
    			echo "true";
    		else
    			echo "error";



    }
    else if($_POST['_action']=="edit")
    {
    	$username = $_POST['_username'];
    	$usernameNew = $_POST['_usernameNew'];

    	$passwordNew = $_POST['_passwordNew'];
    	$nameNew = $_POST['_nameNew'];
    	$emailNew = $_POST['_emailNew'];


    	if (mysql_num_rows(mysql_query("SELECT username FROM `info_table` WHERE username ='$username'"))==0)
	    {
    		echo "false";
	        exit;
	    }else	    
    	{
    		if(mysql_query("DELETE FROM `info_table` WHERE username='$username'"))
    			if(mysql_query("INSERT INTO `info_table`(`username`, `password`, `fullname`, `email`) VALUES('$usernameNew','$passwordNew','$nameNew','$emailNew')"))
    			echo "true";
    		else
    			echo "error";

    		else
    			echo "error";

    	}
    }

?>