<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibraryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\LibraryService;

class LibraryController extends Controller
{
    protected $libraryService;

    public function __construct(LibraryService $libraryService)
    {
        $this->libraryService = $libraryService;
    }

    public function index()
    {
        $libraries = $this->libraryService->all();

        return view('libraries.index', compact('libraries'));
    }

    public function create()
    {
        return view('libraries.create');
    }

    public function store(LibraryRequest $request)
    {
       // $data = $request->only(['name', 'description', 'url']);
        $data = [
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'url' => $request->url,
            'library_id' => $request->library_id
        ];
        $this->libraryService->create($data);

        if ($this->libraryService->create($data)) {
            Session::flash('success', 'Library was created successfully.');
            return redirect()->route('libraries');
        }

        Session::flash('error', 'Unable to create library.');
        return redirect()->route('libraries');
    }

    public function destroy($id)
    {
        if ($this->libraryService->delete($id)) {
            Session::flash('success', 'Library was deleted successfully.');
        } else {
            Session::flash('error', 'Unable to delete library.');
        }

        return redirect()->back();
    }
}
