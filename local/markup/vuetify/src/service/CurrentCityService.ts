import type CityDto from "@/dto/entity/CityDto.ts";
import CraftApi from "@/service/CraftApi.ts";
import type CurrentCityResponseDto from "@/dto/response/CurrentCityResponseDto.ts";
import type CurrentCityRequestDto from "@/dto/request/CurrentCityRequestDto.ts";

export default class CurrentCityService {

  saveCity(city: CityDto): Promise<CurrentCityResponseDto> {
    let api = new CraftApi();

    let request: CurrentCityRequestDto = {
      id: city.id
    };

    return api.post('city.current.store', api.objectToFormData(request)).then(response => response.json());
  }
}
