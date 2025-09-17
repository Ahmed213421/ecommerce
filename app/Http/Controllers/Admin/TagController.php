<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Http\Requests\Admin\UpdateTagRequest;
use App\Repositories\Admin\Interfaces\TagRepositoryInterface;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['tags'] = $this->tagRepository->getAll();
        return view('dashboard.tags.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        $this->tagRepository->create($request->validated());

        toastr()->success(__('toaster.add'));
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, string $id)
    {
        $this->tagRepository->update($request->validated(), $id);

        toastr()->success(__('toaster.update'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->tagRepository->delete($id);

        toastr()->success(__('toaster.del'));
        return back();
    }
}
