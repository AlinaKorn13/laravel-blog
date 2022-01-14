@props(['message'])

<div x-data="{ show : true}"
     x-init="setTimeout(() => show = false, 4000)"
     x-show="show"
    {{$attributes->merge(['class' => 'fixed bottom-1 right-1 py-2 px-4 rounded-xl'])}}">
    <p>{{ $message }}</p>
</div>
