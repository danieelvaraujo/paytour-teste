## Requisitos do Teste

    Criar um formulário para envio de currículos
    Criar os testes unitários para sua aplicação

### Parâmetros de entrada

    Nome
    E-mail
    Telefone
    Cargo Desejado (Campo texto livre)
    Escolaridade (Campo select)
    Observações (Opcional)
    Arquivo
    Data/hora do envio.

### Regras

    - O formulário deve ser validado
    - Não devem ser aceitos arquivos que não possuam as seguintes extensões: .doc, .docx ou .pdf
    - O tamanho máximo do arquivo é de 1MB
    - Use o PSR-2 como padrão de codificação
    - As bibliotecas devem ser carregadas via composer
    - Os dados devem ser armazenados em um banco de dados.
        - O IP e a data e hora do envio devem ficar registrados
    - Um e-mail deve ser enviado com os dados do formulário
