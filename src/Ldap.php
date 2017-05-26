<?php

namespace Coderscoop\LaravelLdap;

use Exception;

/**
 * Description of Ldap
 *
 * @author samyoteroglez
 */
class Ldap 
{
    /**
     * Common Name
     * 
     * @var string 
     */
    protected $cn;
    
    /**
     * Domain Component
     * 
     * @var string
     */
    protected $dc;
    
    /**
     * Organizational Unit
     * 
     * @var string 
     */
    protected $ou;
    
    /**
     * User id
     * 
     * @var string 
     */
    protected $uid;
    
    /**
     * Password
     * 
     * @var string 
     */
    protected $pass;
    
    /**
     * Host
     * 
     * @var int 
     */
    protected $host;
    
    /**
     * Port
     * 
     * @var int 
     */
    protected $port;
    
    /**
     * Connection string
     * 
     * @var string 
     */
    protected $dn;

    /**
     * Connection
     * 
     * @var connection object 
     */
    protected $connection;
    
    /**
     * Class constructor
     */
    public function __construct() 
    {
        ;
    }
    
    /**
     * New instance.
     * 
     * @return Ldap
     */
    public static function newInstance()
    {
        return new Ldap;
    }
    
    /**
     * Set connection string
     * 
     * @param string $dn
     * @return Ldap
     */
    public function setDn($dn)
    {
        $this->dn = $dn;
        
        return $this;
    }
    
    /**
     * Get connection string
     * 
     * @return string
     */
    public function getDn()
    {
        return $this->dn;
    }
    
    /**
     * Set common name
     * 
     * @param string $cn
     * @return Ldap
     */
    public function setCn($cn)
    {
        $this->cn = $cn;
        
        return $this;
    }
    
    /**
     * Get common name
     * 
     * @return string
     */
    public function getCn()
    {
        return $this->cn;
    }

    /**
     * Set domain component
     * 
     * @param string $dc
     * @return Ldap
     */
    public function setDc($dc)
    {
        $this->dc = $dc;
        
        return $this;
    }
    
    /**
     * Get domain component
     * 
     * @return string
     */
    public function getDc()
    {
        return $this->dc;
    }
    
    /**
     * Set organizational unit
     * 
     * @param string $ou
     * @return Ldap
     */
    public function setOu($ou)
    {
        $this->ou = $ou;
        
        return $this;
    }
    
    /**
     * Get organizational unit
     * 
     * @return string
     */
    public function getOu()
    {
        return $this->ou;
    }
    
    /**
     * Set user id
     * 
     * @param string $uid
     * @return Ldap
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        
        return $this;
    }
    
    /**
     * Get user id
     * 
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }
    
    /**
     * Set password
     * 
     * @param string $pass
     * @return Ldap
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
        
        return $this;
    }
    
    /**
     * Get password
     * 
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }
    
    /**
     * Set host
     * 
     * @param int $host
     * @return Ldap
     */
    public function setHost($host)
    {
        $this->host = $host;
        
        return $this;
    }
    
    /**
     * Get host
     * 
     * @return int
     */
    public function getHost()
    {
        return $this->host;
    }
    
    /**
     * Set port
     * 
     * @param int $port
     * @return Ldap
     */
    public function setPort($port)
    {
        $this->port = $port;
        
        return $this;
    }
    
    /**
     * Get port
     * 
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }
    
    /**
     * Set the connnection string "dn" based on the common name "cn"
     * 
     * @return Ldap
     */
    public function setDnForCn() 
    {
        return $this->setDn($this->cn . ',' . $this->dc);
    }

    /**
     * Set the connnection string "dn" based on the user id "iud"
     * 
     * @return Ldap
     */
    public function setDnForUidc() 
    {
        return $this->setDn($this->uid . ',' . $this->dc);
    }

    /**
     * Set standar configuration
     * 
     * @param string $cn
     * @param string $dc
     * @param string $uid
     * @param string $pass
     * @param string $host
     * @param string $port
     * @return Ldap
     */
    public function config($cn, $dc, $uid, $pass, $host, $port) 
    {
        $this->setCn($cn)
            ->setDc($dc)
            ->setUid($uid)
            ->setPass($pass)
            ->setHost($host)
            ->setPort($port);

        return $this;
    }

    /**
     * Stablish the connection
     * 
     * @return Ldap
     */
    public function connect()
     {
        $this->connection = ldap_connect($this->host, $this->port);
        ldap_set_option($this->connection, LDAP_OPT_PROTOCOL_VERSION, 3);
        
        return $this;
    }

    /**
     * Stablish connection using the user id
     */
    public function connectBindUsingUid() 
    {
        $this->setDnForUidc()->connect()->bind();
    }

    /**
     * Stablish connection using the common name
     */
    public function connectBindUsingCn() 
    {
        $this->setDnForCn()->connect()->bind();
    }

    /**
     * Close the connection
     * 
     * @return \Pulseinfoframe\Ldap\PulseLdapController
     */
    public function close() 
    {
        ldap_close($this->connection);

        return $this;
    }

    /**
     * Bind to ldap directory
     * 
     * @throws Exception
     */
    public function bind()
    {
        if (!$this->ldapBind()) {
            throw new Exception('Error stablishing the connection.');
        }
    }
    
    /**
     * Bind the connection
     * 
     * @return boolean
     */
    protected function ldapBind()
    {
        if (!@ldap_bind($this->connection, $this->dn, $this->pass)) {
            return false;
        }
        else {
            return true;
        }
    }
    
    /**
     * Check if a given user and password
     * 
     * @param string $user
     * @param string $password
     */
    public function checkUserPassword($user = null, $password = null)
    {
        $this->uid = ($user) ? "uid=" . $user : $this->uid;
        $this->pass = ($password) ? $password : $this->pass;
        
        return $this->setDnForUidc()->connect()->ldapBind();
    }
    
    /**
     * Search ldap tree and return the findings
     * 
     * @param string $searchDn
     * @param string $filter
     * @param array $attributes
     * @return result
     */
    public function search($searchDn, $filter, $attributes = [])
    {
        $result = ldap_search($this->connection, $searchDn, $filter, $attributes);
        $entries = ldap_get_entries($this->connection, $result);
        
        return $entries;
    }
}
