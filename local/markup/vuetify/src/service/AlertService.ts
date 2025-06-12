import {useAlertsStore} from "@/store.ts";

export default class AlertService {
  static showAlert(title: string, text: string) {
    const alertStore = useAlertsStore();
    alertStore.createAlert(title, text);
  }

  static showErrorAlert(title: string, text: string) {
    const alertStore = useAlertsStore();
    alertStore.createAlert(title, text, 'error');
  }
}
