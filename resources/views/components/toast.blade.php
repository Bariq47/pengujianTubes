@props(['message', 'alert'])

<div class="toast-container position-fixed top-0 end-0 p-3" id="toast">
    <div class="toast align-items-center text-white bg-{{ $alert }} border-0 show" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ $message }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
</div>
