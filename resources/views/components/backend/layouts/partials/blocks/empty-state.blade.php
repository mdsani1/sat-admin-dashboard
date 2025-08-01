@props([
    'title' => 'Default Title',
    'message' => 'Default message',
    'buttonText' => 'Create',
    'buttonRoute' => null, // Now can be either a URL or a modal ID
    'class' => "create-btn"
])

<div class="flex flex-col items-center align-content-center justify-center min-h-screen" style="height: 80vh">
    <div class="text-center" style="position: relative">
        <img src="{{ asset('image/loading.png') }}" alt="Loading Image" class="mb-4" style="opacity: 0.4">
        <div class="text-section">
            <h2 class="text-xl font-semibold" style="font-size: 24px; font-weight:900px">
                <b>{{ $title }}</b>
            </h2>
            <p style="color: #475467; font-size:16px">{{ $message }}</p>
            <a 
                @if(str_starts_with($buttonRoute, '#')) 
                    href="javascript:void(0)" data-toggle="modal" data-target="{{ $buttonRoute }}" 
                @else 
                    href="{{ $buttonRoute }}" 
                @endif
                class="btn text-white px-4 py-2 flex items-center justify-center mx-auto {{ $class }}"
                style="background-color:#732066; font-size: 12px; border-radius: 8px; width: max-content;">
                <i class="fas fa-plus text-xs mr-1"></i> {{ $buttonText }}
            </a>
        </div>
    </div>
</div>


@push('css')
    <style>
        .text-section {
            position: absolute;
            top: 54%;
            /* left: 38%; */
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
        }
    </style>
@endpush
 