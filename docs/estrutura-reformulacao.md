# Estrutura da Reformulacao do BarberHub

Este documento organiza a evolucao do BarberHub antes das mudancas visuais e funcionais maiores. A base atual ja tem Laravel, Blade, autenticacao propria, perfis por `cargo`, CRUDs administrativos e agendamentos com validacao de conflito.

## Objetivo

Melhorar o projeto de ponta a ponta, com foco em:

- login mais claro, seguro e consistente;
- cadastro de cliente mais fluido;
- agenda mais completa para administrador, barbeiro e cliente;
- separacao melhor entre regras de negocio, telas e rotas;
- experiencia visual consistente em todo o sistema.

## Perfis e Fluxos

### Administrador

Responsavel por gestao completa da barbearia.

- Acessa dashboard geral.
- Gerencia clientes, barbeiros e servicos.
- Cria, edita, cancela e conclui agendamentos.
- Visualiza agenda geral por dia, semana e barbeiro.
- Emite relatorios.

### Barbeiro

Responsavel pela propria agenda.

- Acessa dashboard com proximos atendimentos.
- Visualiza somente seus agendamentos.
- Atualiza status do atendimento.
- Consulta historico de clientes atendidos.

### Cliente

Responsavel por acompanhar e, futuramente, solicitar agendamentos.

- Cria conta pelo cadastro publico.
- Acessa painel com proximos horarios.
- Visualiza historico.
- Em etapa posterior, pode solicitar ou criar agendamento conforme regras da barbearia.

## Organizacao Tecnica Proposta

### Rotas

Manter as rotas por grupos claros:

- `auth`: login, cadastro e logout.
- `admin`: dashboard, CRUDs, agenda geral e relatorios.
- `barbeiro`: dashboard e agenda propria.
- `cliente`: dashboard, agenda propria e solicitacao de horario.

Hoje muitas rotas ficam juntas em `routes/web.php`. A primeira melhoria sera reorganizar nomes, middlewares e responsabilidades sem quebrar URLs existentes quando possivel.

### Controllers

Separar CRUD administrativo de fluxos de usuario:

- `AuthController`: login, cadastro e logout.
- `Admin/DashboardController`: metricas do administrador.
- `Admin/AgendaController`: agenda geral e CRUD administrativo.
- `Barbeiro/DashboardController`: resumo do barbeiro.
- `Barbeiro/AgendaController`: agenda do barbeiro e status.
- `Cliente/DashboardController`: resumo do cliente.
- `Cliente/AgendaController`: agenda do cliente e futura solicitacao.

### Services

Criar uma camada pequena para regras de agenda:

- `AgendaService`
  - calcular horario final a partir do servico;
  - validar conflito de horario;
  - listar horarios disponiveis;
  - centralizar regras de cancelamento e conclusao.

Isso evita duplicar regra dentro de `StoreAgendamentoRequest`, `UpdateAgendamentoRequest` e controllers.

### Requests

Manter validacoes de formulario em Form Requests:

- `StoreAgendamentoRequest`
- `UpdateAgendamentoRequest`
- `StoreClienteRequest`
- `StoreServicoRequest`

Depois da criacao do `AgendaService`, os requests validam formato e permissoes; a regra de conflito passa a ser reaproveitavel.

### Models

Base atual:

- `User`: perfis `administrador`, `barbeiro`, `cliente`.
- `Cliente`: dados cadastrais e vinculo opcional com `users`.
- `Servico`: nome, descricao, preco e duracao.
- `Agendamento`: cliente, barbeiro, servico, inicio, fim e status.

Melhorias futuras possiveis:

- enum PHP para cargos e status;
- campos de observacao no agendamento;
- horarios de funcionamento da barbearia;
- bloqueios/folgas por barbeiro;
- status extra como `pendente` se cliente puder solicitar horario.

## Agenda Nova

### Primeira versao

- Tela principal em formato de agenda diaria.
- Filtros por data, barbeiro, status e servico.
- Cards ou linhas agrupadas por horario.
- Acoes rapidas: editar, cancelar, concluir.
- Destaque para conflitos e proximos atendimentos.

### Segunda versao

- Visao semanal.
- Horarios disponiveis calculados automaticamente.
- Cliente escolhe servico, barbeiro e horario.
- Duracao do servico define `data_hora_fim`.
- Bloqueio de horarios fora do expediente.

