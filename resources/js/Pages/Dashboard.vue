<template>
    <div>
        <v-card
            class="mx-auto bg-red-lighten-1"
            prepend-icon="$vuetify"
            subtitle="Lista de Usuários"
            width="auto"
        >
        <v-btn
        color="gray"
        @click="logout()">
            Logout
        </v-btn>
            <template v-slot:title>
                <span class="font-weight-black">Olá, {{ userLogged }} </span>
            </template>
        </v-card>
    </div>

    <div>
        <v-btn
        color="blue"
        @click="cadastrarNovo()">
            Cadastrar novo Usuário
        </v-btn>
        <v-table>
            <thead>
                <tr>
                    <th class="font-weight-bold">Nome</th>
                    <th class="font-weight-bold">Email</th>
                    <th class="font-weight-bold">Telefone</th>
                    <th class="font-weight-bold">CPF</th>
                    <th class="font-weight-bold">Ações</th>
                </tr>
            </thead>
            <tbody
            v-for="user in users">
                <tr>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.phone }}</td>
                    <td>{{ user.cpf }}</td>
                    <td><v-btn
                        color="blue-darken-3"
                        @click="editar(user.id)">
                        Editar
                    </v-btn>
                    <v-btn
                    color="orange"
                    @click="mostrarInfo(user.id)">
                        Detalhes
                    </v-btn>
                    <v-btn
                    color="red"
                    @click="deletarUsuario(user.id)">
                        Excluir
                    </v-btn></td>
                </tr>
            </tbody>
        </v-table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data: () => ({
        userLogged : '',
        users: '',
    }),
    mounted(){
        this.getLoggedUser().then(name => this.userLogged = name);
        this.getUsers().then(users => this.users = users);
    },
    methods :{
        async getLoggedUser(){
            try{
                const response = await axios.get('/loggedUser');
                console.log(response.data.name); // Apenas para depuração
                return response.data.name.toString();
            }
            catch (error){
                console.error('Erro ao obter usuário logado:', error);
                return '';
            }
        },
        async getUsers(){
            try{
                const response = await axios.get('/users');
                console.log(response.data); // Apenas para depuração
                return response.data;
            }
            catch(error){
                console.error('Erro ao obter usuários:', error);
                return '';
            }
        },
        cadastrarNovo(){
            window.location.href = "/newuser";
        },
        editar(id){
            window.location.href=`/users/${id}/edit`
        },
        mostrarInfo(id){
            window.location.href=`/users/${id}/show`
        },
        deletarUsuario(id){
            axios.get(`/users/${id}/delete`)
            .then(response => {
                if (response.status == 201){
                    window.location.reload();
                }
            })
            .catch(error => {
                if(error.response.status==405){
                    window.alert('Você não pode deletar o seu próprio usuário.');
                }
                console.error('Erro ao deletar usuário:', error);
            })
        },
        logout(){
            window.location.href = '/logout';
        }
    }
}
</script>