@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Dettaglio post:</h3>
        <div class="card">
            <div class="card head">
                <h4>{{$post->title}}</h4>
            </div>
            <div class="card-body">
                <h5 class="card-title">slug:  {{$post->slug}}</h5>
                <h6 class="card-text">descrizione:  {{$post->description}}</h6>
                @if ($post->category->id)
                    <h4>categoria:  {{ $post->category->name }}</h4>
                @endif
                <h3>Tags:</h3>
                {{-- @if ($post->tags)
                    @foreach ($post->tags as $tag)
                        <span class="badge badge-info" >{{ $tag->name }}</span>
                    @endforeach
                @endif --}}

                @forelse ($post->tags as $tag)
                    <span class="badge badge-info" >{{ $tag->name }}</span>
                @empty
                    <h6>nessun tag</h6>
                @endforelse
            </div>

        </div>
        <a href="{{route('admin.posts.index')}}" class="btn btn-light mt-3">indietro</a>
    </div>
    
@endsection