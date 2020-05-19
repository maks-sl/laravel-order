@extends('layouts.app')

@section('content')
    @include('cabinet.single.parser._nav')


    <div class="d-flex flex-row mb-3">
        <a href="{{ route('cabinet.single.parser.edit', $parser) }}" class="btn btn-primary mr-1">Edit</a>

{{--        @if ($parser->isActive())--}}
{{--            <form method="POST" action="{{ route('cabinet.parsers.verify', $parser) }}" class="mr-1">--}}
{{--                @csrf--}}
{{--                <button class="btn btn-success">Verify</button>--}}
{{--            </form>--}}
{{--        @endif--}}

        <form method="POST" action="{{ route('cabinet.single.parser.destroy', $parser) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>

    <div class="card mb-3 p-4">
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <th>ID</th><td>{{ $parser->id }}</td>
            </tr>
            <tr>
                <th>Name</th><td>{{ $parser->name }}</td>
            </tr>
            <tr>
                <th>Url</th><td>{{ $parser->url }}</td>
            </tr>
            <tr>
                <th>Css Path</th><td>{{ $parser->css_path }}</td>
            </tr>
            <tr>
                <th>Reg Ex</th><td>{{ $parser->regex }}</td>
            </tr>
            <tr>
                <th>Match Group</th><td>{{ $parser->match_group }}</td>
            </tr>
            <tr>
                <th>Strip tags</th>
                <td>
                    @if ($parser->strip_tags)
                        <span class="badge badge-primary">On</span>
                    @else
                        <span class="badge badge-secondary">Off</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    @if ($parser->isPaused())
                        <span class="badge badge-secondary">Paused</span>
                    @endif
                    @if ($parser->isActive())
                        <span class="badge badge-primary">Active</span>
                    @endif
                </td>
            </tr>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
