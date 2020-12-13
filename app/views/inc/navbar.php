<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="<?php echo URLROOT; ?>/">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">
            Inici
        </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#general-pages" <?php echo (strpos($_SERVER['REQUEST_URI'] ,"immobles") !== false) ? 'aria-expanded="true"' : 'aria-expanded="false"'; ?> aria-controls="general-pages">
        <i class="mdi mdi-table-edit  menu-icon"></i>
        <span class="menu-title">Immobles</span>
        <i class="menu-arrow"></i>
      </a>
      <div <?php echo (strpos($_SERVER['REQUEST_URI'] ,"immobles") !== false) ? 'class="collapse show"' : 'class="collapse"'; ?> id="general-pages">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'] ,"immobles/add") !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/immobles/add">Inserir</a></li>
        </ul>
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'] ,"immobles/index") !== false OR strpos($_SERVER['REQUEST_URI'] ,"immobles/edit") !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/immobles/index">Modificar</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#general-pages-2" <?php echo (strpos($_SERVER['REQUEST_URI'] ,"usuaris") !== false) ? 'aria-expanded="true"' : 'aria-expanded="false"'; ?> aria-controls="general-pages-2">
        <i class="mdi mdi-table-edit  menu-icon"></i>
        <span class="menu-title">Usuari</span>
        <i class="menu-arrow"></i>
      </a>
      <div <?php echo (strpos($_SERVER['REQUEST_URI'] ,"usuaris") !== false) ? 'class="collapse show"' : 'class="collapse"'; ?> id="general-pages-2">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'] ,"usuaris/index") !== false OR strpos($_SERVER['REQUEST_URI'] ,"usuaris/edit") !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/usuaris/index">Modificar</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>