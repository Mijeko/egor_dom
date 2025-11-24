import Env from "@/core/env.ts";

export default class CraftApi {

  host: string = window.location.host;
  apiKey: string = Env.get().apiKey;
  apiUserId: number = Env.get().apiUserId;

  post(method: string, body: FormData, headers: any = {}): Promise<Response> {
    return fetch(`${this.host}/rest/1/${this.apiKey}/${method}/`, {
      method: 'POST',
      body: body,
      headers: headers
    });
  }
}
