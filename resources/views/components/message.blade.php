<div class="flex w-full items-center justify-center z-50">
    @if(session('message'))
        <div id="session-message"
             class="px-4 py-3 text-white text-center transition-transform duration-500 bg-green-500"
             style="transform: translateY(-100%);">
            {{ session('message') }}
        </div>
    @endif

    @if(session('error'))
        <div id="session-error"
             class="px-4 py-3 text-white text-center transition-transform duration-500 bg-red-500"
             style="transform: translateY(-100%);">
            {{ session('error') }}
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const message = document.getElementById('session-message');
        const error = document.getElementById('session-error');

        [message, error].forEach(banner => {
            if (banner) {
                // Slide in the banner
                banner.style.transform = 'translateY(0)';

                // Remove after 10 seconds
                setTimeout(() => {
                    banner.style.transform = 'translateY(-1000%)';
                }, 10000);
            }
        });
    });
</script>
