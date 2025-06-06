import {createApp} from 'vue'
import {registerPlugins} from "@/plugins";
import type {Component} from "@vue/runtime-core";


export default class VueService {

  static render(component: Component, selectors: string) {

    const mountedElements = document.querySelectorAll(selectors);
    mountedElements.forEach((element: Element, key: number, parent: NodeListOf<Element>) => {

      let mountedElement = element as HTMLElement;

      if (mountedElement) {
        let params: Record<string, unknown> = {};
        Object.keys(mountedElement.dataset).forEach(function (key: string) {
          try {
            params[key] = JSON.parse(mountedElement.dataset[key]);
          } catch (e) {
            params[key] = mountedElement.dataset[key];
          }
        });

        const app = createApp(component, {...params});

        // app.config.globalProperties.$breakpoints = breakpoint;
        registerPlugins(app);
        app.mount(mountedElement);
      }

    });
  }

}
