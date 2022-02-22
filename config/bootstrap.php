<?php

use Cake\Core\Configure;

if (file_exists(ROOT . DS . 'config' . DS . 'app_versions.php')) {
    Configure::load('app_versions');
}
