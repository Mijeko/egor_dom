import {defineStore} from "pinia";
import type AlertItemDto from "@/dto/AlertItemDto.ts";

export const useAlertsStore = defineStore('alerts', {
  state: () => ({
    alerts: [] as AlertItemDto[],
  }),
  actions: {
    createAlert(title: string, text: string, type: "error" | "success" | "warning" | "info" | undefined = 'success') {
      let alert: AlertItemDto = {title: title, text: text, type: type};
      this.alerts.push(alert);
    },
  },
  getters: {
    listAlert(state) {
      return state.alerts;
    },
  }
});
