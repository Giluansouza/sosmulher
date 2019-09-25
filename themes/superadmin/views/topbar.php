<nav class="navbar-custom">
    <ul class="list-inline float-right mb-0">
        <li class="list-inline-item dropdown notif">
            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="fa fa-fw fa-question-circle"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg">
                <!-- item-->
                <div class="dropdown-item noti-title">
                    <h5><small>Ajuda e Suporte</small></h5>
                </div>

                <!-- item-->
                <a target="_blank" href="https://www.pikeadmin.com" class="dropdown-item notify-item">
                    <p class="notify-details ml-0">
                        <b>Do you want custom development to integrate this theme?</b>
                        <span>Contact Us</span>
                    </p>
                </a>

                <!-- item-->
                <a target="_blank" href="https://www.pikeadmin.com/pike-admin-pro" class="dropdown-item notify-item">
                    <p class="notify-details ml-0">
                        <b>Do you want PHP version of the theme that save dozens of hours of work?</b>
                        <span>Try Pike Admin PRO</span>
                    </p>
                </a>

                <!-- All-->
                <a title="Clcik to visit Pike Admin Website" target="_blank" href="https://www.giluansouza.com.br" class="dropdown-item notify-item notify-all">
                    <i class="fa fa-link"></i> Giluan Souza
                </a>

            </div>
        </li>
        <!-- <li class="list-inline-item dropdown notif">
            <div id="sessao"></div>
        </li> -->
        <li class="list-inline-item dropdown notif">
            <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="<?= theme("/../superadmin/assets/images/avatars/admin.png"); ?>" alt="Profile image" class="avatar-rounded">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <a href="<?= url("/admin/perfil"); ?>" class="dropdown-item notify-item">
                    <i class="fa fa-user"></i> <span>Perfil</span>
                </a>
                <!-- item-->
                <a href="<?= url("/dev/alterar-senha"); ?>" class="dropdown-item notify-item">
                    <i class="fa fa-edit"></i> <span>Alterar Senha</span>
                </a>
                <!-- item-->
                <a href="<?= url("/sair") ?>" class="dropdown-item notify-item">
                    <i class="fa fa-power-off"></i> <span>Sair</span>
                </a>
            </div>
        </li>
    </ul>
    <ul class="list-inline menu-left mb-0">
        <li class="float-left">
            <button class="button-menu-mobile open-left">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </li>
    </ul>
</nav>
