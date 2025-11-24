import {renderToString} from '@vue/server-renderer';
import createServer from '@inertiajs/core/server'
import {createApp, createSSRApp, type DefineComponent, h} from 'vue'
import {createInertiaApp} from '@inertiajs/vue3'
import vuetify from './plugins/vuetify.ts'
import pinia from './stores'
import {resolvePageComponent} from "laravel-vite-plugin/inertia-helpers";

import DefaultLayout from '@/layouts/default.vue'

type PromisedVue = DefineComponent | Promise<DefineComponent>;


const defaultLayout = DefaultLayout;

createServer(function (page) {


    return createInertiaApp({
      page: page,
      render: renderToString,
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
      setup: ({App, props, plugin}) => {


        return createSSRApp({render: () => h(App, props)})
          .use(plugin)
          .use(vuetify)
          .use(pinia);
      },
    });
  },
  {
    port: 27000
  }
);
