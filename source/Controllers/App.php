<?php

namespace DevBoot\Controllers;

use DevBoot\Controllers\War;
use DevBoot\Support\Pager;
use DevBoot\Core\View;
use DevBoot\Support\Email;
use DevBoot\Commands\OccurrenceCmd;
use DevBoot\Commands\AddressCmd;
use DevBoot\Repositories\AuthRepository;
use DevBoot\Models\Captcha;

/**
 * Start Controller
 * @package DevBoot\App
 */
class App extends War
{

    private $nav;
    private $user;
    /**
     * Web constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!AuthRepository::user()) {
            $this->message->warning("Efetue login para acessar o sistema.")->flash();
            redirect("/");
        }

        $this->user = AuthRepository::user();
        $this->nav = "app/topbar-nav";
    }

    /**
     * PAGINA INICIAL
     * @param null|array $data
     */
    public function home(array $data): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("app/start", [
            "head" => $head,
            "user" => $this->user,
            "app" => "app",
            "nav" => $this->nav
        ]);
    }

    public function panicButton(array $data): void
    {
        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }

            $command = new OccurrenceCmd($data);
            $query = $command->handle();
            if (!$query) {
                $json['message'] = $command->message()->render();
                echo json_encode($json);
                return;
            }

            $json['message'] = $this->message->success("Pedido de socorro enviado com sucesso!")->flash();
            $json['redirect'] = url("/app");
            echo json_encode($json);
            return;
        }
    }

    /**
     * PAGINA INICIAL
     * @param null|array $data
     */
    public function denunciation(array $data): void
    {

        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }

            $command = new OccurrenceCmd($data);
            $query = $command->handle();
            if (!$query) {
                $json['message'] = $command->message()->render();
                echo json_encode($json);
                return;
            }

            $data['occurrences_id'] = $query->id;
            $query = new AddressCmd($data);
            if (!$query->handle()) {
                $json['message'] = $query->message()->render();
                echo json_encode($json);
                return;
            }

            $json['message'] = $this->message->success("Cadastrado com sucesso")->flash();
            $json['redirect'] = url_back();
            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("denunciation", [
            "head" => $head,
            "user" => $this->user,
            "app" => "app/denuncia",
            "nav" => $this->nav
        ]);
    }

    public function instruction(array $data): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("instructions", [
            "head" => $head,
            "user" => $this->user,
            "app" => "app/instrucao",
            "nav" => $this->nav
        ]);
    }

    public function error(array $data): void
    {
        $error = new \stdClass();

        switch ($data['errcode']) {
            case "problemas":
                $error->code = $data['errcode'];
                $error->title = "Estamos enfrentando problemas!";
                $error->message = "Parece que nosso serviço não está diponível no momento. Já estamos vendo isso mas caso precise, envie um e-mail :)";
                $error->linkTitle = "ENVIAR E-MAIL";
                $error->link = "mailto:" . CONF_MAIL_SUPPORT;
                break;

            case "manutencao":
                $error->code = "SIAGEO";
                $error->title = "Estamos em manutenção!";
                $error->message = "Voltamos logo! Por hora estamos trabalhando para melhorar nosso sistema :P";
                $error->linkTitle = null;
                $error->link = null;
                break;

            default:
                $error->code = $data['errcode'];
                $error->title = "Ops! Conteúdo indispinível :/";
                $error->message = "O conteúdo que você tentou acessar não existe, está indisponível no momento ou foi removido :/";
                $error->linkTitle = "Continue navegando!";
                $error->link = url_back();
                break;
        }

        $head = $this->seo->render(
            "{$error->code} | {$error->title}",
            $error->message,
            url("/ops/{$error->code}"),
            theme("/assets/images/share.jpg"),
            false //para o erro não ser indexado por nenhum motor
        );

        echo $this->view->render("error", [
            "head" => $head,
            "error" => $error
        ]);
    }
}
