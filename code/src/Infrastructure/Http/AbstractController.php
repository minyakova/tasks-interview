<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use Twig;

class AbstractController
{

    protected Twig\Environment $twig;

    public function __construct()
    {
        $loader = new Twig\Loader\FilesystemLoader(ROOT.'/templates');
        $this->twig = new Twig\Environment($loader);
    }

}