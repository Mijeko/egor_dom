export default class ObjectMap {
  static objectToFormData(
    obj: Record<string, any>,
    formData: FormData = new FormData(),
    parentKey: string = ''
  ) {
    for (const key in obj) {
      if (!obj.hasOwnProperty(key)) continue;

      const value = obj[key];
      const currentKey = parentKey ? `${parentKey}[${key}]` : key;

      if (value === null || value === undefined) {
        continue; // Пропускаем null и undefined
      }

      // Обработка Blob (включая File)
      if (value instanceof Blob) {
        formData.append(currentKey, value);
        continue;
      }

      // Обработка массивов
      if (Array.isArray(value)) {
        value.forEach((item, index) => {
          const arrayKey = `${currentKey}[${index}]`;
          this.recursiveAppend(formData, arrayKey, item);
        });
        continue;
      }

      // Обработка объектов (кроме Blob и массивов)
      if (typeof value === 'object') {
        this.objectToFormData(value, formData, currentKey);
        continue;
      }

      // Все остальные типы преобразуем в строку
      formData.append(currentKey, String(value));
    }

    return formData;
  }


  static recursiveAppend(formData: FormData, key: string, value: any): void {
    if (value === null || value === undefined) return;

    if (value instanceof Blob) {
      formData.append(key, value);
    } else if (Array.isArray(value)) {
      value.forEach((item, index) => {
        this.recursiveAppend(formData, `${key}[${index}]`, item);
      });
    } else if (typeof value === 'object') {
      for (const subKey in value) {
        if (value.hasOwnProperty(subKey)) {
          this.recursiveAppend(formData, `${key}[${subKey}]`, value[subKey]);
        }
      }
    } else {
      formData.append(key, String(value));
    }
  }
}
