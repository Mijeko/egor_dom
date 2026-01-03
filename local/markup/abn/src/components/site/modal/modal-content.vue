<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "ModalContent",
  props: {
    modelValue: {
      type: Boolean,
      default: false,
    }
  },
  methods: {
    close: function () {
      this.modelValueComp = false;
    }
  },
  computed: {
    modelValueComp: {
      set() {
        this.$emit('update:modelValue');
      },
      get() {
        return this.modelValue;
      },
    }
  }
})
</script>

<template>


  <div class="modern-modal">

    <div class="modern-modal-close" @click="close">
      <img src="@/assets/images/icons/close-modal.svg" alt="Закрыть">
    </div>

    <div class="modern-modal-left">
      <div class="modern-modal-bg">
        <img
          class="modal-img"
          src="@/assets/images/modal/bg/auth.png"
          alt="Фон модального окна"
        >
      </div>
    </div>
    <div class="modern-modal-right">
      <slot name="content"></slot>
    </div>
  </div>

</template>

<style lang="scss">
.modern-modal {
  display: flex;
  background: white;
  border-radius: 20px;
  overflow: hidden;
  position: relative;

  &-close {
    position: absolute;
    top: 0;
    right: 0;
    margin: 15px 15px 0 0;
    cursor: pointer;
  }

  &-bg {
    padding-bottom: 150%;
    position: relative;

    .modal-img, img {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }

  &-left {
    width: 50%;
  }

  &-right {
    width: 50%;
    padding: 40px 20px 20px 20px;
  }
}
</style>
