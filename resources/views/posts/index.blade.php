@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @auth
                <form action="{{ route('posts') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="mb-4">
                        <label for="body">Body</label>
                        <textarea name="body" id="body" cols="30" rows="4"
                            class="bg-grey-100 border-2 w-full p-4 rounnded-lg @error('body') border-red-500 @enderror"
                            placeholder="eneter your post here"></textarea>
                        @error('body')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
                    </div>
                </form>
            @endauth
            @if ($posts->count())
                @foreach ($posts as $post)
                    <x-post :post='$post' />
                @endforeach
                {{ $posts->links() }}
            @else
                there are no posts
            @endif
        </div>
    </div>
@endsection
