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

    let comp = await this.getComponent(componentName)

    const mountedElement = document.getElementById(selectors) as HTMLElement;
    // mountedElements.forEach((element: Element, key: number, parent: NodeListOf<Element>) => {

      // let mountedElement = element as HTMLElement;

      if (mountedElement) {
        let params: Record<string, unknown> = {};
        Object.keys(mountedElement.dataset).forEach(function (key: string) {
          try {
            params[key] = JSON.parse(mountedElement.dataset[key] as string);
          } catch (e) {
            params[key] = mountedElement.dataset[key];
          }
        });

        const app = createApp(comp, {...params});

        // app.config.globalProperties.$breakpoints = breakpoint;
        registerPlugins(app);

        console.log(comp);
        console.log(mountedElement);
        app.mount(mountedElement);
      }

    // });
  }

}


declare global {
  interface Window {
    vs: any;
  }
}

window.vs = VueService;
