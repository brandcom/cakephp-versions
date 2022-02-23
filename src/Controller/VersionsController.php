<?php

namespace Versions\Controller;

use Cake\Core\Configure;

class VersionsController extends AppController
{
    public function index()
    {
        $token = Configure::read('Versions.token');
        if ($this->getRequest()->getQuery('token') != $token) {
            throw new \Cake\Http\Exception\NotFoundException();
        }

        $composer = file_get_contents(ROOT . '/composer.lock');
        $composer = json_decode($composer, true);
        foreach ($composer['packages'] as $package) {
            if ($package['name'] == 'cakephp/cakephp') {
                $version = $package['version'];
                break;
            }
        }

        $versions = [
            'php' => PHP_VERSION,
            'cms' => 'CakePHP',
            'cms_version' => $version,
        ];

        echo json_encode($versions);
        exit;
    }
}
