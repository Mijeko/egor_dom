import type DaDataSuggestionsCompanyInnAddressDto
  from "@/dto/response/api/dadata/DaDataSuggestionsCompanyInnAddressDto.ts";

export default interface DaDataSuggestionsCompanyInnDataDto {
  kpp: string;
  inn: string;
  ogrn: string;
  okpo: string;
  okato: string;
  okved: string;
  address: DaDataSuggestionsCompanyInnAddressDto
}
