<x-mail::message>
    {{-- Greeting --}}
    @if (! empty($greeting))
    # {{ $greeting }}
    @else
    @if ($level === 'error')
    # @lang('Whoops!')
    @else
    # @lang('Hello!')
    @endif
    @endif

    {{-- Intro Lines --}}
    @foreach ($introLines as $line)
    {{ $line }}

    @endforeach

    {{-- Action Button --}}
    @isset($actionText)
    <?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
    ?>
    <x-mail::button :url="$actionUrl" :color="$color">
        {{ $actionText }}
    </x-mail::button>
    <a class="btn text-white btn-primary" href="{{$actionUrl}}"> {{ $actionText }} </a>
    @endisset

    {{-- Outro Lines --}}
    @foreach ($outroLines as $line)
    {{ $line }}

    @endforeach


    Thanks & Regards,
    {{ config('app.name') }} Team


    {{-- Subcopy --}}
    @isset($actionText)
    <x-slot:subcopy>
        @lang(
        "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
        'into your web browser:',
        [
        'actionText' => $actionText,
        ]
        ) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
    </x-slot:subcopy>
    @endisset
</x-mail::message>