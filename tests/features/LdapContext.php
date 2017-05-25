<?php

use Behat\Behat\Context\Context;
use Coderscoop\LaravelLdap\Ldap;
use PHPUnit_Framework_TestCase as PHPUnit;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;

/**
 * Defines application features from the specific context.
 */
class LdapContext implements Context, SnippetAcceptingContext
{
    /**
     * Store the Ldap object
     * 
     * @var Ldap object 
     */
    protected $ldap;
    
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->ldap = Ldap::newInstance();
    }
    
    /**
     * @Given I have an instance of ldap
     */
    public function iHaveAnInstanceOfLdap()
    {
        PHPUnit::assertInstanceOf(Ldap::class, $this->ldap);
    }

    /**
     * @Then I should be able to call the dummy function
     */
    public function iShouldBeAbleToCallTheDummyFunction()
    {
        PHPUnit::assertEquals('dummy', $this->ldap->dummy());
    }

}
