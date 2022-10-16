@extends('layouts.main')
@section('content')


    @if(session()->has('success'))
        <p><strong>Новая ссылка: {{session()->get('success')}}</strong></p>
    @endif
    <form method="post" action="{{route('links.send')}}">
        @csrf
        <input name="url" type="text" placeholder="https://google.com">
        <button type="submit">shorten</button>
    </form>
@stop
