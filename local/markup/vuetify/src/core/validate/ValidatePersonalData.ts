import CoreHelper from "@/service/CoreHelper.ts";

const ValidatePersonalData = {
  phone: [
    (value: string) => {
      if (!CoreHelper.checkDig(value, 11)) {
        return 'Телефон должен состоять из 11 символов';
      }

      return true;
    }
  ]
};
export default ValidatePersonalData;

