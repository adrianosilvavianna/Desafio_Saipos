<template>

    <div class="card mb-4 shadow-sm">

        <div class="card-header">
            Cadastro De Tarefas
             
        </a>
        </div>

        <div >
            <div class="card-body">
                
                <form action="" v-on:submit.prevent="newTask()">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" v-model="name_task">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email </label>
                        <input type="email" class="form-control" id="email" name="email" v-model="email_task">
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="description" name="description" v-model="description_task"></textarea>
                    </div>

                    <p v-if="errors.length">
                        <b>{{ title_error }}</b>
                        <ul>
                        <li v-for="error in errors">{{ error }}</li>
                        </ul>
                    </p>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
    

</template>


<script>
    export default {
        data() {
            return {
                errors: [],
                name_task: null,
                email_task: null,
                description_task: null,
                title_error: 'Por favor, corrija o(s) seguinte(s) erro(s):'
            }
        },
        mounted() {
            //
        },
        methods: {
            newTask(){

                const params = {
                    name: this.name_task,
                    email: this.email_task,
                    description: this.description_task
                }

                this.errors = [];

                if (!this.name_task) {
                    this.errors.push('O nome é obrigatório.');
                }
                if (!this.email_task) {
                    this.errors.push('A idade é obrigatória.');
                }
                if (!this.description_task) {
                    this.errors.push('A idade é obrigatória.');
                }
                
                if(this.errors.length == 0){
                    axios.post('/task', params).then((response) => {

                        const task = response.data;
                        this.$emit('new', task);
                        
                        this.name_task = null;
                        this.email_task = null;
                        this.description_task = null;

                    })
                    .catch(error => {
                        console.log(error)
                        this.title_error = 'Tente novamente.';
                        this.errors.push('Tivemos problemas com nosso servidor, e não conseguimos finalizar o cadastro. :(');
                    })
                }
                
            }
        }

       
    }
</script>
