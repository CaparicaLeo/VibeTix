@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">Meu Perfil</h1>
        <p class="text-purple-200">Gerencie suas informações pessoais e configurações</p>
    </div>

    <div class="space-y-6">
        <!-- Update Profile Information -->
        <div class="bg-white rounded-xl p-8 shadow-lg">
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Update Password -->
        <div class="bg-white rounded-xl p-8 shadow-lg">
            @include('profile.partials.update-password-form')
        </div>

        <!-- Delete Account -->
        <div class="bg-white rounded-xl p-8 shadow-lg">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
