<template>
    <div>
    <v-card
      class="mx-auto bg-red-lighten-1"
      prepend-icon="$vuetify"
      subtitle="Tela de Edição"
      width="auto"
    >
      <template v-slot:title>
        <span class="font-weight-black">Editar usuário: {{ user.name }}</span>
      </template>

    </v-card>

      <v-card
        class="mt-10 mx-auto pa-12 pb-8"
        elevation="8"
        max-width="448"
        rounded="lg"
      >
      <div class="text-subtitle-1 text-medium-emphasis">Nome (Obrigatório)</div>
  
        <v-text-field
            id="name"
            v-model="formData.name"
            placeholder="Digite o nome"
            density="compact"
            prepend-inner-icon="mdi-account"
            :rules = "[rules.required, rules.name]"
            variant="outlined"
        ></v-text-field>

        <div class="text-subtitle-1 text-medium-emphasis">Email (Obrigatório)</div>
  
        <v-text-field
          id="email"
          v-model="formData.email"
          density="compact"
          placeholder="Digite o Email"
          prepend-inner-icon="mdi-email"
          :rules = "[rules.required, rules.email]"
          variant="outlined"
        ></v-text-field>

        <div class="text-subtitle-1 text-medium-emphasis">Telefone (Somente Números) (Opcional)</div>
  
        <v-text-field
            id="phone"
            v-model="formData.phone"
            type="text"
            density="compact"
            placeholder="Digite o Telefone (Opcional)"
            prepend-inner-icon="mdi-phone"
            variant="outlined"
            :rules = "[rules.phone]"
        ></v-text-field>

        <div class="text-subtitle-1 text-medium-emphasis">CPF (Somente Números) (Obrigatório)</div>
  
        <v-text-field
            id="cpf"
            v-model="formData.cpf"
            type="text"
            density="compact"
            placeholder="Digite o CPF"
            prepend-inner-icon="mdi-card-account-details"
            variant="outlined"
            :rules = "[rules.required, rules.cpf]"
        ></v-text-field>
  
        <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
          Senha (Obrigatório)
        </div>
        
  
        <v-text-field
          id="password"
          v-model="formData.password"
          :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
          :type="visible ? 'text' : 'password'"
          density="compact"
          placeholder="Digite a senha"
          prepend-inner-icon="mdi-lock-outline"
          variant="outlined"
          :rules = "[rules.required, rules.password]"
          @click:append-inner="visible = !visible"
        ></v-text-field>

  
        <v-btn
          class="mb-8"
          color="blue"
          size="large"
          variant="tonal"
          @click ="update()"
          block
        >
          Atualizar
        </v-btn>
  
        <v-card-text class="text-center">
          <a
            class="text-blue text-decoration-none"
            rel="noopener noreferrer"
            target="_self"
            href="/dashboard"
          >
          <v-icon icon="mdi-chevron-left"></v-icon>
            Retornar ao Dashboard 
          </a>
        </v-card-text>
      </v-card>
      <v-banner
        v-if="mostrarErro"
        color="error"
        icon="mdi-alert-circle"
        lines="auto"
        max-width="auto"
        max-heigth="auto"
      >
        <template v-slot:text>
          Erro na atualização do Usuário. Verifique as credenciais e tente novamente.
        </template>

        <template v-slot:actions>
          <v-btn
          @click="mostrarErro = false">
            Fechar
          </v-btn>

        </template>
      </v-banner>

      <v-banner
        v-if="mostrarErroServidor"
        color="warning"
        icon="mdi-wifi-alert"
        lines="auto"
        max-width="auto"
        max-heigth="auto"
      >
        <template v-slot:text>
          Erro interno do servidor. Por favor, tente novamente mais tarde.
        </template>

        <template v-slot:actions>
          <v-btn
          @click="mostrarErroServidor = false">
            Fechar
          </v-btn>

        </template>
      </v-banner>

      <v-banner
        v-if="mostrarSucesso"
        color="#4CAF50"
        icon="mdi-check-outline"
        lines="auto"
        max-width="auto"
        max-heigth="auto"
      >
        <template v-slot:text>
          Usuário atualizado com sucesso!
        </template>

        <template v-slot:actions>
          <v-btn
          @click="mostrarSucesso = false">
            Fechar
          </v-btn>
        </template>
      </v-banner>

      <v-banner
        v-if="mostrarAguarde"
        color="warning"
        icon="mdi-message-processing"
        lines="auto"
        max-width="auto"
        max-heigth="auto"
      >
        <template v-slot:text>
          Processando a solicitação, aguarde.
        </template>

        <template v-slot:actions>
          <v-btn
          @click="mostrarAguarde = false">
            Fechar
          </v-btn>
        </template>
      </v-banner>

    </div>
</template>

<script>
import axios from 'axios';


export default{
    data: () => ({
      visible: false,
      formData: {
        name: '',
        email: '',
        cpf: '',
        password: '',
        phone: ''
      },
      mostrarErro: false,
      mostrarErroServidor: false,
      mostrarSucesso: false,
      mostrarAguarde: false,
      rules : {
          required: value =>!!value || 'Campo obrigatório',
          email: value => {
              const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
              return pattern.test(value) || 'E-mail inválido'
          },
          name: value => {
              const pattern = /^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/
              return pattern.test(value) || 'Nome Inválido'
          },
          cpf: value => {
              const pattern = /^\d{11}$/
              return pattern.test(value) || 'CPF Inválido'
          },
          password: value => {
              const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_-])[A-Za-z\d@$!%*?&_-]{8,}$/
              return pattern.test(value) || 'Senha Inválida (Deve ter pelomenos 8 dígitos, um caracter especial, uma letra maiúscula e um número)'
          },
          phone: value => {
            const pattern = /^(?:\d{11})?$/
            return pattern.test(value) || 'Telefone Inválido'
          }
      },
    }),
    props: {
        user: Object // Recebe o usuário como propriedade
    },
    mounted() {
        // Inicializa os dados do formulário com os dados do usuário recebido
        this.formData.name = this.user.name;
        this.formData.email = this.user.email;
        this.formData.cpf = this.user.cpf;
        this.formData.phone = this.user.phone;
    },
    methods : {
        update(){
            this.mostrarAguarde = true;
            axios.put(`/users/${this.user.id}`,{
                    name: this.formData.name,
                    email: this.formData.email,
                    cpf: this.formData.cpf,
                    password:  this.formData.password,
                    phone: this.formData.phone
                })
                .then(response => {
                    if(response.status == 201){
                        this.mostrarSucesso = true;
                        this.mostrarAguarde = false;
                        window.location.href = '/dashboard';
                    }
                })
                .catch(error => {
                    if(error.response.status == 422){
                        this.mostrarErro = true;
                        this.mostrarAguarde = false;
                        console.log(error);
                    }
                    else{
                        this.mostrarErroServidor = true;
                        this.mostrarAguarde = false;
                    }
                });
        }
    },
}

</script>