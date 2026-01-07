import CoreHelper from "@/service/CoreHelper.ts";

const ValidatePersonalData = {
  phone: [
    (value: string) => {

      if (!value || value.length <= 0) {
        return 'Нужно заполнить';
      }

      if (!CoreHelper.checkDig(value, 11)) {
        return 'Телефон должен состоять из 11 символов';
      }

      return true;
    }
  ],
  email: [
    (value: string) => {
      if (!value || value.length <= 0) {
        return 'Введите e-mail адрес';
      }

      const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      let valid = re.test(String(value).toLowerCase());

      if (valid) {
        return 'Некорректный e-mail';
      }
      return true;
    }
  ],
  password: [
    (value: string) => {
      if (!value || value.length <= 0) {
        return 'Введите пароль';
      }

      if (value.length < 6) {
        return 'Пароль должен быть больше 6 символов';
      }
      return true;
    }
  ],
  agree: [
    (value: boolean) => {
      if (!value) {
        return 'Необходимо дать свое согласие';
      }

      return true;
    }
  ]
};
export default ValidatePersonalData;

