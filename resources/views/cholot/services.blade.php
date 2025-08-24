@extends('layouts.cholot')

@section('content')
    {{-- Render Page Builder Blocks --}}
    @if($page->blocks && is_array($page->blocks))
        @foreach($page->blocks as $block)
            @include('cholot.partials.block-renderer', ['block' => $block])
        @endforeach
    @endif
@endsection