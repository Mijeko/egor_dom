import {createApp, createSSRApp, type DefineComponent, h} from 'vue'
import {createInertiaApp} from '@inertiajs/vue3'
import {resolvePageComponent} from "laravel-vite-plugin/inertia-helpers";

type PromisedVue = DefineComponent | Promise<DefineComponent>;
import DefaultLayout from '@/layouts/default.vue'
import vuetify from "@/plugins/vuetify.ts";
import pinia from "@/stores";

const defaultLayout = DefaultLayout;


document.addEventListener('DOMContentLoaded', function () {


  createInertiaApp({
    id: 'app',
    resolve: async (name) => {
      let component: PromisedVue = resolvePageComponent(
        `./pages/${name}.vue`, import.meta.glob('./pages/**/*.vue') as any
      ) as PromisedVue;

      if (component instanceof Promise) {
        try {
          component = await component;
        } catch (e) {
          throw new Error(`Page not found: ${name}`);
        }
      }

      if (defaultLayout) {
        let def = component as DefineComponent;

        if ('default' in def) {
          def = def.default as DefineComponent;
        }

        def.layout = def.layout ?? defaultLayout;
      }

      return component as DefineComponent;
    },
    setup({el, App, props, plugin}) {
      createSSRApp({render: () => h(App, props)})
        .use(plugin)
        .use(vuetify)
        .use(pinia)
        .mount(el)
    },
  })
});
