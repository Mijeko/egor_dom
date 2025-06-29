export default class CoreHelper {
  static checkDig(value: string, len: number) {
    value = value.toString();
    let checkValue = value.replace(/D+/g, '');
    return checkValue.length === len || value.length === len;
  }

  static emailIsValid(email: string) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
  }

}
