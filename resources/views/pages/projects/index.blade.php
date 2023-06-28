@extends('layouts.app')
@section('title')
Portfolio Leonardo Rinaldi | Progetti 
@endsection
@section('content')
<div class="container">
    <div>
        <select name="type" id="select-type">
            @if(isset($typeSelected)) 
                <option value="home">Torna alla Home</option>
            @else
                <option value="">scegli</option>
            @endif
            @foreach ($types as $type)
                <option value="{{$type->slug}}" @if(isset($typeSelected) && $typeSelected->id === $type->id) selected @endif>{{$type->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        @forelse ($projects as $project)
        <div class="col-4 p-3 mt-3">
            <div class="card text-center p-3" style="min-height:600px">
                <div class="text-center">
                    @foreach ($project->tags as $tag)
                    <span class="badge {{$tag->slug}}">
                    </span>
                    @endforeach
                </div>
                <a href="{{route('projects.show', $project)}}" class="text-decoration-none text-dark">
                    <h3 class="my-3 title">{{$project['name']}}
                    </h3>
                    @if ($project['image'] == '')
                        <img class="w-100" src="{{ asset('storage\projects_images\icon-image-not-found-free-vector.jpg') }}" alt="">
                    @else
                        <img class="w-100" src="{{ asset('storage/' . $project['image']) }}" alt="">
                    @endif
                    <h6 class="short-desc mt-4">
                        <i>{{$project['short_description']}}</i>
                    </h6>
                </a>
            </div>
        </div>
        @empty
            <h3>non sono presenti progetti...mi dispiace</h3>
        @endforelse
    </div>
</div>
@endsection