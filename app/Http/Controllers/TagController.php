<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function tasks($id){

        return view('task.index',['tasks'=>Tag::with('tasks.tags')->find($id)->tasks()->paginate(15)]);
    }
}
