<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" value="{{ old('name') ?? $customer->name  }}" class="form-control">
    {{ $errors->first('name') }}
</div>


<div class="form-group">
    <label for="email">Email</label>
    <input type="text" name="email" value="{{ old('email') ?? $customer->email }}" class="form-control">
    {{ $errors->first('email') }}    
</div>

<div class="form-group">
    <label for="active">Status</label>
    <select name="active" id="active" class="form-control">
        <option value="" disabled>Select customer Status</option>
        
        @foreach ($customer->activeOptions() as $activeOptionKey => $activeOptionVlaue)
        <option value="{{ $activeOptionKey }}" {{ $customer->active == $activeOptionVlaue ? 'selected' : '' }}>{{ $activeOptionVlaue }}</option>    
        @endforeach
        
    </select>
</div>

<div class="form-group">
    <label for="company">Company</label>
    <select name="company_id" id="company_id" class="form-control">
        @foreach ($companies as $c)
            <option value="{{ $c->id }}" {{ $c->id == $customer->company_id ? 'selected' : '' }}>{{ $c->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group d-flex flex-column">
    <label for="image">Profile Image</label>
    <input class="py-2" type="file" name="image" id="image">
    {{ $errors->first('image') }}    
</div>
@csrf