<template>
    <div class="composer">
        <textarea v-model="message" @keydown.enter="send" placeholder="Digite uma Mensagem..."></textarea>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                message: ''
            }
        },
        methods: {
            send() {
                /**
                 * Verifica se a mensagem nao ta vazia ne
                 * 
                */
                if(this.message == ''){
                    return;
                }

                this.$emit('send', this.message);
                /**
                 * Limpa o text area dps de enviar
                 * 
                */
                this.message = '';
            }
        }
    }
</script>