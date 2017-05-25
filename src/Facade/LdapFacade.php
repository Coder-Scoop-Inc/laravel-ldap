<?php

namespace Coderscoop\LaravelLdap\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Description of LdapFacade
 *
 * @author samyoteroglez
 */
class LdapFacade extends Facade 
{
    protected static function getFacadeAccessor() 
    {
        return 'ldap';
    }

}
