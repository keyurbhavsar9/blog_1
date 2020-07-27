@extends('layouts.app')


@section('title','Customer List')
<!-- or traditional
@section('title')
    Customer List
@endsection
-->

@section('content')

<div class="row">
    <div class="col-12">
        <h1>Customer List</h1>
    </div>
</div>

@can('create', App\Customer::class)
<div class="row">
    <div class="col-12">
        <p><a href="customers/create">Add new Customer</a></p>
    </div>
</div>
@endcan

@foreach ($customers as $customer)
    <div class="row">
        <div class="col-2">
            {{ $customer->id }}
        </div>
        <div class="col-4">
            @can('view', $customer)
            <a href="/customers/{{ $customer->id }}">{{ $customer->name }}</a> 
            @endcan
            @cannot('view', $customer)
            {{ $customer->name }}
            @endcannot
        </div>
        <div class="col-4">
            {{ $customer->company->name }}
        </div>

        <div class="col-2">{{ $customer->active  }}</div>
    </div>
@endforeach

    <div class="row py-3 ">
        <div class="col-12 d-flex justify-content-center py-5">
            {{ $customers->links() }}
        </div>
    </div>

@endsection