## Login e Cadastro

### Login

- Extrair layout visual comum para evitar CSS duplicado.
- Corrigir textos com acentuacao quebrada.
- Melhorar mensagens de erro e estados de carregamento.
- Preservar redirecionamento por cargo.

### Cadastro

- Manter criacao de `User` e `Cliente` na mesma transacao.
- Melhorar mascaras/formatacao de CPF e telefone.
- Validar email e CPF com mensagens mais humanas.
- Preparar cadastro para futura etapa de primeiro agendamento.

## UI e CSS

Hoje ha CSS espalhado entre views e arquivos em `public/css`. A proposta e usar Bootstrap CSS/JS como base de grid, responsividade, componentes e comportamento, mas com uma camada visual propria para o BarberHub.

### Direcao visual

- Clean, profissional e direto ao ponto.
- Identidade de barbearia premium, sem parecer tema generico de dashboard.
- Menos efeitos decorativos e mais hierarquia, espaco, contraste e microinteracoes uteis.
- Interface boa para uso diario: rapido de escanear, facil de clicar e consistente entre telas.
- Bootstrap como fundacao, com tokens proprios de cor, borda, sombra, espacamento e tipografia.

### Padroes de interface

- Layout principal com sidebar, topbar e conteudo responsivo.
- Cards usados para informacoes reais, nao como decoracao excessiva.
- Tabelas mais limpas, com filtros visiveis e acoes claras.
- Formularios com labels consistentes, validacao clara e estados de foco/erro/sucesso.
- Botoes com hierarquia: primario, secundario, perigo e acao discreta.
- Chips de status padronizados para `agendado`, `concluido` e `cancelado`.
- Modais Bootstrap para confirmacoes e acoes rapidas quando fizer sentido.
- Tooltips Bootstrap em icones e botoes compactos.

### Bootstrap CSS e JS

- Manter Bootstrap como dependencia visual principal.
- Usar componentes Bootstrap quando forem apropriados: grid, nav, dropdown, modal, tooltip, alert, badge, button groups e forms.
- Evitar sobrescrever Bootstrap de forma caotica; criar classes do projeto como `bh-card`, `bh-button`, `bh-status`, `bh-table` e `bh-toolbar`.
- Centralizar customizacoes em arquivos CSS proprios em vez de estilos inline nas views.

### Organizacao proposta de estilos

- `public/css/componentes.css`: base do painel autenticado, tokens visuais e componentes do sistema.
- `public/css/autenticacao.css`: telas de login e cadastro.
- `public/js/interface.js`: inicializacao de tooltips, confirmacoes, estados de envio e pequenos comportamentos Bootstrap.

### Experiencia por area

- Login e cadastro: visual forte, acolhedor e confiavel, com menos texto e formularios mais confortaveis.
- Dashboard admin: leitura rapida de indicadores, agenda do dia e atalhos claros.
- Agenda: tela de trabalho, com filtros bons, agrupamento por horario e acoes rapidas.
- Barbeiro: foco no proximo atendimento e na lista do dia.
- Cliente: simples, com proximos horarios, historico e status sem poluicao.

## Ordem Recomendada de Execucao

1. Ajustar estrutura de rotas, controllers e layouts sem mudar comportamento.
2. Extrair regra de agenda para `AgendaService`.
3. Criar a base visual Bootstrap do sistema: tokens, componentes e JS de UI.
4. Melhorar login e cadastro usando layout comum.
5. Refazer tela de agenda administrativa.
6. Melhorar agenda do barbeiro.
7. Melhorar painel do cliente.
8. Adicionar solicitacao de agendamento pelo cliente, se desejado.
9. Criar testes focados em login, cadastro e conflito de agenda.

## Criterios de Pronto

- Login redireciona corretamente administrador, barbeiro e cliente.
- Cadastro cria `users` e `clientes` de forma consistente.
- Agenda bloqueia conflito de horario.
- Barbeiro ve apenas seus agendamentos.
- Cliente ve apenas os proprios agendamentos.
- Admin consegue gerenciar a agenda completa.
- Layout fica consistente entre autenticacao e painel.
- UI usa Bootstrap de forma consistente, com identidade propria do BarberHub.
- Telas ficam responsivas, limpas e sem aparencia generica.
