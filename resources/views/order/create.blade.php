@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">GF Order</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('order.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="col-form-label">Name</label>
                            <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-form-label">Phone</label>
                            <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('phone') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-form-label">Address</label>
                            <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required>
                            @if ($errors->has('address'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('address') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="tariff" class="col-form-label">Tariff</label>
                            <select id="tariff" class="form-control{{ $errors->has('tariff') ? ' is-invalid' : '' }}" name="tariff" required>
                                <option value=""></option>
                                @foreach ($tariffs as $tariff)
                                    <option value="{{ $tariff->id }}"{{ $tariff->id == old('tariff') ? ' selected' : '' }}>
                                        {{ $tariff->name }}
                                    </option>
                                @endforeach;
                            </select>
                            @if ($errors->has('tariff'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('tariff') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="date" class="col-form-label">Date</label>
                            <input id="date" type="text" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ old('date') }}" required>
                            @if ($errors->has('date'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('date') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Checkout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
