@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Domain</th>
                <th scope="col">Page Autority</th>
                <th scope="col">Domain Autority</th>
                <th scope="col">Expiration</th>
                <th scope="col">Nameserver 1</th>
                <th scope="col">Nameserver 2</th>
                <th scope="col">Index Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($user->domains as $domainy)

            <tr>
                <td>{{$domainy->domain}}</td>
                <td>{{$domainy->pa}}</td>
                <td>{{$domainy->da}}</td>
                <td>{{$domainy->expiration}}</td>
                <td>{{$domainy->nameserver1}}</td>
                <td>{{$domainy->nameserver2}}</td>
                <td>{{$domainy->index_status}}</td>
                <td>
                <p>
                    <a href="/domain/{{$domainy->id}}/editdomain/" class="btn btn-secondary btn-lg">Edit</a></p>

                    <form action="/domain/{{$domainy->id}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" class="btn btn-danger btn-lg" value="Hapus Domain">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
