<?php

namespace DevBoot\Controllers\Auth;

use DevBoot\Core\Controller;
use DevBoot\Repositories\AuthRepository;

/**
 *
 */
class Auth extends Controller
{

    public function __construct()
    {
         parent::__construct(__DIR__ . "/../../../themes/" . CONF_VIEW_WAR . "/");

         $this->nav = "widgets/nav";
    }

    public function login(array $data)
    {
        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }

            // if (isset($_SESSION['weblogin']) && $_SESSION['weblogin']->requests > 0) {
            //     $url = "https://www.google.com/recaptcha/api/siteverify";
            //     $recaptcha = $data['g-recaptcha-response'];
            //     $response = ['secret' => CONF_RECAPTCHA_SERVER, 'response' => $recaptcha];
            //     $options = [
            //         'http' => [
            //             'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            //             'method' => 'POST',
            //             'content' => http_build_query($response)
            //         ]
            //     ];

            //     $context = stream_context_create($options);
            //     $result = file_get_contents($url, false, $context);
            //     $res = json_decode($result);

            //     if (!$res->success) {
            //         $json['message'] = $this->message->error("Marque o reCaptcha pra continuar")->render();
            //         echo json_encode($json);
            //         return;
            //     }
            // }

            // if (request_limit("weblogin", 2, $data['email'])) {
            //     // (new AuthRepository)->blockUser($data);
            //     $json['message'] = $this->message->error("Você efetuou 5 tentativas incorretas. Entre em contato para desbloquear o usuário e o IP")->flash();
            //     $json['redirect'] = url("/");
            //     echo json_encode($json);
            //     return;
            // }

            if (empty($data['email']) || empty($data['password'])) {
                $json['message'] = $this->message->warning("Informe seu email e senha para entrar")->render();
                echo json_encode($json);
                return;
            }

            $save = (!empty($data['save']) ? true : false);
            $auth = new AuthRepository();
            $login = $auth->login($data['email'], $data['password'], $save);

            if ($login) {
                if ($auth->user()->level == 0) {
                    $json['redirect'] = url("/app");
                } else {
                    $json['redirect'] = url("/admin");
                }
            } else {
                $json['message'] = $this->message->error($auth->message().'. Tentativas '.$_SESSION['weblogin']->requests.", após 5 tentativas seu usuário será bloqueado.")->flash();
                $json['redirect'] = url("/");
                echo json_encode($json);
                return;
            }

            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("auth/login", [
            "head" => $head,
            "app" => "",
            "nav" => $this->nav
        ]);
    }

    /**
     * PAGINA DE CASDASTRO
     * @param null|array $data
     */
    public function register(array $data): void
    {

        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }

            $user = new UserCmd ($data);
            if (!$user->handle()) {
                $json['message'] = $user->message()->render();
                echo json_encode($json);
                return;
            }

            $json['message'] = $this->message->success("Cadastrado com sucesso")->flash();
            $json['redirect'] = url("/cadastro");
            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("auth/signup", [
            "head" => $head,
            "app" => "cadastro",
            "nav" => $this->nav
        ]);
    }

    /**
     * SITE PASSWORD FORGET
     * @param null|array $data
     */
    public function forget(?array $data)
    {
        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }

            if (empty($data["email"])) {
                $json['message'] = $this->message->info("Informe seu e-mail para continuar")->render();
                echo json_encode($json);
                return;
            }

            if (request_repeat("webforget", $data["email"])) {
                $json['message'] = $this->message->error("E-mail enviado, verifique a sua caixa de mensagem!")->render();
                echo json_encode($json);
                return;
            }

            $auth = new AuthRepository();
            if ($auth->forget($data["email"])) {
                $json["message"] = $this->message->success("Acesse seu e-mail para recuperar a senha")->render();
            } else {
                $json["message"] = $auth->message()->render();
            }

            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            "Recuperar Senha - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/recuperar"),
            theme("/assets/images/share.jpg")
        );

        echo $this->view->render("auth/forget", [
            "head" => $head,
            "app" => "recuperar-senha",
            "nav" => $this->nav
        ]);
    }

    public function logout()
    {
        $this->message->info("Você saiu do sistema")->flash();
        AuthRepository::logout();
        redirect("/");
        return;
    }
}
