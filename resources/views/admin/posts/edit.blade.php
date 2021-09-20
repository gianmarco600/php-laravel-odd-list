@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('admin.posts.update', $post->id)}}" method="POST">
    @csrf

    @method('PUT')

    <div class="my-4">
        <label for="title" class="form-label">titolo:</label>
        <input type="text" class="form-control
        @error('title')
            is-invalid
        @enderror"
        name="title" id="title" value="{{old('title', $post->title)}}">
        @error('title')
            <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
    </div>

{{-- categorie---------------------------------------------- --}}

    <div class="my-4">
        <label for="category" class="form-label">category:</label>
        <select class="form-control
        @error('category_id')
            is-invalid
        @enderror"
        name="category_id" id="category">
            <option value="">--seleziona categoria--</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}"
                    @if ($category->id == old('category_id', $post->category_id)) selected @endif>

                    {{$category->name}}
                </option>
            @endforeach

        </select>
        @error('category_id')
            <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
    </div>

    {{-- descrizione --}}
    <div class="my-4">
        <label for="description" class="form-label">descrizione:</label>
        <textarea id="description" name="description" class="form-control
        @error('description')
            is-invalid
        @enderror"
          rows="6">{{old('description', $post->description)}}</textarea>
        @error('description')
            <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
    </div>

    {{-- tags --------------------------- --}}
    <div>
        <h4>tags</h4>
        @foreach ($tags as $tag)
        <div class="formcheck"></div>
            <input class="form-check-input" id="tag{{ $loop->iteration }}" type="checkbox" value="{{ $tag->id }}" name="tags[]"
            @if ( !$errors->any() && $post->tags->contains($tag->id))
                checked

            @elseif(in_array($tag->id, old('tags', [])))
                checked

            @endif

            >
            <label class="form-check-label" for="tag{{ $loop->iteration }}">{{ $tag->name }}</label>
        @endforeach
    </div>

    {{-- ----------- --}}
    <a href="{{route('admin.posts.index')}}" class="btn btn-light">Torna indietro</a>
      <button type="submit" class="btn btn-primary">salva modifiche</button>
    </form>

@endsection