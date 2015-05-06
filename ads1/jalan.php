<?php 
session_start();
include('fungsi/config.php');
include('fungsi/tes.php');
?>
<?php 
//Tampilkan Jumlah data
 //Koneksikan ke database

  //Tampilkan Jumlah data
  $query = mysql_query("SELECT COUNT(*) jumData from jalan");
  $data = mysql_fetch_array($query);
  $jumlahData = $data["jumData"];
   
  //Tentukan Jumlah Data Per Halaman
  $dataperPage = 10;
   
  //Buat kondisi saat request halaman
  if(isset($_GET['page']))
  {
    $noPage= $_GET['page'];
  }
 
  else
  {
    $noPage=1;
  }
   
  //Tentukan Awal dari data yang akan ditampilkan
  $offset = ($noPage-1)*$dataperPage;
   
?>
<!DOCTYPE html>
<html lang="en">
 
    <head>
   <title>Adobt Dustbin System</title>
 
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="css/aryo.css">
    <link rel="stylesheet" href="css/page.css">
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
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  
   <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	</script> 
 
<script src="js/jquery.min.js"></script> 
<?php include 'js/map2.php'?>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=&sensor=false"></script>

  </head>

  <body>

   <!-- algor KNN -->
   <?php
   /* $datalatbb=-6.5445725;
   $datalngbb=106.7453143;
   $datalatbte=-6.5764431;
   $datalngbte=106.7894381;
   $datalatbt=-6.6065551;
   $datalngbt=106.8078307;
     ini_set('memory_limit', '-1');
   $query2 = mysql_query("select * from sampah");
 	$data2 = mysql_fetch_array($query2);
	while($data2){
	//$i=0;
	$a3=$data2['lng'];
		$a4=abs($data2['lat']);
	
		$a11=abs($datalatbb);
		$a21=$datalngbb;
		if($a4>$a11){$var1=$a4-$a11;} else {$var1=$a11-$a4;}
		if($a3>$a21){$var2=$a3-$a21;} else {$var2=$a21-$a3;}
		$nilai[0]=$var1+$var2;
		$cl[0]="Bogor Barat";
	
		$a12=abs($datalatbte);
		$a22=$datalngbte;
		if($a4>$a12){$var1=$a4-$a12;} else {$var1=$a11-$a4;}
		if($a3>$a22){$var2=$a3-$a22;} else {$var2=$a22-$a3;}
		$nilai[1]=$var1+$var2;
		$cl[1]="Bogor Tengah";
		
		$a13=abs($datalatbt);
		$a23=$datalngbt;
		if($a4>$a13){$var1=$a4-$a13;} else {$var1=$a13-$a4;}
		if($a3>$a23){$var2=$a3-$a23;} else {$var2=$a23-$a3;}
		$nilai[2]=$var1+$var2;	
		$cl[2]="Bogor Timur";
	
		$flag=min($nilai);
		for($d=0;$d<3;$d++){if($nilai[$d]==$flag){$final=$cl[$d];} else {}}
		$res = mysql_query("update sampah set wilayah='".$final."' WHERE lat='".$data2['lat']."' AND lng='".$data2['lng']."'");
	}
  */
   ?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
   
   
     <div style="margin-top:-10px">
 <div class="row">
        <div class="col-md-2">
		<div style="padding:30px">
 <div class="float:left">
 <a href="#"><img src="img/ad.png" alt=" " / height="150px" width="270px" ></a>
	   <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a class="active" href="beranda.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <?php if ($_SESSION['level']=="member") {?>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-copyright-mark"></span> Coin</a>                         
                        </li>
                        <?php } else {?>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-copyright-mark"></span> DB jalan</a>                         
                        </li>
                         <?php }?>
                         <?php if ($_SESSION['level']=="member") {?>
                       <li>
                            <a href="#" data-toggle="modal" data-target="#myModal3"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>
                        <?php } else {?>
                        <li>
                            <a href="member.php"><i class="fa fa-edit fa-fw"></i> Member</a>
                        </li>
                         <?php }?>
                       <?php 


$query = mysql_query("select * from anggota  where id_login='$user'") or die(mysql_error());

