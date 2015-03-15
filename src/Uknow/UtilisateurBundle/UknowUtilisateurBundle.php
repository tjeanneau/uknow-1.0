<?php

namespace Uknow\UtilisateurBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UknowUtilisateurBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
