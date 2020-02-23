<?php
$dbname="links";
$dbuser="root";
$dbpass="root";
$dbnhost="localhost";
try {

    session_start();
  $conn=new PDO( "mysql:host=$dbnhost;dbname=$dbname", $dbuser, "root");
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);


// Get size from array
  $nRows = $conn->query('select count(*) from allLinks')->fetchColumn();

// Inserting data to Links DB
  if(isset($_POST[link],$_POST[tag],$_POST[categ])) {
    $nRowsd1 = $conn->query("select * from allLinks WHERE allLinks='$_POST[link]' ");
    $addd1=$nRowsd1->rowCount();
    if($_POST[link]!="" && $_POST[tag]!="" && $addd1==0) {
        $linkd=$_POST[link];
        $tagkd=$_POST[tag];
        $categd=$_POST[categ];
        if($categd==""){
			$categd="Uncategorized";
		}
        $authd=$_SESSION['namer'];
        $sql = "INSERT INTO allLinks (allLinks, tags, categ,auth) VALUES ( '$linkd', '$tagkd' , '$categd','$authd')";
        $conn->exec($sql);
        $conn = null;
    }
    }

    //LOGIN
    if(isset($_POST["btnl"])){
        $emaill=$_POST["emaill"];
        $passl=$_POST["passl"];
        $query = $conn->prepare(" select * from users WHERE emailr='$emaill' and passr='$passl'");
        $query->execute();
        $userRow=$query->fetch(PDO::FETCH_ASSOC);
        if($query->rowCount()>0){
            $_SESSION['emailr']=$emaill;
            $_SESSION['namer']=$userRow['namer'];
            $nameed=$userRow['namer'];
            $lurl="user.php?user=".$nameed;
            header("location: $lurl");
        }
    }


}
catch(PDOException $e)
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
  <link href="css/myStyle.css" rel="stylesheet" type="text/css">
  </head>
