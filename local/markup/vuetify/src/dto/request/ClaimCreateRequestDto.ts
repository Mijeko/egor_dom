export default interface ClaimCreateRequestDto {
  userId: number;
  buildObjectId: number;
  phone: string;
  email: string;
  client: string;
  bik: number,
  kpp: number,
  inn: number,
  ogrn: number,
  currAccount: number,
  corrAccount: number,
  legalAddress: string,
  postAddress: string,
  bankName: string,
}
