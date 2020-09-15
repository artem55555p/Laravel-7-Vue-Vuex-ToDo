@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <div class="col-md-12">
           <todos-component></todos-component>
           <hr>
           <inputform-component></inputform-component>
       </div>
    </div>
</div>
@endsection
