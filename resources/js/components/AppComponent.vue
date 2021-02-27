<template>
    <div id="app">

        <form-component
             @new="addCandidate"
        >
        </form-component>


        <div class="card">
            <div class="card-header">Lista De Candidatos</div>

            <candidate-component 
                v-for="(candidate, index) in candidates" 
                :key="candidate.id" 
                :candidate="candidate" 
                @delete="deleteCandidate(index)"
                @update="updateCandidate(index, candidate)">
            </candidate-component>

        </div>

    </div>
    
</template>

<script>
    export default {
        data() {
            return {
                candidates: []
            }
        },
        mounted() {
            axios.get('/candidate').then((response) => {
                this.candidates = response.data;
                console.log(this.candidates);
            })
        },
        methods: {
            addCandidate(candidate){
                
                this.candidates.push(candidate);
            },

            deleteCandidate(index){
                this.candidates.splice(index, 1);
            },

            updateCandidate(index, candidate){
                this.candidates[index] = candidate;
            }
        }
    }
</script>
