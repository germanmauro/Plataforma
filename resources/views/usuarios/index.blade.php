@extends('layouts.main')
@section('content')
    @foreach ($users as $item)
       <p>{{$item->nombre}}</p>
       <p>{{$item->apellido}} </p>
    @endforeach
@endsection