<body>
<div class="navbar navbar-default navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse"  id="collapse1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="index.php" class="navbar-brand btn-danger"><span>OLinkDB</span></a>
    </div>
    <div class="col-md-offset-2 col-md-5">
      <form role="search" class="navbar-form navbar-right" method="post">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search" name="sInput">
        </div>
        <button type="submit" class="btn btn-sm btn-warning" name="sButton">Search</button>
                <span class="badge">Totally <?php echo $nRows; ?> Links</span>
      </form>
    </div>
    <div class="collapse navbar-collapse" id="navbar-ex-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="" id="logB">
          <a href="#mLogin" onclick="$('#myLogin').modal({'backdrop': 'static'});">Log In</a>
        </li>
        <li  id="regB">
          <a href="#" onclick="$('#modal-register').modal({'backdrop': 'static'}); "
             data-backdrop="static">Register</a>
        </li>
        <li id="userP">
            <a href="user.php" >Profile</a>
         </li>
        <li>
          <a href="#myModal" data-target="#myModal" data-toggle="modal" data-backdrop="static">Add a Link</a>
        </li>
        <li>
          <a href="#" id="filterOpen" data-toggle="tooltip" title="Filter Results"><i class="fa fa-fw fa-lg fa-cog text-success"></i></a>
        </li>
      </ul>
    </div>
  </div>

  <script>
    $('#userP').hide();
    $('#collapse1').click(function () {
      var elemnt= $('#navbar-ex-collapse');
      if(elemnt.hasClass("collapse")){
        elemnt.show(300);
        elemnt.removeClass("collapse");
      }else{
        elemnt.hide(300);
        elemnt.addClass("collapse");
      }
    });

  </script>

    <?php
    if(isset($_SESSION['emailr'])){

        echo '<script>
                $(\'#userP\').show();
                $(\'#regB\').hide();
                $(\'#logB\').hide();
                </script>';
    }
    ?>
  </div>
    <div class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" id="collapse2">
            <span class="sr-only">Toggle navigation2</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="navbar-ex-collapse1">
          <ul class="lead nav navbar-left navbar-nav" >
            <li class="">
              <a href="index.php">All Links</a>
            </li>
            <li class="">
              <form method="post"><button type="submit"  class="btn btn-lg btn-link" " name="movieButton" id="mbtn">Movie</button></form>
            </li>
            <li>
              <form method="post"><button type="submit"  class="btn btn-lg btn-link" name="appButton" id="mbtn">App</button></form>
            </li>
            <li>
              <form method="post"><button type="submit"  class="btn btn-lg btn-link" name="gameButton" id="mbtn">Game</button></form>
            </li>
            <li>
              <form method="post"><button type="submit"  class="btn btn-lg btn-link" " name="bookButton" id="mbtn">Books</button></form>
            </li>
            <li class="divider"></li>
            <li>
              <form method="post"><button type="submit"  class="btn btn-lg btn-link" " name="progButton" id="mbtn">Programming</button></form>
            </li>
            <li class="divider"></li>
            <li>
              <form method="post"><button type="submit"  class="btn btn-lg btn-link" " name="muButton" id="mbtn">Music</button></form>
            </li>
            <li>
              <form method="post"><button type="submit"  class="btn btn-lg btn-link" " name="jlButton" id="mbtn">Just Links</button></form>
            </li>
            <li>
              <div class="dropdown kelem">
                <a class="btn btn-primary dropdown-toggle ddm" data-toggle="dropdown" id="dropBtn"> Extra <span class="fa fa-caret-down"></span></a>
                <ul class="dropdown-menu c" role="menu" id="dropm">
                  <li>
                    <a href="http://ohuseynov.tk/" target="_blank" class="btn ">About Dev</a>
                  </li>

                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
<script>
  var dropbtn=$("#dropBtn");
  var menu=$("#dropm")
  dropbtn.click(function(){
    if(menu.hasClass("c")){
      menu.show(300);
      menu.removeClass("c");
    }else{
      menu.hide(300);
      menu.addClass("c");
    }
  });
  $('#collapse2').click(function () {
    var elemnt= $('#navbar-ex-collapse1');
    if(elemnt.hasClass("collapse")){
      elemnt.show(300);
      elemnt.removeClass("collapse");
    }else{
      elemnt.hide(300);
      elemnt.addClass("collapse");
    }
  });

</script>

    <!--main link content-->

      <?php
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
      $keytos;
      $topH;
      if(isset($_POST[movieButton])){
        $stm = $db->query("SELECT * FROM allLinks WHERE categ='Movie'");
        $topH="Movie Links";
      }elseif(isset($_POST[appButton])) {
        $stm = $db->query("SELECT * FROM allLinks WHERE categ='App'");
        $topH="App Links";
      }elseif(isset($_POST[gameButton])) {
        $stm = $db->query("SELECT * FROM allLinks WHERE categ='Game'");
        $topH="Game Links";
      }
      elseif(isset($_POST[bookButton])) {
        $stm = $db->query("SELECT * FROM allLinks WHERE categ='Book'");
        $topH="Book Links";
      }
      elseif(isset($_POST[progButton])) {
        $stm = $db->query("SELECT * FROM allLinks WHERE categ='Programming'");
        $topH="Programming Links";
      }
      elseif(isset($_POST[jlButton])) {
        $stm = $db->query("SELECT * FROM allLinks WHERE categ='Uncategorized'");
        $topH="Uncategorized Links";
      }
      elseif(isset($_POST[muButton])) {
        $stm = $db->query("SELECT * FROM allLinks WHERE categ='Music'");
        $topH="Music Links";
      }
      elseif(isset($_POST[sButton])) {
        $keytos=$_POST[sInput];
        //'tags' OR '
        //' or 'allLinks
        if (strpos($keytos, '\'') == false) {
          $stm = $db->query("SELECT * FROM allLinks WHERE tags LIKE '%$keytos%' or categ LIKE '%$keytos%' or allLinks LIKE '%$keytos%'");
          $topH = "Result";
        }else{
          echo '<script>alert("Olmaz");</script>';
        }
      }
      else
      {
        $stm = $db->query("SELECT * FROM allLinks ORDER BY id");
        $topH="All Links";
      }
      $resultes = array_reverse($stm->fetchAll());
      echo "<div class=\"linkback\">
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-md-12\">
            <div class=\"row\">
              <div class=\"col-md-12 text-center\">
                <h1 class=\"text-danger\">$topH</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>";

      foreach($resultes as $row){
        echo "
<div class=\"linkback post1\">
      <div class=\"container text-justify linklay\">
        <div class=\"row\">
          <div class=\"col-md-12\">
            <div class=\"row\">
              <div class=\"col-md-2\">
                <h5>
                  <a href='$row[1]' target='_blank'><span class=\"text-danger\">Open Link</span></a>
                </h5>
              </div>
              <div class=\"col-md-7\">
                <h5 class='text-primary'><span class=\"text-danger\">Description: </span> $row[2]</h5>
              </div>
              <div class=\"col-md-3\">
                <h5 class='text-success'><span class=\"text-danger\">Category: </span>$row[3]</h5>
              </div>
            </div>
            <div class=\"hrdiv\">
              <hr>
            </div>
            <div class=\"row\">
              <div class=\"col-md-12\">
                <h5>
                <span class=\"label label-success\"  data-toggle=\"tooltip\" title=\"Usefullness\">0</span>
                  <a href=\"#\"  data-toggle=\"tooltip\" title=\"Add to my usefull Links!\"><i class=\"fa fa-fw fa-lg fa-plus-circle text-success\"></i></a>
                  <a href=\"#\"  data-toggle=\"tooltip\" title=\"Copy Link! \"><i class=\"fa fa-files-o fa-fw fa-lg pull-right text-success\"></i></a>
                  <a href=\"#\"  data-toggle=\"tooltip\" title=\"Share Link!\"><i class=\"fa fa-fw fa-lg fa-share-alt pull-right text-success\"></i></a>
                </h5>
                </h5 >
              </div >
            </div >
          </div >
        </div >
      </div >
      <div class=\"col-md-12 linkback\">
          <hr>
    </div>
    </div >";

      }
      ?>



    <div class="section text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul class="pagination pagination-lg ">

            </ul>
          </div>
        </div>
      </div>
    </div>

    <script src="js/jquery.simplePagination.js"></script>

    <script>
      jQuery(function($) {
        var items = $(".post1");
        var numItems = items.length;
        var perPage = 4;
        items.slice(perPage).hide();
        $(".pagination").pagination({
          items: numItems,
          itemsOnPage: perPage,
          displayedPages: 4,
          edges: 0,
          hrefTextPrefix: "#senin-oldugun-sehife-",
          hrefTextSuffix: "?necedi?",
          onPageClick: function(pageNumber) {
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide()
                .slice(showFrom, showTo).fadeIn(500);
            $('html,body').animate({scrollTop:0},'slow');
          }
        });
      });
    </script>
    <!--Modal-->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
      <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title text-success" id="myModalLabel">
              <i class="fa fa-link text-success"></i>Add a Link to Data Base</h4>
          </div>
          <!--Body-->
          <div class="modal-body">
            <form role="form" action="" method="POST">
              <div class="form-group">
                <i class="fa fa-link text-danger"></i>
                <label class="control-label text-danger h4" for="exampleInputEmail1">Link Address:</label>
                <input class="form-control" id="exampleInputLink1"
                       placeholder="Write down a Link" type="url" name="link">
              </div>
              <div class="form-group">
                <i class="fa fa-sort-alpha-desc text-danger" aria-hidden="true"></i>
                <label class="control-label text-danger h4" for="exampleInputPassword1">Description:</label>
                <input class="form-control" id="exampleInputPassword1"
                       placeholder="Describe Source" type="text" name="tag">
              </div>
              <div class="form-group">
                <i class="fa fa-tag text-danger" aria-hidden="true"></i>
                <label class="h4 text-danger">Category:</label>
                <div class=" selectContainer">
                  <select class="form-control" name="categ">
                    <option value="">Choose a Category</option>
                    <option value="Movie">Movie</option>
                    <option value="App">App</option>
                    <option value="Game">Game</option>
                    <option value="Book">Books</option>
                    <option value="Music">Music</option>
                    <option value="Programming">Programming</option>
                    <option value="Uncategorized">Just a Link</option>
                  </select>
                </div>
              </div>
              <button type="submit" class="btn btn-success" name="submit12">Load</button>
            </form>
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>

    <!--Log In-->
    <div class="modal fade" id="myLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title text-success" id="myModalLabel">
              <i class="fa fa-user text-success"></i>Log In</h4>
          </div>
          <!--Body-->
          <div class="modal-body">
            <form class="form-horizontal" role="form" action="index.php" method="POST">
              <div class="form-group">
                <div class="col-sm-2">
                  <i class="fa fa-envelope prefix text-success"></i>
                  <label for="inputEmail3" class="control-label text-success">Email</label>
                </div>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="emaill">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <i class="fa fa-lock prefix text-success"></i>
                  <label for="inputPassword3" class="control-label text-success">Password</label>
                </div>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="passl">
                </div>
              </div>
                <div class="form-group">
                <div class="col-sm-10">
                    <input type="submit" class="btn btn-success" name="btnl">
                </div>
                </div>
            </form>
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-register" data-dismiss="modal">Register</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!--login donee-->

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
              <div class="alert alert-dismissable alert-warning" id="passch1a">Name already Exist
                <strong>!!!!</strong>
              </div>
              <div class="alert alert-dismissable alert-danger" id="passch1">Please fill all Fields
                <strong>!!!!</strong>
              </div>
              <div class="alert alert-dismissable alert-success" id="passch12">Registration was succesfull
                !!!! Now You can Login...
              </div>


              <div>
              <input type="submit" value="Submit" class="btn btn-primary submitB">
              </div>
            </form>
          </div>
          <!--Footer-->
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



    <script type="text/javascript" src="js/ajaxp.js"></script>

    <footer class="section text-success">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h1>OLinkDB</h1>
            <p>Ogtay`s Link Data Base developed by Ogtay Huseynov...
              <br>Site is on developing Stage. Copyright
              <i class="fa fa-copyright"></i> 2016  </p>

          </div>
          <div class="col-sm-6">
            <p class="text-info text-right">
              <br>
              <br>
            </p>
            <div class="row">
              <div class="col-md-12 hidden-lg hidden-md hidden-sm text-left">
                <a href="#"><i class="fa fa-3x fa-fw fa-facebook text-inverse"></i></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 hidden-xs text-right">
                <a href="#"><i class="fa fa-3x fa-facebook fa-fw text-primary"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php include_once "test.php" ?>
    </footer>


</body></html>
