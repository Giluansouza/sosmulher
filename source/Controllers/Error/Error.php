<?php

namespace DevBoot\Controllers\Error;

use DevBoot\Core\Controller;
use DevBoot\Support\Pager;
use DevBoot\Core\View;

/**
 * Start Controller
 * @package DevBoot\Error
 */
class Error extends Controller
{

    private $nav;
    /**
     * Web constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../../themes/" . CONF_VIEW_WAR . "/");

        $this->nav['nav'] = "widgets/nav";
        $this->nav['link'] = "";
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
            "error" => $error,
            "app" => "cadastro",
            "nav" => $this->nav
        ]);
    }
}
