<x-layout>
    <article>
       <h1>{{ $post->title }}</h1>    
       
       <div>
          {!! $post->body !!} <!--GTN: !! allows any HTML to render  -->
       </div>
    </article>

    <a href="/">Go Back</a>
</x-layout>