import type RegisterSimpleAgentRequestDto from "@/dto/request/RegisterSimpleAgentRequestDto.ts";

export default interface RegisterAgentRequestDto extends RegisterSimpleAgentRequestDto {
  inn: string;
  kpp: string;
  ogrn: string;
  bik: string;
  currAcc: string;
  corrAcc: string;
  bankName: string;
  legalAddress: string;
  postAddress: string;
}
