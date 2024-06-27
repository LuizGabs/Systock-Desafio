<template>
    <div>
    <v-card
      class="mx-auto bg-red-lighten-1"
      prepend-icon="$vuetify"
      subtitle="Seja bem vindo! Faça seu cadastro agora mesmo!"
      width="auto"
    >
      <template v-slot:title>
        <span class="font-weight-black">Tela de Cadastro</span>
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
            v-model="name"
            density="compact"
            placeholder="Digite seu nome"
            prepend-inner-icon="mdi-account"
            :rules = "[rules.required, rules.name]"
            variant="outlined"
        ></v-text-field>

        <div class="text-subtitle-1 text-medium-emphasis">Email (Obrigatório)</div>
  
        <v-text-field
          id="email"
          v-model="email"
          density="compact"
          placeholder="Digite seu Email"
          prepend-inner-icon="mdi-email"
          :rules = "[rules.required, rules.email]"
          variant="outlined"
        ></v-text-field>

        <div class="text-subtitle-1 text-medium-emphasis">Telefone (Somente Números) (Opcional)</div>
  
        <v-text-field
            id="phone"
            v-model="phone"
            type="text"
            density="compact"
            placeholder="Digite seu Telefone (Opcional)"
            prepend-inner-icon="mdi-phone"
            variant="outlined"
            :rules = "[rules.phone]"
        ></v-text-field>

        <div class="text-subtitle-1 text-medium-emphasis">CPF (Somente Números) (Obrigatório)</div>
  
        <v-text-field
            id="cpf"
            v-model="cpf"
            type="text"
            density="compact"
            placeholder="Digite seu CPF"
            prepend-inner-icon="mdi-card-account-details"
            variant="outlined"
            :rules = "[rules.required, rules.cpf]"
        ></v-text-field>
  
        <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
          Senha (Obrigatório)
        </div>
        
  
        <v-text-field
          id="password"
          v-model="password"
          :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
          :type="visible ? 'text' : 'password'"
          density="compact"
          placeholder="Digite sua senha"
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
          @click ="cadastro()"
          block
        >
          Cadastrar
        </v-btn>
  
        <v-card-text class="text-center">
          <a
            class="text-blue text-decoration-none"
            rel="noopener noreferrer"
            target="_self"
            href="/"
          >
          <v-icon icon="mdi-chevron-left"></v-icon>
            Retornar ao Login 
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
          Erro na criação do Usuário. Verifique suas credenciais e tente novamente.
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
          Usuário criado com sucesso!
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
          Processando seu cadastro, aguarde.
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
import axios from 'axios'
  export default {
    data: () => ({
      visible: false,
      name: '',
      email: '',
      cpf: '',
      password: '',
      phone: '',
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
    methods:{
      cadastro() {
        this.mostrarAguarde = true;
        axios.post('http://localhost:8080/signup', {
            name: this.name,
            email: this.email,
            cpf: this.cpf,
            password: this.password,
            phone: this.phone,
        })
        .then(response => {
            if(response.status == 201){
              this.mostrarSucesso = true;
              this.mostrarAguarde = false;
              window.location.href = 'http://localhost:8080/';
            }
        })
        .catch(error => {
            if(error.response.status == 422){
              this.mostrarErro = true;
              this.mostrarAguarde = false;
            }
            else{
              this.mostrarErroServidor = true;
              this.mostrarAguarde = false;
            }
        });
      },
    },
  }
</script>
