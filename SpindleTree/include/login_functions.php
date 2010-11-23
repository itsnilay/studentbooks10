<?php // login_functions 1.0

//This page defines two functions used by login/logout process

/* This function determines and freturns qn abosolute URL
 * It takes one argument: the page that conclude the URL
 * The argument defaults to index.php
 */
function absolute_url($page = 'index.php'){
    //start defining URL...
    //URL is http:// plus the host name plus the current directory:
    $url='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
    
    //Remove any trailing slashes:
    $url = rtrim($url, '/\\');
    
    //add the page:
    $url .= '/' . $page;
    
    //return the url
    return $url; 
    
 }// end of absolute_url

function check_login($dbc, $email='', $pass=''){
    $errors = array(); // initialize error array
    
    //validate the email address
    if(empty($email)){
        $errors[] = 'You forgot to enter your email address';
    }else{
        $e = mysqli_real_escape_string($dbc, trim($email));
    }
    
    //validate the password:
    if(empty($pass)){
         $errors[] = 'You forgot to enter your password'; 
    }else{
        $p = mysqli_real_escape_string($dbc, trim($pass));
    }
    
    if(empty($errors)){//if everything's ok
        //retrieve the user id and first name for that email/password combination:
	 $query = "SELECT user_id, first_name FROM users WHERE email='$e' AND password=SHA1('$p')";
	 $result = mysqli_query($dbc, $query) or trigger_error("Query: $query\n<br/>MySQL Error: " .mysqli_error($dbc));

	 if (mysqli_num_rows($result)==1){
            //fetch the record:
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            
            //return true and the record:
            return array(TRUE, $row);
        }else{//not a match!
            $errors[]='The email address and password entered do not match those on file.';
        }
        
    }//end of empty($errors) IF
    
    //Return false and the errors:
    return array(FALSE, $errors);
    
}//end of check login

?>