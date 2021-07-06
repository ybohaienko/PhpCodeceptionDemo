<?php
namespace Page\Acceptance;

class GoogleSearchPage
{
    // include url of current page
    public static $URL = 'www.google.com';

    public $nptSearch = '//input[@name="q"]';
    public $btnSearch = '(//input[@name="btnK"])[last()]';

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }

    /**
     * @var \AcceptanceTester;
     */
    protected $acceptanceTester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
    }

}
