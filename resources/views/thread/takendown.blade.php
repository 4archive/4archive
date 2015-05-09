@extends('master')

@section('title', 'This thread was taken down - 4archive')
@section('contentHeader', 'Uh oh')

@section('content')
<div class="hp-content">
	<span class="slogan">This content is no longer available.</span>
	<p class="center"><strong>Reason:</strong> {{ $reason }}</p>
</div>
@stop