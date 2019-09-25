<?php

namespace DevBoot\Controllers\Dev;

use DevBoot\Repositories\OccurrenceRepository;
use DevBoot\Repository\AddressRepository;
use DevBoot\Repository\CityRepository;
use DevBoot\Support\Pager;

use DevBoot\Models\Relationship;

class Occurrence extends Dev
{

    public function __construct ()
    {
        parent::__construct();
    }

    public function show (array $data): void
    {

        $query = new OccurrenceRepository;
        $result = $query->findById($data['id']);

        // echo "<pre>";
        // print_r([json_decode($result)]);
        // echo "</pre>";
        // exit;
        $head = $this->seo->render(
            CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("occurrences/show", [
            "head" => $head,
            "user" => $this->user,
            "result" => $result
        ]);
    }

}
