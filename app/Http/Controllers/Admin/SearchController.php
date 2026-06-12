<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminSearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $adminSearchService;

    public function __construct(AdminSearchService $adminSearchService)
    {
        $this->adminSearchService = $adminSearchService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = $this->adminSearchService->search($request->search);

        return view('dashboard.search.index', [
            'products' => $data['products'],
            'categories' => $data['categories'],
            'subcategories' => $data['subcategories'],
            'posts' => $data['posts'],
            'tags' => $data['tags']
        ])->with('no_results', $data['no_results']);
    }
}
