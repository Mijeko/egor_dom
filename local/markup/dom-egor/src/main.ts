import {createApp} from 'vue';
import {registerPlugins} from "@/plugins";
import type {Component} from 'vue';

export type VueWithLayout = Component | {
  layout?: PromisedVue
};

export type PromisedVue = VueWithLayout | Promise<VueWithLayout> | (VueWithLayout | Promise<VueWithLayout>)[]

const components = import.meta.glob('./components/**/*.vue');

export default class VueService {

  static async getComponent(name: string) {
    const module = await components[`./components/${name}.vue`]() as any;
    return module.default as VueWithLayout;
  }

  static async render(componentName: string, selectors: string) {
    let component = await this.getComponent(componentName);


    if (!component) {
      return;
    }

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

    }

    const app = createApp(component);
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
