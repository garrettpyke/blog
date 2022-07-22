<x-layout>
    <article>
       <h1>{!! $post->title !!}</h1> <!--GTN: !! allows any HTML to render  -->   
       
       <div>
          {!! $post->body !!} <!--//! ATT: !! make sure you have control of the data enclosed, as browser will execute  -->
       </div>
    </article>

    <a href="/">Go Back</a>
</x-layout>