import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";

export default class BuildObjectService {
  static minPrice(object: BuildObjectDto) {
    if (!object.apartments || object.apartments.length <= 0) {
      return 0;
    }

    let apartment: ApartmentDto | null | undefined = null;
    let apartmentList: ApartmentDto[] = object.apartments;

    apartment = apartmentList.sort((a: ApartmentDto, b: ApartmentDto) => a.price - b.price).shift();

    if (!apartment) {
      return 0;
    }

    return apartment.price;
  }
}
