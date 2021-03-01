<template>

    <div class="card">
        <div class="card-header">Cadastro De Candidatos</div>

        <div class="card-body">
            
            <form action="" v-on:submit.prevent="newCandidate()">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" v-model="name_candidate">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email </label>
                    <input type="email" class="form-control" id="email" name="email" v-model="email_candidate">
                </div>

                <div class="input-group  mb-3">
                    <label for="age" class="form-label">Idade</label>
                    <input type="text" class="form-control" id="age" name="age" v-model="age_candidate">

                    <label for="likedin" class="form-label">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" name="url_linkedin" v-model="likedin_candidate">
                </div>

                <div class="mb-3 form-check" v-for="(technology, index) in technologies" :key="technology.id">
                    <input type="checkbox" class="form-check-input" :id="technology.id" :value="technology.id" v-model="selectedTechnologies">
                    <label class="form-check-label" :for="technology.id" >{{ technology.name }}</label>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
    

</template>


<script>
    export default {
        data() {
            return {
                name_candidate: '',
                email_candidate: '',
                age_candidate: '',
                likedin_candidate: '',
                selectedTechnologies: [],
                technologies: []
            }
        },
        mounted() {
            axios.get('/getTechnologies').then((response) => {
                this.technologies = response.data;
            })
        },
        methods: {
            newCandidate(){

                const params = {
                    name: this.name_candidate,
                    email: this.email_candidate,
                    age: this.age_candidate,
                    url_linkedin: this.likedin_candidate,
                    technologies: this.selectedTechnologies
                }

                console.log(params);

                axios.post('/candidate', params).then((response) => {
                    
                    console.log(response.data);
                    const candidate = response.data;
                    this.$emit('new', candidate);
                })

                
                // this.name_candidate = '';
                // this.email_candidate = ''; 
                // this.age_candidate = '';
                // this.likedin_candidate = '';
            }
        }

       
    }
</script>
