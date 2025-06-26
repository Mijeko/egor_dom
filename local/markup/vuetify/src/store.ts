import {defineStore} from "pinia";
import type AlertItemDto from "@/dto/AlertItemDto.ts";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import {th} from "vuetify/locale";

export const useAlertsStore = defineStore('alerts', {
  state: () => ({
    alerts: [] as AlertItemDto[],
  }),
  actions: {
    clear() {
      this.alerts = [];
    },
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


export const useUserStore = defineStore('user', {
  state: () => ({
    user: {} as BxUserDto,
  }),
  actions: {
    updateInfo(newUserInfo: BxUserDto) {
      this.user = newUserInfo;
    },
  },
  getters: {
    getUser(state) {
      return state.user;
    },
  }
});
