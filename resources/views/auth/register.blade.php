<x-guest-layout>
    @section('auth')
      <x-validation-errors class="mb-4" />
    <!-- 📝 2. FORMULÁRIO DE CRIAR CONTA -->
        <div id="form-registo" class="auth-form active">
            <div class="auth-header">
                <div class="logo-icon"><i class="fa-solid fa-user-plus"></i></div>
                <h2>Criar uma conta</h2>
                <p>Registe-se para explorar e gerir os cursos</p>
            </div>

            <form ection="{{route('register')}}" method="post">
                  @csrf
                <div class="form-group">
                    <label for="registo-nome">Nome Completo</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" id="registo-nome" name="name" class="form-control" placeholder="Ex: Marta Santos" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="registo-email">Endereço de E-mail</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" id="registo-email" name="email" class="form-control" placeholder="seu-email@provedor.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="registo-password">Palavra-passe</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="registo-password" name="password" class="form-control" placeholder="Mínimo 6 caracteres" minlength="6" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="registo-password">Confirmar Palavra-passe</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="registo-password"  name="password_confirmation"  class="form-control" placeholder="Mínimo 6 caracteres" minlength="6" required>
                    </div>
                </div>

                <div class="form-options">
                    <label style="cursor: pointer;">
                        <input type="checkbox" required> Aceito os Termos de Utilização
                    </label>
                </div>

                <button type="submit" class="btn-submit" style="background-color: #10b981;">
                    Finalizar Registo <i class="fa-solid fa-user-check"></i>
                </button>
            </form>

            <div class="auth-footer">
                Já tem uma conta? <button><a href="{{route('login')}}">Fazer Login</a></button>
        
            </div>
                    
        </div>

    @endsection
</x-guest-layout>
