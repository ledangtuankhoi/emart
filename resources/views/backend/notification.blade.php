@php

use Symfony\Component\HttpFoundation\Session\Session;

@endphp
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong> {{ session('success') }} </strong>
        You should check in on some of those fields below.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@elseif (session('error'))
<div class="alert alert-error alert-dismissible fade show" role="alert">
    <strong> {{ session('error') }} </strong>
    You should check in on some of those fields below.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
