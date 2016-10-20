<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['post_controller_constructor'][] = array(
                                'class'    => 'Seguridad',
                                'function' => 'Sii',
                                'filename' => 'Seguridad.php',
                                'filepath' => '././hooks'
                                );


$hook['post_controller_constructor'][] = array(
                                'class'    => 'Seguridad',
                                'function' => 'logged',
                                'filename' => 'Seguridad.php',
                                'filepath' => '././hooks'
                                );

$hook['post_controller_constructor'][] = array(
                                'class'    => 'Seguridad',
                                'function' => 'User',
                                'filename' => 'Seguridad.php',
                                'filepath' => '././hooks'
                                );