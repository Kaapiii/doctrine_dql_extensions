<?php
namespace Concrete\Package\DoctrineDqlExtensions;

/**
 * Package controller
 *
 * @author Markus Liechti <markus@liechti.io>
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
class Controller extends \Concrete\Core\Package\Package
{
    protected $pkgHandle = 'doctrine_dql_extensions';
    protected $appVersionRequired = '5.7.5.6';
    protected $pkgVersion = '0.0.1';

    public function getPackageDescription()
    {
        return t('Package add support for many native MySQL functions. Like: DATE_FORMAT, DATEADD, IFNULL, RAND, FLOOR, MATCH ....');
    }

    public function getPackageName()
    {
        return t('Doctrine DQL extension for MySQL');
    }

    public function install()
    {
        $pkg = parent::install();
    }

    public function on_start(){
        
        \Events::addListener('on_entity_manager_configure', function($event){

            // $event contains the following Objects:
            // - connection (database connection Object), 
            // - configuration (ORM config Object),
            // - eventManager (ORM Event Manager)
            $config = $event->getArgument('configuration');
            // add the match function
            $config->addCustomStringFunction('MATCH_AGAINST','Concrete\Package\DoctrineDqlExtensions\Src\Doctrine\DQL\MySQL\MatchAgainst');

        });

    }
}
