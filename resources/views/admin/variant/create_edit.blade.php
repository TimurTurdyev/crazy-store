@extends('layouts.app')
@section('header', $variant->id ? 'Обновить вариант': 'Создать вариант')
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Список товаров</a></li>
    <li class="breadcrumb-item"><a href="{{ route('product.edit', $product->id) }}">{{ $product->name }}</a></li>
    <li class="breadcrumb-item active">{{ $variant->id ? 'Обновить вариант': 'Создать вариант' }}</li>
@endsection
@section('content')
    @include('admin.variant.index')
@endsection

@include('admin.variant.scripts')
