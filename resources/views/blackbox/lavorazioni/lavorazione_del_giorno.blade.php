@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('lavorazioni.index')}}" />

<Lavorazione-giornaliera method="create" :tipi-pausa="{{json_encode($tipiPausa)}}" :lavorazione="{{json_encode($lavorazione)}}" :operatori="{{json_encode($operatori)}}" />


@endsection