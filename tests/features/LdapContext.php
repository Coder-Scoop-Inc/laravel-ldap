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
     * @Given I have an instance of Ldap class
     */
    public function iHaveAnInstanceOfLdapClass() 
    {
        PHPUnit::assertInstanceOf(Ldap::class, $this->ldap);
    }

    /**
     * @When I set the cn attribute
     */
    public function iSetTheCnAttribute() 
    {
        $this->ldap->setCn("cn=read-only-admin");
    }

    /**
     * @Then The cn getter should return the same value
     */
    public function theCnGetterShouldReturnTheSameValue() 
    {
        PHPUnit::assertEquals("cn=read-only-admin", $this->ldap->getCn());
    }
    
    /**
     * @When I set the dc attribute
     */
    public function iSetTheDcAttribute() 
    {
        $this->ldap->setDc("dc=example,dc=com");
    }

    /**
     * @Then The dc getter should return the same value
     */
    public function theDcGetterShouldReturnTheSameValue() 
    {
        PHPUnit::assertEquals("dc=example,dc=com", $this->ldap->getDc());
    }
    
    /**
     * @When I set the ou attribute
     */
    public function iSetTheOuAttribute() 
    {
        $this->ldap->setOu("ou=scientists");
    }

    /**
     * @Then The ou getter should return the same value
     */
    public function theOuGetterShouldReturnTheSameValue() 
    {
        PHPUnit::assertEquals("ou=scientists", $this->ldap->getOu());
    }
    
    /**
     * @When I set the uid attribute
     */
    public function iSetTheUidAttribute() 
    {
        $this->ldap->setUid("uid=newton");
    }

    /**
     * @Then The uid getter should return the same value
     */
    public function theUidGetterShouldReturnTheSameValue() 
    {
        PHPUnit::assertEquals("uid=newton", $this->ldap->getUid());
    }
    
    /**
     * @When I set the pass attribute
     */
    public function iSetThePassAttribute() 
    {
        $this->ldap->setPass("password");
    }

    /**
     * @Then The pass getter should return the same value
     */
    public function thePassGetterShouldReturnTheSameValue() 
    {
        PHPUnit::assertEquals("password", $this->ldap->getPass());
    }
    
    /**
     * @When I set the host attribute
     */
    public function iSetTheHostAttribute() 
    {
        $this->ldap->setHost("ldap.forumsys.com");
    }

    /**
     * @Then The host getter should return the same value
     */
    public function theHostGetterShouldReturnTheSameValue() 
    {
        PHPUnit::assertEquals("ldap.forumsys.com", $this->ldap->getHost());
    }
    
    /**
     * @When I set the port attribute
     */
    public function iSetThePortAttribute() 
    {
        $this->ldap->setPort(389);
    }

    /**
     * @Then The port getter should return the same value
     */
    public function thePortGetterShouldReturnTheSameValue() 
    {
        PHPUnit::assertEquals(389, $this->ldap->getPort());
    }
    
    /**
     * @When I set the dn attribute based on the uid
     */
    public function iSetTheDnAttributeBasedOnTheUid() 
    {
        $this->ldap->setUid("uid=newton")
            ->setDc("dc=example,dc=com")
            ->setDnForUidc();
    }
    
    /**
     * @Then The dn getter should return the same value uid and dc
     */
    public function theDnGetterShouldReturnTheSameValueUidAndDc() 
    {
        $dn = $this->ldap->getUid() . ',' . $this->ldap->getDc();
        PHPUnit::assertEquals($dn, $this->ldap->getDn());
    }
    
    /**
     * @When I set the dn attribute based on the cn
     */
    public function iSetTheDnAttributeBasedOnTheCn() 
    {
        $this->ldap->setCn("cn=read-only-admin")
            ->setDc("dc=example,dc=com")
            ->setDnForCn();
    }

    /**
     * @Then The dn getter should return the same value cn and dc
     */
    public function theDnGetterShouldReturnTheSameValueCnAndDc() 
    {
        $dn = $this->ldap->getCn() . ',' . $this->ldap->getDc();
        PHPUnit::assertEquals($dn, $this->ldap->getDn());
    }
    
    /**
     * @When I set the correct configuration for cn
     */
    public function iSetTheCorrectConfigurationForCn() 
    {
        $this->ldap
            ->config("cn=read-only-admin", "dc=example,dc=com", "uid=newton", "password", "ldap.forumsys.com", 389);
    }

    /**
     * @Then I should be connected using cn
     */
    public function iShouldBeConnectedUsingCn() 
    {
        $this->ldap->connectBindUsingCn();
        $this->ldap->close();
    }
    
    /**
     * @When I set the correct configuration for uid
     */
    public function iSetTheCorrectConfigurationForUid() 
    {
        $this->ldap
            ->config("cn=read-only-admin", "dc=example,dc=com", "uid=newton", "password", "ldap.forumsys.com", 389);
    }

    /**
     * @Then I should be connected using uid
     */
    public function iShouldBeConnectedUsingUid() 
    {
        $this->ldap->connectBindUsingUid();
        $this->ldap->close();
    }
    
    /**
     * @When I stablish connection to check for an existing user and password
     */
    public function iStablishConnectionToCheckForAnExistingUserAndPassword() 
    {
        $this->ldap
            ->config("cn=read-only-admin", "dc=example,dc=com", "uid=newton", "password", "ldap.forumsys.com", 389);
    }

    /**
     * @Then The user and password should match
     */
    public function theUserAndPasswordShouldMatch() 
    {
        PHPUnit::assertTrue($this->ldap->checkUserPassword("newton", "password"));
        $this->ldap->close();
    }
    
    /**
     * @Then The user and password should not match
     */
    public function theUserAndPasswordShouldNotMatch() 
    {
        PHPUnit::assertFalse($this->ldap->checkUserPassword("wronguser", "wrongpassword"));
        $this->ldap->close();
    }

}
