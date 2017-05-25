<?php

namespace Coderscoop\LaravelLdap;

use Illuminate\Support\ServiceProvider;

/**
 * Description of LdapServiceProvider
 *
 * @author samyoteroglez
 */
class LdapServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {        
        $this->setPackageConfigurationFile();
        $this->bindLdap();
    }
    
    /**
     * Bind the package to Laravel
     */
    protected function bindLdap()
    {
        $config = config('ldap');
        
        $this->app->bind('ldap', function() {
            return new Ldap;
        });
    }
    
    /**
     * Set package config file
     */
    protected function setPackageConfigurationFile()
    {
        $config = __DIR__ . '/Config/ldap.php';
        $path = config_path('ldap.php');
        
        $this->publishes([$config => $path], 'config');        
        $this->mergeConfigFrom( $config, 'ldap');
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ldap'];
    }
}
