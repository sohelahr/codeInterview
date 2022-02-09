@extends('layouts.app')
@section('title')
    <title>Code Interview | View</title>
@endsection
@section('content')
<div class="container-fluid">
    <br>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Office Name</th>
                <th scope="col">Pin Code</th>
                <th scope="col">Office Type</th>
                <th scope="col">Delivery Status</th>
                <th scope="col">Division Name</th>
                <th scope="col">Region Name</th>
                <th scope="col">Circle Name</th>
                <th scope="col">Taluk</th>
                <th scope="col">District Name</th>
                <th scope="col">State Name</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($data) && $data->count())
                @foreach($data as $key => $value)
                    <tr>
                        <td>{{ $value->office_name }}</td>
                        <td>{{ $value->pin_code }}</td>
                        <td>{{ $value->office_type }}</td>
                        <td>{{ $value->delivery_status }}</td>
                        <td>{{ $value->division_name }}</td>
                        <td>{{ $value->region_name }}</td>
                        <td>{{ $value->circle_name }}</td>
                        <td>{{ $value->taluk }}</td>
                        <td>{{ $value->district_name }}</td>
                        <td>{{ $value->state_name }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="10">No records found.</td>
                </tr>
            @endif
        </tbody>
    </table>
    {!! $data->links('pagination::bootstrap-4') !!}
</div>
@endsection
