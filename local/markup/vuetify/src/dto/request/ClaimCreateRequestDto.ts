export default interface ClaimCreateRequestDto {
  userId: number;
  apartmentId: number;
  phone: string;
  email: string;
  client: string;
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
