@extends('layouts.admin_layout')
@section('content')
    
<div>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @livewire('projet.projet-form')
        </div>
    </div>
</div>
@endsection