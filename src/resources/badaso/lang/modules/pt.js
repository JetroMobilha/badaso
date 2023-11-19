export const label = "Portugues";

export default {
  button: {
    close: "Fechar",
    submit: "Enviar",
  },
  vuelidate: {
    required: "* {0} é necessário.",
    requiredIf: "* {0} é necessário.",
    integer: "* {0} deve ser inteiro.",
    rowsRequired: "* Por favor, preencha o campo.",
    maxLength: "* {field} deve ter no máximo {length} Carateris.",
    alphaNum: "* {0} não é alfanumérico.",
    alphaNumAndUnderscoreValidator:
      "* {0} apenas alfanumérico e sublinhado (_) permitido.",
    unique: "* {0} deve ser único.",
    distinct: "* Apenas um {0} é permitido.",
    requiredPrimary: "* Apenas {0}  é permitido.",
  },
  login: {
    title: "Painel",
    subtitle: "Bem-vindo de volta, faça o login na sua conta.",
    field: {
      email: "E-mail",
      password: "Senha",
    },
    rememberMe: "Lembre de mim?",
    forgotPassword: "Esqueceu sua senha",
    button: "Conecte-se",
    createAccount: {
      text: "Não tem uma conta?",
      link: "Crie a sua conta aqui",
    },
  },

  register: {
    title: "Registre-se aqui",
    subtitle: "por favor preencha o formulário abaixo.",
    field: {
      name: "Nome",
      username: "Nome de usuário",
      phone: "Telefone",
      address: "Endereço",
      email: "E-mail",
      password: "Senha",
      passwordConfirmation: "ConfirmaÇão Da Senha",
      gender: "Gênero",
    },
    button: "Registro",
    existingAccount: {
      text: "Você tem uma conta?",
      link: "Conecte-se",
    },
    gender: {
      man: "Homen",
      woman: "Mulher",
    },
  },

  forgotPassword: {
    title: "Esqueceu sua senha",
    subtitle: "Forneça um e-mail para enviar o e-mail de redefinição de senha.",
    field: {
      email: "E;mail",
    },
    button: "Enviar",
    createAccount: {
      text: "Não tem uma conta?",
      link: "Crie a sua conta aqui",
    },
    message: {
      success:
        "Um e-mail foi enviado para o endereço que você forneceu. Siga o link no e-mail para concluir sua solicitação de redefinição de senha.",
      error:
        "Ocorreu um erro. Verifique novamente o e-mail que você forneceu. Se o problema persistir, entre em contato conosco para obter mais assistência.",
    },
  },

  resetPassword: {
    title: "Redefinir senha",
    subtitle: "Forneça uma nova senha.",
    field: {
      password: "Nova Senha",
      passwordConfirmation: "Confirmação  da nova Senha",
    },
    button: "Redefinir senha",
    createAccount: {
      text: "Não tem uma conta?",
      link: "Crie a sua conta aqui",
    },
    message: {
      success:
        "Redefinição de senha bem-sucedida. Agora você pode fazer o login com a nova senha. Agora você será redirecionado para a página de login.",
      error:
        "Ocorreu um erro. Verifique novamente a senha e a confirmação da senha que você forneceu. Se o problema persistir, entre em contato conosco para obter mais assistência.",
    },
  },

  verifyEmail: {
    title: "verificação de e-mail",
    failed: "Verificação de e-mail em andamento ....",
    button: "Verificar",
    request: "Reenviar",
    field: {
      token: "Símbolo",
    },
    message: {
      inProgress: "Verificação de e-mail em andamento ....",
      success:
        "Um e-mail foi enviado para o endereço que você forneceu. Siga o link no e-mail para concluir sua verificação de e-mail.",
      error: "A verificação do e-mail falhou.",
    },
  },

  sidebar: {
    dashboard: "Painel",
    mainMenu: "Menu principal",
    configurationMenu: "Menu de Configuração",
  },

  myProfile: {
    title: "Meu perfil",
    username: "Nome de usuário",
    logout: "Sair",
    profile: "Perfil",
    email: "Email",
    password: "Senha",
    oldPassword: "Corrente Senha",
    newPassword: "Nova Senha",
    newPasswordConfirmation: "Confirmação da nova Senha",
    name: "Nome",
    avatar: "Avatar",
    phone: "Numero Telefone",
    address: "Endereço",
    gender: "Gênero",
    additionalInfo: "Informações adicionais (opcional)",
    token: "Código de verificação",
    buttons: {
      updateProfile: "Atualizar perfil",
      updateEmail: "Update Email",
      verifyEmail: "Verificar e-mail",
      changePassword: "Alterar a senha",
    },
  },

  404: {
    title: "Ops, desculpe",
    subtitle: "A página que você estava procurando não foi encontrada.",
    button: "Ir para casa",
  },

  action: {
    bulkDelete: "Excluir em massa",
    bulkRestore: "Restauração em massa",
    showTrash: "Mostrar Lixeira",
    add: "Adicionar",
    edit: "Editar",
    delete: {
      title: "Confirme",
      text: "Tem certeza?",
      accept: "Aceitar",
      cancel: "Cancel",
    },
    restore: {
      title: "Confirme",
      text: "Tem certeza de restaurar?",
      accept: "Aceitar",
      cancel: "Cancel",
    },
    addItem: "Adicionar Item",
    roles: "Funções",
    sort: "Organizar",
    rollbackMigration: {
      title: "Migração de reversão",
      text: "Tem certeza?",
      accept: "Aceitar",
      cancel: "Cancel",
    },
    exportToExcel: "Exportar para .xls",
    exportToPdf: "Exportar para .pdf",
  },

  alert: {
    success: "Sucesso",
    danger: "Perigo",
    error: "Erro",
  },

  activityLog: {
    title: "Registro de atividade",
    warning: {
      notAllowed: "Você não tem permissão para navegar no Log de atividades.",
    },
    header: {
      logName: "Nome do registro",
      causerType: "Causer Type",
      causerId: "ID do Causador",
      causerName: "Nome do Causador",
      subjectType: "Tipo de Assunto",
      subjectId: "ID do Assunto",
      description: "Descrição",
      dateLogged: "Data registrada",
      action: "Ação",
    },
    footer: {
      descriptionTitle: "Registries",
      descriptionConnector: "de",
      descriptionBody: "Páginas",
    },
    detail: {
      title: "Log de atividades detalhadas",
      causer: {
        title: "Detalha da Causa",
      },
      subject: {
        title: "Detalhe do Assunto",
      },
      properties: {
        title: "Propriedades",
      },
    },
  },

  site: {
    action: "Ação",
    deletedImage: {
      title: "Imagem deletada",
      text: "A imagem selecionada foi excluída com sucesso",
    },
    configUpdated: "Configuração atualizada",
    add: {
      title: "Adicionar configuração do site",
      field: {
        displayName: {
          title: "Nome de exibição",
          placeholder: "Exemplo: Nome de exibição",
        },
        key: {
          title: "Chave",
          placeholder: "Exemplo: Chave_Exemplo",
        },
        type: {
          title: "Tipo",
          placeholder: "Tipo",
        },
        group: {
          title: "Grupo",
          placeholder: "Grupo",
        },
        options: {
          title: "Opção",
          description:
            "As opções são necessárias para caixa de seleção, rádio, seleção, seleção múltipla. Exemplo:",
          example: `{"items": [{"label":"This is label","value":"this_is_value"}] }`,
        },
      },
      button: "Salvar",
    },
    edit: {
      multiple: "Atualizar Configurações",
    },
    maintenanceMode: "A configuração de manutenção é somente leitura."
  },

  crud: {
    title: "CRUD",
    data: {
      switchDataRecycle: "Mostrar Dados de Reciclagem",
      switchDataNormal: "Mostrar dados normais",
    },
    help: {
      generatePermissions:
        "Irá gerar permissão para o CRUD criado. As permissões geradas são: browse_{table_name}, read_{table_name}, edit_{table_name}, add_{table_name}, delete_{table_name} e maintenance_{table_name}.",
      serverSide:
        "Defina a paginação ao navegar para o lado do servidor ou lado do cliente. Se você tiver poucos dados, basta desativá-lo e vice-versa.",
      createSoftDelete:
        "Mude para Ativado se desejar um recurso como a lixeira. Você pode recuperar os dados excluídos. Irá criar soft delete se a tabela for suportada.",
      activeEventNotificationTitle:
        "Isso mostrará uma notificação na barra lateral direita se o evento de ação abaixo estiver definido. Configure a notificação por push do firebase antes de usar este recurso.",
      modelName:
        "Preencha esta entrada se desejar substituir o Modelo CRUD. Por exemplo: App\\Models\\User.",
      controllerName:
        "Preencha esta entrada se desejar substituir o Controlador CRUD. Por exemplo: App\\Http\\Controller\\HomeController. Você pode substituir um dos seguintes métodos: navegar, todos, ler, editar, adicionar, excluir, restaurar, deleteMultiple, restoreMultiple, classificar ou setMaintenanceState.",
    },
    warning: {
      notAllowed: "Você não tem permissão para navegar no CRUD.",
      idNotAllowed: "Não mude o ID do nome por nada",
    },
    header: {
      table: "Tabela",
      action: "Ação",
    },
    body: {
      button: "Adicionar CRUD a esta tabela",
    },
    footer: {
      descriptionTitle: "Registros",
      descriptionConnector: "de",
      descriptionBody: "Páginas",
    },
    add: {
      title: {
        table: "Adicionar CRUD para {tableName}",
        field: "Adicionar campos CRUD para {tableName}",
        advance: "Configuração avançada",
      },
      field: {
        tableName: {
          title: "Nome da tabela",
          placeholder: "Nome da tabela",
        },
        generatePermissions: "Gerar permissões",
        createSoftDelete: "Criar exclusão reversível",
        createSoftDeleteNote:
          "Nota: se você criar soft delete, automaticamente criamos modelo e migração para soft delete",
        serverSide: "Lado do servidor",
        displayNameSingular: {
          title: "Nome de exibição (singular)",
          placeholder: "Nome de exibição (singular)",
        },
        displayNamePlural: {
          title: "Nome de exibição (plural)",
          placeholder: "Nome de exibição (plural)",
        },
        urlSlug: {
          title: "URL Slug (deve ser único)",
          placeholder: "URL Slug (deve ser único)",
        },
        icon: {
          title: "Ícone",
          placeholder: "Ícone",
        },
        modelName: {
          title: "Nome do Modelo",
          placeholder: "Nome do Modelo",
        },
        controllerName: {
          title: "Nome do Controlador",
          placeholder: "Nome do Controlador",
        },
        orderColumn: {
          title: "Ordem de Coluna",
          placeholder: "Ordem de Coluna",
        },
        orderDisplayColumn: {
          title: "Ordem de Coluna de Apresentação",
          placeholder: "Ordem de Coluna de Apresentação",
          description:
            "<p class='text-muted'>A ordem de  coluna será preenchida com números para classificar os dados se este campo for definido</p>",
        },
        orderDirection: {
          title: "Direção da Ordem",
          value: {
            ascending: "Ascendente",
            descending: "Descendente",
          },
          placeholder: "Direção da Ordem",
        },
        defaultServerSideSearchField: {
          title: "Campo de pesquisa padrão do lado do servidor",
          placeholder: "Campo de pesquisa padrão do lado do servidor",
        },
        description: {
          title: "Descrição",
          placeholder: "Descrição",
        },
      },
      header: {
        field: "Campo",
        visibility: "Visibilidade",
        inputType: "Tipo de entrada",
        displayName: "Nome de exibição",
        optionalDetails: "Detalhes Opcionais",
      },
      body: {
        type: "Tipo:",
        required: {
          title: "Obrigatório:",
          yes: "Sim",
          no: "Não",
        },
        browse: "Navegar",
        read: "Ler",
        edit: "Editar",
        add: "Adicionar",
        delete: "Excluir",
        displayName: "Nome de exibição",
        setRelation: "Definir relação",
        setRelationManytomany: "Definir relação de muitos para muitos",
        relationType: "Tipo de relação",
        destinationTable: "Tabela de destino",
        destinationTableManytomany: "Tabela de destino muitos para muitos",
        destinationTableColumn: "Coluna de destino",
        destinationTableDisplayColumn: "Coluna de destino a exibir",
        saveRelation: "Salvar",
        cancelRelation: "Cancelar",
      },
      button: "Salvar",
    },
    edit: {
      title: {
        table: "Editar CRUD para {tableName}",
        field: "Editar campos CRUD para {tableName}",
        advance: "Configuração avançada",
      },
      field: {
        tableName: {
          title: "Nome da Tabela",
          placeholder: "Nome da Tabela",
        },
        generatePermissions: "Generate Permissions",
        serverSide: "Lado do servidor",
        displayNameSingular: {
          title: "Nome de exibição (singular)",
          placeholder: "Nome de exibição (singular)",
        },
        displayNamePlural: {
          title: "Nome de exibição (plural)",
          placeholder: "Nome de exibição (plural)",
        },
        urlSlug: {
          title: "URL Slug (deve ser exclusivo) (somente leitura)",
          placeholder: "URL Slug (deve ser exclusivo)",
        },
        icon: {
          title: "Ícone",
          placeholder: "Ícone",
        },
        modelName: {
          title: "Nome do Model",
          placeholder: "Nome do Model",
        },
        controllerName: {
          title: "Nome do Controlador",
          placeholder: "Nome do Controlador",
        },
        orderColumn: {
          title: "Coluna de ordem",
          placeholder: "Coluna de ordem",
        },
        orderDisplayColumn: {
          title: "Coluna de ordem para exibição",
          placeholder: "Coluna de ordem para exibição",
          description:
            "<p class='text-muted'>A coluna de ordem será preenchida com números para classificar os dados se este campo for definido</p>",
        },
        orderDirection: {
          title: "Direção de Ordem",
          value: {
            ascending: "Ascendente",
            descending: "Descendente",
          },
          placeholder: "Direção de Ordem",
        },
        defaultServerSideSearchField: {
          title: "Campo de pesquisa padrão do lado do servidor",
          placeholder: "Campo de pesquisa padrão do lado do servidor",
        },
        description: {
          title: "Descrição",
          placeholder: "Descrição",
        },
        activeEventNotification: {
          title: "Notificação de evento ativo",
          label: {
            onCreate: "Ao criar",
            onRead: "Ao Ler",
            onUpdate: "Ao atualizar",
            onDelete: "Ao Excluir",
            onCreateTitle: "Título Mensagem Evento Ao Criar",
            onCreateMessage: " Mensagem do Evento ao Criar",
            onReadTitle: "Título Mensagem Evento Ao Ler",
            onReadMessage: " Mensagem do Evento ao Ler",
            onUpdateTitle: "Título Mensagem Evento Ao Atualizar",
            onUpdateMessage: " Mensagem do Evento ao Atualizar",
            onDeleteTitle: "Título Mensagem Evento Ao Excluir",
            onDeleteMessage: " Mensagem do Evento ao Excluir",
          },
        },
      },
      header: {
        field: "Campo",
        visibility: "Visibilidade",
        inputType: "Tipo de Entrada",
        displayName: "Nome de exibição",
        optionalDetails: "Detalhes Opcionais",
      },
      body: {
        type: "Tipo:",
        required: {
          title: "Obrigatório:",
          yes: "Sim",
          no: "Não",
        },
        browse: "Navegar",
        read: "Ler",
        edit: "Editar",
        add: "Adicionar",
        delete: "Excluir",
        displayName: "Nome de Exibição",
        setRelation: "Definir Relação",
        setRelationManytomany: "Definir Relação de muitos para muitos",
        relationType: "Tipo de Relação",
        destinationTable: "Tabela de destino",
        destinationTableManytomany: "Tabela de destino muitos para muitos",
        destinationTableColumn: "Destination Column",
        destinationTableDisplayColumn: "Coluna de destino a exibir",
        saveRelation: "Salvar",
        cancelRelation: "Cancelar",
      },
      button: "Salvar",
    },
  },

  menu: {
    title: "Menu",
    options: {
      showHeader: "Mostrar menu de cabeçalho",
      expand: "Expandir",
    },
    warning: {
      notAllowedToBrowse: "Você não tem permissão para navegar no Menu",
      notAllowedToAdd: "Você não tem permissão para adicionar Menu",
      notAllowedToEdit: "Você não tem permissão para editar o Menu",
    },
    help: {
      key: "Você pode definir esta chave como menu padrão no arquivo .env. Além disso, você pode registrar um novo menu em .env por valor de entrada.",
    },
    header: {
      key: "Chave",
      displayName: "Nome de Exibição",
      action: "Ação",
    },
    footer: {
      descriptionTitle: "Registros",
      descriptionConnector: "de",
      descriptionBody: "Páginas",
    },
    add: {
      title: "Adicionar Menu",
      field: {
        key: {
          title: "Chave",
          placeholder: "menu_chave",
        },
        displayName: {
          title: "Nome de Exibição",
          placeholder: "Nome de Exibição",
        },
        icon: {
          title: "Ícone",
          placeholder: "Ícone",
        },
      },
      button: "Salvar",
    },
    edit: {
      title: "Editar Menu",
      field: {
        key: {
          title: "Chave",
          placeholder: "menu_chave",
        },
        displayName: {
          title: "Nome de Exibição",
          placeholder: "Nome de Exibição",
        },
      },
      button: "Salvar",
    },
    builder: {
      title: "Menu Item",
      popup: {
        add: {
          title: "Adicionar Menu Item",
          field: {
            title: "Titulo",
            url: "Url",
            target: {
              title: "Alvo",
              value: {
                thisTab: "Esta Aba",
                newTab: "Nova Aba",
              },
            },
            icon: {
              title: "Ícone",
              description:
                "Use&nbsp;<a href='https://material.io/resources/icons/?style=baseline' target='_blank'>material design icon</a>",
            },
          },
          button: {
            add: "Adicionar",
            cancel: "Cancelar",
          },
        },
        edit: {
          title: "Editar Menu Item",
          field: {
            title: "Título",
            url: "Url",
            target: {
              title: "Alvo",
              value: {
                thisTab: "Esta Aba",
                newTab: "Nova Aba",
              },
            },
            icon: {
              title: "Ícone",
              description:
                "Use&nbsp;<a href='https://material.io/resources/icons/?style=baseline' target='_blank'>material design icon</a>",
            },
          },
          button: {
            edit: "Editar",
            cancel: "Cancelar",
          },
        },
      },
    },
    permission: {
      title: "Permissões",
      header: {
        key: "Chave",
        description: "Descrição",
      },
      button: "Definir permissões selecionadas para o menu",
      success: {
        title: "Sucesso",
        text: "As permissões foram definidas",
      },
    },
  },

  user: {
    title: "Utilizador",
    header: {
      name: "Nome",
      email: "E-mail",
      action: "Ação",
    },
    footer: {
      descriptionTitle: "Registries",
      descriptionConnector: "de",
      descriptionBody: "Páginas",
    },
    help: {
      emailVerified:
        "Ative para verificar automaticamente o e-mail do usuário criado",
    },
    add: {
      title: "Adicionar Utilizador",
      field: {
        name: {
          title: "Nome",
          placeholder: "Nome",
        },
        username: {
          title: "NomeUtulizador",
          placeholder: "NomeUtulizador",
        },
        phone: {
          title: "Numero de Telefone",
          placeholder: "Numero de Telefone",
        },
        address: {
          title: "Endereço",
          placeholder: "Endereço",
        },
        email: {
          title: "E-mail",
          placeholder: "E-mail",
        },
        password: {
          title: "Senha",
          placeholder: "Senha",
        },
        emailVerified: {
          title: "O e-mail esta verificado",
          placeholder: "O e-mail esta verificado",
        },
        avatar: {
          title: "Avatar",
          placeholder: "Avatar",
        },
        gender: {
          title: "Gênero",
          placeholder: "Gênero",
        },
        additionalInfo: {
          title: "Informações Adicionais (JSON)",
          placeholder: "Informações Adicionais (JSON)",
          invalid: "As informações adicionais são inválidas",
        },
        empresa: {
          title: "Empresa",
          placeholder: "Empresa",
          invalid: "Empresa Invalido",
        },
      },
      button: "Salvar",
    },
    edit: {
      title: "Editar Utilizador",
      field: {
        name: {
          title: "Nome",
          placeholder: "Nome",
        },
        username: {
          title: "NomeUtilizador",
          placeholder: "NomeUtilizador",
        },
        phone: {
          title: "Numero de Telefone",
          placeholder: "Numero de Telefone",
        },
        address: {
          title: "Endereço",
          placeholder: "Endereço",
        },
        gender: {
          title: "Gênero",
          placeholder: "Gênero",
        },
        email: {
          title: "E-mail",
          placeholder: "E-mail",
        },
        password: {
          title: "Senha",
          placeholder: "Deixe em branco se não pretende  alterar",
        },
        emailVerified: {
          title: "O e-mail esta verificado",
          placeholder: "O e-mail esta verificado",
        },
        avatar: {
          title: "Avatar",
          placeholder: "Novo Avatar",
        },
        additionalInfo: {
          title: "Informações Adicionais (JSON)",
          placeholder: "Informações Adicionais (JSON)",
          invalid: "As informações adicionais são inválidas",
        },
        empresa: {
          title: "Empresa",
          placeholder: "Empresa",
          invalid: "Empresa Invalido",
        },
      },
      button: "Salvar",
    },
    detail: {
      title: "Detalhe do usuário",
      avatar: "Avatar",
      name: "Nome",
      username: "NomeUtilizador",
      phone: "Numero de Telefone",
      address: "Endereço",
      gender: "Gênero",
      email: "E-mail",
      additionalInfo: "Informação adicional",
      emailVerified: "O e-mail esta verificado",
    },
    roles: {
      title: "Funções",
      header: {
        name: "Nome",
        description: "Descrição",
        action: "Ação",
      },
      button: "Definir funções selecionadas para o usuário",
      success: {
        title: "Sucesso",
        text: "As funções foram definidas",
      },
    },
    gender: {
      man: "Homen",
      woman: "Mulher",
    },
  },

  role: {
    title: "Função",
    warning: {
      notAllowedToBrowse: "Você não tem permissão para Navegar Função",
      notAllowedToAdd: "Você não tem permissão para Adicionar Função",
      notAllowedToEdit: "Você não tem permissão para Editar Função",
      notAllowedToBrowsePermission:
        "Você não tem permissão para navegar pelas permissões de funções",
    },
    header: {
      name: "Nome",
      displayName: "Nome de exibição",
      description: "Descrição",
      action: "Ação",
    },
    footer: {
      descriptionTitle: "Registros",
      descriptionConnector: "de",
      descriptionBody: "Páginas",
    },
    add: {
      title: "Adicionar Função",
      field: {
        name: {
          title: "Nome",
          placeholder: "Nome",
        },
        displayName: {
          title: "Nome de exibição",
          placeholder: "Nome de exibição",
        },
        description: {
          title: "Descrição",
          placeholder: "Descrição",
        },
      },
      button: "Salvar",
    },
    edit: {
      title: "Editar Função",
      field: {
        name: {
          title: "Nome",
          placeholder: "Nome",
        },
        displayName: {
          title: "Nome de exibição",
          placeholder: "Nome de exibição",
        },
        description: {
          title: "Descrição",
          placeholder: "Descrição",
        },
      },
      button: "Salvar",
    },
    detail: {
      title: "Função detalhada",
      name: "Nome",
      displayName: "Nome de exibição",
      description: "Descrição",
      button: {
        edit: "Editar",
        permission: "Permissão",
      },
    },
    permission: {
      title: "Permissão",
      header: {
        key: "Chave",
        description: "Descrição",
      },
      button: "Defina as permissões selecionadas para a função",
      success: {
        title: "Sucesso",
        text: "As permissões foram definidas",
      },
    },
  },

  permission: {
    title: "Permissão",
    warning: {
      notAllowedToBrowse: "Você não tem permissão para Navegar nesta Permissão",
      notAllowedToAdd: "Você não tem permissão para Adicionar nesta Permissão",
      notAllowedToEdit: "Você não tem permissão para Editar nesta Permissão",
      notAllowedToRead: "Você não tem permissão para Ler nesta Permissão",
    },
    help: {
      alwaysAllow:
        "Depois que a permissão for criada, ela será atribuída a todas as funções criadas após a permissão",
      isPublic: "Permissions will be publicly available",
    },
    header: {
      key: "Chave",
      description: "Descrição",
      tableName: "Nome da tabela",
      alwaysAllow: "Permitir Sempre",
      isPublic: "é público",
      action: "Ação",
    },
    footer: {
      descriptionTitle: "Registros",
      descriptionConnector: "de",
      descriptionBody: "Páginas",
    },
    add: {
      title: "Adicionar Permissão",
      field: {
        key: {
          title: "Chave",
          placeholder: "Chave",
        },
        alwaysAllow: "Permitir Sempre",
        isPublic: "é público",
        description: {
          title: "Descrição",
          placeholder: "Descrição",
        },
        tableName: {
          title: "Nome da Tabela",
          placeholder: "Nome da Tabela",
        },
      },
      button: "Salvar",
    },
    edit: {
      title: "Editar Permissão",
      field: {
        key: {
          title: "Chave",
          placeholder: "Chave",
        },
        alwaysAllow: "Permitir Sempre",
        isPublic: "é público",
        description: {
          title: "Descrição",
          placeholder: "Descrição",
        },
        tableName: {
          title: "Nome da Tabela",
          placeholder: "Nome da Tabela",
        },
      },
      button: "Salvar",
    },
    detail: {
      title: "Permissão detalhada",
      key: "Chave",
      description: "Descrição",
      tableName: "Nome da Tabela",
      alwaysAllow: {
        title: "Permitir Sempre",
        yes: "Sim",
        no: "Não",
      },
      isPublic: {
        title: "É público",
        yes: "Sim",
        no: "Não",
      },
      button: "Editar",
    },
  },

  crudGenerated: {
    warning: {
      notAllowedToBrowse: "Você não tem permissão para Navegar em {tableName}",
      notAllowedToAdd: "Você não tem permissão para Adicionar em {tableName}",
      notAllowedToEdit: "Você não tem permissão para Editar em {tableName}",
      notAllowedToRead: "Você não tem permissão para Ler em {tableName}",
    },
    header: {
      action: "Ação",
    },
    footer: {
      descriptionTitle: "Registros",
      descriptionConnector: "de",
      descriptionBody: "Páginas",
    },
    add: {
      title: "Adicionar {tableName}",
      button: "Salvar",
    },
    edit: {
      title: "Editar {tableName}",
      button: "Atualizar",
    },
    detail: {
      title: "Detalhe {tableName}",
      button: "Editar",
    },
    sort: {
      title: "Organizar {tableName}",
    },
    maintenanceDialog: {
      title: "Configuração",
      switch: "Modo de manutenção",
      button: "Salvar",
    },
  },
  keyIssue: {
    title: "Problemas de licença",
    message:
      "Desculpe, Badaso não pode ser usado porque há um problema em sua licença",
    listTitle: "Aqui estão alguns dos problemas que podem ocorrer com uma licença:",
    licenseEmpty: "Licença vazia",
    licenseEmptyDescription:
      "Você não inseriu BADASO_LICENSE_KEY em .env. Por favor, preencha antes de poder usar o Badaso. Para obter instruções mais completas, consulte aqui.",
    licenseInvalid: "Licença inválida",
    licenseInvalidDescription:
      "BADASO_LICENSE_KEY não foi encontrado. Por favor, certifique-se de que é o mesmo que você obtém no Painel do Badaso. Para obter instruções mais completas, consulte aqui.",
    licenseUsersExpired: "Período Ativo Expiro",
    licenseUsersExpiredDescription:
      "Seu período ativo expirou. Por favor, adicione seu período ativo ao Badaso Dashboard para que sua licença possa ser usada novamente. Para obter instruções mais completas, consulte aqui.",
  },
  authorizationIssue: {
    title: "Sessão expirada",
    subtitle: "Desculpe, não é possível continuar a solicitação porque",
    message: "Falha na autorização, token expirado ou vazio",
  },
  database: {
    browse: {
      title: "Base de dados",
      addButton: "Adicionar Tabela",
      alterButton: "Alterar Tabela",
      rollbackButton: "Migração de reversão",
      dropButton: "Destruir Tabela",
      goBackButton: "Volte",
      deleteMigrationButton: "Excluir arquivo de migração",
      migrateButton: "Migrar",
      warning: {
        title: "Migração não sincronizada",
        notAllowed:
          "Antes de poder usar o Gerenciamento de banco de dados, você deve migrar o arquivo que ainda não migrou ou pode excluir o arquivo de migração. Aqui está uma lista dos arquivos de migração que não foram migrados:",
        empty: "Você deve excluir este CRUD gerado primeiro no Gerenciamento de CRUD.",
      },
      fieldNotSupport: {
        title: "Erro de banco de dados",
        text: "Há um tipo de dados não compatível na tabela, consulte o tipo de dados compatível na documentação do badaso",
        tableList: "Lista de tabelas não suportadas:",
        button: {
          visitDocs: "Visite a Documentação",
        },
      },
    },
    add: {
      title: "Adicionar Tabela",
      field: {
        table: "Nome da Tabela",
      },
      row: {
        title: "Adicionar campo de tabela",
        subtitle: "Leia o {0} antes de criar a migração.",
        field: {
          timestamp: "Timestamp",
          tableName: "Nome da Tabela",
          fieldName: "Nome do Campo",
          fieldType: "Tipo de Campo",
          fieldLength: "Comprimento/Valor",
          fieldDefault: "Padrão",
          asDefined: "Valor padrão definido pelo usuário",
          fieldNull: "Anulável",
          fieldIndex: "Índice",
          fieldAttribute: "Não assinado",
          fieldIncrement: "Incremento automático",
          action: "Ação",
          add: "Adicionar",
        },
      },
      error: {
        fieldName: "O Nome do Campo é Obrigatório.",
        fieldType: "O Tipo do Campo é Obrigatório.",
        tableName: "O nome do Tabela é Obrigatório.",
        fieldLength: "O Comprimento do Campo é Obrigatório.",
      },
      footer: {
        descriptionTitle: "Registros",
        descriptionConnector: "de",
        descriptionBody: "Páginas",
      },
      button: "Salvar",
    },
    edit: {
      title: "Alterar Tabela",
      field: {
        table: "Nome da Tabela",
      },
      row: {
        title: "Alterar Campo da Tabela",
        field: {
          timestamp: "Timestamp",
          tableName: "Nome da Tabela",
          fieldName: "Nome do Campo",
          fieldType: "Tipo de Campo",
          fieldLength: "Comprimento",
          fieldDefault: "Padrão",
          asDefined: "Valor padrão definido pelo usuário",
          fieldNull: "Anulável",
          fieldIndex: "Índice",
          fieldAttribute: "Não assinado",
          fieldIncrement: "Incremento automático",
          action: "Ação",
          add: "Adicionar",
        },
        drop: "Tem certeza que deseja excluir este campo?",
      },
      warning: {
        title: "IMPORTANTE",
        content:
          'Somente os seguintes tipos de coluna podem ser "alterados": Big Integer, BLOB, Boolean, Date, Datetime, Decimal, Float, Integer, JSON, Long Text, Medium Text, Set, Small Integer, Varchar, Text e Time. Além disso, todo campo que você alterar, será registrado quando você enviar a tabela de alteração. Se você cometer alguns erros, poderá atualizar esta página para redefinir suas alterações.',
        crud: "Certifique-se de que a tabela não foi gerada com o Gerenciamento CRUD se desejar editá-la ou excluí-la.",
        notAllowed: "Você não tem permissão para editar.",
        fieldAttUnsigned:
          "A restrição de chave estrangeira foi formada incorretamente. {0} para visitar documentos.",
        visitDocs: "Clique aqui",
      },
      error: {
        fieldName: "O Nome do Campo é Obrigatório.",
        fieldType: "O Tipo de Campo é Obrigatório.",
        tableName: "O Nome da Tabela é Obrigatório.",
        fieldLength: "O Comprimento do Campo é Obrigatório.",
      },
      footer: {
        descriptionTitle: "Registros",
        descriptionConnector: "de",
        descriptionBody: "Páginas",
      },
      button: "Salvar",
    },
    rollback: {
      title: "Reversão",
      label: "Insira a etapa de reversão",
      checkbox: "Excluir arquivo de migração?",
      invalid: "Selecione a migração que deseja reverter.",
    },
    warning: {
      docs: "* Por favor, leia o {0} antes de usar este recurso.",
      exists: "O campo {0} já existe",
      invalid:
        "A solicitação é inválida. Verifique os campos ou o nome da tabela se é válido ou não.",
      empty: "A solicitação é inválida. Nenhuma alteração foi feita.",
      errorOnRequest: "A solicitação é inválida.",
    },
    migration: {
      header: {
        migration: "Nome da migração",
      },
      button: {
        rollback: "Migração de reversão",
      },
    },
  },
  fileManager: {
    title: "Gerenciador de arquivos",
    warning: {
      notAllowedToBrowse: "Você não tem permissão para navegar no gerenciador de arquivos",
    },
    URL: {
      label: "Cole um URL de imagem aqui",
      placeholder: "URL",
      descriptionText:
        "Se o seu URL estiver correto, você verá uma visualização da imagem aqui. Imagens grandes podem demorar alguns minutos para aparecer. Aceite apenas PNG e JPEG.",
      invalid: "A imagem não é válida",
    },
  },
  imageManager: {
    title: "Gerenciador de imagens",
    warning: {
      notAllowedToBrowse: "Você não tem permissão para navegar no gerenciador de imagens",
    },
  },
  firebase: {
    title: "Firebase",
    feature: "Recurso",
    features: {
      firebaseCloudMessage: "Mensagem da nuvem do Firebase",
    },
    form: {
      apiKey: "Chave API",
      authDomain: "domínio de autenticação",
      projectId: "ID do projeto",
      storageBucket: "Epaço de Armazenamento",
      messagingSenderId: "Remetente da mensagem",
      appId: "App Id",
      measurementId: "ID de medição",
      serverKey: "Chave do servidor",
    },
  },
  logViewer: {
    title: "Visualizador de registro",
    warning: {
      notAllowedToBrowse: "Você não tem permissão para navegar no visualizador de log",
    },
  },
  apidocs: {
    title: "Documentação da API",
    warning: {
      notAllowedToBrowse: "Você não tem permissão para navegar na documentação da API.",
    },
  },
  notification: {
    notification: "Notificação",
    detailMessage: "Detalhe da Mensagem",
  },
  noInternetAccess:
    "Os dados não podem ser carregados porque você não está conectado à Internet. Por favor, conecte-se à internet novamente!",
  offlineFeature: {
    dataPending: "Dados Pendentes...",
    dataUpdatePending: "Atualização de dados pendente...",
    dataPendingAdd: {
      title: "Dados Pendentes",
    },
    dataPendingEdit: {
      title: "Mostrar edição de dados pendente",
    },
    crudGenerator: {
      deleteDataPending: "Excluir dados pendentes",
    },
  },
  softDelete: {
    crudGenerator: {
      restore: "Restaurar",
    },
  },
};
