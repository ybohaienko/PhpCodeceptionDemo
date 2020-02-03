<?php

namespace Page\Acceptance;

use phpDocumentor\Reflection\DocBlock\Tags\Factory\Strategy;

class SearchResultPage
{
    // include url of current page
    public static $URL = '';

    public $lnkUrl = '//*[@class="rc"]/div/a';
    public $anchor = '//*[@id="pnnext"]';

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL . $param;
    }

    /**
     * @var \AcceptanceTester;
     */
    protected $acceptanceTester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
    }

    public function getLinkLocatorByUrl(string $url): string
    {
        return "//*[contains(@href,'" . $url . "')]/..";
    }
}
