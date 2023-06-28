@extends('layouts.app')
@section('title')
Portfolio Leonardo Rinaldi | Progetti 
@endsection
@section('content')
@if (Session::has('success'))
<div class="container">
    <div class="alert alert-success text-center">
        {{Session::get('success')}}
    </div>
</div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-8 text-center p-5 mb-5">
            <div>
                <div class="d-flex justify-content-between">
                    <span class="badge badge-type" style="height:25px">{{$project->type->name}}</span>
                    <div>
                        @foreach ($project->tags as $tag)
                        <span class="badge {{$tag->slug}}">
                        </span>
                        @endforeach
                    </div>
                </div>                
            </div>
            <h3 class="mt-3">{{$project['name']}}</h3>
            <h6 class="mb-4">
                <i>{{$project['relase_date']}}</i>
            </h6>
            @if ($project['image'] == '')
                <img  src="{{ asset('storage\projects_images\icon-image-not-found-free-vector.jpg') }}" alt="">
            @else
                <img class="w-100" src="{{ asset('storage/' . $project['image']) }}" alt="">
            @endif
            <p class="mt-4">
                <i>{{$project['description']}}</i>
            </p>
        </div>
    </div>
</div>
@endsection