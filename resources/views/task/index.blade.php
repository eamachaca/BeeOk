@extends('layouts.app')
@push('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{route('tag.create')}}" class="btn btn-primary offset-1 col-3">
                <i class="fa fa-plus"></i>
                <span> Tag </span>
            </a>
            <a href="{{route('task.create')}}" class="btn btn-primary offset-4 col-3">
                <i class="fa fa-plus"></i>
                <span> Task </span>
            </a>
        </div>
    </div>
    <form action="{{route('tag.tags')}}" method="POST">
        @csrf
        <div class="row m-4">
            <div class="col-8 row">
                <select class="col-12" id="tag" name="tags[]" required multiple>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}"
                                @if(!empty($tag_ids)&&in_array($tag->id,$tag_ids)) selected @endif>{{$tag->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-4 row">
                <button type="submit" class="btn btn-primary col-12">
                    <i class='fa fa-search'></i>
                    <span> Filtrar </span>
                </button>
            </div>
        </div>
    </form>
    <div class="row">
        @forelse ($tasks as $task)
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{$task->title}}</h4>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                   @if($task->state==1) checked
                                   @endif onchange=" return changeSwitch(this,{{$task->id}})">
                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                @if($task->state==1)
                                    @lang("ACTIVE")
                                @else
                                    @lang("INACTIVE")
                                @endif
                            </label>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($task->tags as $tag)
                            <a href="{{route('tag.tasks',$tag->id)}}"><span
                                    class="badge bg-primary">{{$tag->title}}</span></a>
                        @endforeach
                        <p class="card-text">{{$task->description}}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <span>@lang("You don't have task created, please create one to see your tasks")</span>
            </div>
        @endforelse
        @if($tasks->isNotEmpty())
            <div class=" mt-5 offset-3 col-6">
                {{ $tasks->onEachSide(1)->links() }}
            </div>
        @endif
        <form id="form_task" action="{{route('task.update','idTask')}}" method="POST" hidden>
            @csrf
            @method('PUT')
            <input type="hidden" id="state" value="1">
        </form>
    </div>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#tag').select2({'placeholder': '@lang('Select minimum a tag')'});

        function changeSwitch(input, id) {
            if (!input.checked) {
                input.checked = !input.checked;
                return false;
            }
            const frm = document.getElementById('form_task');
            frm.action = frm.action.replace('idTask', id);
            frm.submit();
        }
    </script>
@endpush
