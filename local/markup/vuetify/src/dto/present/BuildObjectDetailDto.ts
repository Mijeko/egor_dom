import type DeveloperDto from "@/dto/entity/DeveloperDto.ts";
import type BxImage from "@/dto/bitrix/BxImage.ts";
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";

export default interface BuildObjectDetailDto {
  id: number;
  name?: string;
  floors?: number;
  developer?: DeveloperDto;
  detailLink?: string;
  gallery?: BxImage[];
  apartments?: ApartmentDto[]
}
