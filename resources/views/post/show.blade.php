<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-800 leading-tight">
            おすすめ紅茶の詳細
        </h2>

        <x-message :message="session('message')" />

    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            <div class="px-10 mt-4">

                <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                    <div class="mt-4">
                        <h1 class="text-lg text-red-700 font-semibold">
                            {{ $post->title }}
                            <a href="{{route('post.edit',$post)}}"><x-primary-button class="bg-teal-700 float-right">編集</x-primary-button></a>
                        </h1>
                        <hr class="w-full">
                        <p class="mt-4 text-red-600 py-4 whitespace-pre-line">{{$post->body}}</p>
                        @if($post->image)
                          <div>
                            (画像ファイル:{{$post->image}})
                          </div>
                          <img src="{{ asset('storage/images/'.$post->image)}}" class="mx-auto" style="height:300px;">
                        @endif
                        <div class="text-sm font-semibold flex flex-row-reverse">
                            <p> {{ $post->user->name }} • {{$post->created_at->diffForHumans()}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>