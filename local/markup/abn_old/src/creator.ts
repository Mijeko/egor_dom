import type {App} from 'vue'
import InertiaCreator from '@inertiajs/core'
// import {loadPlugins} from '@/bootstrap'
import DefaultLayout from '@/layouts/default.vue'

import {InertiaApp, InertiaAppProps} from "@inertiajs/vue3/types/app";

export default class Creator extends InertiaCreator {
  protected defaultLayout = DefaultLayout
  protected pages: any;

  constructor(pages: any) {
    super();

    this.pages = pages;
  }

  protected pagePath(name: string): string {
    return `./pages/${name}.vue`
  }

  public getPages() {
    return this.pages;
  }

  protected setup(vueApp: App, config: {
    el: Element;
    App: InertiaApp;
    props: InertiaAppProps;
    plugin: Plugin;
  }): void {
    super.setup(vueApp, config)

    // if(!devOnly(() => true)) {
    //     vueApp.config.errorHandler = () => null;
    //     vueApp.config.warnHandler = () => null;
    // }

    // loadPlugins(vueApp)
  }
}
