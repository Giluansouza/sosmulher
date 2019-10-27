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

        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }

            $people = new OccurrenceRepository;
            if (!$people->update($data)) {
                $json['message'] = $people->message()->render();
                echo json_encode($json);
                return;
            }

            $json['message'] = $this->message->success("Status atualizado com sucesso")->flash();
            $json['redirect'] = url("admin/ocorrencia/{$data['occurrence_id']}");
            echo json_encode($json);
            return;
        }

        $query = new OccurrenceRepository;
        $result = $query->findById($data['id']);

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

    public function btnPanic(array $data): void
    {

        $query = new OccurrenceRepository;
        $lists = $query->getOccurrences([
                            'page' => $data['page']??0,
                            'url' => "admin/botao-panico/p/",
                            "type" => 1,
                            "status" => NULL
                        ], 10, true);

        $head = $this->seo->render(
            CONF_SITE_NAME." | Dashboard",
            CONF_SITE_DESC,//descrição do site
            url('/admin'),//link home
            theme("/assets/images/share.jpg")//imagem de compartilhamento
        );

        echo $this->view->render("occurrences/btn-panic", [
            "head" => $head,
            "user" => $this->user,
            "lists" => $lists,
            'paginator' => $query->pager()->render()
        ]);
    }

    public function denunciation(array $data): void
    {

        $query = new OccurrenceRepository;
        $lists = $query->getOccurrences([
                            'page' => $data['page']??0,
                            'url' => "admin/denuncias/p/",
                            "type" => 0,
                            "status" => NULL
                        ], 10, true);

        $head = $this->seo->render(
            CONF_SITE_NAME." | Dashboard",
            CONF_SITE_DESC,//descrição do site
            url('/admin'),//link home
            theme("/assets/images/share.jpg")//imagem de compartilhamento
        );

        echo $this->view->render("occurrences/denunciation", [
            "head" => $head,
            "user" => $this->user,
            "lists" => $lists,
            'paginator' => $query->pager()->render()
        ]);
    }

}
