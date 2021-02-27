<template>


        <div class="card-body">
            
            <input v-if="editMode" type="text" class="form-control" id="name" name="name" placeholder="Nome" v-model="candidate.name" >
            <h5 v-else class="card-title">{{ candidate.name }}</h5>

            <input v-if="editMode" type="email" class="form-control" id="email" name="email" placeholder="Email" v-model="candidate.email">
            <h6 v-else class="card-subtitle mb-2 text-muted">{{ candidate.email }}</h6>

            <input v-if="editMode" type="text" class="form-control" id="age" name="age" placeholder="Idade" v-model="candidate.age">
            <input v-if="editMode" type="text" class="form-control" id="linkedin" name="url_linkedin" placeholder="URL Linkedin" v-model="candidate.url_linkedin">
            <h6 v-else class="card-subtitle mb-2 text-muted">{{ candidate.age }} - {{ candidate.url_linkedin }} </h6>

            <h6 class="card-subtitle mb-2">
                <span class="badge bg-warning" v-for="thecnology in candidate.technologies">{{ thecnology.name }} </span>
            </h6>

            <button v-if="editMode" class="btn btn-primary card-link" v-on:click="onClickUpdate()">Enviar Dado Editados</button>
            <button v-else class="btn btn-primary card-link" v-on:click="onClickEdit()">Editar</button>

            <button class="btn btn-danger card-link" v-on:click="onClickDelete()">Excluir</button>

        </div>


</template>

<script>
    export default {
        props: ['candidate'],
        data(){
            return {
                editMode: false,
            }
        },

        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            onClickDelete() {
                axios.delete('candidate/'+this.candidate.id).then((response) => {
                    console.log(response);
                    this.$emit('delete');
                });
                
            },
            onClickEdit() {
                this.editMode = true;
            },
            onClickUpdate() {

                const params = {
                    name: this.candidate.name,
                    email: this.candidate.email,
                    age: this.candidate.age,
                    url_linkedin: this.candidate.url_linkedin
                }

                axios.put('candidate/'+this.candidate.id, params).then((response) => {
                    this.editMode = false;
                    const candidate = response.data;
                    this.$emit('update', candidate);
                });
            },
            getCandidateTechnologies() {
                
            }
        }

    }
</script>
