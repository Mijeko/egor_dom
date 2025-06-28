export default interface DaDataSuggestionsBankDataDto {
  name: {
    payment: string,
    full: string,
    short: string,
  },
  bic: string;
  kpp: string;
  correspondent_account: string;
}
