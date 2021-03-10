<template>

    <div>
        <ul class="list-group">

            <li class="list-group-item list-group-item-">
                <h5 class="card-title" >{{ task.name }} - {{ task.email }} </h5>

                <h6 class="card-subtitle mb-2 text-muted"> {{ task.description }}</h6>

                <div class="progress" style="height: 5px; margin-bottom: 10px">
                    <div  class="progress-bar bg-warning" role="progressbar" v-bind:style="{ width: percent+'%' }" v-bind:aria-valuenow="{percent}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <button v-if="pendingMode" class="btn btn-warning card-link" v-on:click="onClickPending()">Pendente</button>
                <button v-show="!pendingMode" class="btn btn-primary card-link"  v-on:click="onClickDone()" :disabled='isDisabled'>{{ isDisabled ? 'Concluido' : 'Concluir' }}</button>

            </li>
        </ul>
    </div>

    
                

</template>

<script>
    export default {
        
        props: ['task'],

        data(){
            return {
                pendingMode: true,
                isDisabled: false,
                password: '',
                percent: '0',
                validate_password: "TrabalheNaSaipos",
            }
        },

        mounted() {
            this.onChangeButton(this.task);
        },

        methods: {
            onClickDone() {
                
                this.pendingMode = true;

                axios.get('task_done/'+this.task.id).then((response) => {
                    
                    const task = response.data;

                    this.onChangeButton(task);
                
                    this.$emit('update', task);
                    
                });
            },
            onClickPending() {
                
                axios.get('task_pending/'+this.task.id).then((response) => {
                
                    const task = response.data;
                    this.onChangeButton(task);
                    this.$emit('update', this.task);
            
                }).
                catch(error => {
                    
                    alert('Essa tarefa não pode mais voltar a ser pendente. Crie outra Tarefa :)');
                    
                })
                
            },
            onChangeButton(task) {

                if(task.pending == false && task.pending_count >= 2){
                    this.isDisabled = true;
                    this.pendingMode = false;
                }else if(task.pending){
                    this.pendingMode = false;
                }else{
                    this.pendingMode = true;
                }

                this.percent = Math.trunc((task.pending_count/2)*100)

            }
        }

    }
</script>