$data = mysql_fetch_array($query);
?>
<div class="modal fade" id="myModaaa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Form</h4>
      </div>
      <div class="modal-body">
         <form role="form" action="update.php" method="post">
		<fieldset disabled>
  <div class="form-group  ">
    <label for="disabledTextInput">Username</label>
    <input type="text" class="form-control" id="disabledInput" name="username"  value="<?php echo $data['username']?>">
  </div>
  </fieldset>
  <div class="form-group">
    <label for="exampleInputPassword1">password</label>
    <input type="email" class="form-control" name="password" id="exampleInputPassword1" value="<?php echo $data['password']?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">nama</label>
    <input type="email" class="form-control" name="nama" id="exampleInputPassword1" value="<?php echo $data['Nama']?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Email</label>
    <input type="email" class="form-control" name="email" id="exampleInputPassword1" value="<?php echo $data['email']?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">alamat</label>
    <input type="text" class="form-control" name="alamat" id="exampleInputPassword1" value="<?php echo $data['Alamat']?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Nomor Handphone</label>
    <input type="text" class="form-control" name="nomorhp" id="exampleInputPassword1" value="<?php echo $data['nomorhp']?>">
  </div>
   <div class="form-group">
    <label for="exampleInputPassword1">NPWP</label>
    <input type="text" class="form-control" name="npwp" id="exampleInputPassword1" value="<?php echo $data['NPWP']?>">
  </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Nomor Kartu debit</label>
    <input type="text" class="form-control" name="debit" id="exampleInputPassword1" value="<?php echo $data['Debit']?>">
  </div>
 
  
  
  <button type="submit" name="submit" class="btn btn-default btn-danger btn-lg">update</button>
  
</form>
	  
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
                        <li>
                           <a href="fungsi/logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a>
                        </li>
       
                      
                      
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
    
		  
	  </div>
	   
	  </div>
	  

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
       
        <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap.min.css"></script>
		
		  
        </div>
		
        <div class="col-md-10">
         <h2 id="sizenew" align="center">&nbsp;</h2>
         <h2 align="center">Data Jalan Adobt Dustbin System</h2>
         
         <table width="858" border="1"  cellspacing="0" align="center" style="webkit-border-radius: 5px;
moz-border-radius: 5px;
border-radius: 5px;"> <tr>
        	    
        	    <td width="48" align="center" valign="middle">No</td>
        	    <td width="365" align="center" valign="middle">Nama jalan</td>
<td width="195" align="center" valign="middle">Latitude</td>
<td width="232" align="center" valign="middle">Longitude</td>
<td width="232" align="center" valign="middle">Wilayah</td>

        	    </tr>
    <tr>
      
      
      </tr> 
            <?php
 $query = mysql_query("SELECT * FROM `jalan` LIMIT $offset, $dataperPage ");$vb=1;
            while ( $data = mysql_fetch_array($query) )
            { ?> 
            <tr>
        	    
       	      <td width="85" align="center" id="tex_dlm"><?php echo $offset=$offset+1;  ?></td>
                <td align="left"><?php echo $data['nama']?></td>
       	      <td align="center"><?php echo $data['lat']?></td>
        	    <td align="center"><?php echo $data['lng']?></td>
        	    <td align="center"><?php echo $data['wilayah']?></td>
                
                     
   	       </tr> <?php $vb++; }?>
           
          </table>
  
</div>
     <div class="pagination">
<ul>
<?php
	$jumPage=ceil($jumlahData / $dataperPage);
	if($noPage > 1)
	{
		echo '<li>';
		echo"<a href='".$_SERVER['PHP_SELF']."?page=".($noPage-1)."'>&laquo;</a>";
		echo '</li>';
	}
	for($page = 1; $page <= $jumPage; $page++)
	{
		$showPage = 0;
		if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage))
		{
			if (($showPage == 1) && ($page != 2)) {
				
				echo '<li class="disabled">';
				echo "<a href='#'>...</a>";
				echo '</li>';
			}
			if (($showPage != ($jumPage - 1)) && ($page == $jumPage)) {
				
				echo '<li class="disabled">';
				echo "<a href='#'>...</a>";
				echo '</li>';
			}
			if ($page == $noPage){
				
				echo '<li class="disabled">';
				 echo " <a href='#'><b>".$page."</b></a> ";
				echo '</li>';
			}
			else {
				
				echo '<li>';
				echo " <a href='".$_SERVER['PHP_SELF']."?page=".$page."'>".$page."</a> ";
				echo '</li>';
			}
			$showPage=$page;
		}
	}


	if ($noPage < $jumPage) {
		
		echo '<li>';
		echo "<a href='".$_SERVER['PHP_SELF']."?page=".($noPage+1)."'>&raquo;</a>";
		echo '</li>';
		}
?>
	</ul>
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
