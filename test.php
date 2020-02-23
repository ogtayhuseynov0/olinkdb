<?php
/**
 * Created by PhpStorm.
 * User: ogtay
 * Date: 5/25/16
 * Time: 12:08 AM
 */
$dbname="u227529497_links";
$dbuser="u227529497_root";
$dbpass="salam123";
$dbnhost="mysql.hostinger.web.tr";
try {
    $conn = new PDO("mysql:host=$dbnhost;dbname=$dbname", $dbuser, "salam123");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);


    if (isset($_POST[namer], $_POST[emailr], $_POST[passr])) {
        $runame = $_POST[namer];
        $remail = $_POST[emailr];
        $rpass = $_POST[passr];
        $rcpass = $_POST[passrc];
        echo "$runame +$remail +$rpass +";
        $sqlr = "INSERT INTO users (namer, emailr, passr) VALUES ('$runame','$remail','$rpass')";
        $conn->exec($sqlr);

    }
}catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
?>
<html>
<head>
  <title>Ogtay's Link Data Base</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
  <script type="application/javascript" src="js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/effects.js"></script>

  <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <link href="css/mystyle.css" rel="stylesheet" type="text/css">

  </head>
<body>
<!-- Modal Register -->
<div class="modal fade modal-ext" id="modal-register" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h3 class="text-success text-center">
                    <i class="fa fa-file-text  text-success  "></i>Register</h3>
            </div>
            <!--Body-->
            <div class="modal-body">
                <form role="form" action="index.php" method="POST" id="regfomr" class="ajax">
                    <div class="md-form">
                        <i class="fa fa-user  prefix text-success"></i>
                        <label for="form1" class="text-success">Your Name</label>
                        <input type="text" id="namer" class="form-control" name="namer">
                    </div>
                    <div class="md-form">
                        <i class="fa fa-envelope prefix text-success"></i>
                        <label for="form2" class="text-success">Your email</label>
                        <input type="email" id="form2" class="form-control"
                               name="emailr" id="emailr">
                    </div>
                    <div class="md-form">
                        <i class="fa fa-lock prefix text-success"></i>
                        <label for="form3" class="text-success">Your password</label>
                        <input type="password" id="form3" class="form-control"
                               name="passr">
                    </div>
                    <div class="md-form">
                        <i class="fa fa-lock prefix text-success"></i>
                        <label for="form4" class="text-success">Repeat password</label>
                        <input type="password" id="form4" class="form-control"
                               name="passrc">
                    </div>
                    <div class="alert alert-dismissable alert-danger" id="passch">Passwords are not same
                        <strong>!!!!</strong>
                    </div>
                    <div class="alert alert-dismissable alert-danger" id="passch1">Please fill all Fields
                        <strong>!!!!</strong>
                    </div>
                    <div class="alert alert-dismissable alert-success" id="passch12">Registration was succesfull
                        !!!! Now You can Login
                    </div>
                    <input type="submit" value="Submit" class="btn btn-primary submitB">
                </form>
            </div>
            <!--Footer-->
            <h3 class="col-md-4 text-danger text-justify">Soon will be ready...!!</h3>
            <div class="modal-footer">
                <div class="options">
                    <p class="text-success">Already have an account?
                        <button type="button" class="btn btn-success"
                                data-dismiss="modal" data-toggle="modal" data-target="#myLogin">Log In</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </p>
                </div>
                <!--/.Content-->
            </div>
        </div>
    </div>
</div>

</body></html>