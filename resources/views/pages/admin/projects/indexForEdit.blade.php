@extends('layouts.app')
@section('title')
Portfolio Leonardo Rinaldi | Modifica/Elimina Progetti
@endsection
@section('content')
<div class="container">
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">NAME</th>
                    <th scope="col">DESC</th>
                    <th scope="col" class="text-center">MODIFICA</th>
                    <th scope="col" class="text-center">VISIBILITA'</th>
                    <th scope="col" class="text-center">ELIMINA</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                <tr class="">
                    <td><b>{{$project['name']}}</b></td>
                    <td><i>"{{$project['short_description']}}"</i></td>
                    <td class="text-center "><a href="{{route('admin.projects.edit', $project)}}" class="text-black"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td class="text-center text">
                        <a href="{{route('admin.projects.visibility', $project)}}" class="text-black">
                            <i class="fa-solid fa-eye{{$project->visibility ? '' : '-slash'}}"></i>
                        </a>
                    </td>
                    <td class="text-center text">
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
                @empty

                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection