<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Administrativo</title>

    <link href="<?= BASE_URL; ?>Assets/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="<?= BASE_URL; ?>Assets/img/favicon.png" />
    <link rel="icon" href="<?= BASE_URL; ?>Assets/img/favicon.png" type="image/x-icon"/>
    <?php if(isset($viewData['CSS'])){echo $viewData['CSS'];}; ?>
    <style type="text/css">
        
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

    </style>
    
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="#">
                    <span class="align-middle">Administrativo</span>
                </a>
                <ul class="sidebar-nav">
                    <!--  -->
                    <li class="sidebar-item <?= (isset($viewData['nivel-1']) && $viewData['nivel-1'] == "Dashboard")?'active':''; ?>">
                        <a class="sidebar-link" href="<?=BASE_URL.'Home';?>">
                            <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">DashBoard</span>
                        </a>
                    </li>
                    <!--  -->
                    <li class="sidebar-item <?= (isset($viewData['nivel-1']) && $viewData['nivel-1'] == "Configurações")?'active':''; ?> ">
                        <!-- Perfil -->
                        <a href="#perfil" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="settings"></i> 
                            <span class="align-middle">Configurações</span>
                        </a>
                        <ul id="perfil" class="sidebar-dropdown list-unstyled collapse <?= (isset($viewData['nivel-1']) && $viewData['nivel-1'] == "Configurações")?'show':''; ?>" data-bs-parent="#sidebar">
                            <li class="sidebar-item <?= (isset($viewData['nivel-2']) && $viewData['nivel-2'] == "Usuarios")?'active':''; ?>"><a class="sidebar-link" href="<?= BASE_URL.'Users';?>">Usuários</a></li>
                            <li class="sidebar-item <?= (isset($viewData['nivel-2']) && $viewData['nivel-2'] == "Permissões")?'active':''; ?>"><a class="sidebar-link" href="<?= BASE_URL.'Permissions';?>">Grupos de permissões</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="sidebar-cta">
                    <div class="sidebar-cta-content">
                        <strong class="d-inline-block mb-2">Quer ajuda?</strong>
                        <div class="mb-3 text-sm">
                            Está com dificuldades em alguma função? Abra um chamado com nosso time de desenvolvimento.
                        </div>
                        <div class="d-grid">
                            <a href="#" target="_blank" class="btn btn-primary">Abrir chamado</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>
                <form class="d-none d-sm-inline-block">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control" placeholder="Search…" aria-label="Search">
                        <button class="btn" type="button">
                            <i class="align-middle" data-feather="search"></i>
                        </button>
                    </div>
                </form>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    4 New Notifications
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Update completed</div>
                                                <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                                                <div class="text-muted small mt-1">30m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Lorem ipsum</div>
                                                <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Login from 192.186.1.8</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">New connection</div>
                                                <div class="text-muted small mt-1">Christina accepted your request.</div>
                                                <div class="text-muted small mt-1">14h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <span class="text-dark"><?= $viewData['name'];?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" ><i class="align-middle me-1" data-feather="user"></i> Example</a>
                                <a class="dropdown-item" ><i class="align-middle me-1" data-feather="pie-chart"></i> Example</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"><i class="align-middle me-1" data-feather="settings"></i>Configurações</a>
                                <a class="dropdown-item" ><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= BASE_URL.'Login/logout';?>">Sair</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <?php $this->loadViewInTemplate($viewName, $viewData); ?>


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="index.html" class="text-muted"><strong>AdminKit Demo</strong></a> &copy; Murilo Morais 
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="<?= BASE_URL; ?>Assets/js/jquery-3.5.1.js"></script>
    <script src="<?= BASE_URL; ?>Assets/js/jquery.mask.js"></script>
    <script src="<?= BASE_URL; ?>Assets/js/app.js"></script>    
    <script type="text/javascript">
        const BASE_URL = '<?= BASE_URL;?>'
    </script>
    <?php if(isset($viewData['JS'])){echo $viewData['JS'];}; ?>
</body>
</html>