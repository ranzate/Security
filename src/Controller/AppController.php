<?php

namespace Security\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
	public $paginate = [
	'limit' => 5
	];

	// public $layout = 'security';
}
