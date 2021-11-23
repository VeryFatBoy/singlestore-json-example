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
      Showing {{ $one_product->name }}
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
      <div class="form-group">
         <label><b>Name:</b></label>
         {{ $one_product->name }}
      </div>
      <div class="form-group">
         <label><b>Brand:</b></label>
         {{ $one_product->brand_name }}
      </div>
      <div class="form-group">
         <label><b>Category:</b></label>
         {{ $one_product->category_name }}
      </div>
      <div class="form-group">
         <label><b>Attributes</b></label>
         @foreach($one_product->attributes as $key => $value)
         <div class="row">
            <div class="col-md-5" style="margin-bottom: 2px;">
               <label for="$key"><b>{{ $key }}:</b></label>
            </div>
            <div class="col-md-5">
               {{ json_encode($value) }}
            </div>
         </div>
         @endforeach
      </div>
      </form>
   </div>
</div>
@endsection
