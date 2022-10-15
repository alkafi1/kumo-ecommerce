@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <h1>Hello  {{ Auth::user()->name }}</h1>
</div>
@endsection
@section('footer_script')

@endsection
