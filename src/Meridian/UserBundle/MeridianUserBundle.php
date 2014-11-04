<?php

namespace Meridian\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MeridianUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
