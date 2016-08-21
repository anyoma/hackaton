<?php
include($_SERVER['DOCUMENT_ROOT']."/hackaton/clases/usua.php");
$idusr=$_GET['usrt'];
$ObjtNmtp=new user();
$nMTYPE=$ObjtNmtp->ObtenerNameTipoUser($idusr);
$nMame=$ObjtNmtp->ObtenerNombre($idusr);
$tipe=$ObjtNmtp->Obtenertipe($idusr);
$proy=$_GET['proy'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Evaluador</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<script src="../js/jquery.min.js"></script> 
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script> 
<script >

$(document).ready(function(){
		$("#Perfilp").click(function(){
			
			$('#perfilp').show();
			$('#proyectoactual').hide();
			$('#postevaluacion').hide();
			$('#nuevop').hide();
		 });
		 $("#Proyectoactual").click(function(){
			
			$('#perfilp').hide();
			$('#proyectoactual').show();
			$('#postevaluacion').hide();
			$('#nuevop').hide();
		 });
		  $("#Postevaluacion").click(function(){
			
			$('#perfilp').hide();
			$('#proyectoactual').hide();
			$('#postevaluacion').show();
			$('#nuevop').hide();
		 });
		  $("#Nuevop").click(function(){
			
			$('#perfilp').hide();
			$('#proyectoactual').hide();
			$('#postevaluacion').hide();
			$('#nuevop').show();
		 });
		 $("#Ev").click(function(){
			
			$('#ev').show();
			$('#pr').hide();
			$('#ca').hide();
		 });
		  $("#Pr").click(function(){
			$('#ev').hide();
			$('#pr').show();
			$('#ca').hide();
		 });
		  $("#Ca").click(function(){
			$('#ev').hide();
			$('#pr').hide();
			$('#ca').show();
		 });
		 $("#Pef").click(function(){			
			$('#pef').show();
			$('#gen').hide();
			$('#sem').hide();
			$('#fin').hide();
		 });
		 $("#Gen").click(function(){			
			$('#pef').hide();
			$('#gen').show();
			$('#sem').hide();
			$('#fin').hide();
		 });
		  $("#Sem").click(function(){			
			$('#pef').hide();
			$('#gen').hide();
			$('#sem').show();
			$('#fin').hide();
		 });
		  $("#Fin").click(function(){			
			$('#pef').hide();
			$('#gen').hide();
			$('#sem').hide();
			$('#fin').show();
		 });
		 
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
		 
		
	});

</script>
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?=$nMTYPE?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="/hackaton/index.html" >
             X
            
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$nMame?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
      <?php if($tipe=='2'){ ?>
        <li class="header">Menu</li>
        <li class="active treeview">
          <a href="#" >
            <i class="fa fa-dashboard"></i> <span>Evaluaciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="#" id="Gen"><i class="fa fa-circle-o"></i> Proyectos Generales</a></li>
            <li><a href="#" id="Sem"><i class="fa fa-circle-o"></i>Semifinalistas</a></li>
            <li><a href="#" id="Fin"><i class="fa fa-circle-o"></i>Finalistas</a></li>
          </ul>
        </li>
         <li class="active treeview">
          <a href="#" id="Pef" >
            <i class="fa fa-dashboard"></i> <span>Perfil</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
      
        </li>
        <?php } ?>
        <?php if($tipe=='1'){ ?>
        <li class="header">Menu</li>
        <li class="active treeview">
          <a href="#" id="Perfilp" >
            <i class="fa fa-dashboard"></i> <span>Perfil</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

          </ul>
        </li>
        <li class="active treeview">
          <a href="#" id="Proyectoactual"  >
            <i class="fa fa-dashboard"></i> <span>Proyecto Actual</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
      
        </li>
         <li class="active treeview">
          <a href="#" id="Postevaluacion" >
            <i class="fa fa-dashboard"></i> <span>Post Evaluación</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
      
        </li>
         <li class="active treeview">
          <a href="#" id="Nuevop">
            <i class="fa fa-dashboard"></i> <span>Agregar Nuevo Proyecto</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
      
        </li>
        <?php } ?>
        <?php if($tipe=='3'){ ?>
        <li class="header">Menu</li>
        <li class="active treeview">
          <a href="#" id="Ev">
            <i class="fa fa-dashboard"></i> <span>Evaluadores</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

          </ul>
        </li>
        <li class="active treeview">
          <a href="#" id="Pr">
            <i class="fa fa-dashboard"></i> <span>Proyectos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
      
        </li>
         <li class="active treeview">
          <a href="#" id="Ca">
            <i class="fa fa-dashboard"></i> <span>Calificaciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
      
        </li>
         
        <?php } ?>
        
        </ul>
       
      
   
       
  
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <?php if($tipe=='1'){ ?>
  <div id="perfilp" style="display:none;">
  <strong>Perfil</strong>
    <?php
  echo $ObjtNmtp->ObtenerPerfil($idusr);
  ?>
  
  </div>
  <div id="proyectoactual" style="display:none;">
  <strong>Proyecto Actual</strong>
  <?php
  echo $ObjtNmtp->ProyectoActual($idusr);
  ?>
  
  </div>
  <div id="postevaluacion" style="display:none;">
  <strong>Post evaluacion</strong>
 <?php echo $ObjtNmtp->ObtenerPostE($idusr) ?>
  
  </div>
  <div id="nuevop" style="display:none;">
    <strong>Nuevo Proyecto</strong>
    <form >
    
    <div class="form-group">
                            <label for="name">
                                Nombre del Proyecto</label>
                            <input type="text" name="nameproyecto" class="form-control" id="name" placeholder="Nombre del Proyecto" required />
                        </div>
                        
                        <div class="form-group">
                  <label>Area Del Proyecto</label>
                  <select name="cat" class="form-control">
                    <option value="1">Tecnología</option>
                    <option value="2">Alimentos</option>
                    <option value="3">Construcción</option>
                    <option value="4">Agricultura</option>
        
                  </select>
                </div>
                <div class="form-group">
                  <label>Categoria Del Proyecto</label>
                  <select name="catego" class="form-control">
                    <option value="1">Emprendimiento Social</option>
                    <option value="2">Idea de Negocio</option>
                    <option value="3">Negocio Emprendido</option>
                  
        
                  </select>
                </div>
                  <div class="form-group">
                  <label>Descripcion del Proyecto</label>
                  <textarea name="descrp" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
                  <div class="form-group">
                  <label>Idea de Negocio</label>
                  <textarea name="idea" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                            <label for="name">
                                Link Video Youtube</label>
                            <input type="text" name="link" class="form-control" id="name" placeholder="Link de Video Youtube" required />
                        </div>
                         <div class="form-group">
                  <label for="exampleInputFile">PDF del Proyecto</label>
                  <input name="pdf" type="file" id="exampleInputFile">

                 
                </div>
    
    </form>
    
  </div>
  
  <?php } ?>
  <?php if($tipe=='3'){ ?>
  <div id="ev" style="display:none;" >
  <strong>Evaluadores</strong>
  <?Php echo $ObjtNmtp->ObtenerEvaluadores(); ?>
            <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar Evaluador</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
<div class="form-group">
                            <label for="name">
                                Nombre</label>
                            <input type="text" name="nam" class="form-control" id="name" placeholder="Enter Nombre" required />
                        </div>
                               <div class="form-group">
                            <label for="name">
                               Apellidos</label>
                            <input type="text" name="ape" class="form-control" id="name" placeholder="Enter Nombre" required />
                        </div>
                        
                        <div class="form-group">
                            <label for="email">
                                Email Address</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" name="corr" class="form-control" id="email" placeholder="Enter email" required /></div>
                        </div>
                         <div class="form-group">
                  <label>Area De Fortaleza</label>
                  <select name="cat" class="form-control">
                    <option value="1">Tecnología</option>
                    <option value="2">Alimentos</option>
                    <option value="3">Construcción</option>
                    <option value="4">Agricultura</option>
        
                  </select>
                </div>
                        <div class="form-group">
                            <label for="name">
                                Password</label>
                            <input type="password" name="passw" class="form-control" id="name" placeholder="Enter Password" required />
                        </div>
                        <div class="form-group">
                            <label for="name">
                                Telefono</label>
                            <input type="text" name="telef" class="form-control" id="name" placeholder="Enter Telefono" required />
                        </div>
            </div>
            <!-- /.box-body -->
           
            <!-- /.box-footer -->
          </div>
  </div>
   <div id="pr" style="display:none;">
    <strong>Proyectos Postulados  <small class="label pull-right bg-green">9</small></strong>
    <br/>
     <br/>
     <strong><a href="#" data-toggle="modal" data-target="#myModal">Emprendimiento Social </a> <span class="label label-primary pull-right">3</span> </strong>
    <br/>
     <br/>
     <strong>Idea de Negocio  <span class="label label-primary pull-right">2</span></strong>
    <br/>
     <br/>
     <strong>Negocio Emprendido  <span class="label label-primary pull-right">4</span></strong>
    <br/>
     <br/>
     
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Proyectos</h4>
      </div>
      <div class="modal-body">
  <?Php echo $ObjtNmtp->ObtenerProyectos(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Asignar</button>
      </div>
    </div>
  </div>
</div>
    
   </div>
    <div id="ca" style="display:none;">
     <strong>Calificacion</strong>
      <strong>Proyectos Postulados  <small class="label pull-right bg-green">9</small></strong>
    <br/>
     <br/>
     <strong><a href="#" data-toggle="modal" data-target="#myModal2">Emprendimiento Social </a> <span class="label label-primary pull-right">3</span> </strong>
    <br/>
     <br/>
     <strong>Idea de Negocio  <span class="label label-primary pull-right">2</span></strong>
    <br/>
     <br/>
     <strong>Negocio Emprendido  <span class="label label-primary pull-right">4</span></strong>
    <br/>
     <br/>
     
     <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Calificaciones</h4>
      </div>
      <div class="modal-body">
  <?Php echo $ObjtNmtp->ObtenerCalificaciones(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
  
      </div>
    </div>
  </div>
</div>
     
     
    </div>
  
  <?php } ?>
  <?php if($tipe=='2'){ ?>
  <div id="pef" style="display:none;">
  <strong>Perfil</strong>
    <br/>
    <?php 	
	echo $ObjtNmtp->ObtenerPerfilEv($idusr);
	?>
     
     
  </div>
  <div id="gen"  style="display:none;">
   <strong>Proyectos Generales</strong>
   <br/>
   <br/>
  <?php 	
	echo $ObjtNmtp->ObtenerProy($idusr);
	?>
      
     
    
  </div>
  <div id="sem"  style="display:none;">
  <strong>Semifinalistas</strong>
   <br/>
   <br/>
  </div>
  <div id="fin"  style="display:none;">
   <strong>Finalistas</strong>
   <br/>
   <br/>
  </div>
  <?php if($proy!=""){?>
  <div >
   <strong>Evaluar Proyecto</strong>
   <br/>
   <br/>
   <?php echo $ObjtNmtp->verProy($proy); ?>
  </div>
  <?php  } ?>
  
  <?PHP } ?>
  
  
  
  
  
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->

        </div>
      
      
        <!-- ./col -->

        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
  
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b></b> 
    </div>
    <strong></strong> 
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
</aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->

<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script> 
<!--<script src="plugins/morris/morris.min.js"></script> -->


</body>
</html>
