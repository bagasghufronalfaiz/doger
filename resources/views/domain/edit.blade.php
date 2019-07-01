@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/domain/{{$domain->id}}" method="post">
        <div class="form-group">
            <label for="domain">Domain</label>
            <input class="form-control" type="text" name="domain" value="{{(old('domain')) ? old('domain') : $domain->domain}}" >
        </div>
        <div class="form-group">
            <label for="pa">Page Autority</label>
            <input class="form-control" type="number" name="pa" value="{{(old('pa')) ? old('pa') : $domain->pa}}">
        </div>
        <div class="form-group">
            <label for="da">Domain Autority</label>
            <input class="form-control" type="number" name="da" value="{{(old('da')) ? old('da') : $domain->da}}">
        </div>
        
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        @if(count($errors)>0)
            <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            <p>{{$error}}</p>
            @endforeach
            </div>
        @endif
        <input type="submit" class="btn btn-primary" value="Edit Domain">
    </form>
</div>
@endsection