<?php
var_dump($_POST);
extract($_POST);

include "conn.php";
$sql="SELECT * FROM item WHERE itemID='$edItemID'";
$rs=mysqli_query($conn, $sql) or die($conn);
$num=mysqli_num_rows($rs);
if($num==0){
    echo "No row has been select";
}else{
    $sql5="UPDATE item SET itemName='$edItemName', itemDescription='$edDescription', stockQuantity='$edStockQuantity', price='$edPrice'
            WHERE itemID='$edItemID'";
    mysqli_query($conn, $sql5) or die($conn);
    $num5=mysqli_affected_rows($conn);
    if($num5==1){
        echo "Update successful";
    }else{
        echo "Fails to update";
    }
}
mysqli_close($conn);
header("Location:searchItem.php");
?>