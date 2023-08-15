<?php 
if($required != ""){

    echo "<div class = 'alert alert-danger'>" . $required . "</div>";
}else{
    echo "<div class = 'alert alert-success'>" . $success . "</div>";
}


?>