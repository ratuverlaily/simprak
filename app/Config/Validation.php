<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $login_user = [
		'email' => [
			'rules' => 'required|valid_email',
		],
		'password' => [
			'rules' => 'required|min_length[10]',
		],
		'kode_praktikum' => [
			'rules' => 'required',
		],
	];

	public $pos_test = [
		'id_user' => [
			'rules' => 'required',
		],
		'id_praktikum' => [
			'rules' => 'required',
		],
		'post_status' => [
			'rules' => 'required',
		],
		'post_fault_counter' => [
			'rules' => 'required',
		],
		'post_waktu_pengerjaan' => [
			'rules' => 'required',
		],

	];

	public $pre_test = [
		'id_user' => [
			'rules' => 'required',
		],
		'id_praktikum' => [
			'rules' => 'required',
		],
		'pre_status' => [
			'rules' => 'required',
		],
		'pre_waktu_games' => [
			'rules' => 'required',
		],
		'pre_fault_counter' => [
			'rules' => 'required',
		],

	];

	public $experiment = [
		'id_user' => [
			'rules' => 'required',
		],
		'id_praktikum' => [
			'rules' => 'required',
		],
		'expe_waktu_pengerjaan' => [
			'rules' => 'required',
		],
		'expe_status' => [
			'rules' => 'required',
		],

	];

	public $statusgames = [
		'id_user' => [
			'rules' => 'required',
		],
		'id_praktikum' => [
			'rules' => 'required',
		],
		'kode_kelas' => [
			'rules' => 'required',
		],

	];

	public $valgames = [
		'token' => [
			'rules' => 'required',
		],
		'id_user' => [
			'rules' => 'required',
		],
		'id_praktikum' => [
			'rules' => 'required',
		],
		'pre_status' => [
			'rules' => 'required',
		],
		'pre_waktu_games' => [
			'rules' => 'required',
		],
		'pre_fault_counter' => [
			'rules' => 'required',
		],
		'post_status' => [
			'rules' => 'required',
		],
		'post_fault_counter' => [
			'rules' => 'required',
		],
		'post_waktu_pengerjaan' => [
			'rules' => 'required',
		],
		'expe_waktu_pengerjaan' => [
			'rules' => 'required',
		],
		'expe_status' => [
			'rules' => 'required',
		],
	];
}
