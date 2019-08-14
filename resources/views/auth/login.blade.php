@extends('layouts.app')

@section('content')
<div class="row justify-content-md-center">
    <div class="col-md-6">
        <h1>@lang('auth.login')</h1>

        {!! Form::open(['route' => 'login', 'role' => 'form', 'method' => 'POST']) !!}
            <div class="form-group">
                {!! Form::label('email', __('validation.attributes.email'), ['class' => 'control-label']) !!}
                {!! Form::email('email', old('email'), ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'required', 'autofocus']) !!}

                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('password', __('validation.attributes.password'), ['class' => 'control-label']) !!}
                {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'required']) !!}

                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        {!! Form::checkbox('remember', null, old('remember')) !!} @lang('auth.remember_me')
                    </label>
                </div>
            </div>

            <div class="form-group">
                {!! Form::submit(__('auth.login'), ['class' => 'btn btn-primary']) !!}
                {{ link_to('/password/reset', __('auth.forgotten_password'), ['class' => 'btn btn-link'])}}
            </div>
        {!! Form::close() !!}

        <hr>
    </div>
</div>
@endsection
