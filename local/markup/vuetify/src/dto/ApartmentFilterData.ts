import type CheckboxDropdownItemDto from "@/dto/present/CheckboxDropdownItemDto.ts";

export interface ApartmentFilterData {
  propertyList: ApartmentFilterProp[]
}

export interface ApartmentFilterProp {
  name: string;
  code: string;
  value: ApartmentFilterPropValue[] | string | CheckboxDropdownItemDto[]
}


interface ApartmentFilterPropValue {
  value: string;
  label: string;
}
