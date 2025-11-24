import type SelectVariantDto from "@/dto/present/component/SelectVariantDto.ts";
import {isProxy, toRaw} from "vue";

export default class SelectHelper {
  static map(items: any[], keys: { label: string; key: string }): SelectVariantDto[] {
    let result: SelectVariantDto[] = [];

    if (isProxy(items)) {
      items = Object.values(toRaw(items));
    }

    for (let item of items) {
      if (item[keys.key]) {
        result.push({label: item[keys.label], value: item[keys.key]} as SelectVariantDto);
      }
    }

    return result;
  }
}
