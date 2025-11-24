import type DaDataSuggestionsCompanyDto from "@/dto/response/api/dadata/company/DaDataSuggestionsCompanyDto.ts";
import type DaDataSuggestionsBankDto from "@/dto/response/api/dadata/bank/DaDataSuggestionsBankDto.ts";

export default class DaDataApi {

  token = '21ebc5ed8ce5d22637d7c721b2a20621bbe00646';

  suggestionsCompany(inn: string): Promise<DaDataSuggestionsCompanyDto> {
    return this.request('suggestions/api/4_1/rs/findById/party', {query: inn});
  }

  suggestionsBank(bik: string): Promise<DaDataSuggestionsBankDto> {
    return this.request('suggestions/api/4_1/rs/suggest/bank', {query: bik});
  }

  request(url: string, body: { query: string }): Promise<any> {
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
