<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PagesController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function welcome(Request $request)
    {
        // Execute a query to get the "keyspaces" from Couchbase using Query Builder
        $systemKeyspaces = DB::select('select * from system:keyspaces');

        // Send the result to the view so we can display it.
        return view('welcome', compact('systemKeyspaces'));
    }
}
