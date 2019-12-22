@extends('layouts.app')
@section('title', 'Результаты')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card none-border none-bg">
                <div class="card-body">
                    <chart fetch-address="/api/results"></chart>
                </div>
            </div>
        </div>
    </div>
@endsection
