@extends('layouts.app')

@section('content')
    @include('cabinet.single.parser._nav')

    <div class="card mb-3 p-4">
        <form method="POST" action="{{ route('cabinet.single.parser.update', $parser) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="col-form-label">Name</label>
                <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $parser->name) }}" required>
                @if ($errors->has('name'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="url" class="col-form-label">Url</label>
                <input id="url" type="url" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" value="{{ old('url', $parser->url) }}" required>
                @if ($errors->has('url'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('url') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="css_path" class="col-form-label">CSS path</label>
                <input id="css_path" class="form-control{{ $errors->has('css_path') ? ' is-invalid' : '' }}" name="css_path" value="{{ old('css_path', $parser->css_path) }}" required>
                @if ($errors->has('css_path'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('css_path') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="regex" class="col-form-label">RegEx</label>
                <input id="regex" class="form-control{{ $errors->has('regex') ? ' is-invalid' : '' }}" name="regex" value="{{ old('regex', $parser->regex) }}">
                @if ($errors->has('regex'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('regex') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="match_group" class="col-form-label">Match group</label>
                <input id="match_group" class="form-control{{ $errors->has('match_group') ? ' is-invalid' : '' }}" name="match_group" value="{{ old('match_group', $parser->match_group) }}">
                @if ($errors->has('match_group'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('match_group') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <input type="hidden" name="strip_tags" value="0">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="strip_tags" {{ old('strip_tags', $parser->strip_tags) ? 'checked' : '' }}> Strip tags
                    </label>
                </div>
                @if ($errors->has('strip_tags'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('strip_tags') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="period" class="col-form-label">Period</label>
                <input id="period" class="form-control{{ $errors->has('period') ? ' is-invalid' : '' }}" name="period" value="{{ old('period', $parser->period) }}" required>
                @if ($errors->has('period'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('period') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection
