<?php

namespace DevBoot\Controllers\App;

use DevBoot\Support\Upload;
use DevBoot\Support\Pager;
use DevBoot\Repository\OccurrenceRepository;
use DevBoot\Repository\PeopleRepository;
use DevBoot\Repository\PoliceUnitRepository;
use DevBoot\Repository\AddressRepository;
use DevBoot\Repository\CityRepository;
use DevBoot\Repository\DistrictRepository;
use DevBoot\Repository\TypeOccurrenceRepository;

use DevBoot\Models\Relationship;

class People extends App
{

    public function __construct ()
    {
        parent::__construct();
    }

    public function peopleQuery(array $data): void
    {

        $people = new PeopleRepository;
        $people->list("/dev/lista-pessoas/p/", $data, 10);

        $head = $this->seo->render(
            "Administração - ".CONF_SITE_NAME,
            CONF_SITE_DESC,//descrição do site
            url("{$this->user->url}/lista-pessoas"),//link home
            theme("/assets/images/share.jpg")//imagem de compartilhamento
        );

        echo $this->view->render("views/people/people-query", [
            'head' => $head,
            'user' => $this->user,
            'lists' => $people->post(),
            'paginator' => $people->pager()->render()
        ]);
    }

    public function peopleList(array $data): void
    {

        $filter = [
            'page' => $data['page']
        ];

        $people = new PeopleRepository;
        $people->list("{$this->user->url}/lista-pessoas/p/", $data, 10);

        $head = $this->seo->render(
            "Administração - ".CONF_SITE_NAME,
            CONF_SITE_DESC,//descrição do site
            url("{$this->user->url}/lista-pessoas"),//link home
            theme("/assets/images/share.jpg")//imagem de compartilhamento
        );

        echo $this->view->render("views/people/people-list", [
            'head' => $head,
            'user' => $this->user,
            'filter' => $filter,
            'lists' => $people->post(),
            'paginator' => $people->pager()->render()
        ]);
    }

    public function peopleCreate(array $data): void
    {
        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }

            $people = new PeopleRepository;
            if (!$people->create($data)) {
                $json['message'] = $people->message()->render();
                echo json_encode($json);
                return;
            }

            $json['message'] = $this->message->success("Cadastrado com sucesso")->flash();
            $json['redirect'] = url("admin/cadastrar-pessoa");
            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            "Administração - ".CONF_SITE_NAME,
            CONF_SITE_DESC,//descrição do site
            url("{$this->user->url}/lista-pessoas"),//link home
            theme("/assets/images/share.jpg")//imagem de compartilhamento
        );

        echo $this->view->render("views/people/people-create", [
            'head' => $head,
            'user' => $this->user
        ]);
    }

    public function peopleUpdate(array $data): void
    {

        //upload photo
        if (!empty($_FILES) && $_FILES["photo"]['name'] != "") {
            $name = time().$data['name'];
            $imageName = str_slugui($name);
            if ($_FILES && !empty($_FILES["photo"]['name'])) {
                $files = $_FILES['photo'];
                $upload = new Upload();
                $image = $upload->image($files, $imageName, 600);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }
                $data['photo'] = $image;
            }
        }

        $people = new PeopleRepository;
        if (!$people->update($data)) {
            $json['message'] = $people->message()->render();
            echo json_encode($json);
            return;
        }

        $json['message'] = $this->message->success("Alteração realizado com sucesso")->flash();
        //$json['redirect'] = url_back();
        echo json_encode($json);
        return;

        // $data['address_id'] = $address->getId();


        // $q = new PeopleRepository;
        // $post = $q->find($data);

        // $head = $this->seo->render(
        //     "Administração - ".CONF_SITE_NAME,
        //     CONF_SITE_DESC,//descrição do site
        //     url("{$this->user->url}/lista-pessoas"),//link home
        //     theme("/assets/images/share.jpg")//imagem de compartilhamento
        // );

        // echo $this->view->render("views/people/people-update", [
        //     'head' => $head,
        //     'user' => $this->user,
        //     'data' => $post
        // ]);
    }
}
