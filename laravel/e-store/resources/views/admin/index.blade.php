@extends('layout')
@section('content')
<style>
   .push-top {
   margin-top: 50px;
   }
</style>
<div class="push-top">
@if(session()->get('success'))
<div class="alert alert-success">
   {{ session()->get('success') }}  
</div>
<br />
@endif
<table class="table table-bordered table-striped">
   <thead>
      <tr class="table-warning">
         <td>ID</td>
         <td>Name</td>
         <td>Brand</td>
         <td>Category</td>
         <td>Attributes</td>
         <td class="text-center">Action</td>
      </tr>
   </thead>
   <tbody>
      @foreach($products as $product)
      <tr>
         <td>{{ $product->id }}</td>
         <td>{{ $product->name }}</td>
         <td>{{ $product->brand_name }}</td>
         <td>{{ $product->category_name }}</td>
         <td>
            @foreach ($product->attributes as $key => $value)
               <b>{{ $key }}</b>: {{ json_encode($value) }} <br />
            @endforeach
         </td>
         <td class="text-center">
            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">Show</a>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm"">Edit</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="post" style="display: inline-block">
               @csrf
               @method('DELETE')
               <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
<div>
{!! $products->links() !!}
@endsection
