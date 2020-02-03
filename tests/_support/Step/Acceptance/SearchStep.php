<?php

namespace Step\Acceptance;

use Page\Acceptance\GoogleSearchPage;
use Page\Acceptance\SearchResultPage;

class SearchStep extends \AcceptanceTester
{
    public function googleSearchByText(
        GoogleSearchPage $googleSearchPage,
        SearchResultPage $searchResultPage,
        string $textToSearch
    )
    {
        $I = $this;
        $I->fillField($googleSearchPage->nptSearch, $textToSearch);
        $I->click($googleSearchPage->btnSearch);
        $I->waitForElement($searchResultPage->anchor);
    }
}