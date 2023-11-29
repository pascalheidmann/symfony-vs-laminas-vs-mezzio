<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class PingController extends AbstractActionController
{
    public function indexAction(): ViewModel
    {
        return new ViewModel([
            'content' => ['ack' => time()],
        ]);
    }
}