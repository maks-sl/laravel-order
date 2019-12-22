@extends('layouts.app')
@section('title', 'Голосование')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            @if ($poll->isStarted())
                <vote-form></vote-form>
            @else
                <h1>Голосование закрыто</h1>
            @endif
        </div>
    </div>
@endsection
