@extends('layouts.app')
@section('title')
    <title>Code Interview | Import</title>
@endsection
@section('content')
<div class="container-fluid">
    <br>
    @if((isset($import_summary) && $import_summary->getRawOriginal('import_status') !== "0") || !isset($import_summary))
        <form method="POST" action="{{url('/import/data')}}">
            <button type="submit" class="btn btn-success">Fetch</button>
        </form>
        <br>
    @endif
    
    @if(isset($import_summary) && $import_summary->getRawOriginal('import_status') === '0')
        <div class="alert alert-info" role="alert">
            <i class="fa fa-spinner fa-pulse"></i>
            Import is in progress.
        </div>
    @endif
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Import Type</th>
                <th scope="col">Import Status</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($import_summary)) 
                <tr>
                    <td>{{$import_summary->id}}</td>
                    <td>{{$import_summary->import_type}}</td>
                    <td>{{$import_summary->import_status}}</td>
                </tr>
            @else
                <tr>
                    <td class="text-center" colspan="3">No records found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
