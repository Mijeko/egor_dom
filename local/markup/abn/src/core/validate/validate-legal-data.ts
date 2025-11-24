import CoreHelper from "@/service/CoreHelper.ts";

const ValidateLegalData = {
  inn: [
    (value: string) => {

      if (!CoreHelper.checkDig(value, 10) && !CoreHelper.checkDig(value, 12)) {
        return 'ИНН должен содержать 10 или 12 символов';
      }

      return true;
    }
  ],
  bik: [
    (value: string) => {

      if (!CoreHelper.checkDig(value, 9)) {
        return 'БИК должен содержать 9 символов';
      }

      return true;
    }
  ],
  ogrn: [
    (value: string) => {

      if (!CoreHelper.checkDig(value, 13) && !CoreHelper.checkDig(value, 15)) {
        return 'ОГРН/ОГРНИП должен содержать 13 или 15 символов';
      }

      return true;
    }
  ],
  kpp: [
    (value: string) => {

      if (!CoreHelper.checkDig(value, 9)) {
        return 'КПП должен содержать 9 символов';
      }

      return true;
    }
  ],
  currAcc: [
    (value: string) => {

      if (!CoreHelper.checkDig(value, 20)) {
        return 'Расчетный счет должен содержать 20 символов';
      }

      return true;
    }
  ],
  corrAcc: [
    (value: string) => {

      if (!CoreHelper.checkDig(value, 20)) {
        return 'Кореспондентский счет должен содержать 20 символов';
      }

      return true;
    }
  ],
  postAddress: [],
  legalAddress: [],
  bankName: [],
};
export default ValidateLegalData;
