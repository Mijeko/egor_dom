<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "WithSocial",
  data: () => {
    return {
      social: [
        {icon: '$googleIcon'},
        {icon: '$tgIcon'},
        {icon: '$vkIcon'},
        {icon: '$yandexIcon'},
      ],
    };
  }
})
</script>

<template>
  <div class="signin-with-social">
    <div class="signin-with-social-line-wrap">
      <div class="signin-with-social-line-text">или</div>
      <div class="signin-with-social-line"></div>
    </div>


    <div class="signin-with-social-list">
      <div class="signin-with-social-item" v-for="(socialItem, index) in social">
        <v-icon :icon="socialItem.icon" :key="index"/>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
