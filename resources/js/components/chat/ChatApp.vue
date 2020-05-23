<template>
    <div class="chat-app">
        <Conversation :contact="selectedContact" :messages="messages" />
        <ContactsList :contacts="contacts" @selected="startConversationWith"/>
    </div>
</template>

<script>
    import Conversation from "./Conversation";
    import ContactsList from "./ContactsList";

    export default {
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: []
            };
        },
        mounted() {
            axios.get('/dash/chat/contacts')
                .then((response) => {
                    this.contacts = response.data;
                });
        },
        methods: {
            startConversationWith(contact) {
                axios.get(`/dash/chat/conversation/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    });
            }
        },
        components: {Conversation, ContactsList}
    }
</script>

<style lang="css" scoped>
.chat-app {
    display: flex;
}
</style>
