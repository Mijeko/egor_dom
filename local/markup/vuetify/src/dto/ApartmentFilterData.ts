export interface ApartmentFilterData {
  propertyList: ApartmentFilterProp[]
}

export interface ApartmentFilterProp {
  name: string;
  code: string;
  type: string;
  value: ApartmentFilterPropValue[] | string
}


export interface ApartmentFilterPropValue {
  value: string;
  label: string;
}
