<template>

  <v-card
    class="mx-auto bg-red-lighten-1"
    prepend-icon="$vuetify"
    subtitle="Desafio para avaliação na systock"
    width="auto"
  >
    <template v-slot:title>
      <span class="font-weight-black">Bem-vindo ao meu projeto!</span>
    </template>

    <v-card-text class="bg-blue-darken-4 pt-4">
      Bem-vindo à página inicial do meu projeto para avaliação na Systock. Utilizei as tecnologias solicitadas no desafio, e fiz um sistema de cadastro/login e um CRUD de usuários que estará disponível na página após o login. Escolha se deseja fazer login ou cadastrar-se no site abaixo.
    </v-card-text>
  </v-card>

  <div>

    <v-card
      class="mt-10 mx-auto pa-12 pb-8"
      elevation="8"
      max-width="448"
      rounded="lg"
    >
      <div class="text-subtitle-1 text-medium-emphasis">Login</div>

      <v-text-field
        density="compact"
        placeholder="Digite seu Email"
        v-model="email"
        :rules="[rules.required, rules.email]"
        prepend-inner-icon="mdi-login"
        variant="outlined"
      ></v-text-field>

      <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
        Senha
      </div>
    

      <v-text-field
        :rules="[rules.required]"
        v-model="password"
        :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
        :type="visible ? 'text' : 'password'"
        density="compact"
        placeholder="Digite sua senha"
        prepend-inner-icon="mdi-lock-outline"
        variant="outlined"
        @click:append-inner="visible = !visible"
      ></v-text-field>


      <v-btn
        class="mb-8"
        color="blue"
        size="large"
        variant="tonal"
        @click="login()"
        block
      >
        Entrar
      </v-btn>

      <v-card-text class="text-center">
        <a
          class="text-blue text-decoration-none"
          rel="noopener noreferrer"
          target="_self"
          href="signup"
        >
          Cadastre-se <v-icon icon="mdi-chevron-right"></v-icon>
      </a>
      </v-card-text>
    </v-card>
  </div>

  <v-banner
      v-if="mostrarErro"
      color="error"
      icon="mdi-alert-circle"
      lines="auto"
      max-width="auto"
      max-heigth="auto"
    >
      <template v-slot:text>
        Erro no Login. Verifique suas credenciais e tente novamente.
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
    v-if="mostrarAguarde"
    color="warning"
    icon="mdi-message-processing"
    lines="auto"
    max-width="auto"
    max-heigth="auto"
  >
    <template v-slot:text>
      Processando seu login, aguarde.
    </template>

    <template v-slot:actions>
      <v-btn
      @click="mostrarAguarde = false">
        Fechar
      </v-btn>
    </template>
  </v-banner>

</template>

<script>
import axios from 'axios';

  export default {
    data: () => ({
      visible: false,
      email: '',
      password: '',
      mostrarErro: false,
      mostrarErroServidor: false,
      mostrarAguarde: false,
      rules : {
        required: value =>!!value || 'Campo obrigatório',
        email: value => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return pattern.test(value) || 'E-mail inválido'
        },
      },
    }),
    methods: {
      login(){
        this.mostrarAguarde = true;
        axios.post('/', {
          email: this.email,
          password:  this.password
        })
        .then(response =>{
          console.log(response);
          this.mostrarAguarde = false;
        })
        .catch(error => {
          if(error.response.status == 401 || error.response.status == 422){
            this.mostrarErro = true;
            this.password = '';
            this.mostrarAguarde = false;
          }
          else{
            this.mostrarErroServidor = true;
            this.password = '';
            this.mostrarAguarde = false;
          }
        })
      }
    }
  }
</script>