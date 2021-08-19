@php

use Symfony\Component\HttpFoundation\Session\Session;

@endphp
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert" id="alert">
        <strong> {{ session('success') }} </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@elseif (session('error'))
    <div class="alert alert-error alert-dismissible fade show text-center" role="alert" id="alert">
        <strong> {{ session('error') }} </strong>
        {{-- error --}}
        @if ($errors->any())
            <div class="alert alert-danger text-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<script>
    setTimeout(() => {
        $('#alert').slideUp();
    }, 4000);
</script>
