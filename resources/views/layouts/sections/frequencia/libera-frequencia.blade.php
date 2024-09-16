@if ($countSenha == 0)
    <h5 class="card-title text-primary"><i class='bx bxs-lock-open' ></i> Liberar Frequência</h5>
    <p class="card-text mb-2">
        Permite que os alunos registrem a frequência.
    </p>
    <form action="/minhas-aulas/{{$modulo_id}}/{{$aula_id}}/liberar-senha" method="POST">
        @csrf

        <div class="row">
            <div class="col-9">
                <div class="form-group">
                    <input type="text" required name="senha" id="senha" placeholder="Informe uma senha" class="form-control">
                </div>
            </div>
            <div class="col-3 p-0">
                <input type="submit" class="w-100 btn btn-primary" value="Liberar" />
            </div>
        </div>

        <input type="hidden" name="id_aula" value="{{$aula_id}}">
        <input type="hidden" name="id_modulo" value="{{$modulo_id}}">
    </form>
    @else
    <h5 class="card-title text-primary"><i class='bx bxs-lock-open' ></i> Frequência liberada</h5>
    <p class="card-text mb-2">
        Informe a senha de frequência para a turma:
    </p>
    <h5 class="m-0 p-0">{{$paramsSenha}}</h5>
@endif