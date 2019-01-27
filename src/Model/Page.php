<?php
/**
 * Gs4Toolbox - SilverStripe 4 Base Tweaks / SilverStripe 4 Basis Anpassungen
 * @package Gs4Toolbox\Model
 * @author gelysis <andreas@gelysis.net>
 * @copyright ©2019 Andreas Gerhards - All rights reserved
 * @license BSD-3-Clause (http://opensource.org/licenses/BSD-3-Clause)
 */

namespace Gs4Toolbox\Model;

use Gs4Toolbox\Controller\ContentController;
use SilverStripe\CMS\Controllers\ContentController as SiSCmsContentController;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;


class Page extends SiteTree
    implements PageInterface
{
    const SUBTITLE = 'sub_title';
    const IMAGE = 'main_image';
    const META_TITLE = 'meta_title';

    /** @var string self::$table_name */
    private static $table_name = 'gs4_page';
    /** @var string self::$description */
    private static $description = 'Gs4 base page, do not use';
    /** @var array self::$db */
    private static $db = [
        self::SUBTITLE=>'Varchar(255)',
        self::META_TITLE=>'Varchar(255)'
    ];

    /** @var \SilverStripe\CMS\Controllers\ContentController $this->controller */
    protected $controller;


    /**
     * @param \SilverStripe\CMS\Controllers\ContentController $controller
     */
    public function setController(SiSCmsContentController $controller) : Page
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * @return \SilverStripe\CMS\Controllers\ContentController $controller
     */
    public function getController() : SiSCmsContentController
    {
        if ($this->controller === null) {
            $controllerName = $this->getControllerName();
            $controller = new $controllerName();
        }else {
            $controller = $this->controller;
        }

        return $controller;
    }

    /**
     * Extending the controller name finding functionality
     * {@inheritDoc}
     * @see \SilverStripe\CMS\Model\SiteTree::getControllerName()
     */
    public function getControllerName() : string
    {
        $pageName = static::class;
        $controllerName = str_replace('\\Model\\', '\\Controller\\', $pageName).'Controller';

        if (!class_exists($controllerName)) {
            $controllerName = parent::getControllerName();
            if ($controllerName == SiSCmsContentController::class) {
                $controllerName = ContentController::class;
            }
        }

        return $controllerName;
    }

    /**
     * {@inheritDoc}
     * @see \SilverStripe\CMS\Model\SiteTree::Link()
     */
    public function Link(string $action = null) : string
    {
        return rtrim(parent::Link($action), '/');
    }

    /**
     * @return string $subtitle
     */
    public function getSubtitle() : string
    {
        return $this->{self::SUBTITLE};
    }

    /**
     * @return bool $hasSubtitle
     */
    public function hasSubtitle() : bool
    {
        return (strlen($this->getSubtitle()) > 0);
    }

    /**
     * @return Image $image
     */
    public function getImage() : Image
    {
        if (!is_null($this->{self::IMAGE}())) {
            $image = $this->{self::IMAGE}();
        }else{
            $image = new Image();
        }

        return $image;
    }

    /**
     * @return bool $hasImage
     */
    public function hasImage() : bool
    {
        return ($this->getImage()->ID !== 0);
    }

    /**
     * @return string $metaTitle
     */
    public function getMetaTitle() : string
    {
        return $this->{self::META_TITLE};
    }

}
