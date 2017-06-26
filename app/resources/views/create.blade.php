@extends('layouts.app')

@section('content')
<div class="container">
@if (Session::has('message'))
    <div class="alert alert-danger">{{ Session::get('message') }}</div>
@endif
    <form class="form-horizontal" role="form" method="POST" action="{{ url('create') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="firstName" class="col-sm-2 control-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Guest first name">
                @if ($errors->has('firstName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('firstName') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="lastName" class="col-sm-2 control-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Guest last name">
                @if ($errors->has('lastName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lastName') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="purpose" class="col-sm-2 control-label">Purpose</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="purpose" name="purpose" placeholder="Purpose of access">
                @if ($errors->has('purpose'))
                    <span class="help-block">
                        <strong>{{ $errors->first('purpose') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="location" class="col-sm-2 control-label">Location</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="location" name="location" placeholder="Guest location">
                @if ($errors->has('location'))
                    <span class="help-block">
                        <strong>{{ $errors->first('location') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="duration" class="col-sm-2 control-label">Duration</label>
            <div class="col-sm-10">
                <select type="text" class="form-control" id="duration" name="duration">
                    <option value="1">1 day</option>
                    <option value="3">3 days</option>
                    <option value="7">1 week</option>
                    <option value="14">2 weeks</option>
                    <option value="30">1 month</option>
                    <option value="0" disabled>Please submit a help desk ticket for longer durations.</option>
                </select>
                @if ($errors->has('duration'))
                    <span class="help-block">
                        <strong>{{ $errors->first('duration') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <input type="submit" class="btn btn-primary">
    </form>      
</div>
@endsection
