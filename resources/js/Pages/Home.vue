<template>

<v-card
      class="mx-auto"
      prepend-icon="$vuetify"
      subtitle="Desafio para avaliação na systock"
      width="400"
    >
      <template v-slot:title>
        <span class="font-weight-black">Bem-vindo ao meu projeto!</span>
      </template>
  
      <v-card-text class="bg-surface-light pt-4">
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
          prepend-inner-icon="mdi-map-marker"
          variant="outlined"
        ></v-text-field>
  
        <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
          Senha
        </div>
        
  
        <v-text-field
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
          block
        >
          Entrar
        </v-btn>
  
        <v-card-text class="text-center">
          <a
            class="text-blue text-decoration-none"
            rel="noopener noreferrer"
            target="_blank"
            href="signup"
          >
            Cadastre-se <v-icon icon="mdi-chevron-right"></v-icon>
          </a>
        </v-card-text>
      </v-card>
    </div>
  </template>

  <script>
    export default {
      data: () => ({
        visible: false,
      }),
    }
  </script>

<style>

</style>