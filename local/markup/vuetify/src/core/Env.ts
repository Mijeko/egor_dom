import type EnvInterface from "@/dto/EnvInterface.ts";

export default class Env {
  static get(): EnvInterface {

    let host: string = window.location.host;

    if (host === 'dom.local') {
      return {
        apiKey: 'ug4k7eew7wa5jnln',
      };
    }

    // is production
    return {
      apiKey: '',
    };
  }
}
