@extends('layouts.app')

@section('content')
    <h1>Contact us</h1>
    @if (! session()->has('message'))
    <form action="{{ route('contact.store') }}" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
            {{ $errors->first('name') }}
        </div>
        
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" value="{{ old('email') }}" class="form-control">
            {{ $errors->first('email') }}    
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea type="text" name="message" id="message" cols="30" rows="10" class="form-control">{{ old('message') }}</textarea>
            {{ $errors->first('message') }}    
        </div>

        <button type="submit" class="btn btn-primary">Send Message</button>
        @csrf
    </form>
    @endif
@endsection     
