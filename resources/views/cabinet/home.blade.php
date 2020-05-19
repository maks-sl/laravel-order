@extends('layouts.app')

@section('content')
    @include ('cabinet._nav', ['page' => ''])
    <div class="card">
        <div class="card-header">Cabinet</div>

        <div class="card-body">
            Welcome to your cabinet!
        </div>
    </div>
@endsection
