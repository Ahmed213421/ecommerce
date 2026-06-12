<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Http\Requests\Admin\UpdateTagRequest;
use App\Services\Admin\AdminTagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $adminTagService;

    public function __construct(AdminTagService $adminTagService)
    {
        $this->adminTagService = $adminTagService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['tags'] = $this->adminTagService->getAllTags();
        return view('dashboard.tags.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        $this->adminTagService->createTag($request->validated());

        toastr()->success(__('toaster.add'));
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, string $id)
    {
        $this->adminTagService->updateTag($id, $request->validated());

        toastr()->success(__('toaster.update'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->adminTagService->deleteTag($id);

        toastr()->success(__('toaster.del'));
        return back();
    }
}
