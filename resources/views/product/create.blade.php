@extends('layouts.app')
@section('content')
<h2>ADD PRODUCT</h2>
<form method="POST" action="{{route('product.store')}}">
    @csrf
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name"  name="name" placeholder="product name">
    </div>
    <div class="form-group">
      <label for="price">Price</label>
      <input type="number" class="form-control" id="price" name="price" placeholder="Unit Price">
    </div>
    
    <button type="submit" class="btn btn-primary">Add</button>
  </form>
@endsection