@props(['category'])

<a href="/?category={{ $category->slug }}"
   class="px-3 py-1 border border-purple-700 rounded-full text-purple-700 text-xs uppercase font-bold"
   style="font-size: 10px"
>{{ $category->name }}</a>
