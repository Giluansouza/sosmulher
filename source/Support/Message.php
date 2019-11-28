<?php

namespace DevBoot\Support;

use DevBoot\Core\Session;

/**
 * DevBoot | Class Message
 * @author Giluan Souza <contato@giluansouza.com.br>
 * @package DevBoot\Support
 */
class Message
{
    /** @var string */
    private $text;

    /** @var string */
    private $type;

    /** @var string */
    private $icon;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * @return string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function info(string $message): Message
    {
        $this->type = CONF_MESSAGE_INFO;
        $this->icon = "fa-info-circle";
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function success(string $message): Message
    {
        $this->type = CONF_MESSAGE_SUCCESS;
        $this->icon = "fa-check-circle";
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function warning(string $message): Message
    {
        $this->type = CONF_MESSAGE_WARNING;
        $this->icon = "fa-exclamation-triangle";
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function error(string $message): Message
    {
        $this->type = CONF_MESSAGE_ERROR;
        $this->icon = "fa-times-circle";
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return  "<div id='alert-message' class='alert {$this->getType()} alert-dismissible fade show' role='alert'>".
                    "<i class='fa {$this->getIcon()} bigfonts' aria-hidden='true'></i> {$this->getText()}".
                "</div>";
    }

    /**
     * @return string
     */
    public function json(): string
    {
        return json_encode(["error" => $this->getText()]);
    }

    /**
     * @return string
     */
    public function textString(): string
    {
        return $this->getText();
    }

    /**
     * Set flash Session Key
     */
    public function flash(): void
    {
        (new Session())->set("flash", $this);
    }

    /**
     * @param string $message
     * @return string
     */
    private function filter(string $message): string
    {
        return filter_var($message, FILTER_SANITIZE_STRIPPED);
    }
}
