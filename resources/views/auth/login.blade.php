@vite(['resources/css/app.css', 'resources/js/app.js'])
@include('layouts.navbar')

<div class="bg-light d-flex align-items-center justify-content-center vh-100">
    <main class="form-signin w-100" style="max-width: 360px;">
        <h4 class="text-center text-secondary">LOGIN </h4>
        <form class="text-center p-4 bg-white" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-floating">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="floatingInput">
                <label for="floatingInput">Email</label>
            </div>

            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingInput">
                <label for="floatingInput">Senha</label>
            </div>

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <button class="btn btn-primary w-100" type="submit">Entrar</button>
        </form>
    </main>
</div>
