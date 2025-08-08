import ControllerApi from "@/service/ControllerApi.ts";
import type ApartmentPreFilterRequestDto from "@/dto/request/ApartmentPreFilterRequestDto.ts";
import type ApartmentFilterRequestDto from "@/dto/request/ApartmentFilterRequestDto.ts";

export default class ApartmentFilterService {
  preFilterAction(body: ApartmentPreFilterRequestDto) {
    return ControllerApi.post('craft:apartment.filter', body);
  }

  filterAction(body: ApartmentFilterRequestDto) {
    return ControllerApi.post('craft:apartment.filter', body);
  }

  static filterData() {
    return ControllerApi.post('craft:apartment.filter.data');
  }
}
