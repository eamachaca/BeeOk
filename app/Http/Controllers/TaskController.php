<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $eloquent = Task::with('tags')->where('user_id', Auth::id());
        $tags = $eloquent->get()->pluck('tags')->flatten()->unique('id');//Tag whereHas Task.user_id ==Auth::user()->id
        return view('task.index', ['tasks' => $eloquent->paginate(15), 'tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('task.create', ['tags' => Tag::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreTaskRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $task = Task::create($validated);
        $task->tags()->sync($request->tags);
        return redirect()->route('task.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTaskRequest $request
     * @param Task $task
     * @return RedirectResponse
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->state = 1;
        $task->save();
        return redirect()->route('task.index');
    }
}
