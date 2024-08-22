<?php 
    include ('config/config.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = " DELETE FROM categories WHERE id='$id'";
        $query = mysqli_query($conn, $sql);

        if($query){
            $msg= '<div class="alert alert-success alert-dismissible"><span class="close" data-dismiss="alert" aria-label="close">x</span>Category Successfully Deleted!</div>';
            header('Location: view_categories.php?msg='.$msg);
        }
    }


?>