<template>
	<div class="main-screen">
		<router-view/>
	</div>
</template>

<script>
export default {
  name: 'MainScreen',
  props: {
    
  }
}
</script>

<style scoped lang="scss">
.main-screen{
	display: flex;
	flex-direction: column;
	justify-content: space-between;
}
</style>