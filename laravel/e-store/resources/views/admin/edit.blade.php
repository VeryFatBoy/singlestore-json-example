@extends('layout')
@section('content')
<style>
   .container {
   max-width: 450px;
   }
   .push-top {
   margin-top: 50px;
   }
</style>
<div class="row">
   <div class="col-lg-12 margin-tb">
      <div class="pull-right">
         <a class="btn btn-info" href="{{ route('products.index') }}">Back</a>
      </div>
   </div>
</div>
<div class="card push-top">
   <div class="card-header">
      Editing {{ $product->name }}
   </div>
   <div class="card-body">
      @if ($errors->any())
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      <br />
      @endif
      <form method="post" action="{{ route('products.update', $product->id) }}">
         <div class="form-group">
            @csrf
            @method('PATCH')
            <label for="name"><b>Name:</b></label>
            <input type="text" class="form-control" name="name" value="{{ $product->name }}"/>
         </div>
         <div class="form-group">
            <label><b>Brand:</b></label>
               <select name="brand_id" class="form-control">
               @foreach($brands as $brand)
                  @if ($product->brand_id == $brand->id)
  		     <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
  	          @else
		     <option value="{{ $brand->id }}">{{ $brand->name }}</option>
	          @endif
               @endforeach
               </select>
         </div>
         <div class="form-group">
            <label><b>Category:</b></label>
               <select name="category_id" class="form-control">
               @foreach($categories as $category)
                  @if ($product->category_id == $category->id)
                     <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                  @else
                     <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endif
               @endforeach
               </select>
         </div>
         <div class="form-group">
            <label for="attributes"><b>Attributes</b></label>
            @foreach($product->attributes as $key => $value)
            <div class="row">
               <div class="col-md-5" style="margin-bottom: 2px;">
                  <label for="$key"><b>{{ $key }}:</b></label>
               </div>
               <div class="col-md-5">
                  <input type="text" class="form-control" name="attributes[{{ $key }}]" value="{{ json_encode($value) }}" readonly="readonly">
               </div>
            </div>
            @endforeach
         </div>
         <button type="submit" class="btn btn-block btn-danger">Update Product</button>
      </form>
   </div>
</div>
@endsection
