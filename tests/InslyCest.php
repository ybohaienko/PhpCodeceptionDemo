<?php

use Codeception\Example;
use Page\Acceptance\GoogleSearchPage;
use Page\Acceptance\SearchResultPage;
use Step\Acceptance\SearchStep;

class InslyCest
{
    /** @var string $textToSearch */
    public $textToSearch = "insly.com";

    public function _before(AcceptanceTester $I, GoogleSearchPage $googleSearchPage)
    {
        $I->amOnPage($googleSearchPage::route("/"));
    }

    /**
     * @param SearchStep $I
     * @param GoogleSearchPage $googleSearchPage
     * @param SearchResultPage $searchResultPage
     */
    protected function searchViaGoogle(
        SearchStep $I,
        GoogleSearchPage $googleSearchPage,
        SearchResultPage $searchResultPage
    )
    {
        $I->googleSearchByText($googleSearchPage, $searchResultPage, $this->textToSearch);
    }

    /**
     * @group main
     *
     * @before searchViaGoogle
     *
     * @dataProvider inslyDataProvider
     *
     * @param AcceptanceTester $I
     * @param Example $data
     * @param SearchResultPage $searchResultPage
     */
    public function whenGoogleSearchThenPass(AcceptanceTester $I, Example $data, SearchResultPage $searchResultPage)
    {
        /** @var array $urls */
        $urls = $I->grabAttributeFrom($searchResultPage->lnkUrl, "href");

        $I->assertContains($data["needleUrl"], $urls, "Search result doesn't contain the needle URL");
    }

    /**
     * @group main
     *
     * @before searchViaGoogle
     *
     * @dataProvider inslyDataProvider
     *
     * @param AcceptanceTester $I
     * @param Example $data
     * @param SearchResultPage $searchResultPage
     */
    public function whenClickLinkThenPass(AcceptanceTester $I, Example $data, SearchResultPage $searchResultPage)
    {
        /** @var string $locator */
        $locator = $searchResultPage->getLinkLocatorByUrl($data["needleUrl"]);

        $I->click($locator);
        $I->seeInTitle($data["needleTitle"]);
    }

    protected function inslyDataProvider()
    {
        return [
            ["needleUrl" => "https://insly.com/en/", "needleTitle" => "Insly - Simple Insurance Software for Brokers and MGAs"]
        ];
    }

    public function _passed(AcceptanceTester $I)
    {
        $I->comment("TEST PASSED");
    }

    public function _failed(AcceptanceTester $I)
    {
        $I->comment("TEST FAILED");
    }
}