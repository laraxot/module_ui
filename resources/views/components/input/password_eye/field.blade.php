{{-- <input type="password" {{ $attributes->merge($attrs) }} /> --}}
<div class="row">
    <div class="col-10">
        <input type="password" id="password" name="password" class="form-control" />
    </div>
    <div class="col-2 ps-0">
        <i class="bi bi-eye-slash" id="togglePassword" style="font-size: 30px;"></i>
        {{-- <i class="bi bi-eye-slash-fill" id="togglePassword"></i> --}}
    </div>
</div>



@push('scripts')
    <script>
        window.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.querySelector("#togglePassword");

            togglePassword.addEventListener("click", function(e) {
                // toggle the type attribute
                const type =
                    password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);
                // toggle the eye / eye slash icon
                this.classList.toggle("bi-eye");
            });
        });
    </script>
@endpush
