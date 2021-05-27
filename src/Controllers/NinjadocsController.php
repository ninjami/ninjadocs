<?php

namespace Ninjami\Ninjadocs;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Ninjami\Ninjadocs\Ninjadocs;

class NinjadocsController extends BaseController
{

	/**
	 * Display a listing of the resource
	 */
	public function show($fileName)
	{
		// Get file content
		$content = new Ninjadocs($fileName);

		return View::make('ninjadocs::document', [
			'content' => $content,
			'title' => ucfirst($fileName)
		]);
	}
}
