 <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <!-- <div class="pull-left image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div> -->
        <div class="pull-left info">
          <p><?=$_SESSION['usuario'];?></p>
          <!-- <a href=""><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVEGACION</li>
        <li class="treeview">
        </li>
        <li>
          
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Graficos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Grafico de Visitas</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Grafico de Visitas por Sector</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Administrar Contenido</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="javascript:void(0);" onclick="verContenedor('vPrincipal.php',7)"><i class="fa fa-table"></i> Todo el Contenido</a></li>
            <li><a href="javascript:void(0);" onclick="verContenedor('vPrincipal.php',2)"><i class="fa fa-plus-circle"></i> Crear Contenido</a></li>
            <li><a href="javascript:void(0);" onclick="verContenedor('vPrincipal.php',3)"><i class="fa fa-edit"></i> Administrar Contenido</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Usuarios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="javascript:void(0);" onclick="verContenedor('vPrincipal.php',5)"><i class="fa fa-table"></i> Todos los Usuarios</a></li>
          <li><a href="javascript:void(0);" onclick="verContenedor('vPrincipal.php',4)"><i class="fa fa-plus-circle"></i> Nuevo Usuario</a></li>
          <li><a href="javascript:void(0);" onclick="verContenedor('vPrincipal.php',6)"><i class="fa fa-eye"></i> Historial de Actividades</a></li>  
          </ul>
        </li>
    </section>
    <!-- /.sidebar -->
  </aside>