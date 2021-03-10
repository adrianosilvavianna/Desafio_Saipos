
<template>
    <!-- <div class="modal" v-if="modalOpen">
        <div class="container">
          <div class="modal__title">Direction</div>
          <p>Get a direction with your favourite apps</p>

          <button @click.prevent="close" class="mt-3 border-b border-teal font-semibold">Close</button>
        </div>
    </div> -->

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Digite a senha do Supervisor</h5>            
            </div>
            <div class="modal-body">
                
                <p v-show="message_validate">{{ message_validate }}</p>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Senha" v-model="password">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="onClickClose()">Close</button>
                <button type="button" class="btn btn-primary" v-on:click="onClickClose()">Enviar</button>
            </div>
            </div>
        </div>
    </div>

</template>
    
    <script>
        export default {
            
            props: ['modalOpen'],
            
            data(){
                return {
                    password: '',
                    validate_password: "TrabalheNaSaipos",
                    message_validate: null
                }
            },

            mounted() {
                console.log('entrou aqui' + this.modalOpen);
                
                $('#exampleModalCenter').modal('show');
            },
            methods: {
                sendPassword(){
                    if(this.password == this.validate_password){
                        this.$emit("validate", true);      
                    }else{
                        this.message_validate = 'Senha Inválida';
                    }
                },
                onClickClose() {
                  this.$emit("input", !this.modalOpen);
                }            
            }
        };
    </script>
    
    <style lang="css" scoped>
        .modal {
          background-color: rgba(0, 0, 0, 0.7);
      }
    </style>