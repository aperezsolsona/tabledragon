<?php

namespace TableDragon;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    /**
     * @return string
     */
    public static function getRootProjectDir(): string
    {
        return dirname(__DIR__);
    }
}
