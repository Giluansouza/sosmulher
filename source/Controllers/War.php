<?php

namespace DevBoot\Controllers;

use DevBoot\Core\Controller;
use DevBoot\Support\Pager;
use DevBoot\Core\View;
use DevBoot\Support\Email;
use DevBoot\Commands\UserCmd;
use DevBoot\Commands\OccurrenceCmd;
use DevBoot\Commands\AddressCmd;
use DevBoot\Repositories\AuthRepository;
use DevBoot\Models\Captcha;

/**
 * Start Controller
 * @package DevBoot\App
 */
class War extends Controller
{

    private $nav;
    /**
     * Web constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_WAR . "/");

        $this->nav = "widgets/nav";
    }

    /**
     * PAGINA DE CASDASTRO
     * @param null|array $data
     */
    public function anonymous(array $data): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("anonymous", [
            "head" => $head,
            "app" => "anonimo",
            "nav" => $this->nav
        ]);
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
            "app" => "denuncia",
            "nav" => $this->nav
        ]);
    }

    /**
     * PAGINA DE CASDASTRO
     * @param null|array $data
     */
    public function instructions(array $data): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("instructions", [
            "head" => $head,
            "app" => "/instrucao",
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
                $error->code = "SOSMulher Juá";
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
