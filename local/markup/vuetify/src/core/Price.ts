export default class Price {
  static format(price: number) {
    return Intl.NumberFormat('ru-RU', {style: 'currency', currency: 'RUB', maximumFractionDigits: 0}).format(price);
  }
}
