<nav id="nav-menu-container">
    <ul class="nav-menu">
        <?php
            $nav = function ($href, $title) use ($app) {
                $active = ($app == $href ? "menu-active" : null);
                $url = url("/{$href}");
                return "<li class=\"{$active}\"><a  href=\"{$url}\">{$title}</a>";
            };

            echo $nav("", "Acessar");
            echo $nav("anonimo", "Anônimo");
            echo $nav("denuncia", "Denúncia");
            echo $nav("cadastro", "Cadastro");
            echo $nav("instrucoes", "Sobre/Instruções");
        ?>
    </ul>
</nav><!-- #nav-menu-container -->
