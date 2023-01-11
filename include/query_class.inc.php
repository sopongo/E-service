<?PHP
!isset($_SESSION['sess_class_user']) ? $_SESSION['sess_class_user']=0 : '';

switch($_SESSION['sess_class_user']){ 
    case 1:// User
        ################ Start ?module=warehouse ########################  
        $class_query = "";
        ################ End ?module=warehouse ########################
      
        ################ Start ?module=requisition ########################  
        $class_query = "";
        ################ End ?module=warehouse ########################
    break;
  
    case 2://Super User
        ################ ?module=warehouse ########################  
        $class_query = "";
        ################ ?module=warehouse ########################
    break;

    case 3://Super User
        ################ ?module=warehouse ########################  
        $class_query = "";
        ################ ?module=warehouse ########################
    break;

    case 4://Administrator
        ################ ?module=warehouse ########################  
        $class_query = "";
        ################ ?module=warehouse ########################
    break;
  
    default:
      session_destroy(); die(include('login.inc.php')); 
    break;
}
?>