<script lang="ts">
import {defineComponent} from 'vue'
import UserService from "@/service/User/UserService.ts";
import type CreateManagerRequestDto from "@/dto/request/CreateManagerRequestDto.ts";
import AlertService from "@/service/AlertService.ts";
import type CreateManagerResponseDto from "@/dto/response/CreateManagerResponseDto.ts";
import PhoneInput from "@/components/site/form/element/PhoneInput.vue";

export default defineComponent({
  name: "CreateManagerModal",
  components: {PhoneInput},
  props: {
    modelValue: {
      type: Boolean,
      default: false
    },
  },
  data: function () {
    return {
      isValidForm: false,
      form: {
        phone: null,
        email: null,
        name: null,
        lastName: null,
      },
      validate: {
        phone: [
          (value: string) => {
            if (!value || value.length <= 0) {
              return 'Заполните телефон';
            }

            return true;
          },
        ],
        email: [
          (value: string) => {
            if (!value || value.length <= 0) {
              return 'Заполните email';
            }

            return true;
          },
        ],
        name: [],
        lastName: [],
      },
    };
  },
  computed: {
    showModalComputed: {
      get(): boolean {
        return this.modelValue;
      },
      set(value: boolean) {
        this.$emit('update:modelValue', value);
      }
    }
  },
  methods: {
    closeModal: function () {
      this.showModalComputed = false;
      this.$emit('update:modelValue', false);
    },
    submitForm() {
      if (!this.isValidForm) {
        return false;
      }

      let body: CreateManagerRequestDto = {
        phone: String(this.form.phone),
        email: String(this.form.email),
        name: String(this.form.name),
        lastName: String(this.form.lastName),
      };

      let service = new UserService();
      service.createManager(body)
        .then((response: CreateManagerResponseDto) => {

          let {status} = response;

          if (status === 'success') {
            AlertService.showAlert('Новый менеджер', 'Менеджер успешно создан');
            this.$emit('update:modelValue', false);

            this.form.email = null;
            this.form.phone = null;
            this.form.name = null;
            this.form.lastName = null;
          }
        });

    }
  }
})
</script>

<template>
  <v-dialog max-width="500" v-model="showModalComputed">
    <template v-slot:default="{ isActive }">
      <v-card title="Добавить менеджера">

        <v-card-text>
          <v-form v-model="isValidForm" @submit.prevent="submitForm">
            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="E-Mail" v-model="form.email" :rules="validate.email" required/>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="12">
                <PhoneInput
                  label="Телефон"
                  v-model="form.phone"
                  :rules="validate.phone"
                  required
                />
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="Имя" v-model="form.name" :rules="validate.name"/>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="Фамилия" v-model="form.lastName" :rules="validate.lastName"/>
              </v-col>
            </v-row>

            <v-divider class="mb-3"/>


            <v-card-actions class="flex-row justify-space-between ga-2">
              <v-btn color="primary" type="submit">Добавить</v-btn>
              <v-btn @click="closeModal">Закрыть</v-btn>
            </v-card-actions>
          </v-form>
        </v-card-text>

      </v-card>
    </template>
  </v-dialog>
</template>

<style scoped>

</style>
