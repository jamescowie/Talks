<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawMinkContext implements Context, SnippetAcceptingContext
{
    /**
     * @Given I am logged into the admin as :username with :password
     */
    public function iAmLoggedIntoTheAdminAsWith($username, $password)
    {
        $this->visitPath('/admin');
        $this->getSession()->getPage()->fillField('username', $username);
        $this->getSession()->getPage()->fillField('password', $password);
        $this->getSession()->getPage()->find('css', '.submit')->click();
    }

    /**
     * @Given I enabled social-share for :product
     */
    public function iEnabledSocialShareFor($product)
    {
        $this->getSession()->getPage()->find('xpath', '//*[@id="top-nav"]/div/div[2]/div/button')->click();
    }
    
    /**
     * @Then I should see a success message
     */
    public function iShouldSeeASuccessMessage()
    {
        $message = $this->getSession()->getPage()->find('success-message');
        expect($message->getHtml())->notToBe();
    }

    /**
     * @Given :arg1 is enabled for social-share
     */
    public function isEnabledForSocialShare($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I visit the product details page
     */
    public function iVisitTheProductDetailsPage()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see that I can share the product via twitter
     */
    public function iShouldSeeThatICanShareTheProductViaTwitter()
    {
        throw new PendingException();
    }
}
