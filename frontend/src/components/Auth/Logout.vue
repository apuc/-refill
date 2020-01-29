<template>
    <div>

    </div>
</template>

<script>
export default{
    beforeCreate() {
        this.$store.dispatch('auth/LOG_OUT_REQUEST').then(success => {
            this.$router.push('login');
        }).catch(error => {
            this.$router.push('login');
        });
    }
}
</script>
