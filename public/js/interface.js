document.addEventListener('DOMContentLoaded', () => {
    if (window.bootstrap) {
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach((elemento) => {
            new bootstrap.Tooltip(elemento);
        });
    }

    document.querySelectorAll('[data-confirmacao]').forEach((elemento) => {
        elemento.addEventListener('click', (evento) => {
            const mensagem = elemento.getAttribute('data-confirmacao') || 'Confirmar esta acao?';

            if (!window.confirm(mensagem)) {
                evento.preventDefault();
            }
        });
    });

    document.querySelectorAll('form[data-formulario-carregando]').forEach((formulario) => {
        formulario.addEventListener('submit', () => {
            const botao = formulario.querySelector('[type="submit"]');

            if (!botao) {
                return;
            }

            botao.disabled = true;
            botao.dataset.textoOriginal = botao.innerHTML;
            botao.innerHTML = '<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span>Salvando...</span>';
        });
    });

    document.querySelectorAll('[data-enviar-formulario]').forEach((elemento) => {
        elemento.addEventListener('click', () => {
            const seletor = elemento.getAttribute('data-enviar-formulario');
            document.querySelector(seletor)?.submit();
        });
    });

    document.querySelectorAll('[data-formulario-agenda]').forEach((formulario) => {
        const servico = formulario.querySelector('[data-servico-agenda]');
        const inicio = formulario.querySelector('[data-inicio-agenda]');
        const fim = formulario.querySelector('[data-fim-agenda]');

        if (!servico || !inicio || !fim) {
            return;
        }

        const atualizarFim = () => {
            const duracao = Number(servico.selectedOptions[0]?.dataset.duracao || 0);

            if (!duracao || !inicio.value) {
                return;
            }

            const data = new Date(inicio.value);
            data.setMinutes(data.getMinutes() + duracao);
            fim.value = formatarDataHoraLocal(data);
        };

        servico.addEventListener('change', atualizarFim);
        inicio.addEventListener('change', atualizarFim);
    });
});

function formatarDataHoraLocal(data) {
    const pad = (valor) => String(valor).padStart(2, '0');

    return [
        data.getFullYear(),
        pad(data.getMonth() + 1),
        pad(data.getDate()),
    ].join('-') + 'T' + [
        pad(data.getHours()),
        pad(data.getMinutes()),
    ].join(':');
}
