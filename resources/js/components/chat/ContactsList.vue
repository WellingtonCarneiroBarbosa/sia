<template>
    <div class="contacts-list">
        <ul>
            <li v-for="(contact, index) in contacts" :key="contact.id" @click="selectContact(index, contact)" :class="{ 'selected': index == selected }">
                
                <div class="avatar">
                    <img :src="contact.profile_image" :alt="contact.name">
                </div>

                <div class="contact">
                    <p class="name">{{ contact.name }}</p>
                    <p class="email">{{ contact.email }}</p>
                </div>

                <hr>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                selected: 0
            }
        },
        props: {
            contacts: {
                type: Array,
                default: []
            }
        },
        methods: {
            selectContact(index, contact){
                this.selected = index;

                this.$emit('selected', contact);
            }
        }
    }
</script>

<style lang="css" scoped>
.contacts-list {
    flex: 2;
    max-height: 25em;
    overflow: scroll;
}

.contacts-list > ul {
    list-style-type: none;
    padding-left: 0;
}

.avatar, .name, .email {
    cursor: pointer;
}
</style>