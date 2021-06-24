@extends('layouts.app')
@section('header', $description->id ? 'Обновить описание': 'Создать описание')
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('description.index') }}">Список мета описаний</a></li>
    <li class="breadcrumb-item"><a href="{{ route('description.edit', $description->id) }}">{{ $description->name }}</a></li>
    <li class="breadcrumb-item active">{{ $description->id ? 'Обновить описание': 'Создать описание' }}</li>
@endsection
@section('content')
    @include('admin.description.form')
@endsection

@include('admin.description.scripts')
