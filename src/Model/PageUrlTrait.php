<?php
/**
 * Gs4Toolbox - SilverStripe 4 Base Tweaks / SilverStripe 4 Basis Anpassungen
 * @package Gs4Toolbox\Model
 * @author gelysis <andreas@gelysis.net>
 * @copyright ©2019 Andreas Gerhards - All rights reserved
 * @license BSD-3-Clause (http://opensource.org/licenses/BSD-3-Clause)
 */

namespace Gs4Toolbox\Model;


trait PageUrlTrait
{

    /**
     * {@inheritDoc}
     * @see \SilverStripe\CMS\Model\SiteTree::Link()
     */
    public function Link(string $action = null) : string
    {
        $link = rtrim(parent::Link($action), '/');
        return rtrim(parent::Link($action), '/');
    }


}
