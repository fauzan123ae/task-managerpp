<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kategoriController extends Controller
{
    public function index()
    {$taskCounts = DB::table('tasks')
                    ->rightJoin('categories', 'tasks.category_id', '=', 'categories.id')
                    ->select('categories.name', DB::raw('COUNT(tasks.id) as task_count'))
                    ->groupBy('categories.name')
                    ->get();
    return print_r($taskCounts);
    }  //
}
