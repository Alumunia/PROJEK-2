<?php include 'fungsi/config.php'?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <head>
    <title>Adobt Dustbin System</title>
 
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="css/aryo.css">

     <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  
   <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	</script> 
<script src="js/jquery.min.js"></script> 
<?php include 'js/map.php'?>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=&sensor=false"></script>
<script src="js/index-search.js"></script>
  </head>

  <body>



    <!-- Main jumbotron for a primary marketing message or call to action -->
   
   
     <div style="margin-top:-10px">
 <div class="row">
        <div class="col-md-2">
		<div style="padding:30px">
 <div class="float:left">
           <a href="#"><img src="img/ad.png" alt=" " / height="150px" width="270px" ></a>
		  
		     <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                            <form action="search.php"  method="post" onKeyPress="search.php">
                                <input type="text" class="form-control" id="search-box" name="search" list="languages"placeholder="Search...">
                                </form>
                                <datalist id="languages">
  <?php 
 $query = mysql_query("select * from jalan");
            while ( $data = mysql_fetch_array($query) )
            { ?> 
    <option value="<?php echo $data['nama']?>">
    <?php }?>
  </datalist>
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a class="active" href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
 Sign in
</button></a>
 <form class="form-signin" method="post" action="fungsi/login.php" role="form">
       
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="text" class="form-control" name="username" id="exampleInputEmail2" placeholder="Username">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Sign in</h4>
      </div>
      <div class="modal-body">
          <form class="form-signin" method="post" action="fungsi/login.php" role="form">
       
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="text" class="form-control" name="username" id="exampleInputEmail2" placeholder="Username">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
	  
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


                          
                            <!-- /.nav-second-level -->
                        </li>
                       <li>
                           <a href="#"><button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal1">
 Sign up
</button></a>
<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Sign up</h4>
      </div>
      <div class="modal-body">
          <form class="form-signin" method="post" action="fungsi/daftar.php" role="form">
       
        <div class="form-group  ">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" name="username" id="exampleInputEmail1" placeholder="Enter Username">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Enter Password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Nama</label>
    <input type="text" class="form-control" name="nama" id="exampleInputPassword1" placeholder="Enter Nama">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">email</label>
    <input type="text" class="form-control" name="email" id="exampleInputPassword1" placeholder="Enter Email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Alamat</label>
    <input type="text" class="form-control" name="alamat" id="exampleInputPassword1" placeholder="Enter Alamat">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Nomor Handphone</label>
    <input type="text" class="form-control" name="nomorhp" id="exampleInputPassword1" placeholder="Enter Nomor Handphone">
  </div>
   
 
   <div class="form-group">
    <label for="exampleInputPassword1">NPWP</label>
    <input type="text" class="form-control" name="npwp" id="exampleInputPassword1" placeholder="Enter Nomor Pokok Wajib Pajak">
  </div>
  
    <div class="form-group">
    <label for="exampleInputPassword1">Nomor Kartu Debit</label>
    <input type="text" class="form-control" name="debit" id="exampleInputPassword1" placeholder="Enter Nomor Kartu Debit">
  </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
      </form>
	  
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
                        </li>
                       
                      
                      
                      
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
		  
		  
	  </div>
	  </div>
	  

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript">
            $(document).ready(function() {

                $('.tool').tooltip();
                $('.btn').popover();

            }); //END $(document).ready()

        </script>

        <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap.min.css"></script>

        </div>
		
        <div class="col-md-10">
        
            
			<!--<h1 class="heading">Google Map Marker</h1>-->
                <!--<div align="center">Klik kanan untuk menambahkan penanda / marker yang baru, dan klik di dalam marker apakah edit atau simpan.</div>-->
                <!--<div><hr/></div>-->
                <!--<div style="text-align:center">-->
        <!--<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>-->
<!-- ad1 -->
<!--<ins class="adsbygoogle"
     style="display:inline-block;width:800px;height:200px"
     data-ad-client="ca-pub-4667919159271602"
     data-ad-slot="1812307776"></ins>-->
<!--<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>-->
<!--</div>-->
                 <!--<div>&nbsp;</div>-->
                <div id="google_map"></div>
         
       
       </div>
        
   
      <hr>

      
    </div> 
      </div>
  
      <!-- Example row of columns -->
     <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
