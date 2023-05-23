<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>manager(before generate record)</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Navbar-With-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<?php
include "conn.php";
extract($_POST);
$sql="SELECT staffID, staffName FROM staff";
$rs=mysqli_query($conn, $sql) or die(mysqli_error($conn));
?>
<body>
<div>
    <nav class="navbar navbar-light navbar-expand-md py-3">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><span
                        class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"><svg
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em"
                            fill="currentColor">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M96 191.1H32c-17.67 0-32 14.33-32 31.1v223.1c0 17.67 14.33 31.1 32 31.1h64c17.67 0 32-14.33 32-31.1V223.1C128 206.3 113.7 191.1 96 191.1zM512 227c0-36.89-30.05-66.92-66.97-66.92h-99.86C354.7 135.1 360 113.5 360 100.8c0-33.8-26.2-68.78-70.06-68.78c-46.61 0-59.36 32.44-69.61 58.5c-31.66 80.5-60.33 66.39-60.33 93.47c0 12.84 10.36 23.99 24.02 23.99c5.256 0 10.55-1.721 14.97-5.26c76.76-61.37 57.97-122.7 90.95-122.7c16.08 0 22.06 12.75 22.06 20.79c0 7.404-7.594 39.55-25.55 71.59c-2.046 3.646-3.066 7.686-3.066 11.72c0 13.92 11.43 23.1 24 23.1h137.6C455.5 208.1 464 216.6 464 227c0 9.809-7.766 18.03-17.67 18.71c-12.66 .8593-22.36 11.4-22.36 23.94c0 15.47 11.39 15.95 11.39 28.91c0 25.37-35.03 12.34-35.03 42.15c0 11.22 6.392 13.03 6.392 22.25c0 22.66-29.77 13.76-29.77 40.64c0 4.515 1.11 5.961 1.11 9.456c0 10.45-8.516 18.95-18.97 18.95h-52.53c-25.62 0-51.02-8.466-71.5-23.81l-36.66-27.51c-4.315-3.245-9.37-4.811-14.38-4.811c-13.85 0-24.03 11.38-24.03 24.04c0 7.287 3.312 14.42 9.596 19.13l36.67 27.52C235 468.1 270.6 480 306.6 480h52.53c35.33 0 64.36-27.49 66.8-62.2c17.77-12.23 28.83-32.51 28.83-54.83c0-3.046-.2187-6.107-.6406-9.122c17.84-12.15 29.28-32.58 29.28-55.28c0-5.311-.6406-10.54-1.875-15.64C499.9 270.1 512 250.2 512 227z"></path>
                        </svg></span><span>BetterLimited</span></a>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span
                        class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <button class="btn btn-primary" type="button" style="margin: 10px;">Manager</button>
            </div>
        </div>
    </nav>
    <div>
        <div class="btn-toolbar bg-secondary shadow">
            <div class="btn-group" role="group">
                <a href="editItemPage.php">
                <button class="btn btn-primary" type="button"
                        style="margin: 20px;margin-top: 10px;margin-bottom: 10px;">Edit & Insert Item
                </button>
                </a>
                <button class="btn btn-primary link-warning bg-dark" type="button"
                        style="margin: 20px;margin-top: 10px;margin-bottom: 10px;">Report
                </button>
                <a href="recordsPage.php">
                <button class="btn btn-primary" type="button"
                        style="margin: 20px;margin-top: 10px;margin-bottom: 10px;">Records
                </button>
                </a>
            </div>
        </div>
    </div>
    <main>
        <form method="get" >
            <div class="col" style="margin: 10px;">
                <table class="table link-warning bg-dark" style="width: 400px">
                    <thead>
                    <th>Staff ID</th>
                    <th>Staff Name</th>
                    <th>Action</th>
                    </thead>
                    <?php
                    $num=mysqli_num_rows($rs);
                    if ($num>0){
                    while($row=mysqli_fetch_assoc($rs)){

                    ?>
                    <table  class="table link-warning bg-dark" style="width: 400px">
                        <tr>
                            <td style="width: 120px;" name="staffID"><?php echo $row['staffID']?></td>
                            <td style="width: 150px;" name="staffName"><?php echo $row['staffName']?></td>
                            <td> <a href="generatePage.php?staffID=<?php echo $row['staffID'];?>" class="btn btn-primary link-dark bg-info" >Generate</a></td>
                        </tr>
                    </table>

                </table>
                <?php
                }}
                ?>
            </div>
        </form>
        <?php
        if(!empty($_GET)){
            extract($_GET);
            $sql5="SELECT staff.staffID, staff.staffName, COUNT(orders.orderID) AS orderID, SUM(orders.orderAmount) AS orderAmount FROM staff INNER JOIN orders ON staff.staffID=orders.staffID WHERE staff.staffID='$staffID' AND MONTH(orders.dateTime) = MONTH(CURRENT_DATE) GROUP BY staff.staffID;";
            $rs5=mysqli_query($conn, $sql5) or die(mysqli_error($conn));
            $num5=mysqli_num_rows($rs5);
            if($num==0){
                echo "This staff out of record in this month <br>";
            }else{
                while($row5 =mysqli_fetch_assoc($rs5)){

                    echo <<<EOD
        
        <form class="text-light bg-dark" method="post">
            <table class="table link-warning bg-dark">
                <h2 class="text-warning" style="text-align: center">Monthly Report</h2>
                <thead>
                <th >Staff Name</th>
                <th >Staff ID</th>
                <th >No. Of Order</th>
                <th >Total Amount(HKD$)</th>
                </thead>
                <tr>
                    <th>{$row5['staffID']}</th>
                    <th>{$row5['staffName']}</th>
                    <th>{$row5['orderID']}</th>
                    <th>{$row5['orderAmount']}</th>
                </tr>




            </table>
        </form>
EOD;
                }
            }
        }
        ?>


    </main>
</div>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>