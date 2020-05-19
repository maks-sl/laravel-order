@extends('layouts.app')

@section('content')
    @include('cabinet.single.parser._nav')

    <p><a href="{{ route('cabinet.single.parser.create') }}" class="btn btn-success">Add Single Parser</a></p>

    <div class="card mb-3 p-4">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Url</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($parsers as $parser)
                <tr>
                    <td>{{ $parser->id }}</td>
                    <td><a href="{{ route('cabinet.single.parser.show', $parser) }}">{{ $parser->name }}</a></td>
                    <td>{{ $parser->url }}</td>
                    <td>
                        @if ($parser->isPaused())
                            <span class="badge badge-secondary">Paused</span>
                        @endif
                        @if ($parser->isActive())
                            <span class="badge badge-primary">Active</span>
                        @endif
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    {{ $parsers->links() }}
@endsection
