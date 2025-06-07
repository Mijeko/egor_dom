import {createApp} from 'vue'
import {registerPlugins} from "@/plugins";
import type {Component} from "@vue/runtime-core";


export default class VueService {

  static async getComponent(name: string) {
    const components = import.meta.glob('./components/**/*.vue');
    // console.log(`./components/${name}.vue`);
    // console.log(components);
    return await components[`./components/${name}.vue`]() as any;
  }

  static async render(componentName: string, selectors: string) {

    let component = await this.getComponent(componentName);

    const targetElement = document.getElementById(selectors) as HTMLElement;
    if (targetElement) {
      let params: Record<string, unknown> = {};
      Object.keys(targetElement.dataset).forEach(function (key: string) {
        try {
          params[key] = JSON.parse(targetElement.dataset[key] as string);
        } catch (e) {
          params[key] = targetElement.dataset[key];
        }
      });

      const app = createApp(component, {...params});

      // app.config.globalProperties.$breakpoints = breakpoint;
      registerPlugins(app);

      console.log(app);
      console.log(component);
      console.log(targetElement);

      app.mount(targetElement);
    }
  }

}


declare global {
  interface Window {
    vs: any;
  }
}

window.vs = VueService;
