import type DeveloperDto from "@/dto/entity/DeveloperDto.ts";
import type BxImage from "@/dto/bitrix/BxImage.ts";
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";
import type LocationDto from "@/dto/LocationDto.ts";

export default interface BuildObjectDto {
  id: number;
  name?: string;
  description?: string;
  type?: string;
  floors?: number;
  developer?: DeveloperDto;
  detailLink?: string;
  gallery?: BxImage[];
  apartments?: ApartmentDto[],
  location?: LocationDto,
  countApartments?: number;
}
