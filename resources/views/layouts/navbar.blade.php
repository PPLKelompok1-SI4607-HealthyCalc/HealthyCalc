<div class="d-flex justify-content-around">
    <p class="my-auto px-4 fw-bold fs-4">
        <img src="/img/Logo.svg" alt="">
        HealthyCalc
    </p>
</div>
<h4 class="my-auto px-4">
    @auth
        <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #009879; padding: 4px;">
            <img src="{{ asset('img/' . ($userProfile->photo ?? 'user_profile.jpeg')) }}" alt="Profil"
                style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%; border: 2px solid white;">
        </div>
    @else
        @guest
            <div class="d-flex justify-content-end">
                <a href="/login" class="btn btn-light me-2">Login</a>
                <a href="/register" class="btn btn-light">Register</a>
            </div>
        @endguest
    @endauth
</h4>
