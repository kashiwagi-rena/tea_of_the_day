<x-app-layout>
  <x-slot name="header">
    <h2 class="font-kaisei text-xl text-red-800 leading-tight">
      おすすめ紅茶投稿
    </h2>
    <x-validation-errors class="mb-4" :errors="$errors" />
    <x-message :message="session('message')" />
  </x-slot>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mx-4 sm:p-8">
          <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
            @csrf
              <div class="md:flex items-center mt-8">
                  <div class="w-full flex flex-col">
                    <label for="title" class="font-kaisei leading-none mt-4 text-red-800">紅茶名</label>
                    <input type="text" name="title" class="font-kaisei w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="title" value="{{old('title')}}" placeholder="おすすめしたい紅茶名">
                  </div>
              </div>

              <div class="w-full flex flex-col">
                  <label for="body" class="font-kaisei leading-none mt-4 text-red-800">おすすめポイント</label>
                  <textarea name="body" class="font-kaisei w-auto py-2 border border-gray-300 rounded-md" id="body" cols="30" rows="10" placeholder="香りが良いや価格がお手頃等">{{old('body')}}</textarea>
              </div>

              <div class="w-full flex flex-col">
                  <label for="image" class="font-kaisei leading-none mt-4 text-red-800">画像 （1MBまで）</label>
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