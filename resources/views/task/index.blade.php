@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{route('task.create')}}" class="btn btn-primary offset-8 col-3">
                <i class="fa fa-plus"></i>
                <span> Task </span>
            </a>
        </div>
    </div>
    <div class="row mt-4">
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
                                @if($task->state==1) @lang("ACTIVE") @else @lang("INACTIVE") @endif
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
            @method('PUT')
            @csrf
            <input type="hidden" id="state" value="1">
        </form>
    </div>
@endsection
@push('js')
    <script>
        function changeSwitch(input, id) {
            if (!input.checked) {
                input.checked=!input.checked;
                return false;
            }
            const frm = document.getElementById('form_task');
            frm.action = frm.action.replace('idTask', id);
            frm.submit();
        }
    </script>
@endpush
