<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        // Load your objects
        $defaultBranch = Branch::where('default', 1)->first();

        // Make it available to all views by sharing it for the master header
        view()->share('defaultBranch', $defaultBranch);
    }
}
