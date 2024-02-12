<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SortController extends Controller
{
    public function getSort(Request $request)
    {
        $sort = $request->get('sort');

        if (!in_array($sort, ['id', 'title', 'user_id', 'post_id'])) {
            $sort = 'id';
        }

        return $sort;
    }

    public function getOrder(Request $request)
    {
        $order = $request->get('order');

        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'asc';
        }

        return $order;
    }
}
