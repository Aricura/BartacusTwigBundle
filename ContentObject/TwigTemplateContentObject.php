<?php

declare(strict_types=1);

/*
 * This file is part of the Bartacus Twig bundle.
 *
 * Copyright (c) Emily Karisch
 *
 * This bundle is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This bundle is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this bundle. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Bartacus\Bundle\TwigBundle\ContentObject;

use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class TwigTemplateContentObject
{
    /**
     * @param string $name  The content object name, eg. "TWIGTEMPLATE"
     * @param array  $conf  The array with TypoScript properties for the content object
     * @param string $TSkey a string label used for the internal debugging tracking
     */
    public function cObjGetSingleExt(string $name, array $conf, $TSkey, ContentObjectRenderer $cObj): string
    {
        if ('TWIGTEMPLATE' === $name) {
            return $this->render($conf, $cObj);
        }

        return '';
    }

    /**
     * Rendering the cObject, TWIGTEMPLATE.
     *
     * Configuration properties:
     * - template string+stdWrap The Twig template file
     * - variable array of cObjects, the keys are the variable names in twig
     *
     * Example:
     * 10 = FLUIDTEMPLATE
     * 10.template = layouts/default.html.twig
     * 10.variables {
     *   mylabel = TEXT
     *   mylabel.value = Label from TypoScript coming
     * }
     *
     * @param array $conf Array of TypoScript properties
     *
     * @return string The rendered output
     */
    public function render(array $conf, ContentObjectRenderer $cObj): string
    {
        if (!is_array($conf)) {
            $conf = [];
        }

        $template = $this->getTemplate($conf, $cObj);

        return 'This will be a Twig template';
    }

    private function getTemplate(array $conf, ContentObjectRenderer $cObj): string
    {
        if ((!empty($conf['template']) || !empty($conf['template.']))) {
            return isset($conf['template.'])
                ? $cObj->stdWrap(isset($conf['template']) ? $conf['template'] : '', $conf['template.'])
                : $conf['template'];
        }

        return 'layouts/default.html.twig';
    }
}
