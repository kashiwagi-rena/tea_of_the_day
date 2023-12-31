<x-app-layout>
    <x-slot name="header">
        <h2 class="font-kaisei text-xl  text-red-800 leading-tight">
            みんなのおすすめ紅茶
        </h2>

        <form class="m-4" method="GET" action="{{ route('post.index') }}">
            <input class="font-kaisei" type="search" placeholder="紅茶名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
            <x-primary-button class="bg-teal-700" type="submit">検索</x-primary-button>
            <div>
                <button>
                    <a href="{{ route('post.index') }}" class="text-white">
                        クリア
                    </a>
                </button>
            </div>
        </form>
        <x-message :message="session('message')" />

    </x-slot>

    {{-- 投稿一覧表示用のコード --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @foreach ($posts as $post)
            <div class="mx-4 sm:p-8">
                <div class="mt-4">
                    <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                        <div class="mt-4">
                            <h1 class="text-lg text-red-800 font-kaisei hover:underline cursor-pointer">
                            <a href="{{route('post.show', $post)}}">{{ $post->title }}</a>
                            </h1>
                            <hr class="w-full">
                            <p class="mt-4 text-red-600 py-4 font-kaisei">{{ $post->body }}</p>
                            <div class="text-sm font-kaisei flex flex-row-reverse text-red-600">
                                <p>{{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>