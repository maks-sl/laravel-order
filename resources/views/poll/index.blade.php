@extends('layouts.app')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manage</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('poll.manage') }}">
                        @csrf
                        <input type="hidden" name="command" value="1">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Start</button>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('poll.manage') }}">
                        @csrf
                        <input type="hidden" name="command" value="2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Pause</button>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('poll.manage') }}">
                        @csrf
                        <input type="hidden" name="command" value="3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
