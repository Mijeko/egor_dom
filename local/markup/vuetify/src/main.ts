import {createApp, createSSRApp} from 'vue';
import {registerPlugins} from "@/plugins";
import './store.ts';

export default class VueService {

  static async getComponent(name: string) {
    try {
      const components = import.meta.glob('./components/**/*.vue');
      const module = await components[`./components/${name}.vue`]() as any;
      return module.default as any;
    } catch (e) {
      console.log(`Компонент ${name} не найден`);
    }
  }

  static async render(componentName: string, selectors: string, extParams: Record<string, unknown> = {}) {
    let component = await this.getComponent(componentName);


    if (!component) {
      return;
    }

    const targetElement = document.getElementById(selectors) as HTMLElement;
    let params: Record<string, unknown> = {};
    if (targetElement && !extParams) {
      Object.keys(targetElement.dataset).forEach(function (key: string) {
        try {
          params[key] = JSON.parse(targetElement.dataset[key] as string);
        } catch (e) {
          params[key] = targetElement.dataset[key];
        }
      });

    } else {
      params = extParams;
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
