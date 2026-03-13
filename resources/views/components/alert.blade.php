<div id="alert" {{ $attributes->merge(['class' => 'alert alert-' . $type . ' alert-dismissible', 'role' => 'alert']) }}>
    <i class='bx'></i>
    <span>{{ $message ?? session($session)}}</span>
</div>
