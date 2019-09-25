<?php

namespace DevBoot\Core;

use DevBoot\Support\Message;
use DevBoot\Support\Seo;

/**
 * DevBoot | Class Controllers
 * @author Giluan Souza <contato@giluansouza.com.br>
 * @package DevBoot\Core
 */
class Controller
{
    /** @var View */
    protected $view;

    /** @var Seo */
    protected $seo;

    /** @var Message */
    protected $message;

    /**
     * Controller constructor.
     * @param string|null $pathToViews
     */
    public function __construct(string $pathToViews = null)
    {
        $this->view = new View($pathToViews);
        $this->seo = new Seo();
        $this->message = new Message();
    }
}
