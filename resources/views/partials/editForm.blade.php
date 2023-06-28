
<div>
    <div class="container-form container m-auto p-5">
        <h1 class="text-center text-white">
            Modifica proggetto
        </h1>
        <form action="{{route('admin.projects.update', $project)}}" method="POST" enctype="multipart/form-data">
            
            @csrf
            @method('PUT')


            <div class="form-group">
                <label for="project-name" class="form-label">Titolo</label>
                <input type="text" required max="255"  id="project-name" class="form-control"
                placeholder="Inserisci il titolo del progetto" name="name" value="{{ old('name') ?? $project->name }}">
                @error('name')
                    <span style="color: red; text-transform: uppercase">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="project-description" class="form-label">Descrizione</label>
                <textarea id="project-description" class="form-control"
                placeholder="Inserisci la descrizione del progetto" name="description">{{ old('description') ?? $project->description}}</textarea>
                @error('description')
                    <span style="color: red; text-transform: uppercase">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="project-short_description" class="form-label">Descrizione breve</label>
                <input type="text" required max="255"  id="project-short_description" class="form-control"
                placeholder="Inserisci BREVE descrizione del progetto" name="short_description" value="{{ old('short_description') ?? $project->short_description}}">
                @error('short_description')
                    <span style="color: red; text-transform: uppercase">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3 form-group">
                <label for="project-image" class="form-label">Scegli una immagine</label>
                <input type="file" class="form-control" name="image" id="project-image" placeholder="project-image" aria-describedby="fileHelpId">
                @error('image')
                    <span style="color: red; text-transform: uppercase">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="project-relase_date" class="form-label">data publicazione</label>
                <input type="date" required id="project-relase_date" class="form-control" name="relase_date"
                    min="1900-01-01" value="{{ old('relase_date') ?? $project->relase_date}}">
                @error('relase_date')
                    <span style="color: red; text-transform: uppercase">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="project-type_id" class="form-label text-white-50">type</label>
                <select required name="type_id" id="type_id">
                    <option value="">scegli un tipo</option>
                    @foreach ($types as $type)
                    <option value="{{$type->id}}" {{ old('type_id',$project->type_id) == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <span style="color: red; text-transform: uppercase">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="project-visibility" class="form-label text-white-50">visibilità</label>
                <div>
                    <input type="radio" name="visibility" value="0" checked="{{ old('visibility',$project->visibility) == 0 ? 'checked' : ''}}"><span class="text-white-50">privato</span>
                    <input type="radio" name="visibility" value="1" checked="{{ old('visibility',$project->visibility) == 1 ? ' checked' : ''}}"><span class="text-white-50">publico</span>
                </div>
            </div>

            <div class="form-group mt-3">
                @foreach ($tags as $tag)
                <div class="form-check">
                    <label for="project-checkbox-{{$tag->id}}" class="form-label text-white-50">{{$tag->name}}</label>
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{$tag->id}}" id="project-checkbox-{{$tag->id}}"
                    @if ($errors->any())
                    @if(old('tags') && in_array($tag->id, old('tags'))) checked @endif
                    @else
                    {{ $project->tags->contains($tag) ? 'checked' : '' }}    
                    @endif>
                </div>           
                @endforeach
                @error('tags')
                <span style="color: red; text-transform: uppercase">{{$message}}</span>
                @enderror
            </div>

            <button type="submit" class="my-3 btn btn-primary">Modifica Proggetto </button>
        </form>
    </div>
</div>