@props(['status'])
@php
$classes = [
    'pending' => 'bg-amber-100 text-amber-700',
    'confirmed' => 'bg-blue-100 text-blue-700',
    'cancelled' => 'bg-red-100 text-red-700',
    'completed' => 'bg-emerald-100 text-emerald-700',
][$status] ?? 'bg-slate-100 text-slate-700';
@endphp
<span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $classes }}">{{ ucfirst($status) }}</span>
