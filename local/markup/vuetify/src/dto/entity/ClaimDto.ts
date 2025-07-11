import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";

export default interface ClaimDto {
  id: number;
  name: string;
  clientName: string;
  phone: string;
  email: string;
  kpp: string;
  inn: string;
  ogrn: string;
  bik: string;
  currAcc: string;
  corrAcc: string;
  legalAddress: string;
  postAddress: string;
  apartment: ApartmentDto;
  createdAt: string;
}
