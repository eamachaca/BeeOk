@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-primary offset-8 col-3">
                <i class="fa fa-plus"></i>
                <span> Task </span>
            </button>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Card title</h4>
                </div>
                <div class="card-body">
                    <span class="badge bg-primary">Primary</span>
                    <p class="card-text">Some example text. Some example text.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
