<template>
    <div class="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.to == contact.id ? ' sent' : ' received'}`" :key="message.id">
                <div class="text">
                    {{ message.text }}
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        contact: {
            type: Object,
            required: false
        },

        messages: {
            type: Array,
            required: false
        }
    }
}
</script>

<style lang="css" scoped>
.feed {
    height: 14em;
    overflow: scroll;
}

.feed > ul {
    list-style-type: none;
    padding-left: 0;
}

.message {
    margin-bottom: 1em;   
}

.sent {
    background-color: rgb(80, 170, 147);
}

.received {
    background-color: bisque;
}
</style>