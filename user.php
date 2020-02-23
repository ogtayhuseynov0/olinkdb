<?php
 $dbname="links";
$dbuser="root";
$dbpass="root";
$dbnhost="localhost";
$conn=new PDO( "mysql:host=$dbnhost;dbname=$dbname", $dbuser, "root");
// set the PDO error mode to exception
$conn->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);

session_start();

if(!isset($_SESSION['emailr'])){
  session_start();
  session_destroy();
  header('location: index.php');
}
if(isset($_POST[logout])){
  session_start();
  session_destroy();
  header('location: index.php');
}

$topH= $_SESSION['namer'];

$nRowsed = $conn->query("select count(*) from allLinks WHERE auth='$topH' ")->fetchColumn();
?>
<html>
  
  <head>
    <meta charset="utf-8">
    <title><?php print($_SESSION['namer']);?>'s Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
  </head>
  
  <body>

    <div class="navbar navbar-default navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php" class="btn btn-danger"><span><?php print($_SESSION['namer']);?></span></a>
           </div>
        <div class="collapse navbar-collapse" id="navbar-ex-collapse">
          <ul class="lead nav navbar-nav navbar-right">

            <li>
              <form method="post">
                <input type="submit" value="Log me Out" name="logout" class="btn btn-danger">
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
	 <div id="forhide" class="">
      <div class="container col-md-4" style="margin-left:0px">
        <div class="row col-md-12">
			<div class="col-md-14 text-center">
        <h2 class="text-center text-succes">Profile</h2>
      </div>
          <div class="col-md-12">
            <div class="thumbnail">
              <img src="img/golder.jpg" class="img-responsive">
              <div class="caption">
                <table class="table table-bordered table-responsive">
                  <tbody>
                    <tr>
                      <td>Name:</td>
                      <td><?php print($_SESSION['namer']);?></td>
                    </tr>
                    <tr>
                      <td>Email:</td>
                      <td><?php print($_SESSION['emailr']);?></td>
                    </tr>
                    <tr>
                      <td>Added Links:</td>
                      <td><?php print($nRowsed);?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="row col-md-8">
      <div class="col-md-14 text-center">
        <h2 class="text-center text-succes">Links that you Added</h2>
      </div>
      <div class="col-md-12">
        <table class="table table-bordered  table-responsive text-danger" id="content">
          <thead class="thead-inverse">
            <tr>
              <th>Link</th>
              <th>Description</th>
              <th>Category</th>
              <th>Aviable Action</th>
            </tr>
          </thead>
          <tbody>

          <?php
          /**
           * Created by Ogtay.
           * User: ogtay
           * Date: 5/23/15
           * Time: 5:48 PM
           */
          $dbname="links";
$dbuser="root";
$dbpass="root";
$dbnhost="localhost";
          $counter=0;
          $size=0;
          try{
            $db=new PDO( "mysql:host=$dbnhost;dbname=$dbname", $dbuser, "root");
          }catch(PDOException $e)
          {
            echo $e->getMessage();
            exit();
          }
          $stm = $db->query("SELECT * FROM allLinks WHERE auth='$topH' ORDER BY id");
          $resultes = array_reverse($stm->fetchAll());
          foreach($resultes as $row){
            echo " <tr>
              <td><a target=\"_blank\" href='$row[1]'><h6 class='text-success'>$row[2]</h6></a></td>
              <td><h6>$row[2]</h6></td>
              <td><h6>$row[3]</h6></td>
              <td><form method='post'>
            <input type=\"submit\"  class='btn btn-warning delBnt' id='$row[0]' name='$row[0]' onclick='' value='Delete'>
            </input></form></td>
            </tr>";

            if(isset($_POST[$row[0]])){
              $stm = $db->query("DELETE FROM allLinks WHERE id='$row[0]'");

            }
          }


          ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="container col-md-7 text-center" style="margin-left:50px;">
      <div class="row col-md-12">
        <div class="col-md-12">
          <ul class="pagination pagination-lg">
            
          </ul>
        </div>
      </div>
    </div>
    
    <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/jquery.simplePagination.js"></script>

        <script>
            jQuery(function($) {
                var items = $("#content tbody tr");
                var numItems = items.length;
                var perPage = 5;
                // only show the first 2 (or "first per_page") items initially
                items.slice(perPage).hide();
                // now setup pagination
                $(".pagination").pagination({
                    items: numItems,
                    itemsOnPage: perPage,
                    cssStyle: "light-theme",
                    onPageClick: function(pageNumber) { // this is where the magic happens
                        // someone changed page, lets hide/show trs appropriately
                        var showFrom = perPage * (pageNumber - 1);
                        var showTo = showFrom + perPage;
                        items.hide() // first hide everything, then show for the new page
                             .slice(showFrom, showTo).show(300);
                    }
                });
            });
        </script>
        </div>
    </div>
  </body>

</html> 
