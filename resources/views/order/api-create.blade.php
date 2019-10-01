@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">GF API Order</div>
                <div class="card-body">
                    <order-form></order-form>
                </div>
            </div>
        </div>
    </div>
@endsection
