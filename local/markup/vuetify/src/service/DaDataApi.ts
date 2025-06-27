import type DaDataSuggestionsCompanyInnDto from "@/dto/response/api/dadata/DaDataSuggestionsCompanyInnDto.ts";

export default class DaDataApi {

  token = '21ebc5ed8ce5d22637d7c721b2a20621bbe00646';

  suggestionsCompany(inn: string): Promise<DaDataSuggestionsCompanyInnDto> {
    return this.request('suggestions/api/4_1/rs/findById/party', {query: inn});
  }

  request(url: string, body: { query: string }): Promise<DaDataSuggestionsCompanyInnDto> {
    return fetch(
      `https://suggestions.dadata.ru/${url}`,
      {
        method: 'POST',
        mode: "cors",
        body: JSON.stringify(body),
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'Authorization': `Token ${this.token}`
        }
      }
    ).then((response: any) => response.json());
  }
}
