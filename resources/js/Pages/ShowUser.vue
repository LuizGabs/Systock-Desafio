<template>
    <div>
    <v-card
      class="mx-auto bg-red-lighten-1"
      prepend-icon="$vuetify"
      subtitle="Tela de Detalhes do Usuário"
      width="auto"
    >
      <template v-slot:title>
        <span class="font-weight-black">Detalhes do Usuário: {{ user.name }}</span>
      </template>

    </v-card>

      <v-card
        class="mt-10 mx-auto pa-12 pb-8"
        elevation="8"
        max-width="448"
        rounded="lg"
      >

      
      <v-list-item
      title="Nome"
      append-icon="mdi-account">

      <span class="font-weight-bold">{{user.name}}</span>
      </v-list-item>
      <v-divider
      color="black"></v-divider>
      
      <v-list-item
      title="Id"
      append-icon="mdi-identifier">

      <span class="font-weight-bold">{{user.id}}</span>
      </v-list-item>
      <v-divider
      color="black"></v-divider>

      <v-list-item
      title="Email"
      append-icon="mdi-email">

      <span class="font-weight-bold">{{user.email}}</span>
      </v-list-item>
      <v-divider
      color="black"></v-divider>

      <v-list-item
      title="Telefone"
      append-icon="mdi-phone">

      <span class="font-weight-bold">{{user.phone}}</span>
      </v-list-item>
      <v-divider
      color="black"></v-divider>

      <v-list-item
      title="CPF"
      append-icon="mdi-card-account-details">

      <span class="font-weight-bold">{{user.cpf}}</span>
      </v-list-item>
      <v-divider
      color="black"></v-divider>

  
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
    </div>
</template>

<script>
import axios from 'axios';


export default{
    data: () => ({
      visible: false,
    }),
    props: {
        user: Object // Recebe o usuário como propriedade
    },
}

</script>