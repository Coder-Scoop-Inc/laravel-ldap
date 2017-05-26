# ldap

Feature: Laravel ldap package
    In order to connect with a server using ldap
    As a user
    I want to use the laravel-ldap api

    Scenario: Common name
        Given I have an instance of Ldap class
        When I set the cn attribute
        Then The cn getter should return the same value

    Scenario: Domain component
        Given I have an instance of Ldap class
        When I set the dc attribute
        Then The dc getter should return the same value

   Scenario: Organizational unit
        Given I have an instance of Ldap class
        When I set the ou attribute
        Then The ou getter should return the same value

   Scenario: User id
        Given I have an instance of Ldap class
        When I set the uid attribute
        Then The uid getter should return the same value

   Scenario: Password
        Given I have an instance of Ldap class
        When I set the pass attribute
        Then The pass getter should return the same value

   Scenario: Host
        Given I have an instance of Ldap class
        When I set the host attribute
        Then The host getter should return the same value

   Scenario: Port
        Given I have an instance of Ldap class
        When I set the port attribute
        Then The port getter should return the same value

   Scenario: Set connection string based on the user id
        Given I have an instance of Ldap class
        When I set the dn attribute based on the uid
        Then The dn getter should return the same value uid and dc

   Scenario: Set connection string based on the common name
        Given I have an instance of Ldap class
        When I set the dn attribute based on the cn
        Then The dn getter should return the same value cn and dc

   Scenario: Connection to the ldap server using common name
        Given I have an instance of Ldap class
        When I set the correct configuration for cn
        Then I should be connected using cn

   Scenario: Connection to the ldap server using user id
        Given I have an instance of Ldap class
        When I set the correct configuration for uid
        Then I should be connected using uid

   Scenario: Check if user and password exist
        Given I have an instance of Ldap class
        When I stablish connection to check for an existing user and password 
        Then The user and password should match

   Scenario: Check if user and password do not exist
        Given I have an instance of Ldap class
        When I stablish connection to check for an existing user and password 
        Then The user and password should not match
