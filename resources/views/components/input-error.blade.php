<!-- resources/views/components/input-error.blade.php -->
@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'invalid-feedback']) }}>
        @foreach ((array) $messages as $message)
            <span>{{ $message }}</span>
        @endforeach
    </div>
@endif