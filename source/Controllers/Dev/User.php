<?php

namespace DevBoot\Controllers\Dev;

use DevBoot\Support\Pager;
use DevBoot\Repositories\UserRepository;

class User extends Dev
{

    public function __construct ()
    {
        parent::__construct();
    }

    public function list(array $data): void
    {

        $filter = [
            'page' => $data['page']??""
        ];

        // $query = new UserRepository;
        $query = (new UserRepository)->getAllUsers();

        $head = $this->seo->render(
            "Administração - ".CONF_SITE_NAME,
            CONF_SITE_DESC,//descrição do site
            url("{$this->user->url}/lista-pessoas"),//link home
            theme("/assets/images/share.jpg")//imagem de compartilhamento
        );

        echo $this->view->render("users/user-list", [
            'head' => $head,
            'user' => $this->user,
            'users' => $query
        ]);
    }
}
