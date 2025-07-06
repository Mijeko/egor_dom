import type BxImage from "@/dto/bitrix/BxImage.ts";
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";

export default interface BuildObjectDto {
  id: number;
  name: string;
  detailLink: string;
  picture?: BxImage;
  apartments?: ApartmentDto[];
}
