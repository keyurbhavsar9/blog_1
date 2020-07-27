@extends('layouts.app')


@section('title','edit customer details')
<!-- or traditional
@section('title')
    Customer List
@endsection
-->


@section('content')
<div class="row">
    <div class="col-12">
        <h1>Edit details for {{ $customer->name }} </h1>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form action="{{ route('customers.update',['customer'=>$customer]) }}" method="POST" enctype="multipart/form-data" >
            @method('PATCH')
            @include('customers.form')
            

            <button type="submit" class="btn btn-primary">Save customer</button>
           
        </form>
    </div>
</div>

@endsection

