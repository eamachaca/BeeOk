@extends('layouts.app')
@push('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@section('content')
    <div class="row">
        <form id="form_task" action="{{route('task.store')}}" method="POST">
            <div class="m-4">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                       placeholder="@lang('Insert your Task Title')">
            </div>
            <div class="m-4">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"
                          placeholder="@lang('Insert your Task Description')"></textarea>
            </div>
            @csrf
            <div class="m-4">
                <label for="tag" class="form-label">Tags</label>
                <select class="form-select" id="tag" name="tags[]" required multiple>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}"
                                @if(!empty($tag_ids)&&in_array($tag->id,$tag_ids)) selected @endif>{{$tag->title}}</option>
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
        $('#tag').select2({'placeholder': '@lang('Select minimum a tag')'});
    </script>
@endpush
