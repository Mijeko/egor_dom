<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ClaimDto from "@/dto/entity/ClaimDto.ts";

export default defineComponent({
  name: "ListClaims",
  props: {
    claims: {
      type: Array as PropType<ClaimDto[]>,
      default: [],
    }
  }
})
</script>

<template>
  <v-app>
    <v-card v-for="claim in claims">
      <v-row>
        <v-col md="2">
          <v-card-text>
            <span class="font-weight-bold">Заявка №{{ claim.id }}</span>
          </v-card-text>
        </v-col>
        <v-col md="5">
          <v-card-text>
            <span class="text-decoration-underline">
              {{ claim.name }}
            </span>
          </v-card-text>
        </v-col>
        <v-col md="3">
          <v-chip prepend-icon="$vuetify">
            Ожидаются документы
          </v-chip>
        </v-col>
        <v-col md="2">
          <v-btn :href="`/profile/orders/${claim.id}/`">
            Подробнее
          </v-btn>
        </v-col>

      </v-row>
    </v-card>
  </v-app>
</template>

<style scoped>

</style>
