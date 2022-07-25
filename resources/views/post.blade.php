<x-layout>
    <article>
       <h1>{!! $post->title !!}</h1> <!--GTN: !! allows any HTML to render //! ATT: !! make sure you have control of the data enclosed, as browser will execute any script-->  
       
        <p>
        By <a href="#">{{ $post->user->name }}</a> in <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
        </p>
       
       <div>
          <p>{{ $post->body }}</p>
       </div>
    </article>

    <a href="/">Go Back</a>
</x-layout>