import CoreHelper from "@/service/CoreHelper.ts";

const ValidatePersonalData = {
  phone: [
    (value: string) => {
      if (!CoreHelper.checkDig(value, 11)) {
        return 'Телефон должен состоять из 11 символов';
      }

      return true;
    }
  ],
  password: [
    (value: string) => {
      if (value.length <= 0) {
        return 'Введите пароль';
      }

      if (value.length < 6) {
        return 'Пароль должен быть больше 6 символов';
      }
      return true;
    }
  ],
};
export default ValidatePersonalData;

