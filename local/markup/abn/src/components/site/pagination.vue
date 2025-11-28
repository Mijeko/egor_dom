<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "Pagination",
  computed: {
    items(): number[] {
      let result = [];
      let start = 1;

      while (start < 10) {
        result.push(start);
        start++;
      }

      return result;
    }
  }
})
</script>

<template>
  <ul class="pagination">
    <li class="pagination-item" v-for="item in items">
      <a class="pagination-link" href="">{{ item }}</a>
    </li>
  </ul>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.pagination {
  margin: auto;

  display: flex;
  gap: 10px;

  &-item {
    padding: 10px;
    border-radius: 5px;
    border: 1px solid $stat-border-color;
    line-height: 0.7;
    color: $bo-char-label;
    text-decoration: none;
    transition: 0.4s ease all;

    &.active, &:hover {
      border-color: $about-text-border;
      color: $about-text-border;
    }
  }

  &-link {
    text-decoration: inherit;
    color: inherit;
    line-height: inherit;
  }
}
</style>
