<?php

namespace DevBoot\Controllers\Dev;

use DevBoot\Core\Controller;
use DevBoot\Support\Message;
use DevBoot\Support\Upload;
use DevBoot\Repositories\OccurrenceRepository;

/**
 * Class Head
 * @package DevBoot\Dev
 */
class Admin extends Dev
{

    /**
     * Admin constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * SITE START
     */
    public function home(): void
    {

        $query = new OccurrenceRepository;
        $lists = $query->getOccurrences([
                            'url' => "",
                            "type" => 1,
                            "status" => 0
                        ], 3, true);
        $denunciation = $query->getOccurrences(["type" => 0, "status" => 0], 5, false);

        $head = $this->seo->render(
            CONF_SITE_NAME." | Dashboard",
            CONF_SITE_DESC,//descrição do site
            url('/admin'),//link home
            theme("/assets/images/share.jpg")//imagem de compartilhamento
        );

        echo $this->view->render("home", [
            "head" => $head,
            "user" => $this->user,
            "lists" => $lists,
            "denunciation" => $denunciation
        ]);
    }

}
