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
      set(value: boolean) {
        this.$emit('update:modelValue', value);
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

    <slot name="close" v-if="$slots.close"></slot>
    <div v-else class="modern-modal-close" @click="close">
      <img src="@/assets/images/icons/close-modal.svg" alt="Закрыть">
    </div>

    <div class="modern-modal-left">
      <div class="modern-modal-bg">

        <slot name="backgroundImage" v-if="$slots.backgroundImage"></slot>
        <img
          v-else
          class="modal-img"
          src="@/assets/images/modal/bg/auth.png"
          alt="Фон модального окна"
        >
      </div>
    </div>
    <div class="modern-modal-right">
      <div class="modern-modal-content">
        <slot name="content"></slot>
      </div>
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
    height: 100%;
    padding-bottom: 130%;
    position: relative;

    .modal-img, img {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }

  &-left {
    width: 40%;
  }

  &-right {
    width: 60%;
    padding: 55px 20px 20px 20px;
    background: #fff;
  }

  &-content {
    padding-right: 10px;
    max-height: 500px;
    overflow: scroll;
  }
}
</style>
