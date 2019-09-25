<nav id="nav-menu-container">
    <ul class="nav-menu">
        <?php
            $nav = function ($href, $title) use ($app) {
                $active = ($app == $href ? "menu-active" : null);
                $url = url("/{$href}");
                return "<li class=\"{$active}\"><a  href=\"{$url}\">{$title}</a>";
            };

            echo $nav("app", "Início");
            echo $nav("app/denuncia", "Denúncia");
            echo $nav("app/instrucao", "Sobre/Instruções");
            echo $nav("sair", "<i class=\"fas fa-sign-out-alt\"></i> Sair");
        ?>
    </ul>
</nav><!-- #nav-menu-container -->

