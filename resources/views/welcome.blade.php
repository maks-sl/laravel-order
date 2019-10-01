@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-3 mt-5">
            <a href="{{ route('order.create') }}"><button class="btn btn-primary">Make Order</button></a>
            <a href="{{ route('api-order.create') }}"><button class="btn btn-primary">Make API Order</button></a>
        </div>
    </div>
@endsection
