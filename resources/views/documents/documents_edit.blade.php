@extends('layouts.app')

@section('content')
<div class="container">
	<a href="{{route("documents.index")}}" class="btn btn-success mb-2">Volver</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Actualizar usuario') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('documents.update',[$document]) }}" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Usuario relacionado') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="user" name="user">
                                    @foreach ($users as $user)
                                        <option 
                                        	value="{{$user->id}}"
                                        	{{ ( $document->user_id == $user->id) ? "selected" : '' }}
                                        >
                                        	{{$user->name}}
                                    	</option>
                                    @endforeach
                                </select>

                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Actualizar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection