import type CityDto from "@/dto/entity/CityDto.ts";
import ControllerApi from "@/service/ControllerApi.ts";

export default class CurrentCityService {

  saveCity(city: CityDto) {
    return ControllerApi.post('craft:city.current', city);
  }
}
