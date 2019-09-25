<?php

namespace DevBoot\Commands;

use DevBoot\Support\Upload;
use DevBoot\Support\Message;

class UploadCmd
{

    protected $data;
    private $message;
    private $upload;
    private $name;
    private $width = 630;

    public function __construct(array $data)
    {
        $this->message = new Message;
        $this->upload = new Upload();
        $this->data = $data;
        $this->setName();
    }

    public function image(): bool
    {
        $image = $this->upload->image($this->data['img'], $this->getName(), $this->width);
        if (!$image) {
            $this->message->error($this->upload->message()->render());
            return false;
        }
        $this->name = $image;
        return true;
    }

    private function setName ()
    {
        $this->name = str_slugui(time().$this->data['img']['name']);
    }

    public function getName (): string
    {
        return  $this->name;
    }

    public function message()
    {
        return $this->message;
    }
}
