<template>
    <div class="main-container">
        <h1>{{ text }}</h1>
    </div>
</template>

<script>
export default {
    props: {
        text: String
    },

    data() {
        console.log('hola');
        return {
        };
    },
};
</script>

