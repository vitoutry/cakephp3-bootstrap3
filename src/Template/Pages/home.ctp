<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

//$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException('Please replace src/Template/Pages/home.ctp with your own version.');
endif;
?>

<div class="row">
    <div class="col-md-12 jumbotron">
        <?php echo $this->Html->image('http://cakephp.org/img/cake-logo.png') ?>
        <h2><?php echo __('Twitter Bootstrap Theme'); ?></h2>
        <h2><?php echo __('Bootstrap is the most popular HTML, CSS, and JS framework for developing responsive, mobile first projects on the web.'); ?></h2>
        <em>CakePHP 3.x Twitter Bootstrap Theme</em>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-warning">
            <p>Please be aware that this page will not be shown if you turn off debug mode unless you replace src/Template/Pages/home.ctp with your own version.</p>
        </div>
    </div>
</div>
<?php Debugger::checkSecurityKeys(); ?>
<div class="row">
    <div id="url-rewriting-warning" class="col-md-12 hidden">
        <div class="alert alert-warning">
            <p class="alert alert-warning">URL rewriting is not properly configured on your server.</p>
            <p>1) <a target="_blank" href="http://book.cakephp.org/3.0/en/installation.html#url-rewriting">Help me configure it</a></p>
            <p>2) <a target="_blank" href="http://book.cakephp.org/3.0/en/development/configuration.html#general-configuration">I don't / can't use URL rewriting</a></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h4>Environment</h4>
        <?php if (version_compare(PHP_VERSION, '5.5.9', '>=')): ?>
            <p class="alert alert-success"><i class="glyphicon glyphicon-ok"></i> Your version of PHP is 5.5.9 or higher (detected <?php echo phpversion() ?>).</p>
        <?php else: ?>
            <p class="alert alert-warning"><i class="glyphicon glyphicon-remove"></i> Your version of PHP is too low. You need PHP 5.5.9 or higher to use CakePHP (detected <?php echo phpversion() ?>).</p>
        <?php endif; ?>

        <?php if (extension_loaded('mbstring')): ?>
            <p class="alert alert-success"><i class="glyphicon glyphicon-ok"></i> Your version of PHP has the mbstring extension loaded.</p>
        <?php else: ?>
            <p class="alert alert-warning"><i class="glyphicon glyphicon-remove"></i> Your version of PHP does NOT have the mbstring extension loaded.</p>;
        <?php endif; ?>

        <?php if (extension_loaded('openssl')): ?>
            <p class="alert alert-success"><i class="glyphicon glyphicon-ok"></i> Your version of PHP has the openssl extension loaded.</p>
        <?php elseif (extension_loaded('mcrypt')): ?>
            <p class="alert alert-success"><i class="glyphicon glyphicon-ok"></i> Your version of PHP has the mcrypt extension loaded.</p>
        <?php else: ?>
            <p class="alert alert-warning"><i class="glyphicon glyphicon-remove"></i> Your version of PHP does NOT have the openssl or mcrypt extension loaded.</p>
        <?php endif; ?>

        <?php if (extension_loaded('intl')): ?>
            <p class="alert alert-success"><i class="glyphicon glyphicon-ok"></i> Your version of PHP has the intl extension loaded.</p>
        <?php else: ?>
            <p class="alert alert-warning"><i class="glyphicon glyphicon-remove"></i> Your version of PHP does NOT have the intl extension loaded.</p>
        <?php endif; ?>

        <?php if (extension_loaded('mysql')): ?>
            <p class="alert alert-success"><i class="glyphicon glyphicon-ok"></i> Your version of PHP has the mysql extension loaded.</p>
        <?php else: ?>
            <p class="alert alert-warning"><i class="glyphicon glyphicon-remove"></i> Your version of PHP does NOT have the mysql extension loaded.</p>
        <?php endif; ?>
    </div>
    <div class="col-md-6">
        <h4>Filesystem</h4>
        <?php if (is_writable(TMP)): ?>
            <p class="alert alert-success"><i class="glyphicon glyphicon-ok"></i> Your tmp directory is writable.</p>
        <?php else: ?>
            <p class="alert alert-warning"><i class="glyphicon glyphicon-remove"></i> Your tmp directory is NOT writable.</p>
        <?php endif; ?>

        <?php if (is_writable(LOGS)): ?>
            <p class="alert alert-success"><i class="glyphicon glyphicon-ok"></i> Your logs directory is writable.</p>
        <?php else: ?>
            <p class="alert alert-warning"><i class="glyphicon glyphicon-remove"></i> Your logs directory is NOT writable.</p>
        <?php endif; ?>

        <?php $settings = Cache::config('_cake_core_'); ?>
        <?php if (!empty($settings)): ?>
            <p class="alert alert-success"><i class="glyphicon glyphicon-ok"></i> The <em><?php echo $settings['className'] ?>Engine</em> is being used for core caching. To change the config edit config/app.php</p>
        <?php else: ?>
            <p class="alert alert-warning"><i class="glyphicon glyphicon-remove"></i> Your cache is NOT working. Please check the settings in config/app.php</p>
        <?php endif; ?>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-12">
        <h4>Database</h4>
        <?php
            try {
                $connection = ConnectionManager::get('default');
                $connected = $connection->connect();
            } catch (Exception $connectionError) {
                $connected = false;
                $errorMsg = $connectionError->getMessage();
                if (method_exists($connectionError, 'getAttributes')):
                    $attributes = $connectionError->getAttributes();
                    if (isset($errorMsg['message'])):
                        $errorMsg .= '<br />' . $attributes['message'];
                    endif;
                endif;
            }
        ?>
        <?php if ($connected): ?>
            <p class="alert alert-success"><i class="glyphicon glyphicon-ok"></i> CakePHP is able to connect to the database.</p>
        <?php else: ?>
            <p class="alert alert-warning"><i class="glyphicon glyphicon-remove"></i> CakePHP is NOT able to connect to the database.<br /><br /><?php echo $errorMsg ?></p>
        <?php endif; ?>

        <hr>
        <h4>DebugKit</h4>
        <?php if (Plugin::loaded('DebugKit')): ?>
            <p class="alert alert-success"><i class="glyphicon glyphicon-ok"></i> DebugKit is loaded.</p>
        <?php else: ?>
            <p class="alert alert-warning"><i class="glyphicon glyphicon-remove"></i> DebugKit is NOT loaded. You need to either install pdo_sqlite, or define the "debug_kit" connection name.</p>
        <?php endif; ?>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-6">
        <h3>Editing this Page</h3>
        <ul>
            <li>To change the content of this page, edit: src/Template/Pages/home.ctp.</li>
            <li>You can also add some CSS styles for your pages at: webroot/css/.</li>
        </ul>
    </div>
    <div class="col-md-6">
        <h3>Getting Started</h3>
        <ul>
            <li><a target="_blank" href="http://book.cakephp.org/3.0/en/">CakePHP 3.0 Docs</a></li>
            <li><a target="_blank" href="http://book.cakephp.org/3.0/en/tutorials-and-examples/bookmarks/intro.html">The 15 min Bookmarker Tutorial</a></li>
            <li><a target="_blank" href="http://book.cakephp.org/3.0/en/tutorials-and-examples/blog/blog.html">The 15 min Blog Tutorial</a></li>
        </ul>
        <p>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-12">
        <h3 class="">More about Cake</h3>
        <p>
            CakePHP is a rapid development framework for PHP which uses commonly known design patterns like Front Controller and MVC.
        </p>
        <p>
            Our primary goal is to provide a structured framework that enables PHP users at all levels to rapidly develop robust web applications, without any loss to flexibility.
        </p>

        <h3>Help and Bug Reports</h3>
        <ul>
            <li>
                <a href="irc://irc.freenode.net/cakephp">irc.freenode.net #cakephp</a>
                <ul><li>Live chat about CakePHP</li></ul>
            </li>
            <li>
                <a href="https://github.com/cakephp/cakephp/issues">CakePHP Issues</a>
                <ul><li>CakePHP issues and pull requests</li></ul>
            </li>
            <li>
                <a href="https://groups.google.com/group/cake-php">CakePHP Google Group</a>
                <ul><li>Community mailing list</li></ul>
            </li>
        </ul>

        <h3>Docs and Downloads</h3>
        <ul>
            <li>
                <a href="http://api.cakephp.org/3.0/">CakePHP API</a>
                <ul><li>Quick Reference</li></ul>
            </li>
            <li>
                <a href="http://book.cakephp.org/3.0/en/">CakePHP Documentation</a>
                <ul><li>Your Rapid Development Cookbook</li></ul>
            </li>
            <li>
                <a href="http://bakery.cakephp.org">The Bakery</a>
                <ul><li>Everything CakePHP</li></ul>
            </li>
            <li>
                <a href="http://plugins.cakephp.org">CakePHP plugins repo</a>
                <ul><li>A comprehensive list of all CakePHP plugins created by the community</li></ul>
            </li>
            <li>
                <a href="https://github.com/cakephp/">CakePHP Code</a>
                <ul><li>For the Development of CakePHP Git repository, Downloads</li></ul>
            </li>
            <li>
                <a href="https://github.com/FriendsOfCake/awesome-cakephp">CakePHP Awesome List</a>
                <ul><li>A curated list of amazingly awesome CakePHP plugins, resources and shiny things.</li></ul>
            </li>
            <li>
                <a href="http://www.cakephp.org">CakePHP</a>
                <ul><li>The Rapid Development Framework</li></ul>
            </li>
        </ul>

        <h3>Training and Certification</h3>
        <ul>
            <li>
                <a href="http://cakefoundation.org/">Cake Software Foundation</a>
                <ul><li>Promoting development related to CakePHP</li></ul>
            </li>
            <li>
                <a href="http://training.cakephp.org/">CakePHP Training</a>
                <ul><li>Learn to use the CakePHP framework</li></ul>
            </li>
            <li>
                <a href="http://certification.cakephp.org/">CakePHP Certification</a>
                <ul><li>Become a certified CakePHP developer</li></ul>
            </li>
        </ul>
    </div>
</div>