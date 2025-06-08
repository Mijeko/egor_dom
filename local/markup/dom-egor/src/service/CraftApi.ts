export default class CraftApi {

  static host: string = 'https://dom.local';
  static key: string = 'ug4k7eew7wa5jnln';

  static get(method: string, formData: FormData, headers: any) {
    return fetch(`${this.host}/rest/1/${this.key}/${method}/`, {
      method: 'GET',
      body: formData,
      headers: headers
    });
  }

  static post(method: string, formData: FormData, headers: any) {
    return fetch(`${this.host}/rest/1/${this.key}/${method}/`, {
      method: 'POST',
      body: formData,
      headers: headers
    });
  }
}
