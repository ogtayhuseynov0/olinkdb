<html>
<head>
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

</head><body>
<?php
/**
 * Created by Ogtay.
 * User: ogtay
 * Date: 5/23/16
 * Time: 5:48 PM
 */
      $dbname="links";
      $dbuser="root";
      $dbpass="root";
      $dbnhost="localhost";
      $counter=0;
      $size=0;
      try{
          $db=new PDO( "mysql:host=$dbnhost;dbname=$dbname", $dbuser, $dbpass);
      }catch(PDOException $e)
      {
          echo $e->getMessage();
          exit();
      }
      $keytos;
      $topH;
          $stm = $db->query("SELECT * FROM allLinks ORDER BY id");
          $topH="All Links";
      $resultes = array_reverse($stm->fetchAll());
      echo "<div class=\"section text-center\">
      <div class=\"container kelem1\">
        <div class=\"row\">
          <div class=\"col-md-14\">
            <h2 class=\"text-center text-danger\">$topH for Admin</h2>
          </div>
        </div>
      </div>
    </div>";
      foreach($resultes as $row){
          echo " <div class=\"section post1\">
      <div class=\"container kelem1\" id='kelem12'>
        <div class=\"row\">
          <div class=\"col-md-4\"><a target=\"_blank\" href='$row[1]'><h4 class='text-success'>$row[2]</h4></a> </div>
          <div class=\"col-md-4\"><h3>  $row[2]</h3></div>
          <div class=\"col-md-3\"><h3> Categroy: $row[3]</h3></div>
          <div class=\"col-md-1\">
          <form method='post'>
            <input type=\"submit\"  class='btn btn-link delBnt' id='$row[0]' name='$row[0]' onclick='' value='Delete'>
            </input></form>
        </div>
      </div>
    </div>
    </div>";
          if(isset($_POST[$row[0]])){
              $stm = $db->query("DELETE FROM allLinks WHERE id='$row[0]'");

          }
      }


?>

<div class="section text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="pagination pagination-lg">

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
                    .slice(showFrom, showTo).show();
            }
        });
    });
</script>
<!--<script type="text/javascript">-->
<!---->
<!--    $(document).on('click', '.delBnt', function() {-->
<!--        document.write(this.id);-->
<!--    });-->
<!--</script>-->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-78203826-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>
