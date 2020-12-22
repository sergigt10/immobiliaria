<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="<?php echo URLROOT; ?>/">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">
            <b>ADMINISTRADOR</b>
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
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" <?php echo (strpos($_SERVER['REQUEST_URI'] ,"categories") !== false) ? 'aria-expanded="true"' : 'aria-expanded="false"'; ?> aria-controls="ui-basic">
        <i class="mdi mdi-table-edit  menu-icon"></i>
        <span class="menu-title">Categories</span>
        <i class="menu-arrow"></i>
      </a>
      <div <?php echo (strpos($_SERVER['REQUEST_URI'] ,"categories") !== false) ? 'class="collapse show"' : 'class="collapse"'; ?> id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'] ,"categories/add") !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/categories/add">Inserir</a></li>
        </ul>
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'] ,"categories/index") !== false OR strpos($_SERVER['REQUEST_URI'] ,"categories/edit") !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/categories/index">Modificar</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#general-pages-3" <?php echo (strpos($_SERVER['REQUEST_URI'] ,"caracteristiques") !== false) ? 'aria-expanded="true"' : 'aria-expanded="false"'; ?> aria-controls="general-pages-3">
        <i class="mdi mdi-table-edit  menu-icon"></i>
        <span class="menu-title">Característiques</span>
        <i class="menu-arrow"></i>
      </a>
      <div <?php echo (strpos($_SERVER['REQUEST_URI'] ,"caracteristiques") !== false) ? 'class="collapse show"' : 'class="collapse"'; ?> id="general-pages-3">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'] ,"caracteristiques/add") !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/caracteristiques/add">Inserir</a></li>
        </ul>
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'] ,"caracteristiques/index") !== false OR strpos($_SERVER['REQUEST_URI'] ,"caracteristiques/edit") !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/caracteristiques/index">Modificar</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#general-pages-4" <?php echo (strpos($_SERVER['REQUEST_URI'] ,"poblacions") !== false) ? 'aria-expanded="true"' : 'aria-expanded="false"'; ?> aria-controls="general-pages-4">
        <i class="mdi mdi-table-edit  menu-icon"></i>
        <span class="menu-title">Poblacions</span>
        <i class="menu-arrow"></i>
      </a>
      <div <?php echo (strpos($_SERVER['REQUEST_URI'] ,"poblacions") !== false) ? 'class="collapse show"' : 'class="collapse"'; ?> id="general-pages-4">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'] ,"poblacions/add") !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/poblacions/add">Inserir</a></li>
        </ul>
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'] ,"poblacions/index") !== false OR strpos($_SERVER['REQUEST_URI'] ,"/poblacions/edit") !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/poblacions/index">Modificar</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#general-pages-5" <?php echo (strpos($_SERVER['REQUEST_URI'] ,"provincies") !== false) ? 'aria-expanded="true"' : 'aria-expanded="false"'; ?> aria-controls="general-pages-5">
        <i class="mdi mdi-table-edit  menu-icon"></i>
        <span class="menu-title">Províncies</span>
        <i class="menu-arrow"></i>
      </a>
      <div <?php echo (strpos($_SERVER['REQUEST_URI'] ,"provincies") !== false) ? 'class="collapse show"' : 'class="collapse"'; ?> id="general-pages-5">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'] ,"provincies/add") !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/provincies/add">Inserir</a></li>
        </ul>
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'] ,"provincies/index") !== false OR strpos($_SERVER['REQUEST_URI'] ,"provincies/edit") !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/provincies/index">Modificar</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#general-pages-7" <?php echo (strpos($_SERVER['REQUEST_URI'] ,"certificats") !== false) ? 'aria-expanded="true"' : 'aria-expanded="false"'; ?> aria-controls="general-pages-7">
        <i class="mdi mdi-table-edit  menu-icon"></i>
        <span class="menu-title">Certificats</span>
        <i class="menu-arrow"></i>
      </a>
      <div <?php echo (strpos($_SERVER['REQUEST_URI'] ,"certificats") !== false) ? 'class="collapse show"' : 'class="collapse"'; ?> id="general-pages-7">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'] ,"certificats/add") !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/certificats/add">Inserir</a></li>
        </ul>
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'] ,"certificats/index") !== false OR strpos($_SERVER['REQUEST_URI'] ,"certificats/edit") !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/certificats/index">Modificar</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#general-pages-6" <?php echo (strpos($_SERVER['REQUEST_URI'] ,"usuaris") !== false) ? 'aria-expanded="true"' : 'aria-expanded="false"'; ?> aria-controls="general-pages-6">
        <i class="mdi mdi-table-edit  menu-icon"></i>
        <span class="menu-title">Usuaris</span>
        <i class="menu-arrow"></i>
      </a>
      <div <?php echo (strpos($_SERVER['REQUEST_URI'] ,"usuaris") !== false) ? 'class="collapse show"' : 'class="collapse"'; ?> id="general-pages-6">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'] ,"usuaris/add") !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/usuaris/add">Inserir</a></li>
        </ul>
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'] ,"usuaris/index") !== false OR strpos($_SERVER['REQUEST_URI'] ,"usuaris/edit") !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/usuaris/index">Modificar</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>