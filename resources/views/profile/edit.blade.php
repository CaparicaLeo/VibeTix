@extends('layouts.app')

@section('title', 'Perfil')

@section('content')
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Meu Perfil</h1>
                <p class="text-gray-600 mt-2">Gerencie suas informações pessoais e configurações de conta</p>
            </div>

            <div class="space-y-6">

                <!-- Card: Informações do Perfil -->
                <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-900">Informações do Perfil</h2>
                        <p class="text-sm text-gray-600 mt-1">Atualize as informações da sua conta e endereço de e-mail</p>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Card: Atualizar Senha -->
                <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-900">Atualizar Senha</h2>
                        <p class="text-sm text-gray-600 mt-1">Certifique-se de usar uma senha longa e aleatória para manter
                            sua conta segura</p>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Card: Deletar Conta -->
                <div class="bg-white shadow-sm rounded-xl overflow-hidden border-2 border-red-100">
                    <div class="px-6 py-4 border-b border-red-200 bg-red-50">
                        <h2 class="text-lg font-semibold text-red-900">Zona de Perigo</h2>
                        <p class="text-sm text-red-700 mt-1">Excluir permanentemente sua conta e todos os dados associados
                        </p>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
