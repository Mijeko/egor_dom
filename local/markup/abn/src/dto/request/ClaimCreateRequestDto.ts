import type ClaimCreateShortRequestDto from "@/dto/request/ClaimCreateShortRequestDto.ts";

export default interface ClaimCreateRequestDto extends ClaimCreateShortRequestDto {
  bik: string,
  kpp: string,
  inn: string,
  ogrn: string,
  currAccount: string,
  corrAccount: string,
  legalAddress: string,
  postAddress: string,
  bankName: string,
}
