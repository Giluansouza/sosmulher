<?php

namespace DevBoot\Controllers\Dev;

use DevBoot\Core\Controller;
use DevBoot\Support\Message;
use DevBoot\Support\Upload;
use DevBoot\Models\PoliceUnit;
use DevBoot\Models\UnitCity;
use DevBoot\Repositories\AuthRepository;
use DevBoot\Support\Pager;

/**
 * Class App
 * @package DevBoot\App
 */
class Dev extends Controller
{
    /**
     * App constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../../themes/" . CONF_VIEW_SUPER);

        if (!AuthRepository::user()) {
            $this->message->warning("Efetue login para acessar o sistema.")->flash();
            redirect("/login");
            return;
        }

        $this->user = AuthRepository::user();

        if ($this->user->level == 2) {
            $this->user->nav = 'views/sidebar-dev'; // Menu
        } else {
            $this->user->nav = 'views/sidebar'; // Menu
        }
    }

    protected function checkLevel(int $lvl): void
    {
        if ($this->user->level < $lvl) {
            $this->message->warning("Você não tem permissão de acesso.")->flash();
            redirect("/app");
        }
    }
}
