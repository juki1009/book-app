@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'text-sm bg-black border border-white/30 rounded-sm']) }}>
