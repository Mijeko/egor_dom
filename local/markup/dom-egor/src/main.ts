import {createApp} from 'vue';
import {registerPlugins} from "@/plugins";

export default class VueService {

  static async getComponent(name: string) {
    const components = import.meta.glob('./components/**/*.vue');
    const module = await components[`./components/${name}.vue`]() as any;
    return module.default as any;
  }

  static async render(componentName: string, selectors: string) {
    let component = await this.getComponent(componentName);


    if (!component) {
      return;
    }

    const targetElement = document.getElementById(selectors) as HTMLElement;
    let params: Record<string, unknown> = {};

    if (targetElement) {
      Object.keys(targetElement.dataset).forEach(function (key: string) {
        try {
          params[key] = JSON.parse(targetElement.dataset[key] as string);
        } catch (e) {
          params[key] = targetElement.dataset[key];
        }
      });

    }

    const app = createApp(component, {...params});
    registerPlugins(app);
    app.mount(`#${selectors}`);
  }

}

declare global {
  interface Window {
    vs: any;
  }
}

window.vs = VueService;
