# Requisitos do MVP – CapitalMaster

## Requisitos Funcionais (RF)

**RF01** – O sistema deve permitir que o usuário se cadastre e faça login com autenticação segura.  
**RF02** – O sistema deve permitir o cadastro de receitas e despesas, tanto recorrentes quanto pontuais.  
**RF03** – O sistema deve permitir a categorização de transações (ex: alimentação, moradia, transporte).  
**RF04** – O sistema deve exibir um dashboard com o saldo consolidado atual.  
**RF05** – O sistema deve gerar um gráfico simples de receitas vs despesas (pizza ou barras).  
**RF06** – O sistema deve permitir consultar as transações filtrando por período (ex: mês atual).  
**RF07** – O sistema deve exibir um relatório mensal com o total de receitas, despesas e saldo final.  

## Requisitos Não Funcionais (RNF)

**RNF01** – A aplicação deve ser responsiva e adaptável a dispositivos móveis.  
**RNF02** – O sistema deve utilizar Laravel no backend e Tailwind CSS/Alpine.js no frontend.  
**RNF03** – O banco de dados utilizado deve ser MySQL ou PostgreSQL.  
**RNF04** – O sistema deve ter autenticação segura usando Laravel Breeze ou Fortify.  
**RNF05** – O projeto deve seguir boas práticas de versionamento com Git.  
**RNF06** – O layout deve ser iniciado com wireframes simples como base.  

## Estrutura Inicial do Banco de Dados (EXEMPLO)

- **users**  
  Campos: id, name, email, password, created_at, updated_at

- **categories**  
  Campos: id, name, user_id, type (receita/despesa), created_at, updated_at

- **transactions**  
  Campos: id, user_id, category_id, type (receita/despesa), amount, description, date, is_recurring, created_at, updated_at

## Fora do Escopo do MVP

- Módulo de investimentos (ações, FIIs, etc.)  
- Integrações com APIs externas de cotação  
- Alertas de variação ou metas financeiras  
- Aplicativo mobile 
- OCR de extrato bancário  
- Bolsa em tempo real ou feed de notícias
