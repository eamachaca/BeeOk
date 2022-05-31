<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TagController extends Controller
{
    public function tasks($id)
    {
        $eloquent = Tag::with('tasks.tags')->whereHas('tasks',function ($query){
            $query->where('user_id',Auth::id());
        })->find($id)->tasks();
        $tags = $eloquent->get()->pluck('tags')->flatten()->unique('id');
        return view('task.index', ['tasks' => $eloquent->paginate(15), 'tags' => $tags, 'tag_ids' => [$id]]);
    }
    public function tags(Request $request)
    {
        $tasks= Task::with('tags')->where('user_id',Auth::id())->whereHas('tags',function ($query) use ($request){
            $query->whereIn('tags.id',$request->tags);
        });
        $tags = Task::with('tags')->where('user_id',Auth::id())->get()->pluck('tags')->flatten()->unique('id');
        return view('task.index', ['tasks' => $tasks->paginate(15), 'tags' => $tags, 'tag_ids' => $request->tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('tag.create', ['tasks' => Task::where('user_id',Auth::id())->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->all(['title']);
        $tag = Tag::firstOrCreate($validated);
        $tag->tasks()->sync($request->tasks);
        return redirect()->route('task.index');
    }
}
