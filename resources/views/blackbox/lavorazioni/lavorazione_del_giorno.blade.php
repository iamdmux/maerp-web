@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('lavorazioni.index')}}" />

<Lavorazione-giornaliera :lavorazione="{{json_encode($lavorazione)}}" :operatori="{{json_encode($operatori)}}" />

{{-- :counters="{{json_encode($counters)}}" --}}
@endsection