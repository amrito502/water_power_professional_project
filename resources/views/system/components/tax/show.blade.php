@extends('system.master')


@section('content')
    <h2>Tax Details</h2>
    <p><strong>ID:</strong> {{ $tax->id }}</p>
    <p><strong>Tax Rate:</strong> {{ $tax->tax_rate }}%</p>
    <p><strong>Tax Type:</strong> {{ $tax->tax_type }}</p>
    <p><strong>Status:</strong> {{ $tax->status }}</p>
    <p><strong>Rank:</strong> {{ $tax->rank }}</p>
    <a href="{{ route('taxes.index') }}">Back</a>
@endsection