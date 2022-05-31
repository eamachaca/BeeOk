@extends('layouts.app')
@push('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@section('content')
    <div class="row">
        <form id="form_task" action="{{route('tag.store')}}" method="POST">
            @csrf
            <div class="m-4">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                       placeholder="@lang('Insert your Tag Title')">
            </div>
            <div class="m-4">
                <label for="tasks" class="form-label">Tasks</label>
                <select class="form-select" id="tasks" name="tasks[]" required multiple>
                    @foreach($tasks as $task)
                        <option value="{{$task->id}}">{{$task->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="offset-3 col-5 row">
                <button type="submit" class="btn btn-primary col-12">
                    <i class='fa fa-plus'></i>
                    <span> Agregar </span>
                </button>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#tasks').select2({'placeholder': '@lang('Select minimum a task')'});
    </script>
@endpush
