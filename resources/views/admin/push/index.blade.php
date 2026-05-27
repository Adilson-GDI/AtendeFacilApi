@extends('admin.layouts.app')

@section('title', 'Push - Atende Fácil')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Envio de Push</h1>
</div>

<div class="row">

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Dispositivos ativos
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{ $totalTokens ?? 0 }}
                </div>
            </div>
        </div>
    </div>

</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Nova notificação</h6>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.push.send') }}">
            @csrf

            <div class="form-group">
                <label>Título</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Mensagem</label>
                <textarea name="body" class="form-control" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label>Imagem URL</label>
                <input type="text" name="image_url" class="form-control">
            </div>

            <div class="form-group">
                <label>Destino</label>
                <select name="target_type" id="target_type" class="form-control" required>
                    <option value="all">Todos</option>
                    <option value="token">Token específico</option>
                    <option value="topic">Grupo / Topic</option>
                </select>
            </div>

            <div class="form-group d-none" id="token_box">
                <label>Token</label>
                <textarea name="token_value" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group d-none" id="topic_box">
                <label>Topic</label>
                <input type="text" name="topic_value" class="form-control">
            </div>

            <div class="form-group">
                <label>Ação ao clicar</label>
                <select name="action_type" class="form-control">
                    <option value="">Nenhuma</option>
                    <option value="open_page">Abrir página</option>
                    <option value="open_url">Abrir URL</option>
                    <option value="open_whatsapp">Abrir WhatsApp</option>
                    <option value="open_project">Abrir projeto</option>
                </select>
            </div>

            <div class="form-group">
                <label>Valor da ação</label>
                <input type="text" name="action_value" class="form-control"
                       placeholder="Ex: projetos, https://site.com, 5511999999999 ou ID do projeto">
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Enviar Push
            </button>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Histórico de envios</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Mensagem</th>
                        <th>Destino</th>
                        <th>Sucesso</th>
                        <th>Erro</th>
                        <th>Data</th>
                        <th width="100">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->title }}</td>
                            <td>{{ Str::limit($log->body, 80) }}</td>
                            <td>{{ $log->target_type }}</td>
                            <td>{{ $log->total_success ?? 0 }}</td>
                            <td>{{ $log->total_error ?? 0 }}</td>
                            <td>{{ optional($log->sent_at)->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.push.resend', $log->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    Reenviar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                Nenhum push enviado ainda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const targetSelect = document.getElementById('target_type');
    const tokenBox = document.getElementById('token_box');
    const topicBox = document.getElementById('topic_box');

    function updateTargetFields() {
        tokenBox.classList.add('d-none');
        topicBox.classList.add('d-none');

        if (targetSelect.value === 'token') {
            tokenBox.classList.remove('d-none');
        }

        if (targetSelect.value === 'topic') {
            topicBox.classList.remove('d-none');
        }
    }

    targetSelect.addEventListener('change', updateTargetFields);
    updateTargetFields();
</script>
@endpush