<nav class="navbar navbar-expand-lg navbar-dark bg-warning fixed-top" id="mainNav">
  <a class="navbar-brand" href="<?php if (isset($link) && $link != ""){ echo $link;}else{ echo "#";} ?>" style="color:black"><i class="<?php if (isset($link) && $link != ""){ echo "fa fa-backward";}else{ echo "";} ?>"></i></a><b><?php echo $nombre_titulo; ?></b>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <?php if($_SESSION['USER_ROLE'] == 1){ ?>
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="dashboard.php">
          <i class="fa fa-fw fa-dashboard"></i>
          <span class="nav-link-text">Dashboard</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-users"></i>
          <span class="nav-link-text">Usuarios</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents">
          <li>
            <a href="register_user.php">Registrar Usuario</a>
          </li>
          <li>
            <a href="view_users.php">Ver Usuarios</a>
          </li>
        </ul>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-wrench"></i>
          <span class="nav-link-text">Servicios</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseExamplePages">
          <li>
            <a href="register_service.php">Registrar Servicio</a>
          </li>
          <li>
            <a href="main.php">Ver Servicios</a>
          </li>
          <li>
            <a href="historical_services.php">Historial de Servicios</a>
          </li>
        </ul>
      </li>
    </ul>
  <?php } ?>
    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
      </li>
      <li class="nav-item">
        <a href="logout.php" class="nav-link" style="color:black">
          <i class="fa fa-fw fa-sign-out"></i>Salir</a>
      </li>
    </ul>
  </div>
</nav>
