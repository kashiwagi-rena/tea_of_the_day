<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-red-800 leading-tight">
      紅茶投稿の編集
    </h2>
    <x-validation-errors class="mb-4" :errors="$errors" />
    <x-message :message="session('message')" />
  </x-slot>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mx-4 sm:p-8">
      <form method="post" action="{{route('post.update', $post)}}" enctype="multipart/form-data">
              @csrf
              @method('patch')
              <div class="md:flex items-center mt-8">
                  <div class="w-full flex flex-col">
                    <label for="title" class="font-semibold leading-none mt-4">紅茶名</label>
                    <input type="text" name="title" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="title" value="{{old('title', $post->title)}}" placeholder="おすすめしたい紅茶名">
                  </div>
              </div>

              <div class="w-full flex flex-col">
                  <label for="body" class="font-semibold leading-none mt-4">おすすめポイント</label>
                  <textarea name="body" class="w-auto py-2 border border-gray-300 rounded-md" id="body" cols="30" rows="10" placeholder="香りが良いや価格がお手頃等">{{old('body',$post->body)}}</textarea>
              </div>

              <div class="w-full flex flex-col">
                @if($post->image)
                  <div>
                    (画像ファイル：{{$post->image}})
                  </div>
                  <img src="{{ asset('storage/images/'.$post->image)}}" class="mx-auto" style="height:300px;">
                @endif
                <label for="image" class="font-semibold leading-none mt-4">画像 （1MBまで）</label>
                <div>
                  <input id="image" type="file" name="image">
                </div>
              </div>

              <x-primary-button class="mt-4">
                  送信する
              </x-primary-button>
              
          </form>
      </div>
  </div>
</x-app-layout>