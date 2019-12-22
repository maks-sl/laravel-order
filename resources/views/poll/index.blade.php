@extends('layouts.app')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Управление голосованием</div>
                <div class="card-body">
                    @if ($poll->isStarted())
                        <h1>Текущий статус: открыто</h1>
                    @else
                        <h1>Текущий статус: закрыто</h1>
                    @endif
                    <hr><br>
                    <form method="POST" action="{{ route('poll.manage') }}">
                        @csrf
                        <input type="hidden" name="command" value="1">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Начать голосование</button>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('poll.manage') }}">
                        @csrf
                        <input type="hidden" name="command" value="2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Завершить голосование</button>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('poll.manage') }}">
                        @csrf
                        <input type="hidden" name="command" value="3">
                        <div class="form-group">
                            <button onclick="return confirm('ВНИМАНИЕ! Все результаты будут удалены безвозвратно. Продолжить?')" type="submit" class="btn btn-primary">Очистить результаты</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
