<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Twig;

use AppBundle\Utils\Markdown;
use Symfony\Component\Intl\Intl;

/**
 * This Twig extension adds a new 'md2html' filter to easily transform Markdown
 * contents into HTML contents inside Twig templates.
 *
 * See http://symfony.com/doc/current/cookbook/templating/twig_extension.html
 *
 * In addition to creating the Twig extension class, before using it you must also
 * register it as a service. See app/config/services.yml file for details.
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Julien ITARD <julienitard@gmail.com>
 */
class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('comma', [$this, 'addComma']),
        ];
    }

    public function addComma($sentence, $commasep = ',')
    {
        return $sentence.$commasep;
    }

}

