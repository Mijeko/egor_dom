import {createApp} from 'vue'
import {registerPlugins} from "@/plugins";
import {Component} from "@vue/runtime-core";


export default class VueService {

  static render(component: Component, selectors: string) {

    const mountedElements = document.querySelectorAll(selectors);
    mountedElements.forEach(mountedElement => {

      if (mountedElement) {
        let params: Record<string, unknown> = [];
        Object.keys(mountedElement.dataset).forEach(function (key) {
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
