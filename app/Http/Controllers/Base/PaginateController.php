<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaginateController extends Controller
{
    public function getPage(Request $request)
    {
        $page = $request->get('page');

        if (!isset($page)) {
            $page = '1';
        }

        return $page;
    }
}
