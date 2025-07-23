
# Plano de Projeto – CapitalMaster

## 🧭 Visão Geral
**Objetivo:** Criar um sistema web onde o usuário possa:
- Controlar gastos e receitas.
- Gerenciar investimentos (ações, FIIs, renda fixa, etc.).
- Acompanhar a variação da bolsa de valores em tempo real.
- Ter uma visão consolidada da sua saúde financeira.

## 🧩 Funcionalidades Principais

### 📊 Dashboard Financeiro
- Saldo atual consolidado
- Gráfico de receitas e despesas
- Variação de patrimônio
- Resumo de investimentos

### 💰 Controle de Gastos
- Cadastro de categorias (alimentação, moradia, transporte…)
- Inserção de despesas/receitas recorrentes e pontuais
- Relatórios mensais e anuais

### 📈 Gestão de Investimentos
- Cadastro manual de ativos: ações, FIIs, tesouro direto, etc.
- Integração com APIs (ex: Alpha Vantage, B3, Yahoo Finance) para cotação atualizada
- Lançamento de compras, vendas, dividendos e proventos
- Histórico de rentabilidade

### 📉 Acompanhamento da Bolsa
- Ticker ao vivo com cotações dos principais índices e ativos
- Notícias relacionadas ao mercado financeiro
- Alertas de variação de preços ou eventos relevantes

### 👤 Área do Usuário
- Cadastro/Login com autenticação segura
- Perfil com metas financeiras
- Configuração de notificações

## 🧱 Estrutura Técnica

### 🔧 Backend
- **Framework**: Laravel
- **Banco de dados**: MySQL ou PostgreSQL
- **APIs de cotação**: Alpha Vantage, Yahoo Finance, Twelve Data, etc.
- **Autenticação**: Laravel Breeze/Fortify ou Laravel Sanctum

### 🎨 Frontend
- **Blade com Alpine.js e Tailwind CSS** ou **Inertia.js com Vue/React**
- Dashboard com gráficos (ex: Chart.js ou ApexCharts)

### 🗄️ Banco de Dados
Tabelas principais:
- users
- transactions
- investment_accounts
- investments
- asset_prices
- goals
- notifications

## 🛣️ Roadmap do Projeto

### Fase 1 – Planejamento
- Levantamento de requisitos
- Criação do layout (wireframes)
- Definição de tecnologias e stack
- Estruturação inicial do repositório

### Fase 2 – MVP Financeiro
- Sistema de autenticação
- Cadastro de receitas/despesas
- Relatório mensal de transações
- Dashboard simples com saldo e gráfico

### Fase 3 – Módulo de Investimentos
- Cadastro de ativos e operações
- Cálculo de rentabilidade
- Integração com API para cotações
- Gráficos de performance

### Fase 4 – Bolsa em Tempo Real
- Tela de acompanhamento de ativos
- Integração com feed de notícias
- Alertas de variação

### Fase 5 – Ajustes Finais e Deploy
- Testes
- Otimizações
- Documentação
- Deploy na nuvem

## ✅ Extras (versões futuras)
- Exportação de relatórios (PDF/Excel)
- Aplicativo mobile com Flutter
- Reconhecimento automático de extratos
- Módulo de metas com gamificação
- Modo “planejamento financeiro para casais”
- Reconhecimento de extrato bancário via OCR

## 🧠 Boas Práticas
- Versionamento com Git
- Commits claros e padronizados
- Testes (unitários e funcionais)
- Deploy contínuo (CI/CD)
- Segurança: criptografia de senhas, proteção CSRF/XSS

## 📌 Dicas Rápidas
- Use Telescope e Laravel Debugbar para debugar
- Comece com dados mockados antes de integrar as APIs
- Use jobs para atualizações de preços em background
- Crie seeds e factories para popular dados de testes
