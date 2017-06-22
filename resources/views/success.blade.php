@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-success hidden-print">
        Account has been successfully created!
    </div>
    <h1>Account Information</h1>
    <dl class="dl-horizontal">
        <dt>First Name</dt>
        <dd>{{ $guest->firstName }}</dd>
        <dt>Last Name</dt>
        <dd>{{ $guest->lastName }}</dd>
        <dt>Sponsor</dt>
        <dd>{{ Auth::user()->name }}</dd>
        <dt>Expires On</dt>
        <dd>{{ date("F j, Y", ($guest->expiration)) }}</dd>
        <dt>Username</dt>
        <dd style="font-family:monospace;">{{ $guest->username }}</dd>   
        <dt>Password</dt>
        <dd style="font-family:monospace;">{{ $guest->password }}</dd>
    </dl>
    <h4>Using your account</h4>
    <p>Your username and password above can be used to login to district WiFi and computers.<br>
    To use the WiFi connect to <b>SCSD Secure</b> and enter your username and password when prompted.</p>
    <h4>Acceptable Use Policy</h4>
    <p>Use of district computing resources or network access indicates acceptance of the Acceptable Use Policy.<br>
    View the entire Acceptable Use Policy at <a href="http://goo.gl/SgpFxJ">this link</a>, or scan this barcode with your phone.</p>
    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&choe=UTF-8&chld=H&chl=https://goo.gl/SgpFxJ">
    <div class="row hidden-print">
        <a onClick="window.print()" class="btn btn-primary">Print</a>
        <a href="/home" class="btn btn-secondary">Create Another</a>
    </div>
</div>

@endsection
