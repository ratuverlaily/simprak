<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     => CSRF::class,
		'toolbar'  => DebugToolbar::class,
		'honeypot' => Honeypot::class,
		'authfilter' => \App\Filters\Authfilter::class,
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			'authfilter' => ['except' => [
				'auth', 'auth/*',
				'apilogin', 'apilogin/*',
				'apiposttest', 'apiposttest/*',
				'apipretest', 'apipretest/*',
				'apiexperiment', 'apiexperiment/*',
				'apigames', 'apigames/*',
				'apigamefinish', 'apigamefinish/*',
			]],
		],
		'after'  => [
			'authfilter' => ['except' => [
				'home', 'home/*',
				'users', 'users/*',
				'kelas', 'kelas/*',
				'sekolah', 'sekolah/*',
				'identitas', 'identitas/*',
				'praktikum', 'praktikum/*',
				'modul', 'modul/*',
				//'resefulapiweb', 'resefulapiweb/*',
			]],
			'toolbar',
			'csrf',
			// 'honeypot',
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [];
}
