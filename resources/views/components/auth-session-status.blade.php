<!-- resources/views/components/auth-session-status.blade.php -->
@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert alert-success']) }}>
        {{ $status }}
    </div>
@endif