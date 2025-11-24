import type DaDataSuggestionsCompanyAddressDto
  from "@/dto/response/api/dadata/company/DaDataSuggestionsCompanyAddressDto.ts";

export default interface DaDataSuggestionsCompanyDataDto {
  kpp: string;
  inn: string;
  ogrn: string;
  okpo: string;
  okato: string;
  okved: string;
  address: DaDataSuggestionsCompanyAddressDto
}
