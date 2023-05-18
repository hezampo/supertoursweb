<?php
session_start();
include './protected/config/common.conf.php';
include './protected/config/routes.conf.php';
include './protected/config/db.conf.php';
include './protected/config/acl.conf.php';

#Just include this for production mode
//include $config['BASE_PATH'].'deployment/deploy.php';
include $config['BASE_PATH'].'Doo.php';
include $config['BASE_PATH'].'app/DooConfig.php';

# Uncomment for auto loading the framework classes.
//spl_autoload_register('Doo::autoload');
Doo::acl()->rules = $acl;

# The default route to be reroute to when resource is denied. If not set, 404 error will be displayed.
Doo::acl()->defaultFailedRoute = 'access';
# Check if allowed.




Doo::conf()->set($config);

# remove this if you wish to see the normal PHP error view.
//include $config['BASE_PATH'].'diagnostic/debug.php';
Doo::db()->setMap($dbmap);
Doo::db()->setDb($dbconfig,  $config['APP_MODE']);
Doo::db()->sql_tracking = true;

Doo::app()->route = $route;

Doo::app()->run();

?>